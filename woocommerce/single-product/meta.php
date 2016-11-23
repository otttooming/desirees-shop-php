<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );

?>

<?php do_action( 'woocommerce_product_meta_start' ); ?>

<?php echo $product->get_categories( '', '<div class="product__details-block product-meta posted_in">' . '<h2 class="posted-in__header">' . __( 'Product categories', 'woocommerce' ) . '</h2>' . ' ', '</div>' ); ?>

<?php echo $product->get_tags( '', '<div class="product__details-block product-meta tagged_as">' . '<h2 class="tagged-as__header">' . __( 'Company', 'woocommerce' ) . '</h2>' . ' ', '</div>' ); ?>

<?php do_action( 'woocommerce_product_meta_end' ); ?>
