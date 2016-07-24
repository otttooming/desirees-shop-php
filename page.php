<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 */
global $wp_query;

get_header();
?>

		<div class="container">
				<div class="row cfx">
						<?php blog_breadcrumbs(); ?>

						<div class="span3 sidebar_grid sidebar_left">
								<?php dynamic_sidebar( 'primary-widget-area' ); ?>
						</div>

						<div class="span9 grid_content with-sidebar-top cfx">
							<?php
									$post_id = $wp_query->get_queried_object_id();
			            $title = get_post_field('post_title', $post_id);
							?>

							<h1 class="page-title"><?php echo $title; ?></h1>

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
									<?php the_content(); ?>
									<?php wp_link_pages(array('before' => ''.__('Pages:', ETHEME_DOMAIN), 'after' => '')); ?>
							<?php endwhile; ?>
							<?php else : ?>
								<p><strong><?php _e('Not Found', ETHEME_DOMAIN); ?></strong></p>
								<p>
									<?php _e('Apologies, but the page you requested could not be found. Perhaps searching will help.', ETHEME_DOMAIN); ?>
								</p>
								<?php get_search_form(); ?>
							<?php endif; ?>

						</div>

				</div>
		</div>

<?php get_footer(); ?>
