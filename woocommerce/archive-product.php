<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header('shop');
?>

<div class="container">
    <div class="row">
        <div class="span12 breadcrumbs">
            <?php
                do_action('woocommerce_before_main_content');

                extract(etheme_get_shop_sidebar());
	          ?>
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
            global $wp_query;
            $cat = $wp_query->get_queried_object();
            $image = '';
            if(empty($cat->term_id) && !is_search()){
                $image = etheme_get_option('product_bage_banner');
            }else{
                $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
                $image = wp_get_attachment_url( $thumbnail_id );
            }
        ?>

				<?php
					// Prints messages and errors which are stored in the session, then clears them.
					// e.g. "Product" has been added to your cart.
					echo wc_print_notices();
				?>

        <?php if($image && $image !=''){ ?>
          <div class="grid_slider">
              <img class="cat-banner" src="<?php echo $image ?>" />
          </div>
        <?php } ?>

        <?php if(isset($cat->description) && $cat->description !='' && !is_shop()) { ?>
          	<div class="product-category-description">
            	<?php echo do_shortcode($cat->description); ?>
          	</div>
        <?php } ?>

        <?php etheme_demo_alerts(); ?>

    		<?php if ( have_posts() ) : ?>

          <div class="grid__options">
          	<?php do_action('woocommerce_before_shop_loop'); ?>
          </div>

    			<?php woocommerce_product_subcategories(array('before'=>'<ul class="subcat__grid cfx">', 'after' => '</ul>')); ?>

          <div id="products-grid" class="products_grid products-grid row rows-count4 cfx">
              <?php while ( have_posts() ) : the_post(); ?>

      					<?php woocommerce_get_template_part( 'content', 'product' ); ?>

      				<?php endwhile; // end of the loop. ?>
  				</div>

  				<!-- <script type="text/javascript">listSwitcher(); check_view_mod();</script> -->

          <div class="grid_pagination_bottom_block cfx">
          	<?php do_action('woocommerce_after_shop_loop'); ?>
          </div>

    		<?php else : ?>

    			<?php if ( ! woocommerce_product_subcategories( array( 'before' => '<ul class="products">', 'after' => '</ul>' ) ) ) : ?>

  					<div class="empty-category-block">

  						<?php etheme_option('empty_category_content'); ?>
  						<p><a class="button active arrow-left" href="<?php echo get_permalink(woocommerce_get_page_id('shop')); ?>"><span><?php _e('Return To Shop', ETHEME_DOMAIN) ?></span></a></p>

  					</div>

    			<?php endif; ?>

    		<?php endif; ?>

        <?php dynamic_sidebar( 'under-product-widget-area' ); ?>

    	  <?php do_action('woocommerce_after_main_content'); ?>

      </div><?php // <!-- /end default_products_page_container  --> ?>

    </div>
</div>

<?php get_footer('shop'); ?>
