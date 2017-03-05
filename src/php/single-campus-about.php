<?php
/**
 * The template for displaying a single campus welcome section
 */
global $params;

$context = Timber::get_context();
$post = new TimberPost();
$context['acf'] = get_fields();
$context['sections'] = $context['acf']['sections'];

// Only get what we need
$context['photo'] = $post->get_field('photo');
$context['message'] = $post->get_field('message');

// Get news
$news_args = 'post_type=news&numberposts=3&orderby=desc';
$news = Timber::get_posts($news_args);
$context['news'] = array();
foreach ($news as $item) {
  array_push( $context['news'], array(
    'title' => $item->title,
    'date' => $item->post_date,
    'link' => $item->link
  ));
}

var_dump($context['acf']);

//Get events


Timber::render( 'page/single-campus.twig' , $context );
