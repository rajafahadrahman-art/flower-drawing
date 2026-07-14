<?php
/**
 * Image helpers.
 *
 * @package Flowerdrawings
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns a theme asset URL.
 */
function flowerdrawings_asset_url( string $flowerdrawings_relative_path ): string {
	return trailingslashit( FLOWERDRAWINGS_THEME_URI ) . 'assets/' . ltrim( $flowerdrawings_relative_path, '/' );
}

/**
 * Returns a theme asset filesystem path.
 */
function flowerdrawings_asset_path( string $flowerdrawings_relative_path ): string {
	return trailingslashit( FLOWERDRAWINGS_THEME_DIR ) . 'assets/' . ltrim( $flowerdrawings_relative_path, '/' );
}

/**
 * Returns the homepage worksheet PDF URL.
 */
function flowerdrawings_worksheet_pdf_url(): string {
	return flowerdrawings_asset_url( 'downloads/flower-drawing-worksheet.pdf' );
}

/**
 * Returns the homepage worksheet WebP URL.
 */
function flowerdrawings_worksheet_webp_url(): string {
	return flowerdrawings_asset_url( 'downloads/flower-drawing-worksheet.webp' );
}

/**
 * Prints a theme image with explicit attributes.
 *
 * @param array<string, string|int|bool> $flowerdrawings_args Image arguments.
 */
function flowerdrawings_the_image( array $flowerdrawings_args ): void {
	$flowerdrawings_defaults = array(
		'src'          => '',
		'alt'          => '',
		'title'        => '',
		'width'        => 0,
		'height'       => 0,
		'class'        => '',
		'loading'      => 'lazy',
		'decoding'     => 'async',
		'fetchpriority'=> '',
	);

	$flowerdrawings_args = wp_parse_args( $flowerdrawings_args, $flowerdrawings_defaults );

	if ( empty( $flowerdrawings_args['src'] ) ) {
		return;
	}

	$flowerdrawings_attributes = array(
		'src'      => esc_url( (string) $flowerdrawings_args['src'] ),
		'alt'      => esc_attr( (string) $flowerdrawings_args['alt'] ),
		'width'    => absint( $flowerdrawings_args['width'] ),
		'height'   => absint( $flowerdrawings_args['height'] ),
		'class'    => esc_attr( (string) $flowerdrawings_args['class'] ),
		'loading'  => esc_attr( (string) $flowerdrawings_args['loading'] ),
		'decoding' => esc_attr( (string) $flowerdrawings_args['decoding'] ),
	);

	if ( ! empty( $flowerdrawings_args['title'] ) ) {
		$flowerdrawings_attributes['title'] = esc_attr( (string) $flowerdrawings_args['title'] );
	}

	if ( ! empty( $flowerdrawings_args['fetchpriority'] ) ) {
		$flowerdrawings_attributes['fetchpriority'] = esc_attr( (string) $flowerdrawings_args['fetchpriority'] );
	}

	echo '<img';
	foreach ( $flowerdrawings_attributes as $flowerdrawings_key => $flowerdrawings_value ) {
		if ( '' === $flowerdrawings_value || 0 === $flowerdrawings_value ) {
			continue;
		}
		printf( ' %s="%s"', esc_attr( $flowerdrawings_key ), $flowerdrawings_value ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- values escaped above.
	}
	echo ' />';
}
