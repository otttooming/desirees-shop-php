<?php
/**
 * Common structure for page template.
 *
 * @package desirees
 */
?>

<div class="container container__content">

    <div class="row">

        <?php if ($template_common_page == 'sidebar') : ?>
          <div class="col-md-3 sidebar_grid sidebar_left">
              <?php dynamic_sidebar( 'primary-widget-area' ); ?>
          </div>
        <?php endif; ?>

        <div class="<?php echo ($template_common_page == 'sidebar') ? 'col-md-9' : 'col-xs-12'; ?> grid_content with-sidebar-top cfx">
          <?php
              $post_id = $wp_query->get_queried_object_id();
              $title = get_post_field('post_title', $post_id);
          ?>

          <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
              <?php the_content(); ?>
              <?php wp_link_pages(array('before' => ''.__('Pages:', 'desirees'), 'after' => '')); ?>
          <?php endwhile; ?>
          <?php else : ?>
            <p><strong><?php _e('Not Found', 'desirees'); ?></strong></p>
            <p>
              <?php _e('Apologies, but the page you requested could not be found. Perhaps searching will help.', 'desirees'); ?>
            </p>
            <?php get_search_form(); ?>
          <?php endif; ?>

        </div>

    </div>
</div>
