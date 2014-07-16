<?php get_header(); // HEADER ?>
	<div id="innerheadcontainer">
        <div id="innerheadcontent">
            <div class="section group"><!-- section -->
                <div class="col span_3_of_3 trans unlimited"><!-- col -->
                	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<h1 class="innertitle">
                        	<?php // POST CATEGORY TITLE
								$category = get_the_category(); 
								if($category[0]){
									echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
								}
							?>
						</h1>
                    <?php endwhile; else: endif; ?>
                </div><!-- /col -->
            </div><!-- /section -->
        </div>
    </div>    
    <div class="innercontentcontainer">
    	<div class="innercontent">
    		<div class="section group"><!-- section -->
                <div class="col span_6_of_12 trans unlimited"><!-- col -->
                	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                		<h1 class="posttitle"><?php the_title(); // POST TITLE ?></h1>
                		<?php if ( get_post_meta($post->ID, 'subtitle', true) ) { // IF SUBTITLE EXISTS ?>
                			<h6 class="postsubtitle"><?php echo get_post_meta($post->ID, 'subtitle', true); // DISPLAY SUBTITLE ?></h6>
                		<?php } else { // IF NO SUBTITLE EXISTS ?>
                			<div class="break smallgap"></div>
                		<?php } // DO NOTHING ?>
                		<?php if ( mytheme_option( 'select_social_post' ) && mytheme_option( 'select_social_post' ) == 'choice1' ) { // IF SOCIAL POST ICONS ACTIVE ?>
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
                		<div class="contentstyle">
                			<?php the_content(); // POST CONTENTS ?>
                			<?php wp_link_pages(); // PAGED NAVIGATION ?>
                		</div>
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
				<div class="col span_2_of_12 trans unlimited"><!-- col -->
                	<h4><?php _e( 'More Posts', 'wpblink_flatolio' ); ?></h4>
                	<?php $my_query = new WP_Query("showposts=2&offset=0"); ?>
                	<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
                		<?php if ( has_post_thumbnail() ) { // IF POST IMAGE EXISTS ?>
                			<a href="<?php the_permalink() ?>" rel="bookmark">
                				<?php the_post_thumbnail( 'img_standard', array( 'class' => 'img img_responsive', 'title' => '' ) ); // POST IMAGE ?>
                				<?php the_title(); // POST TITLE ?>
                				<p class="small"><?php wpe_excerpt('wpe_excerptlength_shorter', 'wpe_excerptmore'); // POST EXCERPT ?></p>
                			</a>
                		<?php } else { // IF NO POST IMAGE ?>
                		<?php } // END IF ?>
                		<div class="break seperate"></div>
                	<?php endwhile; ?>
                	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>       
                		<?php if(get_the_tag_list()) { // POST TAGS ?>
                			<?php 
                				echo '<h4>'; _e( 'Related Topics', 'wpblink_flatolio' ); echo '</h4>';
                				echo get_the_tag_list('<ul class="related"><li>','</li><li>','</li></ul>'); // POST TAGS LIST 
							?>
                		<?php } ?>
                		<?php 
                			echo '<h4>'; _e( 'Post Info', 'wpblink_flatolio' ); echo '</h4>';
                			echo '<p class="small">';
                				_e( 'By: ', 'wpblink_flatolio' ); the_author_posts_link(); echo '<br />'; // AUTHOR LINK
                				_e( 'Posted: ', 'wpblink_flatolio' ); dateformat(); // POST DATE 
                			echo '</p>';
                		?>
                	<?php endwhile; else: endif; ?>
                </div><!-- /col -->
				<div class="col span_4_of_12 trans unlimited"><!-- col -->
					<?php widget_post() // SIDEBAR WIDGETS ?>
				</div><!-- /col -->
			</div><!-- /section -->
		</div>
	</div>
<?php get_footer(); // FOOTER ?>