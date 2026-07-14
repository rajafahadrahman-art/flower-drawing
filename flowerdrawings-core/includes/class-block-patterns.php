<?php
/**
 * Registers FlowerDrawings block patterns.
 *
 * @package Flowerdrawings_Core
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Block pattern registration.
 */
final class Flowerdrawings_Core_Block_Patterns {
	/**
	 * Registers WordPress hooks.
	 */
	public function register_hooks(): void {
		add_action( 'init', array( $this, 'register_patterns' ) );
	}

	/**
	 * Registers pattern category and tutorial pattern.
	 */
	public function register_patterns(): void {
		if ( ! function_exists( 'register_block_pattern_category' ) || ! function_exists( 'register_block_pattern' ) ) {
			return;
		}

		register_block_pattern_category(
			'flowerdrawings',
			array(
				'label' => esc_html__( 'FlowerDrawings', 'flowerdrawings' ),
			)
		);

		$flowerdrawings_pattern_file = FLOWERDRAWINGS_CORE_PATH . 'patterns/flower-tutorial.php';

		if ( ! is_readable( $flowerdrawings_pattern_file ) ) {
			return;
		}

		$flowerdrawings_pattern_content = include $flowerdrawings_pattern_file;

		if ( ! is_string( $flowerdrawings_pattern_content ) || '' === $flowerdrawings_pattern_content ) {
			return;
		}

		register_block_pattern(
			'flowerdrawings/flower-tutorial',
			array(
				'title'       => esc_html__( 'Flower Tutorial Structure', 'flowerdrawings' ),
				'description' => esc_html__( 'A clean starting structure for step-by-step flower drawing tutorials.', 'flowerdrawings' ),
				'categories'  => array( 'flowerdrawings' ),
				'postTypes'   => array( Flowerdrawings_Core_Post_Type::POST_TYPE ),
				'content'     => $flowerdrawings_pattern_content,
			)
		);
	}
}
