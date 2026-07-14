<?php
/**
 * Download Worksheets for Practice.
 *
 * @package Flowerdrawings
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$flowerdrawings_items = array(
	'A complete flower picture for reference',
	'A lighter outline for tracing',
	'A step-by-step drawing sequence',
	'Individual petal and leaf exercises',
	'A blank practice area',
	'Space to recreate the complete drawing',
	'A difficulty level and suggested practice time',
);
?>
<section id="worksheets" class="fd-section fd-worksheet" aria-labelledby="fd-worksheet-heading">
	<div class="fd-container fd-worksheet__grid">
		<figure class="fd-worksheet__preview fd-card fd-reveal">
			<?php
			flowerdrawings_the_image(
				array(
					'src'     => flowerdrawings_worksheet_webp_url(),
					'alt'     => 'flower drawing worksheets',
					'title'   => 'download practice worksheets',
					'width'   => 1055,
					'height'  => 1491,
					'class'   => 'fd-worksheet__image',
					'loading' => 'lazy',
				)
			);
			?>
		</figure>

		<div class="fd-card fd-worksheet__content fd-reveal">
			<h2 id="fd-worksheet-heading">Download Worksheets for Practice</h2>
			<div class="fd-prose">
				<p>These flowers for drawing worksheets provide clear reference pictures, tracing outlines, and blank areas for independent practice.</p>
				<p>Our downloadable flower drawing worksheets are designed to support hands-on practice. Each worksheet include:</p>
			</div>
			<ul>
				<?php foreach ( $flowerdrawings_items as $flowerdrawings_item ) : ?>
					<li><?php echo esc_html( $flowerdrawings_item ); ?></li>
				<?php endforeach; ?>
			</ul>
			<div class="fd-prose">
				<p>You can print a worksheet and draw directly on the page or keep the finished picture beside your sketchbook as a reference.</p>
				<p>Tracing can help you understand the movement of a line, but try drawing the same flower again without tracing. This turns a guided activity into an independent drawing exercise.</p>
			</div>
			<div class="fd-actions">
				<?php
				flowerdrawings_button(
					'Browse Drawing Worksheets',
					flowerdrawings_worksheet_pdf_url(),
					array(
						'class'    => 'fd-btn fd-btn--sage',
						'download' => true,
					)
				);
				flowerdrawings_button(
					'Print a Practice Page',
					flowerdrawings_worksheet_pdf_url(),
					array(
						'class'  => 'fd-btn fd-btn--ghost',
						'target' => '_blank',
						'rel'    => 'noopener noreferrer',
						'data_attrs' => array(
							'data-fd-print-worksheet' => '1',
						),
					)
				);
				?>
			</div>
		</div>
	</div>
</section>
