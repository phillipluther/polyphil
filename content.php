<?php
/**
 * This is our content wrapper/handler, which takes care of laying out both
 * category listings and single entries.
 *
 * @package WordPress
 * @subpackage Polyphil
 * @since Polyphil 1.0.0
 */
?>

<?php 
    // create our subscribe links for Blog and Podcast cats; this stuff is
    // coded for now, so in the @future figure out how to abstract it
    if (in_category('Podcast')) { 
        $subscribeTitle = 'Subscribe:';
        $subscribeActions = array(
            'itunes' => array(
                'href' => '/',
                'hook' => 'itunes',
                'text' => 'iTunes'
            ),
            'google' => array(
                'href' => '/',
                'hook' => 'google',
                'text' => 'Google Play'
            ),
            'rss' => array(
                'href' => '/feed/podcast',
                'hook' => 'rss',
                'text' => 'RSS'
            )
        );

    } else if (in_category('Blog')) {
        $subscribeTitle = 'Subscribe:';
        $subscribeActions = array(
            'rss' => array(
                'href' => '/feed',
                'hook' => 'rss',
                'text' => 'RSS'
            )
        );
    }

    // display our subscribe actions at the top of each feed/cat page
    if (is_single() === false) {
        poly_render_subscribe_actions($subscribeTitle, $subscribeActions);
    }

    // start the loop and display our feed/entry
    while (have_posts()) : the_post(); 
    // {{{
?>

        <div class="post-wrapper">

            <!-- Display the Title as a link to the Post's permalink. -->
            <?php if (is_single()) { ?>
                <h1 class="post-title"><?php the_title(); ?></h1>

            <?php } else { ?>
                <h2 class="post-title">
                    <a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h2>
            <?php } ?>

            <!-- Display the date (November 16th, 2009 format) and a link to other posts by this posts author. -->
            <p class="post-details">
                <span class="timestamp"><?php the_time('F jS, Y'); ?></span> by 
                <span class="author"><?php the_author_posts_link(); ?></span>
            </p>

            <!-- Display the Post's content in a div box. -->
            <div class="post">

                <?php 
                    if (is_single()) {
                        the_content(); 
                ?>
                    <div class="thumbs-up-down-wrapper">
                        <p class="feedback-title">Feedback:</p>
                        <?=function_exists('thumbs_rating_getlink') ? thumbs_rating_getlink() : ''?>
                    </div>

                    <?php poly_render_subscribe_actions($subscribeTitle, $subscribeActions); ?>

                <?php
                    } else {

                        // contextual CTA based on blog/podcast; is this extensible?
                        // no way. but it's a purpose-specific, personal template
                        // for doing "known" things so i'm cool with it.
                        the_excerpt();
                        $category = get_the_category();
                        $catName = $category[0]->name;
                        $ctaText = ($catName === 'Blog') ? 'Read More' : 'Listen Now';
                ?>
                        <p class="more-prompt">
                            <a class="more-link" href="<?php echo the_permalink(); ?>">
                                <span class="fa fa-arrow-circle-right"></span>
                                <?php _e($ctaText); ?>
                            </a>
                        </p>
                <?php
                    }
                ?>
            </div>
        </div> <!-- .post-wrapper -->

<?php
    if (is_single()) {
?>
        <h2 class="feedback">Comments &amp; Discussion</h2>
<?php
    }
?>
        <div class="comments-wrapper">
<?php
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
?>
        </div>
<?php
    // }}}
    endwhile; 