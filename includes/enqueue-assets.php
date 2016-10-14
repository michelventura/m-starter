<?php
/**
 * Mich Starter.
 *
 * @package      Mich_Starter
 * @link         http://michelventura.com
 * @author       Michel Ventura
 * @copyright    Copyright (c) 2016, Michel Ventura
 * @license      GPL-3.0+
 */

add_action( 'wp_enqueue_scripts', 'mich_starter_enqueue_assets' );
/**
 * Enqueue theme assets.
 *
 * @since 1.0.0
 */
function mich_starter_enqueue_assets() {

	// Replace style.css with style-rtl.css for RTL languages.
	wp_style_add_data( 'mich-starter', 'rtl', 'replace' );

	// Keyboard navigation (dropdown menus) script.
	wp_enqueue_script( 'genwpacc-dropdown',  get_stylesheet_directory_uri() . '/js/genwpacc-dropdown.js', array( 'jquery' ), false, true );

	// Load mobile responsive menu.
	wp_enqueue_script( 'mich-starter-responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menu.min.js', array( 'jquery' ), '1.0.0', true );

	// Load interactive switcher.
	wp_enqueue_script( 'mich-starter-interactive-switcher', get_stylesheet_directory_uri() . '/js/interactive-switcher.js', array( 'jquery' ), '1.0.0', true );

	$localize_primary = array(
		'buttonText'     => __( 'Menu', 'mich-starter' ),
		'buttonLabel'    => __( 'Primary Navigation Menu', 'mich-starter' ),
		'subButtonText'  => __( 'Sub Menu', 'mich-starter' ),
		'subButtonLabel' => __( 'Sub Menu', 'mich-starter' ),
	);

	$localize_footer = array(
		'buttonText'     => __( 'Footer Menu', 'mich-starter' ),
		'buttonLabel'    => __( 'Footer Navigation Menu', 'mich-starter' ),
		'subButtonText'  => __( 'Sub Menu', 'mich-starter' ),
		'subButtonLabel' => __( 'Sub Menu', 'mich-starter' ),
	);

	// Localize the responsive menu script (for translation).
	wp_localize_script( 'mich-starter-responsive-menu', 'starterMenuPrimaryL10n', $localize_primary );
	wp_localize_script( 'mich-starter-responsive-menu', 'starterMenuFooterL10n', $localize_footer );

	wp_enqueue_script( 'mich-starter', get_stylesheet_directory_uri() . '/js/responsive-menu.args.js', array( 'mich-starter-responsive-menu' ), CHILD_THEME_VERSION, true );

	// Make Font Awesome available
	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css' );

	// Load Backstretch scripts only if custom background is being used
	// and we're on the home page or a page using the landing page template.
	if ( ! get_background_image() || ( ! ( is_front_page() || is_page_template( 'page_landing.php' ) ) ) ) {
		return;
	}

	wp_enqueue_script( 'mich-starter-backstretch', get_stylesheet_directory_uri() . '/js/backstretch.min.js', array( 'jquery' ), '2.0.1', true );
	wp_enqueue_script( 'mich-starter-backstretch-args', get_stylesheet_directory_uri() . '/js/backstretch.args.js', array( 'mich-starter-backstretch' ), CHILD_THEME_VERSION, true );
	wp_localize_script( 'mich-starter', 'starterBackstretchL10n', array( 'src' => get_background_image() ) );

}
