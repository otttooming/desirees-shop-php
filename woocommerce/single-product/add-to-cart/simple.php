<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}
?>

<?php if ( $product->is_in_stock() ) : ?>
	<div class="addto-container">


		<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

		<form class="addto" method="post" enctype='multipart/form-data'>

			<?php
				/**
				 * @since 2.1.0.
				 */
				do_action( 'woocommerce_before_add_to_cart_button' );

				/**
				 * @since 3.0.0.
				 */
				do_action( 'woocommerce_before_add_to_cart_quantity' );

				woocommerce_quantity_input( array(
					'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
					'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
					'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : $product->get_min_purchase_quantity(),
				) );

				/**
				 * @since 3.0.0.
				 */
				do_action( 'woocommerce_after_add_to_cart_quantity' );
			?>

			<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" />

			<label class="button big active">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="addto__icon"><path d="M11 9h2V6h3V4h-3V1h-2v3H8v2h3v3zm-4 9c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2zm-9.83-3.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.86-7.01L19.42 4h-.01l-1.1 2-2.76 5H8.53l-.13-.27L6.16 6l-.95-2-.94-2H1v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.13 0-.25-.11-.25-.25z" fill="currentColor"/></svg>
				<input type="submit" name="" value="">
				<?php echo $product->single_add_to_cart_text(); ?>
			</label>

			<?php
				/**
				 * @since 2.1.0.
				 */
				do_action( 'woocommerce_after_add_to_cart_button' );
			?>
		</form>

		<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

	</div>

<?php endif; ?>
