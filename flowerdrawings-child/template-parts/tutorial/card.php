<?php
/**
 * Tutorial card.
 *
 * @package Flowerdrawings
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$flowerdrawings_post_id    = get_the_ID();
$flowerdrawings_difficulty = flowerdrawings_get_tutorial_meta( $flowerdrawings_post_id, 'tutorial_difficulty' );
$flowerdrawings_steps      = flowerdrawings_get_tutorial_meta( $flowerdrawings_post_id, 'tutorial_step_count' );
$flowerdrawings_alt        = flowerdrawings_get_tutorial_meta( $flowerdrawings_post_id, 'featured_image_alt', get_the_title() );
$flowerdrawings_title_attr = flowerdrawings_get_tutorial_meta( $flowerdrawings_post_id, 'featured_image_title' );
?>
<article <?php post_class( 'fd-card fd-tutorial-card fd-reveal' ); ?>>
	<a class="fd-tutorial-card__media" href="<?php the_permalink(); ?>">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php
			the_post_thumbnail(
				'medium_large',
				array(
					'alt'      => $flowerdrawings_alt,
					'title'    => $flowerdrawings_title_attr,
					'loading'  => 'lazy',
					'decoding' => 'async',
				)
			);
			?>
		<?php endif; ?>
	</a>
	<div class="fd-tutorial-card__body">
		<h3 class="fd-tutorial-card__title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h3>
		<?php if ( has_excerpt() ) : ?>
			<p class="fd-tutorial-card__excerpt"><?php echo esc_html( wp_strip_all_tags( get_the_excerpt() ) ); ?></p>
		<?php endif; ?>
		<ul class="fd-tutorial-card__meta">
			<?php if ( '' !== $flowerdrawings_difficulty ) : ?>
				<li><?php echo esc_html( $flowerdrawings_difficulty ); ?></li>
			<?php endif; ?>
			<?php if ( '' !== $flowerdrawings_steps ) : ?>
				<li><?php echo esc_html( sprintf( /* translators: %s: step count */ __( '%s steps', 'flowerdrawings' ), $flowerdrawings_steps ) ); ?></li>
			<?php endif; ?>
		</ul>
		<p class="fd-tutorial-card__action">
			<a class="fd-btn fd-btn--ghost" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read tutorial', 'flowerdrawings' ); ?></a>
		</p>
	</div>
</article>
