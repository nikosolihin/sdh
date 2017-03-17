<?php
/**
 * The template for event archive
 */
$context = Timber::get_context();

$context['title'] = get_field('events_title', 'option');
$context['teaser'] = get_field('events_teaser', 'option');
$context['wp_title'] = __('Event Calendar', 'sdh');
$context['body_class'] = 'archive';
$context['empty_msg'] = __('No events found. Please try again.', 'sdh');
$context['ppp'] = get_field('events_listing_ppp', 'option');
$context['ics'] = get_field('ics_url', 'option');

// Get Sidebar. Listing pages can't inherit from any parents.
$context['sidebar_sections'] = get_field('events_listing_sidebar', 'option')['sidebar_sections'];

// Get After Listing page content
$context['sections'] = get_field('events_content', 'option')['sections'];

// Get all campuses to be passed to events.js
$context['all_campuses'] = array();
foreach (Timber::get_terms('campus') as $topic) {
  $context['all_campuses'][$topic->id] = array(
    'name' => $topic->name,
    'slug' => $topic->slug
  );
}
$context['campuses_json'] = json_encode($context['all_campuses']);

Timber::render( 'event/archive-event.twig' , $context );
