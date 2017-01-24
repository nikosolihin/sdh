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

 // else if ( is_post_type_archive() ) {
 // 	$data['title'] = post_type_archive_title( '', false );
 // 	array_unshift( $templates, 'archive-' . get_post_type() . '.twig' );
 // }

global $params;
$context = Timber::get_context();

// Get acf from a separate page
$sermon_page = Timber::get_post('sermons');
$banner = $sermon_page->get_field('page_banner')['items'];
$context['page_banner'] = empty($banner) ? $context['404']['image'] : reset($banner)['large'];
$context['page_teaser'] = $sermon_page->get_field('page_teaser');

// If landing page
if ($params['taxonomy'] == '') {
  $context['subtitle'] = "Browse";
  $context['title'] = "All Sermons";
  Timber::render( 'pages/archive-sermon.twig', $context );
} else
// If taxonomy is series
if ($params['taxonomy'] == 'series') {
  // Get series
  $terms = Timber::get_terms('series', array('hide_empty' => 1 ));
  $context['series'] = array();
  foreach ($terms as $term) {
    array_push($context['series'], array(
      'id' => $term->id(),
      'title_text' => $term->title(),
      'link' => $term->link(),
      'meta' => $term->count() <= 1 ? $term->count()." Sermon" :  $term->count()." Sermons",
      'image' => reset($term->series_image['items'])['thumb'],
      'type' => 'promo',
      'overlay' => true
    ));
  }
  $context['subtitle'] = "Sermons By";
  $context['title'] = "Series";
  Timber::render( 'pages/archive-sermon-by-series.twig', $context );
} else
if ($params['taxonomy'] == 'speakers') {
  // Get speakers
  $terms = Timber::get_terms('speaker', array('hide_empty' => 1 ));
  $context['speakers'] = array();
  foreach ($terms as $term) {
    array_push($context['speakers'], array(
      'id' => $term->id(),
      'title' => $term->title(),
      'link' => $term->link(),
      'meta' => $term->count() <= 1 ? $term->count()." Sermon" :  $term->count()." Sermons",
      'photo' => reset($term->speaker_photo['items'])['thumb']
    ));
  }
  $context['subtitle'] = "Sermons By";
  $context['title'] = "Speaker";
  Timber::render( 'pages/archive-sermon-by-speaker.twig', $context );
}
