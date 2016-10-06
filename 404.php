<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package desirees
 */

get_header(); ?>

	<div class="container">
		<div class="row">
			<div class="span12 txt-center">
        <header>
          <h1>
            <?php _e('<strong>Page not found.</strong>', 'desirees'); ?>
          </h1>
        </header>

				<p>
					<?php _e('Sorry, but the page you are looking for is not found. Please, make sure you’ve typed the current  URL.', 'desirees'); ?>
        </p>

				<div class="f-center">
					<?php get_search_form(); ?>
				</div>

        <?php
						echo desirees_do_shortcode( 'desirees_best_selling_products', array(
							'per_page'  => 4,
							'columns'   => 4,
						) );
        ?>

				<p>
					<a class="button medium arrow-left" href="javascript: history.go(-1)">
						<?php _e('Return to Previous Page', 'desirees'); ?>
					</a>
				</p>

			</div>
		</div>
	</div>

	<?php get_footer(); ?>
