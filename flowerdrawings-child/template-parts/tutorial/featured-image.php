<?php
/**
 * Tutorial featured / final image.
 *
 * @package Flowerdrawings
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! has_post_thumbnail() ) {
	return;
}

$flowerdrawings_post_id    = get_the_ID();
$flowerdrawings_alt        = flowerdrawings_get_tutorial_meta( $flowerdrawings_post_id, 'featured_image_alt', get_the_title() );
$flowerdrawings_title_attr = flowerdrawings_get_tutorial_meta( $flowerdrawings_post_id, 'featured_image_title' );
?>
<figure class="fd-tutorial-featured fd-card">
	<?php
	the_post_thumbnail(
		'large',
		array(
			'alt'      => $flowerdrawings_alt,
			'title'    => $flowerdrawings_title_attr,
			'class'    => 'fd-tutorial-featured__image',
			'loading'  => 'eager',
			'decoding' => 'async',
		)
	);
	?>
</figure>
