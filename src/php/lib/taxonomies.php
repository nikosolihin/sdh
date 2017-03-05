<?php
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
