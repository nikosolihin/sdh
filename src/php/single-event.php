<?php
/**
 * The template for displaying a single event
 */
$context = Timber::get_context();
$post = Timber::query_post();
$context['post'] = $post;
$context['acf'] = get_fields();
$context['gcal'] = filterEvent($post);
$context['og_desc'] = preg_replace('/\s+/', ' ', strip_tags(substr($context['gcal']['description'], 0, 300)));

// Banner stuff
$context['acf']['banner_size'] = 'small';

// Get this event's campus
$campus = $post->get_terms('campus')[0];
$context['campus'] = $campus->name;

// Get other upcoming events at this campus
$context['events'] = array(
  'post_type' => 'event',
  'quantity' => 2,
  'feed_campus' => $campus->slug,
  'event_metadata' => array('date'),
	// 'exclude' => $post->id,
  'style' => 'object',
);

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
// Breadcrumb for events
$context['breadcrumb'] = array();
array_push( $context['breadcrumb'], array(
	'title' => __('Events', 'sdh'),
	'link' => $context['site']->url. '/' .'events'
));
$context['breadcrumb'] = array_reverse( $context['breadcrumb'] );

Timber::render( 'event/single-event.twig' , $context );
