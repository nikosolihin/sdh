<?php
/**
 * Template Name: Landing Page
 * Description: Page template for landing pages
 */

$context = Timber::get_context();
$post = new TimberPost();

// Get page components
$banner = get_field('page_banner')['items'];
$context['page_banner'] = empty($banner) ? $context['404']['image'] : reset($banner)['large'];
$context['page_teaser'] = get_field('page_teaser');
$context['page_subtitle'] = get_field('page_subtitle');

$context['post'] = array(
  'title' => $post->title(),
);

// Landing pages are assumed to not have parents, so get children
$context['children'] = array();
foreach ($post->get_children() as $child) {
  array_push($context['children'], array(
    'title' => $child->title(),
    'link' => $child->link(),
    'teaser' => $child->get_field('page_teaser'),
    'image' => empty($child->get_field('page_banner')['items'])?$context['404']['image']:reset($child->get_field('page_banner')['items'])['thumb']
  ));
}

Timber::render( 'pages/page-template_name.twig' , $context );
