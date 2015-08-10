<?php
/**
 * Template Name: Frontpage-2alt
 */
 global $wp_query, $current_page_id;
$orig_query = $wp_query;
$current_page_id = $wp_query->get_queried_object_id();
get_header( '2alt' );
?>
        
    	<?php $frontpage_query = new WP_Query( array ( 'page_id' => $current_page_id ) ); ?>
    	<?php if ( $frontpage_query->have_posts() ) while ( $frontpage_query->have_posts() ) : $frontpage_query->the_post(); ?>
    	<?php the_content(); ?>	
    	<?php endwhile; ?>
<?php get_footer( '2alt' ); ?>