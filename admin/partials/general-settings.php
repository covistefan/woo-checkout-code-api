<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;
?>
<div id="wcca-general-settings" class="tabcontent">
    <h2><?php esc_html_e( 'Settings', WCCA_TEXT_DOMAIN ); ?></h2>
    <table class="form-table wcca-table-outer product-fee-table">
        <tbody>
            <tr valign="top">
                <th class="titledesc" scope="row">
                    <label><?php esc_html_e( 'API usage', WCCA_TEXT_DOMAIN ); ?></label>
                </th>
                <td>
                    <label class="switch">
                        <input type="checkbox" name="wcca_status" value="on" <?php echo  esc_attr( $wcca_status ) ; ?>>
                    </label>
                </td>
                <td class="forminp mdtooltip">
                    <p class="wcca_tooltip_desc description">
                        <?php esc_html_e( 'Enable or disable code API usage for WooCommerce Checkout', WCCA_TEXT_DOMAIN ); ?>
                    </p>
                </td>
            </tr>
            <tr valign="top">
                <th class="titledesc" scope="row">
                    <label><?php esc_html_e( 'API DEV Mode', WCCA_TEXT_DOMAIN ); ?></label>
                </th>
                <td>
                    <label class="switch">
                        <input type="checkbox" name="wcca_dev" value="on" <?php echo  esc_attr( $wcca_dev ) ; ?>>
                    </label>
                </td>
                <td class="forminp mdtooltip">
                    <p class="wcca_tooltip_desc description">
                        <?php esc_html_e( 'Enable or disable code API development mode. Development mode will show up more returning information in admin panel.', WCCA_TEXT_DOMAIN ); ?>
                    </p>
                </td>
            </tr>
            <tr valign="top">
                <th class="titledesc" scope="row">
                    <label><?php esc_html_e( 'Select data submit type', WCCA_TEXT_DOMAIN ); ?></label>
                </th>
                <td>
                    <?php 
                    
                    $wcca_submit = array(
                        "post" => "POST",
//                        "get" => "GET",
                    );
                            echo  '<select name = "wcca_submit_field" class="multiselect2">' ;
                            foreach ( $wcca_submit as $wcca_field_key => $wcca_field ) {
                                $selectedVal = ( !empty($wcca_submit_field) && $wcca_field_key==$wcca_submit_field ) ? 'selected=selected' : '' ;
                                $selectedAttr = ( !empty($wcca_submit_field) && $wcca_field_key==$wcca_submit_field ) ? ' • ' : '' ;
                                echo  '<option value="' . esc_attr( $wcca_field_key ) . '" ' . esc_attr( $selectedVal ) . '>' . esc_html__( $wcca_field, WCCA_TEXT_DOMAIN ) . '</option>' ;
                            }
                            echo  '</select>' ;
                            ?>
                        </td>
                        <td class="forminp mdtooltip">
                            <p class="wcca_tooltip_desc description"><?php esc_html_e( 'Choose what method should be used to send data to API', WCCA_TEXT_DOMAIN ); ?></p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th class="titledesc" scope="row">
                            <label><?php esc_html_e( 'Select data submit format', WCCA_TEXT_DOMAIN ); ?></label>
                        </th>
                        <td>
                            <?php 

                            $wcca_curl = array(
//                                "post" => "POST-Data",
                                "json" => "JSON-Data",
                            );
                            echo  '<select name = "wcca_curl_field" class="multiselect2">' ;
                            foreach ( $wcca_curl as $wcca_field_key => $wcca_field ) {
                                $selectedVal = ( !empty($wcca_curl_field) && $wcca_field_key==$wcca_curl_field ) ? 'selected=selected' : '' ;
                                $selectedAttr = ( !empty($wcca_curl_field) && $wcca_field_key==$wcca_curl_field ) ? ' • ' : '' ;
                                echo  '<option value="' . esc_attr( $wcca_field_key ) . '" ' . esc_attr( $selectedVal ) . '>' . esc_html__( $wcca_field, WCCA_TEXT_DOMAIN ) . '</option>' ;
                            }
                            echo  '</select>' ;
                            ?>
                        </td>
                        <td class="forminp mdtooltip">
                            <p class="wcca_tooltip_desc description"><?php esc_html_e( 'POST - data will be submitted as post values, JSON - ONE single string with a JSON-encoded dataset will be submitted', WCCA_TEXT_DOMAIN ); ?></p>
                        </td>
                    </tr>
                    <tr valign="top">
                    <th class="titledesc" scope="row">
                        <label><?php esc_html_e( 'Select data return type', WCCA_TEXT_DOMAIN ); ?></label></th>
                    <td>
                        <?php 
$wcca_return = array(
//    "xml" => "XML-Data",
    "json" => "JSON-Data",
//    "text" => "String",
);
echo  '<select name = "wcca_return_field" class="multiselect2">' ;
foreach ( $wcca_return as $wcca_field_key => $wcca_field ) {
    $selectedVal = ( !empty($wcca_return_field) && $wcca_field_key==$wcca_return_field ) ? 'selected=selected' : '' ;
    $selectedAttr = ( !empty($wcca_return_field) && $wcca_field_key==$wcca_return_field ) ? ' • ' : '' ;
    echo  '<option value="' . esc_attr( $wcca_field_key ) . '" ' . esc_attr( $selectedVal ) . '>' . esc_html__( $wcca_field, WCCA_TEXT_DOMAIN ) . '</option>' ;
}
echo  '</select>' ;
?></td>
                <td class="forminp mdtooltip">
                    <p class="wcca_tooltip_desc description">
                    <?php esc_html_e( 'Choose what kind of data you expext to be returned from API', WCCA_TEXT_DOMAIN ); ?>
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<?php 
