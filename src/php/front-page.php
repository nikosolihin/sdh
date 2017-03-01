<?php
/**
 * Description: Page template for home
 */
$context = Timber::get_context();

// Hero
$context['hero'] = get_field('hero', 'option');
$context['placeholder'] = get_field('hero_placeholder', 'option');

// News
$news_args = 'post_type=news&numberposts=4&orderby=date&order=desc';
$news = Timber::get_posts($news_args);
$context['news'] = array();
foreach ($news as $item) {
  array_push( $context['news'], array(
    'title' => $item->title,
    'campus' => $item->get_terms('campus')[0],
    'date' => $item->post_date,
    'link' => $item->link
  ));
}

// Events
// $event_args = 'post_type=event&numberposts=4&orderby=date&order=desc';
// $events = Timber::get_posts($news_args);
// $context['events'] = array();
// foreach ($events as $item) {
//   array_push( $context['events'], array(
//     'title' => $item->title,
//     'date' => $item->post_date,
//     'link' => $item->link
//   ));
// }

// Voices
$voices = get_field('home_voices', 'option');
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

Timber::render( 'page/front-page.twig' , $context );
