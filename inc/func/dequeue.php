<?php

/**
 * Display used styles and scripts
 * Use for dev env only.
 */
function devotion_used_scripts_styles() {
	global $wp_scripts;
	global $wp_styles;

  $scripts_list;
	$styles_list;

	// Runs through the queue scripts
	foreach( $wp_scripts->queue as $handle ) :
		$scripts_list .= $handle . ' | ';
	endforeach;

	// Runs through the queue styles
	foreach( $wp_styles->queue as $handle ) :
		$styles_list .= $handle . ' | ';
	endforeach;

	printf('Scripts: %1$s  Styles: %2$s',
	$scripts_list,
	$styles_list);
}
// add_action( 'wp_print_scripts', 'devotion_used_scripts_styles' );

/**
 * Dequeue assets
 */

function devotion_dequeue_scripts_styles() {
	wp_deregister_style('wpr_giftcards_css');

	if ( !is_checkout() ) {
		wp_deregister_script(	'jquery'	);
		wp_deregister_script(	'woocommerce'	);
	}

	wp_deregister_script(	'wc-cart-fragments'	);
	wp_deregister_script(	'wpr_giftcards_js '	);
	wp_deregister_script( 'prettyPhoto' );
	wp_deregister_script( 'prettyPhoto-init' );
	wp_deregister_script( 'woocommerce_prettyPhoto_css' );
	wp_deregister_script( 'wp-embed' );

	wp_dequeue_script( 'prettyPhoto' );
	wp_dequeue_script( 'prettyPhoto-init' );
	wp_deregister_style( 'woocommerce_prettyPhoto_css' );

}
add_action( 'wp_print_styles', 'devotion_dequeue_scripts_styles', 100 );

add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Remove wp_head actions
 */
remove_action( 'wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link'); // index link
remove_action( 'wp_head', 'parent_post_rel_link'); // prev link
remove_action( 'wp_head', 'start_post_rel_link'); // start link
remove_action( 'wp_head', 'adjacent_posts_rel_link'); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action(' wp_head', 'feed_links_extra', 3); // Remove category feeds
remove_action(' wp_head', 'feed_links', 2); // Remove Post and Comment

remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

// Disable use XML-RPC
add_filter( 'xmlrpc_enabled', '__return_false' );

// Disable X-Pingback to header
add_filter( 'wp_headers', 'disable_x_pingback' );
function disable_x_pingback( $headers ) {
    unset( $headers['X-Pingback'] );

return $headers;
}

remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

// Remove Woocommerce checkout fields
add_filter( 'woocommerce_checkout_fields' , 'desirees_override_checkout_fields' );
add_filter( 'woocommerce_billing_fields' , 'desirees_override_billing_fields' );
add_filter( 'woocommerce_shipping_fields' , 'desirees_override_shipping_fields' );

/**
 * 
 * https://docs.woocommerce.com/document/tutorial-customising-checkout-fields-using-actions-and-filters/
 *
 */
function desirees_override_checkout_fields( $fields ) {
  // unset($fields['billing']['billing_state']);
  // unset($fields['billing']['billing_country']);
  unset($fields['billing']['billing_company']);
  // unset($fields['billing']['billing_address_1']);
  // unset($fields['billing']['billing_address_2']);
  // unset($fields['billing']['billing_postcode']);
  // unset($fields['billing']['billing_city']);
  // unset($fields['shipping']['shipping_state']);
  // unset($fields['shipping']['shipping_country']);
  unset($fields['shipping']['shipping_company']);
  // unset($fields['shipping']['shipping_address_1']);
  // unset($fields['shipping']['shipping_address_2']);
  // unset($fields['shipping']['shipping_postcode']);
  // unset($fields['shipping']['shipping_city']);
  return $fields;
}
function desirees_override_billing_fields( $fields ) {
  // unset($fields['billing_state']);
  // unset($fields['billing_country']);
  unset($fields['billing_company']);
  // unset($fields['billing_address_1']);
  // unset($fields['billing_address_2']);
  // unset($fields['billing_postcode']);
  // unset($fields['billing_city']);
  return $fields;
}
function desirees_override_shipping_fields( $fields ) {
//   unset($fields['shipping_state']);
//   unset($fields['shipping_country']);
  unset($fields['shipping_company']);
//   unset($fields['shipping_address_1']);
//   unset($fields['shipping_address_2']);
//   unset($fields['shipping_postcode']);
//   unset($fields['shipping_city']);
  return $fields;
}

/**
 * Manage WooCommerce styles and scripts.
 */
function grd_woocommerce_script_cleaner() {

	// Remove the generator tag
	remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );

	wp_dequeue_style( 'woocommerce_frontend_styles' );
	wp_dequeue_style( 'woocommerce-general');
	wp_dequeue_style( 'woocommerce-layout' );
	wp_dequeue_style( 'woocommerce-smallscreen' );
	wp_dequeue_style( 'woocommerce_fancybox_styles' );
	wp_dequeue_style( 'woocommerce_chosen_styles' );
	wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
	wp_dequeue_style( 'select2' );
	wp_dequeue_script( 'wc-add-payment-method' );
	wp_dequeue_script( 'wc-lost-password' );
	wp_dequeue_script( 'wc_price_slider' );
	wp_dequeue_script( 'wc-single-product' );
	wp_dequeue_script( 'wc-add-to-cart' );
	wp_dequeue_script( 'wc-cart-fragments' );
	wp_dequeue_script( 'wc-credit-card-form' );

	if ( !is_checkout() ) {
		wp_dequeue_script( 'wc-checkout' );
		wp_dequeue_script( 'wc-cart' );
	}

	wp_dequeue_script( 'wc-add-to-cart-variation' );
	wp_dequeue_script( 'wc-single-product' );
	wp_dequeue_script( 'wc-chosen' );
	wp_dequeue_script( 'woocommerce' );
	wp_dequeue_script( 'prettyPhoto' );
	wp_dequeue_script( 'prettyPhoto-init' );
	wp_dequeue_script( 'jquery-blockui' );
	wp_dequeue_script( 'jquery-placeholder' );
	wp_dequeue_script( 'jquery-payment' );
	wp_dequeue_script( 'fancybox' );
	wp_dequeue_script( 'jqueryui' );
}
add_action( 'wp_enqueue_scripts', 'grd_woocommerce_script_cleaner', 99 );
