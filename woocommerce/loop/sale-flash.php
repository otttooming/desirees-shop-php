<?php
/**
 * Single Product Sale Flash
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/sale-flash.php.
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
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

?>
<?php if ( $product->is_on_sale() ) : ?>

	<?php echo apply_filters( 'woocommerce_sale_flash', '<div class="product-sale"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 29.5 29.5" width="15" height="15" fill="currentColor" class="product-sale__label"><path d="M15.205.043L1.06 15.203 0 16.262l12.793 11.81 1.56 1.41 14.67-16.032L29.5.017 15.205.043zm6.822 9.385a2.647 2.647 0 1 1 .002-5.294 2.647 2.647 0 0 1-.003 5.294z"/></svg><span>' . __( 'Sale!', 'woocommerce' ) . '</span></div>', $post, $product ); ?>

<?php endif;

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
