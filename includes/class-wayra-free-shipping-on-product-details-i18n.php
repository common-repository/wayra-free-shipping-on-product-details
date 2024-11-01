<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://wayradigital.com
 * @since      1.0.0
 *
 * @package    Wayra_Free_Shipping_On_Product_Details
 * @subpackage Wayra_Free_Shipping_On_Product_Details/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wayra_Free_Shipping_On_Product_Details
 * @subpackage Wayra_Free_Shipping_On_Product_Details/includes
 * @author     Juan Manuel Acebal <juanm@wayramarketing.com.ar>
 */
class Wayra_Free_Shipping_On_Product_Details_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wayra-free-shipping-on-product-details',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
