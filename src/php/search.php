<?php
$context = Timber::get_context();
$context['wp_title'] = __('Search', 'sdh');

// Get search engine ID based on locale
switch (get_locale()) {
	case "en_US":
		$context['gcse_id'] = get_field('search_en_id', 'option');
		break;
	case "id_ID":
		$context['gcse_id'] = get_field('search_id_id', 'option');
		break;
	default:
		$context['gcse_id'] = get_field('search_id_id', 'option');
}

// Get Sidebar
$search_sidebar = get_field('sidebar_sections', 'option');
if ($search_sidebar) {
	$context['sidebar_sections'] = $search_sidebar;
}

// Generate breadcrumb. Must be last.
// Breadcrumb for search
$context['breadcrumb'] = array();
array_push( $context['breadcrumb'], array(
	'title' => __('Search', 'sdh'),
	'link' => $context['site']->url. '/' .'search'
));
$context['breadcrumb'] = array_reverse( $context['breadcrumb'] );

Timber::render( 'page/search.twig', $context );
