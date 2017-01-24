<?php
/**
 * Register an example taxonomy
 */
add_action( 'init', 'example_taxonomy' );
function example_taxonomy() {
  $labels = array(
      'name'              => _x( 'Example', 'taxonomy general name' ),
      'singular_name'     => _x( 'Example', 'taxonomy singular name' ),
      'search_items'      => __( 'Search Example' ),
      'all_items'         => __( 'All Example' ),
      'parent_item'       => __( 'Parent Example' ),
      'parent_item_colon' => __( 'Parent Example:' ),
      'edit_item'         => __( 'Edit Example' ),
      'update_item'       => __( 'Update Example' ),
      'add_new_item'      => __( 'Add New Example' ),
      'new_item_name'     => __( 'New Example Name' ),
      'menu_name'         => __( 'Example' ),
  );
  $args = array(
      'hierarchical'      => false,  //True like categories, false like tags
      'labels'            => $labels,
      'show_ui'           => true,
      'show_admin_column' => true,
      'query_var'         => true,
      'rewrite'           => array( 'slug' => 'prefix/tax1-slug' )

      // Add the following if exposing API endpoints
      'show_in_rest'       => true,
      'rest_base'          => 'tax1-slug',
      'rest_controller_class' => 'WP_REST_Terms_Controller',
  );
  register_taxonomy( 'tax1-slug', array( 'example' ), $args );
}
