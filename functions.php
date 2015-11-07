<?php

function register_menus() {
    register_nav_menus(array(
        'header-menu'   => __('Header Menu'),
        'social-links'  => __('Social Menu')
    ));
}

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


/*
 * Action Hooks
 */
add_action('init', 'register_menus');
add_action('init', 'ssp_add_categories_to_podcast');
add_action('pre_get_posts', 'ssp_add_podcast_to_category_archives');
