<?php
/**
 * A Wordpress-convention file containing our page layout, including the
 * HTML shell, asset inclusions and the includes for sub-template files.
 *
 * It's our "core" file and used as the entry for every page of the site.
 *
 * @package WordPress
 * @subpackage Polyphil
 * @since Polyphil 1.0.0
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
        get_template_part('home');

    // if this is a feed/archive/post, display the posts
    } else if (have_posts()) {
        get_template_part('content');

    } else {
        // no posts
?>

            <div class="no-results">
                <span class="fa fa-frown-o"></span>
                <h2>Looks like that page doesn't exist ...</h2>
                <p>Try using the global nav links above, and if you think this might be an error please give a shout.</p>
            </div>

<?php 
    }
?>

        </div>
    </main>

    <?php get_footer(); ?>

    <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/scripts-bundle.js"></script>
</body>
</html>
