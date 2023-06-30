<?php

namespace LeightonQuito;

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
	}

	/**
	 * Render page hooks
	 *
	 * @since 1.0.0
	 */
	public function hooks() {
		// Register activation hook
		register_activation_hook( __FILE__, [ $this, 'activate' ] );

		// Register deactivation hook
		register_deactivation_hook( __FILE__, [ $this, 'deactivate' ] );

		// Initialize plugin
		add_action( 'init', [ $this, 'init_plugin' ] );
	}

	/**
	 * On plugin activation
	 *
	 * @since 1.0.0
	 */
	public function activate() {
		$is_installed = get_option( 'lq_is_installed' );

		if ( ! $is_installed ) {
			update_option( 'lq_is_installed', time() );
		}

		update_option( 'lq_is_installed', LQ_VERSION );
	}

	/**
	 * On plugin deactivation
	 *
	 * @since 1.0.0
	 */
	public function deactivate() {
		// Do nothing.
	}

	/**
	 * Initilize plugin
	 *
	 * @since 1.0.0
	 */
	public function init_plugin() {
		// Load translations
		$this->load_textdomain();

		if ( is_admin() ) {
			$this->get_admin();
		}
	}

	/**
	 * Load language files
	 *
	 * @since 1.0.0
	 */
	private function load_textdomain() {
		load_plugin_textdomain( 'leighton-quito', false, LEIGHTON_QUITO_PLUGIN_BASENAME . '/assets/languages' );
	}

	/**
	 * Load admin area
	 *
	 * @since 1.0.0
	 *
	 * @return Admin\Area
	 */
	public function get_admin() {

		static $admin;

		if ( ! isset( $admin ) ) {
			$admin = apply_filters( 'leighton_quito_core_get_admin', new Admin\Area() );
		}

		return $admin;
	}
}
