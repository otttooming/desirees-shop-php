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
				<?php etheme_footer_demo(8); ?>
            <?php else: ?>
                <?php dynamic_sidebar( 'copyrights-area' ); ?>
            <?php endif; ?>  
            
            <div class="span6 footer-copyright">
                <span class="copyright"><?php etheme_option('copyright') ?></span>
                
            </div>
        </div>
	        
      

        
      </div>

		<?php if(etheme_get_option('to_top') != 'disable'): ?>
		    <div id="back-to-top" class="btn-style-<?php etheme_option('to_top') ?>"><a href="#top" id="top-link" ><span><?php _e('Back to top',ETHEME_DOMAIN) ?></span></a></div>
		<?php endif ;?>	
      </div>
  </div>
  <?php if(etheme_get_option('responsive')): ?>
        	<div class="span12 responsive-switcher visible-phone visible-tablet <?php if(!$etheme_responsive) echo 'visible-desktop'; ?>">
            	<?php _e('Mobile version',  ETHEME_DOMAIN) ?>: 
            	<?php if($etheme_responsive): ?>
            		<a href="<?php echo home_url(); ?>/?responsive=off"><?php _e('Enabled',  ETHEME_DOMAIN) ?></a>
            	<?php else: ?>
            		<a href="<?php echo home_url(); ?>/?responsive=on"><?php _e('Disabled',  ETHEME_DOMAIN) ?></a>
            	<?php endif; ?>
        	</div>
        
        <?php endif; ?>  
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