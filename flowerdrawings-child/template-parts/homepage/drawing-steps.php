<?php
/**
 * How to Draw a Flower Step by Step.
 *
 * @package Flowerdrawings
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$flowerdrawings_steps = array(
	array(
		'heading' => 'Step 1: Mark the Flower Center',
		'paras'   => array(
			'Begin with a small circle or oval. This shape will act as the center and help you decide the size and position of the flower.',
			'Keep the line light so it can be adjusted later.',
		),
	),
	array(
		'heading' => 'Step 2: Add the First Petals',
		'paras'   => array(
			'Draw a few petals around the center. Instead of trying to complete the whole flower at once, place the first petals at different points to establish the overall shape.',
			'Petals can be rounded, pointed, narrow, wide, or slightly folded.',
		),
	),
	array(
		'heading' => 'Step 3: Fill the Remaining Spaces',
		'paras'   => array(
			'Add more petals between the first set. Allow some petals to overlap so the flower does not look flat or overly symmetrical.',
			'The petals do not need to be identical. Small variations make the drawing more natural.',
		),
	),
	array(
		'heading' => 'Step 4: Draw the Stem',
		'paras'   => array(
			'Add two light lines extending downward from the flower. Keep them close enough to form a slender stem.',
			'A slightly curved stem often looks softer than a completely straight one.',
		),
	),
	array(
		'heading' => 'Step 5: Add Leaves',
		'paras'   => array(
			'Draw one or more leaves along the stem. Begin with a center line, then build the outer leaf shape around it.',
			'Leaves may be long, rounded, pointed, smooth, or gently uneven.',
		),
	),
	array(
		'heading' => 'Step 6: Refine the Outline',
		'paras'   => array(
			'Look over the complete sketch and adjust any flower shapes that feel too narrow, wide or uneven.',
		),
	),
	array(
		'heading' => 'Step 7: Add Shading or Color',
		'paras'   => array(
			'Finish the drawing with light pencil shading, colored pencils, markers, or another medium you enjoy.',
			'Place darker values near overlapping petals and underneath the flower center. Leave some areas lighter to create contrast.',
		),
	),
);
?>
<section class="fd-section fd-steps-section" aria-labelledby="fd-steps-heading">
	<div class="fd-container">
		<div class="fd-section__intro fd-reveal">
			<h2 id="fd-steps-heading">How to Draw a Flower Step by Step</h2>
			<p>Most flowers can be broken into a few manageable parts. The exact petal shape may change, but the basic drawing process often remains similar.</p>
		</div>

		<div class="fd-steps">
			<?php foreach ( $flowerdrawings_steps as $flowerdrawings_index => $flowerdrawings_step ) : ?>
				<article class="fd-card fd-step-card fd-reveal">
					<span class="fd-step-card__badge" aria-hidden="true"><?php echo esc_html( (string) ( $flowerdrawings_index + 1 ) ); ?></span>
					<h3 class="fd-step-card__title"><?php echo esc_html( $flowerdrawings_step['heading'] ); ?></h3>
					<?php foreach ( $flowerdrawings_step['paras'] as $flowerdrawings_para ) : ?>
						<p><?php echo esc_html( $flowerdrawings_para ); ?></p>
					<?php endforeach; ?>
				</article>
			<?php endforeach; ?>
		</div>

		<div class="fd-actions fd-actions--center fd-reveal">
			<?php
			flowerdrawings_button(
				'View Step-by-Step Drawing Guides',
				home_url( '/flower-drawing/' ),
				array( 'class' => 'fd-btn fd-btn--ink' )
			);
			?>
		</div>
	</div>
</section>
