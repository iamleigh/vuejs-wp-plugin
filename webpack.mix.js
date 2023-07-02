let mix = require('laravel-mix');

/**
 * Public path to generate assets
 *
 * @since 1.0.0
 */
mix.setPublicPath('assets');

/**
 * Autload jQuery
 *
 * @since 1.0.0
 */
mix.autoload({
	jquery: ['$', 'window.jQuery', 'jQuery'],
});

/**
 * Compile js
 *
 * @since 1.0.0
 */
mix.js('assets/vue/admin.js', 'assets/js').vue({ version: 2 });

/**
 * Compile Sass
 *
 * @since 1.0.0
 */
mix.sass('assets/scss/leighton-quito-admin.scss', 'assets/css/leighton-quito-admin.css');
