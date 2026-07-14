<?php
/**
 * Tutorial worksheet download card.
 *
 * @package Flowerdrawings
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$flowerdrawings_post_id = get_the_ID();
$flowerdrawings_pdf     = flowerdrawings_get_tutorial_meta( $flowerdrawings_post_id, 'worksheet_pdf' );
$flowerdrawings_webp    = flowerdrawings_get_tutorial_meta( $flowerdrawings_post_id, 'worksheet_webp' );

if ( '' === $flowerdrawings_pdf && '' === $flowerdrawings_webp ) {
	return;
}

do_action( 'flowerdrawings_before_worksheet' );
?>
<aside class="fd-card fd-tutorial-worksheet">
	<h2><?php esc_html_e( 'Practice worksheet', 'flowerdrawings' ); ?></h2>
	<?php if ( '' !== $flowerdrawings_webp ) : ?>
		<figure class="fd-tutorial-worksheet__preview">
			<img
				src="<?php echo esc_url( $flowerdrawings_webp ); ?>"
				alt="<?php echo esc_attr( sprintf( /* translators: %s: tutorial title */ __( '%s worksheet', 'flowerdrawings' ), get_the_title() ) ); ?>"
				loading="lazy"
				decoding="async"
				width="800"
				height="1130"
			/>
		</figure>
	<?php endif; ?>
	<?php if ( '' !== $flowerdrawings_pdf ) : ?>
		<div class="fd-actions">
			<a class="fd-btn fd-btn--sage" href="<?php echo esc_url( $flowerdrawings_pdf ); ?>" download>
				<?php esc_html_e( 'Download worksheet PDF', 'flowerdrawings' ); ?>
			</a>
			<a class="fd-btn fd-btn--ghost" href="<?php echo esc_url( $flowerdrawings_pdf ); ?>" target="_blank" rel="noopener noreferrer" data-fd-print-worksheet="1">
				<?php esc_html_e( 'Print worksheet', 'flowerdrawings' ); ?>
			</a>
		</div>
	<?php endif; ?>
</aside>
<?php
do_action( 'flowerdrawings_after_worksheet' );
