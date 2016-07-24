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
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>

<!-- Root element of PhotoSwipe. Must have class pswp. -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

    <!-- Background of PhotoSwipe.
         It's a separate element as animating opacity is faster than rgba(). -->
    <div class="pswp__bg"></div>

    <!-- Slides wrapper with overflow:hidden. -->
    <div class="pswp__scroll-wrap">

        <!-- Container that holds slides.
            PhotoSwipe keeps only 3 of them in the DOM to save memory.
            Don't modify these 3 pswp__item elements, data is added later on. -->
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>

        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
        <div class="pswp__ui pswp__ui--hidden">

            <div class="pswp__top-bar">

                <!--  Controls are self-explanatory. Order can be changed. -->

                <div class="pswp__counter"></div>

                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                <button class="pswp__button pswp__button--share" title="Share"></button>

                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
                <!-- element will get class pswp__preloader--active when preloader is running -->
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                      <div class="pswp__preloader__cut">
                        <div class="pswp__preloader__donut"></div>
                      </div>
                    </div>
                </div>
            </div>

            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>

            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>

            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>

            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>

        </div>

    </div>

</div>
</body>
</html>
