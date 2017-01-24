<?php
/**
 * Search results page
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

$context = Timber::get_context();
$search = Timber::get_post('search');

// Get acf from a separate page
$context['page_banner'] = reset(reset($search->get_field('page_banner')))['large'];

$context['title'] = 'Search results for '. get_search_query();
$context['posts'] = Timber::get_posts();

Timber::render( 'pages/search.twig', $context );
