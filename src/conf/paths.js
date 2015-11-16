/**
 * @file ./src/conf/paths.js
 * @description
 * A configuration object that contains the base paths used throughout our
 * Gulp tasks and theme scripts.
 */

'use strict';

var 
    path = require('path'),
    paths = {

        // top-level folders
        bower:  path.resolve('bower_components'),
        css:    path.resolve('css'),
        fonts:  path.resolve('fonts'),
        images: path.resolve('images'),
        js:     path.resolve('js'),
        src:    path.resolve('src')
    };

// extend our paths based on the core directories defined above
paths.scripts   = path.join(paths.src, 'scripts');
paths.styles    = path.join(paths.src, 'styles');
paths.vendor    = path.join(paths.src, 'vendor');
paths.vendorCss = path.join(paths.vendor, 'css');
paths.vendorJs  = path.join(paths.vendor, 'js');

// external Less files used for customization of vendor builds
paths.customLess = path.join(paths.styles, 'external');

module.exports = paths;