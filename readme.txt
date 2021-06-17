=== Code API for Checkout in WooCommerce ===
Contributors: appleuser
Tags: woo, woocommerce, shop, onlineshop, checkout, order, payment, api, codes, digital code
Requires at least: 5.2
Tested up to: 5.7
Requires PHP: 5.6
Stable tag: 1.6.1
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=5762TWVRT6RQ4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin adds support in WooCommerce for returning digital codes from external service after successful payment provided by an API

== Description ==
If you will provide digital codes from an external server, this plugin helps you connect your WooCommerce Page with your API to get codes returned

= Features =
Returns codes from external API, shows them up on customer checkout page, email and/or admin panel 

== Frequently Asked Questions ==

== Screenshots ==

== Installation ==
1. Upload `woo-checkout-code-api` folder to the WordPress Plugins directory.
2. Activate the plugin through the `Plugins` menu in WordPress.
3. Customize plugin → `Woo Code Api`

== Changelog ==
= 1.6 =
* fixed a deprecated call according to "WooCommerce" 4.4+
= 1.5 =
* added option to show codes on checkout page before OR after order details table
= 1.4 =
* fixed meta box only showing up on product order details page 
= 1.3 =
* fixed an error, where apicall collapsed with post editing 
= 1.2.2 =
* CSS and JS improvements in admin panel
= 1.2.1 =
* German internationalization improvements
= 1.2 =
* changed ‚on checkout‘ option to ‚completed‘ to show code list in detailed order view only if order is set to ‚complete’
* added option ‚override completed‘ to show up code list ALWAYS on checkout/thank you page and in email
* added developer mode for admin panel 
* changed api request from all products to only virtual products
= 1.1 =
* moved menu „Woo Code API“ to submenu position in „WooCommerce“
= 1.0 =
* first release