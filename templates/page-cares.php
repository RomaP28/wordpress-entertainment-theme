<?php
/** Template name: Cares */

add_filter('body_class', function($classes) {
    return array_merge($classes, ['about cares']);
});

$pageID = get_the_ID();
$caresFields = get_fields($pageID);
$posts = get_locations();

get_header(); ?>

    <div class="banner">
        <div class="container">
            <div class="subtitle"><?php echo get_bloginfo(); ?></div>
            <?php if(isset($caresFields['apex_cares_logo'])) { ?>
                <img src="<?php echo $caresFields['apex_cares_logo']; ?>" alt="apex-cares">
            <?php } ?>
        </div>
    </div>
    <div class="container">
        <div class="section cares about-cares">
            <div class="content">
                <?php if(isset($caresFields['content']) && !empty($caresFields['content'])) {
                    echo $caresFields['content'];
                } ?>
            </div>
            <?php if(!empty($caresFields['logo_carousel'])) { ?>
                <div class="logo-carousel" id="logo-carousel">
                    <h5>Partnerships</h5>
                    <?php if(count($caresFields['logo_carousel']) < 2){ ?>
                        <div class="single-logo">
<!--                            --><?php //p($caresFields['logo_carousel']); ?>
                        <?php if(isset($caresFields['logo_carousel'][0]['link']) && !empty($caresFields['logo_carousel'][0]['link'])) { ?>
                            <a href="<?php echo $caresFields['logo_carousel'][0]['link']; ?>" target="_blank">
                                <img src="<?php echo get_repeater_images($pageID, 'logo_carousel', 'img')[0]; ?>" alt="logo">
                            </a>
                        <?php } else { ?>
                            <img src="<?php echo get_repeater_images($pageID, 'logo_carousel', 'img')[0]; ?>" alt="logo">
                        <?php } ?>
                        </div>
                    <?php } else { ?>
                    <div class="logo-swiper">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <?php foreach ($caresFields['logo_carousel'] as $key => $slide) {
                                    if(!empty(get_repeater_images($pageID, 'logo_carousel', 'img')[$key])) { ?>
                                        <div class="swiper-slide">
                                            <?php if(isset($slide['link']) && !empty($slide['link'])) { ?>
                                            <a href="<?php echo $slide['link']; ?>" target="_blank">
                                                <img src="<?php echo get_repeater_images($pageID, 'logo_carousel', 'img')[$key]; ?>" alt="logo">
                                            </a>
                                            <?php } else { ?>
                                                <img src="<?php echo get_repeater_images($pageID, 'logo_carousel', 'img')[$key]; ?>" alt="logo">
                                            <?php } ?>
                                        </div>
                                    <?php }
                                } ?>
                            </div>
                        </div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                    <?php } ?>
                </div>
            <?php  } ?>
        </div>
        <div class="section initiatives">
            <h5>Current initiatives</h5>
            <?php if(!empty($caresFields['current_initiatives'])) { ?>
                <?php foreach ($caresFields['current_initiatives'] as $i => $item) { ?>
                        <div class="item <?php if($i % 2) echo 'reverse'; ?>">
                            <div class="img">
                                <img src="<?php echo get_repeater_images($pageID, 'current_initiatives', 'img')[$i]; ?>" alt="apex cares">
                            </div>
                            <div class="text">
                                <?php echo $item['text']; ?>
                            </div>
                        </div>
                <?php } ?>
            <?php } ?>
        </div>
        <div class="section organizations">
            <h5>Organizations we support</h5>
            <div class="wrap">
                <?php if(!empty($caresFields['organizations'])) { ?>
                    <?php foreach ($caresFields['organizations'] as $i => $item) { ?>
                        <img src="<?php echo get_repeater_images($pageID, 'organizations', 'img')[$i]; ?>" alt="apex cares">
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="community">
        <div class="wrap">
            <h5>Community Impact</h5>
            <div class="wrap">
                <?php if(!empty($caresFields['community'])) { ?>
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($caresFields['community'] as $key => $slide) {
                            if(!empty(get_repeater_images($pageID, 'community', 'img')[$key])) { ?>
                                <div class="swiper-slide">
                                    <img src="<?php echo get_repeater_images($pageID, 'community', 'img')[$key]; ?>" alt="logo">
                                </div>
                            <?php }
                        } ?>
                    </div>
                    <div class="bottom-nav">
                    </div>
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php
get_footer();
