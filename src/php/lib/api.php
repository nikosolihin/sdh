<?php
/**
 * Grab all events in a single month
 *
 * @param array $data URL params
 * @return JSON json encoded list of events
 */
function get_events( $data ) {
  $events = array();

  // Pad single digit months
  $padded_month = sprintf("%02d", $data['month']);
  $yearmonth = $data['year'] . $padded_month;

  $posts = get_posts( array(
    'numberposts' => -1,
    'post_type' => 'event',
    'meta_query' => array (
      array(
        'key'       => 'start_date',
        'value'     => $yearmonth,
        'compare'   => 'LIKE',
      ),
    ),
  ));

  if ( empty( $posts ) ) {
    return new WP_Error('no_event', 'There are no events this month!', array(
      'status' => 404
    ));
  } else {
    foreach($posts as $post) {

      $start_date = get_field('start_date', $post->ID);
      $start_month = substr($start_date,0,2);
      $start_day = substr($start_date,2,2);
      $start_year = substr($start_date,-4);
      $start_date = $start_year.$start_month.$start_day;
      $start_datetime = new DateTime($start_date);

      // If end_date is present, then determine how many times to loop for multiple day events
      if (get_field('end_date', $post->ID)) {
        $end_date = get_field('end_date', $post->ID);
        $end_month = substr($end_date,0,2);
        $end_day = substr($end_date,2,2);
        $end_year = substr($end_date,-4);
        $end_date = $end_year.$end_month.$end_day;
        $end_datetime = new DateTime($end_date);
        $span = $end_datetime->diff($start_datetime)->format("%a") + 1;
      } else {
        // Else just loop once
        $span = 1;
      }

      for ($i = 0; $i < $span; $i++) {
        $start_time = get_field('start_time', $post->ID) ? get_field('start_time', $post->ID). ' ' . get_field('start_time_period', $post->ID) : null;

        $end_time = get_field('end_time', $post->ID) ? get_field('end_time', $post->ID). ' ' . get_field('end_time_period', $post->ID) : null;

        $flickr_photostream = get_field('event_image', $post->ID);
        if (isset($flickr_photostream['items'])) {
          foreach ($flickr_photostream['items'] as $id => $photo) {
            $bg = $photo['large'];
          }
        }

        // Calculate new end date using number of span
        $start_datetime->modify('+'.$i.' day');
        $new_start_date = $start_datetime->format('mdY');
        $start_datetime->modify('-'.$i.' day');

        array_push($events, array(
          'id'          => uniqid(),
          'title'       => $post->post_title,
          'link'        => $post->post_name,
          'category'    => wp_get_post_terms($post->ID, 'event_category')[0]->name,
          'span' => $span,
          'start_date'  => $new_start_date,
          'start_time'  => $start_time,
          'end_time'    => $end_time,
          'location'    => get_field('event_location', $post->ID),
          'teaser'      => get_field('event_teaser', $post->ID),
          'bg'          => $bg,
        ));
      }
    }
  }
  return json_encode($events);
}

add_action( 'rest_api_init', function () {
  register_rest_route( 'events', '/list/(?P<year>\d+)/(?P<month>\d+)', array(
    'methods' => 'GET',
    'callback' => 'get_events',
    'args' => array(
    ),
  ));
});
