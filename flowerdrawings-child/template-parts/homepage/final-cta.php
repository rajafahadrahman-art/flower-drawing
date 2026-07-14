<?php
/**
 * Final CTA section.
 *
 * @package Flowerdrawings
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="fd-section fd-final-cta" aria-labelledby="fd-final-cta-heading">
	<div class="fd-container">
		<div class="fd-card fd-final-cta__card fd-reveal">
			<h2 id="fd-final-cta-heading">Start Your Next Flower Drawing</h2>
			<div class="fd-prose">
				<p>Choose a tutorial, prepare your pencil and paper to begin with the first light shape. Do not worry about making the drawing perfect.</p>
				<p>Follow the steps, make adjustments as you go, and use the downloadable worksheets for extra practice. With each new sketch, petals, stems, leaves, and floral shapes will become easier to understand and draw.</p>
			</div>
			<div class="fd-actions">
				<?php
				flowerdrawings_button(
					'Start Drawing',
					home_url( '/flower-drawing/' ),
					array( 'class' => 'fd-btn fd-btn--ink' )
				);
				flowerdrawings_button(
					'View Practice Worksheets',
					'#worksheets',
					array( 'class' => 'fd-btn fd-btn--sage' )
				);
				?>
			</div>
		</div>
	</div>
</section>
