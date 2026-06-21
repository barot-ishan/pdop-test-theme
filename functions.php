<?php

/**
 * PDOP functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package PDOP
 */

if (! defined('_PDOP_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_PDOP_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function pdop_setup(){
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on PDOP, use a find and replace
		* to change 'pdop' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('pdop', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'pdop'),
			'quick-links' => esc_html__('Quick Links', 'pdop'),
			'support' => esc_html__('Support', 'pdop'),
			'legal-menu' => esc_html__('Legal Menu', 'pdop'),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'pdop_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	// add_theme_support(
	// 	'custom-mobile-logo',
	// 	array(
	// 		'height'      => 163,
	// 		'width'       => 42,
	// 		'flex-width'  => true,
	// 		'flex-height' => true,
	// 	)
	// );

}
add_action('after_setup_theme', 'pdop_setup');

function pdop_mobile_logo_customize($wp_customize){

	$wp_customize->add_setting(
		'mobile_logo',
		array(
			'sanitize_callback'=>'absint'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'mobile_logo',
			array(
				'label'=>'Mobile Logo',
				'section'=>'title_tagline',
				'mime_type'=>'image',
			)
		)
	);

}
add_action('customize_register','pdop_mobile_logo_customize');

function pdop_mobile_logo(){
	$mobile_logo = get_theme_mod('mobile_logo');

	if($mobile_logo){
		echo '<a href="'.esc_url(home_url('/')).'" class="mobile-logo">';
		echo wp_get_attachment_image($mobile_logo,'full');
		echo '</a>';
	}else{
		the_custom_logo();
	}
}


function pdop_secondary_image_customize_register($wp_customize)
{

	// Add setting
	$wp_customize->add_setting('secondary_logo', [
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
	]);

	// Add control (upload field)
	$wp_customize->add_control(new WP_Customize_Image_Control(
		$wp_customize,
		'secondary_logo_control',
		[
			'label' => __('Secondary Logo', 'pdop'),
			'section' => 'title_tagline', // Site Identity section
			'settings' => 'secondary_logo',
			'priority' => 3,
		]
	));
}
add_action('customize_register', 'pdop_secondary_image_customize_register');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function pdop_content_width()
{
	$GLOBALS['content_width'] = apply_filters('pdop_content_width', 640);
}
add_action('after_setup_theme', 'pdop_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function pdop_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'pdop'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'pdop'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'pdop_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function pdop_scripts()
{
	wp_enqueue_style('pdop-style', get_stylesheet_uri(), array(), _PDOP_VERSION);
	wp_style_add_data('pdop-style', 'rtl', 'replace');

	wp_enqueue_script('pdop-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _PDOP_VERSION, true);
	wp_enqueue_script('pdop-script', get_template_directory_uri() . '/assets/js/script.js', array(), _PDOP_VERSION, true);

	if (is_page_template('templates/program.php') || is_page_template('templates/program-activity.php')) {
		wp_enqueue_style('pdop-program', get_template_directory_uri() . '/assets/css/program.css', array(), _PDOP_VERSION);
		wp_enqueue_style('pdop-program-activity', get_template_directory_uri() . '/assets/css/program-activity.css', array(), _PDOP_VERSION);
		wp_enqueue_script('pdop-program', get_template_directory_uri() . '/assets/js/program.js', array(), _PDOP_VERSION, true);
	}

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'pdop_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * General functions.
 */
require get_template_directory() . '/inc/general-functions.php';

/**
 * Custom functions.
 */
require get_template_directory() . '/inc/custom-functions.php';


/**  Mega Menu Walker functions. */
require get_template_directory() . '/inc/megamenu/mega-menu-walker.php';
require get_template_directory() . '/inc/megamenu/mobile-menu-walker.php';
require_once get_template_directory() . '/inc/megamenu/mega-menu-sidebar.php';
require_once get_template_directory() . '/inc/megamenu/mega-menu-submenu.php';


// disable gutenberg editor
add_filter('use_block_editor_for_post', '__return_false');

// disable gutenberg editor for all post types
add_filter('use_block_editor_for_post_type', '__return_false');

//Hide the acf for all the child items in Admin menu
add_action( 'admin_enqueue_scripts', function( $hook ) {
    if ( 'nav-menus.php' !== $hook ) {
        return;
    }

    wp_add_inline_style(
        'nav-menus', // hooks onto WP's own nav-menus stylesheet
        '#menu-to-edit li.menu-item:not(.menu-item-depth-0) .acf-menu-item-fields { display: none !important; }'
    );
} );