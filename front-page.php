<?php
/**
 * Front page for Mich Starter theme
 *
 * @package Mich_Starter
 * @author  Michel Ventura
 * @license GPL-3.0+
 */

add_action( 'genesis_meta', 'mich_starter_homepage_setup' );
/**
 * Set up the homepage layout by conditionally loading sections when widgets
 * are active.
 *
 * @since 1.0.0
 */
function mich_starter_homepage_setup() {

	$home_sidebars = array(
		'seccion_hero' 	   => is_active_sidebar( 'starter-inicio-bienvenido' ),
		'inicio_titulo'    => is_active_sidebar( 'starter-inicio-titulo' ),
		'home_servicio_1'  => is_active_sidebar( 'starter-home-servicio-1' ),
		'ultimas_publicaciones'   => is_active_sidebar( 'starter-ultimas-publicaciones' ),
		'call_to_action'   => is_active_sidebar( 'starter-call-to-action' ),
	);

	// Return early if no sidebars are active.
	if ( ! in_array( true, $home_sidebars ) ) {
		return;
	}

	// Get static home page number.
	$page = ( get_query_var( 'page' ) ) ? (int) get_query_var( 'page' ) : 1;

	// Only show home page widgets on page 1.
	if ( 1 === $page ) {

		// Add home welcome area if "Home Welcome" widget area is active.
		if ( $home_sidebars['seccion_hero'] ) {
			add_action( 'genesis_after_header', 'mich_starter_add_seccion_hero' );
		}

		// Add home servicio titulo if active.
		if ( $home_sidebars['inicio_titulo'] ) {
			add_action( 'genesis_after_header', 'mich_starter_add_inicio_titulo' );
		}

		// Add home servicio area if "Home servicio 1" widget area is active.
		if ( $home_sidebars['home_servicio_1'] ) {
			add_action( 'genesis_after_header', 'mich_starter_add_home_servicio' );
		}

		// Add latest post area if "Últimas publicaciones" widget area is active.
		if ( $home_sidebars['ultimas_publicaciones'] ) {
			add_action( 'genesis_after_header', 'mich_starter_add_home_latest_posts' );
		}

		// Add call to action area if "Call to Action" widget area is active.
		if ( $home_sidebars['call_to_action'] ) {
			add_action( 'genesis_after_header', 'mich_starter_add_call_to_action' );
		}


	}

		// Full width layout
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

		// Remove standard loop and replace with loop showing Posts, not Page content.
		remove_action( 'genesis_loop', 'genesis_do_loop' );

		// We've already removed the loop. We don't want to add this custom one in.
		// add_action ( 'genesis_loop', 'mich_starter_front_loop' );
}

/**
 * Use h1 for site title on a static front page.
 *
 * Hat tip to Bill Erickson for the suggestion.
 *
 * @see http://www.billerickson.net/genesis-h1-front-page/
 *
 * @since 1.2.0
 */
function mich_starter_return_h1( $wrap ) {
	return 'h1';
}

/**
 * Display content for the "Home Welcome" section.
 *
 * @since 1.0.0
 */function mich_starter_add_seccion_hero() {

	genesis_widget_area( 'starter-inicio-bienvenido',
		array(
			'before' => '<div class="seccion-hero"><div class="wrap">',
			'after' => '</div></div>',
		)
	);
}

// Mostrar título de servicios
function mich_starter_add_inicio_titulo() {

	genesis_widget_area( 'starter-inicio-titulo',
		array(
			'before' => '<div class="starter-inicio-titulo"><div class="wrap">',
			'after' => '</div></div>',
		)
	);
}

/**
 * Display content for the "Home servicio" section.
 *
 * @since 1.0.0
 */
function mich_starter_add_home_servicio() {

	printf( '<div %s>', genesis_attr( 'home-servicio' ) );
	genesis_structural_wrap( 'home-servicio' );

	genesis_widget_area(
		'starter-home-servicio-1',
		array(
			'before' => '<div class="home-servicio-1 widget-area">',
			'after'  => '</div>',
		)
	);

	genesis_widget_area(
		'starter-home-servicio-2',
		array(
			'before' => '<div class="home-servicio-2 widget-area">',
			'after'  => '</div>',
		)
	);

	genesis_structural_wrap( 'home-servicio', 'close' );
	echo '</div>';
}

/**
 * Display latest post from widget
 *
 * @since 1.0.0
 */
function mich_starter_add_home_latest_posts() {

	printf( '<div %s>', genesis_attr( 'home-latest-posts' ) );
	genesis_structural_wrap( 'home-latest-posts' );

	genesis_widget_area(
		'starter-ultimas-publicaciones',
		array(
			'before' => '<div class="ultimas-publicaciones widget-area"><div class="wrap">',
			'after' => '</div></div>',
		)
	);

	genesis_structural_wrap( 'home-latest-posts', 'close' );
	echo '</div>';
}

/**
 * Display content for the "Call to action" section.
 *
 * @since 1.0.0
 */
function mich_starter_add_call_to_action() {

	genesis_widget_area(
		'starter-call-to-action',
		array(
			'before' => '<div class="call-to-action-bar"><div class="wrap">',
			'after' => '</div></div>',
		)
	);
}

genesis();
