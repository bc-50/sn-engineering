<?php

/* function testimonial_post_type_func() {
  // Testimonial Post Type
  register_post_type('Testimonial', array(
    //Most of the visual stuff in labels array
      'labels' => array(
        'name' => 'Testimonials',
        'add_new_item' => 'Add New Testimonial',
        'edit_item' => 'Edit Testimonials',
        'all_items' => 'All Testimonials',
        'singular_name' => 'Testimonial'
      ),
      'supports' => array('title', 'editor', 'excerpt'),
      'public' => true,
      'menu_icon' => 'dashicons-format-quote',
      'has_archive' => false,
      'map_meta_cap' => true        //wordpress applies role permission when needed
    ));
  }
  
  add_action( 'init', 'testimonial_post_type_func' ); */

  define('MY_POST_TYPE', 'slider');
define('MY_POST_SLUG', 'slider');

function slider_post_type_func() {
  // Slider Post Type
  register_post_type(MY_POST_TYPE, array(
    //Most of the visual stuff in labels array
      'labels' => array(
        'name' => 'Sliders',
        'add_new_item' => 'Add New Slider',
        'edit_item' => 'Edit Sliders',
        'all_items' => 'All Sliders',
        'singular_name' => 'Slider'
      ),
      'supports' => array('title', 'excerpt'),
      'register_meta_box_cb' => 'my_meta_box_cb',
      'public' => true,
      'menu_icon' => 'dashicons-images-alt2',
      'has_archive' => true,
      'map_meta_cap' => true,        //wordpress applies role permission when needed
      'query_var' => true,
      'show_in_rest' => true
    ));
  }

  add_action( 'init', 'slider_post_type_func' );

  function my_meta_box_cb () {
    add_meta_box( 'slider_images' , 'Media Library', 'my_meta_box_images', MY_POST_TYPE, 'normal', 'high' );
  
  }
  
  function my_meta_box_images () {
    global $post;
    $meta_key = 'slider_images';
    echo image_uploader_field( $meta_key, get_post_meta($post->ID, $meta_key) );
  }

  function myplugin_save_postdata( $id ) {
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
    return $id;
    global $post;
    $meta_key = 'slider_images';
   
    
    $count = 1;
   if (isset($post) && !empty($_POST['slider_images'])) {
    if ('' !== get_post_meta($post->ID, $meta_key)) {
      $metas = explode(',',$_POST['slider_images']);
      update_post_meta( $id, $meta_key, $metas);
    }
   }
  
  // if you would like to attach the uploaded image to this post, uncomment the line:
  // wp_update_post( array( 'ID' => $_POST[$meta_key], 'post_parent' => $post_id ) );
  
  return $id;
  }
  
  add_action('save_post', 'myplugin_save_postdata');