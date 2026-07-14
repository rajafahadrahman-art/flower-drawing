<?php
/**
 * JSON-LD schema output.
 *
 * @package Flowerdrawings
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Outputs homepage WebSite, WebPage, and FAQPage schema.
 */
function flowerdrawings_output_schema(): void {
	if ( flowerdrawings_seo_plugin_active() && ! is_front_page() ) {
		// Still allow homepage FAQ schema only when we own the visible FAQs.
	}

	if ( ! is_front_page() ) {
		if ( is_singular( 'flower_tutorial' ) ) {
			flowerdrawings_output_tutorial_schema();
		}
		return;
	}

	$flowerdrawings_graph = array();

	$flowerdrawings_website = array(
		'@type' => 'WebSite',
		'@id'   => home_url( '/#website' ),
		'url'   => home_url( '/' ),
		'name'  => 'FlowerDrawings.com',
	);

	// Only include SearchAction when WordPress search is available.
	$flowerdrawings_website['potentialAction'] = array(
		'@type'       => 'SearchAction',
		'target'      => array(
			'@type'        => 'EntryPoint',
			'urlTemplate'  => home_url( '/?s={search_term_string}' ),
		),
		'query-input' => 'required name=search_term_string',
	);

	$flowerdrawings_graph[] = $flowerdrawings_website;

	$flowerdrawings_graph[] = array(
		'@type'       => 'WebPage',
		'@id'         => home_url( '/#webpage' ),
		'url'         => home_url( '/' ),
		'name'        => flowerdrawings_homepage_seo_title(),
		'description' => flowerdrawings_homepage_meta_description(),
		'isPartOf'    => array( '@id' => home_url( '/#website' ) ),
		'primaryImageOfPage' => array(
			'@type' => 'ImageObject',
			'url'   => flowerdrawings_asset_url( 'images/flower-drawing/home/flower-drawing-hero.webp' ),
		),
	);

	$flowerdrawings_entities = array();
	foreach ( flowerdrawings_homepage_faqs() as $flowerdrawings_faq ) {
		$flowerdrawings_entities[] = array(
			'@type'          => 'Question',
			'name'           => $flowerdrawings_faq['question'],
			'acceptedAnswer' => array(
				'@type' => 'Answer',
				'text'  => $flowerdrawings_faq['answer'],
			),
		);
	}

	$flowerdrawings_graph[] = array(
		'@type'      => 'FAQPage',
		'@id'        => home_url( '/#faqpage' ),
		'url'        => home_url( '/#faq' ),
		'mainEntity' => $flowerdrawings_entities,
	);

	$flowerdrawings_payload = array(
		'@context' => 'https://schema.org',
		'@graph'   => $flowerdrawings_graph,
	);

	echo '<script type="application/ld+json">' . wp_json_encode( $flowerdrawings_payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}
add_action( 'wp_head', 'flowerdrawings_output_schema', 30 );

/**
 * Outputs basic WebPage schema for a single tutorial.
 */
function flowerdrawings_output_tutorial_schema(): void {
	if ( flowerdrawings_seo_plugin_active() ) {
		return;
	}

	$flowerdrawings_post_id = get_the_ID();
	$flowerdrawings_desc    = flowerdrawings_get_tutorial_meta( $flowerdrawings_post_id, 'meta_description' );
	if ( '' === $flowerdrawings_desc ) {
		$flowerdrawings_desc = wp_strip_all_tags( get_the_excerpt( $flowerdrawings_post_id ) );
	}

	$flowerdrawings_payload = array(
		'@context'    => 'https://schema.org',
		'@type'       => 'WebPage',
		'@id'         => get_permalink( $flowerdrawings_post_id ) . '#webpage',
		'url'         => get_permalink( $flowerdrawings_post_id ),
		'name'        => get_the_title( $flowerdrawings_post_id ),
		'description' => $flowerdrawings_desc,
		'isPartOf'    => array(
			'@type' => 'WebSite',
			'name'  => 'FlowerDrawings.com',
			'url'   => home_url( '/' ),
		),
	);

	echo '<script type="application/ld+json">' . wp_json_encode( $flowerdrawings_payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}
