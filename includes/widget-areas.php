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
 * Register the widget areas enabled by default in mich.
 *
 * @since  1.0.0
 */
function mich_starter_register_widget_areas() {

	$widget_areas = array(
		array(
			'id'          => 'starter-inicio-bienvenido',
			'name'        => __( 'Sección Hero', 'mich-starter' ),
			'description' => __( 'Aquí va el USP', 'mich-starter' ),
		),
		array(
			'id'          => 'starter-inicio-titulo',
			'name'        => __( 'Título de Servicios', 'mich-starter' ),
			'description' => __( 'Aquí va mi título de servicios', 'mich-starter' ),
		),
		array(
			'id'          => 'starter-home-servicio-1',
			'name'        => sprintf( _x( 'Home servicio %d', 'Group of Home servicio widget areas', 'mich-starter' ), 1 ),
			'description' => sprintf( _x( 'Home servicio %d widget area on home page.', 'Description of widget area', 'mich-starter' ), 1 ),
		),
		array(
			'id'          => 'starter-home-servicio-2',
			'name'        => sprintf( _x( 'Home servicio %d', 'Group of Home servicio widget areas', 'mich-starter' ), 2 ),
			'description' => sprintf( _x( 'Home servicio %d widget area on home page.', 'Description of widget area', 'mich-starter' ), 2 ),
		),
		array(
		'id'          	  => 'starter-ultimas-publicaciones',
		'name'        	  => __( 'Últimas publicaciones', 'mich-starter' ),
		'description' 	  => __( 'Mostrar las últimas publicaciones del blog', 'mich-starter' ),
		),
		array(
			'id'          => 'starter-call-to-action',
			'name'        => __( 'Call to Action', 'mich-starter' ),
			'description' => __( 'This is the Call to Action section on the home page.', 'mich-starter' ),
		),
	);

	$widget_areas = apply_filters( 'mich_starter_default_widget_areas', $widget_areas );

	foreach ( $widget_areas as $widget_area ) {
		genesis_register_sidebar( $widget_area );
	}
}