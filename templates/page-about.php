<?php
/** Template name: About */

add_filter('body_class', function($classes) {
    return array_merge($classes, ['about']);
});

$aboutFields = get_fields( get_the_ID() );

$posts = get_locations();

$carFields = get_fields( 418 );


get_header(); ?>
<div class="banner">
    <div class="container">
        <div class="subtitle"><?php echo get_bloginfo(); ?></div>
            <a href="<?php echo get_site_url() ?>/career/" class="join-team">
                <span>We’re hiring!</span>
                Join our team
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/arrow-right.svg" alt="Arrow">
            </a>
    <?php if(isset($aboutFields['about_main_title']) && !empty($aboutFields['about_title'])) { ?>
        <h1><?php echo $aboutFields['about_main_title']; ?></h1>
    <?php } ?>
    </div>
</div>

<div class="container">
        <div class="section">
            <div class="content">
                <?php if(isset($aboutFields['about_title']) && !empty($aboutFields['about_title'])) { ?>
                    <h2><?php echo $aboutFields['about_title']; ?></h2>
                <?php } if(isset($aboutFields['about_subtitle']) && !empty($aboutFields['about_subtitle'])) { ?>
                    <p><?php echo $aboutFields['about_subtitle']; ?></p>
                <?php } ?>
            </div>
            <div class="sidebar">
                <div class="location-name">
                    <?php echo get_bloginfo(); ?>
                    <div class="line"></div>
                </div>
                <?php foreach ($posts as $post) {
                    $title = substr($post->post_title, 0, strpos($post->post_title, ","));
                    if($title === get_bloginfo()) {
                        echo $post->post_content;
                     }
                } ?>
            </div>
        </div>
        <div class="section">
            <div class="content">
            <?php if(isset($aboutFields['content']) && !empty($aboutFields['content'])) {
                echo $aboutFields['content'];
            } ?>
            </div>
            <div class="sidebar">
                <div class="location-name">
                    LOCATIONS
                    <div class="line"></div>
                </div>
                <div class="location">
                    Apex Entertainment also has locations in:
                </div>
                <ul>
                    <?php $sites = get_sites();
                    foreach ($posts as $post) {
                        $title = substr($post->post_title, 0, strpos($post->post_title, ","));
                        if($title === get_bloginfo()) continue;
                        ?>
                        <li><a href="<?php
                            foreach ($sites as $site) {
                                if(get_blog_details($site->blog_id)->blogname === $title) {
                                    echo get_blog_details($site->blog_id)->siteurl.'/about/';
                                }
                            } ?>" "><?php echo $post->post_excerpt ?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
</div>
<?php
get_footer();
