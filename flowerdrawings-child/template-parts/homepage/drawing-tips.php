<?php
/**
 * Tips for Better Drawing of Flower.
 *
 * @package Flowerdrawings
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$flowerdrawings_tips = array(
	'Observe the complete flower before drawing individual petals.',
	'Use the center as an anchor for the surrounding shapes.',
	'Keep construction lines light and loose.',
	'Avoid making every petal exactly the same.',
	'Show depth by overlapping a few forms.',
	'Follow the natural direction of petals when adding shading.',
	'Use blank space around the flower to keep the composition clear.',
	'Compare your final drawing with the reference and choose one area to improve next time.',
	'Save earlier sketches so you can see your progress.',
	'Practice slowly instead of trying to complete every drawing quickly.',
);
?>
<section class="fd-section fd-tips-section" aria-labelledby="fd-tips-heading">
	<div class="fd-container">
		<div class="fd-card fd-reveal">
			<h2 id="fd-tips-heading">Tips for Better Drawing of Flower</h2>
			<p>When creating a petals, observe their size, direction, and position around the center.</p>
			<ul>
				<?php foreach ( $flowerdrawings_tips as $flowerdrawings_tip ) : ?>
					<li><?php echo esc_html( $flowerdrawings_tip ); ?></li>
				<?php endforeach; ?>
			</ul>
			<p>The goal is not to produce a perfect picture on the first attempt. Each sketch helps you become more comfortable with lines, shapes, observation, and proportion.</p>
		</div>
	</div>
</section>
