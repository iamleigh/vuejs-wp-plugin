let mix = require("laravel-mix");

/**
 * Public path to generate assets
 *
 * @since 1.0.0
 */
mix.setPublicPath("assets");

/**
 * Autload jQuery
 *
 * @since 1.0.0
 */
mix.autoload({
  jquery: ["$", "window.jQuery", "jQuery"],
});

/**
 * Compile js
 *
 * @since 1.0.0
 */
mix
  .js("assets/vue/admin.js", "assets/js/admin.js")
  .sourceMaps(false)
  .extract(["vue"]);

/**
 * Compile Sass
 *
 * @since 1.0.0
 */
mix.sass("assets/scss/admin.css", "assets/css/admin.css");
