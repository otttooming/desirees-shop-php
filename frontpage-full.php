<?php
/**
 * Template Name: Frontpage full
 */

  global $wp_query, $current_page_id, $template_header;
  $orig_query = $wp_query;
  $current_page_id = $wp_query->get_queried_object_id();
  $template_header = 'full';

  get_header();
?>

<?php $frontpage_query = new WP_Query( array ( 'page_id' => $current_page_id ) ); ?>

<?php if ( $frontpage_query->have_posts() ) while ( $frontpage_query->have_posts() ) : $frontpage_query->the_post(); ?>
   <?php the_content(); ?>
<?php endwhile; ?>

<?php get_footer(); ?>
