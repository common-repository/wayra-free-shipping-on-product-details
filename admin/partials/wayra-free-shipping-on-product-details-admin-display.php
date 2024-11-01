<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://wayradigital.com
 * @since      1.0.0
 *
 * @package    Wayra_Free_Shipping_On_Product_Details
 * @subpackage Wayra_Free_Shipping_On_Product_Details/admin/partials
 */
?>
<div class="wrap wayra-fsop-admin">
    <h2><?php _e( 'Wayra - Free shipping on product details', 'wayra-free-shipping-on-product-details' ); ?></h2>
    <span class="wayra-fsop-title" ><?php printf( __( 'This plugin is develop with %s by', 'wayra-free-shipping-on-product-details' ), '<i class="dashicons-before dashicons-heart"></i>' ); ?> <a href="https://wayradigital.com" target="_blank">Juan Manuel Acebal</a><br>
        <?php _e( 'Contact me if need a <strong>custom plugin or customization</strong>', 'wayra-free-shipping-on-product-details' ); ?><br>
    <?php _e( 'If you want to help me to continue develop useful plugins', 'wayra-free-shipping-on-product-details' ); ?> <a id="donate" href="https://www.wayramarketing.com.ar/donar" target="_blank"><?php _e( 'buy me a cup of coffee', 'wayra-free-shipping-on-product-details' ); ?></a><i id="coffee" class="dashicons-before dashicons-coffee"></i></span>
    
    <form method="post" name="<?php echo $this->plugin_name; ?>" action="options.php">
    <?php
        //Grab all options
        $options = get_option( $this->plugin_name );

        // Check if Woocommerce is active
		if ( ! function_exists( 'is_plugin_active' ) ) {
			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}
        $is_woocommerce_active = is_plugin_active('woocommerce/woocommerce.php');
        
        $normal_text = $options['normal_text'];
        $normal_subtitle = $options['normal_subtitle'];
        $shipping_text_position = ( ! empty( $options['shipping_text_position'] ) ) ? $options['shipping_text_position'] : 'after_product_price';
        
        $more_than_text = $options['more_than_text'];
        $more_than_subtitle = $options['more_than_subtitle'];
        $more_than_price = $options['more_than_price'];

        $show_icon = ( isset( $options['show_icon'] ) && ! empty( $options['show_icon'] ) ) ? true : false;
        
        settings_fields( $this->plugin_name );
        do_settings_sections( $this->plugin_name );

    ?>
    <table class="form-table" role="presentation">
        <tbody>
            
            <tr>
                <th scope="row"><label for="<?php echo $this->plugin_name; ?>-show_icon"><?php _e( 'Show Icon', 'wayra-free-shipping-on-product-details' ); ?> </label></th>
                <td><input type="checkbox" id="<?php echo $this->plugin_name; ?>-show_icon" name="<?php echo $this->plugin_name; ?>[show_icon]" value="1" <?php checked( $show_icon ); ?> />
                <span class="description" id="tagline-description"><?php _e( 'Show icon before text.', 'wayra-free-shipping-on-product-details' ); ?></span></td>
            </tr>
            
            <tr>
                <th scope="row"><label for="<?php echo $this->plugin_name; ?>-normal_text"><?php _e( 'Shipping Text', 'wayra-free-shipping-on-product-details' ); ?></th>
                <td><input type="text" required id="<?php echo $this->plugin_name; ?>-normal_text" name="<?php echo $this->plugin_name; ?>[normal_text]" value="<?php echo $normal_text; ?>" class="regular-text"/>
                <p class="description" id="tagline-description"><?php _e( 'First line of shipping text.', 'wayra-free-shipping-on-product-details' ); ?> <code><?php _e( 'e.g. Shipping all country', 'wayra-free-shipping-on-product-details' ); ?></code></p></td>
            </tr>

            <tr>
                <th scope="row"><label for="<?php echo $this->plugin_name; ?>-normal_subtitle"><?php _e( 'Shipping Subtitle', 'wayra-free-shipping-on-product-details' ); ?></th>
                <td><input type="text" id="<?php echo $this->plugin_name; ?>-normal_subtitle" name="<?php echo $this->plugin_name; ?>[normal_subtitle]" value="<?php echo $normal_subtitle; ?>" class="regular-text"/>
                <p class="description" id="tagline-description"><?php _e( 'Second line of shipping text.', 'wayra-free-shipping-on-product-details' ); ?> <code><?php _e( 'e.g. +$2500 Free Shipping', 'wayra-free-shipping-on-product-details' ); ?></code></p></td>
            </tr>

            <tr>
                <th scope="row"><label for="<?php echo $this->plugin_name; ?>-shipping_text_position"><?php _e( 'Text position', 'wayra-free-shipping-on-product-details' ); ?></th>
                <td><select id="<?php echo $this->plugin_name; ?>-shipping_text_position" name="<?php echo $this->plugin_name; ?>[shipping_text_position]" value="<?php echo $shipping_text_position; ?>" class="regular-text"/>
                    <option value="before_product_price" <?php selected($shipping_text_position, 'before_product_price'); ?>><?php _e( 'Before product price', 'wayra-free-shipping-on-product-details' ); ?></option>
                    <option value="after_product_price" <?php selected($shipping_text_position, 'after_product_price'); ?>><?php _e( 'After product price', 'wayra-free-shipping-on-product-details' ); ?></option>
                    <option value="before_add_to_cart_button" <?php selected($shipping_text_position, 'before_add_to_cart_button'); ?>><?php _e( 'Before add to cart button', 'wayra-free-shipping-on-product-details' ); ?></option>
                    <option value="after_add_to_cart_button" <?php selected($shipping_text_position, 'after_add_to_cart_button'); ?>><?php _e( 'After add to cart button', 'wayra-free-shipping-on-product-details' ); ?></option>
                </select>
                </td>
            </tr>

        </tbody>
    </table>
    <h3><?php _e( 'Change text based on product price', 'wayra-free-shipping-on-product-details' ); ?></h3>
    <p><?php _e( 'This setting change two lines of text when price is equal or greater than defined price.', 'wayra-free-shipping-on-product-details' ); ?><p>
    <p><?php _e( 'This an optional setting, you can use text, subtitle, both or none. Leave empty to avoid.', 'wayra-free-shipping-on-product-details' ); ?></p>
    <table class="form-table" role="presentation">
        <tbody>
            
            <tr>
                <th scope="row"><label for="<?php echo $this->plugin_name; ?>-more_than_price"><?php _e( 'Price', 'wayra-free-shipping-on-product-details' ); ?></th>
                <td><input type="number" id="<?php echo $this->plugin_name; ?>-more_than_price" name="<?php echo $this->plugin_name; ?>[more_than_price]" value="<?php echo $more_than_price; ?>" min="0" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" class="regular-text"/>
                <p class="description" id="tagline-description"><?php _e( 'If the product price is equal or greater than this price, users see this text.', 'wayra-free-shipping-on-product-details' ); ?> <code><?php _e( 'e.g. 2500.00', 'wayra-free-shipping-on-product-details' ); ?></code></p></td>
            </tr>
        
            <tr>
                <th scope="row"><label for="<?php echo $this->plugin_name; ?>-more_than_text"><?php _e( 'Shipping Text', 'wayra-free-shipping-on-product-details' ); ?></th>
                <td><input type="text" id="<?php echo $this->plugin_name; ?>-more_than_text" name="<?php echo $this->plugin_name; ?>[more_than_text]" value="<?php echo $more_than_text; ?>" class="regular-text"/>
                <p class="description" id="tagline-description"><?php _e( 'First line of shipping text.', 'wayra-free-shipping-on-product-details' ); ?> <code><?php _e( 'e.g. Free Shipping', 'wayra-free-shipping-on-product-details' ); ?></code></p></td>
            </tr>

            <tr>
                <th scope="row"><label for="<?php echo $this->plugin_name; ?>-more_than_subtitle"><?php _e( 'Shipping Subtitle', 'wayra-free-shipping-on-product-details' ); ?></th>
                <td><input type="text" id="<?php echo $this->plugin_name; ?>-more_than_subtitle" name="<?php echo $this->plugin_name; ?>[more_than_subtitle]" value="<?php echo $more_than_subtitle; ?>" class="regular-text"/>
                <p class="description" id="tagline-description"><?php _e( 'Second line of shipping text.', 'wayra-free-shipping-on-product-details' ); ?> <code><?php _e( 'e.g. Arrives in 2 days', 'wayra-free-shipping-on-product-details' ); ?></code></p></td>
            </tr>

        </tbody>
    </table>
    <h3><?php _e( 'Customize CSS style', 'wayra-free-shipping-on-product-details' ); ?></h3>
    <span style="font-size:14px;"><?php _e( 'If you need to customize icon or text style, you can use this class.', 'wayra-free-shipping-on-product-details' ); ?></span>
    <table class="form-table" role="presentation">
        <tbody>
            <tr>
                <th scope="row"><?php _e( 'Div container', 'wayra-free-shipping-on-product-details' ); ?></th>
                <td><code>.wayra-fsop-info</code></td>
            </tr>
            <tr>
                <th scope="row"><?php _e( 'Icon', 'wayra-free-shipping-on-product-details' ); ?></th>
                <td><code>.wayra-fsop-icon</code></td>
            </tr>

            <tr>
                <th scope="row"><?php _e( 'First line of text', 'wayra-free-shipping-on-product-details' ); ?></th>
                <td><code>.wayra-fsop-text</code></td>
            </tr>
            <tr>
                <th scope="row"><?php _e( 'Second line of text', 'wayra-free-shipping-on-product-details' ); ?></th>
                <td><code>.wayra-fsop-subtitle</code></td>
            </tr>

        </tbody>
    </table>
    
    <?php submit_button( __( 'Save all changes', 'wayra-free-shipping-on-product-details' ), 'primary','submit', TRUE ); ?>
    </form>
</div>

