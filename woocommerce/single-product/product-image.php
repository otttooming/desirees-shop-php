<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $woocommerce; ?>

<div class="col-xs-12 col-md-5 product__left-wrap">

		<a class="main-image product__main-image lightbox" itemprop="image" href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" rel="thumbnails" title="<?php echo get_the_title( get_post_thumbnail_id() ); ?>" data-size="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' )[1] . 'x' . wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' )[2] ?>">
				<?php echo desirees_get_attachment_image( get_post_thumbnail_id(), 'medium_large', false, ["class" => "lazyload", "itemprop" => "image", "alt" => get_the_title()] ); ?>
		</a>

		<?php do_action('woocommerce_product_thumbnails'); ?>

</div>
