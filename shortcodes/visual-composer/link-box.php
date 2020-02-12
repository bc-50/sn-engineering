<?php
function link_box_func($atts, $content = null){
  $r = '';
  extract( shortcode_atts( array(
    'pgroup' => null,
    
  ), $atts ) );
  $rows = vc_param_group_parse_atts( $atts['pgroup'] );

  ob_start();
  ?>
    <div class="container-fluid no-gutters link-box">
      <div class="row">
        <?php foreach ($rows as $row) {
            $row['link'] = ($row['link']=='||') ? '' : $row['link'];
            $row['link'] = vc_build_link( $row['link'] );
            $a_link = $row['link']['url'];
            $a_title = ($row['link']['title'] == '') ? '' : 'title="'.$row['link']['title'].'"';
            $a_target = ($row['link']['target'] == '') ? '' : 'target="'.$row['link']['target'].'"';
            $imgsrc = wp_get_attachment_image_url( $row['img'], 'full');
          ?>
          <div class="col-xl-3 col-lg-4 col-md-6 box-column">
            <a href="<?php echo $a_link ?>" class="link-box" style="background-image: url(<?php echo $imgsrc ?>)">
              <div class="overlay"></div>
              <div class="inner-box">
                <h3><?php echo  $row['title'] ?></h3>
                <img src="<?php echo get_theme_file_uri('img/arrow.png') ?>" alt="Next Arrow">
              </div>
            </a>
          </div>
        <?php } ?>
      </div>
    </div>

  <?php
  $r = ob_get_clean();
  return $r;
}
add_shortcode('link_box', 'link_box_func');
add_action('vc_before_init', 'link_box_map');
function link_box_map()
{
  vc_map(array(
    'name' => __('Link Boxes', 'my-text-domain'),
    'base' => 'link_box',
    'category' => __( 'Brace Elements', 'my-text-domain'),
    'icon' => get_template_directory_uri().'/shortcodes/visual-composer/vc-brace-icon.png',
    'params' => array(
    array(
      'type' => 'param_group',
      'heading' => __( 'Boxes', 'my-text-domain' ),
      'param_name' => 'pgroup',
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
          'type' => 'vc_link',
          'heading' => __( 'Link', 'my-text-domain' ),
          'param_name' => 'link',
        ),
      )
    ),
  )));
}