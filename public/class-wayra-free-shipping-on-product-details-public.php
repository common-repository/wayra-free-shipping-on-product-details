<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://wayradigital.com
 * @since      1.0.0
 *
 * @package    Wayra_Free_Shipping_On_Product_Details
 * @subpackage Wayra_Free_Shipping_On_Product_Details/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wayra_Free_Shipping_On_Product_Details
 * @subpackage Wayra_Free_Shipping_On_Product_Details/public
 * @author     Juan Manuel Acebal <juanm@wayramarketing.com.ar>
 */
class Wayra_Free_Shipping_On_Product_Details_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wayra-free-shipping-on-product-details-public.css', array(), $this->version, 'all' );

	}

	public function wayra_fsop_show_on_product() {
		global $product;
		
		if( ! empty( $product->get_price() ) ) {

			$options = get_option( $this->plugin_name );
			
			$product_price = number_format( $product->get_price(), 2, ',', '');
			$more_than_price = number_format( $options['more_than_price'], 2, ',', '');

			$text = $options['normal_text'];
			$subtitle = $options['normal_subtitle'];
			
			if( 0 != $more_than_price && $product_price >= $more_than_price ) {
				$text = $options['more_than_text'];
				$subtitle = $options['more_than_subtitle'];
			}

			$show_icon = $options['show_icon'];
			include_once( 'partials/' . $this->plugin_name . '-public-display.php' );
		}
	}

}
