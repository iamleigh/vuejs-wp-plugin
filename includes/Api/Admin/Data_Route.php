<?php

namespace LeightonQuito\Api\Admin;

use WP_Error;
use WP_HTTP_Response;
use WP_REST_Response;
use WP_REST_Controller;

class Data_Route extends WP_REST_Controller {

	protected $namespace;
	protected $rest_base;

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$this->namespace = 'lq/v1';
		$this->rest_base = 'data';
	}

	/**
	 * Register Routes
	 *
	 * @since 1.0.0
	 */
	public function register_routes() {
		register_rest_route(
			$this->namespace,
			$this->rest_base,
			[
				[
					'methods'             => \WP_REST_Server::READABLE,
					'callback'            => [ $this, 'get_data' ],
					'permission_callback' => [ $this, 'get_data_access' ]
				],
				[
					'methods'             => \WP_REST_Server::CREATABLE,
					'callback'            => [ $this, 'update_data' ],
					'permission_callback' => [ $this, 'get_data_access' ]
				]
			]
		);
	}

	/**
	 * Get data access
	 *
	 * @since 1.0.0
	 */
	public function get_data_access() {
		return true;
	}

	/**
	 * Get data permission
	 *
	 * Abstract method which will be used by the API route to get data.
	 *
	 * @since 1.0.0
	 *
	 * @param mixed $data Contains all the query string variables included at the GET request.
	 * @return void
	 */
	public function get_data( $data = array() ) {
		$api_data_transient = 'leighton_quito_awesome_data';
		$transient_data     = get_transient( $api_data_transient );
		$update_data        = ! empty( $data ) && rest_sanitize_boolean( $data['update'] );

		if ( $transient_data && ! $update_data ) {
			// If the transient is set, return the cached remoteData.
			$data = $transient_data;
		} else {
			// If the transient is not set, call the external API.
			$response = wp_remote_get( 'https://miusage.com/v1/challenge/2/static/' );
			$data     = json_decode( wp_remote_retrieve_body( $response ) );

			// Save the remoteData in a transient for 1 hour.
			set_transient( $api_data_transient, $data, HOUR_IN_SECONDS );
		}

		return rest_ensure_response( $data );
	}

	/**
	 * Abstract method which will be used by the API route to post data.
	 *
	 * @since 1.0.0
	 *
	 * @param mixed $request constains the data used by post method.
	 * @return void
	 */
	public function update_data( $request ) {}
}
