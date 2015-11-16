<?php
/**
 * By Wordpress convention, here's our "core" template file. It loads our
 * universal header and provides the logic/structure/markup for anything
 * that isn't the Home page.
 *
 * @package WordPress
 * @subpackage Polyphil
 * @since Polyphil 1.0
 */

    // load our header
    get_header(); 
?>

    <div class="content-wrapper">
        <main class="content">

<?php 
    // if there are posts to display
    if (have_posts()) : 

        // conditionally use the post title as our H1 for SEO on pages;
        // otherwise, H1 responsibilities are handled by the content itself
        if (is_home() && !is_front_page()) {
?>

            <h1 class="page-title"><?php single_post_title(); ?></h1>

<?php 
        }

        while (have_posts()) : the_post();
            // include the appropriate template partial (Blog, Podcast, etc.)
            get_template_part('content', get_post_format());
        endwhile;

    // if no posts were found, show the "empty" content partial. NOTE! this is
    // not a 404; the page exists ... there's simply no content.
    else :
        get_template_part('content', 'empty');
    endif;
?>

        </main>
    </div>

<?php 
    // load our universal footer
    get_footer(); 

    // @future
    // is it still best-practice to leave PHP files dangling open like this?
    // it was back in the day, but i've been out of the PHP loop (ha, loop! as
    // in, THE loop ... Wordpress joke. sad.) for a long time.

