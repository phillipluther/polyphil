/**
 * @file ./src/gulpers/styles.task.js
 * @description
 * Style (Less and CSS) related tasks.
 */

'use strict';

var
    // Gulp-related dependencies
    gulp        = require('gulp'),
    concat      = require('gulp-concat'),
    less        = require('gulp-less'),
    livereload  = require('gulp-livereload'),
    minifyCss   = require('gulp-minify-css'),
    sourcemaps  = require('gulp-sourcemaps'),

    // un-Gulp'ing
    del  = require('del'),
    path = require('path'),

    // the name of our concatenated less bundle containing all of our modular
    // sheets to be compiled
    lessBundle = 'styles-app.less',

    paths = require('../conf/paths'),
    conf = {
        sources: [
            path.join(paths.css, lessBundle)
        ],
        dest: paths.css,
        output: 'styles-app.css',

        less: {
            sources: [
                path.join(paths.styles, '**/*.less'),
                '!' + path.join(paths.customLess, '**/*.less')
            ],
            dest: paths.css,
            output: lessBundle
        },

        vendor: {
            sources: [
                path.join(paths.vendorCss, '*.css')
            ],
            output: 'styles-vendor.css',

            // vendor-specific style tasks; these will be combined into a 
            // single vendor CSS bundle when complete. as such, we expect each
            // of these to output a CSS file placed in the ./src/vendors/css 
            // folder.
            tasks: [
                'bootstrap',
                'fontAwesome',
                'fonts'
            ]
        }
    };

//
// Our module task file specific to building Bootstrap. contains the following
// Gulp tasks:
//
// bootstrap
// bootstrap:build
// bootstrap:less
// bootstrap:js
//
require('./bootstrap.task');

//
// Modular task for managing Font Awesome tasks; contains the following Gulp
// tasks:
//
// fontAwesome
// fontAwesome:css
// fontAwesome:fonts
//
require('./fontAwesome.task');

//
// Modular tasks for managing font packs, Google Font items installed via
// Bower; provides the following Gulp tasks:
//
// fonts
// fonts:build
// fonts:copy
//
require('./fonts.task');


//
// Simple error handler for catching problems and not breaking our pipe.
// @future 
// this is duplicated in scripts.task.js, as well. consider pulling in extra
// module to handle errors (Gulp Utils, maybe) that will bust us out of a
// stream on errors and not kill out watch tasks.
//
function handleError(err) {
    console.log(err.message);
    this.end();
}


//
// package our vendor styles, triggering our dependent tasks defined in the
// conf object above then simply concatenating and minifying them.
//
// we do not include sourcemaps with the vendor CSS bundle
//
gulp.task('styles:vendor', conf.vendor.tasks, function() {

    return gulp.src(conf.vendor.sources)
        .pipe(concat(conf.vendor.output))
        .pipe(minifyCss())
        .pipe(gulp.dest(conf.dest));
});

//
// Packaging styles, as with scripts, production'ifying them from the get-go
// with sourcemaps for dev
//
gulp.task('styles:concat', function() {
    return gulp.src(conf.less.sources)
        .pipe(sourcemaps.init())
        .pipe(concat(conf.less.output))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(conf.less.dest));
});

//
// Lessification of a pre-concatenated build file.
//
gulp.task('styles:less', ['styles:concat'], function() {
    return gulp.src(path.join(conf.less.dest, conf.less.output))
        .pipe(sourcemaps.init({
            loadMaps: true
        }))
        .pipe(less())
            .on('error', handleError)
        .pipe(minifyCss())
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(conf.dest))
        .pipe(livereload());
});

//
// A task for builing the app styles for the theme, which creates a bundle from
// the modular Less files in our ./src/styles directory
//
gulp.task('styles:app', ['styles:less'], function() {
    var cleanUp = path.join(conf.less.dest, conf.less.output);
    del(cleanUp + '*');
});

// our primary "build" task for styles, creating both our app and vendor
// bundles
gulp.task('styles', [
    'styles:app', 
    'styles:vendor'
]);
