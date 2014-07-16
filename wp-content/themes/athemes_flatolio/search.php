<?php get_header(); // HEADER ?>
	<div id="innercontentcontainer">
		<div id="innercontent">
            <div class="section group">
                <div class="col span_2_of_3 trans unlimited">
                	<h3 class="innertitle">
						<?php the_search_query(); // SEARCH TERM TITLE ?>
					</h3>
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    	<?php if ( has_post_thumbnail() ) { // IF POST IMAGE EXISTS ?>
							<a href="<?php the_permalink() ?>" rel="bookmark">
								<?php the_post_thumbnail( 'img_standard', array( 'class' => 'img img_float img_quarter', 'title' => '' ) ); // POST IMAGE ?>
							</a>
						<?php } else { // IF NO POST IMAGE ?>
						<?php } // END IF ?>
						<h4><a href="<?php the_permalink() ?>"><?php the_title(); // POST TITLE ?></a></h4>
						<p class="caps"><?php _e('By','wpblink_flatolio'); ?> <?php the_author(); ?></p>
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