<?php
/**
 * Our 404 error page, which is a stand-alone template that loads outside of
 * ./index.php as part of Wordpress's config/handling. As such, we pull in the
 * header and footer and simply provide options for recovery.
 *
 * @package WordPress
 * @subpackage Polyphil
 * @since Polyphil 1.1
 */

    get_header(); 
?>

    <div class="content-wrapper">
        <main class="content">

            <section class="not-found-wrapper">
                <div class="not-found">
                    <header class="page-header">
                        <h1 class="page-title">That Page Doesn't Seem to Exist</h1>
                    </header>

                    <div class="page-content">
                        <p>Not found!</p>

                        <?php get_search_form(); ?>
                    </div>
                </div>
            </section>

        </main>
    </div>

<?php 
    get_footer();

    // eof
