<?php
/**
 * Codelist for customer completed order email (plain text)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/plain/customer-completed-order-codelist.php
 *
 * @version 1.0
 */

defined( 'ABSPATH' ) || exit;

$output = array();

echo "\n\n=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\n";
echo __('Your codes', WCCA_TEXT_DOMAIN);
echo "\n=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\n\n";

foreach ($dataset['apidata'] AS $adk => $adv) {
    $output[] = __('Product', WCCA_TEXT_DOMAIN).": ".$adv['product_name'].", ".$adv['sku']."\n".__('Code', WCCA_TEXT_DOMAIN).": ".$adv['code']."\n"; 
}

echo implode("----------------------------------------\n", $output)."\n\n";