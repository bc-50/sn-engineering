<?php 
function plain_content_func($atts, $content = null){
  $r = '';
  extract( shortcode_atts( array(
    'img' => null,
  ), $atts ) );

  $imgsrc = wp_get_attachment_image_url($img, 'full');
  ob_start(); ?>

  <section class="plain-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-8">
          <div class="content-wrapper">
            <?php echo wpautop($content); ?>
          </div>
        </div>
        <div class="col-xl-4 image" style="background-image: url(<?php echo $imgsrc ?>)"></div>
      </div>
    </div>
  </section>

  <?php 
  $r = ob_get_clean();
  return $r;
}
add_shortcode('plain_content', 'plain_content_func');
add_action('vc_before_init', 'plain_content_map');
function plain_content_map()
{
  vc_map(array(
    'name' => __('Plain Content', 'my-text-domain'),
    'base' => 'plain_content',
    'category' => __( 'Brace Elements', 'my-text-domain'),
    'icon' => get_template_directory_uri().'/shortcodes/visual-composer/vc-brace-icon.png',
    'params' => array(
    array(
      'type' => 'attach_image',
      'holder' => 'img',
      'heading' => __( 'Image', 'my-text-domain' ),
      'param_name' => 'img',
    ),
    array(
      'type' => 'textarea_html',
      'holder' => 'p',
      'heading' => __( 'Content', 'my-text-domain' ),
      'param_name' => 'content',
    ),
  )));
}