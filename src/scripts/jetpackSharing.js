/**
 * @file ./src/scripts/jetpackSharing.js
 * @description
 * The Jetpack plugin contains some awesome built-in sharing features for
 * entries, but not a lot of customization in terms of adding class hooks
 * for augmented styling. This script does some little switcheroos to
 * Bootstrap'ify things.
 */

'use strict';

module.exports = (function() {

    // set some tweakable config settings
    var _config = {
        classNames: {
            wrapper: 'post-content-wrapper .sharedaddy',
            newWrapper: 'supplemental',
            button: 'sd-button',
            sendBtn: 'sharing_send',
            cancelBtn: 'sharing_cancel',
            header: 'sd-title'
        },
        // we'll auto-build these from the class names above
        selectors: {}
    };

    // ensure jQuery is available
    if (typeof $ === 'undefined') {
        console.warn('The Polyphil jetpackSharing module requires jQuery!');

    // extend our _config with selectors from the provided classes
    } else {
        $.each(_config.classNames, function(key, className) {
            _config.selectors[key] = '.' + className;
        });
    }

    /**
     * @function toggleButtonClasses
     * @private
     * @param {array} buttons A jQuery "special" array of button elements
     * @description
     * ...
     */
    function toggleButtonClasses(buttons) {

        buttons
            // add our bootstrap classes
            .addClass('btn btn-default btn-sm small')
            // remove the default plugin classes
            .removeClass(_config.classNames.button);
    }

    /**
     * @function toggleHeaderClasses
     * @private
     * @param {array} header A jQuery header element(s) array
     * @description
     * ...
     */
    function toggleHeaderClasses(header) {

        header
            .addClass('entry-action-title small')
            .removeClass('sd-title');
    }

    return {

        /**
         * @function init
         * @public
         * @description
         * Our initialization functionality (by Polyphil theme convention),
         * which triggers our class changes in the sharing buttons and then
         * flags the transition as finished.
         */
        init: function() {

            var 
                wrapper = $(_config.selectors.wrapper),
                buttons = wrapper.find(_config.selectors.button),
                header = wrapper.find(_config.selectors.header);

            toggleButtonClasses(buttons);
            toggleHeaderClasses(header);

            // add our 'ready' hook
            wrapper.addClass('jetpack-sharing-ready');
        }
    };
})();
