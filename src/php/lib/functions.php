<?php
//=============================================
// Add user role class to body tag.
// Used to hide zoneboard blocks for campus_manager role
//=============================================
if ( is_user_logged_in() ) {
  add_filter('body_class','add_role_to_body');
  add_filter('admin_body_class','add_role_to_body');
}
function add_role_to_body($classes) {
  $current_user = new WP_User(get_current_user_id());
  $user_role = array_shift($current_user->roles);
  if (is_admin()) {
    $classes .= 'role-'. $user_role;
  } else {
    $classes[] = 'role-'. $user_role;
  }
  return $classes;
}

//=============================================
// Remove classes from wp_list_pages
//=============================================
 function remove_page_class($wp_list_pages) {
	$pattern = '/current_page_[a-z]+/';
	$replace_with = 'is-Active';
  $first_phase = preg_replace($pattern, $replace_with, $wp_list_pages);

  $pattern = '/\<li class="page_item[^>]*(?=is-Active)/';
	$replace_with = '<li class="';
  $second_phase = preg_replace($pattern, $replace_with, $first_phase);

  $pattern = '/\<li class="page_item[^>]*>/';
	$replace_with = '<li>';
  $third_phase = preg_replace($pattern, $replace_with, $second_phase);

  $pattern = "/\<ul class='children[^>]*>/";
	$replace_with = '<ul class="List">';
	return preg_replace($pattern, $replace_with, $third_phase);
}
add_filter('wp_list_pages', 'remove_page_class');

//=========================================================
// Automatically generates new terms for the Campus taxonomy
// after each new Campus post type is created.
// Based off: http://brennaobrien.com/blog/2013/11/autopopulating-wordpress-taxonomies.html
//=========================================================
function create_campus_terms($post_id) {
  // only update terms if this is a campus post
  if ('campus' != get_post_type($post_id)) return;

  // don't create or update terms for system generated posts
  if (get_post_status($post_id) == 'auto-draft') return;

  // Grab the post title and slug to use as the new
  // or updated term name and slug
  $term_title = get_the_title($post_id);
  $term_slug = get_post($post_id)->post_name;

  // Check if a corresponding term already exists
  $existing_terms = get_terms('campus', array('hide_empty' => false));
  foreach($existing_terms as $term) {
    if ($term->description == "SDH " . $term_title . " campus") {
      //term already exists, so update it and we're done
      wp_update_term($term->term_id, 'campus', array(
        'name' => $term_title,
        'slug' => $term_slug
      ));
      return;
    }
  }

  // If not, this is a new post, so create a new term.
  wp_insert_term($term_title, 'campus', array(
    'slug' => $term_slug,
    'description' => "SDH " . $term_title . " campus"
  ));
}
//run the update function whenever a post is created or edited
add_action('save_post', 'create_campus_terms');

//=============================================
// Get post types
//=============================================
function getPosts($options) {
  $posts = array();
  $type = '';

  // Sets some defaults
  if (!array_key_exists('mode',$options)) {
    $options['mode'] = true;
  }
  if (!array_key_exists('quantity',$options)) {
    $options['quantity'] = -1;
  }

  // Which mode are we on?
  if ($options['mode']) {  // Automatic

    // Are we excluding any posts?
    $exclude = array();
    if (isset($options['exclude'])) {
      array_push($exclude, $options['exclude']);
    }

    // Set up basic wp_query args
    $args = array(
      'posts_per_page'=> $options['quantity'],
      'post_type'		  => $options['post_type'],
      'post__not_in'  => $exclude,
    );

    // If events, get upcoming posts instead of past
    if ($options['post_type'] == 'event') {
      $args['post_status'] = ['publish', 'future'];
      $args['order'] = 'ASC';
      $args['orderby'] = 'date';
      $today = getdate();
      $args['date_query'] = array(
        array( 'after'  => array(
          'year'        => $today['year'],
          'month'       => $today['mon'],
          'day'         => $today['mday']-1,
        ))
      );
    }

    // Add selected term ids
    if (isset($options['feed_campus'])) {
      $slug = $options['feed_campus'];
      $args['tax_query'] = array();
      array_push($args['tax_query'], array(
        'taxonomy'         => 'campus',
        'field'            => 'slug',
        'terms'            => $slug,
      ));
    }

    // Get the posts
    $posts = Timber::get_posts($args);
    $type = $options['post_type'];

  } else { // Manual

    // Get the posts and post type based of first element
    $posts = Timber::get_posts($options['manual_posts']);
    $type = $posts[0]->type->slug;

    // Check the rest of the posts for junks
    foreach ($posts as $key => $post) {
      if( $post->type->slug != $type ) {
        unset($posts[$key]);
      }
    }
  }

  // Discard excess info, depending on post types
  $filtered_posts = array();
  switch ($type) {
    case 'news':
      foreach ($posts as $post) {
        if(isset($post->get_terms('campus')[0]) && is_array($post->get_terms('campus')[0])) {
          $campus_name = $post->get_terms('campus')[0]->name;
        } else {
          $campus_name = __('Head Office', 'sdh');
        }

        array_push($filtered_posts, array(
          'title'       => $post->title,
          'link'        => $post->link,
          'date'        => $post->post_date,
          'campus'      => $campus_name,
          'teaser'      => $post->get_field('teaser'),
          'image'       => serveImage($post->get_field('image')),
        ));
      }
      break;
    case 'event':
      foreach ($posts as $post) {
        $gcal = filterEvent($post);
        array_push($filtered_posts, array(
          'title'       => $post->title,
          'link'        => $post->link,
          'date'        => $post->post_date,
          'campus'      => $post->get_terms('campus')[0]->name,
          'teaser'      => $gcal['description'],
          'location'    => $gcal['location'],
          'image'       => serveImage($post->get_field('image')),
          'time'        => $gcal['event_time'],
          'dateTime'    => $gcal
        ));
      }
      break;
  }
  return $filtered_posts;
}

//=============================================
// Filter Events
// This gets date & time based on repeats
//=============================================
function filterEvent($post) {
  $gcal = $post->get_field('gcal');
  $return = array();

  // Description
  $return['description'] = nl2br($gcal['description']);

  // Location
  $return['location'] = $gcal['location'];

  ///////////////////////////////////
  // What kind of event do we have?
  //
  // ALL DAY - just grab date, no time
  if (array_key_exists('date', $gcal['start'])) {
  	$start = date_create($gcal['start']['date']);
  	$startDate = date_format($start, 'j F Y' );
  	$end = date_create($gcal['end']['date']);
  	$endDate = date_format($end, 'j F Y' );

  	// End on the same day?
  	if ($startDate == $endDate) {
  		$return['event_date'] = $startDate;
  	} else {
  		$return['event_date'] = $startDate . " - " . $endDate;
  	}
  }
  // RANGE EVENT
  else if (array_key_exists('dateTime', $gcal['start'])) {
  	$start = date_create($gcal['start']['dateTime']);
  	$startDate = date_format($start, 'j F Y' );
  	$startTime = date_format($start, 'H:i' );
  	$end = date_create($gcal['end']['dateTime']);
  	$endDate = date_format($end, 'j F Y' );
  	$endTime = date_format($end, 'H:i' );

  	// End on the same day?
  	if ($startDate == $endDate) {
  		$return['event_date'] = $startDate;
  	} else {
  		$return['event_date'] = $startDate . " - " . $endDate;
  	}
  	// Time
  	$return['event_time'] = $startTime . " - " . $endTime;
  }

  ///////////////////////////////////
  // What kind of repeats do we have?
  //
  if (array_key_exists('children', $gcal)) {
  	$return['event_children_date'] = array();
  	$return['event_children_time'] = array();
  	foreach ($gcal['children'] as $child) {
  		if (array_key_exists('date', $child['start'])) {
  			// All day - just grab date, no time
  			$start = date_create($child['start']['date']);
  			$startDate = date_format($start, 'j F Y' );
  			$end = date_create($child['end']['date']);
  			$endDate = date_format($end, 'j F Y' );

  			// End on the same day?
  			if ($startDate == $endDate) {
  				array_push($return['event_children_date'], $startDate);
  			} else {
  				array_push($return['event_children_date'], $startDate . " - " . $endDate);
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
  				array_push($return['event_children_date'], $startDate);
  			} else {
  				array_push($return['event_children_date'], $startDate . " - " . $endDate);
  			}
  			// Time
  			array_push($return['event_children_time'], $startTime . " - " . $endTime);
  		}
  	}
  }
  return $return;
}

//=============================================
// Serve Image
//=============================================
function serveImage($image) {
  if(isset($image) && is_array($image)) {
    $base = $image['base']."s";
    $name = "/".$image['title'];
    $xs = $base . '576' . $name;
    $sm = $base . '800' . $name;
    $md = $base . '1024' . $name;
    $lg = $base . '1280' . $name;
    $xl = $base . '1440' . $name;
    $xxl = $base . '1600' . $name;
    return array(
      'xs' => $xs,
      'sm' => $sm,
      'md' => $md,
      'lg' => $lg,
      'xl' => $xl,
      'xxl' => $xxl,
    );
  }
}
function serveSquareImage($image) {
  if(isset($image) && is_array($image)) {
    $base = $image['base']."s";
    $name = "-c/".$image['title'];
    $xs = $base . '160' . $name;
    $sm = $base . '400' . $name;
    $md = $base . '640' . $name;
    $lg = $base . '800' . $name;
    return array(
      'xs' => $xs,
      'sm' => $sm,
      'md' => $md,
      'lg' => $lg,
    );
  }
}

//=============================================
// Return campus slugs for routes.php
//=============================================
function get_campuses() {
  $campuses = array();
  foreach (Timber::get_terms('campus') as $campus) {
    array_push($campuses, $campus->slug);
  }
  return $campuses;
}

//=============================================
// Set publish date according to
// Google Calendar start date
//=============================================
global $post;
global $wpdb;
function modify_event_date($post_id) {
  // Limit to only event post type
  if (get_post_type($post_id) == "event" && get_post_meta($post_id, 'gcal', true)) {
    $gcal = json_decode(get_post_meta($post_id, 'gcal', true), true);
    if (array_key_exists('dateTime', $gcal['start'])) {
      $datefield = $gcal['start']['dateTime'];
    } else {
      $datefield = $gcal['start']['date'];
    }
    date_default_timezone_set("Asia/Jakarta");
  	$post_date = date("Y-m-d H:i:s", strtotime($datefield));
  	$my_post = array();
  	$my_post['ID'] = $post_id;
  	$my_post['post_date'] = $post_date;
  	remove_action('save_post', 'modify_event_date');
    wp_update_post( $my_post );
  	add_action('save_post', 'modify_event_date');
  }
}
add_action('save_post', 'modify_event_date');

//=========================================================
// Wordpress is a blogging platform, which means
// some tweaking must be done to do upcoming future events.
// This forces scheduled post to published status.
// http://wordpress.stackexchange.com/a/132238
//=========================================================
remove_action('future_post', '_future_post_hook');
add_filter( 'wp_insert_post_data', 'nacin_do_not_set_posts_to_future' );

function nacin_do_not_set_posts_to_future( $data ) {
  if ( $data['post_status'] == 'future' && $data['post_type'] == 'event' )
    $data['post_status'] = 'publish';
  return $data;
}

//=============================================
// Remove the meta tag showing WP version
// Source: https://kinsta.com/blog/wordpress-security/
//=============================================
function wpversion_remove_version() {
  return '';
}
add_filter('the_generator', 'wpversion_remove_version');

//=============================================
// Localization
//=============================================
load_theme_textdomain( 'sdh', get_template_directory().'/languages' );
