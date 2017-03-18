<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

$visible_active_variations = array_filter($available_variations, function ($v) {
    return $v['variation_is_active'] && $v['variation_is_visible'];
});
?>

<?php if ($visible_active_variations) : ?>

<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>
<?php do_action( 'woocommerce_before_variations_form' ); ?>
<div class="product-variations">
    <?php foreach ($visible_active_variations as $i => $variation) : ?>
        <hr>
        <div class="product-variations__item">
            <div class="description"><?php echo $variation['variation_description']; ?></div>
            <?php foreach ($attributes as $j => $a) : ?>
                <?php if (count(array_intersect($a, $variation['attributes'])) !== 0) : ?>
                    <div class="product-variations__attribute"><span><?php echo wc_attribute_label($j); ?>: <?php echo implode('</span><span>', array_map(function ($o) { return esc_html( apply_filters( 'woocommerce_variation_option_name', $o ) ); }, array_intersect($a, $variation['attributes']))); ?></span></div>
                <?php endif; ?>
            <?php endforeach; ?>
            <div class="product-variations__price "><?php echo $variation['price_html'] ? $variation['price_html'] : $product->get_price_html(); ?></div>
            <div class="form">
                <?php do_action( 'woocommerce_before_single_variation' ); ?>
                <?php if( $variation['is_in_stock'] ) : ?>
                    <form class="product-variations__cart addto" action="<?php echo esc_url( $product->add_to_cart_url() ); ?>" method="post" enctype='multipart/form-data'>
                        <?php woocommerce_quantity_input(array('min_value' => 1, 'max_value' => $variation['max_qty'])); ?>
                        <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
                        <label class="button medium active">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="addto__icon"><path d="M11 9h2V6h3V4h-3V1h-2v3H8v2h3v3zm-4 9c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2zm-9.83-3.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.86-7.01L19.42 4h-.01l-1.1 2-2.76 5H8.53l-.13-.27L6.16 6l-.95-2-.94-2H1v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.13 0-.25-.11-.25-.25z" fill="currentColor"/></svg>
                            <input type="submit" name="" value="" visibility="hidden" style="display: none;">
                            <?php echo esc_html( $product->single_add_to_cart_text() ); ?>
                        </label>
                        <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
                        <?php if(!empty($variation['attributes'])) : ?>
                            <?php foreach ($variation['attributes'] as $attr_key => $attr_value) : ?>
                                <input type="hidden" name="<?php echo $attr_key?>" value="<?php echo $attr_value?>">
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <input type="hidden" name="variation_id" value="<?php echo $variation['variation_id']?>" />
                        <input type="hidden" name="product_id" value="<?php echo esc_attr( $product->id ); ?>" />
                        <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />
                    </form>
                <?php else: ?>
                    <p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>
                <?php endif; ?>
                <?php do_action( 'woocommerce_after_single_variation' ); ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php do_action( 'woocommerce_after_variations_form' ); ?>
<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php else: ?>

<p><?php _e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>

<?php endif; ?>
