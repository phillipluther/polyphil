<?php
/**
 * By Wordpress convention, this file contains our header ... which includes
 * the HTML <head> element and corresponding <meta> tags. 
 *
 * @package WordPress
 * @subpackage Polyphil
 * @since Polyphil 1.0
 */
?>

<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <title></title>
    <meta name="description" content="">

    <!-- the favicon army! -->
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- pull in our theme stylesheets -->
    <link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri()); ?>/css/styles-vendor.css">
    <link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri()); ?>/css/styles-bundle.css">

    <!-- pull in our theme scripts (blocking!) -->
    <script src="<?php echo esc_url(get_template_directory_uri()); ?>/js/scripts-vendor-bundle.js"></script>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div class="page-wrapper polyphil">

        <header class="header-wrapper">
            <div class="header">

<?php
    // capture this here to avoid multiple checks
    $isHome = is_front_page() && is_home();

    // if this is our homepage, use the site title as our H1 for SEO
    if ($isHome) {
?>

                <h1 class="page-title">
                    <a href="<?php echo esc_url(home_url( '/')); ?>" rel="home" class="title-link">
                        <?php bloginfo('name'); ?>
                        <span class="title-tagline"><?php bloginfo('description'); ?></span>
                    </a>
                </h1>

<?php 
    // if not the home page, the post/page title should be our H1; display the
    // blog title as just another piece of text
    } else { 
?>

                <p class="page-title">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                        <?php bloginfo('name'); ?>
                        <span class="title-tagline"><?php bloginfo('description'); ?></span>
                    </a>
                </p>

<?php 
    }
?>
            </div>

<?php
    // our home page is basically one giant nav menu; don't include it
    if ($isHome === false) {
?>
            <nav class="nav-wrapper">
                <?php wp_nav_menu(array('theme_location' => 'header-menu')); ?>
            </nav>
<?php
    }
?>
        </header>

<?php 
    get_sidebar();

    // eof