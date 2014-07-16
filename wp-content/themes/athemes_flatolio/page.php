<?php get_header(); // HEADER ?>
	<div id="innercontentcontainer">
		<div id="innercontent">
            <div class="section group">
                <div class="col span_2_of_3 trans unlimited">
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<h1 class="posttitle"><?php the_title(); // PAGE TITLE ?></h1>
						<?php if ( get_post_meta($post->ID, 'subtitle', true) ) { // IF SUBTITLE EXISTS ?>
							<h6 class="postsubtitle"><?php echo get_post_meta($post->ID, 'subtitle', true); // DISPLAY SUBTITLE ?></h6>
						<?php } else { // IF NO SUBTITLE EXISTS ?>
                        <div class="break smallgap"></div>
						<?php } // DO NOTHING ?>
                        <div class="contentstyle">
                            <?php the_content(); // PAGE CONTENTS ?>
                            <?php wp_link_pages(); // PAGED NAVIGATION ?>
                        </div>
                    <?php endwhile; else: ?>
                    	<?php get_template_part( '404' ); // IF NOTHING FOUND ?>
                    <?php endif; ?>
                </div>
                <div class="col span_1_of_3 trans unlimited">
                    <?php widget_post(); // SIDEBAR WIDGETS ?>
                </div>
            </div>
		</div>
	</div>
<?php get_footer(); // FOOTER ?>