<?php
/**
 * Template tags and shared markup helpers.
 *
 * @package Flowerdrawings
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns primary navigation items.
 *
 * @return array<int, array<string, string>>
 */
function flowerdrawings_primary_nav_items(): array {
	return array(
		array(
			'label' => 'Home',
			'url'   => home_url( '/' ),
		),
		array(
			'label' => 'Drawing Tutorials',
			'url'   => home_url( '/flower-drawing/' ),
		),
		array(
			'label' => 'Worksheets',
			'url'   => home_url( '/#worksheets' ),
		),
		array(
			'label' => 'FAQ',
			'url'   => home_url( '/#faq' ),
		),
		array(
			'label' => 'Contact',
			'url'   => 'mailto:ale298784@gmail.com',
		),
	);
}

/**
 * Prints a theme button link.
 *
 * @param string               $flowerdrawings_label Button label (exact).
 * @param string               $flowerdrawings_url   Destination URL.
 * @param array<string, mixed> $flowerdrawings_args  Extra attributes.
 */
function flowerdrawings_button( string $flowerdrawings_label, string $flowerdrawings_url, array $flowerdrawings_args = array() ): void {
	$flowerdrawings_defaults = array(
		'class'       => 'fd-btn fd-btn--ink',
		'download'    => false,
		'target'      => '',
		'rel'         => '',
		'aria_label'  => '',
		'data_attrs'  => array(),
	);
	$flowerdrawings_args = wp_parse_args( $flowerdrawings_args, $flowerdrawings_defaults );

	printf(
		'<a class="%1$s" href="%2$s"',
		esc_attr( (string) $flowerdrawings_args['class'] ),
		esc_url( $flowerdrawings_url )
	);

	if ( ! empty( $flowerdrawings_args['download'] ) ) {
		$flowerdrawings_download = true === $flowerdrawings_args['download']
			? 'flower-drawing-worksheet.pdf'
			: (string) $flowerdrawings_args['download'];
		printf( ' download="%s"', esc_attr( $flowerdrawings_download ) );
	}

	if ( ! empty( $flowerdrawings_args['target'] ) ) {
		printf( ' target="%s"', esc_attr( (string) $flowerdrawings_args['target'] ) );
	}

	if ( ! empty( $flowerdrawings_args['rel'] ) ) {
		printf( ' rel="%s"', esc_attr( (string) $flowerdrawings_args['rel'] ) );
	}

	if ( ! empty( $flowerdrawings_args['aria_label'] ) ) {
		printf( ' aria-label="%s"', esc_attr( (string) $flowerdrawings_args['aria_label'] ) );
	}

	if ( ! empty( $flowerdrawings_args['data_attrs'] ) && is_array( $flowerdrawings_args['data_attrs'] ) ) {
		foreach ( $flowerdrawings_args['data_attrs'] as $flowerdrawings_key => $flowerdrawings_value ) {
			printf( ' %s="%s"', esc_attr( (string) $flowerdrawings_key ), esc_attr( (string) $flowerdrawings_value ) );
		}
	}

	printf( '>%s</a>', esc_html( $flowerdrawings_label ) );
}

/**
 * Returns homepage FAQ pairs exactly as supplied.
 *
 * @return array<int, array{question:string,answer:string}>
 */
function flowerdrawings_homepage_faqs(): array {
	return array(
		array(
			'question' => 'What is the easiest way to start a flower drawing?',
			'answer'   => 'Begin with a small circle or oval for the center. Add a few large petals around it, then draw a stem and simple leaves. Keep the first lines light so you can adjust the proportions.',
		),
		array(
			'question' => 'How can beginners learn to draw flowers?',
			'answer'   => 'Beginners can improve by breaking the subject into basic shapes and following one step at a time. Practicing the same flower more than once also helps develop line control and confidence.',
		),
		array(
			'question' => 'What materials do I need for a basic flower drawing?',
			'answer'   => 'You can begin with paper, a graphite pencil, an eraser, and a sharpener. Colored pencils or markers can be added after the outline is complete.',
		),
		array(
			'question' => 'How do I make a simple flower drawing look more natural?',
			'answer'   => 'Vary the size and direction of the petals, allow a few shapes to overlap, and avoid making every side perfectly symmetrical. A slightly curved stem can also make the drawing feel less rigid.',
		),
		array(
			'question' => 'Can I learn by tracing a complete flower picture?',
			'answer'   => 'Tracing is useful for understanding line direction and shape. After tracing, recreate the same flower on a blank area without following the outline. This helps turn tracing into active practice.',
		),
		array(
			'question' => 'Are flower drawing worksheets suitable for beginners?',
			'answer'   => 'Yes. Worksheets can provide a completed reference, tracing practice, individual shape exercises, and blank space for independent drawing. Choose a worksheet with fewer steps when you are just starting.',
		),
		array(
			'question' => 'Do I need coaching for drawing easy flowers?',
			'answer'   => 'Drawing flowers for beginners can feel difficult at first, but formal classes are not always necessary. Follow the visual steps, use the worksheets for guided practice, and repeat each drawing until the shapes feel familiar.',
		),
	);
}

/**
 * Returns exact homepage SEO title.
 */
function flowerdrawings_homepage_seo_title(): string {
	return 'Easy Flower Drawing Step-by-Step Guide for Beginners to Intermediate';
}

/**
 * Returns exact homepage meta description.
 */
function flowerdrawings_homepage_meta_description(): string {
	return 'Learn flower drawing easy step-by-step guidance, simple flowers drawing ideas, beginner tips, pencil sketch techniques and get downloadable worksheets free.';
}

/**
 * Queries latest flower tutorials.
 *
 * @return WP_Query
 */
function flowerdrawings_query_tutorials( int $flowerdrawings_posts_per_page = 6 ): WP_Query {
	return new WP_Query(
		array(
			'post_type'              => 'flower_tutorial',
			'post_status'            => 'publish',
			'posts_per_page'         => $flowerdrawings_posts_per_page,
			'ignore_sticky_posts'    => true,
			'no_found_rows'          => $flowerdrawings_posts_per_page > 0 && $flowerdrawings_posts_per_page < 100,
			'update_post_meta_cache' => true,
			'update_post_term_cache' => false,
		)
	);
}

/**
 * Returns tutorial meta value helper.
 */
function flowerdrawings_get_tutorial_meta( int $flowerdrawings_post_id, string $flowerdrawings_key, string $flowerdrawings_default = '' ): string {
	$flowerdrawings_value = get_post_meta( $flowerdrawings_post_id, $flowerdrawings_key, true );
	if ( '' === $flowerdrawings_value || null === $flowerdrawings_value ) {
		return $flowerdrawings_default;
	}
	return (string) $flowerdrawings_value;
}
