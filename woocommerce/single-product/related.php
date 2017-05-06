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
 * @version     3.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$is_slider = true;

if ( $related_products ) : ?>

	<div class="row row--no-gutters bg__common m-10-0-0-0 related">
		<h2 class="col-xs-12 px1 related__header"><?php _e( 'Related Products', 'woocommerce' ); ?></h2>

		<ul class="col-xs-12 products-listing related__wrapper swiper-wrapper">

			<?php foreach ( $related_products as $related_product ) : ?>

				<?php
					$post_object = get_post( $related_product->get_id() );
					setup_postdata( $GLOBALS['post'] =& $post_object );
					wc_get_template( 'content-product.php', array('is_slider' => $is_slider ) ); ?>

			<?php endforeach; ?>

		</ul>
	</div>

<?php endif;

wp_reset_postdata();
