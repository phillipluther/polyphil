<?php 
/*
 * @file [polyphil]/home.php
 * @description
 *      This is a unique template for the site's home page.
 */

    // helper function for prettifying the time string from our queries
    function prettifyDate($timeStr) {
        _e(date('F jS, Y', strtotime($timeStr)));
    }

    // grab our categories ... lazily hard-coded, but again - these are "known"
    // categories for the site
    $podcastQuery = new WP_Query('post_type=Podcast&posts_per_page=1');
    $podcastQuery->the_post();
    $recentPodcast = $podcastQuery->posts[0];
    $podcastLink = get_permalink($recentPodcast->ID);

    // get our most recent post ... note that this, like the above, will break if
    // no posts have been made. known, accepted.
    $recentBlog = wp_get_recent_posts(array(
        'posts_per_page' => 1,
        'category_name' => 'Blog'
    ))[0];
    $blogLink = get_permalink($recentBlog['ID']);
?>


<div class="home-wrapper">
    <!--h2 class="page-header">Casual adventures in hardcore gaming.</h2-->

    <p>Hey, guys. Phil/Polygoing here.</p>
    <p>I write and talk about my casual adventures in hardcore gaming. I also make the occasional YouTube video and Tweet from time to time.</p>
    <p class="recent-item-heading">Here's the latest of each:</p>
    <div class="recent-item-wrapper recent-podcast">
        <h2 class="recent-item-title">
            <a href="<?php _e($podcastLink); ?>" class="recent-item-link" title="<?php _e($recentPodcast->post_title); ?>">
                <?php _e($recentPodcast->post_title); ?>
            </a>
        </h2>
        <p class="recent-item-date"><?php prettifyDate($recentPodcast->post_date); ?></p>
        <p class="recent-item-summary"><?php _e($recentPodcast->post_excerpt); ?></p>
        <p class="more-prompt">
            <a class="more-link" href="<?php _e($podcastLink); ?>">
                <span class="fa fa-arrow-circle-right"></span>
                Listen Now
            </a>
        </p>
    </div>

    <div class="recent-item-wrapper recent-blog">
        <h2 class="recent-item-title">
            <a href="<?php _e($blogLink); ?>" class="recent-item-link" title="<?php _e($recentBlog['post_title']); ?>">
                <?php _e($recentBlog['post_title']); ?>
            </a>
        </h2>
        <p class="recent-item-date"><?php prettifyDate($recentBlog['post_date']); ?></p>
        <p class="recent-item-summary"><?php _e($recentBlog['post_excerpt']); ?></p>
        <p class="more-prompt">
            <a class="more-link" href="<?php _e($blogLink); ?>">
                <span class="fa fa-arrow-circle-right"></span>
                Read More
            </a>
        </p>
    </div>
</div>
