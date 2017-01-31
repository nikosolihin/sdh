<?php
/**
 * Template Name: Without Sidebar
 * Description: Page template for sidebarless pages
 */
$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['acf'] = get_fields();
$context['sections'] = $context['acf']['sections'];
$context['no_sidebar'] = true;

// Generate breadcrumb. Must be last.
$context['breadcrumb'] = array();
while( $post->get_parent ) {
	$post = $post->get_parent();
	array_push( $context['breadcrumb'], array(
    'title' => $post->title,
    'link' => $post->link
  ));
}
$context['breadcrumb'] = array_reverse( $context['breadcrumb'] );

Timber::render( 'page/single-page.twig' , $context );
