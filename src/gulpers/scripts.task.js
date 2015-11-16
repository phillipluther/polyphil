/**
 * @file ./src/gulpers/scripts.task.js
 * @description
 * This file is our task for building our JS bundles, both vendor and app.
 */

'use strict';

var
    // Gulp-related dependencies
    gulp        = require('gulp'),
    concat      = require('gulp-concat'),
    lint        = require('gulp-eslint'),
    livereload  = require('gulp-livereload'),
    sourcemaps  = require('gulp-sourcemaps'),
    uglify      = require('gulp-uglify'),

    // misc. deps
    path        = require('path'),
    browserify  = require('browserify'),
    buffer      = require('vinyl-buffer'),
    source      = require('vinyl-source-stream'),

    // our source and base directories for quick-reference
    paths = require('../conf/paths'),
    conf = {
        dest: paths.js,
        app: {
            sources: [
                path.join(paths.scripts, '**/*.js')
            ],
            output: 'scripts-app.js',

            // as we're bundling with Browserify, we need an entry file to
            // bootstrap the build
            entry: path.join(paths.scripts, 'app.js')
        },
        vendor: {
            sources: [
                path.join(paths.vendor, 'js', '*.js')
            ],
            output: 'scripts-vendor.js'
        }
    };

//
// Simple error handler for catching problems and not breaking our pipe.
//
function handleError(err) {
    console.log(err.message);
    this.end();
}

//
// linting for code quality/cruft control
//
gulp.task('scripts:lint', function() {
    return gulp.src(conf.app.sources)
        .pipe(lint({
            config: path.resolve('.eslintrc')
        }))
        .pipe(lint.format())
        // be a dictator about it; don't pass crappy JS
        .pipe(lint.failOnError());
});

//
// Vendor packaging
//
// we simply concat and uglify anything found in the vendor JS file; source
// maps are not provided for vendor files.
//
// NOTE! most (if not all) of the vendor scripts are placed in this folder via
// Gulp tasks from our gulpers. we expect these files to be un-minified.
//
gulp.task('scripts:vendor', function() {
    return gulp.src(conf.vendor.sources)
        .pipe(concat(conf.vendor.output))
        .pipe(uglify())
        .pipe(gulp.dest(conf.dest));
});

//
// App script packagaing
//
// package our app scripts using Browserify; this is modified from the recipe
// found on the project home page for usin Browserify with Gulp.
//
gulp.task('scripts:app', ['scripts:lint'], function() {

    var b = browserify({
        entries: conf.app.entry,

        // trip our debug flag for sourcemapping
        debug: true
    });

    // return our bundle, Gulp-friendly streaming via Vinyl
    return b.bundle()
        .pipe(source(conf.app.output))
        .pipe(buffer())
        .pipe(sourcemaps.init({
            loadMaps: true
        }))
            .pipe(uglify())
            .on('error', handleError)
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(conf.dest))

        // trigger a live reload; as the scripts bundle is manually FTP'd to
        // our Wordpress server we can be cavalier with these knowing they'll
        // never trigger on a "live" server.
        .pipe(livereload());
});

//
// A shortcut task for building both our App and Vendor bundles.
//
gulp.task('scripts', [
    'scripts:vendor',
    'scripts:app'
]);
