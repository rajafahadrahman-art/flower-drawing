<?php
/**
 * Fallback index template.
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
					<p><?php esc_html_e( 'No content found.', 'flowerdrawings' ); ?></p>
				</div>
			<?php endif; ?>
		</div>
	</section>
</main>
<?php
get_footer();
