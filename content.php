<?php
/**
 * By WP convention, this is our "content" page, handling blog posts, podcasts
 * and any other dynamic content (even pages) ... be they single or a feed.
 *
 * For simplicity, indenting is reset on this page so it doesn't flow with the
 * rest of the content if you view source. Breaks my heart ...
 *
 * @package WordPress
 * @subpackage Polyphil
 * @since Polyphil 1.0
 */
?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="content-header-wrapper">
            <div class="content-header">

<?php
    // this is kinda cool; i'd never have found is_single() in the codex and
    // came across this referencing the default WP themes. 
    if (is_single()) {
        the_title('<h1 class="content-title">', '</h1>');

    } else {
        the_title(
            sprintf('<h2 class="content-title"><a href="%s" class="title-link">', esc_url(get_permalink())), 
            '</a></h2>'
        );
    }
?>

                <p class="timestamp-wrapper">
                    <span class="timestamp"><?php the_time('F jS, Y'); ?></span>
                </p>

            </div>
        </header>

        <div class="content-body-wrapper">

<?php
    if (is_single()) {
        the_content();
    } else {
        the_excerpt();
    }
?>
        </div>

        <footer class="content-footer-wrapper">
            <div class="content-footer">
            </div>
        </footer>

<?php
    // include comments if this is a single post and comments aren't disabled
    if (is_single() && comments_open()) {
        comments_template();
    }
?>

    </article>

<?php
    // eof