<?php
/**
 * exago functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package exago
 */

if ( ! function_exists( 'exago_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function exago_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on exago, use a find and replace
	 * to change 'exago' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'exago', get_template_directory() . '/languages' );

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
	add_image_size('exago-large-thumb', 700);
	add_image_size('exago-medium-thumb', 520);
	add_image_size('exago-small-thumb', 360);
	add_image_size('exago-project-thumb', 500, 310, true);
	add_image_size('exago-client-thumb', 250);
	add_image_size('exago-testimonial-thumb', 100);

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' 	=> esc_html__( 'Primary', 'exago' ),
		'footer' 	=> esc_html__( 'Footer', 'exago' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'exago_custom_background_args', array(
		'default-color' => 'f5f9f8',
		'default-image' => '',
	) ) );

	add_theme_support( 'custom-logo', array(
		'height'      => 80,
		'width'       => 200,
		'flex-height' => true,
	) );
}
endif;
add_action( 'after_setup_theme', 'exago_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function exago_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'exago_content_width', 640 );
}
add_action( 'after_setup_theme', 'exago_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function exago_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'exago' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	//Register widget areas for the Widgetized page template
	$pages = get_pages(array(
		'meta_key' => '_wp_page_template',
		'meta_value' => 'page-templates/page_widgetized.php',
	));

	foreach($pages as $page){
		register_sidebar( array(
			'name'          => esc_html__( 'Page - ', 'exago' ) . $page->post_title,
			'id'            => 'widget-area-' . strtolower($page->post_name),
			'description'   => esc_html__( 'Use this widget area to build content for the page: ', 'exago' ) . $page->post_title,
			'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="atblock container">',
			'after_widget'  => '</div></section>',
			'before_title'  => '<h2 class="widget-title"><span class="title-decoration"></span>',
			'after_title'   => '</h2>',
		) );
	}

	//Footer widget areas
	$widget_areas = get_theme_mod('footer_widget_areas', '3');
	for ($i=1; $i<=$widget_areas; $i++) {
		register_sidebar( array(
			'name'          => __( 'Footer ', 'exago' ) . $i,
			'id'            => 'footer-' . $i,
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}

	register_widget( 'Atframework_Services' );
	register_widget( 'Atframework_Skills' );
	register_widget( 'Atframework_Facts' );
	register_widget( 'Atframework_Employees' );
	register_widget( 'Atframework_Projects' );
	register_widget( 'Atframework_Testimonials' );
	register_widget( 'Atframework_Clients' );
	register_widget( 'Atframework_Posts' );
	register_widget( 'Atframework_Video' );
	register_widget( 'Atframework_Recent_Posts' );
	register_widget( 'Atframework_Social' );

}
add_action( 'widgets_init', 'exago_widgets_init' );

//Homepage widgets
$exago_widgets = array('services', 'skills', 'facts', 'employees', 'projects', 'testimonials', 'clients', 'posts');
foreach ( $exago_widgets as $exago_widget) {
	locate_template( '/inc/framework/widgets/front-' . $exago_widget . '.php', true, false );
}

//Sidebar widgets
require get_template_directory() . "/inc/framework/widgets/video-widget.php";
require get_template_directory() . "/inc/framework/widgets/posts-widget.php";
require get_template_directory() . "/inc/framework/widgets/social-widget.php";

/**
 * Enqueue scripts and styles.
 */
function exago_scripts() {
	wp_enqueue_style( 'exago-style', get_stylesheet_uri() );

	$body_font 		= get_theme_mod('body_font_name', '//fonts.googleapis.com/css?family=Open+Sans:300,300italic,600,600italic');
	$headings_font 	= get_theme_mod('headings_font_name', '//fonts.googleapis.com/css?family=Josefin+Sans:300italic,300');
	$remove 		= array("<link href='", "' rel='stylesheet' type='text/css'>", "https:", "http:");
	$body_url 		= str_replace($remove, '', $body_font);
	$headings_url 	= str_replace($remove, '', $headings_font);

	wp_enqueue_style( 'exago-body-fonts', esc_url($body_url) );

	wp_enqueue_style( 'exago-headings-fonts', esc_url($headings_url) );

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/fonts/font-awesome.min.css' );

	wp_enqueue_script( 'exago-main', get_template_directory_uri() . '/js/main.js', array('jquery'), '', true );

	wp_enqueue_script( 'exago-scripts', get_template_directory_uri() . '/js/scripts.min.js', array('jquery'), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( exago_blog_layout() == 'masonry-layout' && (is_home() || is_archive()) ) {
		wp_enqueue_script( 'exago-masonry-init', get_template_directory_uri() . '/js/masonry-init.js', array('masonry'), '', true );
	}

	wp_enqueue_script( 'exago-html5shiv', get_template_directory_uri() . '/js/html5shiv.js', array(), '', true );
    wp_script_add_data( 'exago-html5shiv', 'conditional', 'lt IE 9' );

}
add_action( 'wp_enqueue_scripts', 'exago_scripts' );

/**
 * Enqueue Bootstrap
 */
function exago_enqueue_bootstrap() {
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap/bootstrap.min.css', array(), true );
}
add_action( 'wp_enqueue_scripts', 'exago_enqueue_bootstrap', 9 );


/**
 * Customizer styles
 */
function exago_customizer_styles($hook) {
    if ( ( 'customize.php' != $hook ) && ( 'widgets.php' != $hook ) ) {
        return;
    }
	wp_enqueue_style( 'exago-customizer-styles', get_template_directory_uri() . '/inc/framework/css/customizer.css' );
}
add_action( 'admin_enqueue_scripts', 'exago_customizer_styles' );

/**
 * Blog layout
 */
function exago_blog_layout() {
	$layout = get_theme_mod('blog_layout','list');
	return $layout;
}

/**
 * Remove archives labels
 */
function exago_category_label($title) {
    if ( is_category() ) {
        $title = '<i class="fa fa-folder-o"></i>' . single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = '<i class="fa fa-tag"></i>' . single_tag_title( '', false );
    } elseif ( is_author() ) {
		$title = '<span class="vcard"><i class="fa fa-user"></i>' . get_the_author() . '</span>';
	}
    return $title;
}
add_filter('get_the_archive_title', 'exago_category_label');

/**
 * Header image check
 */
function exago_has_header() {
	$front_header = get_theme_mod('front_header_type' ,'image');
	$site_header = get_theme_mod('site_header_type', 'nothing');
	global $post;
	if ( !is_404() && !is_search() ) {
		$single_toggle = get_post_meta( $post->ID, '_exago_header_key', true );
	} else {
		$single_toggle = false;
	}

	if ( get_header_image() && ( $front_header == 'image' && is_front_page() ) || ( $site_header == 'image' && !is_front_page() ) ) {
		if (!$single_toggle)
		return 'has-header';
	} elseif ( ($front_header == 'shortcode' && is_front_page()) || ($site_header == 'shortcode' && !is_front_page()) ) {
		if (!$single_toggle)
		return 'has-shortcode';
	}
}

/**
 * Full width single posts
 */
function exago_fullwidth_singles($classes) {
	if ( function_exists('is_woocommerce') ) {
		$woocommerce = is_woocommerce();
	} else {
		$woocommerce = false;
	}

	$single_layout = get_theme_mod('fullwidth_single', 0);
	if ( is_single() && !$woocommerce && $single_layout ) {
		$classes[] = 'fullwidth-single';
	}
	return $classes;
}
add_filter('body_class', 'exago_fullwidth_singles');

/**
 * Polylang compatibility
 */
if ( function_exists('pll_register_string') ) :
function exago_polylang() {
	pll_register_string('Header text', get_theme_mod('header_text'), 'exago');
	pll_register_string('Header subtext', get_theme_mod('header_subtext'), 'exago');
	pll_register_string('Header button', get_theme_mod('header_button'), 'exago');
}
add_action( 'admin_init', 'exago_polylang' );
endif;

/**
 * Header text
 */
function exago_header_text() {

	if ( !function_exists('pll_register_string') ) {
		$header_text 		= get_theme_mod('header_text');
		$header_subtext 	= get_theme_mod('header_subtext');
		$header_button		= get_theme_mod('header_button');
	} else {
		$header_text 		= pll__(get_theme_mod('header_text'));
		$header_subtext 	= pll__(get_theme_mod('header_subtext'));
		$header_button		= pll__(get_theme_mod('header_button'));
	}
	$header_button_url	= get_theme_mod('header_button_url');

	echo '<div class="header-info">
			<div class="container">
				<h4 class="header-subtext">' . wp_kses_post($header_subtext) . '</h4>
				<h3 class="header-text">' . wp_kses_post($header_text) . '</h3>';
				if ($header_button_url) {
					echo '<a class="button header-button" href="' . esc_url($header_button_url) . '">' . esc_html($header_button) . '</a>';
				}
	echo 	'</div>';
	echo '</div>';
}

/**
 * Site branding
 */
if ( ! function_exists( 'exago_branding' ) ) :
function exago_branding() {
	$site_logo = get_theme_mod('site_logo');
	if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
		the_custom_logo();
	} elseif ( $site_logo ) {
		echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr(get_bloginfo('name')) . '"><img class="site-logo" src="' . esc_url($site_logo) . '" alt="' . esc_attr(get_bloginfo('name')) . '" /></a>';
	} else {
		echo '<h1 class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . esc_html(get_bloginfo('name')) . '</a></h1>';
		echo '<p class="site-description">' . esc_html(get_bloginfo( 'description' )) . '</p>';
	}
}
endif;

/**
 * Footer site branding
 */
if ( ! function_exists( 'exago_footer_branding' ) ) :
function exago_footer_branding() {
	$footer_logo = get_theme_mod('footer_logo');
	echo '<div class="footer-branding">';
	if ( $footer_logo ) :
		echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr(get_bloginfo('name')) . '"><img class="footer-logo" src="' . esc_url($footer_logo) . '" alt="' . esc_attr(get_bloginfo('name')) . '" /></a>';
	else :
		echo '<h2 class="site-title-footer"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . esc_html(get_bloginfo('name')) . '</a></h1>';
	endif;
	echo '</div>';
}
endif;

/**
 * Footer contact
 */
if ( ! function_exists( 'exago_footer_contact' ) ) :
function exago_footer_contact() {
	$footer_contact_address = get_theme_mod('footer_contact_address');
	$footer_contact_email   = antispambot(get_theme_mod('footer_contact_email'));
	$footer_contact_phone 	= get_theme_mod('footer_contact_phone');

	echo '<div class="footer-contact">';
	if ($footer_contact_address) {
		echo '<div class="footer-contact-block">';
		echo 	'<i class="fa fa-home"></i>';
		echo 	'<span>' . esc_html($footer_contact_address) . '</span>';
		echo '</div>';
	}
	if ($footer_contact_email) {
		echo '<div class="footer-contact-block">';
		echo 	'<i class="fa fa-envelope"></i>';
		echo 	'<span><a href="mailto:' . esc_attr($footer_contact_email) . '">' . esc_html($footer_contact_email) . '</a></span>';
		echo '</div>';
	}
	if ($footer_contact_phone) {
		echo '<div class="footer-contact-block">';
		echo 	'<i class="fa fa-phone"></i>';
		echo 	'<span>' . esc_html($footer_contact_phone) . '</span>';
		echo '</div>';
	}
	echo '</div>';

}
endif;

/**
 * Clearfix posts
 */
function exago_clearfix_posts( $classes ) {
	$classes[] = 'clearfix';
	return $classes;
}
add_filter( 'post_class', 'exago_clearfix_posts' );

/**
 * Excerpt length
 */
function exago_excerpt_length( $length ) {
  $excerpt = get_theme_mod('exc_length', '40');
  return absint($excerpt);
}
add_filter( 'excerpt_length', 'exago_excerpt_length', 99 );

/**
* Footer credits
*/
function exago_footer_credits() {
	echo '<a href="' . esc_url( __( 'https://wordpress.org/', 'exago' ) ) . '">';
		printf( __( 'Powered by %s', 'exago' ), 'WordPress' );
	echo '</a>';
	echo '<span class="sep"> | </span>';
	printf( __( 'Theme: %2$s by %1$s.', 'exago' ), 'aThemes', '<a href="http://athemes.com/theme/exago" rel="designer">exago</a>' );
}
add_action( 'exago_footer', 'exago_footer_credits' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Widget options
 */
require get_template_directory() . '/inc/framework/widget-options.php';

/**
 * Styles
 */
require get_template_directory() . '/inc/styles.php';

/**
 * Woocommerce
 */
require get_template_directory() . '/woocommerce/woocommerce.php';
