<?php
/**
 * Permalink helpers for Flower Tutorials.
 *
 * @package Flowerdrawings_Core
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Keeps tutorial URLs aligned with the approved /flower-drawing/{slug}/ structure.
 */
final class Flowerdrawings_Core_Permalinks {
	/**
	 * Registers WordPress hooks.
	 */
	public function register_hooks(): void {
		add_filter( 'post_type_link', array( $this, 'filter_tutorial_permalink' ), 10, 4 );
	}

	/**
	 * Ensures generated tutorial links use the fixed archive slug.
	 *
	 * Rewrite rules are flushed only by the activation class.
	 *
	 * @param string  $post_link The generated post link.
	 * @param WP_Post $post      The post object.
	 * @param bool    $leavename Whether to keep the post name token.
	 * @param bool    $sample    Whether this is a sample permalink.
	 * @return string
	 */
	public function filter_tutorial_permalink( string $post_link, WP_Post $post, bool $leavename, bool $sample ): string {
		if ( Flowerdrawings_Core_Post_Type::POST_TYPE !== $post->post_type ) {
			return $post_link;
		}

		$flowerdrawings_slug = $leavename || $sample ? '%postname%' : $post->post_name;

		if ( '' === $flowerdrawings_slug ) {
			return $post_link;
		}

		return user_trailingslashit(
			home_url( Flowerdrawings_Core_Post_Type::ARCHIVE_SLUG . '/' . $flowerdrawings_slug )
		);
	}

	/**
	 * Returns the tutorial archive URL.
	 */
	public static function get_archive_url(): string {
		$flowerdrawings_archive_url = get_post_type_archive_link( Flowerdrawings_Core_Post_Type::POST_TYPE );

		if ( false === $flowerdrawings_archive_url ) {
			$flowerdrawings_archive_url = home_url( '/' . Flowerdrawings_Core_Post_Type::ARCHIVE_SLUG . '/' );
		}

		return $flowerdrawings_archive_url;
	}
}
