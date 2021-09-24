const {dest,series,src,watch} = require('gulp');
const scss = require('gulp-sass')(require('sass'));
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const php = require('gulp-connect-php');
const browserSync = require('browser-sync').create();

// Transpile scss into css
function scssTranspile(){
	return src('./src/scss/style.scss', {sourcemaps: true})
		.pipe(scss()
			.on('error', scss.logError))
		.pipe(postcss([autoprefixer(), cssnano()]))
		.pipe(dest('./dist/', {sourcemaps: '.'}));
}

// Minify and autoprefix css
function cssBuild(){
	return src('./dist/style.css')
		.pipe(postcss([cssnano()]))
		.pipe(dest('./dist/'));
}

// Initialize browsersync and Connect php
function phpConnect(cb){
	php.server({}, function(){
		browserSync.init({
			proxy: 'localhost',
			browser: 'firefox'
		})
	})
	cb();
}

// Reload browserSync
function browserSyncReload(cb){
	browserSync.reload();
	cb();
}
// Watch changes in files
function watchFiles(){
	watch('**/*.php', { usePolling: true}, browserSyncReload);
	watch('**/*.scss',{ usePolling: true}, series(scssTranspile, browserSyncReload));
	watch('**/*.js', { usePolling: true}, browserSyncReload);
}

exports.build = cssBuild;
exports.default = series(phpConnect, watchFiles);
