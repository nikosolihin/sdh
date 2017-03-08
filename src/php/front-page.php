<?php
/**
 * Description: Page template for home
 */
$context = Timber::get_context();

// Hero
$context['hero'] = get_field('hero', 'option');
$context['placeholder'] = get_field('hero_placeholder', 'option');

// News
$context['news'] = getPosts( array(
	'mode' => true, // Auto
	'quantity' => 4,
	'post_type' => 'news'
));

// Events
$context['events'] = getPosts( array(
	'mode' => true, // Auto
	'quantity' => 2,
	'post_type' => 'event'
));

Timber::render( 'page/front-page.twig' , $context );
