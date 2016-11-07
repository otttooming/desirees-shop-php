<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version   2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly
}

global $wp_query;

$cat = $wp_query->get_queried_object();
$image = '';
if ( !isset($cat->term_id) || !is_search() ) {
		$image = '';
} else {
		$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
		$image = wp_get_attachment_url( $thumbnail_id );
}

get_header('shop');
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <?php do_action('woocommerce_before_main_content'); ?>
        </div>
    </div>
</div>

<div class="container">
    <div class="row cfx">

			<?php get_sidebar(); ?>

    	<div id="default_products_page_container" class="col-xs-12 col-lg-9 grid_content with-sidebar-left with-sidebar">

				<?php
					// Prints messages and errors which are stored in the session, then clears them.
					// e.g. "Product" has been added to your cart.
					echo wc_print_notices();
				?>

        <?php if($image && $image !='') : ?>
          <div class="grid__slider">
              <img class="grid__cat-banner" src="<?php echo $image ?>" />
          </div>
				<?php elseif (empty($cat->term_id) && !is_search() && is_active_sidebar( 'products-banner-top' ) ) : ?>
					<div class="grid__slider">
							<?php dynamic_sidebar( 'products-banner-top' ); ?>
					</div>
        <?php endif; ?>

        <?php if(isset($cat->description) && $cat->description !='' && !is_shop()) : ?>
          	<div class="product-category-description">
            	<?php echo do_shortcode($cat->description); ?>
          	</div>
        <?php endif; ?>

    		<?php if ( have_posts() ) : ?>

          <div class="grid__options">
          	<?php do_action('woocommerce_before_shop_loop'); ?>
          </div>

    			<?php woocommerce_product_subcategories(array('before'=>'<ul class="subcat__grid cfx">', 'after' => '</ul>')); ?>

          <div class="products-listing">
              <?php while ( have_posts() ) : the_post(); ?>

      					<?php woocommerce_get_template_part( 'content', 'product' ); ?>

      				<?php endwhile; // end of the loop. ?>
  				</div>

          <div class="grid_pagination_bottom_block cfx">
          	<?php do_action('woocommerce_after_shop_loop'); ?>
          </div>

    		<?php else : ?>

    			<?php if ( ! woocommerce_product_subcategories( array( 'before' => '<ul class="products">', 'after' => '</ul>' ) ) ) : ?>

  					<div class="empty-category-block">

							<?php dynamic_sidebar( 'empty-category-area' ); ?>

  						<p>
								<a class="button big active" href="<?php echo get_permalink(woocommerce_get_page_id('shop')); ?>">
									<span><?php _e( 'Return To Shop', 'woocommerce' ) ?></span>
								</a>
							</p>

  					</div>

    			<?php endif; ?>

    		<?php endif; ?>

    	  <?php do_action('woocommerce_after_main_content'); ?>

      </div><?php // <!-- /end default_products_page_container  --> ?>

    </div>
</div>

<?php get_footer('shop'); ?>
