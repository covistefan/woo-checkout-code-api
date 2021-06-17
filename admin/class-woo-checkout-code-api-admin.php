<?php
/**
 * The admin-facing functionality of the plugin.
 *
 * @version     1.1
 * @package     Woo_Checkout_Code_Api
 * @subpackage  Woo_Checkout_Code_Api/admin
 */

defined( 'ABSPATH' ) || exit;

class Woo_Checkout_Code_Api_Admin {

    private  $plugin_name ;
    private  $version ;
    
    /* init class */
    public function __construct( $plugin_name, $version ) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }
    
    /* admin area css */
    public function enqueue_styles( $hook ) {
        wp_enqueue_style(
            $this->plugin_name,
            plugin_dir_url( __FILE__ ) . 'css/woo-checkout-code-api-admin.css',
            array(),
            $this->version,
            'all'
        );
    }
    
    /* admin area javascript */
    public function enqueue_scripts( $hook ) {
        wp_enqueue_script(
            $this->plugin_name . 'wcca-admin-default-js',
            plugin_dir_url( __FILE__ ) . 'js/woo-checkout-code-api-admin.js',
            array( 'jquery', 'jquery-ui-dialog' ),
            $this->version,
            false,
            999
        );
    }
    
    public function wcca_enqueue_meta( $hook ) {
        if (get_post_type()=='shop_order') {
            add_meta_box(
                'wcca_meta', // Unique ID
                'Code API', // Box title
                [self::class, 'wcca_custom_box_html'],  // Content callback, must be of type callable
                NULL,
                'advanced',
                'default',
                array(
                    'plugin_name' => $this->plugin_name
                )
            );
        }
    }
    
    public static function wcca_custom_box_html( $order_id , $args ) {
        $apidata = new Woo_Checkout_Code_Api_Loader();
        $dataset = $apidata->apicall($order_id);
        // get information about development status
        $devmode_arr = maybe_unserialize( get_option( 'wcca_checkout_setting' ) );
        $devmode = ( isset( $devmode_arr['wcca_dev'] ) ? $devmode_arr['wcca_dev'] : '' );
        if ($devmode=='on') {
            require_once(plugin_dir_path( __FILE__ ).'partials/meta-dev.php');
        }
        if ($dataset['status']===true) {
            // include file to display meta
            require_once(plugin_dir_path( __FILE__ ).'partials/meta.php');
        } else {
            require_once(plugin_dir_path( __FILE__ ).'partials/metaerror.php');
        }
    }
    
    public function wcca_email_after_order_table( $order_id ) {
        // init api
        $apidata = new Woo_Checkout_Code_Api_Loader();
        // get data from api
        $dataset = $apidata->apicall($order_id);
        // get information about "completed" order
        $order = wc_get_order( $order_id );
        $comp = $order->get_status();
        // get information about "completed override" 
        $wcca_arr = maybe_unserialize( get_option( 'wcca_checkout_setting' ) );
        $wcca_override_status = ( isset( $wcca_arr['wcca_override_status'] ) ? $wcca_arr['wcca_override_status'] : '' );
        // just add codes to mail if the api is set and data returned
        if ($dataset['status']!==false && ($comp=='completed' || !empty($wcca_override_status))) {
            // get type of sent mail
            $mailoption = maybe_unserialize( get_option( 'woocommerce_customer_completed_order_settings' ) );
            $mailtype = $mailoption['email_type'];
            if ($mailtype=='plain') {
                if (is_file(get_stylesheet_directory().'/woocommerce/emails/plain/customer-completed-order-codelist.php')) {
                    // include the templates mail content template
                    include(get_stylesheet_directory().'/woocommerce/emails/plain/customer-completed-order-codelist.php');
                } else {
                    include(plugin_dir_path( __FILE__ ).'../templates/emails/plain/customer-completed-order-codelist.php');
                }
            }
            else {
                if (is_file(get_stylesheet_directory().'/woocommerce/emails/customer-completed-order-codelist.php')) {
                    // include the templates mail content template
                    include(get_stylesheet_directory().'/woocommerce/emails/customer-completed-order-codelist.php');
                } else {
                    include(plugin_dir_path( __FILE__ ).'../templates/emails/customer-completed-order-codelist.php');
                }
            }
        }
    }

    /* create admin menu */
    public function wcca_create_page() {
        add_submenu_page( 'woocommerce', 'Woo Code API', __( 'Woo Code API' ), 'manage_options', 'wcca_settings', array( $this, 'wcca_settings_page' ), 999 );
    }
    
    /* create admin page */
    public function wcca_settings_page() {
        require_once plugin_dir_path( __FILE__ ) . 'header/plugin-header.php';
        require_once plugin_dir_path( __FILE__ ) . 'partials/general-settings.php';
        require_once plugin_dir_path( __FILE__ ) . 'partials/new-code.php';
        require_once plugin_dir_path( __FILE__ ) . 'partials/embed-pref.php';
        require_once plugin_dir_path( __FILE__ ) . 'partials/helpdesc.php';
        require_once plugin_dir_path( __FILE__ ) . 'header/plugin-footer.php';
    }
    
}