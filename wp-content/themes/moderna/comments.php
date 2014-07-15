<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.','iwebtheme'); ?></p>
	<?php
		return;
	}
?>


<?php if ( comments_open() ) : ?>
<div id="comments" class="">
    <h4 class="title"><?php comments_number(__('0 Comments', 'iwebtheme'), __('1 Comment', 'iwebtheme'), __('% Comments', 'iwebtheme') );?></h4>

<?php if ( have_comments() ) : ?>

<ul class="comment_list">
	<?php wp_list_comments(array(
		'type' => 'comment', // Display Comments
		'avatar_size' => '80', // Adjust Avatar Size
		'callback' => 'custom_comments' // Get Custom Comments Template
	)); ?>
</ul>


<div class="comment-nav">
	<div class="alignleft"><?php previous_comments_link() ?></div>
	<div class="alignright"><?php next_comments_link() ?></div>
</div>

<?php endif; ?>
<?php else :
// comments are closed ?>
<?php endif; ?>


<?php if ( comments_open() ) : ?>


<div id="respond" class="">
<h4><?php _e('Leave a reply','iwebtheme') ?></h4>
<div class="cancel-comment-reply">
<?php cancel_comment_reply_link(); ?>
</div>
<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
<p><?php _e('You must be','iwebtheme'); ?> <a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php _e('logged in','iwebtheme'); ?></a><?php _e(' to post a comment.','iwebtheme'); ?></p>

<?php else : ?>

<form id="contactform" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" role="form">
<?php if ( is_user_logged_in() ) : ?>

<p><?php _e('Logged in as','iwebtheme'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account','iwebtheme'); ?>"><?php _e('Log out','iwebtheme'); ?> &raquo;</a></p>

<?php else : ?>

  <div class="form-group">
    <label for="author"><?php echo __('Name','iwebtheme'); ?></label>
	<div class="controls">
    <input type="text" class="form-control" name="author" id="username" placeholder="">
	</div>
  </div> 
  <div class="form-group">
    <label for="email"><?php echo __('Email','iwebtheme'); ?></label>
	<div class="controls">
    <input type="email" class="form-control" name="email" id="email" placeholder="">
	</div>
  </div>  
  
  <div class="form-group">
    <label for="url"><?php echo __('Website','iwebtheme'); ?></label>
	<div class="controls">
    <input type="text" class="form-control" name="url" id="url" placeholder="">
	</div>
  </div>  

<?php endif; ?>

  <div class="form-group">
    <label for="comment"><?php echo __('Your comment','iwebtheme'); ?></label>
	<div class="controls">
	<textarea id="comment" class="form-control" name="comment" rows="4" cols="3"></textarea>
	</div>
  </div>  

  <div class="form-group">
	<div class="controls">
	 <button id="btn-send" class="btn btn-theme margintop10 pull-left" type="submit"><?php echo __('Send','iwebtheme'); ?></button>
	</div>
  </div>  	

<?php comment_id_fields(); ?>
<?php do_action('comment_form', $post->ID); ?>
</form>
<?php endif;
// registration required and not logged in ?>

</div>
</div>
<?php else :
comment_form();
// comments are closed ?>
<?php endif;
// delete me and the sky will fall on your brain ?>