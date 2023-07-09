<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Autoloader
 *
 * @since 1.0.0
 */
require_once 'vendor/autoload.php';

/**
 * Global Function Holder
 *
 * Similar behaviour to singleton's instance().
 *
 * @since 1.0.0
 *
 * @return LeightonQuito\Core
 */
function leighton_quito() {
	/**
	 * @var \LeightonQuito\Core
	 */
	static $core;

	if ( ! isset( $core ) ) {
		$core = new \LeightonQuito\Core();
	}

	return $core;
}

leighton_quito();