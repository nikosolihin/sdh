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
		parent::__construct();
	}

	function add_to_context( $context ) {
		//=============================================
		// Globals
		//=============================================
		// Breakpoints - taken from variables.scss
	  $context['sm'] = '544px';
	  $context['md'] = '768px';
	  $context['lg'] = '992px';
	  $context['xl'] = '1200px';
	  $context['xxl'] = '1400px';

		// Height Breakpoints
		$context['short'] = '601px';
	  $context['tall'] = '700px';

		//=============================================
		// Layout Modules
		//=============================================

		// Primary - get 3 levels deep
		$primary_menu = get_field('primary_menu', 'option');
		$context['primary_menu'] = array();
		foreach ($primary_menu as $menu) {
			$parent = Timber::get_post($menu['parent']);

			// At level 1, assume children
			$children = array();
			$singles = array();
			foreach ($parent->get_children() as $child) {

				// See if there are grand children
				$grandchildren = array();
				if ( !empty($child->get_children()) ) {
					foreach ($child->get_children() as $grandchild) {
						array_push($grandchildren, array(
							'title' => $grandchild->title,
							'link' => $grandchild->link
						));
					}
					array_push($children, array(
						'title' => $child->title,
						'link' => $child->link,
						'grandchildren' => $grandchildren
					));
				} else {
					// If empty put it in a different bucket
					array_push($singles, array(
						'title' => $child->title,
						'link' => $child->link
					));
				}
			}
			array_push($context['primary_menu'], array(
				'title' => $parent->title,
				'link' => $parent->link,
				'children' => $children,
				'singles' => $singles
			));
		}

		// Secondary
		$secondary_menu = get_field('secondary_menu', 'option');
		$context['secondary_menu'] = array();
		if ($secondary_menu) {
			foreach ($secondary_menu as $item) {
				$post = Timber::get_post($item);
				array_push($context['secondary_menu'], array(
					'title' => $post->title,
					'link' => $post->link
				));
			}
		}

		// Quicklinks
		// array_push($context['secondary_menu'], array(
		// 	'title' => __('Events', 'saat'),
		// 	'link' => $this->url . "/events/"
		// ));
		// array_push($context['secondary_menu'], array(
		// 	'title' => __('News', 'saat'),
		// 	'link' => $this->url . "/news/"
		// ));
		// array_push($context['secondary_menu'], array(
		// 	'title' => __('Media', 'saat'),
		// 	'link' => $this->url . "/media/"
		// ));

		// // Menu Blocks
		// $context['mobile_blocks'] = get_field('blocks', 'option');
		//
		// // Audience Dropdown
		// if (get_field('audience_dropdown', 'option')) {
		// 	$context['audience_label'] = get_field('audience_label', 'option');
		// 	$context['audience_links'] = get_field('audience_links', 'option');
		// }

		// Social Links
		$context['social'] = array(
			'facebook' => get_field('facebook', 'option'),
			'twitter' => get_field('twitter', 'option'),
			'youtube' => get_field('youtube', 'option'),
			'instagram' => get_field('instagram', 'option')
		);

		// Social Analytics
		$context['analytics'] = array(
			'facebook_app_id' => get_field('facebook_app_id', 'option'),
			'twitter_analytics_id' => get_field('twitter_analytics_id', 'option')
		);

		// 404 stuff
		$context['error'] = array(
			'title' => get_field('error_title', 'option'),
			'description' => get_field('error_description', 'option')
		);

		// Org Info
		$context['org'] = array(
			'name' => get_field('org_name', 'option'),
			// 'address' => get_field('org_address', 'option'),
			'description' => get_field('org_description', 'option')
			// 'contacts' => get_field('org_contacts', 'option')
		);

		// Policy Page
		$context['policy'] = get_field('policy', 'option');

		// CTA
		$context['cta'] = get_field('cta_blurb', 'option');

		// Footer items
		$context['footer_bg'] = get_field('footer_bg', 'option');
		$footer_items = Timber::get_posts(get_field('footer', 'option'));
		$context['footer']['singles'] = array();
		$context['footer']['parents'] = array();
		foreach ($footer_items as $item) {
			if ( empty($item->get_children()) ) {
				array_push($context['footer']['singles'], array(
		      'id' => $item->id,
		      'title' => $item->title,
		      'link' => $item->link
		    ));
			} else {
				$children = array();
				foreach ($item->get_children() as $child) {
					array_push($children, array(
						'id' => $child->id,
			      'title' => $child->title,
			      'link' => $child->link
					));
				}
				array_push($context['footer']['parents'], array(
					'id' => $item->id,
					'title' => $item->title,
					'link' => $item->link,
					'children' => $children
				));
			}
		}

		// // Add post types archives to single footer list
		// array_push($context['footer']['singles'], array(
		// 	'title' => __('Events', 'saat'),
		// 	'link' => $this->url . "/events/"
		// ));
		// array_push($context['footer']['singles'], array(
		// 	'title' => __('News', 'saat'),
		// 	'link' => $this->url . "/news/"
		// ));
		// array_push($context['footer']['singles'], array(
		// 	'title' => __('Media', 'saat'),
		// 	'link' => $this->url . "/media/"
		// ));

		// Site Announcement
		if ( get_field('announcement_status', 'option') == 'on' ) {
			$link_type = get_field('announcement_link_type', 'option');
			if ($link_type == "single") {
				$url = get_field('announcement_link_single_url', 'option');
			} elseif ($link_type == "external") {
				$url = get_field('announcement_link_external_url', 'option');
			} else {
				$url = get_field('announcement_link_search_url', 'option');
			}
			$context['announcement'] = array(
				'dte' => get_field('announcement_dte', 'option'),
				'position' => get_field('announcement_position', 'option'),
				'message' => get_field('announcement_message', 'option'),
				'button' => get_field('announcement_button', 'option'),
				'link_type' => $link_type,
				'url' => $url,
			);
		}

		// Locale
		$context['locale'] = get_locale();

		// // Languages
		// $context['languages']['id'] = "https://seabs.ac.id/";
		// $context['languages']['en'] = "https://seabs.ac.id/en";
		// $context['languages']['zh'] = "https://seabs.ac.id/zh";
		// $context['languages']['list'] = get_field('languages', 'option');

		// Current URL
		global $wp;
		$context['current_url'] = home_url(add_query_arg(array(),$wp->request)).'/';

		// Site default
		$context['site'] = $this;

		return $context;
	}

	function add_to_twig( $twig ) {
		/* this is where you can add your own fuctions to twig */
		$twig->addExtension( new Twig_Extension_StringLoader() );

		//=============================================
		// LIST COMPONENT & TERMS
		//=============================================
		$listfunction = new Twig_SimpleFunction('populatelist', function ($options) {
			return populateList($options);
		});
		$twig->addFunction($listfunction);

		$termfunction = new Twig_SimpleFunction('listterms', function ($tax) {
			return listTerms($tax);
		});
		$twig->addFunction($termfunction);

		//=============================================
		// Generate classes from component options
		//=============================================
		$classfilter = new Twig_SimpleFilter('modifiers', function ($component, $options) {
			$classes = '';
			if ($options) {
				$classes = array();
				foreach (explode(", ", $options) as $option) {
					$classes[] = $component.'--'.$option;
				}
				$classes = implode(" ", $classes);
			}
			return $component." ".$classes;
		});
		$twig->addFilter($classfilter);

		//=============================================
		// Generate image url from Google Photos
		//=============================================
		$classfilter = new Twig_SimpleFilter('serveImage', function ($image, $size) {
			$width = strval($size);
			return $image['base'].'s'.$width.'/'.$image['title'];
		});
		$twig->addFilter($classfilter);

		$classfilter = new Twig_SimpleFilter('serveSquareImage', function ($image, $size) {
			$width = strval($size);
			return $image['base'].'s'.$width.'-c/'.$image['title'];
		});
		$twig->addFilter($classfilter);

		// //=============================================
		// // Hide youtube controls
		// //=============================================
		// $classfilter = new Twig_SimpleFilter('modest', function ($embed) {
		// 	return preg_replace('/oembed/', "oembed&modestbranding=1&controls=0&rel=0", $embed);
		// });
		// $twig->addFilter($classfilter);
		//
		// //=============================================
		// // Choose largest image for FB Share
		// //=============================================
		// $classfilter = new Twig_SimpleFilter('getLargest', function ($image) {
		// 	if ($image) {
		// 		// Get just the url addresses of images
		// 		$images = array();
		// 		foreach($image as $key => $value) {
		// 			if(strpos($key, 'url_') !== false) {
		// 				$images[$key] = $value;
		// 			}
		// 		}
		// 		if (array_key_exists('url_h', $images)) {
		// 			// If large 1600 exists, trash original and use that
		// 			unset($images['url_o']);
		// 			return $images['url_h'];
		// 		} else {
		// 			// If large 1600 doesn't exist, grab original
		// 			return $images['url_o'];
		// 		}
		// 	}
		// });
		// $twig->addFilter($classfilter);

		return $twig;
	}
}
new StarterSite();
