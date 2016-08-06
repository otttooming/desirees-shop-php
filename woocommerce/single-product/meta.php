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

<div class="product__meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php echo $product->get_categories( '<span class="separator__tag">&bull;</span>', '<div class="posted_in">' . '<span class="posted-in__header">' . _n( 'Category:', 'Categories:', $cat_count, 'woocommerce' ) . '</span>' . ' ', '</div>' ); ?>

	<?php echo $product->get_tags( '<span class="separator__tag">&bull;</span>', '<div class="tagged_as">' . '<span class="tagged-as__header">' . _n( 'Tag:', 'Tags:', $tag_count, 'woocommerce' ) . '</span>' . ' ', '</div>' ); ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>
