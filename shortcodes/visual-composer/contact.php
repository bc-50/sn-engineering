<?php
function contact_func($atts, $content = null){
  $r = '';
  extract( shortcode_atts( array(
    'add' => null,
    'add_i' => null,
    'ph' => null,
    'ph_i' => null,
    'mail' => null,
    'mail_i' => null,
  ), $atts ) );
  $addsrc = wp_get_attachment_image_url($add_i);
  $phsrc = wp_get_attachment_image_url($ph_i);
  $mailsrc = wp_get_attachment_image_url($mail_i);
  $r ='
  
    <section class="contact-info">
      <div class="contact-row">
        <div class="image-wrapper">
          <img src="'. $addsrc .'" alt="Address Icon">
          </div>
          '. wpautop($add) .'
      </div>
      <div class="contact-row">
        <div class="image-wrapper">
          <img src="'. $phsrc .'" alt="Phone Icon">
          </div>
          <a href="'. str_replace(" ", "", $ph) .'">'. $ph .'</a>
      </div>
      <div class="contact-row">
        <div class="image-wrapper">
          <img src="'. $mailsrc .'" alt="Mail Icon">
          </div>
          <a href="mailto:'. $mail .'">'. $mail .'</a>
      </div>
    </section>
  ';
  return $r;
}
add_shortcode('contact', 'contact_func');
add_action('vc_before_init', 'contact_map');
function contact_map()
{
  vc_map(array(
    'name' => __('Contact Info', 'my-text-domain'),
    'base' => 'contact',
    'category' => __( 'Brace Elements', 'my-text-domain'),
    'icon' => get_template_directory_uri().'/shortcodes/visual-composer/vc-brace-icon.png',
    'params' => array(
    array(
      'type' => 'attach_image',
      'holder' => 'img',
      'heading' => __( 'Address Icon', 'my-text-domain' ),
      'param_name' => 'add_i',
    ),
    array(
      'type' => 'textarea',
      'holder' => 'p',
      'heading' => __( 'Address', 'my-text-domain' ),
      'param_name' => 'add',
    ),
    array(
      'type' => 'attach_image',
      'holder' => 'img',
      'heading' => __( 'Phone Icon', 'my-text-domain' ),
      'param_name' => 'ph_i',
    ),
    array(
      'type' => 'textfield',
      'holder' => 'p',
      'heading' => __( 'Phone', 'my-text-domain' ),
      'param_name' => 'ph',
    ),
    array(
      'type' => 'attach_image',
      'holder' => 'img',
      'heading' => __( 'Email Icon', 'my-text-domain' ),
      'param_name' => 'mail_i',
    ),
    array(
      'type' => 'textfield',
      'holder' => 'p',
      'heading' => __( 'Email', 'my-text-domain' ),
      'param_name' => 'mail',
    ),
  )));
}