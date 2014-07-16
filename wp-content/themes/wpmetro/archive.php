<?php 
	$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));  // GRAB AUTHOR NAME
	get_header(); // HEADER 
?>
	<div id="innercontentcontainer">
		<div id="innercontent">
            <div class="section group">
                <div class="col span_2_of_3 trans unlimited">
                	<h3 class="innertitle">
						<?php // ARCHIVE TITLE VARIATIONS
							$var = get_query_var('post_format');
							if ($var == 'post-format-video') { // IF IS VIDEO FORMAT
								_e('Video Archives', 'wpblink_metro');
							} elseif ($var == 'post-format-audio') { // IF IS AUDIO FORMAT
								_e('Audio Archives', 'wpblink_metro');
							} elseif ($var == 'post-format-gallery') { // IF IS GALLERY FORMAT
								_e('Gallery Archives', 'wpblink_metro');
							} elseif ( is_category() ) { // IF IS CATEGORY ARCHIVE
								single_cat_title();
							} elseif ( is_tag() ) { // IF IS TAG ARCHIVE
								single_tag_title('', true);
							} elseif ( is_author() ) { // IF IS AUTHOR ARCHIVE
								echo $curauth->display_name;
							} elseif ( is_month() ) { // IF IS DATE ARCHIVE
								single_month_title();
							} else { // IF IS NONE OF THE ABOVE
								_e( 'Archives', 'wpblink_metro' );
							}
                        ?>
					</h3>
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    	<?php if ( has_post_thumbnail() ) { // IF POST IMAGE EXISTS ?>
							<a href="<?php the_permalink() ?>" rel="bookmark">
								<?php the_post_thumbnail( 'img_standard', array( 'class' => 'img img_float img_quarter', 'title' => '' ) ); // POST IMAGE ?>
							</a>
						<?php } else { // IF NO POST IMAGE ?>
						<?php } // END IF ?>
						<h4><a href="<?php the_permalink() ?>"><?php the_title(); // POST TITLE ?></a></h4>
						<p class="caps"><?php _e('By','wpblink_metro'); ?> <?php the_author(); ?></p>
                        <div class="contentstyle">
							<?php wpe_excerpt('wpe_excerptlength_moderate', 'wpe_excerptmore'); // POST EXCERPT ?>
                        </div>
						<div class="break seperate toppad"></div>
                    <?php endwhile; else: ?>
                    	<?php get_template_part( '404' ); // IF NOTHING FOUND ?>
                    <?php endif; ?>
                    <div class="break"></div>
					<div class="section group">
						<div class="col span_3_of_3 trans unlimited">            
							<?php paginationlinks(); // ARCHIVE PAGINATION ?>
						</div>
					</div>
                </div>
                <div class="col span_1_of_3 trans unlimited">
                    <?php widget_archive(); // SIDEBAR WIDGETS ?>
                </div>
            </div>
		</div>
	</div>
<?php get_footer(); // FOOTER ?>