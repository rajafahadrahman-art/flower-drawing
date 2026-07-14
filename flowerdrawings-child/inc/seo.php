<?php
/**
 * Basic SEO output when no SEO plugin is active.
 *
 * @package Flowerdrawings
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Detects common SEO plugins that already output metadata.
 */
function flowerdrawings_seo_plugin_active(): bool {
	if ( defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) || defined( 'AIOSEO_VERSION' ) ) {
		return true;
	}

	if ( class_exists( 'WPSEO_Options' ) || class_exists( 'RankMath' ) || class_exists( 'AIOSEO\\Plugin\\AIOSEO' ) || function_exists( 'aioseo' ) ) {
		return true;
	}

	return false;
}

/**
 * Filters document title for the homepage to exact SEO title.
 *
 * @param array<string, string> $flowerdrawings_parts Title parts.
 * @return array<string, string>
 */
function flowerdrawings_document_title_parts( array $flowerdrawings_parts ): array {
	if ( is_front_page() ) {
		$flowerdrawings_parts['title'] = flowerdrawings_homepage_seo_title();
		unset( $flowerdrawings_parts['tagline'], $flowerdrawings_parts['site'] );
	} elseif ( is_singular( 'flower_tutorial' ) ) {
		$flowerdrawings_custom = flowerdrawings_get_tutorial_meta( get_the_ID(), 'seo_title' );
		if ( '' !== $flowerdrawings_custom ) {
			$flowerdrawings_parts['title'] = $flowerdrawings_custom;
		}
	}

	return $flowerdrawings_parts;
}
add_filter( 'document_title_parts', 'flowerdrawings_document_title_parts' );

/**
 * Removes site name separator noise for homepage exact title.
 */
function flowerdrawings_document_title( string $flowerdrawings_title ): string {
	if ( is_front_page() && ! flowerdrawings_seo_plugin_active() ) {
		return flowerdrawings_homepage_seo_title();
	}
	return $flowerdrawings_title;
}
add_filter( 'pre_get_document_title', 'flowerdrawings_document_title', 20 );

/**
 * Outputs canonical, description, and social meta when no SEO plugin is active.
 */
function flowerdrawings_output_basic_seo(): void {
	if ( flowerdrawings_seo_plugin_active() ) {
		return;
	}

	$flowerdrawings_canonical = '';
	$flowerdrawings_title     = wp_get_document_title();
	$flowerdrawings_desc      = '';
	$flowerdrawings_image     = flowerdrawings_asset_url( 'images/flower-drawing/home/flower-drawing-hero.webp' );

	if ( is_front_page() ) {
		$flowerdrawings_canonical = home_url( '/' );
		$flowerdrawings_title     = flowerdrawings_homepage_seo_title();
		$flowerdrawings_desc      = flowerdrawings_homepage_meta_description();
	} elseif ( is_singular( 'flower_tutorial' ) ) {
		$flowerdrawings_canonical = get_permalink();
		$flowerdrawings_custom_title = flowerdrawings_get_tutorial_meta( get_the_ID(), 'seo_title' );
		$flowerdrawings_custom_desc  = flowerdrawings_get_tutorial_meta( get_the_ID(), 'meta_description' );
		if ( '' !== $flowerdrawings_custom_title ) {
			$flowerdrawings_title = $flowerdrawings_custom_title;
		}
		$flowerdrawings_desc = '' !== $flowerdrawings_custom_desc
			? $flowerdrawings_custom_desc
			: wp_strip_all_tags( get_the_excerpt() );
		if ( has_post_thumbnail() ) {
			$flowerdrawings_thumb = get_the_post_thumbnail_url( get_the_ID(), 'full' );
			if ( $flowerdrawings_thumb ) {
				$flowerdrawings_image = $flowerdrawings_thumb;
			}
		}
	} elseif ( is_post_type_archive( 'flower_tutorial' ) ) {
		$flowerdrawings_canonical = get_post_type_archive_link( 'flower_tutorial' );
		$flowerdrawings_title     = 'Flower Drawing Tutorials';
		$flowerdrawings_desc      = 'Browse easy flower drawing tutorials from FlowerDrawings.com.';
	} elseif ( is_singular() ) {
		$flowerdrawings_canonical = get_permalink();
		$flowerdrawings_desc      = wp_strip_all_tags( get_the_excerpt() );
	} else {
		$flowerdrawings_canonical = home_url( add_query_arg( array(), $GLOBALS['wp']->request ?? '' ) );
	}

	if ( $flowerdrawings_canonical ) {
		printf( '<link rel="canonical" href="%s" />' . "\n", esc_url( $flowerdrawings_canonical ) );
	}

	if ( $flowerdrawings_desc ) {
		printf( '<meta name="description" content="%s" />' . "\n", esc_attr( $flowerdrawings_desc ) );
	}

	printf( '<meta property="og:type" content="%s" />' . "\n", esc_attr( is_singular() ? 'article' : 'website' ) );
	printf( '<meta property="og:site_name" content="%s" />' . "\n", esc_attr( 'FlowerDrawings.com' ) );
	printf( '<meta property="og:title" content="%s" />' . "\n", esc_attr( $flowerdrawings_title ) );
	if ( $flowerdrawings_desc ) {
		printf( '<meta property="og:description" content="%s" />' . "\n", esc_attr( $flowerdrawings_desc ) );
	}
	if ( $flowerdrawings_canonical ) {
		printf( '<meta property="og:url" content="%s" />' . "\n", esc_url( $flowerdrawings_canonical ) );
	}
	printf( '<meta property="og:image" content="%s" />' . "\n", esc_url( $flowerdrawings_image ) );

	echo '<meta name="twitter:card" content="summary_large_image" />' . "\n";
	printf( '<meta name="twitter:title" content="%s" />' . "\n", esc_attr( $flowerdrawings_title ) );
	if ( $flowerdrawings_desc ) {
		printf( '<meta name="twitter:description" content="%s" />' . "\n", esc_attr( $flowerdrawings_desc ) );
	}
	printf( '<meta name="twitter:image" content="%s" />' . "\n", esc_url( $flowerdrawings_image ) );
}
add_action( 'wp_head', 'flowerdrawings_output_basic_seo', 5 );
