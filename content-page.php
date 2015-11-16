<?php
/**
 * This is our partial for displaying page content. "Page" proper ... pages
 * created from within Wordpress. Currently, the only page we're using is
 * home, so this has some specific stuff in it around that purpose.
 *
 * @future
 * If we find the need to display additional pages, look into making this a bit
 * more extensible.
 *
 * @package WordPress
 * @subpackage Polyphil
 * @since Polyphil 1.1
 */
?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <header class="content-header-wrapper">
            <div class="content-header">
                <?php the_title('<h1 class="content-title">', '</h1>'); ?>
            </div>
        </header>

        <div class="content-body-wrapper">
            <?php the_content(); ?>
        </div>

    </article>

<?php
    // eof
