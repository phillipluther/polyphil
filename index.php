<?php 
/*
 * @file [polyphil]/index.php
 * @description
 *      A Wordpress-convention file containing our page layout, including the
 *      HTML shell, asset inclusions and the includes for sub-template files.
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <link rel="stylesheet" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
    <link rel="stylesheet" media="all" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/font-awesome.min.css" />
    <link rel="stylesheet" media="all" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/styles-bundle.css" />

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php get_header(); ?>

    <main class="content-wrapper">
        <div class="content">

<?php 
    // if this is our home page, include our home template
    if (is_front_page()) {
        get_template_part('home', 'none');

    // if this is a feed/archive/post, display the posts
    } else if (have_posts()) : while (have_posts()) : the_post(); 
        // {{{
?>

            <div class="post-wrapper">

                <!-- Display the Title as a link to the Post's permalink. -->
                <?php 
                    if (is_single()) { 
                ?>
                        <h1 class="post-title"><?php the_title(); ?></h1>
                <?php
                    } else {
                ?>
                        <h2 class="post-title">
                            <a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h2>
                <?php
                    }
                ?>
                </h2>

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

<?php /*
       * Not using this for now; do something clever with it down the line for
       * making it easy to distinguish blog/podcast entries in results.
       *
                <!-- Display a comma separated list of the Post's Categories. -->
                <p class="metadata">
                    <?php _e('Posted in'); ?> <?php the_category(', '); ?>
                </p>
       */       
?>

                <div class="thumbs-up-down-wrapper">
                    <p class="feedback-title">Feedback:</p>
                    <?=function_exists('thumbs_rating_getlink') ? thumbs_rating_getlink() : ''?>
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
    else : 
        // no posts
?>

            <div class="no-results">
                <p><?php _e('Blerg ... no posts were found.'); ?></p>
            </div>

<?php 
    endif; 
?>

        </div>
    </main>

    <?php get_footer(); ?>

    <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/scripts-bundle.js"></script>
</body>
</html>
