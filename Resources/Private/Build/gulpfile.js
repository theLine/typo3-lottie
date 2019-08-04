const {
	src,
	dest,
	series,
	watch,
} = require('gulp');
const {
	pipeline,
} = require('stream');
const clean = require('gulp-clean');
const merge = require('merge-stream');
const rename = require('gulp-rename');
const sourcemaps = require('gulp-sourcemaps');
const uglify = require('gulp-uglify');

const paths = {
	src: {
		lottieFiles: 'node_modules/lottie-web/build/player/*.min.js',
		inViewFiles: 'node_modules/in-view/dist/*.min.js',
		js: '../JavaScript/*.js',
	},
	dest: {
		js: '../../Public/JavaScript/dist',
	}
};


/**
 * Removes all previously generated files
 */
exports.clean = function () {
	return pipeline(
		src(paths.dest.js, {
			allowEmpty: true
		}),
		clean({
			force: true,
		})
	);
};

/**
 * Copies already generated and minified files
 */
exports.copy = function () {
	return pipeline(
		merge(
			src(paths.src.lottieFiles),
			src(paths.src.inViewFiles)
		),
		dest(paths.dest.js)
	);
};

/**
 * Minifies files
 */
exports.build = function () {
	return pipeline(
		src(paths.src.js),
		sourcemaps.init(),
		rename({
			suffix: '.min'
		}),
		uglify(),
		sourcemaps.write(
			'.'
		),
		dest(paths.dest.js)
	);
};

exports.watch = function () {
	return watch(
		[paths.src.js],
		exports.build
	);
};

exports.default = series(
	exports.clean,
	exports.copy,
	exports.build
);
