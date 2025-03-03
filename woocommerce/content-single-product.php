<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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
	exit; // Exit if accessed directly
}
?>

<?php do_action( 'woocommerce_before_single_product' ); ?>

<div itemscope="" itemtype="http://schema.org/Product" class="row product">

  	<?php do_action( 'woocommerce_before_single_product_summary' ); ?>

    <div class="col-xs-12 col-md-7">
      <div class="product__mainblock product_description_mainblock productcol summary">
        <?php do_action( 'woocommerce_single_product_summary' ); ?>
      </div>

      <?php do_action( 'woocommerce_after_single_product_summary' ); ?>
	  </div>

</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
