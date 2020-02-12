<?php
function color_cont_func($atts, $content = null){
  $r = '';
  extract( shortcode_atts( array(
    'title' => null,
    'img' => null,
    'col' => null,
  ), $atts ) );

  $imgsrc = wp_get_attachment_image_url( $img, 'full');
  $r ='
    <div class="container-fluid color-content">
      <div class="row">
        <div class="col-lg-5 gen-bg" style="background-image: url('. $imgsrc .')"></div>
        <div class="col-lg-7" style="background: '. $col .'">
          <div class="inner-wrapper">
            <div class="title-wrapper">
              <h3>'. $title.'</h3>
            </div>
            <div class="content-wrapper">
              '. wpautop($content) .'
            </div>
          </div>
        </div>
      </div>
    </div>
  
  ';
  return $r;
}
add_shortcode('color_cont', 'color_cont_func');
add_action('vc_before_init', 'color_cont_map');
function color_cont_map()
{
  vc_map(array(
    'name' => __('Colour Content', 'my-text-domain'),
    'base' => 'color_cont',
    'category' => __( 'Brace Elements', 'my-text-domain'),
    'icon' => get_template_directory_uri().'/shortcodes/visual-composer/vc-brace-icon.png',
    'params' => array(
    array(
      'type' => 'textfield',
      'holder' => 'p',
      'heading' => __( 'Title', 'my-text-domain' ),
      'param_name' => 'title',
    ),
    array(
      'type' => 'attach_image',
      'holder' => 'img',
      'heading' => __( 'Image', 'my-text-domain' ),
      'param_name' => 'img',
    ),
    array(
      'type' => 'colorpicker',
      'heading' => __( 'Background Colour', 'my-text-domain' ),
      'param_name' => 'col',
    ),
    array(
      'type' => 'textarea_html',
      'holder' => 'p',
      'heading' => __( 'Content', 'my-text-domain' ),
      'param_name' => 'content',
    ),
  )));
}