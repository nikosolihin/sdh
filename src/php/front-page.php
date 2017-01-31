<?php
/**
 * Description: Page template for home
 */
$context = Timber::get_context();

// // Hero
// $context['hero'] = get_field('hero', 'option');
//
// // Prospective Section
// $context['prospective'] = array(
//   'statement' => get_field('prospective_statement', 'option'),
//   'cta' => get_field('prospective_cta', 'option'),
//   'cta_type' => get_field('prospective_cta_link_type', 'option'),
//   'cta_single_url' => get_field('prospective_cta_link_single_url', 'option'),
//   'cta_external_url' => get_field('prospective_cta_link_external_url', 'option'),
//   'cta_search_url' => get_field('prospective_cta_link_search_url', 'option'),
//   'image' => get_field('prospective_bg', 'option'),
//   'label' => get_field('prospective_cta_label', 'option'),
//   'links' => get_field('prospective_links', 'option'),
// );
//
// // Welcome Video
// $context['welcome'] = array(
//   'quote' => get_field('welcome_quote', 'option'),
//   'byline' => get_field('welcome_by', 'option'),
//   'url' => get_field('welcome_video', 'option')
// );
//
// // News & Events
// $news_events = Timber::get_posts(get_field('stream_news_events', 'option'));
// if ($news_events) {
//   $news_events = array_slice($news_events, 0, 3);
//   $context['news_events'] = array();
//   foreach ($news_events as $post) {
//     array_push($context['news_events'], array(
//       'title' => $post->title,
//       'link' => $post->link,
//       'type' => $post->type->slug,
//       'image' => $post->get_field('image'),
//       'date' => $post->post_date
//     ));
//   }
//   $context['news_events']['first'] = array_slice($context['news_events'], 0, 1)[0];
//   $context['news_events']['rest'] = array_slice($context['news_events'], 1, 2);
// }
//
// // Custom Posts
// $custom = Timber::get_posts(get_field('stream_custom_posts', 'option'));
// if ($custom) {
//   $custom = array_slice($custom, 0, 3);
//   $context['custom_posts'] = array();
//   foreach ($custom as $post) {
//     // If of page post type, get root parent's name
//     $parent = array();
//     if ($post->type->slug == 'page') {
//       $clone = $post;
//       while( $clone->get_parent ) {
//       	$clone = $clone->get_parent();
//       	array_push( $parent, array(
//           'title' => $clone->title
//         ));
//       }
//       $parent = array_reverse($parent)[0];
//     }
//     array_push($context['custom_posts'], array(
//       'title' => $post->title,
//       'link' => $post->link,
//       'type' => $post->type->slug,
//       'image' => $post->get_field('image'),
//       'parent' => $parent,
//       'date' => $post->post_date
//     ));
//   }
// }
//
// // Stream Media Box
// $media = Timber::get_post(get_field('stream_media', 'option'));
// if ($media) {
//   $context['media'] = array(
//     'title' => $media->title,
//     'link' => $media->link,
//     'type' => $media->get_terms('media_type')[0]->slug,
//     'name' => $media->get_terms('media_type')[0]->name,
//     'archive' => $context['site']->url. '/' .'media',
//     'teaser' => $media->get_field('teaser'),
//     'image' => $media->get_field('image'),
//   );
// }
//
// // Custom Control Area
// $context['control_cta'] = array(
//   'description' => get_field('stream_custom_description', 'option'),
//   'buttons' => get_field('stream_custom_buttons', 'option'),
//   'image' => get_field('stream_custom_bg', 'option'),
// );
//
// // Blocks Carousel
// $context['carousel'] = get_field('home_carousel_blocks', 'option');

Timber::render( 'page/front-page.twig' , $context );
