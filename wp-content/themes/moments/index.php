<?php get_header(); ?>


				<!-- featured article -->
		        <section class="featured">
        			<?php
	            		$args = array(
							'posts_per_page' => 1,
							'post__in'  => get_option( 'sticky_posts' )
						);
						query_posts( $args );
	            		if (have_posts()) : while (have_posts()) : the_post();
            		?>

	               	<!-- begin sticky post article -->
	               	<article <?php post_class(); ?>>

	                    <header>

                    		<!-- begin postmeta -->
	                    	<div class="postmeta">
	                        	<span><i class="fa fa-clock-o"></i> <?php the_time('M j, Y') ?></span>
	                        	<span><i class="fa fa-user"></i> Posted by <?php the_author_link(); ?></span>
	                        	<span><i class="fa fa-bookmark"></i> <?php the_category(', '); ?></span>
	                        	<span><i class="fa fa-comments"></i> <?php comments_popup_link('0 comments', '1 comment', ' % comments'); ?></span>
	                        </div>
	                        <!-- end postmeta -->

										<!-- begin post icon -->
										<div class="icon">

											<?php
												if(has_post_format('gallery')){
													echo '<i class="fa fa-picture-o fa-2x"></i>';
												}

												if(has_post_format('image')){
													echo '<i class="fa fa-camera fa-2x"></i>';
												}

												if(has_post_format('link')){
													echo '<i class="fa fa-link fa-2x"></i>';
												}

												if(has_post_format('quote')){
													echo '<i class="fa fa-quote-right fa-2x"></i>';
												}

												if(has_post_format('video')){
													echo '<i class="fa fa-film fa-2x"></i>';
												}

												if(has_post_format('audio')){
													echo '<i class="fa fa-music fa-2x"></i>';
												}
											?>

											<?php
												if(!has_post_format('gallery') && !has_post_format('image') && !has_post_format('link') && !has_post_format('quote') && !has_post_format('video') && !has_post_format('audio')){
													echo '<i class="fa fa-pencil fa-2x"></i>';
												}
											?>

										</div>
										<!-- end post icon -->

	                        <h1><a href="<?php the_permalink();?>"><?php the_title();?></a></h1>

	                        <a class="featured_post"><?php _e("Featured Post", "site5framework"); ?></a>

	                    </header>

	                </article>
	                <!-- end sticky post article -->

	                 <?php endwhile; ?>

	   			</section>
	   			<!-- featured article -->

	   			<?php endif; wp_reset_query();?>


	   			<!-- .main_content-->
                <div class="main_content">

	       			<!-- section content -->
		            <section class="content">

		            		<?php
		            		query_posts( array( 'paged' => $paged, 'post__not_in' => get_option( 'sticky_posts' ) ) );
		            		if (have_posts()) : while (have_posts()) : the_post(); ?>

		                    <!-- standart article -->
		                    <article <?php post_class(); ?>>

		                        <h2><span class="post_title_icon"></span><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>

		                    	<!-- postmeta -->
		                    	<div class="postmeta">
		                        	<span><i class="fa fa-clock-o"></i> <?php the_time('M j, Y') ?></span>
		                        	<span><i class="fa fa-user"></i> Posted by <?php the_author_link(); ?></span>
		                        	<span><i class="fa fa-bookmark"></i> <?php the_category(', '); ?></span>
		                        	<span><i class="fa fa-comments"></i> <?php comments_popup_link('0 comments', '1 comment', ' % comments'); ?></span>
		                        </div>
		                        <!-- postmeta -->

		                        <!-- entry-content -->
		                        <div class="entry-content clearfix">
		                        <div class="entry-colors"><div class="color_col_1"></div><div class="color_col_2"></div><div class="color_col_3"></div></div>


										<?php
	                                    	$format = get_post_format();
											if ( false === $format )
											    $format = 'standard';
										?>

										<!-- begin post icon -->
										<div class="icon">

											<?php
												if(has_post_format('gallery')){
													echo '<i class="fa fa-picture-o fa-2x"></i>';
												}

												if(has_post_format('image')){
													echo '<i class="fa fa-camera fa-2x"></i>';
												}

												if(has_post_format('link')){
													echo '<i class="fa fa-link fa-2x"></i>';
												}

												if(has_post_format('quote')){
													echo '<i class="fa fa-quote-right fa-2x"></i>';
												}

												if(has_post_format('video')){
													echo '<i class="fa fa-film fa-2x"></i>';
												}

												if(has_post_format('audio')){
													echo '<i class="fa fa-music fa-2x"></i>';
												}
											?>

											<?php
												if(!has_post_format('gallery') && !has_post_format('image') && !has_post_format('link') && !has_post_format('quote') && !has_post_format('video') && !has_post_format('audio')){
													echo '<i class="fa fa-pencil fa-2x"></i>';
												}
											?>

										</div>
										<!-- end post icon -->

											<?php
											if ( has_post_thumbnail() ) {
												the_post_thumbnail( 'single-post-thumbnail' );
											}
											else {
											}
											?>

										<?php if(has_post_format('audio')){
											wp_enqueue_script('jplayer-js');
											$postid = $post->ID;
											player_audio($postid);
										}?>

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

		                    <!-- begin #pagination -->
							<?php
								if (function_exists("emm_paginate")) {
									emm_paginate();
								 } else {
							?>

							<div class="navigation">
						        <div class="alignleft"><?php next_posts_link(__('Older','site5framework')) ?></div>
						        <div class="alignright"><?php previous_posts_link(__('Newer','site5framework')) ?></div>
						    </div>

					   		<?php } ?>
					    	<!-- end #pagination -->

	                </section>
	                <!-- section content -->



			<?php endif;?>

			<?php wp_reset_query(); ?>

			<?php get_sidebar(); ?>

        </div>
        <!-- .main_content-->

<?php get_footer(); ?>