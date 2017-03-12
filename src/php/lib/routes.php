<?php
//=============================================
// Search Page -
// so /search doesn't lead to a page.
//=============================================
Routes::map('search', function($params){
  Routes::load('search.php');
});

//=============================================
// Campus
//=============================================
Routes::map('campuses/:location/', function($params){
  // Get all campuses
  $routesCampuses = array();
  foreach (Timber::get_terms('campus') as $campus) {
    array_push($routesCampuses, $campus->slug);
  }

  // Check if we have a valid campus location
  if ( in_array($params['location'], $routesCampuses) ) {
    $params['section'] = 'welcome';
    Routes::load('single-campus.php', $params);
  } else {
    Routes::load('404.php');
  }
});
Routes::map('campuses/:location/:section', function($params){
  $params['body_class'] = 'single-campus';

  // Get all campus page sections
  $routesSection = array('welcome', 'details', 'facilities');

  // Get all campuses
  $routesCampuses = array();
  foreach (Timber::get_terms('campus') as $campus) {
    array_push($routesCampuses, $campus->slug);
  }

  // Check if we have a valid campus location and section
  if ( in_array($params['location'], $routesCampuses) && in_array($params['section'], $routesSection) ) {
    Routes::load('single-campus.php', $params);
  } else {
    Routes::load('404.php');
  }
});
