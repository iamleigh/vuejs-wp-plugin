<?php

namespace LeightonQuito\Api\Admin;

use WP_REST_Controller;

class Settings_Route extends WP_REST_Controller {

	protected $namespace;
	protected $rest_base;

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$this->namespace = 'lq/v1';
		$this->rest_base = 'settings';
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
					'callback'            => [ $this, 'get_items' ],
					'permission_callback' => [ $this, 'get_route_access' ]
				],
				[
					'methods'             => \WP_REST_Server::CREATABLE,
					'callback'            => [ $this, 'create_items' ],
					'permission_callback' => [ $this, 'get_route_access' ]
				]
			]
		);
	}

	/**
	 * Get route access
	 *
	 * @since 1.0.0
	 */
	public function get_route_access( $request ) {
		return true;
	}

	/**
	 * Get items response
	 *
	 * @since 1.0.0
	 */
	public function get_items( $request ) {
		// Define default values
		$tablerows = 5;
		$timestamp = 'false';
		$emails = array(
			0 => array(
				'id' => '1',
				'value' => esc_html( get_bloginfo( 'admin_email' ) ),
			)
		);

		$response = [
			'tablerows' => get_option( 'leighton_quito_settings_tablerows', $tablerows ),
			'timestamp' => get_option( 'leighton_quito_settings_timestamp', $timestamp ),
			'emails'    => get_option( 'leighton_quito_settings_emails', $emails )
		];

		return rest_ensure_response( $response );
	}

	/**
	 * Create items response
	 *
	 * @since 1.0.0
	 */
	public function create_items( $request ) {
		$tablerows = isset( $request['tablerows'] ) ? sanitize_text_field( $request['tablerows'] ) : '';
		$timestamp = isset( $request['timestamp'] ) ? sanitize_text_field( $request['timestamp'] ) : '';
		$emails = isset( $request['emails'] ) && is_array( $request['emails'] ) ? $request['emails'] : array();

		if ( isset( $emails ) && is_array( $emails ) ) {
			foreach( $emails as $key => $email ) {
				$keys = array_keys($emails[$key]);
				$keys = array_map('sanitize_key', $keys);

				$values = array_values($emails[$key]);
				$values = array_map('sanitize_text_field', $values);

				$emails[$key] = array_combine($keys, $values);
			}
		}

		// Save options data into WordPress
		update_option( 'leighton_quito_settings_tablerows', $tablerows );
		update_option( 'leighton_quito_settings_timestamp', $timestamp );
		update_option( 'leighton_quito_settings_emails', $emails );

		// Submit successful response
		$response = [
			'tablerows' => get_option( 'leighton_quito_settings_tablerows' ),
			'timestamp' => get_option( 'leighton_quito_settings_timestamp' ),
			'emails'    => get_option( 'leighton_quito_settings_emails' )
		];

		return rest_ensure_response( $response );
	}
}
