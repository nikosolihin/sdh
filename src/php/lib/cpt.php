<?php
/**
 * Register the block post type
 */
add_action( 'init', 'block_cpt' );
function block_cpt() {
  $labels = array(
    'name'               => _x( 'Blocks', 'post type general name', 'your-plugin-textdomain' ),
    'singular_name'      => _x( 'Block', 'post type singular name', 'your-plugin-textdomain' ),
    'menu_name'          => _x( 'Blocks', 'admin menu', 'your-plugin-textdomain' ),
    'name_admin_bar'     => _x( 'Block', 'add new on admin bar', 'your-plugin-textdomain' ),
    'add_new'            => _x( 'Add New', 'block', 'your-plugin-textdomain' ),
    'add_new_item'       => __( 'Add New Block', 'your-plugin-textdomain' ),
    'new_item'           => __( 'New Block', 'your-plugin-textdomain' ),
    'edit_item'          => __( 'Edit Block', 'your-plugin-textdomain' ),
    'view_item'          => __( 'View Block', 'your-plugin-textdomain' ),
    'all_items'          => __( 'All Blocks', 'your-plugin-textdomain' ),
    'search_items'       => __( 'Search Blocks', 'your-plugin-textdomain' ),
    'parent_item_colon'  => __( 'Parent Blocks:', 'your-plugin-textdomain' ),
    'not_found'          => __( 'No blocks found.', 'your-plugin-textdomain' ),
    'not_found_in_trash' => __( 'No blocks found in Trash.', 'your-plugin-textdomain' )
  );
  $args = array(
      'labels'             => $labels,
      'description'        => __( 'Custom post type for blocks.', 'your-plugin-textdomain' ),
      'public'             => true,
      'publicly_queryable' => true,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'query_var'          => true,
      'rewrite'            => array( 'slug' => 'block' ),
      'capability_type'    => 'post',
      'has_archive'        => true,
      'hierarchical'       => false,
      'menu_position'      => 20.1,
      'menu_icon'          => 'dashicons-screenoptions'
  );
  register_post_type( 'block', $args );
}

/**
 * Register a post type, without REST API support
 */
add_action( 'init', 'example_cpt' );
function example_cpt() {
  $labels = array(
    'name'               => _x( 'Examples', 'post type general name', 'your-plugin-textdomain' ),
    'singular_name'      => _x( 'Example', 'post type singular name', 'your-plugin-textdomain' ),
    'menu_name'          => _x( 'Examples', 'admin menu', 'your-plugin-textdomain' ),
    'name_admin_bar'     => _x( 'Example', 'add new on admin bar', 'your-plugin-textdomain' ),
    'add_new'            => _x( 'Add New', 'sermon', 'your-plugin-textdomain' ),
    'add_new_item'       => __( 'Add New Example', 'your-plugin-textdomain' ),
    'new_item'           => __( 'New Example', 'your-plugin-textdomain' ),
    'edit_item'          => __( 'Edit Example', 'your-plugin-textdomain' ),
    'view_item'          => __( 'View Example', 'your-plugin-textdomain' ),
    'all_items'          => __( 'All Examples', 'your-plugin-textdomain' ),
    'search_items'       => __( 'Search Examples', 'your-plugin-textdomain' ),
    'parent_item_colon'  => __( 'Parent Examples:', 'your-plugin-textdomain' ),
    'not_found'          => __( 'No sermons found.', 'your-plugin-textdomain' ),
    'not_found_in_trash' => __( 'No sermons found in Trash.', 'your-plugin-textdomain' )
  );
  $args = array(
      'labels'             => $labels,
      'description'        => __( 'Custom post type for example.', 'your-plugin-textdomain' ),
      'public'             => true,
      'publicly_queryable' => true,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'taxonomies'         => array( 'tax1-slug', 'tax2-slug' ),
      'query_var'          => true,
      'rewrite'            => array( 'slug' => 'examples' ), // CPT is 'example', but URL slug is 'examples'
      'capability_type'    => 'post',
      'has_archive'        => true,
      'hierarchical'       => false,
      'menu_position'      => 20.2,
      'menu_icon'          => 'dashicons-playlist-video'

      // Add the following to expose API endpoints for this CPT
      // 'show_in_rest'       => true,
      // 'rest_base'          => 'examples',
      // 'rest_controller_class' => 'WP_REST_Posts_Controller',
  );
  register_post_type( 'example', $args );
}
