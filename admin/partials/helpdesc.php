<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;
?>
<div id="wcca-helpdesc" class="tabcontent">
    <div class="product_header_title">
        <h2><?php _e( 'Helpdesc', WCCA_TEXT_DOMAIN ); ?></h2>
        <h3><?php _e( 'How does Woo Code API work?', WCCA_TEXT_DOMAIN ); ?></h3>
        <p><?php _e( 'Woo Code API submits your product data to an external server you defined in "Get Codes"', WCCA_TEXT_DOMAIN ); ?></p>
        <h3><?php _e( 'Data submitted', WCCA_TEXT_DOMAIN ); ?></h3>
        <p><?php _e( 'If API-Key-Authentification is set, the params <code>api-client</code> and <code>api-token</code> will be sent as <code>CURLOPT_HTTPHEADER</code> with their associated data.', WCCA_TEXT_DOMAIN ); ?> <?php _e( 'If an action param is set, it will be submitted as <code>action</code>.', WCCA_TEXT_DOMAIN ); ?> <?php _e( 'For <strong>each</strong> product will be created a single entry. If your customer bought 2 variants of the same product, 2 codes expected to be returned.', WCCA_TEXT_DOMAIN ); ?> <?php _e( 'Every product set submitted to API has following structure:' , WCCA_TEXT_DOMAIN ); ?></p>    
        <p><?php _e( 'submitting', WCCA_TEXT_DOMAIN ); ?>[<code>n</code>]['id'] = <code>n</code>;<br />
<?php _e( 'submitting', WCCA_TEXT_DOMAIN ); ?>[<code>n</code>]['order_id'] = <code><?php _e( 'Items order ID', WCCA_TEXT_DOMAIN ); ?></code>;<br />
<?php _e( 'submitting', WCCA_TEXT_DOMAIN ); ?>[<code>n</code>]['product_id'] = <code><?php _e( 'Items product ID', WCCA_TEXT_DOMAIN ); ?></code>;<br />
<?php _e( 'submitting', WCCA_TEXT_DOMAIN ); ?>[<code>n</code>]['variation_id'] = <code><?php _e( 'Items variation ID', WCCA_TEXT_DOMAIN ); ?></code>;<br />
<?php _e( 'submitting', WCCA_TEXT_DOMAIN ); ?>[<code>n</code>]['sku'] = <code><?php _e( 'Items sku', WCCA_TEXT_DOMAIN ); ?></code>;</p>
        <p><a onclick="showExample('request');"><?php _e( 'Complete set sent to your API example (click to show)', WCCA_TEXT_DOMAIN ); ?></a></p>
        <pre id="request" style="display: none;">array (
    'action' => 'createcodes',
    'product' => array(
        0 => array(
            'id' = 0,
            'order_id' = 1,
            'product_id' = 21,
            'variation_id' = 32,
            'sku' = 'my_prod_21_32',
        ),
        1 => array(
            'id' = 1,
            'order_id' = 1,
            'product_id' = 21,
            'variation_id' = 32,
            'sku' = 'my_prod_21_32',
        ),
        2 => array(
            'id' = 2,
            'order_id' = 1,
            'product_id' = 12,
            'variation_id' = 23,
            'sku' = 'my_prod_12_23',
        ),
    ),
)</pre>
        
        <h3><?php _e( 'Data expected', WCCA_TEXT_DOMAIN ); ?></h3>
        <p><?php _e( 'The expected returning data for XML or JSON is a set of data with same length like product set and <code>n</code> elements with key <code>code</code> and a string as value that holds the full information that should be returned as code:', WCCA_TEXT_DOMAIN ); ?></p>
        <p><?php _e( 'returning', WCCA_TEXT_DOMAIN ); ?>[<code>1</code>] = array('code' => <code><em>string</em> value</code>);<br />
<?php _e( 'returning', WCCA_TEXT_DOMAIN ); ?>[<code>2</code>] = array('code' => <code><em>string</em> value</code>);<br />
<?php _e( 'returning', WCCA_TEXT_DOMAIN ); ?>[<code>…</code>] = array('code' => <code><em>string</em> value</code>);<br />
<?php _e( 'returning', WCCA_TEXT_DOMAIN ); ?>[<code>n</code>] = array('code' => <code><em>string</em> value</code>);<br /></p>
        <p><?php _e( 'The expected returning data for string format is just a list of codes, separeted by semikolon:', WCCA_TEXT_DOMAIN ); ?></p>
        <p><code>code<em>1</em>;code<em>2</em>;…;code<em>n</em></code></p>
        <p><a onclick="showExample('return');"><?php _e( 'Complete set returned from API example (click to show)', WCCA_TEXT_DOMAIN ); ?></a></p>
        <pre id="return" style="display: none;">array (
    0 => array(
        'code' = 'coelab2a09234',
    ),
    1 => array(
        'code' = 'kdi3n0c3lsh59',
    ),
    2 => array(
        'code' = 'al2ns9sk3nal4',
    ),
)</pre>
        
        <script>
        
            function showExample(t) {
                jQ('#' + t).toggle(400);
            }
        
        </script>
    </div>
</div>
<?php 
