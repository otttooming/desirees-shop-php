<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version 	2.6.1
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

?>
<li itemscope itemtype="http://schema.org/Product" class="<?php if ( !isset($is_slider) || !$is_slider ) : ?>col-xs-12 col-md-3 col-sm-6<?php else : ?> swiper-slide<?php endif; ?> products-listing__item">
	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<?php if( has_post_thumbnail() ) : ?>
			<?php echo desirees_get_attachment_image( get_post_thumbnail_id(), 'medium', false, ["class" => "lazyload", "itemprop" => "image", "alt" => get_the_title()] ); ?>
	<?php else : ?>
			<svg xmlns="http://www.w3.org/2000/svg" width="75" height="75" viewBox="0 0 392.697 392.697"><path d="M21.837 83.42l36.496 16.677 169.387-80.21a3.5 3.5 0 0 0-.102-6.355L197.766.3c-.903-.4-1.933-.4-2.837 0L21.872 77.036a3.5 3.5 0 0 0-.036 6.383zM185.69 177.26l-64.99-30.01v91.618a2.502 2.502 0 0 1-3.578 2.256L48.248 208.5a2.5 2.5 0 0 1-1.42-2.257v-92.23L6.803 95.5a3.498 3.498 0 0 0-4.955 3.182v208.744c0 1.37.798 2.615 2.044 3.185l178.886 81.77a3.512 3.512 0 0 0 3.347-.24 3.503 3.503 0 0 0 1.608-2.946v-208.75c0-1.368-.8-2.613-2.046-3.183zM389.24 95.74a3.503 3.503 0 0 0-3.347-.238l-178.876 81.76a3.502 3.502 0 0 0-2.045 3.185v208.75a3.5 3.5 0 0 0 4.955 3.186l178.876-81.768a3.498 3.498 0 0 0 2.045-3.185V98.685a3.5 3.5 0 0 0-1.608-2.945zM372.915 80.216a3.504 3.504 0 0 0-2.082-3.18l-60.182-26.68a3.5 3.5 0 0 0-2.937.044l-173.755 82.992 60.933 29.117a3.5 3.5 0 0 0 2.91 0l173.067-79.093a3.493 3.493 0 0 0 2.048-3.2z"/></svg>
	<?php endif; ?>

	<?php woocommerce_get_template( 'loop/sale-flash.php' );  ?>

	<a itemprop="url" class="products-listing__link" href="<?php the_permalink(); ?>">
			<h3 itemprop="name" class="products-listing__name">
					<?php the_title(); ?>
			</h3>
	</a>

	<?php do_action( 'desirees_after_product_loop_images_wrap' ); ?>
</li>
