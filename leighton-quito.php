<?php
/**
 * Version: 1.0.0
 * Requires PHP: 5.6
 * Plugin Name: Leighton Quito
 * Plugin URI: https://github.com/iamleigh/leighton-quito-amp
 * Description: Awesome Motive Developer Applicant Challenge, Part 1.
 * Author: Leighton Quito (iamleigh)
 * Author URI: https://github.com/iamleigh
 * Text Domain: leighton-quito
 * Domain Path: /languages/
 */

/**
 * @author Leighton Quito
 * @copyright Leighton Quito (iamleigh.com), 2023. All rights reserved.
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU license version 3 or later, available here
 * https://www.gnu.org/licenses/gpl.txt
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with this
 * program; if not, write to the Free Software Foundation, Inc., 59 Temple Place,
 * Suite 330, Boston, MA 02111-1307 USA
 */

if ( ! defined('ABSPATH') ) {
	die();
}

if ( ! defined( 'LEIGHTONQUITO_PLUGIN_BASENAME' ) ) {
	define( 'LEIGHTONQUITO_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
}

// Register activation hook
register_activation_hook( __FILE__, array( 'Leighton_Quito', 'activation__hook' ) );

// Register deactivation hook
register_deactivation_hook( __FILE__, array( 'Leighton_Quito', 'deactivation_hook' ) );

/**
 * Class Leighton_Quito
 *
 * Main class to init plugin.
 *
 * @since 1.0.0
 */
if ( ! class_exists( 'Leighton_Quito' ) ) {
	class Leighton_Quito {
		/**
		 * Plugin instance
		 *
		 * @var null
		 */
		private static $instance = null;

		/**
		 * @var Leighton_Quito_Core
		 */
		public $leighton_quito;

		/**
		 * Return the plugin instance
		 *
		 * @since 1.0.0
		 * @return Leighton_Quito
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				$self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Plugin constructor
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			add_action( 'admin_init', array( $this, 'initialize_admin' ) );

			$this->includes();
			$this->include_vendors();

			$this->init();
			$this->load_textdomain();
		}

		/**
		 * Called on plugin activation
		 *
		 * @since 1.0.0
		 */
		public static function activation_hook() {
			add_option( 'leightonquito_activation_hook', 'activated' );
		}

		/**
		 * Called on plugin deactivation
		 *
		 * @since 1.0.0
		 */
		public static function deactivation_hook() {
			wp_clear_scheduled_hook( 'leightonquito_cleanup' );
		}

		/**
		 * Load plugin files
		 *
		 * @since 1.0.0
		 */
		private function includes() {
			// Core files
			/* @noinspection PhpIncludeInspection */
			include_once leightonquito_plugin_dir() . 'library/class-core.php';
		}

		/**
		 * Init the plugin
		 *
		 * @since 1.0.0
		 */
		private function init() {
			// Initialize plugin core
			$this->leightonquito = Leighton_Quito_Core::get_instance();

			// Trigger when plugin loaded
			do_action( 'leightonquito_loaded' );
		}

		/**
		 * Include vendors
		 *
		 * @since 1.0.0
		 */
		private function include_vendors() {
			// PHP 5.6.0 Requirement
			// Based on the latest version needed on vendors list
			if ( version_compare( PHP_VERSION, '5.6.0', 'ge' ) ) {
				/** @noinspection PhpIncludeInspection */
				include_once leightonquito_plugin_dir() . 'vendor/autoload_psr4.php';
			}
		}

		/**
		 * Load language files
		 *
		 * @since 1.0.0
		 */
		private function load_textdomain() {
			load_plugin_textdomain( 'leighton_quito', false, 'leighton-quito/languages');
		}
	}
}

if ( ! function_exists( 'leightonquito' ) ) {
	function leightonquito() {
		return Leighton_Quito::get_instance();
	}

	/**
	 * Init the plugin and load the plugin instance
	 *
	 * @since 1.0.0
	 */
	add_action( 'plugins_loaded', 'leightonquito' );
}

if ( ! function_exists( 'leightonquito_plugin_url' ) ) {
	/**
	 * Return plugin URL
	 *
	 * @since 1.0.0
	 * @return string
	 */
	function leightonquito_plugin_url() {
		return trailingslashit( plugin_dir_url( __FILE__ ) );
	}
}

if ( ! function_exists( 'leightonquito_plugin_dir' ) ) {
	/**
	 * Return plugin path
	 *
	 * @since 1.0.0
	 * @return string
	 */
	function leightonquito_plugin_dir() {
		return trailingslashit( plugin_dir_path( __FILE__ ) );
	}
}
