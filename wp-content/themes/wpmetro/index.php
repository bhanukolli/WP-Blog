<?php get_header(); // HEADER ?>
	<div id="innercontentcontainer">
		<div id="innercontent">
            <div class="section group">
                <div class="col span_2_of_3 trans unlimited">
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<?php if( has_post_format('video')){ ?>
                            <span class="format_float">
                                <?php get_template_part( 'library/formats/video' ); ?>
                            </span>
                        <?php } else { ?>
                            <?php if( has_post_format('audio')){ ?>
                                <span class="format_float">
                                    <?php get_template_part( 'library/formats/audio' ); ?>
                                </span>
                            <?php } else { ?>
                                <?php if( has_post_format('gallery')){ ?>
                                     <span class="format_float">
                                        <?php get_template_part( 'library/formats/gallery' ); ?>
                                    </span>
                                <?php } else { ?>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>                    
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
						<?php if( has_post_format('video')){ ?>
                        	<?php if ( get_post_meta($post->ID, 'youtube', true) ) { // IF VIDEO EXISTS ?>
                        		<div class="vplayer">
                        			<iframe seamless width="1200" height="675" src="//www.youtube.com/embed/<?php echo get_post_meta($post->ID, 'youtube', true); ?>?rel=0"></iframe>
                        		</div>
                        		<div class="break"></div>
                        	<?php } else { // IF NO VIDEO EXISTS ?>
                        	<?php } // DO NOTHING ?>
                        <?php } else { ?>
                        	<?php if( has_post_format('audio')){ ?>
                        		<?php if ( get_post_meta($post->ID, 'soundcloud', true) ) { // IF AUDIO EXISTS ?>
                        			<div class="aplayer">
                        				<iframe seamless width="650" height="166" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/<?php echo get_post_meta($post->ID, 'soundcloud', true); ?>&amp;color=3b83f9&amp;auto_play=false&amp;show_artwork=true"></iframe>
                        			</div>
                        			<div class="break"></div>
                        		<?php } else { // IF NO AUDIO EXISTS ?>
                        		<?php } // DO NOTHING ?>
                        	<?php } else { ?>
                        		<?php if( has_post_format('gallery')){ ?>
                        		<?php } else { ?>
                        			<?php if ( has_post_thumbnail() ) { // IF POST IMAGE EXISTS ?>			
                        				<?php the_post_thumbnail( 'img_standard', array( 'class' => 'img img_half img_float', 'title' => '' ) ); // POST IMAGE ?>
                        			<?php } else { ?>
                        			<?php } ?>
                        		<?php } ?>
                        	<?php } ?>
                        <?php } ?> 
                        <div class="contentstyle">
                            <?php the_content(); // POST CONTENTS ?>
                            <?php wp_link_pages(); // PAGED NAVIGATION ?>
                        </div>
                        <span class="postmeta"><?php _e( 'By', 'wpblink_metro' ); ?> <?php the_author_posts_link(); ?> (<?php dateformat(); // POST DATE ?>)</span>
<?php if(get_the_tag_list()) { // POST TAGS ?>
<div class="tagsbox">
<span class="heavy"><?php _e('Tagged With: ', 'wpblink_flexpost'); ?></span>
<?php echo get_the_tag_list('<p>',' ','</p>'); // POST TAGS LIST ?>
</div>
<?php } ?>
                    <?php endwhile; else: ?>
                    	<?php get_template_part( '404' ); // IF NOTHING FOUND ?>
                    <?php endif; ?>
                    <?php previous_posts_link(); // POST NAVIGATION ?>
                    <?php next_posts_link(); // POST NAVIGATION ?>
                    <div class="section group">
                        <div class="col span_3_of_3 unlimited">
                            <?php if ( mytheme_option( 'comments_selector' ) && mytheme_option( 'comments_selector' ) == 'choice1' ) { // DISQUS COMMENTS ?>
                                <div class="comment_wrapper">
                                    <h3 class="gap"><?php _e('Readers Comments:', 'wpblink_metro'); ?></h3>
                                    <?php if ( mytheme_option( 'comments_disqus' ) && mytheme_option( 'comments_disqus' ) != '' ) { ?>
                                        <?php $options = get_option( 'mytheme_options' ); $echo_options = $options['comments_disqus']; echo stripslashes($echo_options); ?>
                                    <?php } else { ?>
                                        <div class="contentstyle">
                                            <p class="white"><?php _e('ERROR: Disqus Universal Code missing from theme options, please fix.', 'wpblink_metro'); // DISQUS ERROR ?></p>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } else { ?>
                            <?php } ?>
                            <?php if ( mytheme_option( 'comments_selector' ) && mytheme_option( 'comments_selector' ) == 'choice2' ) { // WORDPRESS COMMENTS ?>
                                <div class="comment_wrapper">
                                    <h3 class="gap"><?php _e('Readers Comments:', 'wpblink_metro'); ?></h3>
                                    <?php comments_template(); // COMMENTS TEMPLATE ?>
                                </div>
                            <?php } else { ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col span_1_of_3 trans unlimited">
                    <?php widget_post(); // SIDEBAR WIDGETS ?>
                </div>
            </div>
		</div>
	</div>
<?php get_footer(); // FOOTER ?>