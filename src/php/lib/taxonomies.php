<?php
/**
 * Register Event Category Taxonomy
 */
// function event_category_taxonomy() {
// 	$labels = array(
// 		'name'                       => _x( 'Event Categories', 'Taxonomy General Name', 'text_domain' ),
// 		'singular_name'              => _x( 'Event Category', 'Taxonomy Singular Name', 'text_domain' ),
// 		'menu_name'                  => __( 'Categories', 'text_domain' ),
// 		'all_items'                  => __( 'All Categories', 'text_domain' ),
// 		'parent_item'                => __( 'Parent Category', 'text_domain' ),
// 		'parent_item_colon'          => __( 'Parent Category:', 'text_domain' ),
// 		'new_item_name'              => __( 'New Category Name', 'text_domain' ),
// 		'add_new_item'               => __( 'Add New Category', 'text_domain' ),
// 		'edit_item'                  => __( 'Edit Category', 'text_domain' ),
// 		'update_item'                => __( 'Update Category', 'text_domain' ),
// 		'view_item'                  => __( 'View Category', 'text_domain' ),
// 		'separate_items_with_commas' => __( 'Separate categories with commas', 'text_domain' ),
// 		'add_or_remove_items'        => __( 'Add or remove categories', 'text_domain' ),
// 		'choose_from_most_used'      => __( 'Choose from the most used categories', 'text_domain' ),
// 		'popular_items'              => __( 'Popular Categories', 'text_domain' ),
// 		'search_items'               => __( 'Search categories', 'text_domain' ),
// 		'not_found'                  => __( 'Not Found', 'text_domain' ),
// 		'no_terms'                   => __( 'No items', 'text_domain' ),
// 		'items_list'                 => __( 'Items list', 'text_domain' ),
// 		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
// 	);
// 	$rewrite = array(
// 		'slug'                       => 'events/?utf8=✓&page=1&categories=',
// 		'with_front'                 => true,
// 		'hierarchical'               => false,
// 	);
// 	$args = array(
// 		'labels'                     => $labels,
// 		'hierarchical'               => true,
// 		'public'                     => true,
// 		'show_ui'                    => true,
// 		'show_admin_column'          => true,
// 		'show_in_nav_menus'          => true,
// 		'show_tagcloud'              => false,
// 		'rewrite'                    => $rewrite,
//     'show_in_rest'               => true,
//     'rest_base'                  => 'categories',
//     'rest_controller_class'      => 'WP_REST_Terms_Controller',
// 	);
// 	register_taxonomy( 'event_category', array( 'event' ), $args );
// }
// add_action( 'init', 'event_category_taxonomy', 0 );

/**
 * Register News Topic Taxonomy
 */
function campus_taxonomy() {
	$labels = array(
		'name'                       => _x( 'Campuses', 'Taxonomy General Name', 'sdh' ),
		'singular_name'              => _x( 'Campus', 'Taxonomy Singular Name', 'sdh' ),
		'menu_name'                  => __( 'Campuses', 'sdh' ),
		'all_items'                  => __( 'All Campuses', 'sdh' ),
		'parent_item'                => __( 'Parent Campus', 'sdh' ),
		'parent_item_colon'          => __( 'Parent Campus:', 'sdh' ),
		'new_item_name'              => __( 'New Campus Name', 'sdh' ),
		'add_new_item'               => __( 'Add New Campus', 'sdh' ),
		'edit_item'                  => __( 'Edit Campus', 'sdh' ),
		'update_item'                => __( 'Update Campus', 'sdh' ),
		'view_item'                  => __( 'View Campus', 'sdh' ),
		'separate_items_with_commas' => __( 'Separate categories with commas', 'sdh' ),
		'add_or_remove_items'        => __( 'Add or remove campuses', 'sdh' ),
		'choose_from_most_used'      => __( 'Choose from the most used campuses', 'sdh' ),
		'popular_items'              => __( 'Popular Campuses', 'sdh' ),
		'search_items'               => __( 'Search campuses', 'sdh' ),
		'not_found'                  => __( 'Not Found', 'sdh' ),
		'no_terms'                   => __( 'No items', 'sdh' ),
		'items_list'                 => __( 'Items list', 'sdh' ),
		'items_list_navigation'      => __( 'Items list navigation', 'sdh' ),
	);
	$rewrite = array(
		// 'slug'                       => 'campus',
		// 'slug'                       => 'news/?utf8=✓&date=desc&page=1&campus=',
		'with_front'                 => false,
		'hierarchical'               => false,
	);
	$caps = array(
    // allow anyone editing posts to assign terms
    'assign_terms' => 'edit_campuses',
    // but you probably don't want anyone except
    // admins messing with what gets auto-generated!
    'edit_terms' => 'administrator'
  );
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'show_ui'                    => true,
		'show_admin_column'          => false,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		// 'rewrite'                    => $rewrite,

		'rewrite'                   => false,
		'query_var'									=> true, // must be true if doing filter[xxx] api call
		'publicly_queryable'				=> true, // must be true if doing filter[xxx] api call
		'public'                    => false,

    'capabilities'               => $caps,
		'show_in_rest'               => true,
		'rest_base'                  => 'campus',
		'rest_controller_class'      => 'WP_REST_Terms_Controller',
	);
	register_taxonomy( 'campus', array( 'news' ), $args );
}
add_action( 'init', 'campus_taxonomy', 0 );


// /**
//  * Register Media Type Taxonomy
//  */
// function media_type_taxonomy() {
// 	$labels = array(
// 		'name'                       => _x( 'Media Type', 'Taxonomy General Name', 'text_domain' ),
// 		'singular_name'              => _x( 'Media Type', 'Taxonomy Singular Name', 'text_domain' ),
// 		'menu_name'                  => __( 'Types', 'text_domain' ),
// 		'all_items'                  => __( 'All Types', 'text_domain' ),
// 		'parent_item'                => __( 'Parent Type', 'text_domain' ),
// 		'parent_item_colon'          => __( 'Parent Type:', 'text_domain' ),
// 		'new_item_name'              => __( 'New Type Name', 'text_domain' ),
// 		'add_new_item'               => __( 'Add New Type', 'text_domain' ),
// 		'edit_item'                  => __( 'Edit Type', 'text_domain' ),
// 		'update_item'                => __( 'Update Type', 'text_domain' ),
// 		'view_item'                  => __( 'View Type', 'text_domain' ),
// 		'separate_items_with_commas' => __( 'Separate types with commas', 'text_domain' ),
// 		'add_or_remove_items'        => __( 'Add or remove types', 'text_domain' ),
// 		'choose_from_most_used'      => __( 'Choose from the most used types', 'text_domain' ),
// 		'popular_items'              => __( 'Popular Types', 'text_domain' ),
// 		'search_items'               => __( 'Search types', 'text_domain' ),
// 		'not_found'                  => __( 'Not Found', 'text_domain' ),
// 		'no_terms'                   => __( 'No items', 'text_domain' ),
// 		'items_list'                 => __( 'Items list', 'text_domain' ),
// 		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
// 	);
// 	$rewrite = array(
// 		'slug'                       => 'media/?utf8=✓&page=1&types=',
// 		'with_front'                 => true,
// 		'hierarchical'               => false,
// 	);
// 	$args = array(
// 		'labels'                     => $labels,
// 		'hierarchical'               => false,
// 		'public'                     => true,
// 		'show_ui'                    => true,
// 		'show_admin_column'          => true,
// 		'show_in_nav_menus'          => true,
// 		'show_tagcloud'              => false,
// 		'rewrite'                    => $rewrite,
//     'show_in_rest'               => true,
//     'rest_base'                  => 'type',
//     'rest_controller_class'      => 'WP_REST_Terms_Controller',
// 	);
// 	register_taxonomy( 'media_type', array( 'resource' ), $args );
// }
// add_action( 'init', 'media_type_taxonomy', 0 );
//
//
// /**
//  * Register Media Category Taxonomy
//  */
// function media_category_taxonomy() {
// 	$labels = array(
// 		'name'                       => _x( 'Media Categories', 'Taxonomy General Name', 'text_domain' ),
// 		'singular_name'              => _x( 'Media Category', 'Taxonomy Singular Name', 'text_domain' ),
// 		'menu_name'                  => __( 'Categories', 'text_domain' ),
// 		'all_items'                  => __( 'All Categories', 'text_domain' ),
// 		'parent_item'                => __( 'Parent Category', 'text_domain' ),
// 		'parent_item_colon'          => __( 'Parent Category:', 'text_domain' ),
// 		'new_item_name'              => __( 'New Category Name', 'text_domain' ),
// 		'add_new_item'               => __( 'Add New Category', 'text_domain' ),
// 		'edit_item'                  => __( 'Edit Category', 'text_domain' ),
// 		'update_item'                => __( 'Update Category', 'text_domain' ),
// 		'view_item'                  => __( 'View Category', 'text_domain' ),
// 		'separate_items_with_commas' => __( 'Separate categories with commas', 'text_domain' ),
// 		'add_or_remove_items'        => __( 'Add or remove categories', 'text_domain' ),
// 		'choose_from_most_used'      => __( 'Choose from the most used categories', 'text_domain' ),
// 		'popular_items'              => __( 'Popular Categories', 'text_domain' ),
// 		'search_items'               => __( 'Search categories', 'text_domain' ),
// 		'not_found'                  => __( 'Not Found', 'text_domain' ),
// 		'no_terms'                   => __( 'No items', 'text_domain' ),
// 		'items_list'                 => __( 'Items list', 'text_domain' ),
// 		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
// 	);
// 	$rewrite = array(
// 		'slug'                       => 'media/?utf8=✓&page=1&category=',
// 		'with_front'                 => true,
// 		'hierarchical'               => false,
// 	);
// 	$args = array(
// 		'labels'                     => $labels,
// 		'hierarchical'               => false,
// 		'public'                     => true,
// 		'show_ui'                    => true,
// 		'show_admin_column'          => true,
// 		'show_in_nav_menus'          => true,
// 		'show_tagcloud'              => false,
// 		'rewrite'                    => $rewrite,
//     'show_in_rest'               => true,
//     'rest_base'                  => 'category',
//     'rest_controller_class'      => 'WP_REST_Terms_Controller',
// 	);
// 	register_taxonomy( 'media_category', array( 'resource' ), $args );
// }
// add_action( 'init', 'media_category_taxonomy', 0 );
//
//
// /**
//  * Register Role Taxonomy
//  */
// function role_taxonomy() {
// 	$labels = array(
// 		'name'                       => _x( 'Roles', 'Taxonomy General Name', 'text_domain' ),
// 		'singular_name'              => _x( 'Role', 'Taxonomy Singular Name', 'text_domain' ),
// 		'menu_name'                  => __( 'Roles', 'text_domain' ),
// 		'all_items'                  => __( 'All Roles', 'text_domain' ),
// 		'parent_item'                => __( 'Parent Role', 'text_domain' ),
// 		'parent_item_colon'          => __( 'Parent Role:', 'text_domain' ),
// 		'new_item_name'              => __( 'New Role Name', 'text_domain' ),
// 		'add_new_item'               => __( 'Add New Role', 'text_domain' ),
// 		'edit_item'                  => __( 'Edit Role', 'text_domain' ),
// 		'update_item'                => __( 'Update Role', 'text_domain' ),
// 		'view_item'                  => __( 'View Role', 'text_domain' ),
// 		'separate_items_with_commas' => __( 'Separate roles with commas', 'text_domain' ),
// 		'add_or_remove_items'        => __( 'Add or remove roles', 'text_domain' ),
// 		'choose_from_most_used'      => __( 'Choose from the most used roles', 'text_domain' ),
// 		'popular_items'              => __( 'Popular Roles', 'text_domain' ),
// 		'search_items'               => __( 'Search roles', 'text_domain' ),
// 		'not_found'                  => __( 'Not Found', 'text_domain' ),
// 		'no_terms'                   => __( 'No items', 'text_domain' ),
// 		'items_list'                 => __( 'Items list', 'text_domain' ),
// 		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
// 	);
// 	$rewrite = array(
// 		'slug'                       => 'roles',
// 		'with_front'                 => true,
// 		'hierarchical'               => true,
// 	);
// 	$args = array(
// 		'labels'                     => $labels,
// 		'hierarchical'               => false,
// 		'public'                     => true,
// 		'show_ui'                    => true,
// 		'show_admin_column'          => true,
// 		'show_in_nav_menus'          => true,
// 		'show_tagcloud'              => true,
// 		'rewrite'                    => $rewrite
// 	);
// 	register_taxonomy( 'role', array( 'person' ), $args );
// }
// add_action( 'init', 'role_taxonomy', 0 );
