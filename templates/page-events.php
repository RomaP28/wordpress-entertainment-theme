<?php
/** Template name: Events */

global $post;

add_filter('body_class', function($classes) {
    return array_merge($classes, ['events-page']);
});

$posts = get_events();
$arFields = get_fields($post->ID);
$pageID = get_the_ID();

get_header(); ?>
    <div class="hidden">
        <?php p($posts); ?>
    </div>
    <div class="banner">
        <div class="container">
            <div class="subtitle"><?php echo get_bloginfo(); ?></div>
            <?php if(isset($arFields['events_main_title']) && !empty($arFields['events_main_title'])) { ?>
                <h1><?php echo $arFields['events_main_title']; ?></h1>
            <?php } ?>
            <div class="bg-text"></div>
        </div>
    </div>
    <div class="container">
        <div class="together-events">
            <div class="left">
                <?php echo $arFields['content'] ?>
                <p class="anchor"><a href="#events-carousel">See all Event Spaces</a> available in <?php echo get_bloginfo(); ?></p>
            </div>
            <div class="right">
                <p>
                    <?php echo $arFields['contact_form_text'] ?>
                </p>
                <a href="tel:<?php echo $arFields['contact_number'] ?>" class="tel"><?php echo $arFields['contact_number'] ?></a>
                <div class="lines">
                    <div class="line"></div>
                    <span>OR</span>
                    <div class="line"></div>
                </div>
                <div class="buttons">
                    <a href="javascript:void(0);" onclick="needHelp()" class="btn"><span><?php echo $arFields['cta_button'] ?></span></a>
<!--                    <a href="mailto:--><?php //echo $arFields['contact_email'] ?><!--" class="btn btn-transparent"><span>EMAIL INQUIRY</span></a>-->
                </div>
            </div>
        </div>
    </div>
    <div class="events-list">
        <div class="container desktop-list">
            <?php foreach($posts as $i => $post) {
                $partyField = get_fields($post->ID);
                ?>
                <div id="<?php echo $post->post_name; ?>" class="item">
                    <div class="top">
                        <div class="title">
                            <h2><?php echo $post->post_title ?></h2>
                            <p><?php echo $post->post_excerpt ?></p>
                            <a href="">Details <img src="<?php echo get_template_directory_uri() ?>/assets/img/chevron-down-orange.svg" alt="Arrow down"></a>
                        </div>
                        <div class="img">
                            <img src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' )[0]; ?>" alt="<?php echo $post->post_title ?>">
                        </div>
                    </div>
                    <div class="accordion">
                        <div class="content">
                            <a href="javascript:void(0);" class="close"><img src="<?php echo get_template_directory_uri() ?>/assets/img/x-close.svg" alt="Close"></a>
                            <div class="info">
<!--                                --><?php //the_content(); ?>
                                <?php echo wpautop($post->post_content); ?>
<!--                                --><?php //echo $post->post_content ?>
                            </div>
                            <div class="buttons">
                                <?php if(isset($partyField['cta_top_header']) && !empty($partyField['cta_top_header'])) { ?>
                                    <h3><?php echo $partyField['cta_top_header']; ?></h3>
                                <?php }
                                if(isset($partyField['cta_top_btn_text']) && !empty($partyField['cta_top_btn_text'])) { ?>
                                    <?php if (isset($partyField['cta_top_button_type']) && !empty($partyField['cta_top_button_type'])) { ?>
                                    <a href="<?php
                                        switch ($partyField['cta_top_button_type']) {
                                            case 'Link': echo $partyField['cta_top_btn_link']; break;
                                            case 'Email': echo 'mailto:'.$partyField['cta_top_btn_email']; break;
                                            case 'Modal link': echo 'javascript:void(0);'; break;
                                        }?> "
                                       <?php if($partyField['cta_top_button_type'] === 'Modal link') { ?>
                                        onclick="needHelp('<?php echo $partyField['book_your_party'] ?>')"
                                       <?php } ?>
                                        class="btn">
                                        <span><?php echo $partyField['cta_top_btn_text'] ?></span>
                                    </a>
                                <?php }
                                    } ?>
                                <div class="lines <?php
                                echo isset($partyField['cta_bottom_header']) && !empty($partyField['cta_bottom_header']) ? '' : 'hidden' ?>">
                                    <div class="line"></div>
                                    <span>OR</span>
                                    <div class="line"></div>
                                </div>
                                <?php if(isset($partyField['cta_bottom_header']) && !empty($partyField['cta_bottom_header'])) { ?>
                                    <h3><?php echo $partyField['cta_bottom_header'] ?></h3>
                                <?php }
                                if(isset($partyField['cta_bottom_text']) && !empty($partyField['cta_bottom_text'])) { ?>
                                        <?php echo $partyField['cta_bottom_text'] ?>
                                <?php }
                                if(isset($partyField['cta_bottom_btn_text']) && !empty($partyField['cta_bottom_btn_text'])) { ?>
                                <?php if (isset($partyField['cta_bottom_button_type']) && !empty($partyField['cta_bottom_button_type'])) { ?>
                                    <a href="<?php
                                    switch ($partyField['cta_bottom_button_type']) {
                                        case 'Link': echo $partyField['cta_bottom_btn_link']; break;
                                        case 'Email': echo 'mailto:'.$partyField['cta_bottom_btn_email']; break;
                                        case 'Modal link': echo 'javascript:void(0);'; break;
                                    }?> "
                                       <?php
                                       if($partyField['cta_bottom_button_type'] == 'Link')
                                           echo 'target="_blank"';
                                       ?>
                                        <?php if($partyField['cta_bottom_button_type'] === 'Modal link') { ?>
                                            onclick="needHelp('<?php echo $partyField['book_your_party'] ?>')"
                                        <?php } ?>
                                       class="btn btn-transparent">
                                        <span><?php echo $partyField['cta_bottom_btn_text'] ?></span>
                                    </a>
                                <?php }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="container mobile-list">
            <div class="item last-item-mobile next">
                <div class="mobile-item">
                    <h2>
                        That's it for <br>
                        <?php echo get_bloginfo() ?>!
                    </h2>
                    <a href="#" class="btn btn-hover-anim"><span>View again</span></a>
                </div>
            </div>
            <?php $reversed = array_reverse($posts);
                    foreach($reversed as $i => $post) {
                          $partyField = get_fields($post->ID);
                     ?>
                <div id="<?php echo $post->post_name; ?>" class="item next">
                    <div class="mobile-item">
                        <div class="img">
                            <img src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' )[0]; ?>" alt="<?php echo $post->post_title ?>">
                            <div class="title"><?php echo $post->post_title ?><img src="<?php echo get_template_directory_uri() ?>/assets/img/chevron-down.svg" alt="chevron down"></div>
                        </div>
                        <div class="content">
                            <div class="text"><?php echo $post->post_excerpt ?></div>
                        </div>
                        <div class="content-inner">
                            <div class="title"><?php echo $post->post_title ?></div>
                            <div class="info">
                                <?php echo $post->post_content ?>
                            </div>
                            <div class="buttons">
                                <?php if(isset($arFields['get_started']) && !empty($arFields['get_started'])) { ?>
                                    <h3><?php echo $arFields['get_started'] ?></h3>
                                <?php } if(isset($partyField['book_your_party']) && !empty($partyField['book_your_party'])) { ?>
                                    <a <?php if (get_bloginfo() === 'Albany') { ?>
                                        href="/book-a-party/"
                                    <?php } else {?>
                                        href="javascript:void(0);"
                                        onclick="needHelp('<?php echo $partyField['book_your_party'] ?>')"
                                    <?php } ?>
                                        class="btn"><span><?php echo $partyField['book_your_party'] ?></span></a>
                                <?php } ?>
                                <div class="lines">
                                    <div class="line"></div>
                                    <span>OR</span>
                                    <div class="line"></div>
                                </div>
                                <?php if(isset($arFields['contact_us']) && !empty($arFields['contact_us'])) { ?>
                                    <h3><?php echo $arFields['contact_us'] ?></h3>
                                <?php } if(isset($arFields['contact_number']) && !empty($arFields['contact_number'])) { ?>
                                    <p>Call our booking team at <a href="tel:<?php echo $arFields['contact_number'] ?>"><?php echo $arFields['contact_number'] ?></a> or email us:</p>
                                <?php } ?>
                                <a href="mailto:<?php echo $arFields['contact_email'] ?>" class="btn btn-transparent"><span>EMAIL INQUIRY</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <div class="nav-arrows">
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/arrow-right.svg" alt="arrow-left" data-arrow="left">
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/arrow-right.svg" alt="arrow-right" data-arrow="right">
            </div>
        </div>
    </div>

<?php if(!empty($arFields['events_carousel'])) { ?>
    <div class="events-carousel" id="events-carousel">
        <div class="swiper">
            <div class="swiper-wrapper">
            <?php foreach ($arFields['events_carousel'] as $key => $slide) {
                if(!empty(get_repeater_images($pageID, 'events_carousel', 'bg_img')[$key])) { ?>
                <div class="swiper-slide" style="background-image: url(<?php echo get_repeater_images($pageID, 'events_carousel', 'bg_img')[$key]; ?>)">
                    <div class="inner">
                        <?php if(isset($slide['category']) && !empty($slide['category'])) { ?>
                            <p class="category"><?php echo $slide['category']; ?></p>
                        <?php } if(isset($slide['title']) && !empty($slide['title'])) { ?>
                            <p class="title"><?php echo $slide['title']; ?></p>
                        <?php } if(isset($slide['excerpt']) && !empty($slide['excerpt'])) { ?>
                            <p class="excerpt"><?php echo $slide['excerpt']; ?></p>
                        <?php }
                        if($slide['add_link_more'] == 1 && !empty($slide['more_details'])) { ?>
                            <a class="more" href="<?php echo $slide['more_details']; ?>">More details<img src="<?php echo get_template_directory_uri() ?>/assets/img/events-page/arrow-more.webp"></a>
                        <?php } ?>
                    </div>
                </div>
            <?php }
                } ?>
            </div>
            <div class="bottom-nav">
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </div>
<?php  }

get_footer();
