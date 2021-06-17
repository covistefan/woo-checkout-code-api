<?php
/**
 * Codelist page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-codelist.php
 *
 * @version 1.0
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="woocommerce-order-codelist">
    <h2><?php _e('Your codes', WCCA_TEXT_DOMAIN); ?></h2>
    <table class="woocommerce-table woocommerce-table--order-details shop_table order_details">
        <thead>
            <tr>
                <th class="woocommerce-table__product-name product-name"><?php _e('Product', WCCA_TEXT_DOMAIN); ?></th>
				<th class="woocommerce-table__product-table product-total"><?php _e('Code', WCCA_TEXT_DOMAIN); ?></th>
			</tr>
		</thead>
		<tbody>
            <?php
            
            foreach ( $dataset['apidata'] as $item ) {
                echo '<tr class="woocommerce-table__line-item order_item">';
                echo '<td class="woocommerce-table__product-name product-name">'.$item['product_name'].', '.$item['sku'].'</td>';
                echo '<td class="woocommerce-table__product-total product-total">';
                echo '<code class="woocommerce-code-view">'.$item['code'].'</code>';
                echo '</td>';
                echo '</tr>';
            }
            
            ?>
		</tbody>
	</table>
</section>