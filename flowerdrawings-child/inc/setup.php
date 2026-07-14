<?php
/**
 * Theme setup and parent-theme checks.
 *
 * @package Flowerdrawings
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers theme supports and menus.
 */
function flowerdrawings_theme_setup(): void {
	load_child_theme_textdomain( 'flowerdrawings', FLOWERDRAWINGS_THEME_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 96,
			'width'       => 96,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	register_nav_menus(
		array(
			'flowerdrawings_primary' => __( 'Primary Navigation', 'flowerdrawings' ),
			'flowerdrawings_footer'  => __( 'Footer Navigation', 'flowerdrawings' ),
		)
	);
}
add_action( 'after_setup_theme', 'flowerdrawings_theme_setup' );

/**
 * Shows an admin notice when Kadence is not active.
 */
function flowerdrawings_kadence_missing_notice(): void {
	if ( ! current_user_can( 'activate_themes' ) ) {
		return;
	}

	$flowerdrawings_parent = wp_get_theme( get_template() );
	if ( $flowerdrawings_parent->exists() && 'kadence' === $flowerdrawings_parent->get_stylesheet() ) {
		return;
	}

	// Also accept template directory named kadence.
	if ( 'kadence' === get_template() ) {
		return;
	}

	echo '<div class="notice notice-error"><p>';
	echo esc_html__( 'FlowerDrawings Child requires the Kadence parent theme. Please install and activate Kadence, then reactivate this child theme.', 'flowerdrawings' );
	echo '</p></div>';
}
add_action( 'admin_notices', 'flowerdrawings_kadence_missing_notice' );

/**
 * Adds site icon fallbacks from theme assets when none is set.
 */
function flowerdrawings_site_icon_fallback( $flowerdrawings_url ) {
	if ( ! empty( $flowerdrawings_url ) ) {
		return $flowerdrawings_url;
	}

	return FLOWERDRAWINGS_THEME_URI . '/assets/icons/site-icon-512.png';
}
add_filter( 'get_site_icon_url', 'flowerdrawings_site_icon_fallback', 10, 1 );
