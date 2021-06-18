<?php
// Exit if accessed directly
if (!defined('ABSPATH')) { exit; }

$plugin_name = WCCA_PLUGIN_NAME;
$plugin_version = WCCA_PLUGIN_VERSION;

?>
<div id="cqmain">
    <div class="all-pad">
        <header class="cq-header"></header>
        <ul class="tablist">
            <li <?php echo esc_html((isset($_POST['tablist']) && sanitize_text_field( $_POST['tablist'] )=='#wcca-general-settings')?'class="active"':''); ?>><a href="#wcca-general-settings"><?php _e("General settings", WCCA_TEXT_DOMAIN); ?></a></li>
            <li <?php echo esc_html((isset($_POST['tablist']) && sanitize_text_field( $_POST['tablist'] )=='#wcca-new-code')?'class="active"':''); ?>><a href="#wcca-new-code"><?php _e("Getting codes", WCCA_TEXT_DOMAIN); ?></a></li>
            <li <?php echo esc_html((isset($_POST['tablist']) && sanitize_text_field( $_POST['tablist'] )=='#wcca-embed-pref')?'class="active"':''); ?>><a href="#wcca-embed-pref"><?php _e("Embedding preferences", WCCA_TEXT_DOMAIN); ?></a></li>
            <li <?php echo esc_html((isset($_POST['tablist']) && sanitize_text_field( $_POST['tablist'] )=='#wcca-helpdesc')?'class="active"':''); ?>><a href="#wcca-helpdesc"><?php _e("Helpdesc", WCCA_TEXT_DOMAIN); ?></a></li>
        </ul>
        <form method="POST" name="" action="">
            <input type="hidden" name="tablist" id="tablist-data" value="" />
            <?php 
        
            wp_nonce_field( basename( __FILE__ ), WCCA_PLUGIN_NAME ); 
            
            global $woocommerce ;

            if ( isset( $_POST['submit_setting'] ) ) {
                
                // verify nonce
    
                if ( !isset( $_POST[str_replace(' ', '_', WCCA_PLUGIN_NAME)] ) || !wp_verify_nonce( sanitize_text_field( $_POST[str_replace(' ', '_', WCCA_PLUGIN_NAME)] ), basename( __FILE__ ) ) ) {
                    die( 'Failed security check' );
                } else {
                    
                    $data_post = array(
                        'tablist' => sanitize_text_field( $_POST['tablist'] ),
                        'wcca_submit_field' => sanitize_text_field( $_POST['wcca_submit_field'] ),
                        'wcca_curl_field' => sanitize_text_field( $_POST['wcca_curl_field'] ),
                        'wcca_return_field' => sanitize_text_field( $_POST['wcca_return_field'] ),
                        'wcca_auth_field' => intval( $_POST['wcca_auth_field'] ),
                        'wcca_auth_user' => sanitize_text_field( $_POST['wcca_auth_user'] ),
                        'wcca_auth_pass' => sanitize_text_field( $_POST['wcca_auth_pass'] ),
                        'wcca_api_action' => sanitize_text_field( $_POST['wcca_api_action'] ),
                        'wcca_api_url' => sanitize_text_field( $_POST['wcca_api_url'] ),
                    );
                        
                    if (isset($_POST['wcca_status'])) $data_post['wcca_status'] = sanitize_text_field( $_POST['wcca_status'] );
                    if (isset($_POST['wcca_dev'])) $data_post['wcca_dev'] = sanitize_text_field( $_POST['wcca_dev'] );
                    if (isset($_POST['wcca_checkout_status'])) $data_post['wcca_checkout_status'] = sanitize_text_field( $_POST['wcca_checkout_status'] );
                    if (isset($_POST['wcca_override_status'])) $data_post['wcca_override_status'] = sanitize_text_field( $_POST['wcca_override_status'] );
                    if (isset($_POST['wcca_metabox_status'])) $data_post['wcca_metabox_status'] = sanitize_text_field( $_POST['wcca_metabox_status'] );
                    if (isset($_POST['wcca_email_status'])) $data_post['wcca_email_status'] = sanitize_text_field( $_POST['wcca_email_status'] );
                    
                    if ( $data_post['wcca_auth_field']==0 ) {
                        unset($data_post['wcca_auth_user']);
                        unset($data_post['wcca_auth_pass']);
                    }
                    
                    $general_setting_data = maybe_serialize( $data_post );
                    update_option( 'wcca_checkout_setting', $general_setting_data );

                }
            }
        
            // get data from database
            $wcca_general_setting = maybe_unserialize( get_option( 'wcca_checkout_setting' ) );
            $wcca_status = ( isset( $wcca_general_setting['wcca_status'] ) && !empty($wcca_general_setting['wcca_status']) ? 'checked' : '' );
            $wcca_dev = ( isset( $wcca_general_setting['wcca_dev'] ) && !empty($wcca_general_setting['wcca_dev']) ? 'checked' : '' );
        
            $wcca_submit_field = ( isset( $wcca_general_setting['wcca_submit_field'] ) && !empty($wcca_general_setting['wcca_submit_field']) ? $wcca_general_setting['wcca_submit_field'] : '' );
            $wcca_curl_field = ( isset( $wcca_general_setting['wcca_curl_field'] ) && !empty($wcca_general_setting['wcca_curl_field']) ? $wcca_general_setting['wcca_curl_field'] : '' );
            $wcca_return_field = ( isset( $wcca_general_setting['wcca_return_field'] ) && !empty($wcca_general_setting['wcca_return_field']) ? $wcca_general_setting['wcca_return_field'] : '' );

            $wcca_auth_field = ( isset( $wcca_general_setting['wcca_auth_field'] ) && !empty($wcca_general_setting['wcca_auth_field']) ? $wcca_general_setting['wcca_auth_field'] : '' );
            $wcca_auth_user = ( isset( $wcca_general_setting['wcca_auth_user'] ) && !empty($wcca_general_setting['wcca_auth_user']) ? $wcca_general_setting['wcca_auth_user'] : '' );
            $wcca_auth_pass = ( isset( $wcca_general_setting['wcca_auth_pass'] ) && !empty($wcca_general_setting['wcca_auth_pass']) ? $wcca_general_setting['wcca_auth_pass'] : '' );

            $wcca_api_action = ( isset( $wcca_general_setting['wcca_api_action'] ) && !empty($wcca_general_setting['wcca_api_action']) ? $wcca_general_setting['wcca_api_action'] : '' );

            $wcca_api_url = ( isset( $wcca_general_setting['wcca_api_url'] ) && !empty($wcca_general_setting['wcca_api_url']) ? $wcca_general_setting['wcca_api_url'] : '' );

            $wcca_checkout_status = ( isset( $wcca_general_setting['wcca_checkout_status'] ) && !empty($wcca_general_setting['wcca_checkout_status']) ? trim($wcca_general_setting['wcca_checkout_status']) : '' );
            $wcca_override_status = ( isset( $wcca_general_setting['wcca_override_status'] ) && !empty($wcca_general_setting['wcca_override_status']) ? 'checked' : '' );
            $wcca_metabox_status = ( isset( $wcca_general_setting['wcca_metabox_status'] ) && !empty($wcca_general_setting['wcca_metabox_status']) ? 'checked' : '' );
            $wcca_email_status = ( isset( $wcca_general_setting['wcca_email_status'] ) && !empty($wcca_general_setting['wcca_email_status']) ? 'checked' : '' );
