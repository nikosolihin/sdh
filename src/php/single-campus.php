<?php
/**
 * The template for displaying a single campus welcome section
 */
global $params;

$context = Timber::get_context();
$post = Timber::get_post($params['location']);
$context['wp_title'] = __('Welcome to SDH', 'sdh') . " " . $post->title;
$context['post'] = $post;
$context['acf'] = get_fields();
$context['sections'] = $context['acf']['sections'];
$context['maps'] = $context['acf']['maps'];
$context['banner'] = $context['acf']['banner'];

// If body class was set in routes.php, set it
if(isset($params['body_class']) && is_string($params['body_class'])) {
  $context['body_class'] = $params['body_class'];
}

// Quicklinks
$context['campus_quicklinks'] = $post->get_field('quicklinks');
$context['campus_quicklinks']['calendar'] = $post->get_field('calendar');
$context['campus_quicklinks']['facebook'] = $post->get_field('facebook');

// Campus News
$news = getPosts( array(
  'post_type' => 'news',
	'mode' => true, // Auto
	'quantity' => 3,
  'feed_campus' => $params['location'],
));
if(isset($news) && is_array($news)) {
  $context['news'] = $news;
}

// Campus Events
$events = getPosts( array(
  'post_type' => 'event',
	'mode' => true, // Auto
	'quantity' => 2,
  'feed_campus' => $params['location'],
));
if(isset($events) && is_array($events)) {
  $context['events'] = $events;
}

// // Voices
// $voices = get_field('home_voices', 'option');
// $context['voices'] = array();
// foreach ($voices as $voice) {
//   $voice = Timber::get_post($voice);
//   array_push( $context['voices'], array(
//     'title' => $voice->title,
//     'campus' => $voice->get_terms('campus')[0]->name,
//     'alignment' => $voice->get_field('alignment'),
//     'quote' => $voice->get_field('quote'),
//     'info' => $voice->get_field('info'),
//     'photo' => $voice->get_field('photo'),
//     'image' => $voice->get_field('background'),
//     'link' => $voice->get_field('link')
//   ));
// }


// Generate breadcrumb. This is custom.
$context['breadcrumb'] = array();
array_push( $context['breadcrumb'], array(
  'title' => 'Our Campuses',
  'link' => $post->link
));

// Where are we going?
switch ($params['section']) {
  case 'details':
    Timber::render( 'campus/single-campus-details.twig' , $context );
    break;

  case 'facilities':
    $context['facilities_gallery'] = $post->get_field('facilities_gallery');
    $context['facilities_teaser'] = $post->get_field('facilities_teaser');
    Timber::render( 'campus/single-campus-facilities.twig' , $context );
    break;

  case 'welcome': // Welcome
    $context['photo'] = $post->get_field('photo');
    $context['message'] = $post->get_field('message');
    Timber::render( 'campus/single-campus-welcome.twig' , $context );
}
