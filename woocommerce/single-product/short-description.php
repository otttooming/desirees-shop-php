<?php
/**
 * Single product short description
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;


?>
	<?php echo content(40); ?>
	<a href="#content_tab_1" id="read_more_content"><span>Rohkem informatsiooni</span></a>
    <?php if ( etheme_get_custom_field('_etheme_size_guide') ) : ?>
        <div class="size_guide">
    	 <a rel="lightbox" href="<?php etheme_option('size_guide_img'); ?>"><?php _e('SIZING GUIDE', ETHEME_DOMAIN); ?></a>
        </div>
        <div class="size_guide sg_mobile">
    	 <a rel="lightbox" href="<?php etheme_option('size_guide_img_mobile'); ?>"><?php _e('SIZING GUIDE', ETHEME_DOMAIN); ?></a>
        </div>
    <?php endif; ?>	
    <hr />