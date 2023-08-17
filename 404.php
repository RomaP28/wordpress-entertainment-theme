<?php get_header(); ?>

<?php if(have_rows('header_main_button','options') && have_rows('attractions_external_links','options') ){ ?>
    <div class="apex_interior_spacer"></div>
<?php } else {?>
    <div class="apex_interior_spacer_no_header_buttons"></div>
<?php } ?>

<div class="apex_top_content">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1">
				<h1>404 Page</h1>
			</div>
		</div>
	</div>
</div>
<div class="apex_top_content">
  <div class="container">
     <div class="col-lg-12">
               <p style=" text-align:center;"><?php _e( "Sorry, we can't find the page you're looking for.", 'HTML5 Reset' ); ?></p>
          <p class="error_404" style=" text-align:center;">Please return <a href="<?php echo site_url();?>">home</a> and try again.</p>
    </div>
  </div>
</div>

<?php get_footer(); ?>