<?php
/**
 * Description: Page template for default pages
 */
$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['acf'] = get_fields();
$context['sections'] = $context['acf']['sections'];
$context['toc'] = $post->get_field('toc');
$context['with_toc_block'] = $post->get_field('toc_block');

// Get TOC block if set
if ($context['with_toc_block']) {
	$context['toc_block'] = array();
	$block = Timber::get_post($context['with_toc_block']);
	$context['toc_block']['alignment'] = $post->get_field('toc_block_alignment');
	$context['toc_block']['title'] = $block->title;
	$link_type = $block->get_field('type');
	if ($link_type == "single") {
		$context['toc_block']['link'] = $block->get_field('single_url');
	} elseif ($link_type == "external") {
		$context['toc_block']['link'] = $block->get_field('external_url');
	} else {
		$context['toc_block']['link'] = $block->get_field('search_url');
	}
	$image = $block->get_field('image');
	if(isset($image) && is_array($image)) {
		$context['toc_block']['image'] = serveImage($image);
	} else {
		$context['toc_block']['image'] = $context['fallback']['image'];
	}
}

// Get Sidebar
$inherit = ($context['acf']['inherit']);
$sidebar = $post->get_field('sidebar_sections');
if ($inherit) {
	$order = $context['acf']['order'];
	$parent = $post->get_parent();
	$parents_sidebar = $parent->get_field('sidebar_sections');
	if ($parents_sidebar) {
		if ($sidebar) {
			$context['sidebar_sections'] = $order == 'parent' ? array_merge($parents_sidebar, $sidebar) : array_merge($sidebar, $parents_sidebar);
		} else {
			$context['sidebar_sections'] = $parents_sidebar;
		}
	} else {
		$context['sidebar_sections'] = $sidebar;
	}
} else {
	$context['sidebar_sections'] = $sidebar;
}

// Find root ID - For sidebar TOC
if ($post->post_parent)	{
	$ancestors = get_post_ancestors($post->id);
	$id = $ancestors[ count($ancestors)-1 ];
} else {
	$id = $post->id;
}
// and generate hierarchy
$args = array(
  'child_of' => $id,
  'echo' => false,
  'title_li' => null
);
$context['hierarchy'] = wp_list_pages($args);

// Generate breadcrumb. Must be last.
$context['breadcrumb'] = array();
while( $post->get_parent ) {
	$post = $post->get_parent();
	array_push( $context['breadcrumb'], array(
    'title' => $post->title,
    'link' => $post->link
  ));
}
$context['breadcrumb'] = array_reverse( $context['breadcrumb'] );

if(isset($context['breadcrumb'][0]) && is_array($context['breadcrumb'][0])) {
	if($context['breadcrumb'][0]['title'] == 'Stories') {
		$context['is_stories'] = true;
	}
}

Timber::render( 'page/single-page.twig' , $context );
