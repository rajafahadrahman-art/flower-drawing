<?php
/**
 * 404 template.
 *
 * @package Flowerdrawings
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main id="main-content" class="fd-main" tabindex="-1">
	<section class="fd-section">
		<div class="fd-container">
			<div class="fd-card fd-empty-state">
				<h1><?php esc_html_e( 'Page not found', 'flowerdrawings' ); ?></h1>
				<p><?php esc_html_e( 'The page you requested is unavailable. Return home or browse flower drawing tutorials.', 'flowerdrawings' ); ?></p>
				<div class="fd-actions">
					<a class="fd-btn fd-btn--ink" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'flowerdrawings' ); ?></a>
					<a class="fd-btn fd-btn--ghost" href="<?php echo esc_url( home_url( '/flower-drawing/' ) ); ?>"><?php esc_html_e( 'Drawing Tutorials', 'flowerdrawings' ); ?></a>
				</div>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();
