<?php
/**
 * This is a custom search form for the quick search/advanced search
 * functionality of the theme. Because the stock one is a turd. This one is
 * also customized with Bootstrap classes for our resolution-specific modes.
 *
 * @package WordPress
 * @subpackage Polyphil
 * @since Polyphil 1.1.0
 */
?>

    <form method="get" action="<?php echo home_url() ; ?>/" class="search-form form-inline" role="search">

        <div class="form-field-wrapper text-field form-group">
            <label for="s" class="label sr-only">Search blog entries &amp; podcast content:</label>
            <input type="text" class="field form-control input-lg" name="s" id="s" />
        </div>

        <button type="submit" class="btn btn-primary btn-lg">Search</button>
    </form>