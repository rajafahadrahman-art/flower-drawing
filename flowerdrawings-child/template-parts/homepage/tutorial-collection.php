<?php
/**
 * Explore More Easy Flowers Drawing Ideas.
 *
 * @package Flowerdrawings
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$flowerdrawings_query = flowerdrawings_query_tutorials( 6 );
?>
<section class="fd-section fd-collection-section" aria-labelledby="fd-collection-heading">
	<div class="fd-container">
		<div class="fd-section__intro fd-reveal">
			<h2 id="fd-collection-heading">Explore More Easy Flowers Drawing Ideas</h2>
			<p>Browse our growing collection of individual flower tutorials. Each post focuses on one flower and includes a finished reference, visual drawing steps, simple instructions, practice tips, and a printable worksheet where available.</p>
			<p>New tutorials will be added regularly, giving you more petal shapes, plant forms, sketching ideas, and floral designs to explore.</p>
		</div>

		<?php if ( $flowerdrawings_query->have_posts() ) : ?>
			<div class="fd-grid fd-grid--3 fd-tutorial-grid">
				<?php
				while ( $flowerdrawings_query->have_posts() ) :
					$flowerdrawings_query->the_post();
					get_template_part( 'template-parts/tutorial/card' );
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		<?php endif; ?>

		<div class="fd-actions fd-actions--center fd-reveal">
			<?php
			flowerdrawings_button(
				'View All Flower Tutorials',
				home_url( '/flower-drawing/' ),
				array( 'class' => 'fd-btn fd-btn--ink' )
			);
			?>
		</div>
	</div>
</section>
