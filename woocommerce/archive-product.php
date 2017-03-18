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

if ( !empty($cat->term_id) ) {
		$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
		$image = wp_get_attachment_url( $thumbnail_id );
}

get_header('shop');
?>

<div class="container container__content">
    <div class="row">

			<?php get_sidebar(); ?>

    	<div class="col-xs-12 col-lg-9">

				<?php
					// Prints messages and errors which are stored in the session, then clears them.
					// e.g. "Product" has been added to your cart.
					echo wc_print_notices();
				?>

				<?php do_action('woocommerce_before_main_content'); ?>

        <?php if( !empty($cat->term_id) && !empty($thumbnail_id) ) : ?>
          <div class="grid__slider">
							<?php echo desirees_get_attachment_image( $thumbnail_id, 'full', false, ["class" => "grid__cat-banner lazyload", "itemprop" => "image", "alt" => $cat->name] ); ?>
          </div>
				<?php elseif ( !is_search() && is_active_sidebar( 'products-banner-top' ) ) : ?>
					<div class="grid__slider">
							<?php dynamic_sidebar( 'products-banner-top' ); ?>
					</div>
        <?php endif; ?>

        <?php if( !empty($cat->description) && !is_shop()) : ?>
          	<div class="product-category-description bg__common p1 mb1">
            	<?php echo do_shortcode($cat->description); ?>
          	</div>
        <?php endif; ?>

    		<?php if ( have_posts() ) : ?>

					<?php do_action('woocommerce_before_shop_loop'); ?>

    			<?php woocommerce_product_subcategories(array('before'=>'<ul class="subcat__grid cfx">', 'after' => '</ul>')); ?>

          <main role="main">
						<ul class="row row--no-gutters products-listing">
							<?php while ( have_posts() ) : the_post(); ?>

								<?php wc_get_template( 'content-product.php' ); ?>

							<?php endwhile; // end of the loop. ?>
						</ul>
  				</main>

					<?php do_action('woocommerce_after_shop_loop'); ?>

    		<?php else : ?>

    			<?php if ( ! woocommerce_product_subcategories( array( 'before' => '<ul class="products">', 'after' => '</ul>' ) ) ) : ?>
						<?php dynamic_sidebar( 'empty-category-area' ); ?>
    			<?php endif; ?>

    		<?php endif; ?>

    	  <?php do_action('woocommerce_after_main_content'); ?>

      </div><?php // <!-- /end default_products_page_container  --> ?>

    </div>
</div>

<?php get_footer('shop'); ?>
