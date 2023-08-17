<?php
/** Template name: Privacy Policy */

add_filter('body_class', function($classes) {
    return array_merge($classes, ['privacy-page']);
});

get_header(); ?>

    <div class="banner">
        <div class="container">
                <h1><?php echo get_the_title( get_the_ID() ); ?></h1>
        </div>
    </div>

    <div class="container">
        <div class="terms-list">
            <?php the_content(); ?>
        </div>
    </div>

<?php
get_footer();
