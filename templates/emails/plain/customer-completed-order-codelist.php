<?php
/**
 * Codelist for customer completed order email (plain text)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/plain/customer-completed-order-codelist.php
 *
 * @version 1.0
 */

defined( 'ABSPATH' ) || exit;

echo "\n\n=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\n";
echo esc_attr__('Your codes', WCCA_TEXT_DOMAIN);
echo "\n=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\n\n";

$output = array();
foreach ($dataset['apidata'] AS $adk => $adv) {
    $output[] = esc_attr__('Product', WCCA_TEXT_DOMAIN).": ".
        esc_attr($adv['product_name']).", ".
        esc_attr($adv['sku'])."\n".
        esc_attr__('Code', WCCA_TEXT_DOMAIN).": ".
        esc_attr($adv['code'])."\n"; 
}

echo esc_attr(implode("----------------------------------------\n", $output)."\n\n");