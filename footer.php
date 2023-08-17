<?php

$pages = get_main_template();
$pageID = $pages[0]->ID;
$arFields = get_fields($pageID);

$posts = get_locations();
$sites = get_sites();

?>

<div class="book-event">
    <div class="container">
        <div class="left">
            <?php $book = $arFields['book_section'];
            if(isset($book['title_left']) && !empty($book['title_left'])) { ?>
                <h2><?php echo $book['title_left'] ?></h2>
            <?php } if(isset($book['button_book']) && !empty($book['button_book'])) { ?>
                <a href="javascript:void(0)" onclick="needHelp();" class="btn"><span><?php echo $book['button_book'] ?></span></a>
            <?php } ?>
        </div>
        <div class="middle">
            <div class="line"></div>
            <span>OR</span>
            <div class="line"></div>
        </div>
        <div class="right">
            <?php if(isset($book['title_right']) && !empty($book['title_right'])) { ?>
                <h2><?php echo $book['title_right'] ?></h2>
            <?php } if(isset($book['call_our_booking_team']) && !empty($book['call_our_booking_team'])) { ?>
                <p>Call our booking team at <strong><a href="tel:<?php echo $book['call_our_booking_team'] ?>"><?php echo $book['call_our_booking_team'] ?></a></strong> or email us:</p>
            <?php } if(isset($book['button_email']) && !empty($book['button_email'])) { ?>
                <a href="mailto:<?php echo $book['email_inquiry'] ?>" class="btn btn-transparent"><span><?php echo $book['button_email'] ?></span></a>
            <?php } ?>
        </div>
    </div>
</div>
</main>

<div class="modal hidden" data-modal="events">
    <div class="modal-container">
        <a href="#" class="modal-close">
            <img src="<?php echo get_template_directory_uri() ?>/assets/img/x-close.svg" alt="Close">
        </a>
        <div class="content">

        </div>
    </div>
</div>

<div class="modal <?php echo get_bloginfo() === 'Apex' ? '' : 'hidden' ?>" data-modal="locations">
    <div class="modal-container">
        <div class="modal-logo">
            <img src="<?php echo get_template_directory_uri() ?>/assets/img/featured-icon-modal.svg" alt="Featured">
        </div>
        <a href="#" class="modal-close">
            <img src="<?php echo get_template_directory_uri() ?>/assets/img/x-close.svg" alt="Close">
        </a>

        <h2>Let us point you in the right direction.</h2>
        <h3>FIND YOUR APEX</h3>

        <?php
            foreach ($posts as $key=>$post) {
                    $fields = get_fields($post->ID);
                    $address = substr($fields['address'], 0, strpos($fields['address'], "<br>"));
                    $title = substr($post->post_title, 0, strpos($post->post_title, ","));
                    ?>
                    <label for="<?php echo $key ?>" class="<?php echo $title === get_bloginfo() ? 'checked' : '' ?>">
                        <span class="name"><?php echo $post->post_title ?></span>
                        <span class="address"><?php echo $address ?>  <strong><?php echo $fields['phone'] ?></strong></span>
                        <input type="radio" name="location" id="<?php echo $key ?>" data-location="<?php
                        foreach ($sites as $site) {
                            if(get_blog_details($site->blog_id)->blogname === $title) {
                                echo get_blog_details($site->blog_id)->siteurl;
                            }
                        } ?>" <?php echo $title === get_bloginfo() ? 'checked' : '' ?>>
                    </label>
        <?php } ?>
        <a href="<?php echo get_bloginfo('url') ?>" class="btn" onclick="setLocationInLS();"><span>Continue</span></a>
    </div>
</div>

<div class="modal hidden" data-modal="book">
    <div class="modal-container">
        <a href="javascript:void(0);" class="modal-close">
            <img src="<?php echo get_template_directory_uri() ?>/assets/img/x-close.svg" alt="Close">
        </a>
        <div class="location"><?php echo get_bloginfo(); ?></div>
        <h2>Book a Party</h2>
        <?php echo do_shortcode('[contact-form-7 id="'.WPCF7_ContactForm::get_current()->id.'" title="'.get_bloginfo().' Booking Form"]'); ?>
    </div>
</div>
<?php $currentUrl = get_site_url() ?>
<script>
    const marlborough = document.querySelector('[for="1"]');
    if(marlborough) marlborough.parentNode.insertBefore(marlborough, document.querySelector('.modal-container h3').nextSibling);

    document.querySelectorAll('.modal-container [type="radio"]').forEach(el => el.addEventListener('click', e=>{
        document.querySelector('.modal-container .btn').href = `${e.target.dataset.location}`;
    }))
    function needHelp(title) {
        if(title === 'book-a-party'){
            history.pushState(null, null, `${window.location.href}?book-a-party=yes`);
        }
        const modal_book = document.querySelector('[data-modal="book"]');
        if(title) modal_book.querySelector('h2').textContent = title;
        modal_book.classList.remove('hidden');
    }
    var currentLocationUrl = '<?php echo get_site_url() ?>'
    console.log(currentLocationUrl);
</script>
<footer>
    <div class="gift-card">
        <div class="container">
            <div class="info">
            <?php $gift = $arFields['gift_section'];
            if (isset($gift['title']) && !empty($gift['title'])) { ?>
                <h2><?php echo $gift['title'] ?></h2>
            <?php } if (isset($gift['subtitle']) && !empty($gift['subtitle'])) { ?>
                <p><?php echo $gift['subtitle'] ?></p>
            <?php } ?>
                <div class="buttons">
                    <?php if (isset($gift['button_order']['text']) && !empty($gift['button_order']['text'])) { ?>
                        <a target="_blank" rel="noopener" href="<?php echo $gift['button_order']['url'];?>" class="btn btn-blue"><span><?php echo $gift['button_order']['text'];?></span></a>
                    <?php } if (isset($gift['button_check']['text']) && !empty($gift['button_check']['text'])) { ?>
                        <a target="_blank" rel="noopener" href="<?php echo $gift['button_check']['url'];?>" class="btn btn-transparent"><span><?php echo $gift['button_check']['text'];?></span></a>
                    <?php } ?>
                </div>
            </div>
            <div class="cards">
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/Cards.svg" alt="Fun pass Apex">
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="container">
            <div class="footer-top">
                <div class="content">
                    <?php $form = $arFields['footer_form'];
                    if (isset($form['title']) && !empty($form['title'])) { ?>
                        <h3><?php echo $form['title'] ?></h3>
                    <?php } if (isset($form['subtitle']) && !empty($form['subtitle'])) { ?>
                        <p><?php echo $form['subtitle'] ?></p>
                    <?php } ?>
                </div>

                <span class="redirect-path" data-subscribeform="<?php echo get_site_url() . '/newsletter-sign-up-confirmation/'?>"></span>
                <?php echo do_shortcode('[contact-form-7 id="'.$form['form_id'].'" title="'.get_bloginfo().' Subscribe Form"]'); ?>
            </div>
            <div class="footer-middle">
                <div class="column">
                    <div class="title">PLAY</div>
                    <?php wp_nav_menu([
                        'theme_location' => 'footer-play',
                        'container' => false,
                        'items_wrap' => '%3$s',
                        'walker' => new walkers\Walker_Footer_Menu()
                    ]); ?>
                </div>
                <div class="column">
                    <div class="title">PARTY</div>
                    <?php wp_nav_menu([
                        'theme_location' => 'footer-party',
                        'container' => false,
                        'items_wrap' => '%3$s',
                        'walker' => new walkers\Walker_Footer_Menu()
                    ]); ?>
                </div>
                <div class="column">
                    <div class="title">Company</div>
                    <?php wp_nav_menu([
                        'theme_location' => 'footer-company',
                        'container' => false,
                        'items_wrap' => '%3$s',
                        'walker' => new walkers\Walker_Footer_Menu()
                    ]); ?>
                </div>
                <div class="column">
                    <div class="title">HELP</div>
                    <?php wp_nav_menu([
                        'theme_location' => 'footer-help',
                        'container' => false,
                        'items_wrap' => '%3$s',
                        'walker' => new walkers\Walker_Footer_Menu()
                    ]); ?>
                </div>
                <div class="column">
                    <div class="title">Legal</div>
                    <?php wp_nav_menu([
                        'theme_location' => 'footer-legal',
                        'container' => false,
                        'items_wrap' => '%3$s',
                        'walker' => new walkers\Walker_Footer_Menu()
                    ]); ?>
                </div>

                <?php wp_nav_menu([
                    'theme_location' => 'footer-mobile-menu',
                    'container' => false,
                    'items_wrap' => '%3$s',
                    'walker' => new walkers\Walker_Footer_Mobile_Menu()
                ]); ?>
            </div>
            <div class="footer-bottom">
                    <a href="/" class="logo">
                        <img src="<?php echo wp_get_attachment_image_src($arFields['footer_logo'], $size = 'full')[0] ?>" alt="Apex entertainment">
                    </a>
                <div class="socials">
                    <?php $socials = $arFields['socials'];
                    foreach ($socials as $key => $item) {
                     $newImg = get_repeater_images($pageID, 'socials', 'social_logo_img')[$key]; ?>
                            <a href="<?php echo $item['social_link'] ?>" target="_blank">
                                <img src="<?php echo wp_get_attachment_image_src($newImg, $size = 'full')[0] ?>" alt="social network">
                            </a>
                    <?php } ?>
                </div>
                <div class="copywriting">
                    © <?php echo date('Y') ?> <?php echo $arFields['copyright'] ?>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer();?>
</body>
</html>

