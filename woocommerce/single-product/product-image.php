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

<div class="span5 product_image cfx">
    <h1 class="product-title2">
      <?php the_title(); ?>
    </h1>

    <div class="main-image">
        <?php etheme_wc_product_labels(); ?>
        <a itemprop="image" href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" rel="thumbnails" title="<?php echo get_the_title( get_post_thumbnail_id() ); ?>">
            <img class="attachment-shop_single" src="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>"  alt="<?php the_title(); ?>">
        </a>
    </div>

	  <?php do_action('woocommerce_product_thumbnails'); ?>
</div>
