<?php
/**
 * The template for displaying Search Results pages.
 *
 */

get_header();
?>

	<div class="container">
		<div class="row">
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

					<div id="post-0" class="post no-results not-found">
						<h2 class="entry-title"><?php _e( 'Nothing Found', 'desirees' ); ?></h2>
						<div class="entry-content">
							<p>
								<?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'desirees' ); ?>
							</p>
							<?php get_search_form(); ?>
						</div>
					</div>

				<?php endif; ?>

			</div>
			<div class="col-sm-3 sidebar_grid cfx">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>

<?php get_footer(); ?>
