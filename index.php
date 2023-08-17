<?php
/** Template name: Home */

add_filter('body_class', function($classes) {
    return array_merge($classes, ['home-page']);
});

$filter = [
    'meta_query' => [['key' => 'show_on_main_page', 'value' => 1, 'compare' => '==']]
];
$filter_plays = [
    'meta_query' => [['key' => 'show_on_main_page', 'value' => 1, 'compare' => '==']],
    'orderby'=> 'title',
    'order' => 'ASC'
];

$plays = get_plays($filter_plays);
$events = get_events($filter);

usort($events, function($a, $b){
    return (get_fields($a)['order'] - get_fields($b)['order']);
});

$pages = get_main_template();
$pageID = $pages[0]->ID;
$arFields = get_fields($pageID);


get_header(); ?>
    <div class="banner">
        <div class="container">
        <?php $top = $arFields['top_section'];
            if (isset($top['title']) && !empty($top['title'])) { ?>
            <h1 class="hidden"><?php echo $top['title'] ?></h1>
         <?php } if (isset($top['video']) && !empty($top['video'])) { ?>
            <video class="bg-video" playsinline autoplay loop muted>
                <source src="<?php echo wp_get_attachment_url( $top['video']) ? wp_get_attachment_url( $top['video']) : $top['video'] ?>" type="video/mp4" />
            </video>
        <?php } ?>
            <div class="bg-text"></div>
        <?php if (isset($top['subtitle_right']) && !empty($top['subtitle_right'])) { ?>
            <div class="float-text-right"><?php echo $top['subtitle_right'] ?></div>
        <?php } if (isset($top['subtitle_left']) && !empty($top['subtitle_left'])) { ?>
            <div class="float-text-left"><?php echo $top['subtitle_left'] ?> </div>
        <?php } ?>
        </div>
    </div>

    <div class="extraordinary">
        <div class="container">
        <?php $ex = $arFields['extraordinary_section'];
        if (isset($ex['title']) && !empty($ex['title'])) { ?>
            <h2><?php echo $ex['title'] ?> </h2>
        <?php } ?>
            <div class="content">
            <?php if (isset($ex['subtitle']) && !empty($ex['subtitle'])) { ?>
                <p><?php echo $ex['subtitle'] ?></p>
            <?php } if (isset($ex['button']) && !empty($ex['button'])) { ?>
                <div class="drop-link">
                    <div class="btn"><span><?php echo $ex['button'] ?></span> <img src="<?php echo get_template_directory_uri() ?>/assets/img/chevron-down.svg" alt="chevron down"></div>
                    <?php wp_nav_menu([
                        'theme_location' => 'reservations',
                        'container' => false,
                        'items_wrap' => '%3$s',
                        'walker' => new walkers\Walker_Reservations_Menu()
                    ]); ?>
                </div>
            <?php } ?>
            </div>
        </div>
    </div>
    <div class="special-events">
        <div class="container">
            <div class="images">
                <?php $spec = $arFields['special_events'];

                $enabledSpec = array();
                $enabledImg = array();
                for ($i = 0; $i < count($spec); $i++) {
                    if($spec[$i]['display_event'] == 1){
                        array_push($enabledSpec, $spec[$i]);
                        array_push($enabledImg, get_repeater_images($pageID, 'special_events', 'image')[$i]);
                    }
                }

                foreach ($enabledSpec as $key => $specialContent) {
                    $imageValue = $enabledImg[$key]; ?>
                    <div class="img <?php echo $key === 0 ? 'active' : '' ?>" data-pos="<?php echo $key + 1 ?>" data-arows-pos="<?php echo $key + 1 ?>">
                        <img src="<?php echo wp_get_attachment_image_src($imageValue, $size = 'full')[0] ?>" alt="event image">
                    </div>
                <?php } ?>
            </div>
            <div class="nav-arrows">
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/arrow-right.svg" alt="arrow-left" data-arrow="left">
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/arrow-right.svg" alt="arrow-right" data-arrow="right">
            </div>

            <?php foreach ($enabledSpec as $key => $specialEv) {
                $imageValue = $enabledImg[$key]; ?>
                <div class="content" data-pos-content="<?php echo $key + 1 ?>">
                    <div class="title">
                        <h3><?php echo $arFields['special_events_title'] ?></h3>
                    </div>
                    <div class="poster">
                        <img src="<?php echo wp_get_attachment_image_src($imageValue, $size = 'full')[0] ?>" alt="event image">
                    </div>
                    <div class="info">
                        <?php if (isset($specialEv['event_title']) && !empty($specialEv['event_title'])) { ?>
                            <h2><?php echo $specialEv['event_title'] ?></h2>
                        <?php } if (isset($specialEv['text']) && !empty($specialEv['text'])) { ?>
                            <p><?php echo $specialEv['text'] ?></p>
                        <?php } if ($specialEv['add_button']) { ?>
                            <a target="_blank" rel="noopener" href="<?php echo $specialEv['button']['url'] ?>"><?php echo $specialEv['button']['text'] ?> <img src="<?php echo get_template_directory_uri() ?>/assets/img/arrow-right.svg" alt="Arrow"></a>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
            <div class="nav-arrows mob">
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/arrow-right.svg" alt="arrow-left" data-arrow="left">
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/arrow-right.svg" alt="arrow-right" data-arrow="right">
            </div>
        </div>
    </div>
    <div class="slider-360">
        <div class="swiper">
            <div class="swiper-wrapper">
                <?php foreach($plays as $play) {
                    $fields = get_fields($play->ID);
                    ?>
                    <div class="swiper-slide">
                        <a href="<?php echo get_site_url() . '/play/#' . $play->post_name ?>">
                            <div class="content">
                                <img src="<?php echo wp_get_attachment_image_src($fields['main_page_image'], $icon = false)[0] ?>" alt="arcade">
                                <h3><?php echo $play->post_title ?></h3>
                            </div>
                            <div class="hover-content">
                                <video class="bg-video" loop muted poster="<?php echo wp_get_attachment_image_src($fields['main_page_image'], $icon = false)[0] ?>">
                                    <source src="<?php echo wp_get_attachment_url( $fields['hover_video']) ? wp_get_attachment_url( $fields['hover_video']) : $fields['hover_video'] ?>" type="video/mp4" />
                                </video>
                                <img src="<?php echo wp_get_attachment_image_src($fields['main_page_image'], $icon = false)[0] ?>" alt="arcade">
                                <p><?php echo $play->post_excerpt ?></p>
                                <h2><?php echo $play->post_title ?></h2>
                                <div class="blue-text">MORE DETAILS</div>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
    <div class="together">
        <div class="container">
            <div class="content">
                <?php $ev = $arFields['events_section'];
                if (isset($ev['title']) && !empty($ev['title'])) { ?>
                    <h2><?php echo $ev['title'] ?></h2>
                <?php } if (isset($ev['subtitle']) && !empty($ev['subtitle'])) { ?>
                    <p><?php echo $ev['subtitle'] ?></p>
                <?php } if (isset($ev['button']) && !empty($ev['button'])) { ?>
                <a class="btn" href="<?php echo get_site_url() . '/events/' ?>"><span><?php echo $ev['button'] ?></span></a>
                <?php } ?>
            </div>
            <div class="cards">
                <div class="column"></div>
                <div class="column"></div>
                <div class="column"></div>
            </div>
            <script>
                <?php foreach($events as $event) {
                        $eventFields = get_fields($event->ID);

                         if ($eventFields['order'] == 1) {
                            $column = 1;
                         } elseif ($eventFields['order'] == 2 || $eventFields['order'] == 3) {
                            $column = 2;
                         } elseif ($eventFields['order'] >= 4) {
                            $column = 3;
                         } ?>

                document.querySelector(`.column:nth-child(<?php echo $column ?>)`)
                    .insertAdjacentHTML('beforeend', `
                        <div class="item <?php echo $eventFields['order'] == 1 || $eventFields['order'] == 5 ? 'big-height' : '' ?>">
                            <div class="<?php echo $eventFields['hover_color'] ?> bg-linear"></div>
                            <a href="<?php echo get_site_url() . '/events/#' . $event->post_name ?>">
                                <div class="star">
                                    <img src="<?php echo get_template_directory_uri() ?>/assets/img/star.svg" alt="Star">
                                </div>
                                <h3><?php echo $event->post_title ?></h3>
                                <p><?php echo $event->post_excerpt ?></p>
                                <div class="link">DETAILS<img src="<?php echo get_template_directory_uri() ?>/assets/img/arrow-right.svg" alt="Arrow"></div>
                            </a>
                        </div>`)
                <?php } ?>
            </script>
            <div class="cards swiper mobile-slider">
                <div class="swiper-wrapper">

                    <?php foreach($events as $event) {
                        $eventFields = get_fields($event->ID); ?>

                        <div class="swiper-slide item">
                            <div class="<?php echo $eventFields['hover_color'] ?> bg-linear"></div>
                            <a href="<?php echo get_site_url() . '/events/#' . $event->ID ?>">
                                <div class="star">
                                    <img src="<?php echo get_template_directory_uri() ?>/assets/img/star.svg" alt="Star">
                                </div>
                                <h3><?php echo $event->post_title ?></h3>
                                <p><?php echo $event->post_excerpt ?></p>
                                <div class="link">DETAILS<img src="<?php echo get_template_directory_uri() ?>/assets/img/arrow-right.svg" alt="Arrow"></div>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="reviews">

        <div class="swiper">
            <div class="img-quote">
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/Quote.svg" alt="Quote">
            </div>
            <div class="swiper-wrapper">
                <?php $reviews = $arFields['reviews_section'];
                foreach ($reviews as $k => $review) { ?>
                    <?php $img_link = get_repeater_images($pageID,'reviews_section', 'logo')[$k]; ?>
                    <div class="swiper-slide">
                        <div class="content">
                            <?php if(isset($review['place']) && !empty($review['place'])) { ?>
                                <h3><?php echo $review['place'] ?></h3>
                            <?php } if(isset($review['review']) && !empty($review['review'])) { ?>
                                <p><?php echo $review['review'] ?></p>
                            <?php }?>
                            <div>
                                <?php if(isset($review['author']) && !empty($review['author'])) { ?>
                                    <div class="author"><?php echo $review['author'] ?></div>
                                <?php } if(isset($review['position']) && !empty($review['position'])) { ?>
                                    <div class="position desktop-only"><?php echo $review['position'] ?></div>
                                <?php } if(isset($review['place']) && !empty($review['place'])) { ?>
                                    <h3 class="mobile-only"><?php echo $review['place'] ?></h3>
                                <?php } ?>
                            </div>
                            <div class="logo">
                                <img src="<?php echo $img_link ?>" alt="logo">
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>

<?php

get_footer();
