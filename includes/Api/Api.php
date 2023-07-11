<?php

namespace LeightonQuito\Api;

use WP_REST_Controller;
use LeightonQuito\Api\Admin\Data_Route;
use LeightonQuito\Api\Admin\Settings_Route;
use LeightonQuito\Api\Admin\Messages_Route;

class Api extends WP_REST_Controller {

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'rest_api_init', [ $this, 'register_routes' ] );
	}

	/**
	 * Register API routes
	 *
	 * @since 1.0.0
	 */
	public function register_routes() {
		( new Data_Route() )->register_routes();
		( new Settings_Route() )->register_routes();
		( new Messages_Route() )->register_routes();
	}
}
