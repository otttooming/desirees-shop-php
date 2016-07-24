<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $woocommerce;

?>

<h1 class="product-title2">
		<?php the_title(); ?>
</h1>

<div class="span5 product_image product__left cfx">

    <div class="main-image product__main-image-wrap">
        <?php etheme_wc_product_labels(); ?>
        <a class="main-image product__main-image" itemprop="image" href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" rel="thumbnails" title="<?php echo get_the_title( get_post_thumbnail_id() ); ?>">
            <img class="attachment-shop_single" src="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>"  alt="<?php the_title(); ?>">
        </a>
    </div>

	  <?php do_action('woocommerce_product_thumbnails'); ?>
</div>
