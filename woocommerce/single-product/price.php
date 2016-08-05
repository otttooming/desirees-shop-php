<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version   2.4.9
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;
?>

<?php if ( $price_html = $product->get_display_price() ) : ?>

<div class="main-info product_meta cfx" itemprop="offers" itemscope itemtype="http://schema.org/Offer">

    <div itemprop="price" class="product__price-block product__price-block-big">
        <?php echo $product->get_price_html(); ?>
    </div>

  	<meta itemprop="price" content="<?php echo esc_attr( $product->get_display_price() ); ?>" />
  	<meta itemprop="priceCurrency" content="<?php echo esc_attr( get_woocommerce_currency() ); ?>" />
  	<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />

    <?php
    	// Availability
    	$availability = $product->get_availability();

    	if ($availability['availability']) :
    		echo apply_filters( 'woocommerce_stock_html', '<div class="product-stock ' . $availability['class'].'">' . '<span class="stock__header">' . __('Availability', ETHEME_DOMAIN) . '</span>' . ' <span class="stock__number">'.$availability['availability'].'</span></div>', $availability['availability'] );
      endif;
    ?>
</div>

<hr />

<?php endif; ?>
