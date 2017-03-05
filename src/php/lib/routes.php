<?php
// //=============================================
// // Media Archive
// //=============================================
// Routes::map('media', function($params){
//   Routes::load('archive-media.php');
// });
// Routes::map('media/:type', function($params){
//   $url = get_bloginfo('url').'/media/?utf8=%E2%9C%93&page=1&types=' . $params['type'];
//   header( "Location: $url" );
// });
//
// //=============================================
// // Search Page
// // so /search doesn't lead to a page.
// //=============================================
// Routes::map('search', function($params){
//   Routes::load('search.php');
// });

//=============================================
// News Archive
//=============================================
Routes::map('campuses/:location/:section', function($params){
  $params['wp_title'] = 'Welcome to';
  Routes::load('single-campus.php', $params);
  // Routes::load('single-campus-'.$params['section'].'.php', $params);
});
// Routes::map('campuses/:location/about', function($params){
//   Routes::load('single-campus.php');
// });
// Routes::map('campuses/:location/facilities', function($params){
//   Routes::load('single-campus.php');
// });
