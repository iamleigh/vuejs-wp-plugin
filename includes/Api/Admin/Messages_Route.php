<?php

namespace LeightonQuito\Api\Admin;

use WP_REST_Controller;

class Messages_Route extends WP_REST_Controller {

	protected $namespace;
	protected $rest_base;

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$this->namespace = 'lq/v1';
		$this->rest_base = 'messages';
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
					'callback'            => [ $this, 'get_messages' ],
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
	 * Get messages response
	 *
	 * @since 1.0.0
	 */
	public function get_messages( $request ) {
		$response = [
			'tableTitle'    => get_option( 'leighton_quito_messages_table_title', esc_html__( 'Table Tab', 'leighton-quito' ) ),
			'graphTitle'    => get_option( 'leighton_quito_messages_graph_title', esc_html__( 'Graph Tab', 'leighton-quito' ) ),
			'settingsTitle' => get_option( 'leighton_quito_messages_settings_title', esc_html__( 'Settings Tab', 'leighton-quito' ) ),
			'rowsTitle'     => get_option( 'leighton_quito_messages_rows_title', esc_html__( 'Table Rows', 'leighton-quito' ) ),
			'rowsLabel'     => get_option( 'leighton_quito_messages_rows_label', esc_html__( 'Limit the number of rows to display at the table.', 'leighton-quito' ) ),
			'rowsHelper'    => get_option( 'leighton_quito_messages_rows_helper', esc_html__( 'The allowed rows value must be between 1 and 5.', 'leighton-quito' ) ),
			'timeTitle'     => get_option( 'leighton_quito_messages_time_title', esc_html__( 'Timestamp', 'leighton-quito' ) ),
			'timeUnix'      => get_option( 'leighton_quito_messages_time_unix', esc_html__( 'Unix', 'leighton-quito' ) ),
			'timeDate'      => get_option( 'leighton_quito_messages_time_date', esc_html__( 'Date', 'leighton-quito' ) ),
			'emailsTitle'   => get_option( 'leighton_quito_messages_emails_title', esc_html__( 'Allowed Emails', 'leighton-quito' ) ),
			'emailsAdd'     => get_option( 'leighton_quito_messages_emails_add', esc_html__( 'Typedown an email', 'leighton-quito' ) ),
			'emailsError'   => get_option( 'leighton_quito_messages_emails_error', esc_html__( 'Invalid email address.', 'leighton-quito' ) ),
			'buttonSave'    => get_option( 'leighton_quito_messages_button_save', esc_html__( 'Save Settings', 'leighton-quito' ) ),
			'buttonAdd'     => get_option( 'leighton_quito_messages_button_add', esc_html__( 'Add Email', 'leighton-quito' ) ),
			'buttonRemove'  => get_option( 'leighton_quito_messages_button_remove', esc_html__( 'Remove Email', 'leighton-quito' ) ),
		];

		return rest_ensure_response( $response );
	}
}
