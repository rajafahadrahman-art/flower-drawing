<?php
/**
 * Homepage FAQ accordion.
 *
 * @package Flowerdrawings
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$flowerdrawings_faqs = flowerdrawings_homepage_faqs();
?>
<section id="faq" class="fd-section fd-faq" aria-labelledby="fd-faq-heading">
	<div class="fd-container">
		<div class="fd-section__intro fd-reveal">
			<h2 id="fd-faq-heading">Frequently Asked Questions</h2>
		</div>

		<div class="fd-accordion" data-fd-accordion>
			<?php foreach ( $flowerdrawings_faqs as $flowerdrawings_index => $flowerdrawings_faq ) : ?>
				<?php
				$flowerdrawings_panel_id  = 'fd-faq-panel-' . ( $flowerdrawings_index + 1 );
				$flowerdrawings_button_id = 'fd-faq-button-' . ( $flowerdrawings_index + 1 );
				?>
				<div class="fd-accordion__item fd-card fd-reveal">
					<h3 class="fd-accordion__heading">
						<button
							id="<?php echo esc_attr( $flowerdrawings_button_id ); ?>"
							class="fd-accordion__trigger"
							type="button"
							aria-expanded="false"
							aria-controls="<?php echo esc_attr( $flowerdrawings_panel_id ); ?>"
						>
							<?php echo esc_html( $flowerdrawings_faq['question'] ); ?>
						</button>
					</h3>
					<div
						id="<?php echo esc_attr( $flowerdrawings_panel_id ); ?>"
						class="fd-accordion__panel"
						role="region"
						aria-labelledby="<?php echo esc_attr( $flowerdrawings_button_id ); ?>"
					>
						<p><?php echo esc_html( $flowerdrawings_faq['answer'] ); ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
