/**
 * @file ./src/gulpers/jQuery.task.js
 * @description
 * This file is our task file for including jQuery (managed by Bower) as a
 * theme dependency.
 */

'use strict';

var
    gulp = require('gulp'),
    path = require('path'),
    paths = require('../conf/paths');

//
// A simple task for copying our Bower component file to the vendor/js
// diretory for further processing
//
gulp.task('jquery', function() {

    var
        source = path.join(paths.bower, 'jquery', 'dist', 'jquery.js'),
        destination = path.join(paths.vendorJs);

    gulp.src(source).pipe(gulp.dest(destination));
});