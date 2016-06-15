<?php
/**
 * The template for displaying the footer.
 *
 */
?>
<?php global $etheme_responsive; ?>

      <div class="footer-black-bg">
      <div class="container no-bg">
      <div class="row after_footer">
        <div class="span6" id="after_footer_menu">
            <?php if ( !is_active_sidebar( 'copyrights-area' ) ) : ?>
            <?php else: ?>
                <?php dynamic_sidebar( 'copyrights-area' ); ?>
            <?php endif; ?>

            <div class="span6 footer-copyright">
                <span class="copyright"><?php etheme_option('copyright') ?></span>

            </div>
        </div>




      </div>

      <div id="back-to-top" class="btn-style-standart"><a href="#top" id="top-link" ><span><?php _e('Back to top',ETHEME_DOMAIN) ?></span></a></div>

      </div>
  </div>

  </div> <!-- .wrapper -->
<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>
