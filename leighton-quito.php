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

if ( ! defined( 'LQ_PLUGIN_VERSION' ) ) {
	define( 'LQ_PLUGIN_VERSION', '1.0.0' );
}

if ( ! defined( 'LQ_PHP_VERSION' ) ) {
	define( 'LQ_PHP_VERSION', '7.2' );
}

if ( ! defined( 'LQ_WP_VERSION' ) ) {
	define( 'LQ_WP_VERSION', '5.2' );
}

if ( ! defined( 'LEIGHTON_QUITO_PLUGIN_BASENAME' ) ) {
	define( 'LEIGHTON_QUITO_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
}

if ( function_exists( 'leighton_quito' ) ) {
	/**
	 * Deactivates the plugin and stops loading the plugin instance
	 *
	 * @since 1.0.0
	 */
	if ( ! function_exists( 'leighton_quito_deactivate' ) ) {
		function leighton_quito_deactivate() {
			deactivate_plugins( LEIGHTON_QUITO_PLUGIN_BASENAME );
		}
	}

	add_action( 'admin_init', 'leighton_quito_deactivate' );

	return;
}

if ( ! function_exists( 'leighton_quito_plugin_url' ) ) {
	/**
	 * Return plugin URL
	 *
	 * @since 1.0.0
	 * @return string
	 */
	function leighton_quito_plugin_url() {
		return trailingslashit( plugin_dir_url( __FILE__ ) );
	}
}

if ( ! function_exists( 'leighton_quito_plugin_dir' ) ) {
	/**
	 * Return plugin path
	 *
	 * @since 1.0.0
	 * @return string
	 */
	function leighton_quito_plugin_dir() {
		return trailingslashit( plugin_dir_path( __FILE__ ) );
	}
}
