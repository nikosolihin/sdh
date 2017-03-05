<?php
/**
 * The template for displaying a single event
 */
$context = Timber::get_context();
$post = Timber::query_post();
$context['post'] = $post;
$context['acf'] = get_fields();
$gcal = $context['acf']['gcal'];

// For event, gcal description is the content
$context['acf']['description'] = $gcal['description'];

// Banner stuff
$context['acf']['banner_size'] = 'small';

// Get this event's campus
$campus = $post->get_terms('campus')[0];
$campus_id = $campus->id;
$context['campus'] = $campus->name;

// // What kind of event do we have?
// if (array_key_exists('date', $gcal['start'])) {
// 	// All day - just grab date, no time
// 	$start = date_create($gcal['start']['date']);
// 	$startDate = date_format($start, 'j F Y' );
// 	$end = date_create($gcal['end']['date']);
// 	$endDate = date_format($end, 'j F Y' );
//
// 	// End on the same day?
// 	if ($startDate == $endDate) {
// 		$context['event_date'] = $startDate;
// 	} else {
// 		$context['event_date'] = $startDate . " - " . $endDate;
// 	}
// }
// else if (array_key_exists('dateTime', $gcal['start'])) {
// 	// Range event
// 	$start = date_create($gcal['start']['dateTime']);
// 	$startDate = date_format($start, 'j F Y' );
// 	$startTime = date_format($start, 'H:i' );
// 	$end = date_create($gcal['end']['dateTime']);
// 	$endDate = date_format($end, 'j F Y' );
// 	$endTime = date_format($end, 'H:i' );
//
// 	// End on the same day?
// 	if ($startDate == $endDate) {
// 		$context['event_date'] = $startDate;
// 	} else {
// 		$context['event_date'] = $startDate . " - " . $endDate;
// 	}
// 	// Time
// 	$context['event_time'] = $startTime . " - " . $endTime;
// }
//
// // Is the event repeating?
// if (array_key_exists('children', $gcal)) {
// 	$context['event_children_date'] = array();
// 	$context['event_children_time'] = array();
// 	foreach ($gcal['children'] as $child) {
// 		if (array_key_exists('date', $child['start'])) {
// 			// All day - just grab date, no time
// 			$start = date_create($child['start']['date']);
// 			$startDate = date_format($start, 'j F Y' );
// 			$end = date_create($child['end']['date']);
// 			$endDate = date_format($end, 'j F Y' );
//
// 			// End on the same day?
// 			if ($startDate == $endDate) {
// 				array_push($context['event_children_date'], $startDate);
// 			} else {
// 				array_push($context['event_children_date'], $startDate . " - " . $endDate);
// 			}
// 		}
// 		else if (array_key_exists('dateTime', $child['start'])) {
// 			// Range event
// 			$start = date_create($child['start']['dateTime']);
// 			$startDate = date_format($start, 'j F Y' );
// 			$startTime = date_format($start, 'H:i' );
// 			$end = date_create($child['end']['dateTime']);
// 			$endDate = date_format($end, 'j F Y' );
// 			$endTime = date_format($end, 'H:i' );
//
// 			// End on the same day?
// 			if ($startDate == $endDate) {
// 				array_push($context['event_children_date'], $startDate);
// 			} else {
// 				array_push($context['event_children_date'], $startDate . " - " . $endDate);
// 			}
// 			// Time
// 			array_push($context['event_children_time'], $startTime . " - " . $endTime);
// 		}
// 	}
// }

// Get other upcoming events at this campus
$context['events'] = populateList( array(
	'mode' => true,
	'quantity' => 2,
	'post_type' => 'event',
	'feed_campus' => $campus_id,
	'exclude' => $post->id
));

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
