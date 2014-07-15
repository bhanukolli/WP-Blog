<?php
function custom_comments($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>

	<li id="comment-<?php comment_ID() ?>" class="comment">
		<div class="single_comment">
		
			<div class="avatar">
				<?php echo get_avatar($comment,$size='80'); ?>
			</div>
			
            <div class="comment_meta">
                <span class="author"><?php echo get_comment_author_link(); ?></span>
                <span class="date"><?php echo get_comment_date(); ?> - <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span>							
            </div><!-- END comment_meta-->
			
			<div class="comment_wrap">
				<?php if ($comment->comment_approved == '0') : ?>
							<em><?php _e('Your comment is awaiting moderation.', 'iwebtheme') ?></em>
						<?php endif; ?>	
				<?php comment_text() ?>			
			</div>
			

		</div>
<?php
} ?>