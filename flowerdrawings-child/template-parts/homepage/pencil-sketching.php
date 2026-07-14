<?php
/**
 * Sketching Flowers with Pencil.
 *
 * @package Flowerdrawings
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$flowerdrawings_tips = array(
	'Short curved strokes that follow the direction of a petal',
	'Light hatching underneath overlapping shapes',
	'Darker lines near the flower center',
	'Soft shadows beside the stem and leaves',
	'Small highlights created by leaving areas of the paper untouched',
);
?>
<section class="fd-section fd-pencil-section" aria-labelledby="fd-pencil-heading">
	<div class="fd-container fd-pencil-section__grid">
		<div class="fd-card fd-reveal">
			<h2 id="fd-pencil-heading">Sketching Flowers with Pencil</h2>
			<div class="fd-prose">
				<p>Pencil is a flexible choice for drawing because it allows you to build the image gradually.</p>
				<p>Start with gentle pressure and make loose marks. At this stage, you are deciding where the flower will sit on the page and how large it will be.</p>
				<p>Once the proportions feel right, define the petal edges and erase the lines that are no longer needed. Add darker strokes near overlapping forms and use softer marks in lighter areas.</p>
				<p>For a beginner-friendly pencil drawing, keep the shading simple. You can use:</p>
			</div>
			<ul>
				<?php foreach ( $flowerdrawings_tips as $flowerdrawings_tip ) : ?>
					<li><?php echo esc_html( $flowerdrawings_tip ); ?></li>
				<?php endforeach; ?>
			</ul>
			<div class="fd-prose">
				<p>Avoid pressing too hard during the first sketch. Heavy lines can be difficult to remove and may make the final drawing look stiff.</p>
				<p>A regular graphite pencil, eraser, smooth paper, and pencil sharpener are enough for most basic practice sessions.</p>
			</div>
		</div>
		<aside class="fd-card fd-pencil-tips-card fd-reveal" aria-hidden="true">
			<ul>
				<?php foreach ( $flowerdrawings_tips as $flowerdrawings_tip ) : ?>
					<li><?php echo esc_html( $flowerdrawings_tip ); ?></li>
				<?php endforeach; ?>
			</ul>
		</aside>
	</div>
</section>
