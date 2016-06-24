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
    <div class="row">
        <div class="span12 breadcrumbs">
            <?php do_action('woocommerce_before_main_content'); ?>
        </div>
    </div>
</div>

<div class="container cfx">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php woocommerce_get_template_part( 'content', 'single-product' ); ?>
	<?php endwhile; ?>

	<?php do_action('woocommerce_after_main_content'); ?>
</div>

<?php get_footer('shop'); ?>
