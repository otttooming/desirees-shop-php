<?php
/**
 * Common structure for page template.
 *
 * @package desirees
 */
?>

<div class="container">
    <div class="row cfx">
        <?php blog_breadcrumbs(); ?>

        <?php if ($template_common_page == 'sidebar') : ?>
          <div class="span3 sidebar_grid sidebar_left">
              <?php dynamic_sidebar( 'primary-widget-area' ); ?>
          </div>
        <?php endif; ?>

        <div class="<?php echo ($template_common_page == 'sidebar') ? 'span9' : 'span12'; ?> grid_content with-sidebar-top cfx">
          <?php
              $post_id = $wp_query->get_queried_object_id();
              $title = get_post_field('post_title', $post_id);
          ?>

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
