<?php
function create_posttypes() {
    register_post_type( 'plays',
        [
            'labels' => [
                'name' => __( 'Play' ),
                'singular_name' => __( 'Plays' )
            ],
            'public' => true,
            'has_archive' => false,
            'rewrite' => ['slug' => 'plays'],
            'supports' => ['title', 'editor', 'thumbnail', 'revisions', 'excerpt', 'page-attributes', 'custom-fields'],
            'show_ui' => true
        ]
    );

    register_post_type( 'events',
        [
            'labels' => [
                'name' => __( 'Event' ),
                'singular_name' => __( 'Events' )
            ],
            'public' => true,
            'has_archive' => false,
            'rewrite' => ['slug' => 'events'],
            'supports' => ['title', 'editor', 'thumbnail', 'revisions', 'excerpt', 'page-attributes', 'custom-fields'],
            'show_ui' => true
        ]
    );

    register_post_type( 'locations',
        [
            'labels' => [
                'name' => __( 'Location' ),
                'singular_name' => __( 'Locations' )
            ],
            'public' => true,
            'has_archive' => false,
            'rewrite' => ['slug' => 'locations'],
            'supports' => ['title', 'editor', 'thumbnail', 'revisions', 'excerpt', 'page-attributes', 'custom-fields'],
            'show_ui' => true
        ]
    );

    register_post_type( 'media posts',
        [
            'labels' => [
                'name' => __( 'Media Posts' ),
                'singular_name' => __( 'Media post' )
            ],
            'public' => true,
            'has_archive' => false,
            'rewrite' => ['slug' => 'media-post'],
            'supports' => ['title', 'editor', 'thumbnail', 'revisions', 'excerpt', 'page-attributes', 'custom-fields'],
            'show_ui' => true
        ]
    );

    register_post_type( 'press releases',
        [
            'labels' => [
                'name' => __( 'Press Releases' ),
                'singular_name' => __( 'Press Release' )
            ],
            'public' => true,
            'has_archive' => false,
            'rewrite' => ['slug' => 'press-releases'],
            'supports' => ['title', 'editor', 'thumbnail', 'revisions', 'excerpt', 'page-attributes', 'custom-fields'],
            'show_ui' => true
        ]
    );
}

add_action( 'init', 'create_posttypes' );