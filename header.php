<?php 
/*
 * @file [polyphil]/header.php
 * @description
 *      This file contains our site's header handling and markup. For clarity,
 *      when I say "header" I mean _actual_ header. Not "the top of what will
 *      be rendered." This defies WP convention a bit, but in my workflow I
 *      think having index.php as a complete HTML layout shell makes a lot
 *      more sense for management and sanity than chopping the thing up into
 *      multiple files, some of which containing opening tags that aren't
 *      closed until 3 files later. </rant>
 *
 *      In this them, index.php contains the entire layout for the page, while
 *      template partials are pulled in and name according to function.
 */
?>

<header class="header-wrapper">
    <div class="header">

        <div class="logo-wrapper">
            <a class="logo" href="<?php echo esc_url(home_url( '/' )); ?>" rel="home">
                <?php bloginfo('name'); ?>
            </a>
<?php /*
            <p class="description">
                <?php bloginfo('description'); ?>
            </p>
*/ ?>
        </div>

        <nav class="nav-wrapper">
            <?php wp_nav_menu(array('theme_location' => 'header-menu')); ?>
        </nav>
    </div>
</header>
