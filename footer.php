<?php
/**
 * The template for displaying the footer.
 *
 */
?>

  <footer class="container container__footer">
      <div class="row">
          <div class="col-md-3 col-sm-4">
              <?php if ( is_active_sidebar( 'first-footer-widget-area' ) ) : ?>
                  <?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
              <?php endif; ?>
          </div>

          <div class="col-md-9 col-sm-8">
              <?php if ( is_active_sidebar( 'second-footer-widget-area' ) ) : ?>
                  <?php dynamic_sidebar( 'second-footer-widget-area' ); ?>
              <?php endif; ?>
          </div>
      </div>

      <div class="row">
        <div class="col-md-6">
            <?php if ( is_active_sidebar( 'copyrights-area' ) ) : ?>
                <?php dynamic_sidebar( 'copyrights-area' ); ?>
            <?php endif; ?>
        </div>

        <div class="col-md-6">
            <?php if ( is_active_sidebar( 'payments-area' ) ) : ?>
                <?php dynamic_sidebar( 'payments-area' ); ?>
            <?php endif; ?>
        </div>
      </div>
  </footer>

</div>
<?php // END .wrapper ?>

<?php

  // Get mobile menu navigation
  require get_template_directory() . '/inc/components/menu-mobile.php';

  // Get PSWP lightbox template
  require get_template_directory() . '/inc/components/lightbox.php';

	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */
	wp_footer();
?>
</body>
</html>
