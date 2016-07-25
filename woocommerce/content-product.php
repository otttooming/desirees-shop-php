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

global $product, $post, $woocommerce_loop, $woocommerce;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$product_page_productname = etheme_get_option('product_page_productname');
$product_page_price = etheme_get_option('product_page_price');
$product_page_addtocart = etheme_get_option('product_page_addtocart');

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Increase loop count
$woocommerce_loop['loop']++;

?>

	<div class="product-grid span2 cfx">
	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

      <a href="<?php echo the_permalink(); ?>" class="product-loop__images-wrap">

					<?php woocommerce_get_template( 'loop/sale-flash.php' );  ?>
        	<div class="product-loop__images">
							<?php if( has_post_thumbnail() ) : ?>
									<img class="product-loop__img lazyload" data-src="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" alt="<?php the_title(); ?>">
							<?php else : ?>
									<img class="product-loop__img lazyload" data-src="<?php echo woocommerce_placeholder_img_src(); ?>" alt="<?php the_title(); ?>">
							<?php endif; ?>
					</div>
      </a>

      <div class="product-information product__info-block">

					<a href="<?php the_permalink(); ?>">
							<h3 class="product__title">
								<?php the_title(); ?>
							</h3>
					</a>

					<?php if ( get_the_content() ) { ?>
						<div class="product-descr">
							<div class="product-descr-info">
								<?php echo content(30); ?>
							</div>
						</div>
					<?php } ?>

          <div class="product__purchase">
            <?php if($product_page_price): ?>
                <?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
            <?php endif; ?>
            <?php if($product_page_addtocart): ?>
                <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
            <?php endif; ?>
          </div>

      </div>
	</div>
<?php
