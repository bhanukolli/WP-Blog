<?php get_header(); // HEADER ?>
	<div id="innerheadcontainer">
		<div id="innerheadcontent">
			<div class="section group"><!-- section -->
				<div class="col span_3_of_3 trans unlimited"><!-- col -->
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<h1 class="innertitle">
							<a href="<?php echo get_post_type_archive_link( 'portfolio' ); ?>">
								<?php // POST CATEGORY TITLE
									echo get_post_type();
								?>
							</a>
						</h1>
					<?php endwhile; else: endif; ?>
				</div><!-- /col -->
			</div><!-- /section -->
		</div>
	</div>
	<div class="innercontentcontainer">
		<div class="innercontent">
			<div class="section group"><!-- section -->
				<div class="col span_8_of_12 trans unlimited"><!-- col -->
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<?php if ( has_post_thumbnail() ) { // IF POST IMAGE EXISTS ?>
							<div class="overlay_wrapper">
								<div class="overlay_image">
									<div class="overlay">
										<?php the_post_thumbnail( 'img_standard', array( 'class' => 'img img_responsive', 'title' => '' ) ); // POST IMAGE ?>
										<span><?php the_title(); // POST TITLE ?></span>
									</div>
								</div>
							</div>
						<?php } else { // IF NO POST IMAGE ?>
						<?php } // END IF ?>
						<?php 
							echo '<p class="small">';
								_e( 'Published: ', 'wpblink_flatolio' ); dateformat(); _e( 'By: ', 'wpblink_flatolio' ); the_author_posts_link(); // AUTHOR LINK 
							echo '</p>';
						?>
						<?php if ( mytheme_option( 'select_social_post' ) && mytheme_option( 'select_social_post' ) == 'choice1' ) { // IF SOCIAL POST ICONS ACTIVE ?>
							<div class="break gap"></div>
                            <!-- AddToAny BEGIN -->
                            <div class="a2a_kit a2a_default_style">
                            	<a class="a2a_button_twitter_tweet"></a>
                            	<a class="a2a_button_google_plusone"></a>
                            	<a class="a2a_button_facebook_like"></a>
                            </div>
                            <script type="text/javascript" src="//static.addtoany.com/menu/page.js"></script>
                            <!-- AddToAny END -->
							<div class="break gap"></div>
						<?php } else { // IF NOT ACTIVE ?> 
						<?php } // END IF ?>
						<a id="expand_excerpt" title="<?php _e('Open/Close', 'wpblink_flatolio'); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_more.png" alt="icon-excerpt" class="expand_excerpt_button" /></a>
						<div class="break"></div>
						<div id="expand_excerpt_content">
							<div class="contentstyle">
								<?php the_content(); // POST CONTENTS ?>
							</div>
						</div>
						<div class="break"></div>
					<?php endwhile; else: endif; ?>
					<?php if ( mytheme_option( 'comments_selector' ) && mytheme_option( 'comments_selector' ) == 'choice1' ) { // DISQUS COMMENTS ?>
						<div class="comment_wrapper">
							<h4><?php _e('Readers Comments', 'wpblink_flatolio'); ?></h4>
							<?php if ( mytheme_option( 'comments_disqus' ) && mytheme_option( 'comments_disqus' ) != '' ) { ?>
								<?php $options = get_option( 'mytheme_options' ); $echo_options = $options['comments_disqus']; echo stripslashes($echo_options); ?>
							<?php } else { ?>
								<div class="contentstyle">
									<p><?php _e('ERROR: Disqus Universal Code missing from theme options, please fix.', 'wpblink_flatolio'); // DISQUS ERROR ?></p>
								</div>
							<?php } ?>
						</div>
					<?php } else { ?>
					<?php } ?>
					<?php if ( mytheme_option( 'comments_selector' ) && mytheme_option( 'comments_selector' ) == 'choice2' ) { // WORDPRESS COMMENTS ?>
						<div class="comment_wrapper">
							<h4><?php _e('Readers Comments', 'wpblink_flatolio'); ?></h4>
							<?php comments_template(); // COMMENTS TEMPLATE ?>
						</div>
					<?php } else { ?>
					<?php } ?>
				</div><!-- /col -->
				<div class="col span_4_of_12 trans unlimited"><!-- col -->
					<?php widget_post() // SIDEBAR WIDGETS ?>
				</div><!-- /col -->
			</div><!-- /section -->
		</div>
	</div>
<?php get_footer(); // FOOTER ?>