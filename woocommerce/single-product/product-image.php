<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $woocommerce;

?>

<div class="span5 product_image product__left cfx">

    <div class="main-image product__main-image-wrap">
        <?php etheme_wc_product_labels(); ?>
        <a class="main-image product__main-image" itemprop="image" href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" rel="thumbnails" title="<?php echo get_the_title( get_post_thumbnail_id() ); ?>">
            <img class="attachment-shop_single lazyload" data-src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium_large' )[0]; ?>" width="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium_large' )[1] ?>" height="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium_large' )[2] ?>" alt="<?php the_title(); ?>">
        </a>
    </div>

	  <?php do_action('woocommerce_product_thumbnails'); ?>
</div>
