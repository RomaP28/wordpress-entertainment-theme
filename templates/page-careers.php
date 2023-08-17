<?php
/** Template name: Careers */

add_filter('body_class', function($classes) {
    return array_merge($classes, ['about career']);
});

$careersFields = get_fields( get_the_ID() );

$posts = get_locations();
$new_url = '';

get_header(); ?>

    <div class="banner">
        <div class="container">
            <div class="subtitle"><?php echo get_bloginfo(); ?></div>
        <?php if(isset($careersFields['careers_main_title']) && !empty($careersFields['careers_main_title'])) { ?>
            <h1><?php echo $careersFields['careers_main_title']; ?></h1>
        <?php } ?>
        </div>
    </div>

    <div class="container">
        <div class="section">
            <div class="content">
            <?php if(isset($careersFields['careers_title']) && !empty($careersFields['careers_title'])) { ?>
                <h3><?php echo $careersFields['careers_title']; ?></h3>
            <?php } ?>
                <p><?php the_content(); ?></p>

                <div class="location-block">
                    <div class="location-name">
                        LOCATIONS
                        <div class="line"></div>
                    </div>
                    <div class="location">
                        View the latest job openings in:
                    </div>

                    <?php $subFields = get_field_object('careers_links', get_the_ID() );?>
                    <ul>
                        <?php $sites = get_sites();
                        foreach ($posts as $post) {
                            $title = substr($post->post_title, 0, strpos($post->post_title, ","));
                            if($title === get_bloginfo()) continue;
                            ?>
                            <li><a href="<?php
                                    foreach ($subFields['sub_fields'] as $label) {
                                        if($label['label'] === $title){
                                            echo $careersFields['careers_links'][0][$label['name']];
                                        }else{
                                            $new_url = $careersFields['careers_links'][0][$label['name']];
                                        }
                                    }
                                ?>"><?php echo $post->post_excerpt ?></a></li>
                        <?php } ?>
                    </ul>
                </div>

            </div>
            <div class="img">
                <img src="<?php echo wp_get_attachment_image_src($careersFields['careers_image'], $size = 'full')[0] ?>" alt="Image">
            </div>
        </div>
    </div>
<?php
get_footer('footer');
