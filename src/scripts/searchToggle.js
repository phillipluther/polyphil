/**
 * @file ./src/scripts/searchToggle.js
 * @description
 * ...
 */

'use strict';

module.exports = (function() {

    var
        _searchForm,
        _isVisible = false;


    /**
     * @function hideSearchForm
     * @private
     * @description
     * ...
     */
    function hideSearchForm() {
        _searchForm.removeClass('toggle-show');
        _isVisible = false;

        $(window).off('resize', hideSearchForm);
    }

    /**
     * @function showSearchForm
     * @private
     * @description
     * ...
     */
    function showSearchForm() {
        _searchForm.addClass('toggle-show');
        _isVisible = true;

        $(window).on('resize', hideSearchForm);
    }

    /**
     * @function toggleSearch
     * @private
     * @description
     * ...
     */
    function toggleSearch() {

        if (_isVisible) {
            hideSearchForm();
        } else {
            showSearchForm();
        }
    }

    return {

        /**
         * @function init
         * @public
         * @description
         * ...
         */
        init: function() {
            _searchForm = $('#searchForm');
            $(document.body).on('click', '.search-toggle', toggleSearch);
        }
    };

})();
