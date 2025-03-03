<?php
/**
 * Pagination - Show numbered pagination for catalog pages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/pagination.php.
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
 * @version     2.2.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $wp_query;

if ( $wp_query->max_num_pages <= 1 ) {
	return;
}
?>
<nav class="pagination">
	<?php if( get_previous_posts_link() ) :

		previous_posts_link( __( 'Previous', 'woocommerce' ), 0 );

		else :

			echo '<span class="pagination__btn button medium button__disabled">' . __( 'Previous', 'woocommerce' ) . '</span>';

	endif; ?>

	<?php if( get_next_posts_link() ) :

	  next_posts_link( __( 'next', 'woocommerce' ), 0 );

	  else :

	    echo '<span class="pagination__btn button medium button__disabled">' . __( 'Next', 'woocommerce' ) . '</span>';

	endif; ?>
</nav>
