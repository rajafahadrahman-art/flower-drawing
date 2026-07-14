<?php
/**
 * Search results template.
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
			<header class="fd-archive__header">
				<h1>
					<?php
					printf(
						/* translators: %s: search query */
						esc_html__( 'Search results for “%s”', 'flowerdrawings' ),
						esc_html( get_search_query() )
					);
					?>
				</h1>
			</header>

			<?php if ( have_posts() ) : ?>
				<div class="fd-grid fd-grid--2">
					<?php
					while ( have_posts() ) :
						the_post();
						?>
						<article <?php post_class( 'fd-card' ); ?>>
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<?php the_excerpt(); ?>
						</article>
						<?php
					endwhile;
					?>
				</div>
				<?php the_posts_pagination(); ?>
			<?php else : ?>
				<div class="fd-card">
					<p><?php esc_html_e( 'No results matched your search.', 'flowerdrawings' ); ?></p>
				</div>
			<?php endif; ?>
		</div>
	</section>
</main>
<?php
get_footer();
