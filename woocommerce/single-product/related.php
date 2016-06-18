<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

$related = $product->get_related(20);
$product_per_row = etheme_get_option('prodcuts_per_row');

if ( sizeof($related) == 0 ) return;

$args = apply_filters('woocommerce_related_products_args', array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'no_found_rows' 		=> 1,
	'posts_per_page' 		=> 20,
	'orderby' 				=> $orderby,
	'post__in' 				=> $related
) );

$products = new WP_Query( $args );
$woocommerce_loop['columns'] 	= $columns;
$related_count = 0;

if ( $products->have_posts() ) : ?>
    <div class="product-slider related columns<?php echo $product_per_row?>">
        <h4 class="slider-title"><?php _e('Related Products', ETHEME_DOMAIN); ?></h4>
        <div class="clear"></div>
        <div class="carousel">
            <div class="slider">
			<?php while ( $products->have_posts() ) : $products->the_post();  $related_count++; ?>
		      <div class="slide product-slide">
				<?php woocommerce_get_template_part( 'content', 'product' ); ?>
	           </div>
			<?php endwhile; // end of the loop. ?>
            </div>
        </div>
        <?php if($related_count > 1): ?>

        	<?php
        		$arrowClass = '';
        		if($related_count < 4) {
	        		$arrowClass = 'hidden-desktop';
        		}
        	?>

            <div class="prev related-arrow"></div>
            <div class="next related-arrow"></div>
        <?php endif; ?>

    </div><!-- product-slider -->
    <?php if($related_count > 1): ?>

    <?php endif; ?>

<?php endif;

wp_reset_query();
