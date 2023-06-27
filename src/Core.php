<?php

namespace LeightonQuito\Core;

/**
 * Class Core
 *
 * @since 1.0.0
 */
class Core {
	/**
	 * Path to plugin directory
	 *
	 * @since 1.0.0
	 *
	 * @var string Without trailing slash
	 */
	public $plugin_path;

	/**
	 * URL to plugin directory
	 *
	 * @since 1.0.0
	 *
	 * @var string Without trailing slash
	 */
	public $plugin_url;

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$this->plugin_path = leighton_quito_plugin_dir();
		$this->plugin_url = leighton_quito_plugin_url();
		$this->assets_url  = $this->plugin_url . '/assets';

		$this->hooks();
		$this->init();
	}

	/**
	 * Render page hooks
	 *
	 * @since 1.0.0
	 */
	public function hooks() {
		// Register activation hook
		register_activation_hook( __FILE__, [ $this, 'activate' ] );
	}

	/**
	 * Initilize plugin
	 *
	 * @since 1.0.0
	 */
	public function init() {
		$this->load_textdomain();

		if ( is_admin() ) {}
	}

	/**
	 * Load language files
	 *
	 * @since 1.0.0
	 */
	private function load_textdomain() {
		load_plugin_textdomain( 'leighton-quito', false, LEIGHTON_QUITO_PLUGIN_BASENAME . '/assets/languages' );
	}
}
