<?php
/**
 * The template for displaying front page.
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::get_context();
$post = new TimberPost();

// Get hero items
$heroes = $post->get_field('home_hero');
$context['heroes'] = array();
foreach ($heroes as $hero) {
  array_push($context['heroes'], array(
    'image' => reset(reset($hero['home_hero_image']))['large'],
    'title' => $hero['home_hero_title'],
    'label' => $hero['home_hero_label'],
    'link' => $hero['home_hero_link']
  ));
}

// Get promo blocks
$blocks = $post->get_field('home_blocks');
$context['blocks'] = array();
foreach ($blocks as $block) {
  $block_item = Timber::get_post($block['block']);
  array_push($context['blocks'], array(
    'type' => $block_item->get_field('block_type'),
    'file' => $block_item->get_field('block_file'),
    'instruction' => $block_item->get_field('block_instruction'),
    'icon' => $block_item->get_field('block_icon'),
    'overlay' => $block_item->get_field('block_tint'),
    // 'title' => $block_item->get_field('block_title'),
    'title_text' => $block_item->get_field('block_title_text'),
    'link' => $block_item->get_field('block_link'),
    'image' => reset(reset($block_item->get_field('block_image')))['thumb'],
    'button' => $block_item->get_field('block_button'),
    'button_type' => $block_item->get_field('block_button_type'),
    'button_label' => $block_item->get_field('block_button_label')
  ));
}

// Get recent news
$recent_news_args = array(
  'post_type' => 'news',
  'numberposts' => $post->get_field('home_recent_news'),
  'order' => DESC,
  'orderby' => 'date'
);
$context['recent_news'] = array();
$recent_news = Timber::get_posts($recent_news_args);
foreach ($recent_news as $recent_news_item) {
  array_push($context['recent_news'], array(
    'title' => $recent_news_item->title(),
    'link' => $recent_news_item->link(),
    'date' => $recent_news_item->date()
  ));
}

// Get upcoming events
$upcoming_events_args = array(
  'post_type' => 'event',
  'numberposts' => 3,
  'meta_query' => array(
    'relation' => 'OR',
    array(
      'key'		     => 'start_date',
      'compare'	   => '>=',
      'value'		   => date('Ymd')
    ),
    array(
      'key'		     => 'end_date',
      'compare'	   => '>=',
      'value'		   => date('Ymd')
    )
  ),
  'order' => ASC,
  'orderby' => 'start_date'
);
$context['upcoming_events'] = array();
$upcoming_events = Timber::get_posts($upcoming_events_args);
foreach ($upcoming_events as $upcoming_event) {
  array_push($context['upcoming_events'], array(
    'type' => 'promo',
    'title' => true,
    'title_text' => $upcoming_event->title(),
    'link' => $upcoming_event->link(),
    'image' => reset(reset($upcoming_event->get_field('event_image')))['thumb'],
    'date' => date_format(date_create_from_format('mdY', $upcoming_event->get_field('start_date')), 'M j, Y')
  ));
}

// Get latest sermon
$latest_sermon = Timber::get_post('post_type=sermon&numberposts=1&orderby=date&order=DESC');
$context['latest_sermon'] = array(
  'title' => $latest_sermon->title(),
  'link' => $latest_sermon->link(),
  'date' => $latest_sermon->date(),
  'blurb' => $latest_sermon->get_field('sermon_blurb'),
  'image' => reset(reset($latest_sermon->get_field('sermon_image')))['thumb'],
  'speaker' => reset($latest_sermon->terms('speaker'))->title(),
  'speaker_link' => reset($latest_sermon->terms('speaker'))->link(),
  'series' => reset($latest_sermon->terms('series'))->title(),
  'series_link' => reset($latest_sermon->terms('series'))->link()
);

// Get newsletter
$context['newsletter'] = array(
  'image' => reset(reset($post->get_field('home_news_image')))['large'],
  'signup_title' => $post->get_field('home_signup_title'),
  'signup_blurb' => $post->get_field('home_signup_blurb'),
  'archive_title' => $post->get_field('home_past_title'),
  'archive_blurb' => $post->get_field('home_past_description'),
  'archive_link' => $post->get_field('home_past_link')
);

Timber::render( 'pages/front-page.twig' , $context );
