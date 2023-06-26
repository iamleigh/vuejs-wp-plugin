<?php
/**
 * Version: 1.0.0
 * Plugin Name: Leighton Quito
 * Plugin URI: https://github.com/iamleigh/leighton-quito-amp
 * Description: Awesome Motive Developer Applicant Challenge, Part 1.
 * Author: Leighton Quito (iamleigh)
 * Author URI: https://github.com/iamleigh
 * Text Domain: leighton-quito
 * Domain Path: assets/languages/
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

if ( ! define('ABSPATH') ) {
	die();
}

if ( ! define( 'LEIGHTONQUITO_PLUGIN_BASENAME' ) ) {
	define( 'LEIGHTONQUITO_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
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
