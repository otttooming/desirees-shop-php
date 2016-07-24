<?php
/**
 * The Template for displaying all single posts.
 *
 */

get_header(); ?>

    <div class="container">
        <div class="row cfx">
              <?php blog_breadcrumbs(); ?>

              <div class="span3 sidebar_grid sidebar_left">
                  <?php dynamic_sidebar( 'primary-widget-area' ); ?>
              </div>

              <div class="span9 grid_content with-sidebar-left">
            			<?php
            			/* Run the loop to output the posts.
            			 * If you want to overload this in a child theme then include a file
            			 * called loop-index.php and that will be used instead.
            			 */
            			    get_template_part( 'loop', 'single' );
            			?>
    			    </div>

    		</div>
		</div>

<?php get_footer(); ?>
