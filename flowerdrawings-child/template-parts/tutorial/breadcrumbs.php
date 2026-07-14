<?php
/**
 * Tutorial breadcrumbs.
 *
 * @package Flowerdrawings
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<nav class="fd-breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'flowerdrawings' ); ?>">
	<ol class="fd-breadcrumbs__list">
		<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'flowerdrawings' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/flower-drawing/' ) ); ?>"><?php esc_html_e( 'Drawing Tutorials', 'flowerdrawings' ); ?></a></li>
		<li aria-current="page"><?php the_title(); ?></li>
	</ol>
</nav>
