<?php
/**
 * Mich Starter
 *
 * @package      Mich_Starter
 * @link         http://michelventura.com
 * @author       Michel Ventura
 * @copyright    Copyright (c) 2016, Michel Ventura
 * @license      GPL-3.0+
 */

// This file loads the Google fonts used in this theme.
require get_stylesheet_directory() . '/includes/google-fonts.php';

// This file loads Font Awesome used in this theme.
require get_stylesheet_directory() . '/includes/font-awesome.php';

// This file contains search form improvements.
require get_stylesheet_directory() . '/includes/class-search-form.php';

add_action( 'genesis_setup', 'mich_starter_setup', 15 );
/**
 * Theme setup.
 *
 */
function mich_starter_setup() {

	define( 'CHILD_THEME_NAME', 'mich-starter' );
	define( 'CHILD_THEME_URL', 'http://michelventura.com' );
	define( 'CHILD_THEME_VERSION', '1.0' );

	// Add HTML5 markup structure.
	add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

	// Add viewport meta tag for mobile browsers.
	add_theme_support( 'genesis-responsive-viewport' );

	// Add support for custom background.
	add_theme_support( 'custom-background', array( 'wp-head-callback' => '__return_false' ) );

	// Add support for accessibility features.
	add_theme_support( 'genesis-accessibility', array( '404-page', 'headings', 'skip-links' ) );

	// Add support for three footer widget areas.
	add_theme_support( 'genesis-footer-widgets', 2 );

	// Add support for structural wraps (all default Genesis wraps unless noted).
	add_theme_support(
		'genesis-structural-wraps',
		array(
			'footer',
			'footer-widgets',
			'footernav',    // Custom.
			'header',
			'inicio-titulo', // Custom.
			'home-servicio', // Custom.
			'home-latest-posts', // Custom.
			'menu-footer',  // Custom.
			'nav',
			'site-inner',
			'site-tagline',
		)
	);

	// Add support for two navigation areas (theme doesn't use secondary navigation).
	add_theme_support(
		'genesis-menus',
		array(
			'primary' => __( 'Primary Navigation Menu', 'mich-starter' ),
			'footer'  => __( 'Footer Navigation Menu', 'mich-starter' ),
		)
	);

	// Add custom image sizes.
	add_image_size( 'feature-large', 960, 330, true );

	// Register a custom image size for images in Home Tabs section
	 add_image_size( 'home-tabs', 380, 480, true );

	// Unregister secondary sidebar.
	unregister_sidebar( 'sidebar-alt' );

	// Unregister layouts that use secondary sidebar.
	genesis_unregister_layout( 'content-sidebar-sidebar' );
	genesis_unregister_layout( 'sidebar-content-sidebar' );
	genesis_unregister_layout( 'sidebar-sidebar-content' );

	// Register the default widget areas.
	mich_starter_register_widget_areas();

	// Add featured image above posts.
	add_filter( 'the_content', 'mich_starter_featured_image' );

	// Add a navigation area above the site footer.
	add_action( 'genesis_before_footer', 'mich_starter_do_footer_nav' );

	// Remove Genesis archive pagination (Genesis pagination settings still apply).
	remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );

	// Add WordPress archive pagination (accessibility).
	add_action( 'genesis_after_endwhile', 'mich_starter_post_pagination' );

	// Apply search form enhancements (accessibility).
	add_filter( 'get_search_form', 'mich_starter_get_search_form', 25 );

}


/**
 * Add featured image above single posts.
 *
 */
function mich_starter_featured_image( $content ) {

	if ( ! is_singular( 'post' ) || ! has_post_thumbnail() ) {
		return $content;
	}

	$image = '<div class="featured-image">';
	$image .= get_the_post_thumbnail( get_the_ID(), 'feature-large' );
	$image .= '</div>';

	return $image . $content;
}

add_filter( 'genesis_footer_creds_text', 'mich_starter_footer_creds' );
/**
 * Change the footer text.
 *
 */
function mich_starter_footer_creds( $creds ) {

	return '&copy; 2016 por <a href="http://michelventura.com" rel="nofollow">Michel Ventura</a>.';
}

add_filter( 'genesis_author_box_gravatar_size', 'mich_starter_author_box_gravatar_size' );
/**
 * Customize the Gravatar size in the author box.
 *
 */
function mich_starter_author_box_gravatar_size( $size ) {
	return 96;
}

// Add theme widget areas.
include get_stylesheet_directory() . '/includes/widget-areas.php';

// Add footer navigation components.
include get_stylesheet_directory() . '/includes/footer-nav.php';

// Add scripts to enqueue.
include get_stylesheet_directory() . '/includes/enqueue-assets.php';

// Miscellaenous functions used in theme configuration.
include get_stylesheet_directory() . '/includes/theme-config.php';

// Featured Post Combo Widget customization

add_action( 'gfpc_before_entry', 'mv_post_info_before_title', 10, 2 );
function mv_post_info_before_title( $instance, $widget_id ) {
	if ( ( $widget_id == "gfpc-widget-1" ) ) {
		remove_action( 'gfpc_entry_header', 'gfpc_do_post_info', 12, 2 );
		add_action( 'gfpc_entry_header', 'gfpc_do_post_info', 7, 2 );
	}
}

//* Remove post info
add_filter( 'genesis_post_info', 'mv_post_info_filter' );
function mv_post_info_filter() {
	return;
}

//* Add custom social fields in User Profile page in WP admin
function my_new_contactmethods( $contactmethods ) {
	$contactmethods['twitter'] = 'Twitter (w/o the @)';
	$contactmethods['instagram'] = 'Instagram URL';
	$contactmethods['rss'] = 'RSS Feed URL';

	return $contactmethods;
}
add_filter( 'user_contactmethods', 'my_new_contactmethods', 10, 1 );

// Display user profile fields after title in author box
add_filter( 'genesis_author_box_title', 'sk_add_twitter_author_box_title', 10, 1 );
function sk_add_twitter_author_box_title( $title ) {

	$email_address = get_the_author_meta( 'email' );
	$website_url = get_the_author_meta( 'url' );
	$twitter_handle = ltrim( get_the_author_meta( 'twitter' ), '@' );
	$instagram_url = get_the_author_meta( 'instagram' );
	$rss_url = get_the_author_meta( 'rss' );

	$author_display_name = get_the_author_meta( 'display_name', (int) get_query_var( 'author' ) );

	$email = sprintf(
		'<span class="email author-box-social"><a href="mailto: %s" title="Send an email to %s"><i class="fa fa-envelope" aria-hidden="true"></i></a></span>',
		esc_url( $email_address ),
		$author_display_name
	);

	if ( !empty( $website_url ) ) {
		$website_link = sprintf(
			'<span class="website author-box-social"><a href="%s" target="_blank" title="Visit %s\'s site"><i class="fa fa-globe" aria-hidden="true"></i></a></span>',
			esc_url( $website_url ),
			$author_display_name
		);
	}

	if ( !empty( $twitter_handle ) ) {
		$twitter_link = sprintf(
			'<span class="twitter author-box-social"><a href="%s" target="_blank" title="Visit %s on Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></span>',
			esc_url( 'https://twitter.com/' . $twitter_handle ),
			$author_display_name
		);
	}

	if ( !empty( $instagram_url ) ) {
		$instagram_link = sprintf(
			'<span class="instagram author-box-social"><a href="%s" target="_blank" title="Visit %s on Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></span>',
			esc_url( $instagram_url ),
			$author_display_name
		);
	}

	if ( !empty( $rss_url ) ) {
		$rss_link = sprintf(
			'<span class="rss author-box-social"><a href="%s" target="_blank" title="Visit %s\'s RSS Feed"><i class="fa fa-rss" aria-hidden="true"></i></a></span>',
			esc_url( $rss_url ),
			$author_display_name
		);
	}

	return $title . $email . $website_link . $twitter_link . $instagram_link . $rss_link;
}

add_filter( 'simple_social_default_profiles', 'custom_simple_social_default_profiles' );
function custom_simple_social_default_profiles() {
	$glyphs = array(
			'bloglovin'		=> '&#xe60c;',
			'dribbble'		=> '&#xe602;',
			'email'			=> '&#xe60d;',
			'facebook'		=> '&#xe606;',
			'flickr'		=> '&#xe609;',
			'github'		=> '&#xe60a;',
			'gplus'			=> '&#xe60e;',
			'instagram' 	=> '&#xe600;',
			'linkedin'		=> '&#xe603;',
			'pinterest'		=> '&#xe605;',
			'rss'			=> '&#xe60b;',
			'stumbleupon'	=> '&#xe601;',
			'tumblr'		=> '&#xe604;',
			'twitter'		=> '&#xe607;',
			'vimeo'			=> '&#xe608;',
			'youtube'		=> '&#xe60f;',
		);

	$profiles = array(
			'dribbble' => array(
				'label'   => __( 'Dribbble URI', 'simple-social-icons' ),
				'pattern' => '<li class="social-dribbble"><a href="%s" %s>' . $glyphs['dribbble'] . '</a></li>',
			),
			'bloglovin' => array(
				'label'   => __( 'Bloglovin URI', 'simple-social-icons' ),
				'pattern' => '<li class="social-bloglovin"><a href="%s" %s>' . $glyphs['bloglovin'] . '</a></li>',
			),
			'email' => array(
				'label'   => __( 'Email URI', 'simple-social-icons' ),
				'pattern' => '<li class="social-email"><a href="%s" %s>' . $glyphs['email'] . '</a></li>',
			),
			'facebook' => array(
				'label'   => __( 'Facebook URI', 'simple-social-icons' ),
				'pattern' => '<li class="social-facebook"><a href="%s" %s>' . $glyphs['facebook'] . '</a></li>',
			),
			'flickr' => array(
				'label'   => __( 'Flickr URI', 'simple-social-icons' ),
				'pattern' => '<li class="social-flickr"><a href="%s" %s>' . $glyphs['flickr'] . '</a></li>',
			),
			'github' => array(
				'label'   => __( 'GitHub URI', 'simple-social-icons' ),
				'pattern' => '<li class="social-github"><a href="%s" %s>' . $glyphs['github'] . '</a></li>',
			),
			'gplus' => array(
				'label'   => __( 'Google+ URI', 'simple-social-icons' ),
				'pattern' => '<li class="social-gplus"><a href="%s" %s>' . $glyphs['gplus'] . '</a></li>',
			),
			'twitter' => array(
				'label'   => __( 'Twitter URI', 'simple-social-icons' ),
				'pattern' => '<li class="social-twitter"><a href="%s" %s>' . $glyphs['twitter'] . '</a></li>',
			),
			'instagram' => array(
				'label'   => __( 'Instagram URI', 'simple-social-icons' ),
				'pattern' => '<li class="social-instagram"><a href="%s" %s>' . $glyphs['instagram'] . '</a></li>',
			),
			'linkedin' => array(
				'label'   => __( 'Linkedin URI', 'simple-social-icons' ),
				'pattern' => '<li class="social-linkedin"><a href="%s" %s>' . $glyphs['linkedin'] . '</a></li>',
			),
			'pinterest' => array(
				'label'   => __( 'Pinterest URI', 'simple-social-icons' ),
				'pattern' => '<li class="social-pinterest"><a href="%s" %s>' . $glyphs['pinterest'] . '</a></li>',
			),
			'rss' => array(
				'label'   => __( 'RSS URI', 'simple-social-icons' ),
				'pattern' => '<li class="social-rss"><a href="%s" %s>' . $glyphs['rss'] . '</a></li>',
			),
			'stumbleupon' => array(
				'label'   => __( 'StumbleUpon URI', 'simple-social-icons' ),
				'pattern' => '<li class="social-stumbleupon"><a href="%s" %s>' . $glyphs['stumbleupon'] . '</a></li>',
			),
			'tumblr' => array(
				'label'   => __( 'Tumblr URI', 'simple-social-icons' ),
				'pattern' => '<li class="social-tumblr"><a href="%s" %s>' . $glyphs['tumblr'] . '</a></li>',
			),
			'vimeo' => array(
				'label'   => __( 'Vimeo URI', 'simple-social-icons' ),
				'pattern' => '<li class="social-vimeo"><a href="%s" %s>' . $glyphs['vimeo'] . '</a></li>',
			),
			'youtube' => array(
				'label'   => __( 'YouTube URI', 'simple-social-icons' ),
				'pattern' => '<li class="social-youtube"><a href="%s" %s>' . $glyphs['youtube'] . '</a></li>',
			),
		);

	return $profiles;
}


//* Modify breadcrumb arguments.
add_filter( 'genesis_breadcrumb_args', 'mv_breadcrumb_args' );
function mv_breadcrumb_args( $args ) {
	$args['home'] = 'Inicio';
	$args['sep'] = ' » ';
	$args['list_sep'] = ', '; // Genesis 1.5 and later
	$args['prefix'] = '<div class="breadcrumb">';
	$args['suffix'] = '</div>';
	$args['heirarchial_attachments'] = true; // Genesis 1.5 and later
	$args['heirarchial_categories'] = true; // Genesis 1.5 and later
	$args['display'] = true;
	$args['labels']['prefix'] = '';
	$args['labels']['author'] = 'Publicaciones de ';
	$args['labels']['category'] = 'Publicaciones de '; // Genesis 1.6 and later
	$args['labels']['tag'] = 'Archivos de ';
	$args['labels']['date'] = 'Archivos de ';
	$args['labels']['search'] = 'Buscar ';
	$args['labels']['tax'] = 'Archivos de ';
	$args['labels']['post_type'] = 'Publicaciones de ';
	$args['labels']['404'] = 'No se encontro: '; // Genesis 1.5 and later
return $args;
}

// Load Flexbox Grid
add_action( 'wp_enqueue_scripts', 'mv_enqueue_flexbox_grid' );
	  function mv_enqueue_flexbox_grid() {
		wp_enqueue_style( 'flexboxgrid', CHILD_URL . '/css/flexboxgrid.min.css' );
}

//* HIDE LOGIN ERROR MESSAGES (Wrong Password, No Such User etc.)
add_filter('login_errors',create_function('$a', "return null;"));

//* Customize the post meta function
add_filter( 'genesis_post_meta', 'custom_post_meta_filter' );
function custom_post_meta_filter($post_meta) {
if ( !is_page() ) {
	$post_meta = '[post_categories before="Categoria: "]';
	return $post_meta;
}}

// Custom author box
//* Customize the author box title
add_filter( 'genesis_author_box_title', 'custom_author_box_title' );
function custom_author_box_title() {
	return '<strong>Sobre Mich</strong>';
}

//* Remove the edit link
add_filter ( 'genesis_edit_post_link' , '__return_false' );
