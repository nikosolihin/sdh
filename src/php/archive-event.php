<?php
/**
 * The template for arvhive event
 */
$context = Timber::get_context();

$context['title'] = get_field('news_title', 'option');
$context['teaser'] = get_field('news_teaser', 'option');
$context['wp_title'] = __('Events', 'sdh');
$context['empty_msg'] = __('No events found. Please try again.', 'sdh');

// Get all campuses to be passed to news.js
$context['campuses'] = array();
foreach (Timber::get_terms('campus') as $topic) {
  $context['campuses'][$topic->id] = array(
    'name' => $topic->name,
    'slug' => $topic->slug
  );
}
$context['campuses_json'] = json_encode($context['campuses']);

// Get Downloadble .ics
$context['ics'] = get_field('ics_url', 'option');

Timber::render( 'event/archive-event.twig' , $context );
