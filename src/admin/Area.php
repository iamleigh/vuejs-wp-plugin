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
	protected function hooks() {
		add_action( 'admin_menu', [ $this, 'admin_menu' ] );
		// add_action( 'admin_enqueue_scripts', [ $this, 'register_scripts_styles' ] );
	}

	/**
	 * Register menu page
	 *
	 * @since 1.0.0
	 */
	public function admin_menu() {
		global $submenu;

		$this->$hook = add_menu_page(
			__( 'Leighton Quito', 'leighton-quito' ),
			__( 'Leighton Quito', 'leighton-quito' ),
			self::ACCESS,
			self::SLUG,
			[ $this, 'template' ],
			'dashicons-superhero'
		);

		if ( current_user_can( self::ACCESS ) ) {
			add_submenu_page(
				self::SLUG,
				esc_html__( 'Settings', 'leighton-quito' ),
				esc_html__( 'Settings', 'leighton-quito' ),
				self::ACCESS,
				self::SLUG,
				[ $this, 'template' ]
			);
		}
	}

	/**
	 * Render admin page
	 *
	 * @since 1.0.0
	 */
	public function template() {
		?>

		<div class="wrap" id="lq-app">
			<h1>Leighton Quito</h1>
		</div>

		<?php
	}
}