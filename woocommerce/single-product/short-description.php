<?php
/**
 * Single product short description
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version   1.6.4
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<div class="product__excerpt">
  <?php echo content(40); ?>
</div>

<a class="more-info" href="#content_tab_1" >
  <span class="more-info__text">
    <?php _e('More information', ETHEME_DOMAIN) ?>
  </span>
	
  <i class="more-info__icon icon-chevron-down"></i>
</a>

<hr>
