<?php
/**
 * The template for news archive
 */
$context = Timber::get_context();
$context['wp_title'] = __('News', 'saat');
$context['empty_msg'] = __('No news found. Please try again.', 'saat');

$post = new TimberPost();
$context['post'] = $post;
$context['ppp'] = get_field('news_listing_ppp', 'option');

// Get all topics to be passed to news.js
$context['topics'] = array();
foreach (Timber::get_terms('news_topic') as $topic) {
  $context['topics'][$topic->id] = array(
    'name' => $topic->name,
    'slug' => $topic->slug
  );
}
$context['topics_json'] = json_encode($context['topics']);

// Get featured news
$context['more_label'] = get_field('news_load_more', 'option');
$context['featured_news'] = array();
$featured_news = array_slice( get_field('news_featured', 'option'), 0, 4);
foreach (Timber::get_posts($featured_news) as $news) {
  $authors = array();
  if ($news->get_field('authors')) {
    foreach ($news->get_field('authors') as $author) {
      array_push($authors, $author->name);
    }
  }
  array_push($context['featured_news'], array(
    'id'          => $news->id,
    'title'       => $news->title,
    'link'        => $news->link,
    'topic'       => $news->get_terms('news_topic')[0]->name,
    'authors'     => implode(", ", $authors),
    'date'        => $news->post_date,
    'image'       => $news->get_field('image'),
  ));
}

// Get latest news
$context['latest_news'] = array();
$quantity = (int)get_field('news_latest_quantity', 'option');
foreach (Timber::get_terms('news_topic', array('hide_empty' => true)) as $topic) {
  $news = array();
  $args = array(
    'post_type'       => 'news',
    'orderby'         => 'post_date',
    'posts_per_page'  => $quantity,
    'order'           => 'DESC',
    'tax_query'       => array(
      array(
        'taxonomy'    => 'news_topic',
        'field'       => 'term_id',
        'terms'       => $topic->id,
      ),
	  ),
  );
  foreach (Timber::get_posts($args) as $post) {
    $authors = array();
    if ($post->get_field('authors')) {
      foreach ($post->get_field('authors') as $author) {
        array_push($authors, $author->name);
      }
    }
    array_push($news, array(
      'title'   => $post->title,
      'link'    => $post->link,
      'authors' => implode(", ", $authors),
      'date'    => $post->post_date,
      'image'   => $post->get_field('image')
    ));
  }
  $context['latest_news'][$topic->name] = $news;
}

Timber::render( 'news/archive-news.twig' , $context );
