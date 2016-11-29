<?php
/**
 * The template for displaying the footer.
 *
 */
?>

  <footer class="container container__footer mt1 py1">
      <?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) ) : ?>
          <div class="row">
              <div class="col-md-3 col-sm-4 col-xs-12">
                  <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                      <?php dynamic_sidebar( 'footer-1' ); ?>
                  <?php endif; ?>
              </div>

              <div class="col-md-9 col-sm-8 col-xs-12">
                  <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                      <?php dynamic_sidebar( 'footer-2' ); ?>
                  <?php endif; ?>
              </div>
          </div>
      <?php endif; ?>

      <?php if ( is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ) : ?>
          <div class="row">
              <div class="col-md-6 col-xs-12">
                  <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
                      <?php dynamic_sidebar( 'footer-3' ); ?>
                  <?php endif; ?>
              </div>

              <div class="col-md-6 col-xs-12">
                  <?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
                      <?php dynamic_sidebar( 'footer-4' ); ?>
                  <?php endif; ?>
              </div>
          </div>
      <?php endif; ?>

      <?php if ( is_active_sidebar( 'footer-wide' ) ) : ?>
          <div class="row">
              <div class="col-xs-12">
                  <?php if ( is_active_sidebar( 'footer-wide' ) ) : ?>
                      <?php dynamic_sidebar( 'footer-wide' ); ?>
                  <?php endif; ?>
              </div>
          </div>
      <?php endif; ?>
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
