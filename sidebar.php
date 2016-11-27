<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 */
?>

<?php	if ( is_active_sidebar( 'sidebar-widget-area' ) ) : ?>

	<aside class="col-lg-3 sidebar_grid hidden-md-down">
			<?php dynamic_sidebar( 'sidebar-widget-area' ); ?>
	</aside>

<?php endif; ?>
