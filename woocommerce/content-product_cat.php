<?php
/**
 * The template for displaying product category thumbnails within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product_cat.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version 	2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$small_thumbnail_size = apply_filters( 'single_product_small_thumbnail_size', 'shop_catalog' );
$thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );
$dimensions = wc_get_image_size( $small_thumbnail_size );
$image = wp_get_attachment_url( $thumbnail_id );
?>

<li class="subcat__block">
	<a class="subcat__item" href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">

		<?php if ( $image ) : ?>
			<img class="subcat__img" src="<?php echo $image; ?>" alt="<?php echo $category->name; ?>" width="<?php echo $dimensions['width'];  ?>" height="<?php echo $dimensions['height'];  ?>">
		<?php endif; ?>

		<h3 class="subcat__header">
			<?php echo $category->name; ?>
			<?php if ( $category->count > 0 ) : ?>
				<mark class="subcat__count">(<?php echo $category->count; ?>)</mark>
			<?php endif; ?>
		</h3>

	</a>
</li>
