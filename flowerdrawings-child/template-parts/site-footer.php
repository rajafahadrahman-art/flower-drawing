<?php
/**
 * Site footer.
 *
 * @package Flowerdrawings
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$flowerdrawings_year = gmdate( 'Y' );
$flowerdrawings_links = array(
	array( 'label' => 'Home', 'url' => home_url( '/' ) ),
	array( 'label' => 'Drawing Tutorials', 'url' => home_url( '/flower-drawing/' ) ),
	array( 'label' => 'Worksheets', 'url' => home_url( '/#worksheets' ) ),
	array( 'label' => 'FAQ', 'url' => home_url( '/#faq' ) ),
	array( 'label' => 'Contact', 'url' => 'mailto:ale298784@gmail.com' ),
);
?>
<footer class="fd-site-footer" role="contentinfo">
	<div class="fd-container fd-site-footer__inner">
		<div class="fd-site-footer__brand">
			<a class="fd-logo fd-logo--footer" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php
				flowerdrawings_the_image(
					array(
						'src'     => flowerdrawings_asset_url( 'images/brand/flowerdrawings-logo.webp' ),
						'alt'     => 'FlowerDrawings.com',
						'width'   => 40,
						'height'  => 40,
						'class'   => 'fd-logo__image',
						'loading' => 'lazy',
					)
				);
				?>
				<span class="fd-logo__text">FlowerDrawings.com</span>
			</a>
		</div>

		<nav class="fd-site-footer__nav" aria-label="<?php esc_attr_e( 'Footer', 'flowerdrawings' ); ?>">
			<ul class="fd-site-footer__list">
				<?php foreach ( $flowerdrawings_links as $flowerdrawings_link ) : ?>
					<li>
						<a href="<?php echo esc_url( $flowerdrawings_link['url'] ); ?>">
							<?php echo esc_html( $flowerdrawings_link['label'] ); ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</nav>

		<p class="fd-site-footer__contact">
			<a href="mailto:ale298784@gmail.com">ale298784@gmail.com</a>
		</p>

		<p class="fd-site-footer__copy">
			&copy; <?php echo esc_html( $flowerdrawings_year ); ?> FlowerDrawings.com
		</p>
	</div>

	<a class="fd-back-to-top" href="#main-content" data-fd-back-to-top>
		<span class="screen-reader-text"><?php esc_html_e( 'Back to top', 'flowerdrawings' ); ?></span>
		<span aria-hidden="true">↑</span>
	</a>
</footer>
