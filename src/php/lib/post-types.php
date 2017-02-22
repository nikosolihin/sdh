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
		'add_new_item'          => __( 'Add New Block', 'text_domain' ),
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

/**
 * Register Event Post Type
 */
function events_post_type() {
	$labels = array(
		'name'                  => _x( 'Events', 'Post Type General Name', 'sdh' ),
		'singular_name'         => _x( 'Event', 'Post Type Singular Name', 'sdh' ),
		'menu_name'             => __( 'Events', 'sdh' ),
		'name_admin_bar'        => __( 'Event', 'sdh' ),
		'archives'              => __( 'Event Archives', 'sdh' ),
		'parent_item_colon'     => __( 'Parent Event:', 'sdh' ),
		'all_items'             => __( 'All Events', 'sdh' ),
		'add_new_item'          => __( 'Add New Events', 'sdh' ),
		'add_new'               => __( 'New Event', 'sdh' ),
		'new_item'              => __( 'New Event', 'sdh' ),
		'edit_item'             => __( 'Edit Event', 'sdh' ),
		'update_item'           => __( 'Update Event', 'sdh' ),
		'view_item'             => __( 'View Event', 'sdh' ),
		'search_items'          => __( 'Search Events', 'sdh' ),
		'not_found'             => __( 'No event found', 'sdh' ),
		'not_found_in_trash'    => __( 'No event found in trash', 'sdh' ),
		'featured_image'        => __( 'Featured Image', 'sdh' ),
		'set_featured_image'    => __( 'Set featured image', 'sdh' ),
		'remove_featured_image' => __( 'Remove featured image', 'sdh' ),
		'use_featured_image'    => __( 'Use as featured image', 'sdh' ),
		'insert_into_item'      => __( 'Insert into item', 'sdh' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'sdh' ),
		'items_list'            => __( 'Items list', 'sdh' ),
		'items_list_navigation' => __( 'Items list navigation', 'sdh' ),
		'filter_items_list'     => __( 'Filter items list', 'sdh' ),
	);
	$rewrite = array(
		'slug'                  => 'events',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => false,
	);
	$args = array(
		'label'                 => __( 'Event', 'sdh' ),
		'description'           => __( 'Custom post type for event', 'sdh' ),
		'labels'                => $labels,
		'supports'              => array( 'title' ),
		'taxonomies'            => array( 'campus' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 101,
		'menu_icon'             => 'dashicons-calendar-alt',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'     	=> array('campus','campuses'),
    'map_meta_cap'        	=> true,
		'show_in_rest'       		=> true,
		'rest_base'          		=> 'events',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	);
	register_post_type( 'event', $args );
}
add_action( 'init', 'events_post_type', 0 );

/**
 * Register News Post Type
 */
function news_post_type() {
	$labels = array(
		'name'                  => _x( 'News', 'Post Type General Name', 'sdh' ),
		'singular_name'         => _x( 'News', 'Post Type Singular Name', 'sdh' ),
		'menu_name'             => __( 'News', 'sdh' ),
		'name_admin_bar'        => __( 'News', 'sdh' ),
		'archives'              => __( 'News Archives', 'sdh' ),
		'parent_item_colon'     => __( 'Parent News:', 'sdh' ),
		'all_items'             => __( 'All News', 'sdh' ),
		'add_new_item'          => __( 'Add New News', 'sdh' ),
		'add_new'               => __( 'New News', 'sdh' ),
		'new_item'              => __( 'New News', 'sdh' ),
		'edit_item'             => __( 'Edit News', 'sdh' ),
		'update_item'           => __( 'Update News', 'sdh' ),
		'view_item'             => __( 'View News', 'sdh' ),
		'search_items'          => __( 'Search News', 'sdh' ),
		'not_found'             => __( 'No news found', 'sdh' ),
		'not_found_in_trash'    => __( 'No news found in trash', 'sdh' ),
		'featured_image'        => __( 'Featured Image', 'sdh' ),
		'set_featured_image'    => __( 'Set featured image', 'sdh' ),
		'remove_featured_image' => __( 'Remove featured image', 'sdh' ),
		'use_featured_image'    => __( 'Use as featured image', 'sdh' ),
		'insert_into_item'      => __( 'Insert into item', 'sdh' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'sdh' ),
		'items_list'            => __( 'Items list', 'sdh' ),
		'items_list_navigation' => __( 'Items list navigation', 'sdh' ),
		'filter_items_list'     => __( 'Filter items list', 'sdh' ),
	);
	$rewrite = array(
		'slug'                  => 'news',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => false,
	);
	$args = array(
		'label'                 => __( 'News', 'sdh' ),
		'description'           => __( 'Custom post type for news', 'sdh' ),
		'labels'                => $labels,
		'supports'              => array( 'title' ),
		'taxonomies'            => array( 'campus' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 101,
		'menu_icon'             => 'dashicons-megaphone',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'     	=> array('campus','campuses'),
    'map_meta_cap'        	=> true,
		'show_in_rest'       		=> true,
		'rest_base'          		=> 'news',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	);
	register_post_type( 'news', $args );
}
add_action( 'init', 'news_post_type', 0 );


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


/**
 * Register Campus Post Type
 */
function campus_post_type() {
	$labels = array(
		'name'                  => _x( 'Campuses', 'Post Type General Name', 'sdh' ),
		'singular_name'         => _x( 'Campus', 'Post Type Singular Name', 'sdh' ),
		'menu_name'             => __( 'Campuses', 'sdh' ),
		'name_admin_bar'        => __( 'Campus', 'sdh' ),
		'archives'              => __( 'Campus Archives', 'sdh' ),
		'parent_item_colon'     => __( 'Parent Campus:', 'sdh' ),
		'all_items'             => __( 'All Campuses', 'sdh' ),
		'add_new_item'          => __( 'Add New Campus', 'sdh' ),
		'add_new'               => __( 'New Campus', 'sdh' ),
		'new_item'              => __( 'New Campus', 'sdh' ),
		'edit_item'             => __( 'Edit Campus', 'sdh' ),
		'update_item'           => __( 'Update Campus', 'sdh' ),
		'view_item'             => __( 'View Campus', 'sdh' ),
		'search_items'          => __( 'Search Campuses', 'sdh' ),
		'not_found'             => __( 'No campus found', 'sdh' ),
		'not_found_in_trash'    => __( 'No campus found in trash', 'sdh' ),
		'featured_image'        => __( 'Featured Image', 'sdh' ),
		'set_featured_image'    => __( 'Set featured image', 'sdh' ),
		'remove_featured_image' => __( 'Remove featured image', 'sdh' ),
		'use_featured_image'    => __( 'Use as featured image', 'sdh' ),
		'insert_into_item'      => __( 'Insert into item', 'sdh' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'sdh' ),
		'items_list'            => __( 'Items list', 'sdh' ),
		'items_list_navigation' => __( 'Items list navigation', 'sdh' ),
		'filter_items_list'     => __( 'Filter items list', 'sdh' ),
	);
	$rewrite = array(
		'slug'                  => 'campuses',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => false,
	);
	$args = array(
		'label'                 => __( 'Campus', 'sdh' ),
		'description'           => __( 'Custom post type for campus', 'sdh' ),
		'labels'                => $labels,
		'supports'              => array( 'title' ),
		'taxonomies'            => array(),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 101,
		'menu_icon'             => 'dashicons-location',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'     	=> array('campus','campuses'),
    'map_meta_cap'        	=> true,
	);
	register_post_type( 'campus', $args );
}
add_action( 'init', 'campus_post_type', 0 );

/**
 * Filters to enable %custom-taxonomy% in rewrites
 * http://wordpress.stackexchange.com/questions/108642/permalinks-custom-post-type-custom-taxonomy-post
 */
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
