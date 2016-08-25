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
        <div class="span12 breadcrumbs">
            <?php do_action('woocommerce_before_main_content'); ?>
        </div>
    </div>
</div>

<div class="container">
    <div class="row cfx">

    	<div id="products-sidebar" class="span3 sidebar_grid leftnav acc_enabled sidebar_left cfx">
          <?php dynamic_sidebar( 'product-widget-area' ); ?>
      </div>

    	<div id="default_products_page_container" class="grid_content with-sidebar-left span9 with-sidebar">

				<?php
					// Prints messages and errors which are stored in the session, then clears them.
					// e.g. "Product" has been added to your cart.
					echo wc_print_notices();
				?>

        <?php if($image && $image !='') : ?>
          <div class="grid__slider">
              <img class="grid__cat-banner" src="<?php echo $image ?>" />
          </div>
				<?php elseif (empty($cat->term_id) && !is_search() && is_active_sidebar( 'product_bage_banner' ) ) : ?>
					<div class="grid__slider">
							<?php dynamic_sidebar( 'product_bage_banner' ); ?>
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
            
            <div class="view-switcher">
              <label><?php _e('View as', ETHEME_DOMAIN); ?></label>
              <div class="switchToGrid"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 80.538 80.538"><path d="M0 21.965h21.965V0H0v21.965zm29.287 0h21.965V0H29.287v21.965zM58.573 0v21.965h21.965V0H58.573zM0 51.25h21.965V29.288H0V51.25zm29.287 0h21.965V29.288H29.287V51.25zm29.286 0h21.965V29.288H58.573V51.25zM0 80.54h21.965V58.573H0v21.965zm29.287 0h21.965V58.573H29.287v21.965zm29.286 0h21.965V58.573H58.573v21.965z" fill="currentColor"/></svg></div>
              <div class="switchToList"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 560.414 560.415"><path d="M115.65 24.92H33.507C15.03 24.92 0 39.95 0 58.42v82.144c0 18.477 15.03 33.5 33.507 33.5h82.143c18.476 0 33.5-15.03 33.5-33.5V58.42c-.005-18.475-15.03-33.5-33.5-33.5zM526.908 24.92H212.205c-18.477 0-33.5 15.03-33.5 33.5v82.144c0 18.477 15.024 33.5 33.5 33.5h314.703c18.477 0 33.506-15.03 33.506-33.5V58.42c0-18.475-15.037-33.5-33.506-33.5zM115.65 205.632H33.507C15.03 205.632 0 220.662 0 239.132v82.144c0 18.476 15.03 33.5 33.507 33.5h82.143c18.476 0 33.5-15.024 33.5-33.5v-82.143c-.005-18.476-15.03-33.5-33.5-33.5zM526.908 205.632H212.205c-18.477 0-33.5 15.03-33.5 33.5v82.144c0 18.476 15.024 33.5 33.5 33.5h314.703c18.477 0 33.506-15.024 33.506-33.5v-82.143c0-18.476-15.037-33.5-33.506-33.5zM115.65 386.343H33.507C15.03 386.343 0 401.373 0 419.85v82.143c0 18.477 15.03 33.5 33.507 33.5h82.143c18.476 0 33.5-15.023 33.5-33.5V419.85c-.005-18.476-15.03-33.507-33.5-33.507zM526.908 386.343H212.205c-18.477 0-33.5 15.03-33.5 33.507v82.143c0 18.477 15.024 33.5 33.5 33.5h314.703c18.477 0 33.506-15.023 33.506-33.5V419.85c0-18.476-15.037-33.507-33.506-33.507z" fill="currentColor"/></svg></div>
            </div>
          </div>

    			<?php woocommerce_product_subcategories(array('before'=>'<ul class="subcat__grid cfx">', 'after' => '</ul>')); ?>

          <div id="products-grid" class="products_grid products-grid row rows-count4 cfx">
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

        <?php dynamic_sidebar( 'under-product-widget-area' ); ?>

    	  <?php do_action('woocommerce_after_main_content'); ?>

      </div><?php // <!-- /end default_products_page_container  --> ?>

    </div>
</div>

<?php get_footer('shop'); ?>
