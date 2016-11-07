<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package desirees
 */

get_header(); ?>

	<div class="container">
		<div class="row center-xs">

			<?php get_sidebar(); ?>

			<div class="col-xs-12 col-lg-9">
				<?php dynamic_sidebar( 'empty-page-widget-area' ); ?>
			</div>

		</div>
	</div>

	<?php get_footer(); ?>
