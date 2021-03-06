<?php
/**
 * The template for news archive
 */
$context = Timber::get_context();

$context['title'] = get_field('news_title', 'option');
$context['subtitle'] = get_field('news_subtitle', 'option');
$context['teaser'] = get_field('news_teaser', 'option');
$context['wp_title'] = __('News', 'sdh');
$context['body_class'] = 'archive';
$context['empty_msg'] = __('No news found. Please try again.', 'sdh');
$context['ppp'] = get_field('news_listing_ppp', 'option');

// Get Sidebar. Listing pages can't inherit from any parents.
$context['sidebar_sections'] = get_field('news_listing_sidebar', 'option')['sidebar_sections'];

// Get After Listing page content
$context['sections'] = get_field('news_content', 'option')['sections'];

// Get all campuses to be passed to news.js
$context['all_campuses'] = array();
foreach (Timber::get_terms('campus') as $topic) {
  $context['all_campuses'][$topic->id] = array(
    'name' => $topic->name,
    'slug' => $topic->slug
  );
}
$context['campuses_json'] = json_encode($context['all_campuses']);

Timber::render( 'news/archive-news.twig' , $context, 600, TimberLoader::CACHE_SITE_TRANSIENT );
