<?php
require_once get_template_directory().'/inc/menus/include.php';
require_once get_template_directory().'/inc/post-types/include.php';


function p($arr = null) : void
{
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}

add_theme_support( 'post-thumbnails');

add_filter( 'network-media-library/site_id', function( $site_id ) {
    return 1;
} );

function get_plays(array $filter = []) : array
{
    $params = [
        'post_type' => 'plays',
        'posts_per_page' => -1,
        'orderby' => 'order',
        'order' => 'ASC',
        'post_status' => 'publish'
    ];

    if(!empty($filter)){
        $params = array_merge($params, $filter);
    }

    return get_posts($params);
}

function get_events(array $filter = []) : array
{
    $params = [
        'post_type' => 'events',
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'post_status' => 'publish'
    ];

    if(!empty($filter)){
        $params = array_merge($params, $filter);
    }

    return get_posts($params);
}

function get_locations(array $filter = []) : array
{
    $params = [
        'post_type' => 'locations',
        'posts_per_page' => -1,
        'orderby' => 'order',
        'order' => 'ASC',
        'post_status' => 'publish'
    ];

    if(!empty($filter)){
        $params = array_merge($params, $filter);
    }

    return get_posts($params);
}

function get_media(array $filter = []) : array
{
    $params = [
        'post_type' => 'media posts',
        'posts_per_page' => -1,
        'orderby' => 'order',
        'order' => 'DESC',
        'post_status' => 'publish'
    ];

    if(!empty($filter)){
        $params = array_merge($params, $filter);
    }

    return get_posts($params);
}

function get_press_releases(array $filter = []) : array
{
    $params = [
        'post_type' => 'press releases',
        'posts_per_page' => -1,
        'orderby' => 'order',
        'order' => 'DESC',
        'post_status' => 'publish'
    ];

    if(!empty($filter)){
        $params = array_merge($params, $filter);
    }

    return get_posts($params);
}

function get_main_template(array $filter = []) : array
{
    $params = [
        'post_type' => 'page',
        'post_status' => 'publish',
        'numberposts' => -1,
        'order'    => 'DESC',
        'meta_key' => '_wp_page_template',
        'meta_value' => 'index.php'
    ];

    if(!empty($filter)){
        $params = array_merge($params, $filter);
    }

    return get_posts($params);
}

function get_repeater_images($pageID, $repeater, $imgLabel) {
    $section_object = get_field_object($repeater, $pageID, false);

    $image_key = '';
    foreach ($section_object['sub_fields'] as $sub_field){
        if($sub_field['name'] !== $imgLabel) continue;
        $image_key = $sub_field['key'];
    }

    $arImageValues = [];
    foreach ($section_object['value'] as $k => $image_value){
        $arImageValues[$k] = $section_object['value'][$k][$image_key];
    }
    return $arImageValues;
}