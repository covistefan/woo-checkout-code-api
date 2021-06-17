<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;
?>
<div id="wcca-embed-pref" class="tabcontent">
    <h2><?php esc_html_e( 'Embedding preferences', WCCA_TEXT_DOMAIN ); ?></h2>
    <p><?php esc_html_e( 'You can define here, which pages/elements will show up the codelist.', WCCA_TEXT_DOMAIN ); ?></p>
    <table class="form-table wcca-table-outer product-fee-table">
        <tbody>
            <tr>
                <th class="titledesc">
                    <label><?php esc_html_e( 'Successful Checkout', WCCA_TEXT_DOMAIN ); ?></label>
                </th>
                <td class="select">
                    <label>
                        <select name="wcca_checkout_status">
                            <option value=""><?php _e( 'Dont show', WCCA_TEXT_DOMAIN ); ?></option>
                            <option value="before" <?php echo ($wcca_checkout_status=='before')?'selected="selected"':''; ?>><?php _e( 'Show before order details', WCCA_TEXT_DOMAIN ); ?></option>
                            <option value="after" <?php echo ($wcca_checkout_status=='after')?'selected="selected"':''; ?>><?php _e( 'Show after order details', WCCA_TEXT_DOMAIN ); ?></option>
                        </select>
                    </label>
                </td>
                <td>
                    <p><?php esc_html_e( 'Determine whether the code list should be displayed after successful checkout. The list is only displayed if the status of the order is `complete`.', WCCA_TEXT_DOMAIN ); ?></p>
                </td>
            </tr>
            <tr>
                <th class="titledesc">
                    <label><?php esc_html_e( 'Email support', WCCA_TEXT_DOMAIN ); ?></label>
                </th>
                <td class="checkbox">
                    <label>
                        <input type="checkbox" name="wcca_email_status" value="on" <?php echo  esc_attr( $wcca_email_status ) ; ?>>
                    </label>
                </td>
                <td>
                    <p><?php esc_html_e( 'Setup whether the code list should be sent by email within the order confirmation.', WCCA_TEXT_DOMAIN ); ?></p>
                </td>
            </tr>
            <tr>
                <th class="titledesc">
                    <label><?php esc_html_e( 'Override completed', WCCA_TEXT_DOMAIN ); ?></label>
                </th>
                <td class="checkbox">
                    <label>
                        <input type="checkbox" name="wcca_override_status" value="on" <?php echo  esc_attr( $wcca_override_status ) ; ?>>
                    </label>
                </td>
                <td>
                    <p><?php esc_html_e( 'Determine whether the code list should be displayed on the thank you page, regardless of the further status of the order. Make sure you only offer payment options that have been successfully completed at this time.', WCCA_TEXT_DOMAIN ); ?></p>
                </td>
            </tr>
            <tr>
                <th class="titledesc">
                    <label><?php esc_html_e( 'Metabox', WCCA_TEXT_DOMAIN ); ?></label>
                </th>
                <td class="checkbox">
                    <label>
                        <input type="checkbox" name="wcca_metabox_status" value="on" <?php echo  esc_attr( $wcca_metabox_status ) ; ?>>
                    </label>
                </td>
                <td>
                    <p><?php esc_html_e( 'Setup whether the code list should be shown in order details page for admin.', WCCA_TEXT_DOMAIN ); ?></p>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<?php 
