<?php
/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0
 * @package    Woo_Checkout_Code_Api
 * @subpackage Woo_Checkout_Code_Api/includes
 */

defined( 'ABSPATH' ) || exit;

class Woo_Checkout_Code_Api_i18n {

	/* The slug specified for this plugin */
	private $slug;

	/* load the plugin text domain for translation */
	public function load_woo_plugin_textdomain() {
        load_plugin_textdomain( $this->slug, false, WCCA_TEXT_DOMAIN.'/languages' );
	}

	/* set the slug equal to that of the specified slug */
	public function set_slug( $slug ) {
		$this->slug = $slug;
	}

}