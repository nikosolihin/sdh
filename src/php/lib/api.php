<?php
//=============================================
// Allow meta field to be queried in WP-API
// Based on https://1fix.io/blog/2015/07/20/query-vars-wp-api/
// Note: this function must be pair with
// https://github.com/WP-API/rest-filter
//=============================================
function my_allow_meta_query( $valid_vars ) {
  $valid_vars = array_merge( $valid_vars, array( 'meta_key', 'meta_value', 'meta_query', 'meta_compare' ) );
  return $valid_vars;
}
add_filter( 'rest_query_vars', 'my_allow_meta_query' );
