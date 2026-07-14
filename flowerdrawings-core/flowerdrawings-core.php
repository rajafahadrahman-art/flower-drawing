<?php
/**
 * Plugin Name: FlowerDrawings Core
 * Description: Registers Flower Tutorials CPT, permalinks, meta fields, and patterns for FlowerDrawings.com
 * Version: 1.0.0
 * Requires at least: 6.5
 * Requires PHP: 8.1
 * Author: FlowerDrawings.com
 * Text Domain: flowerdrawings
 *
 * @package Flowerdrawings_Core
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'FLOWERDRAWINGS_CORE_VERSION', '1.0.0' );
define( 'FLOWERDRAWINGS_CORE_FILE', __FILE__ );
define( 'FLOWERDRAWINGS_CORE_PATH', plugin_dir_path( __FILE__ ) );
define( 'FLOWERDRAWINGS_CORE_URL', plugin_dir_url( __FILE__ ) );

/**
 * Loads the plugin class files.
 */
function flowerdrawings_core_load_files(): void {
	$flowerdrawings_core_files = array(
		'includes/class-post-type.php',
		'includes/class-permalinks.php',
		'includes/class-meta-fields.php',
		'includes/class-admin-columns.php',
		'includes/class-block-patterns.php',
		'includes/class-activation.php',
	);

	foreach ( $flowerdrawings_core_files as $flowerdrawings_core_file ) {
		require_once FLOWERDRAWINGS_CORE_PATH . $flowerdrawings_core_file;
	}
}

flowerdrawings_core_load_files();

register_activation_hook( FLOWERDRAWINGS_CORE_FILE, array( 'Flowerdrawings_Core_Activation', 'activate' ) );
register_deactivation_hook( FLOWERDRAWINGS_CORE_FILE, array( 'Flowerdrawings_Core_Activation', 'deactivate' ) );

/**
 * Boots the site-specific plugin services.
 */
function flowerdrawings_core_bootstrap(): void {
	$flowerdrawings_core_services = array(
		new Flowerdrawings_Core_Post_Type(),
		new Flowerdrawings_Core_Permalinks(),
		new Flowerdrawings_Core_Meta_Fields(),
		new Flowerdrawings_Core_Admin_Columns(),
		new Flowerdrawings_Core_Block_Patterns(),
	);

	foreach ( $flowerdrawings_core_services as $flowerdrawings_core_service ) {
		$flowerdrawings_core_service->register_hooks();
	}
}

add_action( 'plugins_loaded', 'flowerdrawings_core_bootstrap' );

/**
 * Loads plugin translations.
 */
function flowerdrawings_core_load_textdomain(): void {
	load_plugin_textdomain(
		'flowerdrawings',
		false,
		dirname( plugin_basename( FLOWERDRAWINGS_CORE_FILE ) ) . '/languages'
	);
}

add_action( 'init', 'flowerdrawings_core_load_textdomain' );
