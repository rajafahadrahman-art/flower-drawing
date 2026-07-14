<?php
/**
 * Plugin activation and deactivation handlers.
 *
 * @package Flowerdrawings_Core
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Handles one-time rewrite flushing.
 */
final class Flowerdrawings_Core_Activation {
	/**
	 * Runs on plugin activation.
	 */
	public static function activate(): void {
		self::ensure_minimum_versions();

		$flowerdrawings_post_type = new Flowerdrawings_Core_Post_Type();
		$flowerdrawings_post_type->register();

		update_option( 'flowerdrawings_core_version', FLOWERDRAWINGS_CORE_VERSION, false );
		flush_rewrite_rules();
	}

	/**
	 * Runs on plugin deactivation.
	 */
	public static function deactivate(): void {
		flush_rewrite_rules();
	}

	/**
	 * Blocks activation on unsupported PHP or WordPress versions.
	 */
	private static function ensure_minimum_versions(): void {
		global $wp_version;

		if ( version_compare( PHP_VERSION, '8.1', '<' ) ) {
			deactivate_plugins( plugin_basename( FLOWERDRAWINGS_CORE_FILE ) );
			wp_die(
				esc_html__( 'FlowerDrawings Core requires PHP 8.1 or newer.', 'flowerdrawings' ),
				esc_html__( 'Plugin activation failed', 'flowerdrawings' ),
				array( 'back_link' => true )
			);
		}

		if ( isset( $wp_version ) && version_compare( (string) $wp_version, '6.5', '<' ) ) {
			deactivate_plugins( plugin_basename( FLOWERDRAWINGS_CORE_FILE ) );
			wp_die(
				esc_html__( 'FlowerDrawings Core requires WordPress 6.5 or newer.', 'flowerdrawings' ),
				esc_html__( 'Plugin activation failed', 'flowerdrawings' ),
				array( 'back_link' => true )
			);
		}
	}
}
