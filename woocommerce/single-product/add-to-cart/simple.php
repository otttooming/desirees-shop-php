<?php
/**
 * Simple product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}
?>


<?php if ( $product->is_in_stock() ) : ?>
	<div class="addto-container cfx">


		<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

		<form class="cart cfx" method="post" enctype='multipart/form-data'>
			<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

			<?php
				if ( ! $product->is_sold_individually() )
					woocommerce_quantity_input( array(
						'min_value' => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
						'max_value' => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product ),
						// 'input_value' => ( isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 ) // Adds back value from customer selection
						) );
			?>

			<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />

			<button type="submit" class="button big active"><span><?php echo $product->single_add_to_cart_text(); ?></span></button>

			<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
		</form>

		<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

	</div>

	<hr>
<?php endif; ?>
