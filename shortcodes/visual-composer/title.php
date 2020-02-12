<?php 
function title_func($atts, $content = null){
  $r = '';
  extract( shortcode_atts( array(
    'title' => null,
    'pos' => 'left',
  ), $atts ) );
  $r ='
    <div class="text-'. $pos .'">
      <h2 class="gen-title '. $pos .'">'. $title .'</h2>
    </div>
  ';
  return $r;
}
add_shortcode('title', 'title_func');
add_action('vc_before_init', 'title_map');
function title_map()
{
  vc_map(array(
    'name' => __('Underline Title', 'my-text-domain'),
    'base' => 'title',
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
      'type' => 'dropdown',
      'holder' => 'p',
      'heading' => __( 'Position', 'my-text-domain' ),
      'value' => array(
        'Left' => 'left',
        'Center' => 'center',
        'Right' => 'right',
      ),
      'param_name' => 'pos',
    ),
  )));
}