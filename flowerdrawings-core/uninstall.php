<?php
/**
 * Uninstall cleanup for FlowerDrawings Core.
 *
 * The plugin intentionally does not delete Flower Tutorial posts, media, or
 * post meta by default. Tutorial content is site content and should remain
 * under the site owner's control after uninstall.
 *
 * @package Flowerdrawings_Core
 */

declare(strict_types=1);

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

delete_option( 'flowerdrawings_core_version' );
