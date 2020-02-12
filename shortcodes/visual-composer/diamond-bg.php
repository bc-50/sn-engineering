<?php
function diamond_background_func($atts, $content = null){
  $r = '';
  extract( shortcode_atts( array(
    'css' => null,
  ), $atts ) );
  $img_src = wp_get_attachment_image_url($img, 'full');
  $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'diamond_background', $atts );
  $r='
  <div class="custom-diamond-background '. esc_attr( $css_class ) .'">
    '. do_shortcode($content) .'
  </div>
  ';
  return $r;
}
add_shortcode('diamond_background', 'diamond_background_func');
add_action('vc_before_init', 'diamond_background_map');
function diamond_background_map()
{
  vc_map(array(
    'name' => __('Diamond Background', 'my-text-domain'),
    'base' => 'diamond_background',
    /* "as_parent" => array('only' => 'plain_content'), */
    "content_element" => true,
    "show_settings_on_create" => true,
    "is_container" => true,
    "js_view"                 => 'VcColumnView',
    'category' => __( 'Brace Elements', 'my-text-domain'),
    'icon' => get_template_directory_uri().'/shortcodes/visual-composer/vc-brace-icon.png',
    'params' => array(
    array(
      'type' => 'css_editor',
      'heading' => __( 'Css', 'my-text-domain' ),
      'param_name' => 'css',
      'group' => __( 'Design options', 'my-text-domain' ),
      ),
  )));


  if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_diamond_background extends WPBakeryShortCodesContainer {
    }
  }

}