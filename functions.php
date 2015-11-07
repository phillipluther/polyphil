<?php

function register_menus() {
    register_nav_menus(array(
        'header-menu'   => __('Header Menu'),
        'social-links'  => __('Social Menu')
    ));
}


/*
 * Action Hooks
 */
add_action('init', 'register_menus');

