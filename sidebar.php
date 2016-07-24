<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 */
?>

<?php	if ( is_active_sidebar( 'primary-widget-area' ) ) : ?>

		<div id="primary" class="widget-area" role="complementary">
				<?php dynamic_sidebar( 'primary-widget-area' ); ?>
		</div>

<?php endif; ?>

<?php	if ( is_active_sidebar( 'secondary-widget-area' ) ) : ?>

		<div id="secondary" class="widget-area" role="complementary">
				<?php dynamic_sidebar( 'secondary-widget-area' ); ?>
		</div>

<?php endif; ?>
