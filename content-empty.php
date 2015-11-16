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
            <div class="content-header">
                <h1 class="content-title">No Results Found</h1>
            </div>
        </header>

        <div class="content-body-wrapper">

<?php 
    if (is_search()) { 
?>

            <p>Nothing matched your search terms. Try again?</p>
            <?php get_search_form(); ?>

<?php 
    } else {
?>

            <p>We're having some trouble finding what you were looking for.</p>
            <?php get_search_form(); ?>

<?php
    }
?>

        </div>
    </section>

<?php
    // eof