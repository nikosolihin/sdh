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
//
// /**
//  * Register News Topic Taxonomy
//  */
// function news_topic_taxonomy() {
// 	$labels = array(
// 		'name'                       => _x( 'News Topics', 'Taxonomy General Name', 'text_domain' ),
// 		'singular_name'              => _x( 'News Topic', 'Taxonomy Singular Name', 'text_domain' ),
// 		'menu_name'                  => __( 'Topics', 'text_domain' ),
// 		'all_items'                  => __( 'All Topics', 'text_domain' ),
// 		'parent_item'                => __( 'Parent Topic', 'text_domain' ),
// 		'parent_item_colon'          => __( 'Parent Topic:', 'text_domain' ),
// 		'new_item_name'              => __( 'New Topic Name', 'text_domain' ),
// 		'add_new_item'               => __( 'Add New Topic', 'text_domain' ),
// 		'edit_item'                  => __( 'Edit Topic', 'text_domain' ),
// 		'update_item'                => __( 'Update Topic', 'text_domain' ),
// 		'view_item'                  => __( 'View Topic', 'text_domain' ),
// 		'separate_items_with_commas' => __( 'Separate categories with commas', 'text_domain' ),
// 		'add_or_remove_items'        => __( 'Add or remove topics', 'text_domain' ),
// 		'choose_from_most_used'      => __( 'Choose from the most used topics', 'text_domain' ),
// 		'popular_items'              => __( 'Popular Topics', 'text_domain' ),
// 		'search_items'               => __( 'Search topics', 'text_domain' ),
// 		'not_found'                  => __( 'Not Found', 'text_domain' ),
// 		'no_terms'                   => __( 'No items', 'text_domain' ),
// 		'items_list'                 => __( 'Items list', 'text_domain' ),
// 		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
// 	);
// 	$rewrite = array(
// 		'slug'                       => 'news/?utf8=✓&page=1&topic=',
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
//     'rest_base'                  => 'topics',
//     'rest_controller_class'      => 'WP_REST_Terms_Controller',
// 	);
// 	register_taxonomy( 'news_topic', array( 'news' ), $args );
// }
// add_action( 'init', 'news_topic_taxonomy', 0 );
//
//
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
