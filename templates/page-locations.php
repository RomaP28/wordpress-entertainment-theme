<?php
/** Template name: Locations */

global $post;

add_filter('body_class', function($classes) {
    return array_merge($classes, ['location-page']);
});

$posts = get_locations();
$sites = get_sites();

get_header(); ?>
    <div class="banner">
        <div class="container">
            <h1><span>APEX</span> LOCATIONS</h1>
        </div>
    </div>

    <div class="container">
        <div class="locations-list">
            <?php foreach ($posts as $post) {
                $fields = get_fields($post->ID);
                ?>
                <div class="item">
                    <div class="map"><a href="<?php echo $fields["map-link"] ?>"><img src="<?php echo $fields["map"] ?>" alt="Map"></a></div>
                    <div class="info">
                        <div class="name"><?php echo $post->post_title ?></div>
                        <div class="address"><?php echo $post->address ?></div>
                        <a href="mailto:<?php echo $post->email ?>" class="mail"><?php echo $post->email ?></a>
                        <a href="tel:<?php echo $post->phone ?>" class="phone"><?php echo $post->phone ?></a>
                    </div>
                    <?php $title = substr($post->post_title, 0, strpos($post->post_title, ",")); ?>
                    <div class="work-time <?php echo $title === get_bloginfo() ? '' : ' hidden' ?>">
                        <div class="head">HOURS<sup>*</sup></div>
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
                    <div class="buttons">
                        <?php $title = substr($post->post_title, 0, strpos($post->post_title, ",")); ?>
                        <a href="<?php foreach ($sites as $site) {
                            if(get_blog_details($site->blog_id)->blogname === $title) {
                                echo get_blog_details($site->blog_id)->siteurl;
                            }
                        } ?>" class="btn <?php echo $title === get_bloginfo() ? 'selected' : 'btn-transparent not-selected' ?>">
                            <span><?php echo $title === get_bloginfo() ? 'SELECTED' : 'SELECT' ?></span>
                        </a>
                    </div>
                </div>
            <?php } ?>
            <div class="item">
                <div class="quote">Hours of operation are subject to change.</div>
            </div>
        </div>
    </div>
    <script>
        var locationBtns = document.querySelectorAll('.locations-list .btn');

        if (locationBtns.length > 0) {
            locationBtns.forEach(el => el.addEventListener('click',e => {
                e.preventDefault();
                let oldUrl = e.target.href || e.target.closest('a').href;
                const newUrl = oldUrl.split('/').pop() ? oldUrl : oldUrl.split('/').slice(0,-1).join('/');
                localStorage.setItem('location', newUrl);
                location.assign(newUrl + '/locations');
            }))
        }
    </script>
<?php
get_footer();
