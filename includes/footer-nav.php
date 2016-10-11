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

/**
 * Output footer navigation menu.
 *
 * @since  1.0.0
 */
function mich_starter_do_footer_nav() {

	genesis_nav_menu(
		array(
			'menu_class'     => 'menu genesis-nav-menu menu-footer',
			'theme_location' => 'footer',
		)
	);
}

// Add schema markup to Footer Navigation Menu.
add_filter( 'genesis_attr_nav-footer', 'genesis_attributes_nav' );

add_filter( 'wp_nav_menu_args', 'mich_starter_footer_menu_args' );
/**
 * Reduce the footer navigation menu to one level depth.
 *
 * @since  1.0.0
 *
 * @param  array $args Existing footer menu args.
 * @return array Amended footer menu args.
 */
function mich_starter_footer_menu_args( $args ) {

	if ( 'footer' !== $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;
	return $args;
}
