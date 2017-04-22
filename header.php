<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package exago
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="preloader">
<div class="preloader-inner">
	<ul><li></li><li></li><li></li><li></li><li></li><li></li></ul>
</div>
</div>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'exago' ); ?></a>

	<header id="masthead" class="site-header <?php echo exago_has_header(); ?>" role="banner">
		<div class="container">
			<div class="site-branding col-md-4 col-sm-6 col-xs-12">
				<?php exago_branding(); ?>
			</div>
			<div class="btn-menu col-md-8 col-sm-6 col-xs-12"><i class="fa fa-navicon"></i></div>
			<nav id="mainnav" class="main-navigation col-md-8 col-sm-6 col-xs-12" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
			</nav><!-- #site-navigation -->
		</div>
	</header><!-- #masthead -->

	<?php $exago_has_header = exago_has_header(); ?>
	<?php if ( $exago_has_header == 'has-header' ) : ?>
	<div class="header-image">
		<?php exago_header_text(); ?>
		<img class="large-header" src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" alt="<?php bloginfo('name'); ?>">

		<?php $mobile_default = get_template_directory_uri() . '/images/header-mobile.jpg'; ?>
		<?php $mobile = get_theme_mod('tablet_header', $mobile_default); ?>
		<?php if ( $mobile ) : ?>
		<img class="tablet-header" src="<?php echo esc_url($mobile); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" alt="<?php bloginfo('name'); ?>">
		<?php else : ?>
		<img class="tablet-header" src="<?php header_image(); ?>" width="1024" alt="<?php bloginfo('name'); ?>">
		<?php endif; ?>

		<?php $mobile_default = get_template_directory_uri() . '/images/header-mobile.jpg'; ?>
		<?php $mobile = get_theme_mod('mobile_header', $mobile_default); ?>
		<?php if ( $mobile ) : ?>
		<img class="small-header" src="<?php echo esc_url($mobile); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" alt="<?php bloginfo('name'); ?>">
		<?php else : ?>
		<img class="small-header" src="<?php header_image(); ?>" width="767" alt="<?php bloginfo('name'); ?>">
		<?php endif; ?>

		<?php $header_logo = get_template_directory_uri() . '/images/header-mobile.jpg'; ?>
		<?php $logo = get_theme_mod('header-logo', $header_logo); ?>
		<?php if ( $logo ) : ?>
		<img class="header-logo" src="<?php echo esc_url($logo); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" alt="<?php bloginfo('name'); ?>">
		<?php else : ?>
		<img class="header-logo" src="<?php header_image(); ?>" width="767" alt="<?php bloginfo('name'); ?>">
		<?php endif; ?>
	</div>

	<?php elseif ( $exago_has_header == 'has-shortcode' ) : ?>
	<div class="shortcode-area">
		<?php $shortcode = get_theme_mod('exago_shortcode'); ?>
		<?php echo do_shortcode(wp_kses_post($shortcode)); ?>
	</div>
	<?php elseif ( $exago_has_header == 'has-video' ) : ?>
		<?php the_custom_header_markup(); ?>
	<?php elseif ( $exago_has_header == 'has-single' ) : ?>
		<?php $single_toggle = get_post_meta( $post->ID, '_exago_single_header_shortcode', true ); ?>
		<?php echo do_shortcode(wp_kses_post($single_toggle)); ?>
	<?php else : ?>
	<div class="header-clone"></div>
	<?php endif; ?>

	<?php if ( !is_page_template('page-templates/page_widgetized.php') ) : ?>
		<?php $container = 'container'; ?>
	<?php else : ?>
		<?php $container = 'home-wrapper'; ?>
	<?php endif; ?>

	<?php do_action('exago_before_content'); ?>

	<div id="content" class="site-content">
		<div class="<?php echo $container; ?>">
