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
	<?php
    if (have_posts()) : ?>        
  
			<?php
            while (have_posts()) : the_post(); ?>        
			<?php get_template_part( 'includes/content', get_post_format() ); ?>
                <!-- /search-entry -->                
            <?php endwhile; ?>            

				<?php if (function_exists("pagination")) { 
				pagination();
				} else {
				posts_nav_link(' &#183; ', 'previous page', 'next page'); 	
				} ?>

		<?php else : ?>        
		<h2 class="entry-title"><?php _e('No results found for', 'iwebtheme'); ?>: <?php the_search_query(); ?></h2>
        <!-- /post  -->   

 		
		<?php endif; ?>
	</div>
		
	<?php if ($sidebar_pos == 'right') { ?>
	<?php get_sidebar(); ?>
	<?php } ?>
	</div>
</div>
</section>
<?php get_footer(); ?>