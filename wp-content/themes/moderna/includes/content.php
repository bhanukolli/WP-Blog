<?php
/**
 * @package WordPress
 * @subpackage Moderna Theme
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="post-image">
			<div class="post-heading">
				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			</div>
		<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
		<?php the_post_thumbnail('full', array('class' => 'img-responsive')); ?>
		<?php endif; ?>
		</div>

	<?php if ( is_search() ) { // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
		<a href="<?php the_permalink(); ?>" class="cta2"><?php echo __('Read more', 'iwebtheme'); ?></a>
	</div><!-- .entry-summary -->
	<?php } else if ( is_category() ) { ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
		<a href="<?php the_permalink(); ?>" class="cta2"><?php echo __('Read more', 'iwebtheme'); ?></a>
	</div><!-- .entry-summary -->	
	
	<?php } else if ( is_single() ) { ?>
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'iwebtheme' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'iwebtheme' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>	
	<?php } else { ?>
		<?php the_excerpt(); ?>


	
		<div class="bottom-article">
			<ul class="meta-post">
				<li><i class="fa fa-calendar"></i><?php the_time('F d, Y'); ?></li>
				<li><i class="fa fa-user"></i> <?php the_author_posts_link(); ?></li>
				<li><i class="fa fa-comments"></i><a href="<?php comments_link(); ?>"><?php comments_number(__('0 Comment', 'iwebtheme'), __('1 Comment', 'iwebtheme'), __('% Comments', 'iwebtheme') );?></a></li>
			</ul>
			<a href="<?php the_permalink(); ?>" class="pull-right"><?php echo __('Continue reading', 'iwebtheme'); ?> <i class="icon-angle-right"></i></a>
		</div>
		<?php } ?>
</article><!-- #post -->