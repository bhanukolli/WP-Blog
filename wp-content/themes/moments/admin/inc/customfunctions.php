<?php

/*********************************************************************************************

Add Theme Support

*********************************************************************************************/
add_theme_support( 'automatic-feed-links' );

/*********************************************************************************************

Default Wordpress Gallery With PrettyPhoto

*********************************************************************************************/
add_filter( 'wp_get_attachment_link', 'site5framework_prettyphoto');

function site5framework_prettyphoto ($content) {
    $content = preg_replace("/<a/","<a class=\"prettyPhoto[mixed]\"",$content,1);
    return $content;
}


/*********************************************************************************************

Remove and Reformat Admin Footer

*********************************************************************************************/
function remove_footer_admin () {

    $theme    = of_get_theme_info();
    if($theme->parent()) {
      $parentTheme = $theme->parent();
    }
    $themeName = $theme['Name'];
    $themeVersion = $theme['Version'];
    $themeDescription = $theme['Description'];

    echo "<b><a href=http://www.s5themes.com>$themeName - $themeVersion</a></b> - $themeDescription | <a href=www.s5themes.com/>Designed by S5themes.com</a> ";
}
add_filter('admin_footer_text', 'remove_footer_admin');


/*********************************************************************************************

Enable Threaded Comments

*********************************************************************************************/
function enable_threaded_comments(){
if (!is_admin()) {
     if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1))
          wp_enqueue_script('comment-reply');
     }
}

add_action('get_header', 'enable_threaded_comments');



function wpthemess_content_nav() {
	global $wp_query;
	if (  $wp_query->max_num_pages > 1 ) :
		if (function_exists('wp_pagenavi') ) {
			wp_pagenavi();
		} else { ?>
        	<nav id="nav-below">
			<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'site5framework' ); ?></h1>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'site5framework' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'site5framework' ) ); ?></div>
			</nav><!-- #nav-below -->
    	<?php }
	endif;
}

/*********************************************************************************************

WP MU IMAGE SUPPORT

*********************************************************************************************/
function get_image_url() {
    $theImageSrc = wp_get_attachment_url(get_post_thumbnail_id($post_id));
    global $blog_id;
    if (isset($blog_id) && $blog_id > 0) {
        $imageParts = explode('/files/', $theImageSrc);
        if (isset($imageParts[1])) {
            $theImageSrc = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
        }
    }
    echo $theImageSrc;
}

/*********************************************************************************************

WP MU CUSTOM META IMAGE SUPPORT

*********************************************************************************************/
function get_image_path($cutommeta_image) {
$theImageSrc1 = $cutommeta_image;
global $blog_id;
if (isset($blog_id) && $blog_id > 0) {
    $imageParts = explode('/files/', $theImageSrc1);
    if (isset($imageParts[1])) {
        $theImageSrc1 = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
    }
}
return $theImageSrc1;
}



/*********************************************************************************************

COMMENT LAYOUT

*********************************************************************************************/
function site5framework_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>">
			<header class="comment-author vcard">
				<?php echo get_avatar($comment,$size='50',$default='' ); ?>
        <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				<?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?> |
				<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time('F jS, Y'); ?> </a></time>
				<?php edit_comment_link(__('(Edit)'),'  ','') ?>
			</header>

			<section class="comment_content">
				<?php comment_text() ?>

			</section>
      <?php if ($comment->comment_approved == '0') : ?>
      <em style="display:block;"><?php _e('Your comment is awaiting moderation.','site5framework') ?></em>
      <?php endif; ?>

		</article>
    <!-- </li> is added by wordpress automatically -->
<?php
} // don't remove this bracket!


/*******************************
 Audio player
********************************/
function player_audio($postid){

$mp3 = get_post_meta($postid, SN.'audio_post_mp3', $single = true);
$ogg = get_post_meta($postid, SN.'audio_post_ogg', $single = true);
$poster = get_post_meta($postid, SN.'audio_post_poster',true);
?>
<script type="text/javascript">
(function($) {
  $(document).ready(function($){

    if($().jPlayer) {
      $("#jquery_jplayer_<?php echo $postid; ?>").jPlayer({
        ready: function () {
          $(this).jPlayer("setMedia", {
            <?php if($poster != '') : ?>
            poster: "<?php echo $poster['url']; ?>",
            <?php endif; ?>
            <?php if($mp3 != '') : ?>
            mp3: "<?php echo $mp3; ?>",
            <?php endif; ?>
            <?php if($ogg != '') : ?>
            oga: "<?php echo $ogg; ?>",
            <?php endif; ?>
            end: ""
          });
        },
        size: {
                  width: "100%",
                  height:"auto"
              },
        swfPath: "<?php echo get_template_directory_uri(); ?>/lib/jplayer",
        cssSelectorAncestor: "#jp_interface_<?php echo $postid; ?>",
        supplied: "<?php if($ogg != '') : ?>oga,<?php endif; ?><?php if($mp3 != '') : ?>mp3, <?php endif; ?> all"
      });
    }
  });
})(jQuery);
</script>

<div id="jquery_jplayer_<?php echo $postid; ?>" class="jp-jplayer jp-jplayer-audio"></div>
  <div class="jp-audio-container">
      <div class="jp-audio">
           <div class="jp-type-single">
               <div id="jp_interface_<?php echo $postid; ?>" class="jp-interface">
                   <ul class="jp-controls">
                    <li><div class="seperator-first"></div></li>
                       <li><div class="seperator-second"></div></li>
                       <li><a href="#" class="jp-play" tabindex="1">play</a></li>
                       <li><a href="#" class="jp-pause" tabindex="1">pause</a></li>
                       <li><a href="#" class="jp-mute" tabindex="1">mute</a></li>
                       <li><a href="#" class="jp-unmute" tabindex="1">unmute</a></li>
                   </ul>
                   <div class="jp-progress-container">
                       <div class="jp-progress">
                           <div class="jp-seek-bar">
                               <div class="jp-play-bar"></div>
                           </div>
                       </div>
                   </div>
                   <div class="jp-volume-bar-container">
                       <div class="jp-volume-bar">
                           <div class="jp-volume-bar-value"></div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
</div>
<?php


 }?>