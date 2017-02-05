<?php
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

// //=============================================
// // Edit links for wp_list_categories to work
// // with our ajax search.
// // By default the event_category taxonomy returns
// // events/?utf8=✓&page=1&categories=/academic/
// // this hook removes the slashes.
// //=============================================
// function edit_category_links($wp_list_categories) {
//   $pattern = "/\/[^\/]+\/\"/";
//   $remove_slashes = preg_replace_callback( $pattern,
//     function($matches) {
//       $value = str_replace('/', '', $matches[0]);
//       return $value;
//     }, $wp_list_categories );
//
//   $pattern = "/\<ul class='children[^>]*>/";
//   $replace_with = '<ul class="List">';
//   return preg_replace($pattern, $replace_with, $remove_slashes);
// }
// add_filter('wp_list_categories', 'edit_category_links');
//
// //=============================================
// // Feed component
// //=============================================
// function populateList($options) {
//
//   $posts = array();
//   $type = '';
//
//   // Which mode are we on?
//   if ($options['mode'] == 'automatic') {
//
//     // Media is actually resource, so call it that
//     if ($options['post_type'] == 'media') {
//       $options['post_type'] = 'resource';
//     }
//
//     // Set up basic wp_query args
//     $args = array(
//       'numberposts'	=> $options['quantity'],
//       'post_type'		=> $options['post_type'],
//     );
//
//     // Get tax ids for the chosen post type
//     switch ($options['post_type']) {
//       case 'event':
//         $tax = 'event_category';
//         $term_ids = $options['event_categories'];
//         // $metadata = $options['event_metadata'];
//
//         // If events, get upcoming posts instead of recent
//         $args['post_status'] = ['publish', 'pending', 'draft', 'auto-draft', 'future'];
//         $args['order'] = 'ASC';
//         $today = getdate();
//         $args['date_query'] = array(
//           array( 'after'  => array(
//             'year'        => $today['year'],
//             'month'       => $today['mon'],
//             'day'         => $today['mday'],
//           ))
//         );
//         break;
//       case 'news':
//         $tax = 'news_topic';
//         $term_ids = $options['news_topics'];
//         break;
//       case 'resource':
//         $tax = 'media_category';
//         $term_ids = $options['media_categories'];
//         break;
//       case 'person':
//         $tax = 'role';
//         $term_ids = $options['roles'];
//         $args['orderby'] = 'title';
//         $args['order'] = 'ASC';
//         break;
//     }
//
//     // Add selected term ids
//     $args['tax_query'] = array( 'relation' => 'AND', );
//     array_push($args['tax_query'], array(
//       'taxonomy'         => $tax,
//       'field'            => 'term_id',
//       'terms'            => $term_ids,
//     ));
//
//     // Get the posts
//     $posts = Timber::get_posts($args);
//     $type = $options['post_type'];
//
//   } else { // Manual
//
//     // Get the posts and post type based of first element
//     $posts = Timber::get_posts($options['manual_posts']);
//     $type = $posts[0]->type->slug;
//
//     // Check the rest of the posts for junks
//     foreach ($posts as $key => $post) {
//       if( $post->type->slug != $type ) {
//         unset($posts[$key]);
//       }
//     }
//   }
//
//   // Discard excess info, depending on post types
//   $filtered_posts = array();
//   switch ($type) {
//     case 'event':
//       foreach ($posts as $post) {
//         array_push($filtered_posts, array(
//           'title'       => $post->title,
//           'link'        => $post->link,
//           'date'        => $post->post_date,
//           'term'        => $post->get_terms('event_category')[0]->name,
//           'teaser'      => $post->get_field('gcal')['description'],
//           'image'       => $post->get_field('image'),
//         ));
//       }
//       break;
//     case 'news':
//       foreach ($posts as $post) {
//         array_push($filtered_posts, array(
//           'title'       => $post->title,
//           'link'        => $post->link,
//           'date'        => $post->post_date,
//           'topic'       => $post->get_terms('news_topic')[0]->name,
//           'teaser'      => $post->get_field('teaser'),
//           'image'       => $post->get_field('image'),
//         ));
//       }
//       break;
//     case 'resource':
//       foreach ($posts as $post) {
//         array_push($filtered_posts, array(
//           'title'       => $post->title,
//           'link'        => $post->link,
//           'type'        => $post->get_terms('media_type')[0]->name,
//           'icon'        => $post->get_terms('media_type')[0]->slug,
//           'category'    => $post->get_terms('media_category')[0]->name,
//           'teaser'      => $post->get_field('teaser'),
//           'image'       => $post->get_field('image'),
//         ));
//       }
//       break;
//     case 'person':
//       foreach ($posts as $post) {
//         array_push($filtered_posts, array(
//           'name'        => $post->name,
//           'email'       => $post->get_field('email'),
//           'bio'         => $post->get_field('bio'),
//           'bio_title'   => $post->get_field('bio_title'),
//           'title'       => $post->get_field('title'),
//           'phone'       => $post->get_field('phone'),
//           'photo'       => $post->get_field('image'),
//           'facebook'    => $post->get_field('facebook'),
//           'twitter'     => $post->get_field('twitter'),
//           'instagram'   => $post->get_field('instagram'),
//         ));
//       }
//       break;
//   }
//   return $filtered_posts;
// }
//
// //================================================
// // Set default terms for each custom taxonomies based on locale
// // http://www.billerickson.net/code/default-term-for-taxonomy/
// //================================================
// function set_default_object_terms( $post_id, $post ) {
// 	if ( 'publish' === $post->post_status ) {
//     $defaults = array(
//       'event_category' => array('uncategorized'),
//       'news_topic' => array('uncategorized'),
//       'media_category' => array('uncategorized'),
//       'role' => array('uncategorized'),
//     );
// 		$taxonomies = get_object_taxonomies( $post->post_type );
// 		foreach ( (array) $taxonomies as $taxonomy ) {
// 			$terms = wp_get_post_terms( $post_id, $taxonomy );
// 			if ( empty( $terms ) && array_key_exists( $taxonomy, $defaults ) ) {
// 				wp_set_object_terms( $post_id, $defaults[$taxonomy], $taxonomy );
// 			}
// 		}
// 	}
// }
// add_action( 'save_post', 'set_default_object_terms', 100, 2 );
//
// //=============================================
// // Set publish date according to
// // Google Calendar start date
// //=============================================
// global $post;
// global $wpdb;
// function modify_event_date($post_id) {
//   // Limit to only event post type
//   if (get_post_type($post_id) == "event" && get_post_meta($post_id, 'gcal', true)) {
//     $gcal = json_decode(get_post_meta($post_id, 'gcal', true), true);
//     if (array_key_exists('dateTime', $gcal['start'])) {
//       $datefield = $gcal['start']['dateTime'];
//     } else {
//       $datefield = $gcal['start']['date'];
//     }
//     date_default_timezone_set("Asia/Jakarta");
//   	$post_date = date("Y-m-d H:i:s", strtotime($datefield));
//   	$my_post = array();
//   	$my_post['ID'] = $post_id;
//   	$my_post['post_date'] = $post_date;
//   	remove_action('save_post', 'modify_event_date');
//     wp_update_post( $my_post );
//   	add_action('save_post', 'modify_event_date');
//   }
// }
// add_action('save_post', 'modify_event_date');
//
// //=========================================================
// // Wordpress is a blogging platform, which means
// // some tweaking must be done to do upcoming future events.
// // This forces scheduled post to published status.
// // http://wordpress.stackexchange.com/a/132238
// //=========================================================
// remove_action('future_post', '_future_post_hook');
// add_filter( 'wp_insert_post_data', 'nacin_do_not_set_posts_to_future' );
//
// function nacin_do_not_set_posts_to_future( $data ) {
//   if ( $data['post_status'] == 'future' && $data['post_type'] == 'event' )
//     $data['post_status'] = 'publish';
//   return $data;
// }
//
// //=============================================
// // Remove the meta tag showing WP version
// // Source: https://kinsta.com/blog/wordpress-security/
// //=============================================
// function wpversion_remove_version() {
//   return '';
// }
// add_filter('the_generator', 'wpversion_remove_version');
//
// //=============================================
// // List Component
// //=============================================
// function listTerms($tax) {
//   return wp_list_categories(array(
//     'taxonomy'    => $tax,
//     'title_li'    => '',
//     'hide_empty'  => false,
//     'echo'        => false,
//   ));
// }
//
// //=============================================
// // Get/Set view count
// //=============================================
// function getPostViews($postID) {
//   $count_key = 'post_views_count';
//   $count = get_post_meta($postID, $count_key, true);
//   if( $count == '' ){
//     $count = 0;
//     delete_post_meta($postID, $count_key);
//     add_post_meta($postID, $count_key, $count);
//   }
//   return (int)$count;
// }
// function setPostViews($postID) {
//   session_start();
//   $count_key = 'post_views_count';
//   $count = get_post_meta($postID, $count_key, true);
//   if( $count == '' ){
//     $count = 0;
//     delete_post_meta($postID, $count_key);
//     add_post_meta($postID, $count_key, $count);
//   } else {
//     if( !isset($_SESSION['post_views_count-' . $postID]) ) {
//       $_SESSION['post_views_count-'. $postID] = "si";
//       $count++;
//       update_post_meta($postID, $count_key, $count);
//     }
//   }
// }
// // Remove issues with prefetching adding extra views
// remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
//
// //=============================================
// // Localization
// //=============================================
// load_theme_textdomain( 'saat', get_template_directory().'/languages' );
