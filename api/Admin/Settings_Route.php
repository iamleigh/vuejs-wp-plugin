<?php

namespace LeightonQuito\Api\Admin;

use WP_REST_Controller;

class Settings_Route extends WP_REST_Controller {

	protected $namespace;
	protected $rest_base;

	/**
	 * Admin Email
	 *
	 * @since 1.0.0
	 */
	public $admin_email;

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$this->namespace = 'lq/v1';
		$this->rest_base = 'settings';
		$this->admin_email = esc_html( get_bloginfo( 'admin_email' ) );
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
		$response = [
			'tablerows' => get_option( 'lq_settings_tablerows' ),
			'timestamp' => get_option( 'lq_settings_timestamp' ),
			'emails'    => get_option( 'lq_settings_emails' )
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

		if ( isset( $request['emails'] ) && is_array( $request['emails'] ) ) {
			foreach ( $request['emails'] as $key => $email ) {
				$emails[ $key ] = isset( $request['emails'][ $key ] ) ? sanitize_email( $email ) : '';
			}
		} else {
			$emails = array( $this->admin_email );
		}

		// Save options data into WordPress
		update_option( 'lq_settings_tablerows', $tablerows );
		update_option( 'lq_settings_timestamp', $timestamp );
		update_option( 'lq_settings_emails', $emails );

		// Submit successful response
		$response = [
			'tablerows' => get_option( 'lq_settings_tablerows' ),
			'timestamp' => get_option( 'lq_settings_timestamp' ),
			'emails'    => get_option( 'lq_settings_emails' )
		];

		return rest_ensure_response( $response );
	}
}
