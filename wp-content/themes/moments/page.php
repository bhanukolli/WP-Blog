<?php get_header(); ?>

				<!-- featured article -->
		        <div class="topbar"> </div>
       			<!-- featured article -->

	   			<!-- .main_content-->
                <div class="main_content">

	       			<!-- section content -->
		            <section class="content">

		            		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		                    <!-- standart article -->
		                    <article <?php post_class(); ?>>

		                        <h2><span class="post_title_icon"></span><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>

		                         <!-- entry-content -->
		                         <div class="entry-content clearfix">
		                         <div class="entry-colors"><div class="color_col_1"></div><div class="color_col_2"></div><div class="color_col_3"></div></div>

										<?php
										if(is_search()){
											the_excerpt();
										}else{
										 the_content(__('Read More', 'site5framework'));
										}?>

	                            </div>
	                            <!-- entry-content -->

		                    </article>
		                    <!-- standart article -->

		                    <?php endwhile; ?>

	                </section>
	                <!-- section content -->

			<?php endif;?>

			<?php wp_reset_query(); ?>

			<?php get_sidebar(); ?>

        </div>
        <!-- .main_content-->

<?php get_footer(); ?>