<?php
/**
 * Asset enqueueing.
 *
 * @package Flowerdrawings
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueues theme styles and scripts.
 */
function flowerdrawings_enqueue_assets(): void {
	$flowerdrawings_version = FLOWERDRAWINGS_THEME_VERSION;
	$flowerdrawings_uri     = FLOWERDRAWINGS_THEME_URI;

	$flowerdrawings_styles = array(
		'flowerdrawings-tokens'     => '/assets/css/tokens.css',
		'flowerdrawings-base'       => '/assets/css/base.css',
		'flowerdrawings-layout'     => '/assets/css/layout.css',
		'flowerdrawings-components' => '/assets/css/components.css',
		'flowerdrawings-homepage'   => '/assets/css/homepage.css',
		'flowerdrawings-tutorial'   => '/assets/css/tutorial.css',
	);

	$flowerdrawings_previous = null;
	foreach ( $flowerdrawings_styles as $flowerdrawings_handle => $flowerdrawings_path ) {
		$flowerdrawings_deps = $flowerdrawings_previous ? array( $flowerdrawings_previous ) : array();
		wp_enqueue_style(
			$flowerdrawings_handle,
			$flowerdrawings_uri . $flowerdrawings_path,
			$flowerdrawings_deps,
			$flowerdrawings_version
		);
		$flowerdrawings_previous = $flowerdrawings_handle;
	}

	wp_enqueue_style(
		'flowerdrawings-child',
		get_stylesheet_uri(),
		array( 'flowerdrawings-tutorial' ),
		$flowerdrawings_version
	);

	$flowerdrawings_scripts = array(
		'flowerdrawings-navigation' => '/assets/js/navigation.js',
		'flowerdrawings-accordion'  => '/assets/js/accordion.js',
		'flowerdrawings-reveal'     => '/assets/js/reveal.js',
		'flowerdrawings-worksheet'  => '/assets/js/worksheet.js',
	);

	foreach ( $flowerdrawings_scripts as $flowerdrawings_handle => $flowerdrawings_path ) {
		wp_enqueue_script(
			$flowerdrawings_handle,
			$flowerdrawings_uri . $flowerdrawings_path,
			array(),
			$flowerdrawings_version,
			array(
				'in_footer' => true,
				'strategy'  => 'defer',
			)
		);
	}
}
add_action( 'wp_enqueue_scripts', 'flowerdrawings_enqueue_assets', 20 );

/**
 * Preloads the homepage hero image.
 */
function flowerdrawings_preload_hero(): void {
	if ( ! is_front_page() ) {
		return;
	}

	$flowerdrawings_hero = flowerdrawings_asset_url( 'images/flower-drawing/home/flower-drawing-hero.webp' );
	printf(
		'<link rel="preload" as="image" href="%s" fetchpriority="high" />' . "\n",
		esc_url( $flowerdrawings_hero )
	);
}
add_action( 'wp_head', 'flowerdrawings_preload_hero', 2 );

/**
 * Outputs favicon link tags from theme icons.
 */
function flowerdrawings_favicon_links(): void {
	$flowerdrawings_icons = FLOWERDRAWINGS_THEME_URI . '/assets/icons';
	printf( '<link rel="icon" href="%s" sizes="32x32" />' . "\n", esc_url( $flowerdrawings_icons . '/favicon-32x32.png' ) );
	printf( '<link rel="icon" href="%s" sizes="16x16" />' . "\n", esc_url( $flowerdrawings_icons . '/favicon-16x16.png' ) );
	printf( '<link rel="shortcut icon" href="%s" />' . "\n", esc_url( $flowerdrawings_icons . '/favicon.ico' ) );
	printf( '<link rel="apple-touch-icon" href="%s" />' . "\n", esc_url( $flowerdrawings_icons . '/apple-touch-icon.png' ) );
}
add_action( 'wp_head', 'flowerdrawings_favicon_links', 3 );
