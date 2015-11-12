/**
 * @file src/scripts/subOptions.js
 */
'use strict';

var $ = require('jquery');

module.exports = (function() {

    var
        // these options will be initialized as disabled; when clicked they'll
        // display an error message. we expect the object key to be a class
        // selector and the value to be the user-facing message
        _disabled = {
            'itunes': 'The podcast is pending approval in iTunes. We\'ll be there soon!',
            'google': 'The Google Play podcast directory is not live yet. When it is, we\'ll be there!'
        },
        _subWrapper = $('.subscribe-wrapper'),
        _messageEl = $('<div/>').addClass('message-wrapper'),
        _messagePromise = false;

    /**
     * @function hideMessage
     * @private
     * @description
     * ...
     */
    function hideMessage() {
        _messagePromise = false;
        _messageEl.removeClass('message-show');
        _messageEl.remove();
    }

    /**
     * @function showMessage
     * @private
     * @param {string} message The message text to display
     * @description
     * ...
     */
    function showMessage(message) {
        _messageEl.text(message);

        if (_messagePromise !== false) {
            clearTimeout(_messagePromise);
        } else {
            _subWrapper.append(_messageEl);
        }

        _messagePromise = setTimeout(hideMessage, 6500);
        _messageEl.addClass('message-show');
    }

    /**
     * @function handleClick
     * @private
     * @param {object} e A click event
     * @description
     * ...
     */
    function handleClick(e) {
        var target = $(this);

        e.preventDefault();
        e.stopPropagation();
        
        showMessage(target.data('message'));
    }

    /**
     * @function disableOptions
     * @private
     * @description
     * This method inits our disable functionality, flagging each subscription
     * option with the appropriate class hooks and providing listeners for
     * handling clicks on disabled options.
     */
    function disableOptions() {

        $.each(_disabled, function(selector, message) {
            var optionEl = _subWrapper.find('.' + selector);

            optionEl
                .addClass('sub-option-disabled')
                .data({
                    message: message
                });

            _subWrapper.on('click', '.' + selector, handleClick);
        });
    }

    // auto-init actions
    disableOptions();
})();
