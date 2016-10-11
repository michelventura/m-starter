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

// Enable shortcodes in widgets.
add_filter( 'widget_text', 'do_shortcode' );

add_filter( 'theme_page_templates', 'mich_starter_remove_genesis_page_templates' );
/**
 * Remove Genesis Blog page template.
 *
 */
function mich_starter_remove_genesis_page_templates( $page_templates ) {
	unset( $page_templates['page_blog.php'] );
	return $page_templates;
}

add_filter( 'genesis_attr_nav-footer', 'mich_starter_add_nav_secondary_id' );
/**
 * Add ID to footer nav.
 *
 */
function mich_starter_add_nav_secondary_id( $attributes ) {
	$attributes['id'] = 'genesis-nav-footer';
	return $attributes;
}

add_filter( 'genesis_skip_links_output', 'mich_starter_add_nav_secondary_skip_link' );
/**
 * Add skip link to footer navigation.
 *
 * @since 1.2.1
 *
 * @param array Default skiplinks.
 * @return array Amended markup for Genesis skip links.
 */
function mich_starter_add_nav_secondary_skip_link( $links ) {
	$new_links = $links;
	array_splice( $new_links, 1 );

	if ( has_nav_menu( 'footer' ) ) {
		$new_links['genesis-nav-footer'] = __( 'Skip to footer navigation', 'mich_starter' );
	}

	return array_merge( $new_links, $links );
}

/**
 * Customize the search form to improve accessibility.
 *
 */
function mich_starter_get_search_form() {
	$search = new mich_starter_Search_Form;
	return $search->get_form();
}

/**
 * Use WordPress archive pagination.
 *
 * Return a paginated navigation to next/previous set of posts, when
 * applicable. Includes screen reader text for better accessibility.
 *
 * @since  1.0.0
 *
 * @see the_posts_pagination()
 */
function mich_starter_post_pagination() {
	$args = array(
		'mid_size' => 2,
		'before_page_number' => '<span class="screen-reader-text">' . __( 'Page', 'mich-starter' ) . ' </span>',
	);

	if ( 'numeric' === genesis_get_option( 'posts_nav' ) ) {
		the_posts_pagination( $args );
	} else {
		the_posts_navigation( $args );
	}
}
