<?php
function special_design_func($atts, $content = null){
  $r = '';
  extract( shortcode_atts( array(
    'title' => null,
    'link' => null,
    'img' => null,
  ), $atts ) );

  $link = ($link=='||') ? '' : $link;
  $link = vc_build_link( $link );
  $a_link = $link['url'];
  $a_title = ($link['title'] == '') ? '' : 'title="'.$link['title'].'"';
  $a_target = ($link['target'] == '') ? '' : 'target="'.$link['target'].'"';

  $imgsrc = wp_get_attachment_image_url($img, 'full');

  ob_start(); ?>
  <section class="special-design">
    <p><?php echo $title ?></p>
    <div class="design-image" style="background-image: url(<?php echo $imgsrc ?>)">
      <div class="case-study<?php echo !empty($a_link) ? '' : ' no-link' ?>">
          <a href="<?php echo !empty($a_link) ? $a_link : '#' ?>">Case Studies</a>
      </div>
    </div>
  </section>

  <?php
  $r = ob_get_clean();
  return $r;
}
add_shortcode('special_design', 'special_design_func');
add_action('vc_before_init', 'special_design_map');
function special_design_map()
{
  vc_map(array(
    'name' => __('Special Design Box', 'my-text-domain'),
    'base' => 'special_design',
    'category' => __( 'Brace Elements', 'my-text-domain'),
    'icon' => get_template_directory_uri().'/shortcodes/visual-composer/vc-brace-icon.png',
    'params' => array(
      array(
        'type' => 'textfield',
        'heading' => __( 'Title', 'my-text-domain' ),
        'param_name' => 'title',
      ),
      array(
        'type' => 'attach_image',
        'heading' => __( 'Image', 'my-text-domain' ),
        'param_name' => 'img',
      ),
      array(
        'type' => 'vc_link',
        'heading' => __( 'Case Study Link', 'my-text-domain' ),
        'param_name' => 'link',
      ),
  )));
}