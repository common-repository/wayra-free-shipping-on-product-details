<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * For more information, see the following discussion:
 * https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate/pull/123#issuecomment-28541913
 *
 * @link       https://wayradigital.com
 * @since      1.0.0
 *
 * @package    Wayra_Free_Shipping_On_Product_Details
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Delete DB info
delete_option('wayra-free-shipping-on-product-details');
 
// for site options in Multisite
delete_site_option('wayra-free-shipping-on-product-details');