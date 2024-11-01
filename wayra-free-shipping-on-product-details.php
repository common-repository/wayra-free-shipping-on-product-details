<?php

/**
 *
 * @link              https://wayradigital.com
 * @since             1.0.0
 * @package           Wayra_Free_Shipping_On_Product_Details
 *
 * @wordpress-plugin
 * Plugin Name:       Wayra - Free shipping on product details
 * Description:       Show icon and shipping text on products based on product price.
 * Version:           1.0.1
 * Author:            Juan Manuel Acebal
 * Author URI:        https://wayradigital.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wayra-free-shipping-on-product-details
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WAYRA_FREE_SHIPPING_ON_PRODUCT_DETAILS_VERSION', '1.0.1' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wayra-free-shipping-on-product-details-activator.php
 */
function activate_wayra_free_shipping_on_product_details() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wayra-free-shipping-on-product-details-activator.php';
	Wayra_Free_Shipping_On_Product_Details_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wayra-free-shipping-on-product-details-deactivator.php
 */
function deactivate_wayra_free_shipping_on_product_details() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wayra-free-shipping-on-product-details-deactivator.php';
	Wayra_Free_Shipping_On_Product_Details_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wayra_free_shipping_on_product_details' );
register_deactivation_hook( __FILE__, 'deactivate_wayra_free_shipping_on_product_details' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wayra-free-shipping-on-product-details.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wayra_free_shipping_on_product_details() {

	$plugin = new Wayra_Free_Shipping_On_Product_Details();
	$plugin->run();

}
run_wayra_free_shipping_on_product_details();
