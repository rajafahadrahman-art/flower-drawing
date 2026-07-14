<?php
/**
 * Related tutorials.
 *
 * @package Flowerdrawings
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$flowerdrawings_related = new WP_Query(
	array(
		'post_type'           => 'flower_tutorial',
		'posts_per_page'      => 3,
		'post__not_in'        => array( get_the_ID() ),
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	)
);

if ( ! $flowerdrawings_related->have_posts() ) {
	return;
}
?>
<section class="fd-related-tutorials" aria-labelledby="fd-related-heading">
	<h2 id="fd-related-heading"><?php esc_html_e( 'Related flower tutorials', 'flowerdrawings' ); ?></h2>
	<div class="fd-grid fd-grid--3">
		<?php
		while ( $flowerdrawings_related->have_posts() ) :
			$flowerdrawings_related->the_post();
			get_template_part( 'template-parts/tutorial/card' );
		endwhile;
		wp_reset_postdata();
		?>
	</div>
</section>
