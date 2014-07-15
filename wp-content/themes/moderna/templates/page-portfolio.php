<?php
/*
Template Name: Portfolio
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
<!-- CONTENT -->	
<section id="content">
<div class="container">
	<div class="row">
	<div class="col-lg-12">
	
				<?php
					$taxonomy = 'portfolio_categories';
					$categories = get_terms( $taxonomy, array( 'parent' => 0, ) );
					if ( count($categories) > 0 ){
						echo '<ul class="portfolio-categ filter">';
						echo '<li class="all active"><a href="#">'.__('All', 'iwebtheme').'</a></li>';
						foreach ( $categories as $category ) {
							$catasclass = $category->name;
							$catasclass = preg_replace('/\s/', '', $catasclass);
							echo '<li class="'.$catasclass.'"><a href="#">'.$category->name.'</a></li>';
						}
						echo '</ul>';
					}					
				?>
				<div class="clearfix">
				</div>
	<div class="row">
	<section id="projects">
	<ul id="thumbs" class="portfolio">
			<?php if(iwebtheme_smof_data('disable_portpagination') != 0) { 	
					$port_count = iwebtheme_smof_data('port_count');
					$paged = (get_query_var('paged') ? get_query_var('paged') : 1);
                    $count = 1;
        		    $type = 'portfolio';
        		    $args=array(
        		    'post_type' => $type,
					'paged' => $paged,
                    'posts_per_page' => $port_count
        		    );
        		    query_posts($args);	
				} else { 
 					$port_count = iwebtheme_smof_data('port_count');
				
                    $count = 1;
        		    $type = 'portfolio';
        		    $args=array(
        		    'post_type' => $type,
                    'posts_per_page' => -1
        		    );
        		    query_posts($args);	
				} ?>

					<?php if (have_posts()) : while (have_posts()) : the_post();					
					$terms = ''; // variable
					$project_overview = get_post_meta($post->ID, 'iweb_project_overview', true);
					if (has_post_thumbnail()) {					
						$thumb = get_post_thumbnail_id();
						$thumb_w = '800';
						$thumb_h = '600';
						$image_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
						$image_url = $image_src [0];
						$attachment_url = wp_get_attachment_url($thumb, 'full');
						$image = aq_resize($attachment_url, $thumb_w, $thumb_h, true);							
					}			
        			
					
					$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'grid-thumb');
					$terms = get_the_terms( $post->ID, 'portfolio_categories' );
									foreach ( $terms as $term ) {
											$cats[0] = $term->name;
											$catname = join($cats);		
											$catname = preg_replace('/\s/', '', $catname);											
									}
					$title= get_the_title();
					$title= explode(' ',$title);
					$title[0]= '<span class="bold">'.$title[0].'</span>';
					$title= implode(' ',$title);
                    ?>	
	
		<!-- PORTFOLIO ITEM -->
			<li class="item-thumbs col-lg-3 design" data-id="id-<?php echo $post->ID; ?>" data-type="<?php 
						$terms = get_the_term_list( $post->ID, 'portfolio_categories','',' , ','' ); 
						$terms = preg_replace('/\s/','', $terms);
						$terms = strip_tags( $terms );
						$terms = preg_replace('/[\s,\-!]/',' ', $terms);
						echo $terms;
						?>">
						<a class="hover-wrap fancybox" data-fancybox-group="gallery" title="<?php the_title(); ?>" href="<?php echo $attachment_url; ?>">
						<span class="overlay-img"></span>
						<span class="overlay-img-thumb font-icon-plus"></span>
						</a>
						<img src="<?php echo $image; ?>" alt="<?php echo $project_overview; ?>">
			</li>
  <?php endwhile; ?>	
	</ul>
	</section>
	</div>
	
	</div>
	</div>
</div>
</section>
<?php if(iwebtheme_smof_data('disable_portpagination') != 0) { ?>
	<div class="container m-bot-25 clearfix">
			<?php if (function_exists("pagination")) { ?>
			<div class="pagination-1-container sixteen columns">
			<?php pagination(); ?>
			</div>
			<?php } else {
			posts_nav_link(' &#183; ', 'previous page', 'next page'); 	
			} ?>
	</div>
<?php } ?>
<?php endif; wp_reset_query(); ?>		
<!-- end of section -->
<?php get_footer(); ?>