<?php
/**
 * The template for displaying a single campus welcome section
 */
global $params;

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['acf'] = get_fields();
$context['sections'] = $context['acf']['sections'];
$context['location'] = $context['acf']['maps'];
$context['banner'] = $context['acf']['banner'];

// Get news
$news_args = array(
  'post_type'       => 'news',
  'tax_query'       => array(
    array(
      'taxonomy'    => 'campus',
      'field'       => 'slug',
      'terms'       => $params['location']
    )
  ),
  'posts_per_page'  => 3,
  'orderby'         => 'date',
  'order'           => 'DESC'
 );
$news = Timber::get_posts($news_args);
$context['news'] = array();
foreach ($news as $item) {
  array_push( $context['news'], array(
    'title' => $item->title,
    'date' => $item->post_date,
    'link' => $item->link
  ));
}

// Get events


// Generate breadcrumb. This is custom.
$context['breadcrumb'] = array();
array_push( $context['breadcrumb'], array(
  'title' => 'Our Campuses',
  'link' => $post->link
));

// Where are we going?
switch ($params['section']) {
  case 'about':
    var_dump("About");
    break;

  case 'facilities':
    var_dump("Facilities");
    break;

  default: // Welcome
    $context['photo'] = $post->get_field('photo');
    $context['message'] = $post->get_field('message');
    Timber::render( 'campus/single-campus-welcome.twig' , $context );
}
