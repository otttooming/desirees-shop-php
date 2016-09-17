<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php do_action( 'woocommerce_before_single_product' ); ?>

<div itemscope="" itemtype="http://schema.org/Product">
    <div id="product-page" class="row product f-center">

      	<?php do_action( 'woocommerce_before_single_product_summary' ); ?>

        <div class="span4 product__mainblock product_description_mainblock productcol summary">
    		    <?php do_action( 'woocommerce_single_product_summary' ); ?>
    	  </div>

        <div class="span3 product__banner product_description_banner cfx">
            <?php dynamic_sidebar( 'product-single-widget-area' ); ?>
        </div>

    </div>
    <?php do_action( 'woocommerce_after_single_product_summary' ); ?>

    <?php do_action( 'woocommerce_after_single_product' ); ?>
</div>
