<?php
function image_content_func($atts, $content = null){
  $r = '';
  extract( shortcode_atts( array(
    'title' => null,
    'ipos' => 'right',
    'link' => null,
    'img' => null,
    'wid' => null,
    'under' => 'no',
  ), $atts ) );
  $tposition = 8;
  $imgsrc = wp_get_attachment_image_url($img, 'full');
  $link = ($link=='||') ? '' : $link;
  $link = vc_build_link( $link );
  $a_link = $link['url'];
  $a_title = ($link['title'] == '') ? '' : 'title="'.$link['title'].'"';
  $a_target = ($link['target'] == '') ? '' : 'target="'.$link['target'].'"';
  if ($ipos == 'left') {
    $tposition = 7;
  }
  ob_start() ?>

    <section class="main-content<?php echo ' ' . $under ?>">
      <div class="mob-bg" style="background-image: url(<?php echo $imgsrc ?>)"></div>
      <div class="container-fluid">
        <div class="row <?php echo $ipos ?>">
          <div class="col-xl-<?php echo $tposition ?> content-column">
            <div class="col-wrapper" style="max-width: <?php echo is_numeric($wid) ? $wid : '730' ?>px">
              <div class="title-wrapper">
                <h2><?php echo $title;?></h2>
              </div>
              <div class="content-wrapper">
                <?php echo wpautop($content)  ?>
              </div>
            </div>
          </div>
          <div class="col-xl-4 p-0 img-column">
            <div class="image-wrapper" style="background-image: url(<?php echo $imgsrc ?>)">
              <?php if (empty($img)) { ?>
                <h3>Image Needed</h3>
              <?php } ?>
              <?php if (!empty($a_link)) { ?>
                <div class="case-study">
                  <a href="<?php echo $a_link ?>">Case Studies</a>
                </div>
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
add_shortcode('image_content', 'image_content_func');
add_action('vc_before_init', 'image_content_map');
function image_content_map()
{
  vc_map(array(
    'name' => __('Main Layout', 'my-text-domain'),
    'base' => 'image_content',
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
      'heading' => __( 'Underline Title?', 'my-text-domain' ),
      'param_name' => 'under',
      'value' => array(
        'No' => 'no',
        'Yes' => 'underline',
      ),
    ),
    array(
      'type' => 'dropdown',
      'heading' => __( 'Image Position', 'my-text-domain' ),
      'param_name' => 'ipos',
      'value' => array(
        'Right' => 'right',
        'Left' => 'left',
      ),
    ),
    array(
      'type' => 'vc_link',
      'heading' => __( 'Case Study Link', 'my-text-domain' ),
      'param_name' => 'link',
    ),
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
    array(
      'type' => 'textfield',
      'holder' => 'p',
      'heading' => __( 'Content Max Width', 'my-text-domain' ),
      'description' => __( 'Note: Exclude "px"', 'my-text-domain' ),
      'param_name' => 'wid',
    ),
  )));
}