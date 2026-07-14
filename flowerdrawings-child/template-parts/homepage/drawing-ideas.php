<?php
/**
 * Simple Flower Drawing Ideas to Practice.
 *
 * @package Flowerdrawings
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$flowerdrawings_ideas = array(
	array(
		'heading' => 'A Five-Petal Flower',
		'paras'   => array(
			'Draw a small center and place five rounded petals around it. Add a stem and two simple leaves.',
			'This is a good starting point for anyone making a very simple drawing.',
		),
	),
	array(
		'heading' => 'A Side-View Flower',
		'paras'   => array(
			'Instead of showing every petal from the front, draw the flower from the side. Use a curved cup-like shape for the bloom and connect it to a gently bending stem.',
		),
	),
	array(
		'heading' => 'A Flower with Large Petals',
		'paras'   => array(
			'Create four or six wide petals around a visible center. Large petals provide more room for shading, patterns, and color.',
		),
	),
	array(
		'heading' => 'A Small Floral Cluster',
		'paras'   => array(
			'Draw several small flowers close together. Vary their sizes and directions to create a loose floral arrangement.',
		),
	),
	array(
		'heading' => 'A Flower Plant Drawing',
		'paras'   => array(
			'Combine one main flower with a longer stem, several leaves, smaller buds, and lines suggesting new growth.',
		),
	),
	array(
		'heading' => 'A Pencil Flower Sketch',
		'paras'   => array(
			'Use light construction lines first, then build darker contours and soft shading. Focus on line weight rather than adding color.',
		),
	),
);
?>
<section class="fd-section fd-ideas-section" aria-labelledby="fd-ideas-heading">
	<div class="fd-container">
		<div class="fd-section__intro fd-reveal">
			<h2 id="fd-ideas-heading">Simple Flower Drawing Ideas to Practice</h2>
			<p>Not every practice session needs a complicated subject. Short drawing exercises are useful for improving line control, proportion, and confidence.</p>
			<p>Try these approachable ideas in your sketchbook:</p>
		</div>

		<div class="fd-bento fd-ideas">
			<?php foreach ( $flowerdrawings_ideas as $flowerdrawings_idea ) : ?>
				<article class="fd-card fd-idea-card fd-reveal">
					<h3><?php echo esc_html( $flowerdrawings_idea['heading'] ); ?></h3>
					<?php foreach ( $flowerdrawings_idea['paras'] as $flowerdrawings_para ) : ?>
						<p><?php echo esc_html( $flowerdrawings_para ); ?></p>
					<?php endforeach; ?>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
