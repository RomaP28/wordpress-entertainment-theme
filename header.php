<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php wp_title();?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1.0, user-scalable=0">
    <meta name="facebook-domain-verification" content="r5cerrx2sjmua45lp2pokbk7yhdwqg" />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
    />

    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/datepicker/zebra_datepicker.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/styles.css?v=<?php echo time() ?>">
    <!-- jquery -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>

    <script src="<?php echo get_template_directory_uri() ?>/assets/js/datepicker/zebra_datepicker.src.js"></script>

    <script src="<?php echo get_template_directory_uri() ?>/apexForm/assets/scripts/jquery.inputmask.js"></script>
    <script src="<?php echo get_template_directory_uri() ?>/apexForm/assets/scripts/inputmask.js"></script>
    <script src="<?php echo get_template_directory_uri() ?>/apexForm/assets/scripts/inputmask.binding.js"></script>
    <script src="<?php echo get_template_directory_uri() ?>/assets/js/index.js?v=<?php echo time() ?>"></script>
    <script src="<?php echo get_template_directory_uri() ?>/assets/js/pagination.js?v=<?php echo time() ?>"></script>

    <?php
    $pages = get_main_template();
    $arFields = get_fields( $pages[0] );
    ?>
</head>
<body <?php body_class(); ?>>
<header>
    <div class="nav">
        <a href="<?php echo get_site_url() ?>" class="logo">
            <img src="<?php echo wp_get_attachment_image_src($arFields['header_logo'], $size = 'full')[0] ?>" alt="Apex logo">
        </a>
        <div class="nav-right">
            <div class="top-nav">
                <div class="location">
                    <?php $location = $arFields['location'];
                        if(isset($location['text_left']) && !empty($location['text_left'])) { ?>
                            <?php echo $location['text_left'] ?>:
                    <?php } ?>
                    <div class="select-location" data-modal-name="locations" id="location-btn"><?php echo get_bloginfo() ?>  <img src="<?php echo get_template_directory_uri() ?>/assets/img/chevron-down.svg" alt="chevron down"></div>
                    |
                    <a href="<?php echo get_site_url() ?>/locations/">&nbsp;HOURS</a>
                </div>
                <div class="links">
                    <?php $top_menu = $arFields['top_menu'];
                    foreach ($top_menu as $menuitem) { ?>
                        <?php if(isset($menuitem['item']) && !empty($menuitem['item'])) { ?>
                            <a href="<?php echo get_site_url() . $menuitem['url'] ?>"><?php echo $menuitem['item'] ?></a>
                        <?php } ?>
                    <?php } ?>
                    <div class="search">
                        <form role="search" method="get" id="searchform" class="searchform" action="<?php echo get_home_url(); ?>">
                            <input class="search-input" type="text" value="" name="s" id="s" autocomplete="off" placeholder="Search Apex">
                            <img class="submit-search" src="<?php echo get_template_directory_uri() ?>/assets/img/search.svg" alt="Search">
                            <input style="display: none" type="submit" id="searchsubmit" value="Search">
                        </form>
                    </div>
                </div>
            </div>
            <div class="bottom-nav">
                <?php wp_nav_menu([
                    'theme_location' => 'header-menu-left',
                    'menu_class' => 'drop-down',
                    'items_wrap' => '%3$s',
                    'container' => false,
                    'walker' => new walkers\Walker_Header_Menu()
                ]); ?>
                <div class="right">
                    <a href="javascript:void(0);" onclick="needHelp('book-a-party');" class="book-party">Book a party</a>
                    <div class="drop-link">
                        <a href="#" class="btn">
                            <span>reservations</span>
                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/chevron-down.svg" alt="chevron down">
                        </a>
                        <?php wp_nav_menu([
                            'theme_location' => 'reservations',
                            'container' => false,
                            'items_wrap' => '%3$s',
                            'walker' => new walkers\Walker_Reservations_Menu()
                        ]); ?>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <div class="nav-mobile ">
        <div class="content">

            <div class="logo-mobile">
                <div class="menu"><img src="<?php echo get_template_directory_uri() ?>/assets/img/menu.svg" alt="Menu"></div>
                <a href="<?php echo get_site_url() ?>" class="logo-mobile-link">
                    <img src="<?php echo wp_get_attachment_image_src($arFields['mobile_logo'], $size = 'full')[0] ?>" alt="APEX">
                </a>
                <div class="menu-search"><img class="submit-search" src="<?php echo get_template_directory_uri() ?>/assets/img/search.svg" alt="Search"></div>
            </div>
            <div class="search-block-menu">
                <form role="search" method="get" id="searchform-mobile" class="searchform" action="<?php echo get_home_url(); ?>">
                    <input class="search-input" type="text" value="" name="s" id="sm" autocomplete="off" placeholder="Search Apex">

                    <button class="submit-search" type="submit" id="searchsubmit-mobile" value="Search"><img  src="<?php echo get_template_directory_uri() ?>/assets/img/search.svg" alt="Search"></button>
                </form>
            </div>
            <div class="location" data-modal-name="locations">
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/location-icon.svg" alt="Location">
                <div class="location-name"><?php echo get_bloginfo() ?></div>
            </div>

            <div class="items">
                <div class="links-list">
                    <a href="javascript:void(0);" onclick="needHelp('book-a-party');" class="link">Book a party</a>
                    <div class="link-title">
                        <div class="title">Reservations<img src="<?php echo get_template_directory_uri() ?>/assets/img/chevron-down.svg" alt="chevron down"></div>
                        <div class="inner-content">
                            <?php wp_nav_menu([
                                'theme_location' => 'reservations',
                                'items_wrap' => '%3$s',
                                'container' => false,
                                'walker' => new walkers\Walker_Mobile_Reservations()
                            ]); ?>
                        </div>
                    </div>

                </div>

                <div class="links-list">
                    <?php wp_nav_menu([
                        'theme_location' => 'header-menu-left',
                        'menu_class' => 'inner-content',
                        'items_wrap' => '%3$s',
                        'container' => false,
                        'walker' => new walkers\Walker_Header_Mobile_Menu()
                    ]); ?>
                </div>

                <div class="links-list">
                    <?php $top_menu = $arFields['top_menu'];
                    foreach ($top_menu as $menuitem) { ?>
                        <?php if(isset($menuitem['item']) && !empty($menuitem['item'])) { ?>
                            <a href="<?php echo get_site_url() . $menuitem['url'] ?>" class="link" ><?php echo $menuitem['item'] ?></a>
                        <?php } ?>
                    <?php } ?>
                </div>

                <div class="links-list">
                    <?php $top_menu = $arFields['bottom_mobile_menu'];
                    foreach ($top_menu as $menuitem) { ?>
                        <?php if(isset($menuitem['item']) && !empty($menuitem['item'])) { ?>
                            <a href="<?php echo get_site_url() . $menuitem['url'] ?>" class="link" ><?php echo $menuitem['item'] ?></a>
                        <?php } ?>
                    <?php } ?>
                </div>

                <div class="close-container">
                    <a href="#" class="close"><img src="<?php echo get_template_directory_uri() ?>/assets/img/x-close.svg" alt="Close"></a>
                </div>
            </div>
        </div>
    </div>
</header>

<main>
