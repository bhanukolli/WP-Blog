<?php 
 /**
  * @package WPBlink_Flatolio
  * @since 1.0
  * @modified  1.0
 */
 
 
	/**
	 * Include all required functions & classes
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/
	
	get_template_part( 'options/options' ); 
	get_template_part( 'options/css' ); 
	get_template_part( 'library/scripts' ); 
	get_template_part( 'library/inc/trim' ); 
	get_template_part( 'library/inc/logo' ); 
	get_template_part( 'library/inc/menus' ); 
	get_template_part( 'library/inc/shortcodes' );
	get_template_part( 'library/inc/widgets' );  
	
	
	

	/**
	 * Queue up the global CSS stylesheet
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/

	function style_global()
	{
		wp_register_style( 'default', get_template_directory_uri() . '/style.css', array(), '2014', 'all' );
		wp_register_style( 'html5reset', get_template_directory_uri() . '/css/html5reset.css', array(), '2014', 'all' );
		wp_register_style( 'core', get_template_directory_uri() . '/css/core.css', array(), '2014', 'all' );
		wp_register_style( 'col', get_template_directory_uri() . '/css/col.css', array(), '2014', 'all' );
		wp_register_style( '2cols', get_template_directory_uri() . '/css/2cols.css', array(), '2014', 'all' );
		wp_register_style( '3cols', get_template_directory_uri() . '/css/3cols.css', array(), '2014', 'all' );
		wp_register_style( '6cols', get_template_directory_uri() . '/css/6cols.css', array(), '2014', 'all' );
		wp_register_style( '5cols', get_template_directory_uri() . '/css/5cols.css', array(), '2014', 'all' );
		wp_register_style( '11cols', get_template_directory_uri() . '/css/11cols.css', array(), '2014', 'all' );
		wp_register_style( '12cols', get_template_directory_uri() . '/css/12cols.css', array(), '2014', 'all' );

		
		
		wp_enqueue_style( 'default' );
		wp_enqueue_style( 'html5reset' );
		wp_enqueue_style( 'core' );
		wp_enqueue_style( 'col' );
		wp_enqueue_style( '2cols' );
		wp_enqueue_style( '3cols' );
		wp_enqueue_style( '6cols' );
		wp_enqueue_style( '5cols' );
		wp_enqueue_style( '11cols' );
		wp_enqueue_style( '12cols' );
		
	}
	add_action( 'wp_enqueue_scripts', 'style_global' );




	/**
	 * Set content maximum width
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/
	
	if ( ! isset( $content_width ) ) $content_width = 1200;
	
	
	
	
	/**
	 * Add support for Wordpress features
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/
	
	add_editor_style('editor.css');
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'custom-background' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'menus' );
	
	


	/**
	 * Prevent any 404s on pagination links
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/

	function remove_page_from_query_string($query_string) {
		if ($query_string['name'] == 'page' && isset($query_string['page'])) {
			unset($query_string['name']);
			list($delim, $page_index) = split('/', $query_string['page']);
			$query_string['paged'] = $page_index;
		}
		return $query_string;
	}
	add_filter('request', 'remove_page_from_query_string');
	
	
	
		
	/**
	 * Register menu locations
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/
	
	register_nav_menus( array(
		'main_menu' => 'Main Menu'
	) );



	/**
	 * Add featured image dimensions
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/
	
	add_image_size( 'img_standard', 1200, 900, true );



	/**
	 * Add multilingual/translation text domain
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/
	
	add_action('after_setup_theme', 'int_setup');
	function int_setup(){
		load_theme_textdomain('wpblink_flatolio', get_template_directory() . '/lang');
	}
	
	
	
	

	/**
	 * Add Portfolio custom post-type
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/

	add_action('init', 'Portfolio');
	
	function Portfolio(){
		$Portfolio_args = array(
			'label'	=> __('Portfolio', 'wpblink_flatolio'),
			'singular_label' =>	__('Portfolio', 'wpblink_flatolio'),
			'public'	=>	true,
			'show_ui'	=>	true,
			'capability_type'	=>	'post',
			'hierarchical'	=>	true,
			'rewrite'	=>	true,
			'has_archive' => true,
			'supports'	=>	array('title', 'editor','page-attributes','thumbnail')
			);
			register_post_type('Portfolio', $Portfolio_args);
	}



	/**
	 * Default commenting system
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/
	
	if ( ! function_exists( 'wpblink_flatolio_comment' ) ) :
		function wpblink_flatolio_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'wpblink_flatolio' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'wpblink_flatolio' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
		break;
		default :
	?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment">
			<div class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 50;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 32;
							echo get_avatar( $comment, $avatar_size );
							printf( __( '%1$s on %2$s <span class="says">said:</span>', 'wpblink_flatolio' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s">%3$s</a>',
							esc_url( get_comment_link( $comment->comment_ID ) ),
							get_comment_time( 'c' ),
							sprintf( __( '%1$s at %2$s', 'wpblink_flatolio' ), get_comment_date(), get_comment_time() )
						)
						);
					?>
					<?php edit_comment_link( __( 'Edit', 'wpblink_flatolio' ), '<span class="edit-link">', '</span>' ); ?>
				</div>
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'wpblink_flatolio' ); ?></em>
					<br />
				<?php endif; ?>
			</div>
			<div class="comment-content"><?php comment_text(); ?></div>
			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'wpblink_flatolio' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</div><!-- #comment-## -->
	<?php
		break;
		endswitch;
		}
	endif;



	/**
	 * Custom archive pagination
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/
	
	function pagination($pages = '', $range = 4) {
		$showitems = ($range * 2)+1;  
		global $paged;
		if(empty($paged)) $paged = 1;
		if($pages == '')
	{
	global $wp_query;
	$pages = $wp_query->max_num_pages;
		if(!$pages)
		{
		$pages = 1;
		}
	}   
	if(1 != $pages)
	{
	echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
		if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
			if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
				for ($i=1; $i <= $pages; $i++)
			{
			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
			{
		echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
		}
	}
	if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";
		if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
			echo "</div>\n";
		}
	}
	function paginationlinks() { ?>
		<?php
			echo '<div class="paginationblock">'; 
			   pagination($pages = '', $range = 1);
		   echo '</div>';
		   if ( mytheme_option( 'appearance_footbar' ) && mytheme_option( 'appearance_footbar' ) == 'choice1' ) { 
                echo '<br /><br />';	
            } else { 
            }
		 ?>
	<?php }




	/**
	 * Register all theme fonts
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/
	
	function themefonts()
	{
		wp_register_style( 'googlefonts', 'http://fonts.googleapis.com/css?family=Raleway:400,600,700,300', array(), '2013', 'all' );
		wp_enqueue_style( 'googlefonts' );
	}
	add_action( 'wp_enqueue_scripts', 'themefonts' );





	/**
	 * Date format selector function
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/
	
	function dateformat() { ?>
		<?php 
		
		if ( mytheme_option( 'date_format' ) && mytheme_option( 'date_format' ) == 'choice2' ) {
			if (function_exists('wp_days_ago')) { 
				wp_days_ago();
			} else { 
				echo the_time('jS F, Y');
			}
		} else {
			if ( mytheme_option( 'date_format' ) && mytheme_option( 'date_format' ) == 'choice1' ) {
				if (function_exists('wp_days_ago')) { 
					wp_days_ago();
				} else { 
					echo the_time('F jS, Y');
				}
			} else {
				if ( mytheme_option( 'date_format' ) && mytheme_option( 'date_format' ) == 'choice3' ) {
					if (function_exists('wp_days_ago')) { 
						wp_days_ago();
					} else { 
						echo the_time('Y, F jS');
					}
				} else {
					if ( mytheme_option( 'date_format' ) && mytheme_option( 'date_format' ) == 'choice4' ) {
						if (function_exists('wp_days_ago')) { 
							wp_days_ago();
						} else { 
							echo the_time('Y, jS F');
						}
					} else {
					}
				}
			}
		}
			
		?>
	<?php }
	
	
	
	
	/**
	 * Display analytics tracking code
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/
		
	function analytics() { ?>	
		<?php if ( mytheme_option( 'misc_analytics' ) && mytheme_option( 'misc_analytics' ) != '' ) { ?>
			<?php $options = get_option( 'misc_analytics' ); $echo_options = $options['misc_analytics']; echo stripslashes($echo_options); ?>
		<?php } else { ?>
		<?php } ?>
	<?php }




	/**
	 * Display custom copyright text
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/
		
	function copyrighttext() { ?>		
		<?php if ( mytheme_option( 'copyright' ) && mytheme_option( 'copyright' ) != '' ) { ?>
			<?php $options = get_option( 'mytheme_options' ); $echo_options = $options['copyright']; echo stripslashes($echo_options); ?>
		<?php } else { ?>
			<?php _e('COPYRIGHT','wpblink_flatolio'); ?> <?php _e('&copy;','wpblink_flatolio'); ?> <?php echo date("Y"); ?> <?php echo get_bloginfo('name'); ?><?php _e('.','wpblink_flatolio'); ?>
		<?php } ?>  
	<?php }
	
	
	
	
	/**
	 * Display the 'Back to Top' button
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/
		
	function backtotop() { ?>		
		<?php if ( mytheme_option( 'select_btt' ) && mytheme_option( 'select_btt' ) == 'choice1' ) { ?>
        	<a class='backtotop' href='#Top'><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_up.png" alt="icon-backtop" class="backtop" /></a>
        <?php } else { ?>
        <?php } ?> 
	<?php }
	
	
	
	
	
	/**
	 * Display the Theme Info button
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/
		
	function themeinfo() { ?>
    	<a href="http://wpblink.com" target="_blank" title="Professional Wordpress Development Studio"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_info.png" alt="icon-themeinfo" class="themeinfo" /></a>		
	<?php }
	
	
	
		
	/**
	 * Modify admin footer text
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/
	
	function remove_footer_admin () {
		echo 'Thank you for creating with <a href="http://www.wordpress.org" target="_blank">WordPress</a>, enhanced by <a href="http://wpblink.com" target="_blank" title="Professional Wordpress Development Studio">WPBlink.com</a>.';
	}
	add_filter('admin_footer_text', 'remove_footer_admin');	


?>