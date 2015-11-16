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

// copy our source JS files to build directory
gulp.task('bootstrap:js', function() {
    return gulp.src(conf.sources.js)
        .pipe(gulp.dest(conf.dest.js));
});

// copy our source LESS files to the temporary build directory
gulp.task('bootstrap:less', function() {
    return gulp.src(conf.sources.css)
        .pipe(gulp.dest(conf.dest.less));
});

// lessification and script packaging (via dep task)
gulp.task('bootstrap:build', ['bootstrap:less', 'bootstrap:js'], function() {
    return gulp.src(path.join(conf.dest.less, conf.manifest))
        .pipe(less())
        .pipe(gulp.dest(conf.dest.css));
});

// build and clean up any tmp files
gulp.task('bootstrap', ['bootstrap:build'], function() {
    del(conf.dest.less);
});
