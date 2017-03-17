<?php
/**
 * The template for displaying a single news
 */
$context = Timber::get_context();
$post = Timber::query_post();
$context['post'] = $post;
$context['acf'] = get_fields();
$context['sections'] = $context['acf']['sections'];
$image = $context['acf']['image'];

// Default teaser
if ($context['acf']['teaser'] == '') {
	$context['acf']['teaser'] = $context['org']['description'];
}

// Default image
if(isset($image) && is_array($image)) {
	$context['image'] = $image;
} else {
	$context['image'] = false;
}

// Get this event's campus
$campus = $post->get_terms('campus')[0];
$context['campus'] = $campus->name;

// Get Sidebar
$inherit = $context['acf']['inherit'];
$sidebar = $post->get_field('sidebar_sections');
if ($inherit) {
	$order = $context['acf']['order'];
	$parents_sidebar = get_field('news_sidebar', 'option')['sidebar_sections'];
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

// Generate breadcrumb. Must be last.
// Breadcrumb for news
$context['breadcrumb'] = array();
array_push( $context['breadcrumb'], array(
	'title' => __('News', 'sdh'),
	'link' => $context['site']->url. '/' .'news'
));
$context['breadcrumb'] = array_reverse( $context['breadcrumb'] );

Timber::render( 'news/single-news.twig' , $context );
