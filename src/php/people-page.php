<?php
/**
 * Template Name: People Page
 * Description: Page template for people page
 */
 $context = Timber::get_context();
 $post = new TimberPost();
 $context['post'] = $post;
 $context['acf'] = get_fields();
 $context['sections'] = $context['acf']['sections'];
 $context['slim_sidebar'] = true;

 // Get Sidebar
 $inherit = ($context['acf']['inherit'] === 'true');
 $sidebar = $post->get_field('sidebar_sections');
 if ($inherit) {
 	$order = $context['acf']['order'];
 	$parent = $post->get_parent();
 	$parents_sidebar = $parent->get_field('sidebar_sections');
 	if ($parents_sidebar) {
 		if ($sidebar) {
 			$context['sidebar_sections'] = $order == 'parent' ? array_merge($parents_sidebar, $sidebar) : array_merge($sidebar, $parents_sidebar);
 		} else {
 			$context['sidebar_sections'] = $parents_sidebar;
 		}
 	} else {
 		$context['sidebar_sections'] = $sidebar;
 	}
 } else {
 	$context['sidebar_sections'] = $sidebar;
 }

 // Find root ID - For sidebar TOC
 if ($post->post_parent)	{
 	$ancestors = get_post_ancestors($post->id);
 	$id = $ancestors[ count($ancestors)-1 ];
 } else {
 	$id = $post->id;
 }
 // and generate hierarchy
 $args = array(
   'child_of' => $id,
   'echo' => false,
   'title_li' => null
 );
 $context['hierarchy'] = wp_list_pages($args);

 // Generate breadcrumb. Must be last.
 $context['breadcrumb'] = array();
 while( $post->get_parent ) {
 	$post = $post->get_parent();
 	array_push( $context['breadcrumb'], array(
     'title' => $post->title,
     'link' => $post->link
   ));
 }
 $context['breadcrumb'] = array_reverse( $context['breadcrumb'] );

 Timber::render( 'page/single-page.twig' , $context );
