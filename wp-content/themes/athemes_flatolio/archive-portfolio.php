<?php get_header(); // HEADER ?>
	<div id="innerheadcontainer">
        <div id="innerheadcontent">
            <div class="section group"><!-- section -->
                <div class="col span_3_of_3 trans unlimited"><!-- col -->
                    <h1 class="innertitle">
							<a href="<?php echo get_post_type_archive_link( 'portfolio' ); ?>">
								<?php // POST CATEGORY TITLE
									echo get_post_type();
								?>
							</a>
						</h1>
                </div><!-- /col -->
            </div><!-- /section -->
        </div>
    </div>    
    <div class="innercontentcontainer">
    	<div class="innercontent">
    		<div class="section group"><!-- section -->
				<?php if (have_posts()) : ?>
                	<?php $count = 0; ?>
                	<?php while (have_posts()) : the_post(); ?>
                		<?php $count++; ?>
                		<?php if (($count > 0) && ($count <= 3)) : ?>
                			<div class="col span_4_of_12 trans unlimited centered"><!-- col -->
                				<?php if ( has_post_thumbnail() ) { // IF POST IMAGE EXISTS ?>
                					<a href="<?php the_permalink() ?>" rel="bookmark">
                						<?php the_post_thumbnail( 'img_standard', array( 'class' => 'img img_responsive img_pad', 'title' => '' ) ); // POST IMAGE ?>
                					</a>
                				<?php } else { // IF NO POST IMAGE ?>
                				<?php } // END IF ?>
                				<h4><a href="<?php the_permalink() ?>"><?php the_title(); // POST TITLE ?></a></h4>
                				<div class="break seperate"></div>
                			</div><!-- /col -->
                		<?php else : ?>
                		<?php endif; ?>
                	<?php endwhile; ?>
                <?php else : ?>
                <?php endif; ?>
			</div><!-- /section -->
            <div class="section group"><!-- section -->
				<?php if (have_posts()) : ?>
                	<?php $count = 0; ?>
                	<?php while (have_posts()) : the_post(); ?>
                		<?php $count++; ?>
                		<?php if (($count > 3) && ($count <= 6)) : ?>
                			<div class="col span_4_of_12 trans unlimited centered"><!-- col -->
                				<?php if ( has_post_thumbnail() ) { // IF POST IMAGE EXISTS ?>
                					<a href="<?php the_permalink() ?>" rel="bookmark">
                						<?php the_post_thumbnail( 'img_standard', array( 'class' => 'img img_responsive img_pad', 'title' => '' ) ); // POST IMAGE ?>
                					</a>
                				<?php } else { // IF NO POST IMAGE ?>
                				<?php } // END IF ?>
                				<h4><a href="<?php the_permalink() ?>"><?php the_title(); // POST TITLE ?></a></h4>
                				<div class="break seperate"></div>
                			</div><!-- /col -->
                		<?php else : ?>
                		<?php endif; ?>
                	<?php endwhile; ?>
                <?php else : ?>
                <?php endif; ?>
			</div><!-- /section -->
    		<div class="section group"><!-- section -->
				<?php if (have_posts()) : ?>
                	<?php $count = 0; ?>
                	<?php while (have_posts()) : the_post(); ?>
                		<?php $count++; ?>
                		<?php if (($count > 6) && ($count <= 9)) : ?>
                			<div class="col span_4_of_12 trans unlimited centered"><!-- col -->
                				<?php if ( has_post_thumbnail() ) { // IF POST IMAGE EXISTS ?>
                					<a href="<?php the_permalink() ?>" rel="bookmark">
                						<?php the_post_thumbnail( 'img_standard', array( 'class' => 'img img_responsive img_pad', 'title' => '' ) ); // POST IMAGE ?>
                					</a>
                				<?php } else { // IF NO POST IMAGE ?>
                				<?php } // END IF ?>
                				<h4><a href="<?php the_permalink() ?>"><?php the_title(); // POST TITLE ?></a></h4>
                				<div class="break seperate"></div>
                			</div><!-- /col -->
                		<?php else : ?>
                		<?php endif; ?>
                	<?php endwhile; ?>
                <?php else : ?>
                <?php endif; ?>
                <?php paginationlinks(); // ARCHIVE PAGINATION ?>
			</div><!-- /section -->
		</div>
	</div>
<?php get_footer(); // FOOTER ?>