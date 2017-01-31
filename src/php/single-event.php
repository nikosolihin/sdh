<?php
/**
 * The template for displaying a single event
 */
$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['acf'] = get_fields();
$context['sections'] = $context['acf']['sections'];
$gcal = $context['acf']['gcal'];

// For event, gcal description is the teaser
$context['acf']['teaser'] = $gcal['description'];

// Get this event's category
$category = $post->get_terms('event_category')[0];
$context['category'] = array(
	'name' => $category->name,
	'color' => $category->category_color
);

// What kind of event do we have?
if (array_key_exists('date', $gcal['start'])) {
	// All day - just grab date, no time
	$start = date_create($gcal['start']['date']);
	$startDate = date_format($start, 'j F Y' );
	$end = date_create($gcal['end']['date']);
	$endDate = date_format($end, 'j F Y' );

	// End on the same day?
	if ($startDate == $endDate) {
		$context['event_date'] = $startDate;
	} else {
		$context['event_date'] = $startDate . " - " . $endDate;
	}
}
else if (array_key_exists('dateTime', $gcal['start'])) {
	// Range event
	$start = date_create($gcal['start']['dateTime']);
	$startDate = date_format($start, 'j F Y' );
	$startTime = date_format($start, 'H:i' );
	$end = date_create($gcal['end']['dateTime']);
	$endDate = date_format($end, 'j F Y' );
	$endTime = date_format($end, 'H:i' );

	// End on the same day?
	if ($startDate == $endDate) {
		$context['event_date'] = $startDate;
	} else {
		$context['event_date'] = $startDate . " - " . $endDate;
	}
	// Time
	$context['event_time'] = $startTime . " - " . $endTime;
}

// Is the event repeating?
if (array_key_exists('children', $gcal)) {
	$context['event_children_date'] = array();
	$context['event_children_time'] = array();
	foreach ($gcal['children'] as $child) {
		if (array_key_exists('date', $child['start'])) {
			// All day - just grab date, no time
			$start = date_create($child['start']['date']);
			$startDate = date_format($start, 'j F Y' );
			$end = date_create($child['end']['date']);
			$endDate = date_format($end, 'j F Y' );

			// End on the same day?
			if ($startDate == $endDate) {
				array_push($context['event_children_date'], $startDate);
			} else {
				array_push($context['event_children_date'], $startDate . " - " . $endDate);
			}
		}
		else if (array_key_exists('dateTime', $child['start'])) {
			// Range event
			$start = date_create($child['start']['dateTime']);
			$startDate = date_format($start, 'j F Y' );
			$startTime = date_format($start, 'H:i' );
			$end = date_create($child['end']['dateTime']);
			$endDate = date_format($end, 'j F Y' );
			$endTime = date_format($end, 'H:i' );

			// End on the same day?
			if ($startDate == $endDate) {
				array_push($context['event_children_date'], $startDate);
			} else {
				array_push($context['event_children_date'], $startDate . " - " . $endDate);
			}
			// Time
			array_push($context['event_children_time'], $startTime . " - " . $endTime);
		}
	}
}

// Get Sidebar
$inherit = ($context['acf']['inherit'] === 'true');
$sidebar = $post->get_field('sidebar_sections');
if ($inherit) {
	$order = $context['acf']['order'];
	$parents_sidebar = get_field('event_sidebar_sections', 'option');
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
	'title' => __('Events', 'saat'),
	'link' => $context['site']->url. '/' .'events'
));
$context['breadcrumb'] = array_reverse( $context['breadcrumb'] );

Timber::render( 'event/single-event.twig' , $context );
