<?php
/**
 * Single Product Up-Sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

$upsells = $product->get_upsells();

$rand = rand(1000,9999);

if ( sizeof( $upsells ) == 0 ) return;

$args = array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'posts_per_page' 		=> 20,
	'no_found_rows' 		=> 1,
	'orderby' 				=> 'rand',
	'post__in' 				=> $upsells
);

$products = new WP_Query( $args );
$upsells_count = 0;
if ( $products->have_posts() ) : ?>

    <div class="product-slider upsells columns4">
        <h4 class="slider-title"><?php _e('You may also like&hellip;', 'desirees') ?></h4>
        <div class="carousel slider-<?php echo $rand ?>" <?php if($upsells_count < 5): ?>style="height:auto;"<?php endif; ?>>
            <div class="slider">
			<?php while ( $products->have_posts() ) : $products->the_post(); $upsells_count++; ?>
		      <div class="slide product-slide">
						<?php wc_get_template( 'content-product.php' ); ?>
	        </div>
			<?php endwhile; // end of the loop. ?>
            </div>
        </div>
        <?php if($upsells_count > 1): ?>
        	<?php
        		$arrowClass = '';
        		if($upsells_count < 4) {
	        		$arrowClass = 'hidden-desktop';
        		}
        	?>

            <div class="prev <?php echo $arrowClass; ?> related-arrow arrow<?php echo $rand ?>" style="cursor: pointer; ">&nbsp;</div>
            <div class="next <?php echo $arrowClass; ?> related-arrow arrow<?php echo $rand ?>" style="cursor: pointer; ">&nbsp;</div>
        <?php endif; ?>

    </div><!-- product-slider -->

<?php endif;

wp_reset_query();
