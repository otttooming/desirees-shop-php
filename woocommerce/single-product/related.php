<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product, $woocommerce_loop;

if ( empty( $product ) || ! $product->exists() ) {
	return;
}

if ( ! $related = $product->get_related( $posts_per_page ) ) {
	return;
}

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => $posts_per_page,
	'orderby'              => $orderby,
	'post__in'             => $related,
	'post__not_in'         => array( $product->id )
) );

$products                    = new WP_Query( $args );
$woocommerce_loop['name']    = 'related';
$woocommerce_loop['columns'] = apply_filters( 'woocommerce_related_products_columns', $columns );

if ( $products->have_posts() ) : ?>

	<div class="related products product__related">

		<h2 class="product__related-header"><?php _e( 'Related Products', 'woocommerce' ); ?></h2>

		<div class="product__control-items control__items">
			<svg class="control__prev" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 501.5 501.5"><g><path fill="currentColor" d="M302.67 90.877l55.77 55.508L254.575 250.75 358.44 355.116l-55.77 55.506L143.56 250.75z"></path></g></svg>
			<svg class="control__next" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 501.5 501.5"><g><path fill="currentColor" d="M199.33 410.622l-55.77-55.508L247.425 250.75 143.56 146.384l55.77-55.507L358.44 250.75z"></path></g></svg>
		</div>

		<div class="swiper-container product__related-slider">
		    <div class="swiper-wrapper">

					<?php while ( $products->have_posts() ) : $products->the_post(); ?>

						<div class="swiper-slide">
							<?php wc_get_template_part( 'content', 'product' ); ?>
						</div>

					<?php endwhile; // end of the loop. ?>
		    </div>

		    <div class="swiper-pagination"></div>

		</div>


	</div>




<?php endif;

wp_reset_postdata();
