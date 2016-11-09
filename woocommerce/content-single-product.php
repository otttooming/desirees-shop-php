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

<div itemscope="" itemtype="http://schema.org/Product" class="row product">

  	<?php do_action( 'woocommerce_before_single_product_summary' ); ?>

    <div class="col-xs-12 col-md-7">
      <div class="product__mainblock product_description_mainblock productcol summary">
        <?php do_action( 'woocommerce_single_product_summary' ); ?>
      </div>
	  </div>

    <?php do_action( 'woocommerce_after_single_product_summary' ); ?>

</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
