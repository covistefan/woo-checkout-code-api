<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;
?>
<table cellpadding="0" cellspacing="0" class="wcca_codelist">
    <thead>
        <tr>
            <th>Produkt</th>
            <th>Code</th>
        </tr>
    </thead>
    <tbody id="order_line_items">
        <?php foreach ($dataset['apidata'] AS $adk => $adv) { ?>
        <tr>
            <td class="item_name" data-sort-value="<?php echo esc_url($adv['product_name']); ?>">
                <a href="post.php?post=<?php echo intval($adv['product_id']); ?>&action=edit"><?php echo esc_attr($adv['product_name']); ?></a>
                <div class="wc-order-item-sku"><strong>Artikelnummer:</strong> <?php echo esc_attr($adv['sku']); ?></div>
            </td>
            <td class="item_code" width="50%" data-sort-value="<?php echo esc_url($adv['code']); ?>">
                <div class="view">
                    <span class="wcca-code"><?php echo esc_attr($adv['code']); ?></span>
                </div>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>