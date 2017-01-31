<?php
/**
 * The template for displaying a single news
 */
$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['acf'] = get_fields();
$context['sections'] = $context['acf']['sections'];

// Get Sidebar
$inherit = ($context['acf']['inherit'] === 'true');
$sidebar = $post->get_field('sidebar_sections');
if ($inherit) {
	$order = $context['acf']['order'];
	$parents_sidebar = get_field('news_sidebar_sections', 'option');
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

// Get Authors
if ($post->get_field('authors')) {
	$context['authors'] = array();
	foreach ($post->get_field('authors') as $author) {
		array_push($context['authors'], $author->name);
	}
	$context['authors'] = implode(", ", $context['authors']);
}

// Get topic
if ($post->get_terms('news_topic')) {
	$context['topic'] = array(
		'slug'	=> $post->get_terms('news_topic')[0]->slug,
		'name'	=> $post->get_terms('news_topic')[0]->name
	);
}

// Generate breadcrumb. Must be last.
// Breadcrumb for news
$context['breadcrumb'] = array();
array_push( $context['breadcrumb'], array(
	'title' => __('News', 'saat'),
	'link' => $context['site']->url. '/' .'news'
));
$context['breadcrumb'] = array_reverse( $context['breadcrumb'] );

Timber::render( 'news/single-news.twig' , $context );
