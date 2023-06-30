<?php

namespace LeightonQuito\Admin;

/**
 * Admin Area
 *
 * @since 1.0.0
 */
class Area {
	/**
	 * Admin page slug
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	const SLUG = 'leighton-quito';

	/**
	 * Admin page access capability
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	const ACCESS = 'manage_options';

	/**
	 * Admin page unique hook
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $hook;

	/**
	 * List admin page(s)
	 *
	 * @since 1.0.0
	 *
	 * @var PageAbstract[]
	 */
	private $pages;

	/**
	 * Register page(s)
	 *
	 * @since 1.0.0
	 *
	 * @var array
	 */
	public static $pages_registered = [ 'general', 'settings' ];

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$this->hooks();
	}

	/**
	 * Register hooks
	 *
	 * @since 1.0.0
	 */
	protected function hooks() {}
}