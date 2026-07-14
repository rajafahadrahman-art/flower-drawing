<?php
/**
 * Admin list table columns for Flower Tutorials.
 *
 * @package Flowerdrawings_Core
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Adds readable tutorial metadata to the admin post list.
 */
final class Flowerdrawings_Core_Admin_Columns {
	private const COLUMN_FOCUS_KEYWORD = 'flowerdrawings_focus_keyword';
	private const COLUMN_WORKSHEET     = 'flowerdrawings_worksheet_status';
	private const COLUMN_DIFFICULTY    = 'flowerdrawings_difficulty';

	/**
	 * Registers WordPress hooks.
	 */
	public function register_hooks(): void {
		add_filter( 'manage_' . Flowerdrawings_Core_Post_Type::POST_TYPE . '_posts_columns', array( $this, 'register_columns' ) );
		add_action( 'manage_' . Flowerdrawings_Core_Post_Type::POST_TYPE . '_posts_custom_column', array( $this, 'render_column' ), 10, 2 );
		add_filter( 'manage_edit-' . Flowerdrawings_Core_Post_Type::POST_TYPE . '_sortable_columns', array( $this, 'register_sortable_columns' ) );
		add_action( 'pre_get_posts', array( $this, 'handle_column_sorting' ) );
	}

	/**
	 * Registers custom admin columns.
	 *
	 * @param array<string,string> $columns Existing columns.
	 * @return array<string,string>
	 */
	public function register_columns( array $columns ): array {
		$flowerdrawings_updated_columns = array();

		foreach ( $columns as $flowerdrawings_key => $flowerdrawings_label ) {
			$flowerdrawings_updated_columns[ $flowerdrawings_key ] = $flowerdrawings_label;

			if ( 'title' === $flowerdrawings_key ) {
				$flowerdrawings_updated_columns[ self::COLUMN_FOCUS_KEYWORD ] = esc_html__( 'Focus Keyword', 'flowerdrawings' );
				$flowerdrawings_updated_columns[ self::COLUMN_DIFFICULTY ]    = esc_html__( 'Difficulty', 'flowerdrawings' );
				$flowerdrawings_updated_columns[ self::COLUMN_WORKSHEET ]     = esc_html__( 'Worksheet', 'flowerdrawings' );
			}
		}

		return $flowerdrawings_updated_columns;
	}

	/**
	 * Renders custom admin column output.
	 *
	 * @param string $column  Column key.
	 * @param int    $post_id Post ID.
	 */
	public function render_column( string $column, int $post_id ): void {
		if ( self::COLUMN_FOCUS_KEYWORD === $column ) {
			$flowerdrawings_focus_keyword = get_post_meta( $post_id, 'focus_keyword', true );
			echo '' !== $flowerdrawings_focus_keyword ? esc_html( (string) $flowerdrawings_focus_keyword ) : '&mdash;';
			return;
		}

		if ( self::COLUMN_DIFFICULTY === $column ) {
			$flowerdrawings_difficulty = get_post_meta( $post_id, 'tutorial_difficulty', true );
			echo '' !== $flowerdrawings_difficulty ? esc_html( (string) $flowerdrawings_difficulty ) : '&mdash;';
			return;
		}

		if ( self::COLUMN_WORKSHEET === $column ) {
			$flowerdrawings_worksheet_pdf = get_post_meta( $post_id, 'worksheet_pdf', true );
			echo '' !== $flowerdrawings_worksheet_pdf ? esc_html__( 'Yes', 'flowerdrawings' ) : esc_html__( 'No', 'flowerdrawings' );
		}
	}

	/**
	 * Marks text-based columns sortable for future admin filtering.
	 *
	 * @param array<string,string> $columns Existing sortable columns.
	 * @return array<string,string>
	 */
	public function register_sortable_columns( array $columns ): array {
		$columns[ self::COLUMN_FOCUS_KEYWORD ] = 'focus_keyword';
		$columns[ self::COLUMN_DIFFICULTY ]    = 'tutorial_difficulty';

		return $columns;
	}

	/**
	 * Applies meta sorting for custom admin columns.
	 *
	 * @param WP_Query $query Current query.
	 */
	public function handle_column_sorting( WP_Query $query ): void {
		if ( ! is_admin() || ! $query->is_main_query() ) {
			return;
		}

		if ( Flowerdrawings_Core_Post_Type::POST_TYPE !== $query->get( 'post_type' ) ) {
			return;
		}

		$flowerdrawings_orderby = $query->get( 'orderby' );

		if ( 'focus_keyword' === $flowerdrawings_orderby || 'tutorial_difficulty' === $flowerdrawings_orderby ) {
			$query->set( 'meta_key', $flowerdrawings_orderby );
			$query->set( 'orderby', 'meta_value' );
		}
	}
}
