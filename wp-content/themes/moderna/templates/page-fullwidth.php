<?php
/*
Template Name: Fullwidth page
*/
get_header();
?>
<!-- PAGE TITLE -->
<section id="inner-headline">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<?php get_template_part('includes/breadcrumbs'); ?>
				</div>
			</div>	
		</div>
</section>	
<section id="content">
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?> 
			<?php the_content(); ?>
			<?php endwhile; ?>

		<?php endif; ?>
		
		</div>	
	</div>
</div>	
</section>
<?php get_footer(); ?>