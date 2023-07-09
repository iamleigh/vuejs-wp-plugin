<?php
/**
 * Plugin uninstall methods
 *
 * @since 1.0.0
 */
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die;
}

global $wpdb;

/**
 * Delete custom options
 *
 * @since 1.0.0
 *
 * @param string $db_prefix - Database prefix
 */
$options = [
	'leighton_quito_settings_tablerows',
	'leighton_quito_settings_timestamp',
	'leighton_quito_settings_emails',
];

foreach ( $options as $option ) {
	delete_option( $option );
}
