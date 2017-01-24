<?php
/**
 * The Template for displaying a single post type.
 *
 * @package  WordPress
 * @subpackage  Timber
 */

$context = Timber::get_context();
$post = Timber::query_post();
$context['post'] = $post;

// Get related posts in the series
$series = reset($post->terms('series'))->ID();
$args = array(
	'post_type' => 'sermon',
  'tax_query' => array(
		array(
			'taxonomy' => 'series',
			'field'    => 'term_id',
			'terms'    => $series,
		),
	),
	'post__not_in' => array( $post->ID() )
);
$related = Timber::get_posts($args);
$context['related'] = array();
foreach ($related as $item) {
	array_push($context['related'], array(
		'image' => reset(reset($item->get_field('sermon_image')))['thumb'],
		'title' => $item->title(),
		'date' => $item->date(),
		'link' => $item->link(),
		'teaser' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem pariatur provident eaque."
	));
}

// Get scriptures and format for API call to Biblia.com
$scripture = array();
foreach ($post->get_field('sermon_scripture') as $passage) {
	array_push($scripture, array(
		'title' => $passage['scripture_passage'],
		'body' => ''
	));
}

// Get main content
$context['content_rows'] = get_field('rows');

// Get cfs
$context['acf'] = array(
	'video' => $post->get_field('sermon_video'),
	'image' => reset(reset(get_field('sermon_image')))['large'],
	'speaker' => reset($post->terms('speaker'))->title(),
	'speaker_link' => reset($post->terms('speaker'))->link(),
	'speaker_bio' => reset($post->terms('speaker'))->description(),
	'speaker_photo' => reset(reset(reset($post->terms('speaker'))->speaker_photo))['thumb'],
	'series' => reset($post->terms('series'))->title(),
	'series_link' => reset($post->terms('series'))->link(),
	'series_children' => reset($post->terms('series'))->children(),
	'content' => $post->get_field('main_content'),
	'scriptures' => $scripture
);

Timber::render( 'pages/sermon-single.twig', $context );
