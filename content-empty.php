<?php
/**
 * This is our partial for displaying content when there is no content to 
 * display. It's not a 404; it's a "real" page that simply has no results,
 * as when performing a search for gibberish or when a category has no posts.
 *
 * @package WordPress
 * @subpackage Polyphil
 * @since Polyphil 1.1
 */
?>

    <section class="content-empty-wrapper">

        <header class="content-header-wrapper">
            <div class="content-header col-xs-6">
                <h1 class="content-title">No Results Found</h1>
                <p>Drag, I know.</p>
            </div>
        </header>

        <div class="content-body-wrapper">

            <div class="col-xs-6 col-lg-5">
<?php 
    if (is_search()) { 
?>

                <h2 class="subheading try-search-again">Try another search?</h2>
                <p>Nothing came up for your search of <strong><?php echo esc_html($s, 1); ?></strong>. Try searching again for something a little less specific.</p>
                <?php get_search_form(); ?>

<?php 
    } else {
?>

                <h2 class="subheading try-search-again">Try a search?</h2>
                <p>We're having some trouble finding what you were looking for.</p>
                <?php get_search_form(); ?>

<?php
    }
?>

            </div>
        </div>
    </section>

<?php
    // eof