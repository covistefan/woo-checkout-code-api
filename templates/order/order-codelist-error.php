<?php
/**
 * Codelist Error Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-codelist-error.php
 *
 * @version 1.0
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="woocommerce-order-codelist">
    <h2><?php _e('Error requesting codelist API', WCCA_TEXT_DOMAIN); ?></h2>
    <p><?php echo $codelisterror; ?></p>
</section>