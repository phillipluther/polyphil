<?php
/**
 * This is our top-level page for displaying podcast content, loaded via the
 * slug according to WP convention. 
 *
 * @package WordPress
 * @subpackage Polyphil
 * @since Polyphil 1.0
 */

    // load our header
    get_header(); 
?>

    <div class="content-wrapper container">
        <main class="content">


<?php 
    // if there are posts to display
    if (have_posts()) : 
        $catDetails = get_category_by_slug('podcast');
?>

            <div class="category-details-wrapper row">
                <div class="col-xs-6">

                    <div class="category-details">

                        <h1 class="category-title">
                            About the Podcast
                            <span class="sr-only">on Video Games &amp; Game Culture</span>
                        </h1>

                        <!--img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/blank.png" class="category-image" style="background-image:url(<?php if (function_exists('z_taxonomy_image_url')) echo z_taxonomy_image_url(); ?>);"-->

                        <div class="category-description">
                            <?php _e($catDetails->description); ?>
                        </div>

                        <div class="subscribe-links-wrapper small">
                            <?php get_sidebar('podcast-goodies'); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="post-content-wrapper row">

                <h2 class="col-xs-6 podcast-listings sr-only">Podcast Episodes: Commentary on Games and Game Culture</h2>
<?php
        $i = 0;
        while (have_posts()) : the_post();

            $customFields = get_post_meta($post->ID);
            $postThumbnail = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
            $epNumber = $customFields['episode_number'][0];
?>

                <div class="col-xs-6 col-sm-3 col-md-2">

                    <a href="<?php _e(esc_url(get_permalink())); ?>" class="post-link-wrapper" title="Listen Now: <?php the_title(); ?>">
                        <h3 class="post-title"><?php the_title(); ?></h3>
                        <p class="post-details">
                            <small class="episode-number">Episode <?php _e($epNumber); ?></small>
                            |
                            <small class="timestamp"><?php the_time('F jS, Y'); ?></small>
                        </p>

                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/blank.png" class="post-thumbnail" style="background-image:url(<?php _e($postThumbnail); ?>);">
                        <span class="fa fa-microphone post-icon"></span>
                    </a>
                </div>
<?php
            $i++;
            if ($i % 2 === 0) {
                _e('<div class="clearfix visible-sm "></div>');

            } else if ($i % 3 === 0) {
                _e('<div class="clearfix visible-lg visible-md"></div>');
            }

        endwhile;

    // if no posts were found, show the "empty" content partial. NOTE! this is
    // not a 404; the page exists ... there's simply no content.
    else :
        get_template_part('content', 'empty');
    endif;
?>

            </div>
        </main>
    </div>

<?php
    // load our universal footer
    get_footer(); 

    // eof
