<?php
/** Template name: Terms and conditions */

add_filter('body_class', function($classes) {
    return array_merge($classes, ['terms-page']);
});

$termsFields = get_fields( get_the_ID() );

get_header(); ?>
    <div class="banner">
        <div class="container">
            <?php if(isset($termsFields['terms_main_title']) && !empty($termsFields['terms_main_title'])) { ?>
                <h1><?php echo $termsFields['terms_main_title']; ?></h1>
            <?php } ?>
        </div>
    </div>

    <div class="container">
        <div class="terms-list">
            <p>Jump to:</p>
            <ul>
                <li><a href="#apex-cards">Apex Cards Terms & Conditions</a></li>
                <li><a href="#sweepstakes-rules">Sweepstakes Rules</a></li>
            </ul>
            <?php the_content(); ?>
            <?php if(isset($termsFields['terms']) && !empty($termsFields['terms'])) {
                echo $termsFields['terms'];
            } ?>
        </div>
  </div>

<?php
get_footer();
