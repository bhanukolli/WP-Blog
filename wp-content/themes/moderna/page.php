<?php
/**
 * @package WordPress
 * @subpackage Moderna Theme
 */
$sidebar_pos = iwebtheme_smof_data('sidebar_pos');
?>
<?php get_header(); ?>
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
	<?php if ($sidebar_pos == 'left') { ?>
		<?php get_sidebar(); ?>
	<?php } ?>
		<div class="col-lg-8">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
			<?php the_content(); ?>
			<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>			
			<?php endwhile; endif; ?>
			<div class="margintop30"></div>
			<?php comments_template(); ?>				
		</div>
	<?php if ($sidebar_pos == 'right') { ?>
		<?php get_sidebar(); ?>
	<?php } ?>
		</div>
	</div>
</section>   
<?php get_footer(); ?>