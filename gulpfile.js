"use strict";
// Project configuration
var project 	    = 'positor', // Project name, used for build zip.
    version         = '1.3.0', // Version for stylesheets and scripts
	url 		    = 'local.wordpress.dev', // Local Development URL for BrowserSync. Change as-needed.
	build 		    = './temp/buildtheme/', // Files that you want to package into a zip go here
	buildInclude    = [
				// include common file types
				'**/*.php',
				'**/*.html',
				'**/*.css',
				'**/*.js',
				'**/*.svg',
				'**/*.ttf',
				'**/*.otf',
				'**/*.eot',
				'**/*.woff',
				'**/*.woff2',
                '**/*.pot',
                '**/*.mo',
                '**/*.po',
                '**/*.txt',

				// include specific files and folders
				'screenshot.png',

				// exclude files and folders
				'!temp/**/*',
                '!node_modules/**/*',
				'!assets/bower_components/**/*',
				'!style.css.map',
				'!assets/js/custom/*',
				'!assets/css/patrials/*',
                '!gulpfile.js'


			];


var gulp = require("gulp"),
    rimraf = require("rimraf"),
    concat = require("gulp-concat"),
    cssmin = require("gulp-cssmin"),
    uglify = require("gulp-uglify"),
    gulp = require('gulp'),
    clean = require('gulp-clean'),
    sass = require('gulp-sass'),
    rename = require('gulp-rename'),
    plumber = require('gulp-plumber'),
    sourcemaps = require('gulp-sourcemaps'),
    clone = require('gulp-clone'),
    cssnano = require('gulp-cssnano'),
    merge = require('gulp-merge'),
    zip  = require('gulp-zip'),
    wpPot = require('gulp-wp-pot'),
    notify = require('gulp-notify'),
    gulpSequence = require('gulp-sequence')
;

var webroot = "./";

var paths = {
    js: "js/**/*.js",
    minJs: "js/**/*.min.js",
    jsSrc: "js/source/",
    jsDest: "assets/js/",
    css:  "css/**/*.css",
    cssDest: "assets/stylesheets/",
    minCss: "css/**/*.min.css",
    libSrc: "node_modules/",
    libDest: "assets/libs/",
    bootstrapSassSrc: "node_modules/bootstrap/scss/",
    temp: "./temp/"
};

gulp.task("clean:js", function (cb) {
    rimraf(paths.jsDest, cb);
});

gulp.task("clean:css", function (cb) {
    rimraf(paths.CssDest, cb);
});

gulp.task("clean:lib", function (cb) {
    rimraf(paths.libDest, cb);
});

gulp.task("clean:temp", function (cb) {
    rimraf(paths.temp, cb);
});

gulp.task("clean", ["clean:js", "clean:css", "clean:lib", "clean:temp"]);

gulp.task("minify:js", function () {
    return gulp.src([paths.js, "!" + paths.minJs], { base: "." })
        .pipe(concat(paths.concatJsDest))
        .pipe(uglify())
        .pipe(gulp.dest("."));
});

// Copy libs to wwwroot/lib folder
gulp.task("copy:lib", () => {
    gulp.src([
        'moment/min/*.js',
        'font-awesome/fonts'
    ], {
        cwd: paths.libSrc + "/**"
    })
        .pipe(gulp.dest(paths.libDest));
});


// gulp sass - Compiles SCSS files in CSS
gulp.task('sass', function () {
    gulp.src('./sass/*.scss')
        .pipe(plumber())
        .pipe(sass())
        .pipe(gulp.dest(paths.cssDest));
});

// gulp make:css - Make both minified and unminified css from scss. 
gulp.task('make:css', function () {
    var source = gulp.src('./sass/*.scss')
        .pipe(plumber())
        .pipe(sourcemaps.init({ loadMaps: true }))
        .pipe(sass());

    var pipe1 = source.pipe(clone())
        .pipe(sourcemaps.write(undefined, { sourceRoot: null }))
        .pipe(gulp.dest(paths.cssDest));

    var pipe2 = source.pipe(clone())
        .pipe(cssnano())
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest(paths.cssDest));

    return merge(pipe1, pipe2);
});

// gulp make:js - Uglifies and concat all JS files into one
gulp.task('make:js', function () {
    gulp.src([
        paths.libSrc + 'jquery/dist/jquery.min.js',
        paths.libSrc + 'popper.js/dist/popper.min.js',
        paths.libSrc + 'bootstrap/dist/js/bootstrap.min.js',
        paths.libSrc + 'moment/min/moment.min.js',
        paths.libSrc + 'moment/locale/nb.js',
        paths.jsSrc + 'skip-link-focus-fix.js',
        paths.jsSrc + 'comment-reply.min.js',
        paths.jsSrc + 'wp-embed.min.js'

    ])
        .pipe(concat('positor.min.js'))
        //.pipe(uglify())
        .pipe(gulp.dest(paths.jsDest));

    gulp.src([
        paths.libSrc + 'jquery/dist/jquery.js',
        paths.libSrc + 'popper.js/dist/umd/popper.js',
        paths.libSrc + 'bootstrap/dist/js/bootstrap.js',
        paths.libSrc + 'moment/moment.js',
        paths.libSrc + 'moment/locale/nb.js',
        paths.jsSrc + 'skip-link-focus-fix.js',
        paths.jsSrc + 'comment-reply.min.js',
        paths.jsSrc + 'wp-embed.min.js'
    ])
        .pipe(concat('positor.js'))
        .pipe(gulp.dest(paths.jsDest));
});

// gulp build:pot - Make .pot file for translation
gulp.task('build:pot', function () {
    return gulp.src('**/*.php')
        .pipe(wpPot( {
            domain: 'positor'
        } ))
        .pipe(gulp.dest('languages/positor.pot'));
});

 /**
  * Build task that moves essential theme files for production-ready sites
  *
  * build:theme copies all the files in buildInclude to build folder - check variable values at the top
  */

  gulp.task('build:theme', function() {
  	return 	gulp.src(buildInclude)
  		.pipe(gulp.dest(build))
  		.pipe(notify({ message: 'Copy from buildFiles complete', onLast: true }));
  });

   /**
  * Zipping build directory for distribution
  *
  * Taking the build folder, which has been cleaned, containing optimized files and zipping it up to send out as an installable theme
 */
 gulp.task('build:zip', function () {
 	return 	gulp.src(build+'/**/')
 		.pipe(zip(project+'.zip'))
 		.pipe(gulp.dest(paths.temp))
 		.pipe(notify({ message: 'Zip task complete', onLast: true }));
 });

 gulp.task('build', gulpSequence('clean:temp', 'make:css', 'build:pot', 'build:theme', 'build:zip'));
