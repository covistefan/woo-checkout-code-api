<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;
?>
<div id="wcca-new-code" class="tabcontent">
    <h2><?php esc_html_e( 'Getting Codes', WCCA_TEXT_DOMAIN ); ?></h2>
    <p><?php esc_html_e( 'Tell API, where from and how to request a new code.', WCCA_TEXT_DOMAIN ); ?></p>
    <h4><?php esc_html_e( 'Is an authentication to API required?', WCCA_TEXT_DOMAIN ); ?></h4>
    <table class="form-table wcca-table-outer product-fee-table">
        <tbody>
            <tr valign="top">
                <th class="titledesc" scope="row">
                    <label><?php esc_html_e( 'Authentication Type', WCCA_TEXT_DOMAIN ); ?></label>
                </th>
                <td>
                    <select name = "wcca_auth_field" class="multiselect2" onchange="showhideAuthRow(this.value);"><?php 

                    $wcca_auth = array(
                        "0" => __('none', WCCA_TEXT_DOMAIN),
                        "1" => __('Basic Authentication', WCCA_TEXT_DOMAIN),
                        "2" => __('API-Key Authentication', WCCA_TEXT_DOMAIN),
                    );

                    foreach ( $wcca_auth as $wcca_field_key => $wcca_field ) {
                        $selectedVal = ( !empty($wcca_auth_field) && $wcca_field_key==$wcca_auth_field ) ? 'selected=selected' : '' ;
                        $selectedAuth = ( !empty($wcca_auth_field) ) ? intval($wcca_auth_field) : 0 ;
                        echo  '<option value="' . esc_attr( $wcca_field_key ) . '" ' . esc_attr( $selectedVal ) . '>' . esc_html__( $wcca_field, WCCA_TEXT_DOMAIN ) . '</option>' ;
                    }
                    
                    ?></select>
                </td>
                <td class="forminp mdtooltip">
                    <p class="wcca_tooltip_desc description"><?php esc_html_e( 'Basic authentication works as known `user:pass` combination, API-Key-Authentication works with HTTP-header `api-client` and HTTP-header `api-key`', WCCA_TEXT_DOMAIN ); ?></p>
                </td>
            </tr>
            <tr class="auth_data" <?php echo wp_kses_post(($selectedAuth==0) ? ' style="display: none;" ' : ''); ?>>
                <th class="titledesc" scope="row">
                    <label class="basic_user" <?php echo wp_kses_post(($selectedAuth!=1) ? ' style="display: none;" ' : ''); ?>><?php esc_html_e( 'Auth user', WCCA_TEXT_DOMAIN ); ?></label>
                    <label class="api_client" <?php echo wp_kses_post(($selectedAuth!=2) ? ' style="display: none;" ' : ''); ?>><?php esc_html_e( 'API-Client', WCCA_TEXT_DOMAIN ); ?></label>
                </th>
                <td class="forminp mdtooltip">
                    <label>
                        <input type="text" name="wcca_auth_user" style="min-width: 20em;" value="<?php echo esc_attr( $wcca_auth_user ); ?>" />
                    </label>
                </td>
                <td class="forminp mdtooltip"></td>  
            </tr>
            <tr class="auth_data" <?php echo wp_kses_post(($selectedAuth==0) ? ' style="display: none;" ' : ''); ?>>
                <th class="titledesc" scope="row">
                    <label class="basic_user" <?php echo wp_kses_post(($selectedAuth!=1) ? ' style="display: none;" ' : ''); ?>><?php esc_html_e( 'Auth pass', WCCA_TEXT_DOMAIN ); ?></label>
                    <label class="api_client" <?php echo wp_kses_post(($selectedAuth!=2) ? ' style="display: none;" ' : ''); ?>><?php esc_html_e( 'API-Key', WCCA_TEXT_DOMAIN ); ?></label>
                </th>
                <td class="forminp mdtooltip">
                    <label>
                        <input type="text" name="wcca_auth_pass" style="min-width: 20em;" value="<?php echo esc_attr( $wcca_auth_pass ); ?>" />
                    </label>
                </td>
                <td class="forminp mdtooltip"></td>    
            </tr>
        </tbody>
    </table>
    
    <table class="form-table wcca-table-outer product-fee-table">
        <tbody>
            <tr>
                <th class="titledesc" scope="row">
                    <label><?php esc_html_e( 'API-Action', WCCA_TEXT_DOMAIN ); ?></label>
                </th>
                <td class="forminp mdtooltip">
                    <label>
                        <input type="text" name="wcca_api_action" style="min-width: 20em;" value="<?php echo esc_attr( $wcca_api_action ); ?>" />
                    </label>
                </td>
                <td class="forminp mdtooltip">
                    <p class="wcca_tooltip_desc description"><?php _e( 'API-Action is an optional parameter telling the API, what shall be returned, value will be sent as parameter `action` in JSON-string or fieldname `action` in POST-array.', WCCA_TEXT_DOMAIN ); ?></p>
                </td>  
            </tr>
            <tr>
                <th class="titledesc" scope="row">
                    <label><?php esc_html_e( 'API-URL', WCCA_TEXT_DOMAIN ); ?></label>
                </th>
                <td>
                    <label>
                        <input type="text" name="wcca_api_url" style="min-width: 20em;" value="<?php echo  esc_attr( $wcca_api_url ) ; ?>" />
                    </label>
                </td>
                <td class="forminp mdtooltip">
                    <p class="wcca_tooltip_desc description"><?php esc_html_e( 'URL, that the cURL-request will be sent to.', WCCA_TEXT_DOMAIN ); ?></p>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<?php 
