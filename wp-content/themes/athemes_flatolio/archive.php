<?php 
	$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));  // GRAB AUTHOR NAME
	get_header(); // HEADER 
?>
	<div id="innerheadcontainer">
        <div id="innerheadcontent">
            <div class="section group"><!-- section -->
                <div class="col span_3_of_3 trans unlimited"><!-- col -->
                    <h1 class="innertitle">
                        <?php // ARCHIVE TITLE VARIATIONS
                            if ( is_category() ) { // IF IS CATEGORY ARCHIVE
                                single_cat_title();
                            } elseif ( is_tag() ) { // IF IS TAG ARCHIVE
                                single_tag_title('', true);
                            } elseif ( is_author() ) { // IF IS AUTHOR ARCHIVE
                                echo $curauth->display_name;
                            } elseif ( is_month() ) { // IF IS DATE ARCHIVE
                                single_month_title();
                            } else { // IF IS NONE OF THE ABOVE
                                _e( 'Archives', 'wpblink_flatolio' );
                            }
                        ?>
                    </h1>
                </div><!-- /col -->
            </div><!-- /section -->
        </div>
    </div>    
    <div class="innercontentcontainer">
    	<div class="innercontent">
    		<div class="section group"><!-- section -->
                <div class="col span_8_of_12 trans unlimited"><!-- col -->
                    <h5 class="lighttitle">
                        <?php // ARCHIVE TITLE VARIATIONS
                            if ( is_category() ) { // IF IS CATEGORY ARCHIVE
                                _e( 'Category Archive', 'wpblink_flatolio' );
                            } elseif ( is_tag() ) { // IF IS TAG ARCHIVE
                                _e( 'Tag Archive', 'wpblink_flatolio' );
                            } elseif ( is_author() ) { // IF IS AUTHOR ARCHIVE
                                _e( 'Author Archive', 'wpblink_flatolio' );
                            } elseif ( is_month() ) { // IF IS DATE ARCHIVE
                                _e( 'Monthly Archive', 'wpblink_flatolio' );
                            } else { // IF IS NONE OF THE ABOVE
                            }
                        ?>
                    </h5>
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    	<?php if ( has_post_thumbnail() ) { // IF POST IMAGE EXISTS ?>
							<a href="<?php the_permalink() ?>" rel="bookmark">
								<?php the_post_thumbnail( 'img_standard', array( 'class' => 'img img_float img_third_inner', 'title' => '' ) ); // POST IMAGE ?>
							</a>
						<?php } else { // IF NO POST IMAGE ?>
						<?php } // END IF ?>
						<h4><a href="<?php the_permalink() ?>"><?php the_title(); // POST TITLE ?></a></h4>
						<p class="caps"><?php _e('By','wpblink_flatolio'); ?> <?php the_author(); ?></p>
                        <div class="contentstyle short">
							<?php wpe_excerpt('wpe_excerptlength_short', 'wpe_excerptmore'); // POST EXCERPT ?>
                        </div>
						<div class="break seperate"></div>
                    <?php endwhile; else: ?>
                    	<?php get_template_part( '404' ); // IF NOTHING FOUND ?>
                    <?php endif; ?>
                    <?php paginationlinks(); // ARCHIVE PAGINATION ?>
				</div><!-- /col -->
				<div class="col span_4_of_12 trans unlimited"><!-- col -->
					<?php widget_post() // SIDEBAR WIDGETS ?>
				</div><!-- /col -->
			</div><!-- /section -->
		</div>
	</div>
<?php get_footer(); // FOOTER ?>