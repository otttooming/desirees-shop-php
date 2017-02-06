<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header('shop'); ?>

<div class="container">
  <?php do_action('woocommerce_before_main_content'); ?>

	<?php while ( have_posts() ) : the_post(); ?>
    <?php wc_get_template( 'content-single-product.php' ); ?>
	<?php endwhile; ?>

	<?php do_action('woocommerce_after_main_content'); ?>
</div>

<?php get_footer('shop'); ?>
