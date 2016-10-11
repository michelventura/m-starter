<?php
/**
 *
 * @package Mich_Starter
 * @author Michel Ventura
 * @license GPL-3.0+
 */

// This file loads the Google fonts used in this theme.
add_action( 'wp_enqueue_scripts', 'mich_starter_enqueue_fonts' );
/**
 * Load fonts.
 *
 * @since 1.0.0
 */
function mich_starter_enqueue_fonts() {
	wp_enqueue_style( 'mich-starter-fonts', mich_starter_fonts_url(), array(), null );
}

/**
 * Build Google fonts URL.
 *
 * Hat tip to Frank Klein for the tutorial.
 *
 * @link http://themeshaper.com/2014/08/13/how-to-add-google-fonts-to-wordpress-themes/
 *
 * @since  1.0.0
 */
function mich_starter_fonts_url() {
	$fonts_url = '';

	$bitter = _x( 'on', 'Bitter font: on or off', 'mich-starter' );

	$raleway = _x( 'on', 'Raleway font: on or off', 'mich-starter' );

	if ( 'off' !== $bitter || 'off' !== $raleway ) {
		$font_families = array();

		if ( 'off' !== $bitter ) {
			$font_families[] = 'Bitter:400,700';
		}

		if ( 'off' !== $raleway ) {
			$font_families[] = 'Raleway:400,700';
		}

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
