<?php
/** Template name: Know before you go */

add_filter('body_class', function($classes) {
    return array_merge($classes, ['kbyg']);
});

$knbgFields = get_fields( get_the_ID() );

get_header(); ?>

    <div class="banner">
        <div class="container">
            <?php if(isset($knbgFields['kbyg_title']) && !empty($knbgFields['kbyg_title'])) { ?>
                <h1><?php echo $knbgFields['kbyg_title']; ?></h1>
            <?php } ?>
        </div>
    </div>

    <div class="container kbyg-section">
        <div class="search-block">

            <form role="search" method="get" id="searchform" class="searchform" action="<?php echo get_home_url(); ?>">
                <input class="search-input" type="text" value="" name="s" id="s" autocomplete="off" placeholder="Search FAQs">
                <button class="btn" type="submit"><span>search</span></button>
                <input style="display: none" type="submit" id="searchsubmit" value="Search">
            </form>

        </div>
        <div class="faq">
            <h3>Below are answers to many of the questions our guests have about Apex. If you need information beyond this, <a href="mailto:apexsalesteam@apexentertainment.com" target="_blank" data-type="mailto" data-id="mailto:apexsalesteam@apexentertainment.com" rel="noreferrer noopener">contact a party planner</a> or the <a href="/locations/" data-type="page" data-id="151">location you’re visiting</a>.</h3>
            <div class="tabs">
                <?php foreach ($knbgFields['tabs'] as $i=>$tab) { ?>
                    <?php if (isset($tab['title']) && !empty($tab['title'])) { ?>
                        <div class="tab <?php echo $i === 1 ? 'active' : '' ?>" data-faq-tab="<?php echo $i; ?>"><?php echo $tab['title']; ?></div>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="content">
                <div class="mobile-tabs">
                    <div class="title">CATEGORY</div>
                    <div class="arrow"><img src="<?php echo get_template_directory_uri() ?>/assets/img/chevron-down.svg" alt="Arrow down"></div>
                    <?php foreach ($knbgFields['tabs'] as $i=>$tab) { ?>
                        <?php if (isset($tab['title']) && !empty($tab['title'])) { ?>
                            <div class="tab-mobile <?php echo $i === 1 ? 'active' : '' ?>" data-faq-tab="<?php echo $i; ?>"><?php echo $tab['title']; ?></div>
                        <?php } ?>
                    <?php } ?>
                </div>
                <?php foreach ($knbgFields['tabs'] as $j=>$item) { ?>
                <div class="info <?php echo $j === 1 ? 'active' : '' ?>" data-faq-content="<?php echo $j; ?>">
                    <?php if (isset($item['title']) && !empty($item['title'])) { ?>
                        <h2><?php echo $item['title']; ?></h2>
                    <?php } ?>
                    <div class="accordion">
                        <?php foreach ($item['inner'] as $content) { ?>
                        <div class="item">
                            <?php if (isset($content['question']) && !empty($content['question'])) { ?>
                                <div class="title"><?php echo $content['question']; ?> <img src="<?php echo get_template_directory_uri() ?>/assets/img/chevron-down.svg" alt="Down"></div>
                            <?php } ?>
                            <div class="text">
                            <?php if (isset($content['answer']) && !empty($content['answer'])) { ?>
                                <div class="inner-text"><?php echo $content['answer']; ?></div>
                            <?php } ?>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>
    </div>

<?php
get_footer();
