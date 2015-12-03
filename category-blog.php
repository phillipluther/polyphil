<?php
/**
 * This is our top-level page for displaying blog listings, loaded via the
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

        if (is_single() === false) {
?>

            <div class="category-details-wrapper row">
                <div class="col-xs-6">

                    <div class="category-details">
                        <h1 class="category-title sr-only">
                            A Blog About Video Games &amp; Game Culture
                        </h1>

                        <div class="subscribe-links-wrapper small">
                            <span class="subscribe-label">Subscribe:</span>
                            <a href="<?php echo esc_url(home_url('/')); ?>category/blog/feed" title="Subscribe to blog posts by RSS" class="subscribe-link rss">
                                <span class="fa fa-rss"></span>
                                RSS
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="post-content-wrapper row">
<?php
        }

        while (have_posts()) : the_post();

            $customFields = get_post_meta($post->ID);
            $bucketImage = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
            $epNumber = $customFields['episode_number'][0];?>

                <div class="col-xs-6 col-md-4">

                    <h2 class="post-title">
                        <a href="<?php _e(esc_url(get_permalink())); ?>" class="post-link" title="Read More: <?php the_title(); ?>">
                             <?php the_title(); ?>
                         </a>
                    </h2>

                    <p class="post-details">
                        <small class="timestamp-wrapper"><?php the_time('F jS, Y'); ?></small>
                    </p>

                    <div class="post-excerpt">
                        <?php the_excerpt(); ?>
                    </div>

                    <a href="<?php _e(esc_url(get_permalink())); ?>" class="post-cta btn btn-default btn-sm" title="Read More: <?php the_title(); ?>">
                        <span class="fa fa-arrow-circle-right"></span>
                        Read More
                    </a>
                </div>

                <div class="col-xs-6 col-md-2">

                    <div class="supplemental">
                        <?php 
                            _e('<h3 class="sidebar-title">Recent Posts</h3>');
                            dynamic_sidebar('blog-goodies'); 
                        ?>
                    </div>
                </div>

<?php /*
                <div class="xol-xs-6 col-sm-6 col-md-4 col-lg-3">
                    <a href="<?php _e(esc_url(get_permalink())); ?>" class="bucket-wrapper" title="Listen Now: <?php the_title(); ?>">
                        <?php the_title('<h2 class="bucket-title">', '</h2>'); ?>
                        <p class="bucket-episode">Episode <?php _e($epNumber); ?></p>

                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/blank.png" class="bucket-image" alt="<?php the_title(); ?>" style="background-image:url(<?php _e($bucketImage); ?>);">

                        <div class="bucket-btn">
                            <span class="fa fa-microphone"></span>
                            <span class="sr-only">Listen Now</span>
                        </div>
                    </a>
                </div>
                <!--div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 bucket-wrapper">

                    <a href="<?php _e(esc_url(get_permalink())); ?>" class="bucket-link" title="Listen Now: <?php the_title(); ?>">
                        <header class="content-header-wrapper">
                            <div class="content-header">
                                <?php the_title('<h3 class="bucket-title">', '</h3>'); ?>

                                <p class="episode-meta-wrapper">
                                    <span class="episode-number">Episode <?php _e($epNumber); ?></span> | 
                                    <span class="timestamp"><?php the_time('F jS, Y'); ?></span>
                                </p>
                            </div>
                        </header>

                        <div class="content-body-wrapper">

<?php
                            //the_excerpt();
                            _e(sprintf('<span class="bucket-image" style="background-image:url(%s);"></span>', $bucketImage));
?>
                        </div>
                    </a>
                </div-->

<?php
*/
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
