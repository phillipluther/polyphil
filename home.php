<?php
/**
 * This partial is a unique template for the site's home page. We display an
 * intro blurb and provide links to the most recent podcast and blog entry.
 *
 * @package WordPress
 * @subpackage Polyphil
 * @since Polyphil 1.0.0
 */
?>

<div class="home-wrapper">

<?php
    // start a mini-loop to grab the page content
    while (have_posts()) : the_post();
        the_content();
    endwhile;

    if (is_active_sidebar('front-page-widgets')) {
?>

        <div id="widget-area" class="widget-area" role="complementary">
            <?php dynamic_sidebar('front-page-widgets'); ?>
        </div>
<?php
    }
?>

</div>
