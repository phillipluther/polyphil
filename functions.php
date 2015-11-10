<?php

function register_menus() {
    register_nav_menus(array(
        'header-menu'   => __('Header Menu')
        //'social-links'  => __('Social Menu')
    ));
}

// Seriously Simple Podcasting init functions to include podcasts in the
// blog feed
function ssp_add_categories_to_podcast () {
    register_taxonomy_for_object_type( 'category', 'podcast' );
}

function ssp_add_podcast_to_category_archives( $query ){
    if( is_admin() ) {
        return; 
    }
  
    if( $query->is_tax('category') ) {
        $query->set('post_type', array( 'post', 'podcast' ) );
    }
}

// helper function for rendering Subscribe actions site-wide
function poly_render_subscribe_actions($title, $actions) {

    $markup = '<div class="subscribe-wrapper">' .
        '<p class="subscribe-title">' . $title . '</p>' .
        '<div class="subscribe-actions">';


    foreach ($actions as $action) {
        $markup .= 
            '<a href="' . $action['href'] . '" class="subscribe-action ' . $action['hook'] . '" target="_blank">' .
                $action['text'] . 
            '</a>';
    }

    $markup .= '</div></div>';

    _e($markup);
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
add_action('init', 'ssp_add_categories_to_podcast');
add_action('widgets_init', 'init_widgets');
add_action('pre_get_posts', 'ssp_add_podcast_to_category_archives');
