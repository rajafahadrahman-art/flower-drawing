<?php
/**
 * Flower Tutorial archive.
 *
 * @package Flowerdrawings
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main id="main-content" class="fd-main fd-archive" tabindex="-1">
	<section class="fd-section">
		<div class="fd-container">
			<header class="fd-archive__header fd-reveal">
				<h1><?php esc_html_e( 'Flower Drawing Tutorials', 'flowerdrawings' ); ?></h1>
				<p><?php esc_html_e( 'Browse the FlowerDrawings.com tutorial collection.', 'flowerdrawings' ); ?></p>
			</header>

			<div class="fd-archive__filters" data-fd-tutorial-filters aria-label="<?php esc_attr_e( 'Tutorial filters', 'flowerdrawings' ); ?>">
				<label class="screen-reader-text" for="fd-tutorial-search"><?php esc_html_e( 'Search tutorials', 'flowerdrawings' ); ?></label>
				<input id="fd-tutorial-search" class="fd-archive__search" type="search" name="s" placeholder="<?php esc_attr_e( 'Search tutorials', 'flowerdrawings' ); ?>" disabled />
			</div>

			<?php if ( have_posts() ) : ?>
				<div class="fd-grid fd-grid--3 fd-tutorial-grid">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/tutorial/card' );
					endwhile;
					?>
				</div>

				<nav class="fd-pagination" aria-label="<?php esc_attr_e( 'Tutorials pagination', 'flowerdrawings' ); ?>">
					<?php
					the_posts_pagination(
						array(
							'mid_size'  => 2,
							'prev_text' => __( 'Previous', 'flowerdrawings' ),
							'next_text' => __( 'Next', 'flowerdrawings' ),
						)
					);
					?>
				</nav>
			<?php else : ?>
				<div class="fd-card fd-empty-state fd-reveal">
					<p><?php esc_html_e( 'No flower tutorials have been published yet. Check back soon for new step-by-step guides.', 'flowerdrawings' ); ?></p>
				</div>
			<?php endif; ?>
		</div>
	</section>
</main>
<?php
get_footer();
