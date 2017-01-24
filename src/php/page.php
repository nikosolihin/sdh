<?php
/**
 * The template for displaying all pages.
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

// Get page components
$banner = get_field('page_banner')['items'];
$context['page_banner'] = empty($banner) ? $context['404']['image'] : reset($banner)['large'];
$context['page_teaser'] = get_field('page_teaser');
$context['page_subtitle'] = get_field('page_subtitle');

// Is this post inheriting sidebar from parent?
if (get_field('sidebar_inherit') == 'yes') {
  $context['buttons'] = $post->get_parent()->get_field('sidebar_buttons');
  $context['blocks'] = array();
  $parent_blocks = $post->get_parent()->get_field('sidebar_blocks');
  if (is_array($parent_blocks)) {
    foreach ($parent_blocks as $block) {
      $block_item = new TimberPost($block);
      $image = $block_item->get_field('block_image')['items'];
      array_push($context['blocks'], array(
        'type' => $block_item->get_field('block_type'),
        'file' => $block_item->get_field('block_file'),
        'instruction' => $block_item->get_field('block_instruction'),
        'icon' => $block_item->get_field('block_icon'),
        'overlay' => $block_item->get_field('block_tint'),
        'title_text' => $block_item->get_field('block_title_text'),
        'link' => $block_item->get_field('block_link'),
        'image' => empty($image) ? $context['404']['image'] : reset($image)['thumb'],
        'button' => $block_item->get_field('block_button'),
        'button_type' => $block_item->get_field('block_button_type'),
        'button_label' => $block_item->get_field('block_button_label')
      ));
    }
  }
} else {
  // Get sidebar buttons
  $context['buttons'] = get_field('sidebar_buttons');
  // Get sidebar blocks if set
  $context['blocks'] = array();
  $blocks = get_field('sidebar_blocks');
  if (is_array($blocks)) {
    foreach ($blocks as $block) {
      $block_item = new TimberPost($block);
      $image = $block_item->get_field('block_image')['items'];
      array_push($context['blocks'], array(
        'type' => $block_item->get_field('block_type'),
        'file' => $block_item->get_field('block_file'),
        'instruction' => $block_item->get_field('block_instruction'),
        'icon' => $block_item->get_field('block_icon'),
        'overlay' => $block_item->get_field('block_tint'),
        'title_text' => $block_item->get_field('block_title_text'),
        'link' => $block_item->get_field('block_link'),
        'image' => empty($image) ? $context['404']['image'] : reset($image)['thumb'],
        'button' => $block_item->get_field('block_button'),
        'button_type' => $block_item->get_field('block_button_type'),
        'button_label' => $block_item->get_field('block_button_label')
      ));
    }
  }
}

// Get main content
$context['content_rows'] = get_field('rows');

// Generate hierarchy
// This will change $post, so do this last
$context['hierarchy'] = array();
while ($post != 0) {
  $children = array();
  foreach ($post->get_children() as $child) {
    array_push($children, array(
      'id' => $child->id(),
      'title' => $child->title(),
      'link' => $child->link()
    ));
  }
  array_push($context['hierarchy'], array(
    'id' => $post->id(),
    'title' => $post->title(),
    'link' => $post->link(),
    'children' => $children
  ));
  $post = $post->get_parent();
}
$context['hierarchy'] = array_reverse($context['hierarchy']);

// Generate breadcrumb
$context['breadcrumb'] = array();
foreach ($context['hierarchy'] as $item) {
  array_push($context['breadcrumb'], array(
    'title' => $item['title'],
    'link' => $item['link']
  ));
}
$context['breadcrumb'] = array_splice($context['breadcrumb'], 0, -1);

// Generate sidebar
function reducer($carry, $item) {
  if ($carry == NULL) {
    $carry = $item;
  }
  foreach($item['children'] as $key => $value) {
    if($value['id'] == $carry['id']){
      unset($item['children'][$key]);
      $item['children'][$key] = $carry;
    }
  }
  return $carry = $item;
}
$context['sidebar']['list'] = array_reduce(array_reverse($context['hierarchy']), "reducer");

Timber::render( 'pages/page.twig', $context );
