const { src, dest, series } = require('gulp');
const merge = require('merge-stream');

/**
 * Removes all previously generated files
 * @param  {Function} cb
 */
function clean (cb) {
	// @TODO: remove generate files

	cb();
}

/**
 * Copies already generated and minified files
 */
function copy (cb) {
	const lottieFiles = src('node_modules/lottie-web/build/player/*.min.js');
	const inViewFiles = src('node_modules/in-view/dist/*.min.js');

	merge(lottieFiles, inViewFiles).pipe(dest('../../Public/JavaScript/dist'));

	cb();
}

/**
 * Minifies files
 * @param  {Function} cb
 */
function build (cb) {
	// @TODO: generate files
	cb();
}


exports.clean = clean;
exports.copy = copy;
exports.build = build;
exports.default = series(
	clean,
	copy,
	build
);
