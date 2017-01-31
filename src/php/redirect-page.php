<?php
/**
 * Template Name: Redirect Page
 * Description: Page template for redirect page
 */

$context = Timber::get_context();
$post = new TimberPost();

$targetURL = $post->get_field('redirect_url');
if($targetURL) wp_redirect(clean_url($targetURL), 301);
