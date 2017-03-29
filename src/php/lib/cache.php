<?php
/**
 * Mostly based on
 * https://github.com/timber/timber/wiki/Performance
 */

// Cache twig files (but not the data)
if (class_exists('Timber')){
  Timber::$cache = true;
}
