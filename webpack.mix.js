let mix = require('laravel-mix');
require('laravel-mix-stylelint');

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
mix.js('assets/vue/admin.js', 'assets/js').sourceMaps(false).vue({ version: 2 });

/**
 * Compile Sass
 *
 * @since 1.0.0
 */
mix.stylelint();
mix.sass('assets/scss/leighton-quito-admin.scss', 'assets/css/leighton-quito-admin.css');
