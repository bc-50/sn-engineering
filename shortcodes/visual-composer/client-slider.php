<?php
function clients_slider_func($atts, $content = null){
  $r = '';
  extract( shortcode_atts( array(
    'slides' => null,
    'dis' => null,
  ), $atts ) );
  ob_start(); 
  $imgIds = get_post_meta($slides,'slider_images')[0];
  $numIds = count($imgIds);
  $first = true;
  $norep = true;
  $count = 0;
  if (!is_numeric($dis) || $dis < 1) {
    $dis = 2;
  }else{
    $dis -= 2;
  } 
  ?>

  <section class="clients">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-4">
          <div class="content-wrapper">
            <?php echo wpautop($content); ?>
          </div>
        </div>
        <div class="col-xl-8 p-0">
          <div id="clients_slider" class="k-carousel slide">
            <div class="carousel-inner">
              <div class="items-wrapper">
                <?php for ($i=0; $i <= $numIds - 1 ; $i++) {  ?>
                  <div class="carousel-item<?php echo $first ? ' active' : '' ?>" data-count="<?php echo $count++ ?>">
                    <div class="inner-wrapper">
                        <div class="image-wrapper" style="background-image: url(<?php echo wp_get_attachment_image_url($imgIds[$i], 'full') ?>)">
                          <!-- <?php echo wp_get_attachment_image($imgIds[$i], 'medium'); ?> -->
                        </div>
                    </div>
                  </div>
                <?php 
                  if ($dis == -1) {
                    $first = false;
                  } else{
                    $first = $i > $dis ? false : true;
                  }
                  if (!$first && $norep) {
                    $noslide = $i + 1;
                    $norep = false;
                  }} 
                ?>
              </div>
            </div>
            <?php if ($numIds > $noslide && $numIds > $dis) { ?>
              <a class="carousel-control-prev carousel-button" href="#clients_slider" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true" style="background-image: url(<?php echo get_theme_file_uri('img/prev.png') ?>)"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next carousel-button" href="#clients_slider" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true" style="background-image: url(<?php echo get_theme_file_uri('img/next.png') ?>)"></span>
                <span class="sr-only">Next</span>
              </a>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php
  $r = ob_get_clean();
  return $r;
}
add_shortcode('clients_slider', 'clients_slider_func');
add_action('vc_before_init', 'clients_slider_map');
function clients_slider_map()
{
  vc_map(array(
    'name' => __('Clients Slider', 'my-text-domain'),
    'base' => 'clients_slider',
    'category' => __( 'Brace Elements', 'my-text-domain'),
    'icon' => get_template_directory_uri().'/shortcodes/visual-composer/vc-brace-icon.png',
    'params' => array(
    array(
      'type' => 'dropdown',
      'heading' => __( 'Choose Slider', 'my-text-domain' ),
      'param_name' => 'slides',
      'value' => all_sliders(),
    ),
    array(
      'type' => 'textfield',
      'holder' => 'p',
      'heading' => __( 'Display Amount', 'my-text-domain' ),
      'description' => __( 'Default is four', 'my-text-domain' ),
      'param_name' => 'dis',
    ),
    array(
      'type' => 'textarea_html',
      'holder' => 'p',
      'heading' => __( 'Content', 'my-text-domain' ),
      'param_name' => 'content',
    ),
  )));
}