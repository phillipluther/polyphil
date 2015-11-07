/**
 * @file ./gulpfile.js
 */
'use strict';

var
    // Gulp and Gulp-related plugins
    gulp        = require('gulp'),
    concat      = require('gulp-concat'),
    lint        = require('gulp-eslint'),
    less        = require('gulp-less'),
    livereload  = require('gulp-livereload'),
    minifyCss   = require('gulp-minify-css'),
    sourcemaps  = require('gulp-sourcemaps'),
    uglify      = require('gulp-uglify'),

    // other task-related dependencies
    browserify  = require('browserify'),
    buffer      = require('vinyl-buffer'),
    del         = require('del'),
    path        = require('path'),
    source      = require('vinyl-source-stream'),

    // general pathing for reuse below
    paths = {
        scripts: {
            sources: [
                './src/scripts/**/*.js'
            ],
            dest: './js/',
            entry: './src/scripts/app.js',
            output: 'scripts-bundle.js'
        },
        styles: {
            sources: [
                './src/styles/**/*.less',
                '!./src/styles/*-bundle.less'
            ],
            lessDest: './src/styles/',
            lessBundle: 'styles-bundle.less',
            cssDest: './css/',
            cssBundle: 'styles-bundle.css'
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
// Packaging scripts; we go ahead and uglify even during development since
// everything is sourcemapped.
//
gulp.task('scripts', ['lint'], function() {

    var b = browserify({
        entries: paths.scripts.entry,
        debug: true
    });

    return b.bundle()
        .pipe(source(paths.scripts.output))
        .pipe(buffer())
        .pipe(sourcemaps.init({
            loadMaps: true
        }))
            .pipe(uglify())
            .on('error', handleError)
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(paths.scripts.dest))
        .pipe(livereload());
});

//
// Packaging styles, as with scripts, production'ifying them from the get-go
// with sourcemaps for dev
//
gulp.task('concat-styles', function() {
    return gulp.src(paths.styles.sources)
        .pipe(sourcemaps.init())
        .pipe(concat(paths.styles.lessBundle))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(paths.styles.lessDest));
});

gulp.task('lessify-styles', ['concat-styles'], function() {
    return gulp.src(paths.styles.lessDest + paths.styles.lessBundle)
        .pipe(sourcemaps.init({
            loadMaps: true
        }))
        .pipe(less())
            .on('error', handleError)
        .pipe(minifyCss())
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(paths.styles.cssDest))
        .pipe(livereload());
});

gulp.task('styles', ['lessify-styles'], function() {
    del(paths.styles.lessDest + paths.styles.lessBundle + '*');    
});

//
// linting for code quality/cruft control
//
gulp.task('lint', function() {
    return gulp.src(paths.scripts.sources)
        .pipe(lint({
            config: '.eslintrc'
        }))
        .pipe(lint.format())
        // be a dictator about it; don't pass crappy JS
        .pipe(lint.failOnError());
});

//
// Watchers and helpers for bundling
//
gulp.task('build', [
    'styles',
    'scripts'
]);

gulp.task('watch', ['build'], function() {
    
    // fire up our reload server
    livereload.listen();

    // js
    gulp.watch(paths.scripts.sources, [
        'scripts'
    ]);

    // css
    gulp.watch(paths.styles.sources, [
        'styles'
    ]);
});