<?php
/**
 * Additional Information tab
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author    WooThemes
 * @package   WooCommerce/Templates
 * @version   2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

?>

<div class="product__attributes">
	<?php $product->list_attributes(); ?>
</div>
