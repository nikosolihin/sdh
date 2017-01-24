<?php
if ( ! class_exists( 'Timber' ) ) {
	add_action( 'admin_notices', function() {
			echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
		} );
	return;
}

Timber::$dirname = array('templates', 'views');

class StarterSite extends TimberSite {

	function __construct() {
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		parent::__construct();
	}

	function register_post_types() {
		require('lib/custom-types.php');
	}

	function register_taxonomies() {
		require('lib/taxonomies.php');
	}

	function add_to_context( $context ) {

		// Generate menu exclusion list
		$blacklist = get_field('global_menu_exclude', 'option');
		$exclude = array();
		foreach ($blacklist as $item) {
			$exclude[] = $item->ID;
		}

		// Retrieve menu items and label them if in exclusion list
		$context['menu'] = array();
		$menus = get_field('global_menu', 'option');
		foreach ($menus as $menu) {
			$post = new TimberPost($menu->ID);
			// Based on current URL - is this menu item active?
			$active = $post->slug() == explode("/", $_SERVER[REQUEST_URI])[1] ? true : false;

			$children = array();
		  foreach ($post->get_children() as $child) {
		    array_push($children, array(
		      'id' => $child->id(),
		      'title' => $child->title(),
		      'link' => $child->link()
		    ));
		  }
	    array_push($context['menu'], array(
				'id' => $post->id(),
				'slug' => $post->slug(),
				'title' => $post->title(),
				'link' => $post->link(),
				'children' => $children,
				'active' => $active,
				'exclude' => in_array($post->id(), $exclude)
	    ));
	  }

		// Put client info inside context
		$context['info'] = array(
			'name' => get_field('global_name', 'option'),
			'phone' => get_field('global_phone', 'option'),
			'email' => get_field('global_email', 'option')
		);

		// Social Links
		$context['social'] = array(
			'facebook' => get_field('global_facebook', 'option'),
			'youtube' => get_field('global_youtube', 'option')
		);

		// 404 stuff
		$context['404'] = array(
			'image' => reset(reset(get_field('global_image', 'option')))['thumb'],
			'title' => get_field('global_404_title', 'option'),
			'description' => get_field('global_404_description', 'option')
		);

		// Site default
		$context['site'] = $this;
		return $context;
	}

	function add_to_twig( $twig ) {
		/* this is where you can add your own fuctions to twig */
		$twig->addExtension( new Twig_Extension_StringLoader() );

		// http://cmsmess.com/timber-gravity-forms-dynamic-population-fields/
		$gravityfunction = new Twig_SimpleFunction('displayform', function ($id) {
			// https://www.gravityhelp.com/documentation/article/gravity_form_enqueue_scripts/
	    gravity_form_enqueue_scripts($id, true);

			// https://www.gravityhelp.com/documentation/article/embedding-a-form/#function-call
			$form = gravity_form($id, false, false, false, '', true, 1, false);

			return $form;
		});
		$twig->addFunction($gravityfunction);

		return $twig;
	}

}
new StarterSite();
