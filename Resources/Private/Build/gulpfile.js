const {
	src,
	dest,
	series,
	watch,
} = require('gulp');
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
exports.clean = function _clean() {
	return src(paths.dest.js, {allowEmpty: true})
		.pipe(clean({force: true}))
	;
};

/**
 * Copies already generated and minified files
 */
exports.copy = function _copy() {
	return merge(
			src(paths.src.lottieFiles),
			src(paths.src.inViewFiles)
		)
		.pipe(dest(paths.dest.js))
	;
};

/**
 * Minifies files
 */
exports.build = function _build() {
	return src(paths.src.js)
		.pipe(sourcemaps.init())
		.pipe(rename({suffix: '.min'}))
		.pipe(uglify())
		.pipe(sourcemaps.write('.'))
		.pipe(dest(paths.dest.js))
	;
};

exports.watch = function _watch() {
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
