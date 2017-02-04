<?php
/**
 * Register Block Post Type
 */
function blocks_post_type() {
	$labels = array(
		'name'                  => _x( 'Blocks', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Block', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Blocks', 'text_domain' ),
		'name_admin_bar'        => __( 'Block', 'text_domain' ),
		'archives'              => __( 'Block Archives', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Block:', 'text_domain' ),
		'all_items'             => __( 'All Blocks', 'text_domain' ),
		'add_new_item'          => __( 'Add New Blocks', 'text_domain' ),
		'add_new'               => __( 'New Block', 'text_domain' ),
		'new_item'              => __( 'New Block', 'text_domain' ),
		'edit_item'             => __( 'Edit Block', 'text_domain' ),
		'update_item'           => __( 'Update Block', 'text_domain' ),
		'view_item'             => __( 'View Block', 'text_domain' ),
		'search_items'          => __( 'Search Blocks', 'text_domain' ),
		'not_found'             => __( 'No block found', 'text_domain' ),
		'not_found_in_trash'    => __( 'No block found in trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Block', 'text_domain' ),
		'description'           => __( 'Custom post type for blocks', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', ),
		'taxonomies'            => array( 'block_type' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 100,
		'menu_icon'             => 'dashicons-screenoptions',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => false, //Disable single page viewing
		'rewrite'               => false,
		'capability_type'       => 'page',
	);
	register_post_type( 'block', $args );
}
add_action( 'init', 'blocks_post_type', 0 );

// /**
//  * Register Event Post Type
//  */
// function events_post_type() {
// 	$labels = array(
// 		'name'                  => _x( 'Events', 'Post Type General Name', 'text_domain' ),
// 		'singular_name'         => _x( 'Event', 'Post Type Singular Name', 'text_domain' ),
// 		'menu_name'             => __( 'Events', 'text_domain' ),
// 		'name_admin_bar'        => __( 'Event', 'text_domain' ),
// 		'archives'              => __( 'Event Archives', 'text_domain' ),
// 		'parent_item_colon'     => __( 'Parent Event:', 'text_domain' ),
// 		'all_items'             => __( 'All Events', 'text_domain' ),
// 		'add_new_item'          => __( 'Add New Events', 'text_domain' ),
// 		'add_new'               => __( 'New Event', 'text_domain' ),
// 		'new_item'              => __( 'New Event', 'text_domain' ),
// 		'edit_item'             => __( 'Edit Event', 'text_domain' ),
// 		'update_item'           => __( 'Update Event', 'text_domain' ),
// 		'view_item'             => __( 'View Event', 'text_domain' ),
// 		'search_items'          => __( 'Search Events', 'text_domain' ),
// 		'not_found'             => __( 'No event found', 'text_domain' ),
// 		'not_found_in_trash'    => __( 'No event found in trash', 'text_domain' ),
// 		'featured_image'        => __( 'Featured Image', 'text_domain' ),
// 		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
// 		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
// 		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
// 		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
// 		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
// 		'items_list'            => __( 'Items list', 'text_domain' ),
// 		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
// 		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
// 	);
// 	$rewrite = array(
// 		'slug'                  => 'events',
// 		'with_front'            => true,
// 		'pages'                 => true,
// 		'feeds'                 => false,
// 	);
// 	$args = array(
// 		'label'                 => __( 'Event', 'text_domain' ),
// 		'description'           => __( 'Custom post type for event', 'text_domain' ),
// 		'labels'                => $labels,
// 		'supports'              => array( 'title' ),
// 		'taxonomies'            => array( 'event_category' ),
// 		'hierarchical'          => false,
// 		'public'                => true,
// 		'show_ui'               => true,
// 		'show_in_menu'          => true,
// 		'menu_position'         => 101,
// 		'menu_icon'             => 'dashicons-calendar-alt',
// 		'show_in_admin_bar'     => true,
// 		'show_in_nav_menus'     => true,
// 		'can_export'            => true,
// 		'has_archive'           => true,
// 		'exclude_from_search'   => false,
// 		'publicly_queryable'    => true,
// 		'rewrite'               => $rewrite,
// 		'show_in_rest'       		=> true,
// 		'rest_base'          		=> 'events',
// 		'rest_controller_class' => 'WP_REST_Posts_Controller',
// 	);
// 	register_post_type( 'event', $args );
// }
// add_action( 'init', 'events_post_type', 0 );
//
// /**
//  * Register News Post Type
//  */
// function news_post_type() {
// 	$labels = array(
// 		'name'                  => _x( 'News', 'Post Type General Name', 'text_domain' ),
// 		'singular_name'         => _x( 'News', 'Post Type Singular Name', 'text_domain' ),
// 		'menu_name'             => __( 'News', 'text_domain' ),
// 		'name_admin_bar'        => __( 'News', 'text_domain' ),
// 		'archives'              => __( 'News Archives', 'text_domain' ),
// 		'parent_item_colon'     => __( 'Parent News:', 'text_domain' ),
// 		'all_items'             => __( 'All News', 'text_domain' ),
// 		'add_new_item'          => __( 'Add New News', 'text_domain' ),
// 		'add_new'               => __( 'New News', 'text_domain' ),
// 		'new_item'              => __( 'New News', 'text_domain' ),
// 		'edit_item'             => __( 'Edit News', 'text_domain' ),
// 		'update_item'           => __( 'Update News', 'text_domain' ),
// 		'view_item'             => __( 'View News', 'text_domain' ),
// 		'search_items'          => __( 'Search News', 'text_domain' ),
// 		'not_found'             => __( 'No news found', 'text_domain' ),
// 		'not_found_in_trash'    => __( 'No news found in trash', 'text_domain' ),
// 		'featured_image'        => __( 'Featured Image', 'text_domain' ),
// 		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
// 		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
// 		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
// 		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
// 		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
// 		'items_list'            => __( 'Items list', 'text_domain' ),
// 		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
// 		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
// 	);
// 	$rewrite = array(
// 		'slug'                  => 'news',
// 		'with_front'            => true,
// 		'pages'                 => true,
// 		'feeds'                 => false,
// 	);
// 	$args = array(
// 		'label'                 => __( 'News', 'text_domain' ),
// 		'description'           => __( 'Custom post type for news', 'text_domain' ),
// 		'labels'                => $labels,
// 		'supports'              => array( 'title' ),
// 		'taxonomies'            => array( 'news_topic' ),
// 		'hierarchical'          => false,
// 		'public'                => true,
// 		'show_ui'               => true,
// 		'show_in_menu'          => true,
// 		'menu_position'         => 101,
// 		'menu_icon'             => 'dashicons-megaphone',
// 		'show_in_admin_bar'     => true,
// 		'show_in_nav_menus'     => true,
// 		'can_export'            => true,
// 		'has_archive'           => true,
// 		'exclude_from_search'   => false,
// 		'publicly_queryable'    => true,
// 		'rewrite'               => $rewrite,
// 		'show_in_rest'       		=> true,
// 		'rest_base'          		=> 'news',
// 		'rest_controller_class' => 'WP_REST_Posts_Controller',
// 	);
// 	register_post_type( 'news', $args );
// }
// add_action( 'init', 'news_post_type', 0 );
//
//
// /**
//  * Register Person Post Type
//  */
// function person_post_type() {
// 	$labels = array(
// 		'name'                  => _x( 'People', 'Post Type General Name', 'text_domain' ),
// 		'singular_name'         => _x( 'Person', 'Post Type Singular Name', 'text_domain' ),
// 		'menu_name'             => __( 'People', 'text_domain' ),
// 		'name_admin_bar'        => __( 'Person', 'text_domain' ),
// 		'archives'              => __( 'People Archives', 'text_domain' ),
// 		'parent_item_colon'     => __( 'Parent Person:', 'text_domain' ),
// 		'all_items'             => __( 'All People', 'text_domain' ),
// 		'add_new_item'          => __( 'Add New Person', 'text_domain' ),
// 		'add_new'               => __( 'New Person', 'text_domain' ),
// 		'new_item'              => __( 'New Person', 'text_domain' ),
// 		'edit_item'             => __( 'Edit Person', 'text_domain' ),
// 		'update_item'           => __( 'Update Person', 'text_domain' ),
// 		'view_item'             => __( 'View Person', 'text_domain' ),
// 		'search_items'          => __( 'Search Person', 'text_domain' ),
// 		'not_found'             => __( 'No person found', 'text_domain' ),
// 		'not_found_in_trash'    => __( 'No person found in trash', 'text_domain' ),
// 		'featured_image'        => __( 'Featured Image', 'text_domain' ),
// 		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
// 		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
// 		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
// 		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
// 		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
// 		'items_list'            => __( 'Items list', 'text_domain' ),
// 		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
// 		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
// 	);
// 	$args = array(
// 		'label'                 => __( 'Person', 'text_domain' ),
// 		'description'           => __( 'Custom post type for people', 'text_domain' ),
// 		'labels'                => $labels,
// 		'supports'              => array( 'title' ),
// 		'taxonomies'            => array( 'role' ),
// 		'hierarchical'          => false,
// 		'public'                => true,
// 		'show_ui'               => true,
// 		'show_in_menu'          => true,
// 		'menu_position'         => 102,
// 		'menu_icon'             => 'dashicons-groups',
// 		'show_in_admin_bar'     => true,
// 		'show_in_nav_menus'     => false,
// 		'can_export'            => true,
// 		'has_archive'           => false,
// 		'exclude_from_search'   => false,
// 		'publicly_queryable'    => false, //Disable single page viewing
// 		'rewrite'               => false,
// 		'capability_type'       => 'page',
// 		'show_in_rest'       		=> false,
// 	);
// 	register_post_type( 'person', $args );
// }
// add_action( 'init', 'person_post_type', 0 );
//
//
// /**
//  * Register Media Post Type
//  */
// function media_post_type() {
// 	$labels = array(
// 		'name'                  => _x( 'Media', 'Post Type General Name', 'text_domain' ),
// 		'singular_name'         => _x( 'Media', 'Post Type Singular Name', 'text_domain' ),
// 		'menu_name'             => __( 'Media', 'text_domain' ),
// 		'name_admin_bar'        => __( 'Media', 'text_domain' ),
// 		'archives'              => __( 'Media Archives', 'text_domain' ),
// 		'parent_item_colon'     => __( 'Parent Media:', 'text_domain' ),
// 		'all_items'             => __( 'All Media', 'text_domain' ),
// 		'add_new_item'          => __( 'Add New Media', 'text_domain' ),
// 		'add_new'               => __( 'New Media', 'text_domain' ),
// 		'new_item'              => __( 'New Media', 'text_domain' ),
// 		'edit_item'             => __( 'Edit Media', 'text_domain' ),
// 		'update_item'           => __( 'Update Media', 'text_domain' ),
// 		'view_item'             => __( 'View Media', 'text_domain' ),
// 		'search_items'          => __( 'Search Media', 'text_domain' ),
// 		'not_found'             => __( 'No media found', 'text_domain' ),
// 		'not_found_in_trash'    => __( 'No media found in trash', 'text_domain' ),
// 		'featured_image'        => __( 'Featured Image', 'text_domain' ),
// 		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
// 		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
// 		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
// 		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
// 		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
// 		'items_list'            => __( 'Items list', 'text_domain' ),
// 		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
// 		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
// 	);
// 	$rewrite = array(
// 		'slug'                  => 'media/%media_type%',
// 		'with_front'            => true,
// 		'pages'                 => true,
// 		'feeds'                 => true,
// 	);
// 	$args = array(
// 		'label'                 => __( 'Media', 'text_domain' ),
// 		'description'           => __( 'Custom post type for media', 'text_domain' ),
// 		'labels'                => $labels,
// 		'supports'              => array( 'title' ),
// 		'taxonomies'            => array( 'media_type', 'media_category' ),
// 		'hierarchical'          => false,
// 		'public'                => true,
// 		'show_ui'               => true,
// 		'show_in_menu'          => true,
// 		'menu_position'         => 101,
// 		'menu_icon'             => 'dashicons-category',
// 		'show_in_admin_bar'     => true,
// 		'show_in_nav_menus'     => true,
// 		'can_export'            => true,
// 		'has_archive'           => true,
// 		'exclude_from_search'   => false,
// 		'publicly_queryable'    => true,
// 		'rewrite'               => $rewrite,
// 		'show_in_rest'       		=> true,
// 		'rest_base'          		=> 'resources', // 'media' is taken
// 		'rest_controller_class' => 'WP_REST_Posts_Controller',
// 	);
// 	register_post_type( 'resource', $args );
// }
// add_action( 'init', 'media_post_type', 0 );
//
// /**
//  * Filters to enable %custom-taxonomy% in rewrites
//  * http://wordpress.stackexchange.com/questions/108642/permalinks-custom-post-type-custom-taxonomy-post
//  */
// function media_type_permalinks( $post_link, $post ){
// 	if ( is_object( $post ) && $post->post_type == 'resource' ){
// 		$terms = wp_get_object_terms( $post->ID, 'media_type' );
// 		if( $terms ){
// 			return str_replace( '%media_type%' , $terms[0]->slug , $post_link );
// 		}
// 	}
// 	return $post_link;
// }
// add_filter( 'post_type_link', 'media_type_permalinks', 1, 2 );
