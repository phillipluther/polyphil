/**
 * @file ./src/gulpers/fonts.task.js
 * @description
 * This file contains the packaging tasks for bundling the site fonts. This
 * bundling system assumes that we're using Google Fonts installed through
 * Bower in the method described here:
 *
 * http://www.cardinalsolutions.com/blog/2015/05/google-fonts-bower-proxy
 *
 */

'use strict';

var
    gulp    = require('gulp'),
    concat  = require('gulp-concat'),
    path    = require('path'),
    del     = require('del'),

    paths = require('../conf/paths'),

    // these fonts will be loaded an incorporated into our builds
    fontPacks = {
        arimo: path.join(paths.bower, 'arimo')
    },

    conf = {
        dest: {
            build: path.join(paths.vendorCss, 'fonts_build'),
            // lame that we have to put fonts in the CSS folder ... limitation
            // of the Bower packaging of Google Fonts
            fonts: paths.css,
            css: paths.vendorCss
        },
        sources: {
            build: path.join(paths.vendorCss, 'fonts_build', '*.css')
        },
        output: 'fonts.css',

        // an array of gulp tasks for copying font .ttf and .css files within
        // our streams; this is to ensure they execute as depedencies within
        // the normal workflows
        copyTasks: []
    };


// copy our font files (.css and .ttf) to the project directory
function createCopyTasks() {
    var
        fonts = Object.keys(fontPacks),
        i,
        font,
        cssFiles,
        ttfFiles;

    for (i = fonts.length; i--; ) {
        font = fonts[i];
        cssFiles = path.join(fontPacks[font], '*.css');
        ttfFiles = path.join(fontPacks[font], '*.ttf');

        gulp.task('fonts:copy:css:' + font, function() {
            return gulp.src(cssFiles)
                .pipe(gulp.dest(conf.dest.build));
        });

        gulp.task('fonts:copy:ttf:' + font, function() {
            return gulp.src(ttfFiles)
                .pipe(gulp.dest(conf.dest.fonts));
        });

        // stash the new tasks in our array
        conf.copyTasks.push('fonts:copy:css:' + font);
        conf.copyTasks.push('fonts:copy:ttf:' + font);

        //copyTasks.push(copyFiles(cssFiles, conf.dest.build));
        //copyTasks.push(copyFiles(ttfFiles, conf.dest.fonts));
    }
}

// execute our dynamically-generated task list for copying over .css and .ttf
// files to our working directories. copyTasks is create when this file is
// loaded
gulp.task('fonts:copy', conf.copyTasks);

// package our CSS files into a single vendor font sheet
gulp.task('fonts:build', ['fonts:copy'], function() {
    return gulp.src(conf.sources.build)
        .pipe(concat(conf.output))
        .pipe(gulp.dest(conf.dest.css));
});

gulp.task('fonts', ['fonts:build'], function() {
    // build our font sheet and copy assets (as dep task), then clean up the
    // build folder
    del(conf.dest.build);
});

// build our conf.copyTasks array
createCopyTasks();