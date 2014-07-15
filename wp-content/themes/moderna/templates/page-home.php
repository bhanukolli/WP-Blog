<?php
/*
Template Name: Homepage
*/
get_header();
?>
<section id="featured">
<?php get_template_part('includes/slider-flexslider'); ?>
</section>
<?php if(iwebtheme_smof_data('disable_cta') !=0) { ?>
	<section class="callaction">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="big-cta">
					<div class="cta-text">
						<?php echo iwebtheme_smof_data('home_cta'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	</section>
<?php } ?>
<section id="content">
<div class="container">
	<div class="row">
		<div class="col-lg-12">	
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
				<?php the_content(); ?>
				<?php endwhile; endif; ?>	
		</div>
	</div>
</div>
</section>
<?php get_footer(); ?>