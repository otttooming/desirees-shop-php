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

$img_padding_ratio = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium_large' )[2] / wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium_large' )[1] * 100 . '%';
?>

<div class="col-xs-12 col-md-5 product__left-wrap">

<div class=" product_image product__left">
	<div class="product__left-inner">
		<div class="main-image product__main-image-wrap img-padding-ratio__wrap">
				<?php // etheme_wc_product_labels(); ?>
				<a class="main-image product__main-image" itemprop="image" href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" rel="thumbnails" title="<?php echo get_the_title( get_post_thumbnail_id() ); ?>">
						<img
						class="attachment-shop_single lazyload"
						data-src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium_large' )[0]; ?>"
						width="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium_large' )[1] ?>"
						height="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium_large' )[2] ?>"
						alt="<?php the_title(); ?>"
						data-type="<?php echo gettype(wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium_large' )[2]) ?>"
						>

				</a>
				<div style="padding-bottom:<?php echo $img_padding_ratio; ?>"></div>

		</div>

		<?php do_action('woocommerce_product_thumbnails'); ?>
	</div>
</div>


</div>
