<?php

namespace LeightonQuito;

/**
 * Admin Area
 *
 * @since 1.0.0
 */
class Admin {
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
		$this->plugin_path = leighton_quito_plugin_dir();
		$this->plugin_url = leighton_quito_plugin_url();
		$this->assets_url  = $this->plugin_url . 'assets/';

		$this->scripts_url = $this->assets_url . 'js/';
		$this->styles_url = $this->assets_url . 'css/';
		$this->images_url = $this->assets_url . 'images/';

		$this->hooks();
	}

	/**
	 * Register hooks
	 *
	 * @since 1.0.0
	 */
	protected function hooks() {
		if (!$this->is_admin_page()) {
			return;
		}

		add_action( 'admin_menu', [ $this, 'admin_menu' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'register_assets' ] );

		// Outputs admin header
		add_action( 'in_admin_header', [ $this, 'header_template' ], 100 );
	}

	/**
	 * Register assets
	 *
	 * @since 1.0.0
	 */
	public function register_assets() {
		if (!$this->is_admin_page()) {
			return;
		}

		$this->load_styles();
		$this->load_scripts();
	}

	/**
	 * Load scripts
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function load_scripts() {
		wp_register_script( 'lq-manifest', $this->scripts_url . 'manifest.js', [], rand(), true );
		wp_register_script( 'lq-vendor', $this->scripts_url . 'vendor.js', [ 'lq-manifest' ], rand(), true );
		wp_register_script( 'lq-admin', $this->scripts_url . 'admin.js', [ 'lq-vendor' ], rand(), true );

		wp_enqueue_script( 'lq-manifest' );
		wp_enqueue_script( 'lq-vendor' );
		wp_enqueue_script( 'lq-admin' );

		wp_localize_script( 'lq-admin', 'lqAdminLocalizer', [
			'adminUrl'  => admin_url( '/' ),
			'ajaxUrl'   => admin_url( 'admin-ajax.php' ),
			'apiUrl'    => home_url( '/wp-json' ),
		] );
	}

	/**
	 * Load styles
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function load_styles() {
		wp_register_style( 'lq-admin', $this->styles_url . 'leighton-quito-admin.css' );

		wp_enqueue_style( 'lq-admin' );
	}

	/**
	 * Register menu page
	 *
	 * @since 1.0.0
	 */
	public function admin_menu() {
		global $submenu;

		$this->hook = add_menu_page(
			__( 'Leighton Quito', 'leighton-quito' ),
			__( 'Leighton Quito', 'leighton-quito' ),
			self::ACCESS,
			self::SLUG,
			[ $this, 'page_template' ],
			'dashicons-superhero'
		);

		if ( current_user_can( self::ACCESS ) ) {
			add_submenu_page(
				self::SLUG,
				esc_html__( 'Settings', 'leighton-quito' ),
				esc_html__( 'Settings', 'leighton-quito' ),
				self::ACCESS,
				self::SLUG,
				[ $this, 'page_template' ]
			);
		}
	}

	/**
	 * Check whether we are on an admin page.
	 *
	 * @since 1.0.0
	 *
	 * @return bool
	 */
	public function is_admin_page() {
		$cur_page    = isset( $_GET['page'] ) ? sanitize_key( $_GET['page'] ) : '';
		$check       = self::SLUG;

		return is_admin() && $cur_page === $check;
	}

	/**
	 * Render admin page
	 *
	 * @since 1.0.0
	 */
	public function page_template() {
		?>

		<div id="leighton-quito-plugin" class="wrap">
			<div id="lq-admin-app"></div>
		</div>

		<?php
	}

	/**
	 * Render admin header
	 *
	 * @since 1.0.0
	 */
	public function header_template() {
		// Bail if we're not on a plugin page.
		if ( ! $this->is_admin_page() ) {
			return;
		}

		do_action( 'leighton_quito_header_template_before' );
		?>

			<div class="leighton-quito-header">
				<div class="leighton-quito-logo" aria-hidden="true">
					<img src="<?php echo esc_url( $this->images_url ); ?>logo.svg" alt="Leighton Quito" class="leighton-quito-logo__image" />
				</div>

				<div class="leighton-quito-header__slogan">
					<h1 class="leighton-quito-header__title">Leighton Quito</h1>
					<p class="leighton-quito-header__subtitle">a <strong>vue<span>js</span></strong> developer applicant challenge</p>
				</div>
			</div>

		<?php
	}
}
