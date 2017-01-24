<?php

//=============================================
// EXAMPLE Routes
//=============================================

// Browse Examples by taxonomy (speaker or series) //
Routes::map('examples/:taxonomy', function($params){
  $query = 'post_type=example';
  // Catch taxonomy
  if (in_array($params['taxonomy'], array( 'tax1-slug', 'tax2-slug')) ){
    Routes::load('archive-example.php', $params, $query);
  }
});

// Browse Examples by term /////////////////////////
$example_by_term_args = array(
  'post_type' => 'example',
  'posts_per_page' => 20,
  'order' => 'desc',
  'orderby' => 'date',
  'tax_query' => array(
    array(
      'field' => 'slug',
    ),
  ),
);
Routes::map('examples/:taxonomy/:term/', function($params) use ($example_by_term_args) {
  // No page number means we're at page 1
  $example_by_term_args['tax_query'][0]['taxonomy'] = singularize($params['taxonomy']);
  $example_by_term_args['tax_query'][0]['terms'] = $params['term'];
  $example_by_term_args['paged'] = 1;
  Routes::load('archive-example-by-term.php', $params, $example_by_term_args);
});
Routes::map('examples/:taxonomy/:term/page/:pg', function($params) use ($example_by_term_args) {
  // The rest of the page
  $example_by_term_args['tax_query'][0]['taxonomy'] = $params['taxonomy'];
  $example_by_term_args['tax_query'][0]['terms'] = $params['term'];
  $example_by_term_args['paged'] = $params['pg'];
  Routes::load('archive-example-by-term.php', $params, $example_by_term_args);
});
