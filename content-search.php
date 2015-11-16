<?php
/**
 * Our WP-convention partial for search results. 
 *
 * @package WordPress
 * @subpackage Polyphil
 * @since Polyphil 1.1
 */
?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <header class="content-header-wrapper">
            <div class="content-header">
                <?php the_title(
                    sprintf('<h2 class="content-title"><a href="%s" class="title-link">', esc_url( get_permalink())), 
                    '</a></h2>'
                ); ?>
            </div>
        </header>

        <div class="content-body-wrapper">
            <div class="content-summary">
                <?php the_excerpt(); ?>
            </div><!-- .entry-summary -->
        </div>

<?php 
    // only show the meta details for posts/podcasts
    if (get_post_type() === 'post') { 
?>

        <footer class="content-footer-wrapper">
            <div class="content-footer">
                <p class="meta-wrapper">
                    <span class="timestamp"><?php the_time('F jS, Y'); ?></span> by 
                    <span class="author"><?php the_author_posts_link(); ?></span>
                </p>
            </div>
        </footer>

<?php 
    }
?>

    </article>

<?php
    // eof
