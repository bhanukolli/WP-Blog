<?php
/*
Template Name: Blog page
*/
$sidebar_pos = iwebtheme_smof_data('sidebar_pos');
get_header();
?>
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
	<?php if ($sidebar_pos == 'left') { ?>
		<?php get_sidebar(); ?>
	<?php } ?>	
		<div class="col-lg-8">
		<?php query_posts('post_type=post&post_status=publish&paged='. get_query_var('paged')); ?>
			<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?> 
			<?php get_template_part( 'includes/content' ); ?>
					<?php endwhile; ?>

			<?php if (function_exists("pagination")) { ?>
			<?php pagination(); ?>
			<?php } else {
			posts_nav_link(' &#183; ', 'previous page', 'next page'); 	
			} ?>
		
		<?php endif; ?>
		<?php wp_reset_query(); ?>
		</div>	
	<?php if ($sidebar_pos == 'right') { ?>
		<?php get_sidebar(); ?>
	<?php } ?>
	</div>
</div>
</section>
<!-- end of section -->
<?php get_footer(); ?>