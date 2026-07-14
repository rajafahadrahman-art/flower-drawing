<?php
/**
 * Site header.
 *
 * @package Flowerdrawings
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$flowerdrawings_nav_items = flowerdrawings_primary_nav_items();
?>
<header class="fd-site-header" role="banner">
	<div class="fd-site-header__inner fd-container">
		<a class="fd-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php
			flowerdrawings_the_image(
				array(
					'src'     => flowerdrawings_asset_url( 'images/brand/flowerdrawings-logo.webp' ),
					'alt'     => 'FlowerDrawings.com',
					'width'   => 48,
					'height'  => 48,
					'class'   => 'fd-logo__image',
					'loading' => 'eager',
				)
			);
			?>
			<span class="fd-logo__text">FlowerDrawings.com</span>
		</a>

		<button
			class="fd-nav-toggle"
			type="button"
			aria-expanded="false"
			aria-controls="fd-primary-nav"
			data-fd-nav-toggle
		>
			<span class="fd-nav-toggle__bars" aria-hidden="true"></span>
			<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'flowerdrawings' ); ?></span>
		</button>

		<nav id="fd-primary-nav" class="fd-nav" aria-label="<?php esc_attr_e( 'Primary', 'flowerdrawings' ); ?>" data-fd-nav>
			<ul class="fd-nav__list">
				<?php foreach ( $flowerdrawings_nav_items as $flowerdrawings_item ) : ?>
					<li class="fd-nav__item">
						<a class="fd-nav__link" href="<?php echo esc_url( $flowerdrawings_item['url'] ); ?>">
							<?php echo esc_html( $flowerdrawings_item['label'] ); ?>
						</a>
					</li>
				<?php endforeach; ?>
				<li class="fd-nav__item fd-nav__item--cta">
					<a class="fd-btn fd-btn--sage" href="<?php echo esc_url( home_url( '/#worksheets' ) ); ?>">
						<?php esc_html_e( 'Worksheets', 'flowerdrawings' ); ?>
					</a>
				</li>
			</ul>
		</nav>
	</div>
</header>
