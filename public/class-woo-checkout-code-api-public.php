<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @since       1.0.0
 * @package     Woo_Checkout_Code_Api
 * @subpackage  Woo_Checkout_Code_Api/public
 */

defined( 'ABSPATH' ) || exit;

class Woo_Checkout_Code_Api_Public {
    
    private  $plugin_name ;
    private  $version ;
    
    /* init class */
    public function __construct( $plugin_name, $version ) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }
    
    /* public area css */
    public function enqueue_styles() {}
    
    /* public area javascript */
    public function enqueue_scripts() {}
    
    /* show api codes or errors in frontend */
    public function wcca_get_api_codes( $order_id ) {
        // get data from api
        $apidata = new Woo_Checkout_Code_Api_Loader();
        $dataset = $apidata->apicall($order_id);
        // if api returned data
        if ($dataset['status']===true) {
            // show codelist from theme
            if (is_file(get_stylesheet_directory().'/woocommerce/order/order-codelist.php')) {
                include_once(get_stylesheet_directory().'/woocommerce/order/order-codelist.php');
            } 
            // show codelist from plugin
            else {
                include_once(__DIR__.'/../templates/order/order-codelist.php');
            }
        } 
        else {
            // show error page from theme
            $codelisterror = sanitize_text_field($dataset['message']);
            if (is_file(get_stylesheet_directory().'/woocommerce/order/order-codelist-error.php')) {
                include_once(get_stylesheet_directory().'/woocommerce/order/order-codelist-error.php');
            } 
            // show error page from plugin
            else {
                include_once(__DIR__.'/../templates/order/order-codelist-error.php');
            }
        }
    }
    
    /**/
    public function wcca_get_api_codes_completed_order( $order_id ) {
        // get data from api
        $order = wc_get_order( $order_id );
        if ($order->get_status()=='completed') {
            $this->wcca_get_api_codes( $order_id );
        }
    }
    
    
}