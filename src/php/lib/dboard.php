<?php
/*=============================================*/
/* Show favicon in the dashboard
/*=============================================*/
add_action('admin_head', 'show_favicon');
function show_favicon() {
  echo '<link href="FAVICON IMAGE URL" rel="icon" type="image/x-icon">';
  echo '<link rel="icon" type="image/png" href="https://sdh.or.id/wp-content/themes/sdh/favicon-32x32.png?v=bOv5Xbx3PO" sizes="32x32">';
  echo '<link rel="icon" type="image/png" href="https://sdh.or.id/wp-content/themes/sdh/favicon-16x16.png?v=bOv5Xbx3PO" sizes="16x16">';
}

/*=============================================*/
/* Remove nag from acf plugins
/*=============================================*/
add_filter('remove_hube2_nag', '__return_true');

/*=============================================*/
/* Change medium editor theme
/*=============================================*/
add_filter('medium-editor-theme', 'my_medium_editor_theme_function');
function my_medium_editor_theme_function($theme) {
  $theme = 'beagle';
  return $theme;
}

/*=============================================*/
/* Hide admin bar on the front-end for all users
/*=============================================*/
add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
  show_admin_bar(false);
}

/*=============================================*/
/* Remove meta boxes in the Dashboard landing page
/*=============================================*/
function remove_dashboard_widgets () {
  remove_meta_box('dashboard_quick_press','dashboard','side'); //Quick Press widget
  remove_meta_box('dashboard_recent_drafts','dashboard','side'); //Recent Drafts
  remove_meta_box('dashboard_primary','dashboard','side'); //WordPress.com Blog
  remove_meta_box('dashboard_secondary','dashboard','side'); //Other WordPress News
  remove_meta_box('dashboard_incoming_links','dashboard','normal'); //Incoming Links
  remove_meta_box('dashboard_plugins','dashboard','normal'); //Plugins
  remove_meta_box('dashboard_right_now','dashboard', 'normal'); //Right Now
  remove_meta_box('rg_forms_dashboard','dashboard','normal'); //Gravity Forms
  remove_meta_box('dashboard_recent_comments','dashboard','normal'); //Recent Comments
  remove_meta_box('icl_dashboard_widget','dashboard','normal'); //Multi Language Plugin
  remove_meta_box('dashboard_activity','dashboard', 'normal'); //Activity
  remove_action('welcome_panel','wp_welcome_panel');
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets');

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
  return 'Sekolah Dian Harapan';
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
/* Disable Wordpress Update Notification
/*=============================================*/
add_action('after_setup_theme','remove_core_updates');
function remove_core_updates() {
  if(! current_user_can('update_core')){return;}
  add_action('init', create_function('$a',"remove_action( 'init', 'wp_version_check' );"),2);
  add_filter('pre_option_update_core','__return_null');
  add_filter('pre_site_transient_update_core','__return_null');
}

/*=============================================*/
/* Disable Plugin Update Notifications
/*=============================================*/
remove_action('load-update-core.php','wp_update_plugins');
add_filter('pre_site_transient_update_plugins','__return_null');

/*=============================================*/
/* Disable Other Misc Notifications
/*=============================================*/
function remove_other_updates(){
  global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
}
add_filter('pre_site_transient_update_core','remove_other_updates');
add_filter('pre_site_transient_update_plugins','remove_other_updates');
add_filter('pre_site_transient_update_themes','remove_other_updates');

/*=============================================*/
/* Hide thanks for creating with Wordpress in footer
/*=============================================*/
function wpse_edit_footer() {
  add_filter( 'admin_footer_text', 'wpse_edit_text', 11 );
}
function wpse_edit_text($content) {
  return "";
}
add_action( 'admin_init', 'wpse_edit_footer' );

/*=============================================*/
/* Hide Wordpress version in footer
/*=============================================*/
function my_footer_shh() {
  remove_filter( 'update_footer', 'core_update_footer' );
}
add_action( 'admin_menu', 'my_footer_shh' );

/*=============================================*/
/* Increase `timeout` for `api.wordpress.org` requests
/*=============================================*/
add_filter( 'http_request_args', function( $request, $url ) {
  if ( strpos( $url, '://api.wordpress.org/' ) !== false ) {
    $request[ 'timeout' ] = 15;
  }
  return $request;
}, 10, 2 );

/*=============================================*/
/* Removing an erroneous upgrade notice
/* when upgrade are managed through SVN
/* https://codex.wordpress.org/Installing/Updating_WordPress_with_Subversion
/*=============================================*/
add_action( 'admin_menu', function() {
  remove_action( 'admin_notices', 'update_nag', 3 );
});
