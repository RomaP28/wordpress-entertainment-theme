
<?php  get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 1905,200 ), false, '' );?>	

    <div class="apex_interior_spacer"></div>
    <div class="apex_top_content">
        <div class="container">
            <div class="row">
                <div class=<?php if(is_page(900)){ echo "col-lg-12 col-md-12";} else { ?>"col-lg-8 offset-lg-2 col-md-10 offset-md-1" <?php } ?>>
                    <h1><?php the_title();?></h1>
                    <?php  if (get_field('title_content')){?> <p> <?php  the_field('title_content'); ?></p> <?php } ?>

                </div>
            </div>
        </div>
    </div>

    <div class="apex_content_main">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                     <?php  the_content();?>
                </div>
            </div>
        </div>
    </div>

<?php endwhile; endif; ?>
<?php get_footer(); ?>





