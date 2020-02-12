<?php
require_once('inc/custom-post-types.php');
require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';

function theme_files()
{
  wp_deregister_script('jquery');
  wp_register_script('jquery', "https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js", false, null);
  wp_enqueue_script('jquery');

  wp_enqueue_script('Main-Scripts', get_theme_file_uri('js/scripts.min.js'));
  wp_enqueue_style('MyStyles', get_stylesheet_uri());
  wp_enqueue_style('Hamburger', get_theme_file_uri('lib/hamburgers.min.css'));
  wp_enqueue_script('BootstrapJS', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js', array('jquery'));
  wp_enqueue_style('Bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');
  wp_enqueue_style('FontAwes', 'https://use.fontawesome.com/releases/v5.7.2/css/all.css');

  /* fonts */
  wp_enqueue_style('Ubuntu', 'https://fonts.googleapis.com/css?family=Ubuntu:400,500,700&display=swap');
  wp_enqueue_style('Montserrat', 'https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap');
  
}

add_action('wp_enqueue_scripts', 'theme_files');

function all_sliders(){
  $slider = new WP_Query(array(
    'post_type' => 'slider',
  ));
  $args = array();
  
  foreach ($slider->posts as $single) {
    $name = ucwords(str_replace('-', ' ',$single->post_name));
    $args[$name] = $single->ID;
  }

  wp_reset_postdata();
  return $args;
}
/* Extra theme support */
function extra_theme_support()
{
  register_nav_menus(array(
    'primary' => __('Primary Menu')
  ));
  add_theme_support( 'title-tag' );
}

add_action('after_setup_theme', 'extra_theme_support');

add_theme_support( 'post-thumbnails' );


function include_myuploadscript() {
	/*
	 * I recommend to add additional conditions just to not to load the scipts on each page
	 * like:
	 * if ( !in_array('post-new.php','post.php') ) return;
	 */
	if ( ! did_action( 'wp_enqueue_media' ) ) {
		wp_enqueue_media();
  }
  wp_enqueue_style('MyStyles', get_stylesheet_directory_uri() . '/backend-styles/admin-main.min.css');
 
  wp_enqueue_script( 'myuploadscript', get_stylesheet_directory_uri() . '/js/backend-js/scripts.min.js', array('jquery'));
}
 
add_action( 'admin_enqueue_scripts', 'include_myuploadscript' );

function image_uploader_field( $name, $values = array()) {
  $image = ' button">Upload image';
  $image_size = 'full'; // it would be better to use thumbnail size here (150x150 or so)
  $display = 'none'; // display state ot the "Remove image" button
  $r = '<div class="gallery-wrapper">';
  if (!empty($values)) {
    foreach ($values[0] as $value) {
      if( $image_attributes = wp_get_attachment_image_src( $value, $image_size ) ) {
   
        // $image_attributes[0] - image URL
        // $image_attributes[1] - image width
        // $image_attributes[2] - image height
     
        $image = '<img src="' . $image_attributes[0] . '" style="max-width:95%;display:block;" />';
        $display = 'inline-block';
     
        $r .='
        <div class="admin-image-wrapper">
          '. $image .'
        </div>';
      } 
    }
  }
  $r .= '
          <div class="upload">Upload Image</div>
          </div>
        <a href="#" style="display: none;" class="remove_image_button">Remove All</a>';
  return $r;
}

add_action('init', 'brace_autoload_shortcodes', 1);
function brace_autoload_shortcodes(){
    $dir = get_stylesheet_directory() . '/shortcodes/visual-composer';
    $pattern = $dir . '/*.php';
    
    $files = glob($pattern);
    foreach($files as $file){
        $parts = pathinfo($file);
        $name = $parts['filename'];
        
        require_once($file);        
    }
  }


