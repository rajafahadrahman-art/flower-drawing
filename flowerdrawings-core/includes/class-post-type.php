<?php
/**
 * Registers the Flower Tutorial custom post type.
 *
 * @package Flowerdrawings_Core
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Custom post type registration.
 */
final class Flowerdrawings_Core_Post_Type {
	public const POST_TYPE    = 'flower_tutorial';
	public const ARCHIVE_SLUG = 'flower-drawing';

	/**
	 * Registers WordPress hooks.
	 */
	public function register_hooks(): void {
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * Registers the flower_tutorial post type.
	 */
	public function register(): void {
		$flowerdrawings_labels = array(
			'name'                  => esc_html__( 'Flower Tutorials', 'flowerdrawings' ),
			'singular_name'         => esc_html__( 'Flower Tutorial', 'flowerdrawings' ),
			'menu_name'             => esc_html__( 'Flower Tutorials', 'flowerdrawings' ),
			'name_admin_bar'        => esc_html__( 'Flower Tutorial', 'flowerdrawings' ),
			'add_new'               => esc_html__( 'Add New', 'flowerdrawings' ),
			'add_new_item'          => esc_html__( 'Add New Flower Tutorial', 'flowerdrawings' ),
			'new_item'              => esc_html__( 'New Flower Tutorial', 'flowerdrawings' ),
			'edit_item'             => esc_html__( 'Edit Flower Tutorial', 'flowerdrawings' ),
			'view_item'             => esc_html__( 'View Flower Tutorial', 'flowerdrawings' ),
			'all_items'             => esc_html__( 'All Flower Tutorials', 'flowerdrawings' ),
			'search_items'          => esc_html__( 'Search Flower Tutorials', 'flowerdrawings' ),
			'parent_item_colon'     => esc_html__( 'Parent Flower Tutorials:', 'flowerdrawings' ),
			'not_found'             => esc_html__( 'No flower tutorials found.', 'flowerdrawings' ),
			'not_found_in_trash'    => esc_html__( 'No flower tutorials found in Trash.', 'flowerdrawings' ),
			'featured_image'        => esc_html__( 'Final tutorial image', 'flowerdrawings' ),
			'set_featured_image'    => esc_html__( 'Set final tutorial image', 'flowerdrawings' ),
			'remove_featured_image' => esc_html__( 'Remove final tutorial image', 'flowerdrawings' ),
			'use_featured_image'    => esc_html__( 'Use as final tutorial image', 'flowerdrawings' ),
			'archives'              => esc_html__( 'Flower Tutorial archives', 'flowerdrawings' ),
			'insert_into_item'      => esc_html__( 'Insert into flower tutorial', 'flowerdrawings' ),
			'uploaded_to_this_item' => esc_html__( 'Uploaded to this flower tutorial', 'flowerdrawings' ),
			'filter_items_list'     => esc_html__( 'Filter flower tutorials list', 'flowerdrawings' ),
			'items_list_navigation' => esc_html__( 'Flower tutorials list navigation', 'flowerdrawings' ),
			'items_list'            => esc_html__( 'Flower tutorials list', 'flowerdrawings' ),
		);

		$flowerdrawings_args = array(
			'labels'              => $flowerdrawings_labels,
			'public'              => true,
			'publicly_queryable'  => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'show_in_rest'        => true,
			'rest_base'           => 'flower-tutorials',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'menu_icon'           => 'dashicons-art',
			'menu_position'       => 20,
			'capability_type'     => 'post',
			'hierarchical'        => false,
			'has_archive'         => self::ARCHIVE_SLUG,
			'rewrite'             => array(
				'slug'       => self::ARCHIVE_SLUG,
				'with_front' => false,
				'feeds'      => true,
			),
			'query_var'           => true,
			'can_export'          => true,
			'delete_with_user'    => false,
			'supports'            => array(
				'title',
				'editor',
				'thumbnail',
				'excerpt',
				'revisions',
				'author',
				'custom-fields',
			),
		);

		register_post_type( self::POST_TYPE, $flowerdrawings_args );
	}
}
