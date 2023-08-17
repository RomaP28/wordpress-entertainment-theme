<?php
/** Template name: Newsletter sign-up confirmation */

add_filter('body_class', function($classes) {
    return array_merge($classes, ['privacy-page success-email-page']);
});
$arFields = get_fields( get_the_ID() );

get_header(); ?>

    <div class="banner">
        <div class="container">
            <h1><?php echo $arFields['newsletter_main_title']; ?></h1>
        </div>
    </div>

    <div class="container">
        <div class="terms-list">
            <?php the_content(); ?>
            <a href="#" data-prev="Y" onclick="history.back();" class="btn mt-40">
                <span>Return to last visited page</span>
            </a>
        </div>
    </div>
    <script>
        var prevTitle = localStorage.getItem('pageHeader');
        if (prevTitle) {
            var prevButtonText = document.querySelector('[data-prev="Y"] span');
            prevButtonText.innerHTML = `Return to ${prevTitle} page`;
        }
    </script>
<?php
get_footer();
