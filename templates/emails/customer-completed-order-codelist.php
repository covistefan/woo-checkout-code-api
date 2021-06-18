<?php
/**
 * Codelist for customer completed order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-completed-order-codelist.php
 *
 * @version 1.0
 */

defined( 'ABSPATH' ) || exit;

?>
<h2 style='color: #96588a; display: block; font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif; font-size: 18px; font-weight: bold; line-height: 130%; margin: 0 0 18px; text-align: left;'><?php _e('Your codes', WCCA_TEXT_DOMAIN); ?></h2>
<div style="margin-bottom: 40px;">
    <table class="td" cellspacing="0" cellpadding="6" border="1" style="color: #636363; border: 1px solid #e5e5e5; vertical-align: middle; width: 100%; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;">
        <thead>
            <tr>
                <th class="td" scope="col" style="color: #636363; border: 1px solid #e5e5e5; vertical-align: middle; padding: 12px; text-align: left;"><?php _e('Product', WCCA_TEXT_DOMAIN); ?></th>
                <th class="td" scope="col" style="color: #636363; border: 1px solid #e5e5e5; vertical-align: middle; padding: 12px; text-align: left;"><?php _e('Code', WCCA_TEXT_DOMAIN); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dataset['apidata'] AS $adk => $adv) { ?>
            <tr class="order_item">
                <td class="td" style="color: #636363; border: 1px solid #e5e5e5; padding: 12px; text-align: left; vertical-align: middle; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; word-wrap: break-word;">
                    <?php echo esc_attr($adv['product_name']); ?>, <?php echo esc_attr($adv['sku']); ?> </td>
                <td class="td" style="color: #636363; border: 1px solid #e5e5e5; padding: 12px; text-align: left; vertical-align: middle; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;"><?php echo esc_attr($adv['code']); ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
