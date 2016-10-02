<?php
/**
 * Empty cart page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version   2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

wc_print_notices();
?>

<?php do_action('woocommerce_cart_is_empty'); ?>

<div class="empty-cart-block">
		<i class="icon-shopping-cart"></i>

		<?php // etheme_option('empty_cart_content'); ?>
		<p>
				<a class="button" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
						<?php _e( 'Return To Shop', 'woocommerce' ) ?>
				</a>
		</p>

</div>
