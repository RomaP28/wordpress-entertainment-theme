<?php
/** Template name: Play */

add_filter('body_class', function($classes) {
    return array_merge($classes, ['play-page']);
});

$filter = [
    'meta_query' => [['key' => 'show_on_play_page', 'value' => 1, 'compare' => '==']],
    'post_type' => 'Plays',
    'meta_key'  => 'mini_title',
    'orderby'=> 'meta_value',
    'order' => 'ASC'
];
$posts = get_plays($filter);
$arFields = get_fields( get_the_ID() );

get_header(); ?>

    <div class="banner">
        <div class="container">
            <h1 class="hidden"><?php echo $arFields['title'] ?></h1>
            <video class="bg-video" playsinline autoplay loop muted>
                <source src="<?php echo get_template_directory_uri() ?>/assets/video/play-compressed.mp4" type="video/mp4" />
            </video>
            <div class="bg-text" style="background-image: url('<?php echo wp_get_attachment_image_src($arFields['background'], $size = 'full')[0] ?>');"></div>
            <?php if(isset($arFields['mobile_background']) && !empty($arFields['mobile_background'])) { ?>
                <div class="bg-text mobile-only" style="background-image: url('<?php echo wp_get_attachment_image_src($arFields['mobile_background'], $size = 'full')[0] ?>');"></div>
            <?php } else { ?>
                <div class="bg-text mobile-only" style="background-image: url('<?php echo get_template_directory_uri() ?>/assets/img/4.png');"></div>
            <?php } ?>
            <div class="separated-text">
                <h2><?php echo $arFields['subtitle_left'] ?></h2>
                <p><?php echo $arFields['subtitle_right'] ?></p>
            </div>
        </div>
    </div>

    <div class="what-we-have">
        <div class="container section-title">
            <h2><?php echo $arFields['plays_title']; ?></h2>
            <div class="content">
                <p><?php echo $arFields['plays_subtitile']; ?></p>
            </div>
            <?php if (isset($arFields['pricing_&_restrictions']) && !empty($arFields['pricing_&_restrictions'])) { ?>
                <a target="_blank" rel="noopener" href="<?php echo $arFields['pricing_&_restrictions']; ?>" class="btn">See pricing & restrictions</a>
            <?php } ?>
        </div>

        <div class="content-section desktop-only">
            <?php foreach ($posts as $i => $post) {
                $fields = get_fields($post->ID);  ?>

                <div id="<?php echo $post->post_name; ?>" data-item="<?php echo $i; ?>" class="item <?php
                if (!($i % 3)) {
                    echo 'first';
                } elseif ($i === 2|| $i === 5 || $i === 8) {
                    echo 'end';
                }?>">
                    <div class="expanded-img">
                        <img src="<?php echo wp_get_attachment_image_src($fields['expanded'], $size = 'full')[0] ?>" alt="Preview">
                    </div>
                    <div class="img">
                        <img src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' )[0]; ?>" alt="Preview">
                        <?php if(isset($fields['mini_title']) && !empty($fields['mini_title'])) { ?>
                            <div class="title"><?php echo strtolower($fields['mini_title']) ?><img src="<?php echo get_template_directory_uri() ?>/assets/img/chevron-down.svg" alt="chevron down"></div>
                        <?php } ?>
                    </div>
                    <div class="content">
                        <?php if(isset($fields['mini_description']) && !empty($fields['mini_description'])) { ?>
                            <div class="text"><?php echo $fields['mini_description'] ?></div>
                        <?php } ?>
                    </div>
                    <div data-item-content="<?php echo $i ?>" class="item-content hidden">
                        <a href="javascript:void(0);" class="close"><img src="<?php echo get_template_directory_uri() ?>/assets/img/x-close.svg" alt="Close"></a>
                        <div class="title">
                            <?php if(isset($fields['detail_title']) && !empty($fields['detail_title'])) { ?>
                                <h2><?php echo strtolower($fields['detail_title']) ?></h2>
                            <?php } if(isset($fields['detail_subtitle']) && !empty($fields['detail_subtitle'])) {
                                echo $fields['detail_subtitle'];
                            } if(isset($fields['book_btn']['text']) && !empty($fields['book_btn']['text'])) {  ?>
                                <a href="<?php echo $fields['book_btn']['url']; ?>" target="_blank" rel="noopener" class="btn"><?php echo $fields['book_btn']['text']; ?></span></a>
                            <?php } else {  ?>
                                <a href="javascript:void(0)" onclick="needHelp();" class="btn">Book a Party</span></a>
                            <?php } if(isset($fields['sign_waiver']['text']) && !empty($fields['sign_waiver']['text'])) { ?>
                                <a href="<?php echo $fields['sign_waiver']['url']; ?>" target="_blank" rel="noopener" class="btn waiver"><?php echo $fields['sign_waiver']['text']; ?></span></a>
                            <?php } ?>
                        </div>
                        <div class="info">
                            <div class="info-content">
                                <?php echo $post->post_content ?>
                            </div>
                            <div class="img">
                                <img src="<?php echo wp_get_attachment_image_src($fields['detail_image'], $size = 'full')[0] ?>" alt="Img">
                            </div>
                        </div>
                        <div class="info x-card-block">
                            <div class="img img-small">
                                <img src="<?php echo get_template_directory_uri() ?>/assets/img/play-page/Cards.svg" alt="Cards">
                            </div>
                            <div class="info-content">
                                <h3>Apex Entertainment Fun Pass</h3>
                                <p>All of your winnings are saved electronically on your Apex Entertainment Fun Pass, so no matter how you spend your points or when your card will always reflect a real-time balance. You can even save up your points and keep your game card filled, so with each visit to Apex Entertainment, you walk in ahead. If this isn’t enough motivation to bring your A-game to Apex Entertainment, we don’t know what is!</p>
                                <p><u>Please note: Redemption prizes are not to be re-sold by the winner under any circumstance.</u></p>
                                <a href="https://apexentertainment.myembed.io/login" target="_blank" class="btn">Check Your Balance</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="content-section mobile-only">
            <div class="item last-item-mobile next">
                <div class="mobile-item">
                    <h2>
                        That's it for <br>
                        <?php echo get_bloginfo() ?>!
                    </h2>
                    <a href="javascript:void(0);" class="btn btn-hover-anim"><span>View again</span></a>
                </div>
            </div>
            <?php $reversed = array_reverse($posts);
            foreach ($reversed as $i => $post) {
                $fields = get_fields($post->ID);  ?>
                <div id="<?php echo $post->post_name; ?>" data-item="<?php echo $i ?>" class="item next">
                    <div class="mobile-item">
                        <div class="img">
                            <img src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' )[0]; ?>" alt="Preview">
                            <?php if(isset($fields['mini_title']) && !empty($fields['mini_title'])) { ?>
                                <div class="title"><?php echo $fields['mini_title'] ?><img src="<?php echo get_template_directory_uri() ?>/assets/img/chevron-down.svg" alt="chevron down"></div>
                            <?php } ?>
                        </div>
                        <div class="content">
                            <?php if(isset($fields['mini_description']) && !empty($fields['mini_description'])) { ?>
                                <div class="text"><?php echo $fields['mini_description'] ?></div>
                            <?php } ?>
                        </div>
                        <div data-item-content="<?php echo $i ?>" class="content-inner">
                            <a href="javascript:void(0);" class="close"><img src="<?php echo get_template_directory_uri() ?>/assets/img/x-close.svg" alt="Close"></a>
                            <div class="title">
                                <div class="modal-img">
                                    <img src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' )[0]; ?>" alt="Preview">
                                    <?php if(isset($fields['detail_title']) && !empty($fields['detail_title'])) { ?>
                                    <div class="tit">
                                        <?php echo $fields['detail_title'] ?>
                                    </div>
                                </div>
                                <?php } if(isset($fields['detail_subtitle']) && !empty($fields['detail_subtitle'])) {
                                    echo $fields['detail_subtitle'];
                                } if(isset($fields['book_btn']['text']) && !empty($fields['book_btn']['text'])) {  ?>
                                    <a href="<?php echo $fields['book_btn']['url']; ?>" target="_blank" rel="noopener" class="btn"><?php echo $fields['book_btn']['text']; ?></span></a>
                                <?php } else {  ?>
                                    <a href="javascript:void(0)" onclick="needHelp();" class="btn">Book a Party</span></a>
                                <?php } if(isset($fields['sign_waiver']['text']) && !empty($fields['sign_waiver']['text'])) { ?>
                                    <a href="<?php echo $fields['sign_waiver']['url']; ?>" target="_blank" rel="noopener" class="btn waiver"><?php echo $fields['sign_waiver']['text']; ?></span></a>
                                <?php } ?>
                            </div>
                            <div class="info">
                                <div class="info-content">
                                    <?php echo $post->post_content ?>
                                </div>
                                <div class="img">
                                    <img src="<?php echo wp_get_attachment_image_src($fields['detail_image'], $size = 'full')[0] ?>" alt="Img">
                                </div>
                            </div>
                            <div class="info">
                                <div class="img img-small">
                                    <img src="<?php echo get_template_directory_uri() ?>/assets/img/play-page/Cards.svg" alt="Cards">
                                </div>
                                <div class="info-content">
                                    <h3>Apex Entertainment Fun Pass</h3>
                                    <p>All of your winnings are saved electronically on your Apex Entertainment Fun Pass, so no matter how you spend your points or when your card will always reflect a real-time balance. You can even save up your points and keep your game card filled, so with each visit to Apex Entertainment, you walk in ahead. If this isn’t enough motivation to bring your A-game to Apex Entertainment, we don’t know what is!</p>
                                    <p><u>Please note: Redemption prizes are not to be re-sold by the winner under any circumstance.</u></p>
                                </div>
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

<?php
get_footer();
