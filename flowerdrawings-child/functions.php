<?php
/**
 * FlowerDrawings Child theme bootstrap.
 *
 * @package Flowerdrawings
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'FLOWERDRAWINGS_THEME_VERSION', '1.0.0' );
define( 'FLOWERDRAWINGS_THEME_DIR', get_stylesheet_directory() );
define( 'FLOWERDRAWINGS_THEME_URI', get_stylesheet_directory_uri() );

$flowerdrawings_includes = array(
	'/inc/setup.php',
	'/inc/enqueue.php',
	'/inc/image-helpers.php',
	'/inc/template-tags.php',
	'/inc/seo.php',
	'/inc/schema.php',
);

foreach ( $flowerdrawings_includes as $flowerdrawings_include ) {
	$flowerdrawings_path = FLOWERDRAWINGS_THEME_DIR . $flowerdrawings_include;
	if ( is_readable( $flowerdrawings_path ) ) {
		require_once $flowerdrawings_path;
	}
}
