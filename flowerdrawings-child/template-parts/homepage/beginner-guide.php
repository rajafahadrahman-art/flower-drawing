<?php
/**
 * Flower Drawing for Beginners.
 *
 * @package Flowerdrawings
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$flowerdrawings_habits = array(
	'Sketch lightly before creating a final outline.',
	'Compare the size of the petals to the center.',
	'Notice where one petal overlaps another.',
	'Use curved lines instead of making every edge stiff.',
	'Rotate the paper when a line feels difficult to draw.',
	'Erase only after the main structure is complete.',
	'Practice the same petal shape several times.',
	'Leave small imperfections instead of repeatedly correcting them.',
);
?>
<section class="fd-section fd-beginner-section" aria-labelledby="fd-beginner-heading">
	<div class="fd-container">
		<div class="fd-card fd-beginner-card fd-reveal">
			<h2 id="fd-beginner-heading">Flower Drawing for Beginners</h2>
			<div class="fd-prose">
				<p>Beginners often make the process harder by trying to draw every detail immediately. A better approach is to work from large shapes toward smaller ones.</p>
				<p>Begin by observing the direction of the flower. Is it facing forward, leaning to one side, or turning upward? Next, look at the center, the outer edge of the petals, and the way the stem connects to the bloom.</p>
				<p>Use these simple habits while practicing:</p>
			</div>
			<ul class="fd-checklist">
				<?php foreach ( $flowerdrawings_habits as $flowerdrawings_habit ) : ?>
					<li><?php echo esc_html( $flowerdrawings_habit ); ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</section>
