<?php
/**
 * Cart Page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.8
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<form action="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" method="post" class="cart__form bg__common p1 mb1">

<h2><?php _e('Cart', 'woocommerce') ?></h2>

<?php do_action( 'woocommerce_before_cart_table' ); ?>
<table class="cart table checkout_cart" cellspacing="0" style="margin-bottom: 20px;">
	<thead class="cart__form-head">
		<tr>
			<th class="product-thumbnail cart_del_column visible-desktop">&nbsp;</th>
			<th class="product-name"><?php _e('Product', 'woocommerce'); ?></th>
			<th class="product-price cart_del_column"><?php _e('Price', 'woocommerce'); ?></th>
			<th class="product-quantity"><?php _e('Qty', 'woocommerce'); ?></th>
			<th class="product-subtotal"><?php _e('Total', 'woocommerce'); ?></th>
			<th class="product-remove cart_del_column">&nbsp;</th>
		</tr>
	</thead>
	<tbody class="cart__form-body">
	<?php do_action( 'woocommerce_before_cart_contents' ); ?>


	<?php
	if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) {
		foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values ) {
			$_product = $values['data'];
			if ( $_product->exists() && $values['quantity'] > 0 ) {
				?>
				<tr class = "<?php echo esc_attr( apply_filters('woocommerce_cart_table_item_class', 'cart_table_item', $values, $cart_item_key ) ); ?>">

					<!-- The thumbnail -->
					<td class="cart__thumbnail cart_del_column visible-desktop">
						<?php
							$thumbnail = apply_filters( 'woocommerce_in_cart_product_thumbnail', $_product->get_image(), $values, $cart_item_key );
							printf('<a href="%s">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), $thumbnail );
						?>
					</td>

					<!-- Product Name -->
					<td class="product-name">
						<?php
							if ( ! $_product->is_visible() || ( $_product instanceof WC_Product_Variation && ! $_product->parent_is_visible() ) )
								echo apply_filters( 'woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key );
							else
								printf('<a href="%s">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), apply_filters('woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key ) );

							// Meta data
							echo $woocommerce->cart->get_item_data( $values );

               				// Backorder notification
               				if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $values['quantity'] ) )
               					echo '<p class="backorder_notification">' . __('Available on backorder', 'desirees') . '</p>';
						?>
					</td>

					<!-- Product price -->
					<td class="product-price cart_del_column">
						<?php
							$product_price = get_option('woocommerce_display_cart_prices_excluding_tax') == 'yes' || $woocommerce->customer->is_vat_exempt() ? $_product->get_price_excluding_tax() : $_product->get_price();

							echo apply_filters('woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $values, $cart_item_key );
						?>
					</td>

					<!-- Quantity inputs -->
					<td class="product-quantity" id="cart-quantity">
						<?php
							if ( $_product->is_sold_individually() ) {
								$product_quantity = '1';
							} else {
								$data_min = apply_filters( 'woocommerce_cart_item_data_min', '', $_product );
								$data_max = ( $_product->backorders_allowed() ) ? '' : $_product->get_stock_quantity();
								$data_max = apply_filters( 'woocommerce_cart_item_data_max', $data_max, $_product );

								$product_quantity = sprintf( '<div class="qty-block quantity"><input name="cart[%s][qty]" type="number" data-min="%s" data-max="%s" value="%s" size="4" title="%s" class="input-text qty text" maxlength="12" /></div>', $cart_item_key, $data_min, $data_max, esc_attr( $values['quantity'] ), __('Qty', 'woocommerce') );
							}

							echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
						?>
					</td>

					<!-- Product subtotal -->
					<td class="product-subtotal">
						<?php
							echo apply_filters( 'woocommerce_cart_item_subtotal', $woocommerce->cart->get_product_subtotal( $_product, $values['quantity'] ), $values, $cart_item_key );
						?>
					</td>
					<!-- Remove from cart link -->
					<td class="product-remove cart_del_column">
						<?php
							echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="delete-btn" title="%s"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 149.337 149.337"><path fill="currentColor" d="M149.337 143.96L80.044 74.668l69.292-69.292L143.96 0 74.668 69.292 5.378 0 0 5.376l69.292 69.292L0 143.96l5.376 5.376 69.292-69.292 69.293 69.292z"/></svg></a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __('Remove this item', 'woocommerce') ), $cart_item_key );
						?>
					</td>
				</tr>
				<?php
			}
		}
	}

	do_action( 'woocommerce_cart_contents' );
	?>
</tbody>

</table>

<div class="mb1">
	<?php do_action( 'woocommerce_after_cart_contents' ); ?>

	<input type="submit" class="button update-button" name="update_cart" value="<?php _e('Update Cart', 'woocommerce'); ?>" />

	<?php wp_nonce_field('woocommerce-cart') ?>
</div>

<hr>

<?php do_action( 'woocommerce_after_cart_table' ); ?>

<div class="wc-proceed-to-checkout">
	<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
</div>
</form>
