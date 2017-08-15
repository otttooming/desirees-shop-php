<?php
/*
Plugin Name: Your Shipping plugin
Plugin URI: http://woothemes.com/woocommerce
Description: Your shipping method plugin
Version: 1.0.0
Author: WooThemes
Author URI: http://woothemes.com
*/

/**
 * Check if WooCommerce is active
 */
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

	function desirees_omniva_shipping_method_init() {
		if ( ! class_exists( 'Desirees_Omniva_Shipping_Method' ) ) {
			class Desirees_Omniva_Shipping_Method extends WC_Shipping_Method {
				/**
				 * Constructor for your shipping class
				 *
				 * @access public
				 * @return void
				 */
				public function __construct() {
					$this->id                 = 'desirees_omniva_shipping_method'; // Id for your shipping method. Should be uunique.
					$this->method_title       = __( 'Desirees Omniva shipping method' );  // Title shown in admin
					$this->method_description = __( 'Desirees Omniva shipping method' ); // Description shown in admin

					$this->enabled            = "yes"; // This can be added as an setting but for this example its forced enabled
					$this->title              = "Desirees Omniva shipping method"; // This can be added as an setting but for this example its forced.

					$this->init();
				}

				/**
				 * Init your settings
				 *
				 * @access public
				 * @return void
				 */
				function init() {
					// Load the settings API
					$this->init_form_fields(); // This is part of the settings API. Override the method to add your own settings
					$this->init_settings(); // This is part of the settings API. Loads settings you previously init.

					// Save settings in admin if you have any defined
					add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
				}

				/**
				 * calculate_shipping function.
				 *
				 * @access public
				 * @param mixed $package
				 * @return void
				 */
				public function calculate_shipping( $package = array()) {
					$rate = array(
						'id' => $this->id,
						'label' => $this->title,
						'cost' => '0.0',
						'calc_tax' => 'per_item'
					);

					// Register the rate
					$this->add_rate( $rate );
				}
			}
		}
	}

	add_action( 'woocommerce_shipping_init', 'desirees_omniva_shipping_method_init' );

	function add_desirees_omniva_shipping_method( $methods ) {
		$methods['desirees_omniva_shipping_method'] = 'Desirees_Omniva_Shipping_Method';
		return $methods;
	}

	add_filter( 'woocommerce_shipping_methods', 'add_desirees_omniva_shipping_method' );

	function desirees_smartpost_shipping_method_init() {
		if ( ! class_exists( 'Desirees_Smartpost_Shipping_Method' ) ) {
			class Desirees_Smartpost_Shipping_Method extends WC_Shipping_Method {
				/**
				 * Constructor for your shipping class
				 *
				 * @access public
				 * @return void
				 */
				public function __construct() {
					$this->id                 = 'desirees_smartpost_shipping_method'; // Id for your shipping method. Should be uunique.
					$this->method_title       = __( 'Desirees Smartpost shipping method' );  // Title shown in admin
					$this->method_description = __( 'Desirees Smartpost shipping method' ); // Description shown in admin

					$this->enabled            = "yes"; // This can be added as an setting but for this example its forced enabled
					$this->title              = "Desirees Smartpost shipping method"; // This can be added as an setting but for this example its forced.

					$this->init();
				}

				/**
				 * Init your settings
				 *
				 * @access public
				 * @return void
				 */
				function init() {
					// Load the settings API
					$this->init_form_fields(); // This is part of the settings API. Override the method to add your own settings
					$this->init_settings(); // This is part of the settings API. Loads settings you previously init.

					// Save settings in admin if you have any defined
					add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
				}

				/**
				 * calculate_shipping function.
				 *
				 * @access public
				 * @param mixed $package
				 * @return void
				 */
				public function calculate_shipping( $package = array()) {
					$rate = array(
						'id' => $this->id,
						'label' => $this->title,
						'cost' => '0.0',
						'calc_tax' => 'per_item'
					);

					// Register the rate
					$this->add_rate( $rate );
				}
			}
		}
	}

	add_action( 'woocommerce_shipping_init', 'desirees_smartpost_shipping_method_init' );

	function add_desirees_smartpost_shipping_method( $methods ) {
		$methods['desirees_smartpost_shipping_method'] = 'Desirees_Smartpost_Shipping_Method';
		return $methods;
	}

	add_filter( 'woocommerce_shipping_methods', 'add_desirees_smartpost_shipping_method' );

}
