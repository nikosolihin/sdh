<?php
/*
 **************************
 * Custom Theme Functions *
 **************************
 *
 * Namespaced "tsk" - find and replace with your own three-letter-thing.
 *
 */

// Enqueue scripts
function tsk_scripts() {

  // Use jQuery from CDN, enqueue in footer
  if (!is_admin()) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js', array(), null, true);
    wp_enqueue_script('jquery');
  }

  // Enqueue stylesheet and scripts. Use minified for production.
  // NOTE: will need to change this to get_stylesheet_directory_uri() to allow for child themes later.
  if( WP_ENV == 'production' ) {
    wp_enqueue_style( 'tsk-styles', get_stylesheet_directory_uri() . '/assets/css/build/main.min.css', 1.0);
    wp_enqueue_script( 'tsk-js', get_stylesheet_directory_uri() . '/assets/js/build/scripts.min.js', array('jquery'), '1.0.0', true );
  } else {
    wp_enqueue_style( 'tsk-styles', get_stylesheet_directory_uri() . '/assets/css/main.css', 1.0);
    wp_enqueue_script( 'tsk-js', get_stylesheet_directory_uri() . '/assets/js/build/scripts.js', array('jquery'), '1.0.0', true );
  }

}
add_action( 'wp_enqueue_scripts', 'tsk_scripts' );


/*
 *
 * Nice to Haves
 *
 */

// Change Title field placeholders for Custom Post Types
// (You'll need to register the types, of course)

function tsk_title_placeholder_text ( $title ) {
  if ( get_post_type() == 'service' ) {
    $title = __( 'Service Name' );
  } else if ( get_post_type() == 'cast-study' ) {
        $title = __( 'Case Study Name' );
  } else if ( get_post_type() == 'testimonial' ) {
        $title = __( 'Testimonial Nickname' );
  }
  return $title;
}
// add_filter( 'enter_title_here', 'tsk_title_placeholder_text' );
