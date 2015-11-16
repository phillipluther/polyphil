/**
 * @file ./src/gulpers/fontAwesome.task.js
 * @description
 * This file is our task for copying the Font Awesome typefaces and CSS files
 * (managed by Bower) into our working directory.
 */

'use strict';

var
    gulp = require('gulp'),
    path = require('path'),

    paths = require('../conf/paths'),
    bowerFa = path.join(paths.bower, 'font-awesome'),
    conf = {
        dest: {
            fonts: paths.fonts,
            css: path.join(paths.src, 'vendor', 'css')
        },
        sources: {
            fonts: path.join(bowerFa, 'fonts/*.*'),
            css: [
                path.join(bowerFa, 'css/*.css'),
                '!' + path.join(bowerFa, 'css/*.min*')
            ]
        }
    };

// copy our font files to the project directory
gulp.task('fontAwesome:fonts', function() {
    return gulp.src(conf.sources.fonts)
        .pipe(gulp.dest(conf.dest.fonts));
});

// move our distributable Font Awesome CSS to the src folder
gulp.task('fontAwesome:css', function() {
    return gulp.src(conf.sources.css)
        .pipe(gulp.dest(conf.dest.css));
});

// our composite task for performing all actions
gulp.task('fontAwesome', [
    'fontAwesome:fonts',
    'fontAwesome:css'
]);