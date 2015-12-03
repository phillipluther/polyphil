<?php
/**
 * By WP convention, this is our "content" page, handling blog posts, podcasts
 * and any other dynamic content (even pages).
 *
 * For simplicity, indenting is reset on this page so it doesn't flow with the
 * rest of the content if you view source. Breaks my heart ...
 *
 * @package WordPress
 * @subpackage Polyphil
 * @since Polyphil 1.0
 */

    // we'll provide some category-specific hooks to our listings
    $catDetails = get_the_category();
    $catName = strToLower($catDetails[0]->cat_name);

    // grab our album art
    //$albumArt = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
    $customFields = get_post_meta($post->ID);
    $albumArt = $customFields['episode_art'][0];
    $postThumb = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> class="post-wrapper">

        <div class="col-xs-6 col-md-4">

            <div class="post-title-wrapper">
                <?php the_title( '<h1 class="post-title">', '</h1>' ); ?>

                <p class="post-details">
                    <span class="timestamp-wrapper"><?php the_time('F jS, Y'); ?></span>
                </p>
            </div>

            <div class="post-content-wrapper">
                <?php the_content(); ?>
            </div>
        </div>

        <div class="col-xs-6 col-md-2 hidden-sm hidden-xs">
            <div class="supplemental">

                <div class="sr-only">
                    <?php the_excerpt(); ?>
                </div>

<?php
    if ($catName === 'blog') {
        _e('<h3 class="sidebar-title">Recent Posts</h3>');
        dynamic_sidebar('blog-goodies');
?>

        <div class="supplemental-links">
            <a href="#commentsJump" class="comments-jump supplemental-link btn btn-default" title="Jump to comments">
                <span class="fa fa-comments"></span>
                Comments
            </a>

            <a href="/category/blog/feed" class="blog-feed supplemental-link btn btn-default" title="Subscribe to all blog posts">
                <span class="fa fa-rss"></span>
                Subscribe
            </a>
        </div>

<?php
    } else if ($catName === 'podcast') {
?>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/blank.png" class="album-art" alt="<?php the_title(); ?>" style="background-image:url(<?php _e($albumArt); ?>);">
<?php
    }
?>

            </div>
        </div>


<?php
    // include comments if this is a single post and comments aren't disabled
    if (is_single() && comments_open()) {
?>

        <span id="commentsJump"></span>

        <div class="col-xs-6 col-lg-5">
            <div class="comments-wrapper">
                <?php comments_template(); ?>
            </div>
        </div>

<?php
    }
?>

    </article>
<?php
    // eof