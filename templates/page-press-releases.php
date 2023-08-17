<?php
/** Template name: Press Releases */

add_filter('body_class', function($classes) {
    return array_merge($classes, ['releases']);
});

$pressFields = get_fields( get_the_ID() );
$posts = get_locations();
$media = get_media();
$press_releases = get_press_releases();

get_header(); ?>
    <div class="banner">
        <div class="container">
            <div class="subtitle"><?php echo get_bloginfo(); ?></div>
            <?php if(isset($pressFields['main_title']) && !empty($pressFields['main_title'])) { ?>
                <h1><?php echo $pressFields['main_title']; ?></h1>
            <?php } ?>
        </div>
    </div>
    <section>
        <h5>Apex Ambassadors</h5>
        <div class="ambassadors-slider">
            <?php if(!empty($pressFields['ambassadors'])) { ?>
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($pressFields['ambassadors'] as $key => $slide) {
                            if(!empty(get_repeater_images($pageID, 'ambassadors', 'img')[$key])) { ?>
                                <div class="swiper-slide">
                                        <div class="content">
                                            <img src="<?php echo get_repeater_images($pageID, 'ambassadors', 'img')[$key]; ?>" alt="arcade">
                                            <div class="bottom">
                                                <h3><?php echo $slide['name']; ?></h3>
                                                <?php if(count($slide['tags']) > 0) { ?>
                                                    <ul>
                                                    <?php foreach ($slide['tags'] as $tag) {  ?>

                                                        <li><?php echo $tag['title']; ?></li>

                                                    <?php } ?>
                                                    </ul>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="hover-content">
                                            <video class="bg-video" loop muted poster="<?php echo get_repeater_images($pageID, 'ambassadors', 'img')[$key]; ?>">
                                                <source src="<?php echo get_repeater_images($pageID, 'ambassadors', 'hover_video')[$key]['url']; ?>" type="video/mp4" />
                                            </video>
                                            <img src="<?php echo get_repeater_images($pageID, 'ambassadors', 'img')[$key]; ?>" alt="arcade">
                                        </div>
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
    </section>
    <section>
        <div class="media-press-releases">
            <div class="tabs">
                <p class="active" data-type="media">Media</p>
                <p data-type="press-releases">Press Releases</p>
            </div>
            <div class="tabs-content">
                <div class="active" data-type="media" data-active-page=1>
                <?php if(count($media) > 0) {
                    foreach($media as $item){
                        $media_url = get_fields($item); ?>
                       <div class="media-item">
                           <time><?php echo date("Y F", strtotime($item->post_date)); ?></time>
                           <h4><?php echo $item->post_title; ?></h4>
                           <p><?php echo $item->post_excerpt; ?></p>
                           <?php if($media_url['media']['mime_type'] === 'audio/mpeg') { ?>
                               <a target="_blank" href="<?php echo $media_url['media']['url']; ?>" class="media"><img src="<?php echo get_template_directory_uri() ?>/assets/img/releases-page/headphones.webp" alt="headphones">Listen</a>
                           <?php } else if($media_url['media']['mime_type'] === 'video/mp4') { ?>
                               <a target="_blank" href="<?php echo $media_url['media']['url']; ?>" class="media"><img src="<?php echo get_template_directory_uri() ?>/assets/img/releases-page/play-circle.webp" alt="play">Watch</a>
                           <?php } ?>
                          </div>
                    <?php }
                } ?>
                <div class="pagination">
                    <span class="prev" data-arrow="prev"><img src="<?php echo get_template_directory_uri() ?>/assets/img/releases-page/arrow-left.webp" alt="arrow-prev" data-arrow="prev">Previous</span>
                    <div class="pages"></div>
                    <span class="next" data-arrow="next">Next<img src="<?php echo get_template_directory_uri() ?>/assets/img/releases-page/arrow-right.webp" alt="arrow-next" data-arrow="next"></span>
                </div>
                </div>
                <div data-type="press-releases" data-active-page=1>
                    <?php if(count($press_releases) > 0) {
                        foreach($press_releases as $item){
                            $link = get_fields($item); ?>
                            <div class="media-item">
                                <time><?php echo date("Y F d", strtotime($item->post_date)); ?></time>
                                <h4><?php echo $item->post_title; ?></h4>
                                <?php if(isset($link['link']) && !empty($link['link'])){ ?>
                                <a target="_blank" href="<?php echo $link['link']; ?>" class="link">Read the Press Release<img src="<?php echo get_template_directory_uri() ?>/assets/img/releases-page/arrow-right-orange.webp" alt="arrow"></a>
                                <?php } ?>
                            </div>
                        <?php }
                    } ?>
                    <div class="pagination">
                        <span class="prev" data-arrow="prev"><img src="<?php echo get_template_directory_uri() ?>/assets/img/releases-page/arrow-left.webp" alt="arrow-prev" data-arrow="prev">Previous</span>
                        <div class="pages"></div>
                        <span class="next" data-arrow="next">Next<img src="<?php echo get_template_directory_uri() ?>/assets/img/releases-page/arrow-right.webp" alt="arrow-next" data-arrow="next"></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
get_footer();
