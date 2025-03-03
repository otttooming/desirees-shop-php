<?php
/**
 * Checkout login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( is_user_logged_in() || 'no' == get_option( 'woocommerce_enable_checkout_login_reminder' ) ) return;

?>
<form method="post">
	<p>
		<?php _e('If you have shopped with us before, please enter your details in the boxes below. If you are a new customer please proceed to the Billing &amp; Shipping section.', 'desirees') ?>
	</p>

	<p class="form-row form-row-first">
		<label for="username"><?php _e('Username or email', 'desirees'); ?> <span class="required">*</span></label>
		<input type="text" class="input-text" name="username" id="username" />
	</p>
	<p class="form-row form-row-last">
		<label for="password"><?php _e('Password', 'desirees'); ?> <span class="required">*</span></label>
		<input class="input-text" type="password" name="password" id="password" />
	</p>

	<p class="form-row">
		<?php wp_nonce_field( 'woocommerce-login' ); ?>
		<input type="submit" class="button" name="login" value="<?php _e('Login', 'desirees'); ?>" />
		<input type="hidden" name="redirect" value="<?php echo get_permalink( wc_get_page_id( 'checkout' ) ) ?>" />
		<a class="lost_password" href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php _e('Lost Password?', 'desirees'); ?></a>
	</p>
</form>
