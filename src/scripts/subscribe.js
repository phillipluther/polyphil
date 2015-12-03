/**
 * @file ./src/scripts/subscribe.js
 * @description
 * ...
 */

'use strict';

module.exports = (function() {

    var
        _config = {
            classNames: {
                wrapper: 'widget_powerpress_subscribe',
                button: 'pp-ssb-btn',
                header: 'widget-title',
                icon: 'pp-ssb-ic',
                itunes: 'pp-ssb-itunes',
                android: 'pp-ssb-android',
                rss: 'pp-ssb-rss'
            },
            selectors: {}
        };

    // ensure jQuery is available
    if (typeof $ === 'undefined') {
        console.warn('The Polyphil subscribe module requires jQuery!');

    // extend our _config with selectors from the provided classes
    } else {
        $.each(_config.classNames, function(key, className) {
            _config.selectors[key] = '.' + className;
        });
    }

    /**
     * @function reformButtons
     * @private
     * @param {array} wrapper A jQuery wrapper element for our reformation
     * @param {array} buttons A jQuery "special" array of button elements
     * @description
     * ...
     */
    function reformButtons(wrapper, buttons) {


        $.each(buttons, function(index, button) {

            var
                hook = 'button-' + index,
                $button = $(button),
                iconEl = $('<span/>').addClass('fa'),
                iconClass,
                newText,
                removalClass;

            if ($button.is(_config.selectors.itunes)) {
                iconClass = 'fa-apple';
                removalClass = _config.selectors.itunes;
                newText = ' iTunes';

            } else if ($button.is(_config.selectors.android)) {
                iconClass = 'fa-android';
                removalClass = _config.selectors.android;
                newText = ' Android';

            } else if ($button.is(_config.selectors.rss)) {
                iconClass = 'fa-rss';
                removalClass = _config.selectors.rss;
                newText = ' RSS';
            }

            // toggle our classes and append our FA element
            iconEl.addClass(iconClass);
            $button.removeClass(
                _config.classNames.button + ' ' + removalClass + ' ' + hook
            ).text(newText).prepend(iconEl);

            $button
                .addClass('subscribe-link')
                .appendTo(wrapper);
        });
    }

    /**
     * @function reformHeader
     * @private
     * @param {array} wrapper A jQuery element of our reformation wrapper
     * @param {array} header A jQuery element of our header/title
     * @description
     * ...
     */
    function reformHeader(wrapper, header) {

        var newHeader = $('<span/>').addClass('subscribe-label');

        newHeader
            .text(header.text())
            .prependTo(wrapper);

        header.remove();
    }

    return {

        /**
         * @function init
         * @public
         * @description
         * Our initialization functionality (by Polyphil theme convention),
         * which triggers our class changes in the subscribe buttons and then
         * flags the transition as finished.
         */
        init: function() {

            var
                wrapper = $(_config.selectors.wrapper),
                header = $(_config.selectors.header),
                buttons = $(_config.selectors.button),
                icons = $(_config.selectors.icon);
    
            icons.remove();
            wrapper.children().remove();
            reformButtons(wrapper, buttons);
            reformHeader(wrapper, header);

            wrapper.addClass('subscribe-ready');
        }
    };
})();
