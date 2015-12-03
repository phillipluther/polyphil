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

    <div class="content-wrapper container">
        <main class="content row">

            <section class="not-found-wrapper col-xs-6 col-lg-5">
                <div class="not-found">
                    <h1 class="page-title">That Page Doesn't Seem to Exist</h1>
                    <p>You're invited to check out some of the recent posts mentioned below, or try a search to find what you're looking for.</p>

                    <div class="page-content">

                        <div class="search-wrapper">
                            <?php get_search_form(); ?>
                        </div>

                        <h2 class="not-found-heading">Recent Posts</h2>
                        <?php dynamic_sidebar('blog-goodies'); ?>
                    </div>
                </div>
            </section>

        </main>
    </div>

<?php 
    get_footer();

    // eof
