<?php

add_filter('body_class', function($classes) {
    return array_merge($classes, ['kbyg search-page']);
});

$searchFields = get_fields( get_the_ID() );
$sites = get_sites();
$s = get_search_query();
$allResults = array(
    "amount" => 0
);
foreach ($sites as $site) {
    switch_to_blog($site->blog_id);

    $current_page = get_query_var('paged') ? get_query_var('paged') : 1;
    $the_query = new WP_Query( array(
            's' => $s,
            'paged' => $current_page,
            'post_status' => 'publish',
            'post__not_in' => array( 899, 2 )
    ) );

    $homeUrl = get_home_url();

    $nav = paginate_links( array(
        'base' => $homeUrl.'/page/%#%/',
        'format' => '?paged=%#%',
        'current' => max( 1, $current_page ),
        'total' => $the_query->max_num_pages,
        'prev_text' => __('Previous'),
        'next_text' => __('Next'),
        'type' => 'array',
    ) );


    $location = get_blog_details($site->blog_id)->blogname;
    $searchResults[$location]['nav'] = $nav;
    $searchResults[$location]['amount'] = $the_query->found_posts;
    $allResults['amount'] += $the_query->found_posts;
    $searchResults[$location]['results'] = array();
    $searchResults[$location]['time'] = timer_stop(0, 2);

    if ($the_query->have_posts()) {
        while ($the_query->have_posts()) {
            $the_query->the_post();

            $link = '';
            if(get_post_type() === 'events' || get_post_type() === 'plays') {
                $link = $homeUrl.'/'.get_post_type().'/#'.get_post_field( 'post_name', get_the_ID() );
            } elseif (get_post_type() === 'locations') {
                $link = $homeUrl.'/'.get_post_type();
            } else {
                $link = get_permalink(get_the_ID());
            }

            $content = stristr(strip_tags($content), $s);
            if(strlen($content) < 1) { $content = get_the_content(); }

            $content = wp_trim_words( $content, 50);
            $content = str_ireplace($s, '<a class="text-link" href="'.$link.'" >'.$s.'</a>', strip_tags($content));

            $title = the_title('', '', FALSE);

            array_push($searchResults[$location]['results'], Array(
                    "title" => $title,
                    "description" => $content,
                    "link" => $link,
                ));
        }
    }
    wp_reset_query();
    restore_current_blog();
}

$allResults['time'] = timer_stop(0, 2);

get_header(); ?>
    <div class="banner">
        <div class="container">
            <h1>Search <br><span>results</span></h1>
        </div>
    </div>
<div class="search-section">
    <div class="container">
        <div>
            <form role="search" method="get" id="searchform" class="searchform" action="<?php echo get_home_url(); ?>">
                <input class="search-input" type="text" value="" name="s" id="s" autocomplete="off" placeholder="Search Apex">

                <div class="buttons">
                    <div class="clear"><img src="<?php echo get_template_directory_uri() ?>/assets/img/search/close.svg" alt="Close"></div>
                    <button class="search" type="submit"><img src="<?php echo get_template_directory_uri() ?>/assets/img/search/search-glass.svg" alt="Search"></button>
                </div>
                <input style="display: none" type="submit" id="searchsubmit" value="Search">
            </form>
            <?php foreach (array_keys($searchResults) as $i=>$location) { ?>
                <div class="result-stats <?php echo $location === get_bloginfo() ? 'active' : '' ?>" data-stat="<?php echo $i ?>">
                    <?php echo $searchResults[$location]['amount'] > 50 ? 'About '.$searchResults[$location]['amount'] : $searchResults[$location]['amount'] ; ?> results for <strong><?php echo $s; ?></strong> (<?php echo $searchResults[$location]['time']; ?> seconds)
                </div>
            <?php } ?>
                <div class="result-stats" data-stat="All">
                    <?php echo $allResults['amount'] > 50 ? 'About '.$allResults['amount'] : $allResults['amount'] ; ?> results for <strong><?php echo $s; ?></strong> (<?php echo $allResults['time']; ?> seconds)
                </div>
            <div class="results-content">
                <div class="result-tabs">
                    <?php foreach (array_keys($searchResults) as $i=>$location) { ?>
                        <div class="tab <?php echo $location === get_bloginfo() ? 'active' : '' ?>" data-tab="<?php echo $i ?>"><?php echo $location ?></div>
                    <?php } ?>
                        <div class="tab" data-tab="All">All</div>
                </div>
                <div class="mobile-tabs">
                    <div class="title">Results for</div>
                    <div class="arrow"><img src="<?php echo get_template_directory_uri() ?>/assets/img/chevron-down.svg" alt="Arrow down"></div>
                    <?php foreach (array_keys($searchResults) as $i=>$location) { ?>
                        <div class="tab-mobile <?php echo $location === get_bloginfo() ? 'active' : '' ?>" data-tab="<?php echo $i ?>"><?php echo $location ?></div>
                    <?php } ?>
                        <div class="tab-mobile" data-tab="All">All</div>
                </div>
                <div class="result-tabs-content">
                <?php foreach (array_keys($searchResults) as $i=>$location) { ?>
                    <div class="content <?php echo $location === get_bloginfo() ? 'active' : '' ?>" data-tab-content="<?php echo $i ?>">
<!--                        --><?php //p($searchResults[$location]) ?>
                        <?php if(count($searchResults[$location]['results']) !== 0 ) {
                            foreach ($searchResults[$location]['results'] as $item) {?>
                                <div class="item">
                                    <h2><?php echo $item['title']; ?></h2>
                                    <p><?php echo $item['description']; ?></p>
                                    <a href="<?php echo $item['link'] ?>"><?php echo $item['link'] ?></a>
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                                <div class="item">
                                    <h2>Nothing Found</h2>
                                    <p>Sorry, but nothing matched your search criteria. Please try again with some different keywords.</p>
                                </div>
                        <?php } ?>
                        <?php if ( ! empty( $searchResults[$location]['nav'] ) ) : ?>
                            <div class="pagination">
                                <div class="pages">
                                <?php foreach ( $searchResults[$location]['nav'] as $key => $page_link ) : ?>
                                    <?php echo $page_link; ?>
                                <?php endforeach ?>
                                </div>
                                <div class="pagination mobile-only">
                                    <div class="pages">
                                        <div>Page <span class="active-page"></span> of <?php echo ceil($searchResults[$location]['amount'] / 10) ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                <?php } ?>
                    <div class="content" data-tab-content="All">
                <?php
                    $xpagenr = 1;
                    if ($_GET['page'] != "") $xpagenr = $_GET['page'];
                    $posts_per_page = get_option('posts_per_page');
                    $fpagenr = ($xpagenr - 1) * $posts_per_page;
                    $fposts_per_page = $xpagenr * $posts_per_page;
                    $posts_per_page = get_option('posts_per_page');

                    $searchfor = get_search_query();
                    $blogs = wp_get_sites( 0,'all' );
                    $blogs_ordered = array(get_current_blog_id());

                    foreach ( $blogs as $blog ) {
                        if ($blog['blog_id']!=$blogs_ordered['0']){
                            $blogs_ordered[]=$blog['blog_id'];
                        }
                    }

                    foreach ( $blogs_ordered as $blogid ) {
                        switch_to_blog($blogid);
                            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                            $search = new WP_Query(array(
                                    's' => get_search_query(),
                                    'posts_per_page' => $posts_per_page,
                                    'paged' => $xpagenr,
                                    'post__not_in' => array( 899, 2 )
                                )
                            );

                            if ($search->found_posts>0) {
                                foreach ( $search->posts as $post ) {

                                   $pglink = '';
                                    if(get_post_type() === 'events' || get_post_type() === 'plays') {
                                        $pglink = $homeUrl.'/'.get_post_type().'/#'.get_post_field( 'post_name', get_the_ID() );
                                    } elseif (get_post_type() === 'locations') {
                                        $pglink = $homeUrl.'/'.get_post_type();
                                    } else {
                                        $pglink = get_permalink(get_the_ID());
                                    }

                                    $postcontent = stristr(strip_tags($post->post_content), $s);
                                    if(strlen($postcontent) < 1) {
                                        $postcontent = $post->post_content;
                                    }
                                    $postcontent = wp_trim_words( $postcontent, 50);
                                    $postcontent = str_ireplace($s, '<a class="text-link" href="'.$pglink.'" >'.$s.'</a>', strip_tags($postcontent));
                                    ?>
                                 <div class="item">
                                    <h2><?php echo $post->post_title; ?></h2>
                                    <p><?php echo $postcontent; ?></p>
                                    <a href="<?php echo $pglink ?>"><?php echo $pglink; ?></a>
                                </div>
                            <?php wp_reset_postdata();
                                 }
                            }
                        wp_reset_postdata();
                    }
                    if($allResults['amount'] < 1) { ?>
                        <div class="item">
                            <h2>Nothing Found</h2>
                            <p>Sorry, but nothing matched your search criteria. Please try again with some different keywords.</p>
                        </div>
                    <?php  } elseif ($allResults['amount'] > 20) {
                        $search->query_vars['paged'] > 1 ? $current = $search->query_vars['paged'] : $current = 1;
                        $nav2 = paginate_links( array(
                            'base' => get_home_url() . "/?s=" . get_search_query() . '&page=' . '%#%',
                            'current' => max( 1, $search->query_vars['paged'] ),
                            'total' => $search->max_num_pages,
                            'prev_text' => __('Previous'),
                            'next_text' => __('Next'),
                            'type' => 'array',
                        ) );
                        ?>
                            <div class="pagination">
                                <div class="pages">
                                    <?php foreach ( $nav2 as $key => $pagelink ) : ?>
                                        <?php echo $pagelink; ?>
                                    <?php endforeach ?>
                                </div>

                                <div class="pagination mobile-only">
                                    <div class="pages">
                                        <div>Page <span class="active-page"></span> of <?php echo $search->max_num_pages ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        var activePage = document.querySelectorAll('.search-section .pagination .pages .current');
        activePage.forEach(function (el) {
            var container = el.closest('.content');
            var pageNumberPlace = container.querySelector('.pagination.mobile-only .pages .active-page');

            pageNumberPlace.innerText = el.innerText;
        })
        const tabAll = localStorage.getItem('tab')
        if(tabAll) {
            const searchTabs = document.querySelectorAll('.search-page .results-content .tab');
            const searchTabsContent = document.querySelectorAll('.search-page .results-content .content');
            const searchStats = document.querySelectorAll('.search-page .result-stats');
            const searchTabsMobile = document.querySelectorAll('.search-page .results-content .tab-mobile');

            [ searchTabs, searchTabsContent, searchStats, searchTabsMobile ].forEach(el => removeAddActiveClass(el))
        }

        function removeAddActiveClass(elem) {
            elem.forEach(el=>el.classList.remove('active'));
            elem[elem.length - 1].classList.add('active');
        }

        const searchForm = document.querySelector(".search-section");
        if(searchForm) {
            searchForm.scrollIntoView({behavior: 'smooth'})
        }
    </script>
<?php
get_footer();
