<?php
/*=============================================*/
/* Prevent TinyMCE from including unnecessary headings
/*=============================================*/
function my_format_TinyMCE( $in ) {
  $in['block_formats'] = "Heading=h3; Sub-Heading=h5; Paragraph=p;";
	return $in;
}
add_filter( 'tiny_mce_before_init', 'my_format_TinyMCE' );


/*=============================================*/
/* Hide admin bar on the front-end for all users
/*=============================================*/
add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
  show_admin_bar(false);
}

/*=============================================*/
/* Load custom CSS for WP dashboard
/*=============================================*/
function load_custom_wp_admin_style() {
  wp_register_style( 'custom_wp_admin_css', get_template_directory_uri() . '/dashboard/custom-style.css', false, '1.0.0' );
  wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action( 'login_head', 'load_custom_wp_admin_style' );
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );

/*=============================================*/
/* Change the login logo URL.
/* Default is wordpress.org.
/*=============================================*/
// Href attribute
add_filter( 'login_headerurl', 'my_login_logo_url' );
function my_login_logo_url() {
  return get_bloginfo( 'url' );
}
// Alt attribute
add_filter( 'login_headertitle', 'my_login_logo_url_title' );
function my_login_logo_url_title() {
  return 'Karawaci Presbyterian Church';
}

/*=============================================*/
/* Change the default error message
/* to something vague.
/*=============================================*/
add_filter('login_errors', 'login_error_override');
function login_error_override() {
  return 'Incorrect username/password combination';
}

/*=============================================*/
/* Check "Remember Me" by default
/*=============================================*/
add_action( 'init', 'login_checked_remember_me' );
function login_checked_remember_me() {
  add_filter( 'login_footer', 'rememberme_checked' );
}
function rememberme_checked() {
  echo "<script>document.getElementById('rememberme').checked = true;</script>";
}

/*=============================================*/
/* Remove Gravity Form wysiwyg button
/* and rely on ACF plugin
/*=============================================*/
add_filter( 'gform_display_add_form_button', '__return_false');
