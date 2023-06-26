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
	 * Core constructor
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$this->plugin_path = leighton_quito_plugin_dir();
		$this->plugin_url = leighton_quito_plugin_url();
		$this->assets_url  = $this->plugin_url . '/assets';
	}
}
