<?php
/**
 * Product quantity inputs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version   2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<div class="qty-block" id="product-quantity">
    <label class="qty-block__title"><?php _e('Qty:', ETHEME_DOMAIN); ?></label>
    <input
      type="number"
      step="<?php echo esc_attr( $step ); ?>"
      min="<?php echo esc_attr( $min_value ); ?>"
      max="<?php echo esc_attr( $max_value ); ?>"
      name="<?php echo esc_attr( $input_name ); ?>"
      value="<?php echo esc_attr( $input_value ); ?>"
      title="<?php _ex( 'Qty', 'Product quantity input tooltip', 'woocommerce' ) ?>"
      class="qty-block__input input-text qty text"
      size="4" />
</div>
