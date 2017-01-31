<?php
/**
 * Template Name: Landing Page
 * Description: Page template for landing page
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['acf'] = get_fields();
$context['sections'] = $context['acf']['sections'];
$context['children'] = array();
$exception = $post->get_field('landing_layout_exception');

foreach ($post->get_children() as $child) {
  // Skip if this page in the exception list
  if ($exception && in_array($child->id, $exception)) {
    continue;
  }
  $grandchildren = array();
  if ( $context['acf']['landing_layout'] == "extensive" ) {
    //Extensive. Fetch all children and grand children
    foreach ($child->get_children() as $grandchild) {
      array_push($grandchildren, array(
        'title' => $grandchild->title(),
        'link' => $grandchild->link()
      ));
    }
  }
  // And their teaser images.
  array_push($context['children'], array(
    'title' => $child->title(),
    'link' => $child->link(),
    'teaser' => $child->get_field('teaser'),
    'image' => $child->get_field('image'),
    'children' => $grandchildren
  ));
}
Timber::render( 'page/landing-page.twig' , $context );
