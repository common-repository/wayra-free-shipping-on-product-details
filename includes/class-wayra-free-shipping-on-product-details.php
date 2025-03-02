<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://wayradigital.com
 * @since      1.0.0
 *
 * @package    Wayra_Free_Shipping_On_Product_Details
 * @subpackage Wayra_Free_Shipping_On_Product_Details/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Wayra_Free_Shipping_On_Product_Details
 * @subpackage Wayra_Free_Shipping_On_Product_Details/includes
 * @author     Juan Manuel Acebal <juanm@wayramarketing.com.ar>
 */
class Wayra_Free_Shipping_On_Product_Details {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Wayra_Free_Shipping_On_Product_Details_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'WAYRA_FREE_SHIPPING_ON_PRODUCT_DETAILS_VERSION' ) ) {
			$this->version = WAYRA_FREE_SHIPPING_ON_PRODUCT_DETAILS_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'wayra-free-shipping-on-product-details';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Wayra_Free_Shipping_On_Product_Details_Loader. Orchestrates the hooks of the plugin.
	 * - Wayra_Free_Shipping_On_Product_Details_i18n. Defines internationalization functionality.
	 * - Wayra_Free_Shipping_On_Product_Details_Admin. Defines all hooks for the admin area.
	 * - Wayra_Free_Shipping_On_Product_Details_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wayra-free-shipping-on-product-details-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wayra-free-shipping-on-product-details-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wayra-free-shipping-on-product-details-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-wayra-free-shipping-on-product-details-public.php';

		$this->loader = new Wayra_Free_Shipping_On_Product_Details_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Wayra_Free_Shipping_On_Product_Details_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Wayra_Free_Shipping_On_Product_Details_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Wayra_Free_Shipping_On_Product_Details_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		
		// Save/Update our plugin options
		$this->loader->add_action('admin_init', $plugin_admin, 'options_update');

		// Add menu item
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_plugin_admin_menu' );
	
		// Add Settings link to the plugin
		$plugin_basename = plugin_basename( plugin_dir_path( __DIR__ ) . $this->plugin_name . '.php' );
	
		$this->loader->add_filter( 'plugin_action_links_' . $plugin_basename, $plugin_admin, 'add_action_links' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$options = get_option( $this->get_plugin_name() );

		// Check if Woocommerce is active
		if ( ! function_exists( 'is_plugin_active' ) ) {
			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}
		$is_woocommerce_active = is_plugin_active('woocommerce/woocommerce.php');
			
		if ( $is_woocommerce_active ) {
			
			$plugin_public = new Wayra_Free_Shipping_On_Product_Details_Public( $this->get_plugin_name(), $this->get_version() );

			$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );

			$position = $options['shipping_text_position'];

			if ( 'before_add_to_cart_button' == $position ) {
			
				$this->loader->add_action( 'woocommerce_before_add_to_cart_form', $plugin_public, 'wayra_fsop_show_on_product' );
			
			} elseif ( 'after_add_to_cart_button' == $position ) {
			
				$this->loader->add_action( 'woocommerce_after_add_to_cart_form', $plugin_public, 'wayra_fsop_show_on_product' );
			
			} else {
			
				$priority = ( 'before_product_price' == $position ) ? 9 : 13;

				$this->loader->add_action( 'woocommerce_single_product_summary', $plugin_public, 'wayra_fsop_show_on_product', $priority );
			
			}
		}

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Wayra_Free_Shipping_On_Product_Details_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
