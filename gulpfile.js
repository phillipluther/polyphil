/**
 * @file ./gulpfile.js
 */
'use strict';

var
    gulp        = require('gulp'),
    livereload  = require('gulp-livereload'),
    path        = require('path'),

    paths = require('./src/conf/paths'),
    conf = {
        scripts: {
            sources: {
                app: [
                    path.join(paths.scripts, '**/*.js')
                ],
                vendor: [
                ]
            }
        },
        styles: {
            sources: {
                app: [
                    path.join(paths.styles, '**/*.less'),
                    '!' + path.join(paths.customLess, '**/*.less')
                ],
                vendor: [
                    path.join(paths.customLess, '**/*.less')
                ]
            }
        }
    };

//
// Modular tasks for managing script bundling. these handle packaging of both
// vendor scripts and app scripts and provide the following Gulp tasks:
//
// scripts
// scripts:app
// scripts:lint
// scripts:vendor
//
require('./src/gulpers/scripts.task');

//
// Modular tasks for managing CSS files and compiling Less sheets; provides
// the following Gulp tasks:
//
// styles
// styles:app
// styles:concat
// styles:less
// styles:vendor
//
require('./src/gulpers/styles.task');


//
// The primary build task, which creates production-ready CSS and JS assets
// used in our theme.
//
gulp.task('build', [
    'styles',
    'scripts'
]);

gulp.task('watch', ['build'], function() {
    
    // fire up our reload server
    livereload.listen();

    // js
    gulp.watch(conf.scripts.sources.app, [
        'scripts:app'
    ]);

    // css
    gulp.watch(conf.styles.sources.app, [
        'styles:app'
    ]);

    // vendor CSS (mainly our custom Bootstrap build)
    gulp.watch(conf.styles.sources.vendor, [
        'styles:vendor'
    ]);
});