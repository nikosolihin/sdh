<?php

//=============================================
// Options Page
//=============================================

// Site Settings //////////////////////////////
if( function_exists('acf_add_options_page') ) {

	// Essentials //////////////////////////////
	acf_add_options_page(array(
		'page_title' 	=> 'Important Services & Server Details',
		'menu_title'	=> 'Essentials',
		'menu_slug' 	=> 'essentials',
		'position' 		=> '99',
		'icon_url' 		=> 'dashicons-admin-network'
		'redirect'		=> false  // Redirect to first sub opt page
	));
}

//=============================================
// Only list parent pages for the "global_menu"
// relationship field type
//=============================================
function my_relationship_query( $args, $field, $post_id ) {
  $args['post_parent'] = 0;
  return $args;
}
// add_filter('acf/fields/relationship/query/name=global_menu', 'my_relationship_query', 10, 3);

//=============================================
// Hide from client
//=============================================
// add_filter('acf/settings/show_admin', '__return_false');
