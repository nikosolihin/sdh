<?php
require_once WPMU_PLUGIN_DIR. '/google-photos-auth/google-api-php-client/vendor/autoload.php';

session_start();

$client = new Google_Client();
$client->setAccessType("offline");

$secret = 'client_secret_273648969461-obgo20v9hjpv5n875a0lldbhkbkvhmfc.apps.googleusercontent.com';
$client->setAuthConfig(WPMU_PLUGIN_DIR. '/google-photos-auth/' . $secret . '.json');

$client->addScope(Google_Service_Drive::DRIVE);

if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $client->setAccessToken($_SESSION['access_token']);
  $drive_service = new Google_Service_Drive($client);
  $files_list = $drive_service->files->listFiles(array())->getItems();
  echo json_encode($files_list);
} else {
  $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback';
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}
