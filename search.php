<?php
/**
 * The template for displaying Search Results pages.
 *
 */

get_header();
?>

	<div class="container">
		<div class="row">
			<?php get_sidebar(); ?>

			<div class="col-sm-9 grid_content">

				<?php if ( have_posts() ) : ?>

					<p>
						<?php printf( __( 'Search Results for: %s', 'desirees' ), '<em>' . get_search_query() . '</em>' ); ?>
					</p>

					<?php
						/* Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called loop-search.php and that will be used instead.
						 */
						get_template_part( 'loop', 'search' );
					?>

				<?php else : ?>

					<?php dynamic_sidebar( 'empty-category-area' ); ?>

				<?php endif; ?>

			</div>
		</div>
	</div>

<?php get_footer(); ?>
