<?php
/**
 * Register all actions and filters for the plugin.
 *
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WordPress API. Call the
 * run function to execute the list of actions and filters.
 *
 * @package    Woo_Checkout_Code_Api
 * @subpackage Woo_Checkout_Code_Api/includes
 */

defined( 'ABSPATH' ) || exit;

class Woo_Checkout_Code_Api_Loader {

	/* the array of actions registered with WordPress */
	protected $actions;

    /* the array of filters registered with WordPress */
	protected $filters;

	/* initialize the collections used to maintain the actions and filters */
	public function __construct() {
		$this->actions = array();
		$this->filters = array();
	}

	/**
	 * Add a new action to the collection to be registered with WordPress.
	 *
	 * @since    1.0
	 * @param    string               $hook             The name of the WordPress action that is being registered.
	 * @param    object               $component        A reference to the instance of the object on which the action is defined.
	 * @param    string               $callback         The name of the function definition on the $component.
	 * @param    int                  $priority         Optional. he priority at which the function should be fired. Default is 10.
	 * @param    int                  $accepted_args    Optional. The number of arguments that should be passed to the $callback. Default is 1.
	 */
	public function add_action( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->actions = $this->add( $this->actions, $hook, $component, $callback, $priority, $accepted_args );
	}

	/**
	 * Add a new filter to the collection to be registered with WordPress.
	 *
	 * @since    1.0
	 * @param    string               $hook             The name of the WordPress filter that is being registered.
	 * @param    object               $component        A reference to the instance of the object on which the filter is defined.
	 * @param    string               $callback         The name of the function definition on the $component.
	 * @param    int                  $priority         Optional. he priority at which the function should be fired. Default is 10.
	 * @param    int                  $accepted_args    Optional. The number of arguments that should be passed to the $callback. Default is 1
	 */
	public function add_filter( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->filters = $this->add( $this->filters, $hook, $component, $callback, $priority, $accepted_args );
	}

	/**
	 * A utility function that is used to register the actions and hooks into a single
	 * collection.
	 *
	 * @since    1.0
	 * @access   private
	 * @param    array                $hooks            The collection of hooks that is being registered (that is, actions or filters).
	 * @param    string               $hook             The name of the WordPress filter that is being registered.
	 * @param    object               $component        A reference to the instance of the object on which the filter is defined.
	 * @param    string               $callback         The name of the function definition on the $component.
	 * @param    int                  $priority         The priority at which the function should be fired.
	 * @param    int                  $accepted_args    The number of arguments that should be passed to the $callback.
	 * @return   array                                  The collection of actions and filters registered with WordPress.
	 */
	private function add( $hooks, $hook, $component, $callback, $priority, $accepted_args ) {

		$hooks[] = array(
			'hook'          => $hook,
			'component'     => $component,
			'callback'      => $callback,
			'priority'      => $priority,
			'accepted_args' => $accepted_args
		);

		return $hooks;

	}

    /* do the call */
    public function apicall( $order_id ) {
        
        $orderdata = wc_get_order( $order_id );
        // this is the order total
        $orderitem = false;
        if ($orderdata!==false) { $orderitem = $orderdata->get_items(); }
        // this is the saved data from plugin 
        $wcca_unserialize_array = maybe_unserialize( get_option( 'wcca_checkout_setting' ) );
        $wcca_submit_field = ( isset( $wcca_unserialize_array['wcca_submit_field'] ) ? $wcca_unserialize_array['wcca_submit_field'] : 'post' );
        $wcca_curl_field = ( isset( $wcca_unserialize_array['wcca_curl_field'] ) ? $wcca_unserialize_array['wcca_curl_field'] : 'post' );
        $wcca_return_field = ( isset( $wcca_unserialize_array['wcca_return_field'] ) ? $wcca_unserialize_array['wcca_return_field'] : 'json' );
        $wcca_auth_field = ( isset( $wcca_unserialize_array['wcca_auth_field'] ) ? intval($wcca_unserialize_array['wcca_auth_field']) : 0 );
        $wcca_auth_user = ( isset( $wcca_unserialize_array['wcca_auth_user'] ) ? $wcca_unserialize_array['wcca_auth_user'] : '' );
        $wcca_auth_pass = ( isset( $wcca_unserialize_array['wcca_auth_pass'] ) ? $wcca_unserialize_array['wcca_auth_pass'] : '' );
        //
        // maybe we have to differ between new code and code recall
        //
        $wcca_api_action = ( isset( $wcca_unserialize_array['wcca_api_action'] ) ? $wcca_unserialize_array['wcca_api_action'] : '' );
        $wcca_api_url = ( isset( $wcca_unserialize_array['wcca_api_url'] ) ? $wcca_unserialize_array['wcca_api_url'] : false );
        $wcca_dev = ( isset( $wcca_unserialize_array['wcca_dev'] ) ? $wcca_unserialize_array['wcca_dev'] : false );

        $data = array(
            $orderitem,
            $wcca_unserialize_array
        );
        $dev = array();
        
        if ($wcca_api_url!==false && $orderitem!==false) {
            // prepare some dev vars
            $dev['non_virtual_items'] = 0;
            // grab line items from the order 
            $line_items = $orderdata->get_items();
            // create code items for output 
            $code_items = array(); $ci = 0;
            // create api dataset 
            $api_dataset = array();
            // fill base set of code items 
            foreach ( $line_items as $item ) {
                // get the product facts
                $product = $item->get_product();
                $is_visible = $product && $product->is_visible();
                $is_virtual = $product && $product->is_virtual('yes');
                $qty = $item['quantity'];
                // set attributes
                if ($is_virtual) {
                    for ($q=0; $q<$qty; $q++) {
                        $code_items[$ci]['product_permalink'] = apply_filters( 'woocommerce_order_item_permalink', $is_visible ? $product->get_permalink( $item ) : '', $item, $orderdata );
                        $code_items[$ci]['product_permalink_output'] = apply_filters( 'woocommerce_order_item_name', $code_items[$ci]['product_permalink'] ? sprintf( '<a href="%s">%s</a>', $code_items[$ci]['product_permalink'], $item->get_name() ) : $item->get_name(), $item, $is_visible );
                        $code_items[$ci]['product_name'] = $product->get_name();
                        $code_items[$ci]['order_id'] = $item['order_id'];
                        $code_items[$ci]['product_id'] = $item['product_id'];
                        $code_items[$ci]['variation_id'] = $item['variation_id'];
                        $code_items[$ci]['sku'] = $product->get_sku();
                        $code_items[$ci]['code'] = '';
                        //
                        $api_dataset[$ci]['id'] = $ci;
                        $api_dataset[$ci]['order_id'] = $item['order_id'];
                        $api_dataset[$ci]['product_id'] = $item['product_id'];
                        $api_dataset[$ci]['variation_id'] = $item['variation_id'];
                        $api_dataset[$ci]['sku'] = $product->get_sku();
                        //
                        $dev['code_items'][$ci] = $api_dataset[$ci];
                        //
                        $ci++;
                    }
                } else {
                    $dev['non_virtual_items']++;
                }
            }
            /*
             * make the api call
             */
            
            // setup the args
            $args = array();
            // returning (and accepted) content type
            if ($wcca_return_field=='json') {
                $args['headers']['Content-Type'] = 'application/json';
                $args['headers']['Accept'] = 'application/json';
            } 
            
            // authentification
            if ($wcca_auth_field==2 && trim($wcca_auth_user)!='' && trim($wcca_auth_pass)!='') {
                $args['headers']['api-client'] = $wcca_auth_user;
                $args['headers']['api-token'] = $wcca_auth_pass;
            }
            else if ($wcca_auth_field==1 && trim($wcca_auth_user)!='' && trim($wcca_auth_pass)!='') {
                $args['headers']['Authorization'] = 'Basic '.base64_encode($wcca_auth_user.":".$wcca_auth_pass);
            }
            
            if ($wcca_api_action!='') {
                $api_dataset['action'] = $wcca_api_action;
            }
            
            if ($wcca_curl_field=='json') {
                $data_string = json_encode($api_dataset);
                $args['headers']['Content-Length'] = strlen($data_string);
                $args['body'] = $data_string;
            }
            
            $args['timeout'] = 30;
            
            if ($wcca_submit_field=='post') {
                $response = wp_remote_post( $wcca_api_url , $args );
            } 
            else if ($wcca_submit_field=='get') {
                $response = wp_remote_get( $wcca_api_url , $args );
            }
            
            $dev['http_code'] = $http_code = wp_remote_retrieve_response_code( $response );
            $dev['api_body'] = $api_body = wp_remote_retrieve_body( $response );
            
            // support PHP < 7.3
            if (!function_exists('array_key_first')) {
                function array_key_first(array $arr) {
                    foreach($arr as $key => $unused) {
                        return $key;
                    }
                    return NULL;
                }
            }

            if (intval($http_code)!==200) {
                // problem with curl call
                $data = array(
                    'status' => false,
                    'message' => 'Error Code: '.intval($http_code),
                    'apidata' => false
                );
            }
            // grep all
            else if (intval($http_code)===200) {
                // check for returning errormsg
                if ($wcca_return_field=='xml') {
                    // xml should be parsed ...
                    $data = array(
                        'status' => false,
                        'message' => 'XML as return is not yet supported',
                        'apidata' => NULL
                    );
                }
                else if ($wcca_return_field=='json') {
                    // decode the json string to array
                    $apidata = json_decode($api_body, true);
                    if (is_array($apidata) && count($apidata)==count($code_items) && isset($apidata[0])) {
                        if (count($apidata[0])>1) {
                            $data = array(
                                'status' => false,
                                'message' => __('Returning data had to much values', WCCA_TEXT_DOMAIN),
                                'apidata' => $apidata
                            );
                        }
                        else {
                            // get the name of the first key of returned element (maybe it is not 'code' especially)
                            $fkore = array_key_first($apidata[0]);
                            foreach ($code_items AS $cik => $civ) {
                                $code_items[$cik]['code'] = $apidata[$cik][$fkore];
                            }
                            $data = array(
                                'status' => true,
                                'message' => '',
                                'apidata' => $code_items
                            );
                        }
                    } 
                    else {
                        $data = array(
                            'status' => false,
                            'message' => __('Returning data count did not match requestest data count', WCCA_TEXT_DOMAIN),
                            'apidata' => NULL
                        );
                    }
                }
                else {
                    // the call should return just a string
                    if (trim($api_body)=='') {
                        $data = array(
                            'status' => false,
                            'message' => __('There was no data returned', WCCA_TEXT_DOMAIN),
                            'apidata' => NULL
                        );
                    } 
                    else {
                        $data = array(
                            'status' => false,
                            'message' => __('Strings as return are not supported yet', WCCA_TEXT_DOMAIN),
                            'apidata' => NULL
                        );
                    }
                }
                // final error return
                if ($apidata===NULL) {
                    $data = array(
                        'status' => false,
                        'message' => __('There was no data returned', WCCA_TEXT_DOMAIN),
                        'apidata' => NULL
                    );
                }
            }
        } else {
            $data = array(
                'status' => false,
                'message' => __('Codelist API got no host to connect', WCCA_TEXT_DOMAIN),
                'apidata' => false
            );
        }
        
        if ($wcca_dev=='on') { 
            $data['dev'] = $dev; 
            unset($dev);
        }
        return $data;
    }
    
	/**
	 * Register the filters and actions with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {

		foreach ( $this->filters as $hook ) {
			add_filter( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}

		foreach ( $this->actions as $hook ) {
			add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}

	}

}
