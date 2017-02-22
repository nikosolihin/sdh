<?php
/**
 * The template for displaying a single campus facilities
 */
global $params;

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['acf'] = get_fields();
$context['sections'] = $context['acf']['sections'];

var_dump($params);

Timber::render( 'page/single-campus.twig' , $context );
