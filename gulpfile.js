/**
 * Supported Packages
 * List here all dependencies necessary to run required tasks.
 *
 * @since 1.0.0
 */
const fs = require("fs");
const gulp = require("gulp");

const clean = require("gulp-clean");
const copy = require("gulp-copy");
const archiver = require("gulp-archiver");

const makepot = require("gulp-wp-pot");
const gettext = require("gulp-gettext");

const pkg = require("./package.json");

/**
 * Makepot
 *
 * @desc Gulp task to create POT files.
 *
 * @since 1.0.0
 */
gulp.task("makepot", () =>
	gulp
		.src(sourcePhp.php)
		.pipe(
			makepot({
				domain: pkg.name,
				package: "Leighton Quito",
				bugReport: "https://github.com/iamleigh/leighton-quito-amp/issues",
				metadataFile: "leighton-quito.php",
			})
		)
		.pipe(gulp.dest(`languages/${pkg.name}.pot`))
);

/**
 * Get Text
 *
 * @desc Grab languages files.
 *
 * @since 1.0.0
 */
gulp.task("gettext", () => gulp.src("languages/*.po").pipe(gettext()).pipe(gulp.dest("languages")));

/**
 * Translate (i18n)
 *
 * @desc Run `makepot` and `gettext` tasks in parallel.
 *
 * @since 1.0.0
 */
gulp.task("i18n", gulp.parallel(["makepot", "gettext"]));

/**
 * Package
 *
 * @desc Pack the plugin for release.
 *
 * @since 1.0.0
 */
gulp.task(
	"package",
	gulp.series(
		() => gulp.src(["dist", pkg.name, `${pkg.name}.*.zip`], { read: false, allowEmpty: true }).pipe(clean()),

		() =>
			gulp
				.src([
					"leighton-quito.php",
					"leighton-quito-loader.php",
					"uninstall.php",
					"LICENSE",
					"vendor/autoload.php",
					"src/**",
					"languages/**",
					"assets/css/**/*.css",
					"assets/css/**/*.min.css",
					"assets/images/**/**",
					"assets/js/**/**",
				])
				.pipe(copy(pkg.name)),

		() =>
			gulp
				.src(pkg.name + "/**/*", { base: "." })
				.pipe(archiver(`${pkg.name}.${pkg.version}.zip`))
				.pipe(gulp.dest(".")),

		(done) =>
			fs.rename(pkg.name, "dist", (err) => {
				if (err) throw err;
				done();
			})
	)
);
