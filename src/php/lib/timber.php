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

		// Fallback Image
		$context['fallback']['image'] = serveImage(get_field('fallback_image', 'option'));
		$context['fallback']['square'] = serveSquareImage(get_field('fallback_image', 'option'));
		$context['fallback']['photo'] = serveSquareImage(get_field('fallback_photo', 'option'));

		// Campuses
		$context['campuses'] = array();
		$campuses = Timber::get_posts('post_type=campus');
		foreach ($campuses as $campus) {
			array_push($context['campuses'], array(
				'name' => $campus->title,
				'slug' => $campus->slug,
				'link' => $campus->link,
			));
		}

		// Primary
		$primary_menu = get_field('primary_menu', 'option');
		$context['primary_menu'] = array();

		foreach ($primary_menu as $menu) {
			$parent = Timber::get_post($menu['parent']);
			$children = array();
			foreach ($parent->get_children() as $child) {
				array_push($children, array(
					'title' => $child->title,
					'link' => $child->link
				));
			}
			array_push($context['primary_menu'], array(
				'title' => $parent->title,
				'link' => $parent->link,
				'children' => $children,
				'image' => serveSquareImage($menu['image'])
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

		// Slogan
		$context['slogan'] = get_field('slogan', 'option');

		// Welcome Page
		if(get_field('welcome_page', 'option')) {
			$welcome_page = Timber::get_post(get_field('welcome_page', 'option'));
			$context['welcome_page']['image'] = serveImage($welcome_page->get_field('image'));
			$context['welcome_page']['link'] = $welcome_page->link;
			$context['welcome_page']['title'] = get_field('welcome_caption', 'option');
			$context['welcome_page']['subtitle'] = get_field('welcome_subtitle', 'option');
		}

		// Quicklinks
		$qlinks = get_field('quicklinks', 'option');
		if(isset($qlinks) && is_array($qlinks)) {
			$context['quicklinks'] = array();
			$quicklinks = Timber::get_posts($qlinks);
			foreach ($quicklinks as $item) {
				array_push($context['quicklinks'], array(
					'title' => $item->title,
					'link' => $item->link,
				));
			}
		}

		// Popular Pages
		$pop = get_field('search_popular', 'option');
		if(isset($pop) && is_array($pop)) {
			$context['popular'] = array();
			$popular = Timber::get_posts($pop);
			foreach ($popular as $item) {
				array_push($context['popular'], array(
					'title' => $item->title,
					'link' => $item->link,
				));
			}
		}

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
			'address' => get_field('org_address', 'option'),
			'description' => get_field('org_description', 'option'),
			'dept_one' => get_field('org_add_contact_dept_one', 'option'),
			'details_one' => get_field('org_add_contact_details_one', 'option')
		);

		// Policy Page
		$context['policy'] = get_field('policy', 'option');

		// Career Page
		$context['career'] = get_field('career', 'option');

		// CTA
		$context['cta'] = get_field('cta_blurb', 'option');
		$context['cta_buttons'] = array();
		foreach (get_field('cta_buttons', 'option') as $button) {
			array_push($context['cta_buttons'], array(
				'label' => $button['label'],
				'link' => $button['link']
			));
		}

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

		// Feedback
		$context['feedback'] = get_field('feedback', 'option');

		// Webmaster's Email
		$context['webmaster'] = get_field('webmaster', 'option');

		// Languages URLs
		$context['languages']['en'] = get_field('language_en', 'option');
		$context['languages']['id'] = get_field('language_id', 'option');
		$context['languages']['solo'] = get_field('language_solo', 'option');

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
		$listfunction = new Twig_SimpleFunction('getPosts', function ($options) {
			return getPosts($options);
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
		// Generate image URL from Google Photos
		//=============================================
		$classfilter = new Twig_SimpleFilter('serveImage', function ($image) {
			return serveImage($image);
		});
		$twig->addFilter($classfilter);

		$classfilter = new Twig_SimpleFilter('serveSquareImage', function ($image) {
			return serveSquareImage($image);
		});
		$twig->addFilter($classfilter);

		//=============================================
		// String replace _ and - with spaces
		//=============================================
		$classfilter = new Twig_SimpleFilter('spacify', function ($text) {
			if(isset($text) && is_string($text)) {
				$removeHyphen = str_replace("-", " ", $text);
				$removeUnderscore = str_replace("_", " ", $removeHyphen);
				$removeExtension = preg_replace('/\\.[^.\\s]{3,4}$/', '', $removeUnderscore);
				$removeNumbers = preg_replace('/[0-9]+/', '', $removeExtension);
				return $removeNumbers;
			}
		});
		$twig->addFilter($classfilter);

		return $twig;
	}
}
new StarterSite();
