<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://wayradigital.com
 * @since      1.0.0
 *
 * @package    Wayra_Free_Shipping_On_Product_Details
 * @subpackage Wayra_Free_Shipping_On_Product_Details/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * @package    Wayra_Free_Shipping_On_Product_Details
 * @subpackage Wayra_Free_Shipping_On_Product_Details/admin
 * @author     Juan Manuel Acebal <juanm@wayramarketing.com.ar>
 */
class Wayra_Free_Shipping_On_Product_Details_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wayra-free-shipping-on-product-details-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the administration menu for this plugin into the WordPress Settings menu.
	 *
	 * @since    1.0.0
	 */
	public function add_plugin_admin_menu() {

		add_options_page('Wayra - Free Shipping On Product Details', __( 'Free shipping on product details', 'wayra-free-shipping-on-product-details' ), 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page' ) );
	}

	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */
	public function add_action_links( $links ) {

		/*
		*  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
		*/
		$settings_link = array( '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __( 'Settings', 'wayra-free-shipping-on-product-details' ) . '</a>', );
		return array_merge(  $settings_link, $links );

	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_setup_page() {

		include_once( 'partials/' . $this->plugin_name . '-admin-display.php' );

	}

	/**
	 * Validate the field based on type, and assign default value if it's necessary.
	 *
	 * @since    1.0.0
	 * @param      string    $field       		The field to validate.
	 * @param      string    $field_type    	The field type checkbox, input, select or textarea.
	 * @param      string    $default_value    	The default value to assign if it's empty.
	 * @return	   mixed	 field value or default value.
	 */
	private function validate_field( $field, $field_type, $default_value = '' ) {
		switch ( $field_type ) {

			case 'checkbox':
				return ( isset( $field ) && ! empty( $field ) ) ? true : false;
				break;
			case 'input':
				return ( isset( $field ) && ! empty( $field ) ) ? esc_attr( $field ) : $default_value;
				break;
			case 'select':
				return ( isset( $field ) && ! empty( $field ) ) ? esc_attr( $field ) : 1;
				break;
			case 'textarea':
				return ( isset( $field ) && ! empty( $field ) ) ? sanitize_textarea_field( $field ) : $default_value;

		}
	}


	/**
	 * Validate fields from admin area plugin settings
	 * 
	 * @since    1.0.0
	 * @param  	mixed 	$input as field form settings form
	 * @return 	mixed 	as validated fields
	 */
	public function validate( $input ) {

		$options = get_option( $this->plugin_name );
		
		$options['normal_text'] = $this->validate_field( $input['normal_text'], 'input' );
		$options['normal_subtitle'] = $this->validate_field( $input['normal_subtitle'], 'input' );

		$options['shipping_text_position'] = $this->validate_field( $input['shipping_text_position'], 'select' );

		$options['more_than_text'] = $this->validate_field( $input['more_than_text'], 'input' );
		$options['more_than_subtitle'] = $this->validate_field( $input['more_than_subtitle'], 'input' );
		$options['more_than_price'] = $this->validate_field( $input['more_than_price'], 'input', 0 );

		$options['show_icon'] = $this->validate_field( $input['show_icon'], 'checkbox', true );
		
		return $options;

	}

	public function options_update() {

		register_setting( $this->plugin_name, $this->plugin_name, array( 'sanitize_callback' => array( $this, 'validate' ), ) );

	}

}
