<?php
/** Template name: X Card */

add_filter('body_class', function($classes) {
    return array_merge($classes, ['location-page x-card']);
});

$xcard = get_fields( get_the_ID() );

get_header(); ?>
<div class="banner">
    <div class="container">
        <?php if(isset($xcard['x-card_title']) && !empty($xcard['x-card_title'])) { ?>
            <h1><?php echo $xcard['x-card_title'] ?></h1>
        <?php } ?>
    </div>
</div>

<div class="container">
    <div class="content-area">
        <div class="text">
            <?php if(isset($xcard['x-card_content_area']) && !empty($xcard['x-card_content_area'])) {
                echo $xcard['x-card_content_area'];
            } if(isset($xcard['check_balance_link']) && !empty($xcard['check_balance_link'])) { ?>
                <a class="btn" target="_blank" href="<?php echo $xcard['check_balance_link'] ?>"><span>Check Your Balance</span></a>
            <?php } ?>
        </div>
        <div class="cards">
            <img src="<?php echo get_template_directory_uri() ?>/assets/img/play-page/Cards.svg" alt="cards">
        </div>
    </div>
</div>

<?php
get_footer('careers');
