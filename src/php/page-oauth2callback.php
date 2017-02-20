<?php
require_once WPMU_PLUGIN_DIR . '/google-photos-auth/google-api-php-client/vendor/autoload.php';

session_start();

$client = new Google_Client();
$client->setAccessType("offline");

$secret = 'client_secret_273648969461-obgo20v9hjpv5n875a0lldbhkbkvhmfc.apps.googleusercontent.com';
$client->setAuthConfig(WPMU_PLUGIN_DIR. '/google-photos-auth/' . $secret . '.json');

$redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback';
$client->setRedirectUri($redirect_uri);
$client->addScope(Google_Service_Drive::DRIVE);

if (! isset($_GET['code'])) {
  $auth_url = $client->createAuthUrl();
  header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
} else {
  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
  $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/';
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}
