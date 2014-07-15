<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div <?php post_class(); ?>>
<?php get_template_part( 'includes/single' ); ?>	
<div class="m-top-15">
<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>	
</div>
				
<?php comments_template(); ?>		
</div>
 
<?php endwhile; ?>
<?php endif; ?>