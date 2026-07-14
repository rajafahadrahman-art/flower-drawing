<?php
/**
 * Homepage template.
 *
 * @package Flowerdrawings
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main id="main-content" class="fd-main fd-homepage" tabindex="-1">
	<?php
	get_template_part( 'template-parts/homepage/hero-banner' );
	get_template_part( 'template-parts/homepage/introduction' );
	get_template_part( 'template-parts/homepage/tutorial-overview' );
	get_template_part( 'template-parts/homepage/drawing-steps' );
	get_template_part( 'template-parts/homepage/drawing-ideas' );
	get_template_part( 'template-parts/homepage/beginner-guide' );
	get_template_part( 'template-parts/homepage/basic-shapes' );
	get_template_part( 'template-parts/homepage/pencil-sketching' );
	get_template_part( 'template-parts/homepage/worksheet-download' );
	get_template_part( 'template-parts/homepage/skill-levels' );
	get_template_part( 'template-parts/homepage/drawing-tips' );
	get_template_part( 'template-parts/homepage/tutorial-collection' );
	get_template_part( 'template-parts/homepage/faq' );
	get_template_part( 'template-parts/homepage/final-cta' );
	?>
</main>
<?php
get_footer();
