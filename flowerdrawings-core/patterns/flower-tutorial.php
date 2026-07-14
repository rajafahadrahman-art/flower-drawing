<?php
/**
 * Flower Tutorial block pattern content.
 *
 * @package Flowerdrawings_Core
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return '<!-- wp:group {"tagName":"section","className":"flowerdrawings-tutorial-pattern","layout":{"type":"constrained"}} -->
<section class="wp-block-group flowerdrawings-tutorial-pattern">
	<!-- wp:heading {"level":2} -->
	<h2 class="wp-block-heading">What you will draw</h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph -->
	<p>Use this introduction to explain the finished flower drawing and the simple shapes readers will practice before they begin.</p>
	<!-- /wp:paragraph -->

	<!-- wp:image {"sizeSlug":"large","className":"flowerdrawings-tutorial-final-image"} -->
	<figure class="wp-block-image size-large flowerdrawings-tutorial-final-image"></figure>
	<!-- /wp:image -->

	<!-- wp:group {"tagName":"section","className":"flowerdrawings-tutorial-steps","layout":{"type":"constrained"}} -->
	<section class="wp-block-group flowerdrawings-tutorial-steps">
		<!-- wp:heading {"level":2} -->
		<h2 class="wp-block-heading">How to draw this flower step by step</h2>
		<!-- /wp:heading -->

		<!-- wp:group {"tagName":"article","className":"flowerdrawings-tutorial-step","layout":{"type":"constrained"}} -->
		<article class="wp-block-group flowerdrawings-tutorial-step">
			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading">Step 1</h3>
			<!-- /wp:heading -->

			<!-- wp:image {"sizeSlug":"large"} -->
			<figure class="wp-block-image size-large"></figure>
			<!-- /wp:image -->

			<!-- wp:paragraph -->
			<p>Describe the first simple shape and where it should sit on the page.</p>
			<!-- /wp:paragraph -->
		</article>
		<!-- /wp:group -->

		<!-- wp:group {"tagName":"article","className":"flowerdrawings-tutorial-step","layout":{"type":"constrained"}} -->
		<article class="wp-block-group flowerdrawings-tutorial-step">
			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading">Step 2</h3>
			<!-- /wp:heading -->

			<!-- wp:image {"sizeSlug":"large"} -->
			<figure class="wp-block-image size-large"></figure>
			<!-- /wp:image -->

			<!-- wp:paragraph -->
			<p>Add the next flower shape slowly, keeping the lines light and easy to adjust.</p>
			<!-- /wp:paragraph -->
		</article>
		<!-- /wp:group -->

		<!-- wp:group {"tagName":"article","className":"flowerdrawings-tutorial-step","layout":{"type":"constrained"}} -->
		<article class="wp-block-group flowerdrawings-tutorial-step">
			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading">Step 3</h3>
			<!-- /wp:heading -->

			<!-- wp:image {"sizeSlug":"large"} -->
			<figure class="wp-block-image size-large"></figure>
			<!-- /wp:image -->

			<!-- wp:paragraph -->
			<p>Finish the main outline, then add small details that make the flower drawing feel complete.</p>
			<!-- /wp:paragraph -->
		</article>
		<!-- /wp:group -->
	</section>
	<!-- /wp:group -->

	<!-- wp:group {"tagName":"section","className":"flowerdrawings-worksheet-note","layout":{"type":"constrained"}} -->
	<section class="wp-block-group flowerdrawings-worksheet-note">
		<!-- wp:heading {"level":2} -->
		<h2 class="wp-block-heading">Practice worksheet</h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>Add a short note about the printable worksheet and how readers can use it for extra practice.</p>
		<!-- /wp:paragraph -->
	</section>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->';
