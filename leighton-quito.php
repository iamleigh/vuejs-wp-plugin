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

	// Stop processing the plugin code
	return;
}

if ( ! function_exists( 'leighton_quito_notice_php' ) ) {
	/**
	 * PHP Notice
	 *
	 * Check if the server is using an old/insecure PHP version
	 * and display a notification if true.
	 *
	 * @since 1.0.0
	 */
	function leighton_quito_notice_php() {
		?>
		<div class="notice notice-error">
			<p>Your site is running PHP <?php echo phpversion(); ?>, an <strong>insecure version</strong> that is no longer supported by this plugin. Please, contact your web hosting provider to update your site to PHP <?php echo LQ_PHP_VERSION; ?> or later version, or switch to a <a href="https://www.wpbeginner.com/wordpress-hosting/" target="_blank" rel="noopener noreferrer">recommended WordPress hosting company</a>.</p>

			<p><strong>Leighton Quito plugin is disabled</strong> on your site until you fix the issue.</p>
		</div>

		<?php
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}
	}
}

if ( ! function_exists( 'leighton_quito_notice_wp' ) ) {
	/**
	 * WP Notice
	 *
	 * Check if the site is using an unsupported WordPress version
	 * and display a notification if true.
	 *
	 * @since 1.0.0
	 */
	function leighton_quito_notice_wp() {
		?>
		<div class="notice notice-error">
			<p>Your site is running an <strong>old version</strong> of WordPress that is no longer supported by this plugin. Please update your WordPress site to WordPress 5.2 or later version.</p>

			<p><strong>Leighton Quito plugin is disabled</strong> on your site until WordPress is updated to the required version.</p>
		</div>
		<?php
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}
	}
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

/**
 * PHP Notice
 *
 * Prevent code execution if the server is using an old PHP version and
 * display an admin notice to notify user.
 *
 * @version 1.0.0
 */
if ( version_compare( phpversion(), LQ_PHP_VERSION, '<=' ) ) {
	add_action( 'admin_notices', 'leighton_quito_notice_php' );

	return;
}

/**
 * WordPres Notice
 *
 * Prevent code execution if the server is using an old WordPress version
 * and display an admin notice to notify user.
 *
 * @version 1.0.0
 */
if ( version_compare( get_bloginfo( 'version' ), LQ_WP_VERSION, '<' ) ) {
	add_action( 'admin_notices', 'leighton_quito_notice_wp' );

	return;
}

require_once dirname( __FILE__ ) . '/leighton-quito-loader.php';
