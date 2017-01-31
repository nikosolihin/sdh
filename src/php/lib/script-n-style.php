<?php
// //=============================================
// // Register dashboard style
// //=============================================
// function saat_admin_styles() {
// 	wp_deregister_style( 'saat-admin-style' );
// 	wp_register_style( 'saat-admin-style', get_template_directory_uri() . '/dashboard/custom-style.css', false, '1.0.0' );
// 	wp_enqueue_style( 'saat-admin-style' );
// }
// add_action( 'login_head', 'saat_admin_styles' ); // For login logo
// add_action( 'admin_enqueue_scripts', 'saat_admin_styles' );

//=============================================
// Register dashboard script
//=============================================
function sdh_admin_scripts() {
	wp_deregister_script( 'sdh-admin-script' );
	wp_register_script( 'sdh-admin-script', get_template_directory_uri() . '/dashboard/custom-script.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'sdh-admin-script' );
}
add_action( 'admin_enqueue_scripts', 'sdh_admin_scripts' );
