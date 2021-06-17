<?php

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0
 * @package    Woo_Checkout_Code_Api
 * @subpackage Woo_Checkout_Code_Api/includes
 */

defined( 'ABSPATH' ) || exit;

class Woo_Checkout_Code_Api {
    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0
     * @access   protected
     * @var      Woo_Checkout_Code_Api_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected  $loader ;
    protected  $plugin_name ;
    protected  $version ;
    
    /* define the core functionality of the plugin.
     *
     * det the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     */
    public function __construct() {
        $this->plugin_name = 'woo-checkout-code-api';
        $this->version = '1.0';
        $this->load_dependencies();
        $this->define_public_hooks();
        $this->define_admin_hooks();
        $this->set_locale();
    }
    
    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Woo_Checkout_Code_Api_Loader. Orchestrates the hooks of the plugin.
     * - Woo_Checkout_Code_Api_i18n. Defines internationalization functionality.
     * - Woo_Checkout_Code_Api_Admin. Defines all hooks for the admin area.
     * - Woo_Checkout_Code_Api_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0
     * @access   private
     */
    private function load_dependencies() {
        /* The class responsible for orchestrating the actions and filters of the core plugin. */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-woo-checkout-code-api-loader.php';
        /* The class responsible for defining internationalization functionality of the plugin. */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-woo-checkout-code-api-i18n.php';
        /* The class responsible for defining all actions that occur in the public-facing side of the site. */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-woo-checkout-code-api-public.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-woo-checkout-code-api-admin.php';
        $this->loader = new Woo_Checkout_Code_Api_Loader();
    }
    
    /* define the locale for this plugin for internationalization. */
    private function set_locale() {
        $plugin_i18n = new Woo_Checkout_Code_Api_i18n();
        $plugin_i18n->set_slug( $this->get_plugin_name() );
        $this->loader->add_action( 'init', $plugin_i18n, 'load_woo_plugin_textdomain' );
    }
    
    /* Register all of the hooks related to the public-facing functionality of the plugin. */
    private function define_public_hooks() {
        $plugin_public = new Woo_Checkout_Code_Api_Public( $this->get_plugin_name(), $this->get_version() );
        // $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
        // $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
        $wcca_array = maybe_unserialize( get_option( 'wcca_checkout_setting' ) );
        $wcca_status = ( isset( $wcca_array['wcca_status'] ) ? $wcca_array['wcca_status'] : '' );
        $wcca_override_status = ( isset( $wcca_array['wcca_override_status'] ) ? $wcca_array['wcca_override_status'] : '' );
        $wcca_checkout_status = ( isset( $wcca_array['wcca_checkout_status'] ) ? $wcca_array['wcca_checkout_status'] : '' );
        $wcca_user_role_restrict_flag = 1;
        // if the status is active
        if (!empty($wcca_status)) {
            // adds the code list to thank-you-page
            if (!empty($wcca_override_status)) {
                if ($wcca_checkout_status=='before') {
                    // adds the code list to order details, if the order is set to completed 
                    $this->loader->add_action( 'woocommerce_order_details_before_order_table', $plugin_public, 'wcca_get_api_codes', 10 );
                }
                else {
                    $this->loader->add_action( 'woocommerce_order_details_after_order_table', $plugin_public, 'wcca_get_api_codes', 10 );
                }
            }
            else if (!empty($wcca_checkout_status)) {
                if ($wcca_checkout_status=='before') {
                    // adds the code list to order details, if the order is set to completed 
                    $this->loader->add_action( 'woocommerce_order_details_before_order_table', $plugin_public, 'wcca_get_api_codes_completed_order', 10 );
                }
                else {
                    $this->loader->add_action( 'woocommerce_order_details_after_order_table', $plugin_public, 'wcca_get_api_codes_completed_order', 10 );
                }
            }
        } 
    }
    
    /* Register all of the hooks related to the admin-facing functionality of the plugin. */
    private function define_admin_hooks() {
        $plugin_admin = new Woo_Checkout_Code_Api_Admin( $this->get_plugin_name(), $this->get_version() );
        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
        // get backend data from plugin
        $wcca_array = maybe_unserialize( get_option( 'wcca_checkout_setting' ) );
        // check for metabox-support
        $wcca_metabox_status = ( isset( $wcca_array['wcca_metabox_status'] ) ? $wcca_array['wcca_metabox_status'] : '' );
        if (!empty($wcca_metabox_status)) {
            $this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'wcca_enqueue_meta' );
        }
        // check for email-support
        $wcca_email_status = ( isset( $wcca_array['wcca_email_status'] ) ? $wcca_array['wcca_email_status'] : '' );
        if (!empty($wcca_email_status)) {
            $wcca_email_position = ( isset( $wcca_array['wcca_email_position'] ) ? $wcca_array['wcca_email_position'] : 'woocommerce_email_after_order_table' );
            // add action to woocommerce email on desired position 'woocommerce_email_after_order_table'
            // position may be choosen by user in later version
            // calls 'wcca_email_after_order_table' from 'admin/class-woo-checkout-code-api-admin.php'
            $this->loader->add_action( $wcca_email_position, $plugin_admin, 'wcca_email_after_order_table' );
        }
        $this->loader->add_action( 'admin_menu', $plugin_admin, 'wcca_create_page' );
    }
    
    /* Retrieve the plugin name. */
    public function get_plugin_name() { return $this->plugin_name; }
    
    /* Retrieve the version number of the plugin. */
    public function get_version() { return $this->version; }

    /* The reference to the class that orchestrates the hooks with the plugin. */
    public function get_loader() { return $this->loader; }

    /* Run the loader to execute all of the hooks with WordPress. */
    public function run() { $this->loader->run(); }
    
}