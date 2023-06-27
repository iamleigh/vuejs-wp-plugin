<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

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
		$core = new \LeightonQuito\Core\Core();
	}

	return $core;
}

leighton_quito();