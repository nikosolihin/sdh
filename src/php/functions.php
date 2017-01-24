<?php
require_once('includes/constants.php');
require_once('includes/functions.php');
require_once('includes/routes.php');
// Register the Custom Taxonomy BEFORE the Custom Post Type
// in order for rewrite rule to work.
// (https://clarknikdelpowell.com/blog/the-right-way-to-do-wordpress-custom-taxonomy-rewrites/)
require_once('includes/ct.php');
require_once('includes/cpt.php');
require_once('includes/api.php');
require_once('includes/acf.php');
require_once('includes/timber.php');

// Don't change me to dashboard.php
require_once('includes/dboard.php');

require_once('includes/mime.php');
require_once('includes/wordings.php');
