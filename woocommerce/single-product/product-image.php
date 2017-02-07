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

global $post, $woocommerce; ?>

<div class="col-xs-12 col-md-5 product__left-wrap">

	<div class="product_image product__left">
		<figure class="main-image product__main-image-wrap">
			<a class="main-image product__main-image lightbox" itemprop="image" href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" rel="thumbnails" title="<?php echo get_the_title( get_post_thumbnail_id() ); ?>" data-size="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' )[1] . 'x' . wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' )[2] ?>">
					<?php echo desirees_get_attachment_image( get_post_thumbnail_id(), 'medium_large', false, ["class" => "lazyload", "itemprop" => "image", "alt" => get_the_title()] ); ?>
			</a>
		</figure>

		<?php do_action('woocommerce_product_thumbnails'); ?>
	</div>

</div>
