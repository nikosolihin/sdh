<?php
/**
 * Template Name: Voice Page
 * Description: Page template for testimonies
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['acf'] = get_fields();
$context['sections'] = $context['acf']['sections'];
$context['children'] = false;
$context['is_voice'] = true;

// Voices
$voices = $post->get_field('voices');
$context['voices'] = array();
foreach ($voices as $voice) {
  $voice = Timber::get_post($voice);
  array_push( $context['voices'], array(
    'title' => $voice->title,
    'campus' => $voice->get_terms('campus')[0]->name,
    'alignment' => $voice->get_field('alignment'),
    'quote' => $voice->get_field('quote'),
    'info' => $voice->get_field('info'),
    'photo' => $voice->get_field('photo'),
    'image' => $voice->get_field('background'),
    'link' => $voice->get_field('link')
  ));
}

Timber::render( 'page/landing-page.twig' , $context, 600, TimberLoader::CACHE_SITE_TRANSIENT );
