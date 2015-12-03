/**
 * @file ./src/scripts/app.js
 * @description
 * Our entry file for the app's script bundle.
 */

'use strict';

var
    jetpackSharing = require('./jetpackSharing'),
    thumbsUpDown = require('./thumbsUpDown'),
    comments = require('./comments'),
    subscribe = require('./subscribe'),
    searchToggle = require('./searchToggle');

module.exports = (function() {

    $(document).ready(function() {
        jetpackSharing.init();
        thumbsUpDown.init();
        comments.init();
        subscribe.init();
        searchToggle.init();
    });
})();
