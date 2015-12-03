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
    <link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri()); ?>/css/styles-app.css">

    <!-- pull in our theme scripts (intentionally blocking!) -->
    <script src="<?php echo esc_url(get_template_directory_uri()); ?>/js/scripts-vendor.js"></script>
    <script src="<?php echo esc_url(get_template_directory_uri()); ?>/js/scripts-app.js"></script>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div class="page-wrapper polyphil">

        <header class="header-wrapper">

<?php
    // capture this here to avoid multiple checks
    $isHome = is_front_page() && is_home();

    // if this is our homepage, use the site title as our H1 for SEO
    if ($isHome) {
?>
            <div class="container">
                <div class="row">
                    <h1 class="home-title col-xs-12">
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="title-link logo text-hide">
                            <?php bloginfo('name'); ?>
                        </a>
                    </h1>

                    <div class="col-xs-12">
                        <h2 class="title-tagline"><?php bloginfo('description'); ?></h2>
                    </div>
                </div>
            </div>

<?php
    } else { // $isHome
?>

            <nav class="navbar navbar-fixed-top">
                <div class="container">

                    <div class="header">
                        <button type="button" class="navbar-toggle collapsed hamburger" data-toggle="collapse" data-target="#primaryNav" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="fa fa-navicon"></span>
                        </button>

                        <div class="navbar-header logo-wrapper">
                            <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                <span class="text-hide">
                                    <?php bloginfo('name'); ?> | 
                                    <?php bloginfo('description'); ?>
                                </span>
                                <span class="logo"></span>
                            </a>
                        </div>

                        <div class="collapse navbar-collapse nav-content" id="primaryNav">

                            <?php wp_nav_menu(array(
                                'menu' => 'primary',
                                'container' => false,
                                'menu_class' => 'nav navbar-nav header-nav',
                                //'theme_location' => 'header-menu',
                                'walker' => new wp_bootstrap_navwalker()
                            )); ?>

<?php
    /*
     * We hardcode a header-specific quick search here, as it's used only in
     * the header and integrated with our Bootstrap nav. All other searches,
     * as in the widgets or on the "no results" page come from searchform.php.
     */
?>

                            <button type="button" id="searchToggle" class="search-toggle visible-sm">
                                <span class="fa fa-search-plus"></span>

                                <span class="sr-only">Search</span>
                            </button>

                            <form method="get" id="searchForm" action="<?php echo home_url() ; ?>/" class="navbar-form navbar-right hidden-sm" role="search">

                                <div class="form-field-wrapper text-field form-group">
                                    <label for="s" class="label">
                                        <span class="sr-only">Search blog entries &amp; podcast content:</span>
                                        <span class="fa fa-search search-icon"></span>
                                    </label>
                                    <input type="text" class="field form-control" placeholder="Search ..." value="<?php echo esc_html($s, 1); ?>" name="s" id="s" />
                                </div>

                                <div class="form-field-wrapper submit-field sr-only">
                                    <button type="submit" class="field btn btn-default">
                                        <span class="fa fa-search"></span>
                                        <span class="text-hide">Go</span>
                                    </button>
                                </div>

                                <a href="javascript:;" class="search-toggle fa fa-times-circle visible-sm">
                                    <span class="sr-only">Close Search</span>
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>

            <!--div class="header-fade"></div-->

<?php
    } // $isHome/els
?>

        </header>

<?php 
    // eof