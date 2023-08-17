<?php
/** Template name: Contact Us */

global $post;

add_filter('body_class', function($classes) {
    return array_merge($classes, ['location-page']);
});

$posts = get_locations();
$sites = get_sites();

get_header(); ?>
<style>
    .address ul{
        display: none;
    }
</style>
<div class="banner">
    <div class="container">
        <h1>Contact <span>Us</span></h1>
    </div>
</div>
<div class="container">
        <div class="locations-list">
            <?php foreach ($posts as $post) {
                    $title = substr($post->post_title, 0, strpos($post->post_title, ","));
                    if($title === get_bloginfo()) {
                        $fields = get_fields($post->ID);?>
                        <h2>Be in touch with any questions, event inquiries, and anything else about our place and people:</h2>
                        <div class="item">
                            <div class="info">
                                <a href="tel:<?php echo $post->phone ?>" class="phone"><?php echo $post->phone ?></a>
                                <a href="mailto:<?php echo $post->email ?>" class="mail"><?php echo $post->email ?></a>
                                <div class="address"><?php echo get_the_content() ?></div>
                            </div>

                            <div class="work-time">
                                <div class="head">HOURS</div>
                                <div><b>Monday</b></div>
                                <div><?php echo $post->monday ?></div>
                                <div><b>Tuesday</b></div>
                                <div><?php echo $post->tuesday ?></div>
                                <div><b>Wednesday</b></div>
                                <div><?php echo $post->wednesday ?></div>
                                <div><b>Thursday</b></div>
                                <div><?php echo $post->thursday ?></div>
                                <div><b>Friday</b></div>
                                <div><?php echo $post->friday ?></div>
                                <div><b>Saturday</b></div>
                                <div><?php echo $post->saturday ?></div>
                                <div><b>Sunday</b></div>
                                <div><?php echo $post->sunday ?></div>
                                <?php if(isset($fields['apex_kids']) && !empty($fields['apex_kids'])) { ?>
                                    <div><b>Apex Kids</b></div>
                                    <div>
                                        <?php foreach ($fields['apex_kids'] as $item) {?>
                                            <?php  echo $item['apex_kids_value'] ?> <br>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                <?php } ?>
            <?php } ?>
            <p>Looking to work here? Review <a href="<?php echo get_site_url() ?>/career/" class="join-team"><u>current career opportunities in <?php echo get_bloginfo(); ?></u></a></p>
        </div>

    </div>
</div>
<?php
get_footer();
