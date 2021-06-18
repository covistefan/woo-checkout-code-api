<?php

/**
 * Plugin Name:       Woo Checkout Code API
 * Plugin URI:        https://wordpress.org/plugins/woo-checkout-code-api/
 * Description:       This plugin adds support in WooCommerce for returning digital codes from external service after successful payment provided by an API
 * Version:           1.7
 * Author:            appleuser
 * Author URI:        https://profiles.wordpress.org/appleuser
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woo-checkout-code-api
 * Domain Path:       /languages
 *
 * WC requires at least: 4.4
 * WC tested up to: 5.4
 */

defined( 'ABSPATH' ) || exit;

add_action( 'plugins_loaded', 'wcca_initialize_plugin' );
$wc_active = in_array( 'woocommerce/woocommerce.php', get_option( 'active_plugins' ), true );

if ( true === $wc_active ) {
        
    if ( !defined( 'WCCA_PLUGIN_URL' ) ) {
        define( 'WCCA_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
    }
    if ( !defined( 'WCCA_PLUGIN_VERSION' ) ) {
        define( 'WCCA_PLUGIN_VERSION', '1.5' );
    }
    if ( !function_exists( 'wp_get_current_user' ) ) {
        include ABSPATH . "wp-includes/pluggable.php";
    }
    if ( !defined( 'WCCA_PLUGIN_NAME' ) ) {
        define( 'WCCA_PLUGIN_NAME', 'Woo Checkout Code API' );
    }
    if ( !defined( 'WCCA_TEXT_DOMAIN' ) ) {
        define( 'WCCA_TEXT_DOMAIN', 'woo-checkout-code-api' );
    }
    
    /* core plugin class */
    require plugin_dir_path( __FILE__ ) . 'includes/class-woo-checkout-code-api.php';
    
    /* execute plugin */
    function run_woo_checkout_code_api() {
        $plugin = new Woo_Checkout_Code_Api();
        $plugin->run();
    }

}

/* check initialize plugin in case WooCommerce is missing */
function wcca_initialize_plugin() {
    $wc_active = in_array( 'woocommerce/woocommerce.php', get_option( 'active_plugins' ), true );
    if ( current_user_can( 'activate_plugins' ) && $wc_active !== true || $wc_active !== true ) {
        add_action( 'admin_notices', 'wcca_plugin_admin_notice' );
    } else {
        run_woo_checkout_code_api();
    }
}

/* show admin notice in case WooCommerce is missing */
function wcca_plugin_admin_notice() {
    $wcca_plugin = esc_html__( 'Code API for WooCommerce Checkout', 'woo-checkout-code-api' );
    $wc_plugin = esc_html__( 'WooCommerce', 'woo-checkout-code-api' );
    ?>
    <div class="error">
        <p>
            <?php 
    echo  sprintf( esc_html__( '%1$s is ineffective as it requires %2$s to be installed and active.', 'woo-checkout-code-api' ), '<strong>' . esc_html( $wcca_plugin ) . '</strong>', '<strong>' . esc_html( $wc_plugin ) . '</strong>' ) ;
    ?>
        </p>
    </div>
    <?php 
}
