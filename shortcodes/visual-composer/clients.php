<?php
function clients_func($atts, $content = null){
  $r = '';
  extract( shortcode_atts( array(
    'slides' => null,
  ), $atts ) );
  ob_start(); 
  $imgIds = get_post_meta($slides,'slider_images')[0];
  $numIds = count($imgIds);
  $divFour = true;
  if ($numIds % 4 == 0) {
    $s_count = $numIds/4;
  }else{
    $s_count = ceil($numIds/4);
    $divFour = false;
  }
  var_dump($s_count);
  $first = true;
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
          <div id="clients" class="carousel slide" <?php echo $numIds > 4 ? 'data-ride="carousel"' : '' ?>>
            <div class="carousel-inner">
              <?php for ($i=1; $i <= $s_count ; $i++) {  ?>
                <?php 
                  if (!$divFour && $s_count == $i) {
                    $end = $numIds - 1;
                  } else {
                    $end = ($i*4 - 1);
                  }  
                ?>
                <div class="carousel-item<?php echo $first ? ' active' : '' ?>">
                  <div class="inner-wrapper">
                    <?php for ($j = ($i*4 - 4); $j <= $end ; $j++) {  ?>
                      <div class="image-wrapper" style="background-image: url(<?php echo wp_get_attachment_image_url($imgIds[$j], 'full') ?>)">
                        <!-- <?php echo wp_get_attachment_image($imgIds[$j], 'medium'); ?> -->
                      </div>
                    <?php } ?>
                  </div>
                </div>
              <?php $first = false; } ?>
            </div>
            <?php if ($numIds > 4) { ?>
              <a class="carousel-control-prev" href="#clients" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true" style="background-image: url(<?php echo get_theme_file_uri('img/prev.png') ?>)"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#clients" role="button" data-slide="next">
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
add_shortcode('clients', 'clients_func');
add_action('vc_before_init', 'clients_map');
function clients_map()
{
  vc_map(array(
    'name' => __('Clients', 'my-text-domain'),
    'base' => 'clients',
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
      'type' => 'textarea_html',
      'holder' => 'p',
      'heading' => __( 'Content', 'my-text-domain' ),
      'param_name' => 'content',
    ),
  )));
}