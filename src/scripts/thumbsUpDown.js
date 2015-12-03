/**
 * @file ./src/scripts/thumbsUpDown.js
 * @description
 * A simple script for manipulating some classes and CSS hooks for our thumbs
 * up/down plugin, which does not provide the ability to do this via config.
 */

'use strict';

module.exports = (function() {

    var 
        _config = {
            classNames: {
                wrapper: 'watch-action',
                button: 'jlk',
                newWrapper: 'supplemental'
            },
            selectors: {}
        };

    /**
     * @future
     * The classNames -> selector functionality below is duplicated exactly in
     * `src/scripts/jetpackSharing.js` ... this stuff should be consolidated
     * into a higher level util somewhere.
     */

    // ensure jQuery is available
    if (typeof $ === 'undefined') {
        console.warn('The Polyphil thumbsUpDown module requires jQuery!');

    // extend our _config with selectors from the provided classes
    } else {
        $.each(_config.classNames, function(key, className) {
            _config.selectors[key] = '.' + className;
        });
    }

    /**
     * @function toggleButtonClasses
     * @private
     * @param {array} buttons A jQuery array of button elements
     * @description
     * ...
     */
    function toggleButtonClasses(buttons) {
        buttons.addClass('btn btn-default btn-sm feedback-link');
    }

    /**
     * @function renderHeading
     * @private
     * @return {object} A DOM fragment for our section header
     * @description
     * ...
     */
    function renderHeading() {
        var heading = $('<h3/>')
            .addClass('entry-action-title small')
            .text('Feedback');

        return heading;
    }

    return {

        /**
         * @function init
         * @public
         * @description
         * Our initialization functionality (by Polyphil theme convention),
         * which triggers our class changes in the thumbs up/down markup.
         */
        init: function() {

            var
                wrapper = $(_config.selectors.wrapper),
                buttons = $(_config.selectors.button);

            toggleButtonClasses(buttons);

            wrapper
                .prepend(renderHeading())
                .addClass('thumbs-up-down-ready');
        }
    };
})();
