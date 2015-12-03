/**
 * @file ./src/scripts/comments.js
 * @description
 * ...
 */

'use strict';

module.exports = (function() {

    /**
     * @function tweakCommentForm
     * @private
     * @description
     * This method makes some CSS and attribute adjustments to our comment
     * form to make things a little less clunky and layout better in
     * accordance with the theme.
     */
    function tweakCommentForm() {

        var
            commentBox = $('.wc-form-wrapper'),
            commentSubmit = commentBox.find('.wc_comm_submit'),
            formGroups = commentBox.find('.wpdiscuz-item'),
            emailField = formGroups.find('[type=email]');

        emailField.attr({
            placeholder: 'Email (Optional)'
        });

        commentSubmit
            .addClass('btn btn-primary')
            .parent('.wc-field-submit')
                .removeClass('wc-field-submit');

    }

    return {

        /**
         * @function init
         * @public
         * @description
         * Our theme-convention initialization method for firing up our
         * comment tweaks.
         */
        init: function() {

            tweakCommentForm();
        }
    };
})();
