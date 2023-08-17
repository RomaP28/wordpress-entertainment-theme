<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<?php $our_title = get_the_title( get_option('page_for_posts', true) );?>


<?php 
    $img = wp_get_attachment_image_src(get_post_thumbnail_id(get_option('page_for_posts')),'full');
    $featured_image = $img[0];
?>

<?php
$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 1905,200 ), false, '' );

?>	


<div class="title_bar" style="background-image:url(<?php if($src[0]){echo $src[0]; } else { echo $featured_image; }?>);">
	<div class="title_bar_overlay">
		<div class="container">
			<h1> <?php echo $our_title;  ?></h1>
		</div>
	</div>
</div>

<div class="content inner">
	<div class="container">
	    <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
		         <p class="cmc_news_date"><?php the_date('F j, Y');?></p>
					<hr>
					<h3><a href="#"><?php the_title(); ?></a></h3>
					<?php  the_content();?>

         </div>
	</div>
</div>


<?php endwhile; endif; ?>

<?php get_footer(); ?>