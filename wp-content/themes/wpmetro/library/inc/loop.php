<?php if ( has_post_thumbnail() ) { // IF POST IMAGE EXISTS ?>
	<div class="overlay_wrapper">
		<div class="overlay_image">
			<div class="overlay">
				<a href="<?php the_permalink() ?>" rel="bookmark">
					<?php the_post_thumbnail( 'img_standard', array( 'class' => 'img img_standard', 'title' => '' ) ); // POST IMAGE ?>
				</a>
					<?php if( has_post_format('video')){ ?>
                    <div <?php post_class(); ?>>
                    <span>
                        <?php get_template_part( 'library/formats/video' ); ?>
                        </span>
                        </div>
                    <?php } else { ?>
                        <?php if( has_post_format('audio')){ ?>
                    <div <?php post_class(); ?>>
                    <span>
                        <?php get_template_part( 'library/formats/audio' ); ?>
                        </span>
                        </div>
                        <?php } else { ?>
                            <?php if( has_post_format('gallery')){ ?>
                                                    <div <?php post_class(); ?>>
                    <span>
                        <?php get_template_part( 'library/formats/gallery' ); ?>
                        </span>
                        </div>
                            <?php } else { ?>
                                                
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
				<span class="overlay_title"><a href="<?php the_permalink() ?>"><?php trim_title_short(); // POST TITLE ?></a></span>
			</div>
		</div>
	</div>
<?php } else { // IF NO POST IMAGE ?>
<?php } // END IF ?>