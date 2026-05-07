<?php
/**
 * skookum functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package skookum
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function skookum_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on skookum, use a find and replace
		* to change 'skookum' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'skookum', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

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
			'skookum_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

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

    /**
	 * Add support for editor styling and enqueue in the editor.
     * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#editor-styles
	 */
    add_theme_support( 'editor-styles' );
    add_editor_style( get_site_url() . '/wp-content/themes/skookum/css/editor.css' );
}
add_action( 'after_setup_theme', 'skookum_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function skookum_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'skookum_content_width', 640 );
}
add_action( 'after_setup_theme', 'skookum_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function skookum_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'skookum' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'skookum' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'skookum_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function skookum_scripts() {
    // Enqueue Skookum styles
    wp_enqueue_style( 'skookum-style', get_template_directory_uri() . '/css/style.css', array(), _S_VERSION );
    wp_style_add_data( 'skookum-style', 'rtl', 'replace' );

    // Enqueue Skookum JS
    wp_enqueue_script('jquery');
    wp_enqueue_script( 'skookum-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'skookum-navigation-dropdowns', get_template_directory_uri() . '/js/navigation-dropdowns.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'skookum-tooltip', get_template_directory_uri() . '/js/tooltip.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'skookum-scroll-to-top', get_template_directory_uri() . '/js/scroll-to-top.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'skookum-scroll-down', get_template_directory_uri() . '/js/scroll-down.js', array(), _S_VERSION, true );

	if ( is_page_template( 'templates/posts-feed.php' ) ) :
		wp_enqueue_script( 'skookum-facetwp', get_template_directory_uri() . '/js/facetwp.js', array(), _S_VERSION, true );
	endif;

	// Google Translate
	wp_enqueue_script( 'skookum-google-translate', get_template_directory_uri() . '/js/google-translate.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'google-translate', 'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit', array(), '1.0.0', true );
	
	// Alert bar
	wp_enqueue_script( 'skookum-alert-bar', get_template_directory_uri() . '/js/alert-bar.js', array(), _S_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'skookum_scripts' );

/**
 * Register block scripts and styles.
 */
function skookum_register_block_scripts() {
	// Register Swiper CDN
	wp_register_style( 'swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), '11.1.1', false );
	wp_register_script( 'swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11.1.1', false );
}
add_action( 'init', 'skookum_register_block_scripts' );

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
 * Navigation Registration.
 */
require get_template_directory() . '/inc/navigation-reg.php';
require get_template_directory() . '/inc/primary-nav.php';

/**
 * Page Language function.
 */
require get_template_directory() . '/inc/get-page-lang.php';

/**
 * Custom shortcodes.
 */
require get_template_directory() . '/inc/shortcodes.php';

/**
 * Walker file.
 */
require get_template_directory() . '/inc/walker.php';

/**
 * Featured image function.
 */
require get_template_directory() . '/inc/featured-image.php';

/**
 * Alert bar function.
 */
require get_template_directory() . '/inc/alert-bar.php';

/**
 * ACF Options Registrations.
 */
require get_template_directory() . '/inc/acf-options.php';

/**
 * Enqueue ACF blocks JSON.
 */
require get_template_directory() . '/inc/acf-blocks.php';

/**
 * Enqueue ACF blocks JSON.
 */
require get_template_directory() . '/inc/blocks-list.php';
