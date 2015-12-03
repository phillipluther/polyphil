/**
 * @file ./src/gulpers/bootstrap.task.js
 * @description
 * This file is our task for building the theme's custom Bootstrap CSS file
 * and copying the require JS files from our Bower source.
 */

'use strict';

var
    gulp = require('gulp'),
    path = require('path'),
    less = require('gulp-less'),
    del  = require('del'),

    // our source and base directories for quick-reference
    paths = require('../conf/paths'),
    bowerBootstrap = path.join(paths.bower, 'bootstrap'),
    conf = {
        dest: {
            less: path.join(paths.vendorCss, 'bootstrap_build'),
            css: paths.vendorCss,
            js: paths.vendorJs
        },
        sources: {
            css: [
                path.join(bowerBootstrap, 'less', '**/*.less'),
                path.join(paths.customLess, 'bootstrap', 'variables.less'),
                // ignore the stock variables file and use our custom one
                '!' + path.join(bowerBootstrap, 'less', 'variables.less')
            ],
            js: path.join(bowerBootstrap, 'dist', 'js', 'bootstrap.js')
        },
        // our build file including the Bootstrap imports
        manifest: 'bootstrap.less'
    };

// copy our source JS files to build directory; we have a separate task for
// including jQuery ... which is a dependency of Bootstrap's JS. if assuming
// jQuery is available becomes problematic, consider pulling it in here as an
// explicity dep.
gulp.task('bootstrap:js', function() {
    return gulp.src(conf.sources.js)
        .pipe(gulp.dest(conf.dest.js));
});

// copy our source LESS files to the temporary build directory
gulp.task('bootstrap:copy', function() {
    return gulp.src(conf.sources.css)
        .pipe(gulp.dest(conf.dest.less));
});

// lessification packaging to create a compiled Bootstrap stylesheet
gulp.task('bootstrap:less', ['bootstrap:copy'], function() {
    return gulp.src(path.join(conf.dest.less, conf.manifest))
        .pipe(less())
        .pipe(gulp.dest(conf.dest.css));
});

// build and clean up any tmp files for our CSS
gulp.task('bootstrap:css', ['bootstrap:less'], function() {
    del(conf.dest.less);
});

// a generic build command that packages both our CSS and JS files
gulp.task('bootstrap', [
    'bootstrap:css', 
    'bootstrap:js'
]);
