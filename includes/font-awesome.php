<?php

add_action( 'wp_enqueue_scripts', 'utility_pro_enqueue_font_awesome' );

// Load Font Awesome
add_action( 'wp_enqueue_scripts', 'utility_pro_enqueue_font_awesome' );
function utility_pro_enqueue_font_awesome() {

	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css' );

}