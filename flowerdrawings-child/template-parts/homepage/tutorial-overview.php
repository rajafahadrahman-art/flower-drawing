<?php
/**
 * Explore Easy Flower Drawing Tutorial section.
 *
 * @package Flowerdrawings
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="fd-section fd-tutorial-overview" aria-labelledby="fd-overview-heading">
	<div class="fd-container fd-tutorial-overview__grid">
		<figure class="fd-tutorial-overview__media fd-card fd-reveal">
			<?php
			flowerdrawings_the_image(
				array(
					'src'     => flowerdrawings_asset_url( 'images/flower-drawing/home/flower-drawing.webp' ),
					'alt'     => 'flower drawing',
					'title'   => 'easy flower drawing',
					'width'   => 1254,
					'height'  => 1254,
					'class'   => 'fd-tutorial-overview__image',
					'loading' => 'lazy',
				)
			);
			?>
		</figure>
		<div class="fd-card fd-tutorial-overview__content fd-reveal">
			<h2 id="fd-overview-heading">Explore Easy Flower Drawing Tutorial</h2>
			<div class="fd-prose">
				<p>An easy drawing of a flower usually begins with familiar shapes such as circles, ovals, curved lines, and soft pointed forms. These shapes create the center, petals, stem, and leaves before any detail is added.</p>
				<p>You do not need to make every line perfect. Flowers naturally vary in shape, size, and direction, so small differences can make your drawing feel more organic.</p>
				<p>Start with a light pencil outline and focus on the overall form. Once the basic structure looks balanced, refine the petals, clean up extra guidelines, and add simple details.</p>
				<p>Our step-by-step flower drawing tutorials are arranged to make the process easy to follow. Each guide includes a completed drawing, clear visual steps, beginner-friendly instructions, and a downloadable practice worksheet where available.</p>
				<p>You can keep your flower drawing simple for a quick activity or follow a more detailed tutorial when you are ready for an extra challenge.</p>
			</div>
		</div>
	</div>
</section>
