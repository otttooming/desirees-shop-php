<?php
/**
 * The template for displaying the footer.
 *
 */
?>
      <div class="container_footer_bg">
        <div class="container">
              <div class="row footer_container">
	               <div class="span3 footer_block1 f-contacts">
		               <?php if ( is_active_sidebar( 'first-footer-widget-area' ) ) : ?>
		                    <?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
		                <?php endif; ?>
	                </div>

	                 <div class="span3 footer_block1 footer-big-block">
		               <?php if ( is_active_sidebar( 'second-footer-widget-area' ) ) : ?>
		                    <?php dynamic_sidebar( 'second-footer-widget-area' ); ?>
		                <?php endif; ?>
	                </div>

	                <div class="span3 footer_block tweets-block">
		                <?php if ( is_active_sidebar( 'third-footer-widget-area' ) ) : ?>
		                    <?php dynamic_sidebar( 'third-footer-widget-area' ); ?>
		                <?php endif; ?>
	                </div>

	                <div class="span3 footer_block tweets-block">
	                  <?php if ( is_active_sidebar( 'fourth-footer-widget-area' ) ) : ?>
		                    <?php dynamic_sidebar( 'fourth-footer-widget-area' ); ?>
		                <?php endif; ?>
	                </div>

	                <hr class="footer-hr">

                  <div class="footer-menu-wrap">
  	                <div class="span3 footer_block1">
  		                <?php if ( is_active_sidebar( 'fifth-footer-widget-area' ) ) : ?>
  		                    <?php dynamic_sidebar( 'fifth-footer-widget-area' ); ?>
  		                <?php endif; ?>
  	                </div>

  		              <div class="span3 footer_block1">
  		                <?php if ( is_active_sidebar( 'sixth-footer-widget-area' ) ) : ?>
  		                    <?php dynamic_sidebar( 'sixth-footer-widget-area' ); ?>
  		                <?php endif; ?>
  	                </div>

          					<div class="span3 footer_block1">
          						<?php if ( is_active_sidebar( 'seventh-footer-widget-area' ) ) : ?>
          							<?php dynamic_sidebar( 'seventh-footer-widget-area' ); ?>
          						<?php endif; ?>
          					</div>

  	                <div class="span3 footer_block1">
  		                <?php if ( is_active_sidebar( 'eighth-footer-widget-area' ) ) : ?>
  		                    <?php dynamic_sidebar( 'eighth-footer-widget-area' ); ?>
  		                <?php endif; ?>
  	                </div>
                </div>
            </div>
        </div>
      </div>
      <div class="footer-black-bg">
      <div class="container no-bg">
      <div class="row after_footer">
        <div class="span6" id="after_footer_menu">
            <?php if ( is_active_sidebar( 'copyrights-area' ) ) : ?>
                <?php dynamic_sidebar( 'copyrights-area' ); ?>
            <?php endif; ?>
        </div>

        <div class="span6" id="after_footer_payments">
            <?php if ( is_active_sidebar( 'payments-area' ) ) : ?>
                <?php dynamic_sidebar( 'payments-area' ); ?>
            <?php endif; ?>
        </div>

      </div>

      <div id="back-to-top" class="btn-style-standart"><a href="#top" id="top-link" ><span><?php _e('Back to top',ETHEME_DOMAIN) ?></span></a></div>

      </div>
  </div>

  </div> <!-- .wrapper -->
  
<?php

  // Get PSWP lightbox template
  require get_template_directory() . 'inc/components/lightbox.php';
  
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */
	wp_footer();
?>
</body>
</html>
