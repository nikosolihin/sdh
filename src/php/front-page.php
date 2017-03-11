<?php
/**
 * Description: Page template for home
 */
$context = Timber::get_context();

// Hero
$context['hero'] = get_field('hero', 'option');
$context['placeholder'] = get_field('hero_placeholder', 'option');

// Blocks - Only mobile
$context['home_blocks'] = get_field('home_blocks', 'option');

// News
$context['news'] = array(
  'post_type' => 'news',
  'quantity' => 4,
  'news_metadata' => array('date','campus'),
);

// Campus Events
$context['events'] = array(
  'post_type' => 'event',
  'quantity' => 3,
  'event_metadata' => array('date','campus'),
  'style' => 'object',
);

Timber::render( 'page/front-page.twig' , $context );
