<?php get_header(); ?>

<?php $our_title = get_the_title( get_option('page_for_posts', true) );?>

<?php 
    $img = wp_get_attachment_image_src(get_post_thumbnail_id(get_option('page_for_posts')),'full');
    $featured_image = $img[0];
?>
<div class="title_bar" style="background-image:url(<?php echo $featured_image ?>);">
	<div class="title_bar_overlay">
		<div class="container">
			<h1> <?php echo $our_title;  ?></h1>
		</div>
	</div>
</div>

<div class="content inner">
	<div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post();
                    $link_url = substr(get_the_content(), 0, 4) == 'http' ? get_the_content() : get_the_permalink();
                    $url_target = substr(get_the_content(), 0, 4) == 'http' ? ' target="_blank"' : ''; ?>

                            <div class="col-md-4 col-sm-6">
                                <div class="ml_block">
                                    <a href="<?php echo $link_url; ?>"<?php echo $url_target; ?>>
                                        <div class="ml_block_photo">
                                        
                                            <?php global $post;?>
                                            <?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 5600,1000 ), false, '' );?>

                                            <img src="<?php if(get_field('post_thumbnail')){ the_field('post_thumbnail');}
                                            elseif($src[0]) { echo $src[0]; }
                                            else { echo '/wp-content/uploads/2017/10/flag-heart-min.png';}  ?>">
                                            <!-- Had echo site_url in the else before the period -->
                                        </div>
                                        <div class="ml_block_text">
                                            <h3><?php the_title(); ?></h3>
                                            <?php the_excerpt();?>
                                            <p>Read More <i class="fa fa-angle-right"></i></p>
                                        </div>
                                    </a>
                                </div>
                            </div>

                    <?php endwhile; ?>
                 <?php endif; ?>
            </div>

            <!--   Paginate start -->

            <div  <?php if ( is_paginated() ) : ?> class="post_pagination"<?php endif; ?> >
		        <div class="col-sm-4 right new_post "> <?php previous_posts_link('<< Newer Posts ') ;  ?></div>
                <div class="col-sm-4 page_pagination">
				    <?php $current_page = max( 1, get_query_var('paged') );
							$total_pages = $wp_query->max_num_pages;
							echo 'Page '.$current_page.' of '.$total_pages;  ;  ?>
					</div>

				<div class="col-sm-4 old_post "> <?php next_posts_link('Older Posts >>'); ?></div>
             </div>

             <!--   Paginate end -->
        </div>
    </div>
</div>

