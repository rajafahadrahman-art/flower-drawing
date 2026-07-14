<?php
/**
 * Homepage hero banner.
 *
 * @package Flowerdrawings
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="fd-section fd-hero" aria-label="<?php esc_attr_e( 'Hero banner', 'flowerdrawings' ); ?>">
	<div class="fd-container">
		<div class="fd-hero__card fd-reveal">
			<figure class="fd-hero__media">
				<?php
				flowerdrawings_the_image(
					array(
						'src'           => flowerdrawings_asset_url( 'images/flower-drawing/home/flower-drawing-hero.webp' ),
						'alt'           => 'simple flower drawing',
						'title'         => 'flower drawing easy',
						'width'         => 1734,
						'height'        => 907,
						'class'         => 'fd-hero__image',
						'loading'       => 'eager',
						'fetchpriority' => 'high',
						'decoding'      => 'async',
					)
				);
				?>
			</figure>
		</div>
	</div>
</section>
