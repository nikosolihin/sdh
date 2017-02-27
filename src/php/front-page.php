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

Timber::render( 'page/front-page.twig' , $context );
