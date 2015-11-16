<?php
/**
 * @package WordPress
 * @subpackage Polyphil
 * @since Polyphil 1.0
 */

function register_menus() {
    register_nav_menus(array(
        'header-menu'   => __('Header Menu')
        //'social-links'  => __('Social Menu')
    ));
}

// initialization of our "side" bars ... side in quotes because it's a single
// column layout and we simply want the functionality.
function init_widgets() {
    register_sidebar( array(
        'name' => __('Front page widgets', 'polyphil'),
        'id' => 'front-page-widgets',
        'description' => __('Our widget container on the Home page', 'polyphil'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar( array(
        'name' => __('Feed management', 'polyphil'),
        'id' => 'feed-widgets',
        'description' => __('Feed and sub actions for our series', 'polyphil'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

}

/*
 * Action Hooks
 */
add_action('init', 'register_menus');
add_action('widgets_init', 'init_widgets');
