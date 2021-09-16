const {dest,series,src,watch} = require('gulp');
const scss = require('gulp-sass')(require('sass'));
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const browserSync = require('browser-sync').create();

// Transpile scss into css
function scssTranspile(){
	return src('./src/scss/style.scss', {sourcemaps: true})
		.pipe(scss()
			.on('error', scss.logError))
		.pipe(postcss([autoprefixer()]))
		.pipe(dest('./dist/', {sourcemaps: '.'}));
}
// Minify and autoprefix css
function cssBuild(){
	return src('./dist/style.css')
		.pipe(postcss([cssnano()]))
		.pipe(dest('./dist'));
}
// Initialize browserSync server
function browserSyncServe(cb){
	browserSync.init({
		server: {
			baseDir: '.'
		},
		browser: 'firefox'
	});
	cb();
}
// Reload browserSync
function browserSyncReload(cb){
	browserSync.reload();
	cb();
}
// Watch changes in files
function watchFiles(){
	watch('index.php', { usePolling: true}, browserSyncReload);
	watch('./src/**/*.scss',{ usePolling: true}, series(scssTranspile, browserSyncReload));
	watch('./src/js/app.js', { usePolling: true}, browserSyncReload);
}

exports.build = cssBuild;
exports.default = series(browserSyncServe, watchFiles);
