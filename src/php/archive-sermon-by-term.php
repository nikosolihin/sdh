<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.2
 */

global $params;
$context = Timber::get_context();
$context['pagination'] = Timber::get_pagination();

// Get acf from a separate page
$sermon_page = Timber::get_post('sermons');
$context['page_banner'] = reset(reset($sermon_page->get_field('page_banner')))['large'];
$context['page_teaser'] = $sermon_page->get_field('page_teaser');
$context['page_subtitle'] = $sermon_page->get_field('page_subtitle');
$context['page_title'] = $sermon_page->title();

// Get needed fields for posts by this speaker or series
$posts = Timber::get_posts();
$context['posts'] = array();
foreach ($posts as $post) {
  array_push($context['posts'], array(
    'title' => $post->title(),
    'date' => $post->date(),
    'topic' => reset($post->terms('series'))->name,
    'link' => $post->link(),
  ));
}

// Customize title and subtitle to differentiate speakers and series
$context['subtitle'] = ($params['taxonomy'] == 'speakers') ? 'Sermons By': 'Browse';

if ($params['taxonomy'] == 'speakers') {
  $context['subtitle'] = "Sermons By";
  $context['title'] = get_term_by('slug', $params['name'], 'speaker')->name;
} else if ($params['taxonomy'] == 'series') {
  $context['subtitle'] = "Sermons In";
  $context['title'] = get_term_by('slug', $params['name'], 'series')->name;
}

Timber::render( 'pages/archive-sermon.twig', $context );
