<?php
/**
 * Homepage introduction.
 *
 * @package Flowerdrawings
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="fd-section fd-intro" aria-labelledby="fd-home-h1">
	<div class="fd-container fd-intro__grid">
		<div class="fd-card fd-intro__content fd-reveal">
			<h1 id="fd-home-h1">Flower Drawing Easy and Simple Step-by-Step Guide for Beginners</h1>
			<div class="fd-prose">
				<p>A flower drawing does not have to begin with a complicated sketch. A few light lines, basic shapes, and simple petal forms are often enough to create something beautiful.</p>
				<p>This collection is made for beginners, students, kids, and anyone who wants to enjoy drawing flowers without feeling overwhelmed. You can start with a basic flower drawing, follow a clear step-by-step process, and practice at your own pace using printable worksheets.</p>
				<p>Whether you want to create a quick pencil sketch, a simple floral design, or a detailed flower with a stem and leaves, you will find approachable ideas and visual tutorials to help you get started.</p>
			</div>
			<div class="fd-actions">
				<?php
				flowerdrawings_button(
					'Explore Drawing Tutorials',
					home_url( '/flower-drawing/' ),
					array( 'class' => 'fd-btn fd-btn--ink' )
				);
				flowerdrawings_button(
					'Download Practice Worksheets',
					flowerdrawings_worksheet_pdf_url(),
					array(
						'class'    => 'fd-btn fd-btn--sage',
						'download' => true,
					)
				);
				?>
			</div>
		</div>
	</div>
</section>
