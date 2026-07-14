<?php
/**
 * Single Flower Tutorial template.
 *
 * @package Flowerdrawings
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main id="main-content" class="fd-main fd-single-tutorial" tabindex="-1">
	<?php
	while ( have_posts() ) :
		the_post();
		$flowerdrawings_post_id    = get_the_ID();
		$flowerdrawings_difficulty = flowerdrawings_get_tutorial_meta( $flowerdrawings_post_id, 'tutorial_difficulty' );
		$flowerdrawings_time       = flowerdrawings_get_tutorial_meta( $flowerdrawings_post_id, 'tutorial_time' );
		$flowerdrawings_steps      = flowerdrawings_get_tutorial_meta( $flowerdrawings_post_id, 'tutorial_step_count' );
		?>
		<article <?php post_class( 'fd-section' ); ?>>
			<div class="fd-container">
				<?php get_template_part( 'template-parts/tutorial/breadcrumbs' ); ?>

				<header class="fd-single-tutorial__header">
					<h1><?php the_title(); ?></h1>
					<div class="fd-meta-cards">
						<?php if ( '' !== $flowerdrawings_difficulty ) : ?>
							<div class="fd-card fd-meta-card">
								<span class="fd-meta-card__label"><?php esc_html_e( 'Difficulty', 'flowerdrawings' ); ?></span>
								<span class="fd-meta-card__value"><?php echo esc_html( $flowerdrawings_difficulty ); ?></span>
							</div>
						<?php endif; ?>
						<?php if ( '' !== $flowerdrawings_time ) : ?>
							<div class="fd-card fd-meta-card">
								<span class="fd-meta-card__label"><?php esc_html_e( 'Time', 'flowerdrawings' ); ?></span>
								<span class="fd-meta-card__value"><?php echo esc_html( $flowerdrawings_time ); ?></span>
							</div>
						<?php endif; ?>
						<?php if ( '' !== $flowerdrawings_steps ) : ?>
							<div class="fd-card fd-meta-card">
								<span class="fd-meta-card__label"><?php esc_html_e( 'Steps', 'flowerdrawings' ); ?></span>
								<span class="fd-meta-card__value"><?php echo esc_html( $flowerdrawings_steps ); ?></span>
							</div>
						<?php endif; ?>
					</div>
				</header>

				<?php get_template_part( 'template-parts/tutorial/featured-image' ); ?>

				<?php do_action( 'flowerdrawings_before_tutorial_content' ); ?>

				<div class="fd-prose fd-single-tutorial__content">
					<?php the_content(); ?>
				</div>

				<?php do_action( 'flowerdrawings_after_tutorial_content' ); ?>

				<?php get_template_part( 'template-parts/tutorial/drawing-tool-shell' ); ?>

				<?php get_template_part( 'template-parts/tutorial/worksheet-card' ); ?>

				<nav class="fd-post-nav" aria-label="<?php esc_attr_e( 'Tutorial navigation', 'flowerdrawings' ); ?>">
					<div class="fd-post-nav__prev"><?php previous_post_link( '%link', '%title' ); ?></div>
					<div class="fd-post-nav__next"><?php next_post_link( '%link', '%title' ); ?></div>
				</nav>

				<?php get_template_part( 'template-parts/tutorial/related-tutorials' ); ?>
			</div>
		</article>
		<?php
	endwhile;
	?>
</main>
<?php
get_footer();
