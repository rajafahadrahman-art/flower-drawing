<?php
/**
 * Skill level cards.
 *
 * @package Flowerdrawings
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$flowerdrawings_levels = array(
	array(
		'heading' => 'Easy',
		'text'    => 'Each flower step by step drawing uses clear outlines and a short sequence that beginners can follow at their own pace.',
	),
	array(
		'heading' => 'Beginner',
		'text'    => 'Beginner tutorials introduce overlapping petals, leaves, stems, and light details while keeping the process manageable.',
	),
	array(
		'heading' => 'Intermediate',
		'text'    => 'These drawings may include more petals, angled views, layered forms, pencil shading, or a complete flower plant.',
	),
);
?>
<section class="fd-section fd-skills-section" aria-labelledby="fd-skills-heading">
	<div class="fd-container">
		<div class="fd-section__intro fd-reveal">
			<h2 id="fd-skills-heading">Find a Flower Drawing That Matches Your Skill Level</h2>
			<p>Choose a simple floral drawing that matches your current skill level and the amount of detail you want to practice.</p>
		</div>

		<div class="fd-grid fd-grid--3">
			<?php foreach ( $flowerdrawings_levels as $flowerdrawings_level ) : ?>
				<article class="fd-card fd-skill-card fd-reveal">
					<h3><?php echo esc_html( $flowerdrawings_level['heading'] ); ?></h3>
					<p><?php echo esc_html( $flowerdrawings_level['text'] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>

		<p class="fd-section__closing fd-reveal">You can repeat an easy tutorial several times before moving to the next level. Improvement often comes from practicing familiar shapes rather than constantly choosing a new subject.</p>
	</div>
</section>
