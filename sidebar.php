<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 */
?>

<?php	if ( is_active_sidebar( 'sidebar-widget-area' ) ) : ?>

	<aside class="col-lg-3 sidebar_grid hidden-md-down">

	    <?php do_action('desirees_breadcrumbs'); ?>

			<?php dynamic_sidebar( 'sidebar-widget-area' ); ?>

			<div class="widget-container">

				<h2 class="widget-title filters-menu__wrap">
					<!-- <svg fill="currentColor" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
							<path d="M0 0h24v24H0z" fill="none"/>
							<path d="M19.43 12.98c.04-.32.07-.64.07-.98s-.03-.66-.07-.98l2.11-1.65c.19-.15.24-.42.12-.64l-2-3.46c-.12-.22-.39-.3-.61-.22l-2.49 1c-.52-.4-1.08-.73-1.69-.98l-.38-2.65C14.46 2.18 14.25 2 14 2h-4c-.25 0-.46.18-.49.42l-.38 2.65c-.61.25-1.17.59-1.69.98l-2.49-1c-.23-.09-.49 0-.61.22l-2 3.46c-.13.22-.07.49.12.64l2.11 1.65c-.04.32-.07.65-.07.98s.03.66.07.98l-2.11 1.65c-.19.15-.24.42-.12.64l2 3.46c.12.22.39.3.61.22l2.49-1c.52.4 1.08.73 1.69.98l.38 2.65c.03.24.24.42.49.42h4c.25 0 .46-.18.49-.42l.38-2.65c.61-.25 1.17-.59 1.69-.98l2.49 1c.23.09.49 0 .61-.22l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.65zM12 15.5c-1.93 0-3.5-1.57-3.5-3.5s1.57-3.5 3.5-3.5 3.5 1.57 3.5 3.5-1.57 3.5-3.5 3.5z"/>
					</svg> -->

					<?php _e( 'Filter by', 'woocommerce' ); ?>

					<!-- <div class="control__items">
							<svg class="control__down" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 501.5 501.5"><g><path fill="currentColor" d="M199.33 410.622l-55.77-55.508L247.425 250.75 143.56 146.384l55.77-55.507L358.44 250.75z"></path></g></svg>
					</div> -->
				</h2>

				<div class="">
					<?php do_action( 'desirees_sidebar_settings' ); ?>
				</div>
			</div>
	</aside>

<?php endif; ?>
