<?php
/**
 * From Basic Shapes to a Beautiful Flower Drawing.
 *
 * @package Flowerdrawings
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$flowerdrawings_elements = array(
	array(
		'heading' => 'Shape',
		'text'    => 'Look at the overall silhouette before focusing on small details. A clear outer shape helps the flower remain readable.',
	),
	array(
		'heading' => 'Proportion',
		'text'    => 'Compare the width of the flower to the length of the stem and the size of the leaves. These relationships help the drawing feel balanced.',
	),
	array(
		'heading' => 'Overlap',
		'text'    => 'Allow some petals and leaves to sit in front of others. Overlapping shapes create depth without requiring advanced shading.',
	),
	array(
		'heading' => 'Line Weight',
		'text'    => 'Use light lines for early construction and darker lines for the final outline. Varying line strength can separate important edges from smaller details.',
	),
	array(
		'heading' => 'Texture',
		'text'    => 'Short strokes, dots, curves, and fine lines can suggest pollen, veins, folds, and surface detail.',
	),
	array(
		'heading' => 'Light and Shadow',
		'text'    => 'Choose a general direction for the light. Add darker marks where petals overlap, where the center meets the petals, and where leaves join the stem.',
	),
);
?>
<section class="fd-section fd-shapes-section" aria-labelledby="fd-shapes-heading">
	<div class="fd-container">
		<div class="fd-section__intro fd-reveal">
			<h2 id="fd-shapes-heading">From Basic Shapes to a Beautiful Flower Drawing</h2>
			<div class="fd-prose">
				<p>A finished drawing may look detailed, but its structure is usually based on a small group of simple forms.</p>
				<p>The flower center may begin as a circle or oval. Petals are created with curved lines, teardrop shapes, or pointed forms. Stems are built with parallel lines, while leaves often start with a center guideline and an outer contour.</p>
				<p>Our flowers simple drawing exercises are designed to help beginners understand petals, centers, stems, and leaves through basic shapes.</p>
				<p>Pay attention to the following elements:</p>
			</div>
		</div>

		<div class="fd-grid fd-grid--3">
			<?php foreach ( $flowerdrawings_elements as $flowerdrawings_element ) : ?>
				<article class="fd-card fd-info-card fd-reveal">
					<h3><?php echo esc_html( $flowerdrawings_element['heading'] ); ?></h3>
					<p><?php echo esc_html( $flowerdrawings_element['text'] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>

		<p class="fd-section__closing fd-reveal">These basic drawing ideas can be used in simple sketches, floral illustrations, greeting-card designs, worksheets, and more detailed pencil artwork.</p>
	</div>
</section>
