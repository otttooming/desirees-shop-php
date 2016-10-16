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

<?php if ( get_the_content() ) : ?>

	<div class="product__excerpt">
	  <?php echo content(20); ?>
	</div>

	<a class="button" href="#content_tab_1" >
	  <span class="more-info__text">
	    <?php _e('Read more', 'desirees') ?>
	  </span>
	</a>

	<hr>

<?php endif; ?>
