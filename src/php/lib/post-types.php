<?php
/**
 * Register Block Post Type
 */
function blocks_post_type() {
	$labels = array(
		'name'                  => _x( 'Blocks', 'Post Type General Name', 'sdh' ),
		'singular_name'         => _x( 'Block', 'Post Type Singular Name', 'sdh' ),
		'menu_name'             => __( 'Blocks', 'sdh' ),
		'name_admin_bar'        => __( 'Block', 'sdh' ),
		'archives'              => __( 'Block Archives', 'sdh' ),
		'parent_item_colon'     => __( 'Parent Block:', 'sdh' ),
		'all_items'             => __( 'All Blocks', 'sdh' ),
		'add_new_item'          => __( 'Add New Block', 'sdh' ),
		'add_new'               => __( 'New Block', 'sdh' ),
		'new_item'              => __( 'New Block', 'sdh' ),
		'edit_item'             => __( 'Edit Block', 'sdh' ),
		'update_item'           => __( 'Update Block', 'sdh' ),
		'view_item'             => __( 'View Block', 'sdh' ),
		'search_items'          => __( 'Search Blocks', 'sdh' ),
		'not_found'             => __( 'No block found', 'sdh' ),
		'not_found_in_trash'    => __( 'No block found in trash', 'sdh' ),
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
	$args = array(
		'label'                 => __( 'Block', 'sdh' ),
		'description'           => __( 'Custom post type for blocks', 'sdh' ),
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
 * Register Voice Post Type
 */
function voices_post_type() {
	$labels = array(
		'name'                  => _x( 'Voices', 'Post Type General Name', 'sdh' ),
		'singular_name'         => _x( 'Voice', 'Post Type Singular Name', 'sdh' ),
		'menu_name'             => __( 'Voices', 'sdh' ),
		'name_admin_bar'        => __( 'Voice', 'sdh' ),
		'archives'              => __( 'Voice Archives', 'sdh' ),
		'parent_item_colon'     => __( 'Parent Voice:', 'sdh' ),
		'all_items'             => __( 'All Voices', 'sdh' ),
		'add_new_item'          => __( 'Add New Voice', 'sdh' ),
		'add_new'               => __( 'New Voice', 'sdh' ),
		'new_item'              => __( 'New Voice', 'sdh' ),
		'edit_item'             => __( 'Edit Voice', 'sdh' ),
		'update_item'           => __( 'Update Voice', 'sdh' ),
		'view_item'             => __( 'View Voice', 'sdh' ),
		'search_items'          => __( 'Search Voices', 'sdh' ),
		'not_found'             => __( 'No voice found', 'sdh' ),
		'not_found_in_trash'    => __( 'Nvoicese found in trash', 'sdh' ),
		'featured_image'        => __( 'Fvoicesd Image', 'sdh' ),
		'set_featured_image'    => __( 'Set featured image', 'sdh' ),
		'remove_featured_image' => __( 'Remove featured image', 'sdh' ),
		'use_featured_image'    => __( 'Use as featured image', 'sdh' ),
		'insert_into_item'      => __( 'Insert into item', 'sdh' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'sdh' ),
		'items_list'            => __( 'Items list', 'sdh' ),
		'items_list_navigation' => __( 'Items list navigation', 'sdh' ),
		'filter_items_list'     => __( 'Filter items list', 'sdh' ),
	);
	$args = array(
		'label'                 => __( 'Voice', 'sdh' ),
		'description'           => __( 'Custom post type for voices', 'sdh' ),
		'labels'                => $labels,
		'supports'              => array( 'title' ),
		'taxonomies'            => array( 'campus' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 100,
		'menu_icon'             => 'dashicons-editor-quote',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => false, //Disable single page viewing
		'rewrite'               => false,
		'capability_type'       => 'page',
	);
	register_post_type( 'voice', $args );
}
add_action( 'init', 'voices_post_type', 0 );

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
