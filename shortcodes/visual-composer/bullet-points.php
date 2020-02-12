<?php
function points_func($atts, $content = null){
  $r = '';
  extract( shortcode_atts( array(
    'title' => null,
  ), $atts ) );
  $r ='
    <div class="bullet-points">
      '. $content .'
    </div>
  
  ';
  return $r;
}
add_shortcode('points', 'points_func');
add_action('vc_before_init', 'points_map');
function points_map()
{
  vc_map(array(
    'name' => __('SN Points', 'my-text-domain'),
    'base' => 'points',
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
      'type' => 'textarea_html',
      'holder' => 'p',
      'heading' => __( 'Content', 'my-text-domain' ),
      'param_name' => 'content',
    ),
  )));
}