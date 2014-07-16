<?php 
 /**
  * @package WPBlink_Metro
  * @since 1.0
  * @modified  1.0
 */
 
 
 
	/**
	 * Unregister some default widgets
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/
	
	function unregister_default_wp_widgets() { 
		unregister_widget('WP_Nav_Menu_Widget');
		unregister_widget('WP_Widget_Recent_Comments');
		unregister_widget('WP_Widget_Search');
	}
	add_action('widgets_init', 'unregister_default_wp_widgets', 1);
	
	

	/**
	 * Customise the tag cloud widget
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/
		
	function custom_tag_cloud_widget($args) {
		$args['number'] = 20; 
		$args['largest'] = 12; 
		$args['smallest'] = 12; 
		$args['unit'] = 'px'; 
		return $args;
	}
	add_filter( 'widget_tag_cloud_args', 'custom_tag_cloud_widget' );



	/**
	 * Register all widgetised sidebars/areas
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/

	if (function_exists('register_sidebar'))
		{
			register_sidebar(array(
				'description' => 'Drop your chosen widgets here to position them in the sidebar on your posts.',
				'before_widget' => '<div class="widget pad_most">',
				'after_widget' => '</div>',
				'before_title' => '<h4>',
				'after_title' => '</h4>',
				'name' => 'Post Sidebar'
			));
		}
	if (function_exists('register_sidebar'))
		{
			register_sidebar(array(
				'description' => 'Drop your chosen widgets here to position them in the sidebar on your archives.',
				'before_widget' => '<div class="widget pad_most">',
				'after_widget' => '</div>',
				'before_title' => '<h4>',
				'after_title' => '</h4>',
				'name' => 'Archive Sidebar'
			));
		}




	/**
	 * Display all registered widgetised sidebars/areas
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/

	function widget_post() { ?>
		<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Post Sidebar') ) : else : ?>
		<?php endif; ?>
	<?php }
	function widget_archive() { ?>
		<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Archive Sidebar') ) : else : ?>
			<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Post Sidebar') ) : else : ?>
			<?php endif; ?>
		<?php endif; ?>
	<?php }




	/**
	 * Create banner advertisement widget
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/

	class wpblink_metro_bannersidead extends WP_Widget {
		function wpblink_metro_bannersidead() {
			$widget_ops = array(
				'classname' => 'widget_wpblink_metro_bannersidead',
				'description' => 'Add any advertisement to a sidebar.'
			);
			$this->WP_Widget(
				'wpblink_metro_bannersidead',
				'[METRO] Advertisement',
				$widget_ops
			);
		}
		function widget( $args, $instance ) {
			extract($args);
			$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
			$text = apply_filters( 'widget_execphp', $instance['text'], $instance );
		?>
		<div class="widget style4 pad_banner">
			<div class="advertisement">
				<?php echo $instance['filter'] ? wpautop($text) : $text; ?>
			</div>
		</div>
		<?php
			}
			function update( $new_instance, $old_instance ) {
				$instance = $old_instance;
				$instance['title'] = strip_tags($new_instance['title']);
				if ( current_user_can('unfiltered_html') )
					$instance['text'] =  $new_instance['text'];
				else
					$instance['text'] = stripslashes( wp_filter_post_kses( $new_instance['text'] ) );
					$instance['filter'] = isset($new_instance['filter']);
					return $instance;
				}
				function form( $instance ) {
					$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
					$title = strip_tags($instance['title']);
					$text = format_to_edit($instance['text']);
			?>
			<p>
				<label for="<?php echo $this->get_field_id("text"); ?>">
					<?php _e( 'Banner Code:', 'wpblink_metro' ); ?>
					<textarea class="widefat" rows="10" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
				</label>
			</p>
			<p><?php _e( 'Add your advertisement code for this space (300*250px for best results).', 'wpblink_metro'); ?></p>
			<hr />
		<?php
			}
		}
	add_action('widgets_init', create_function('', 'return register_widget("wpblink_metro_bannersidead");'));
	
	
	
	
	
	/**
	 * Create large post widget
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/

class wpblink_metro_postlarge extends WP_Widget {
	function wpblink_metro_postlarge() {
		$widget_ops = array(
			'classname' => 'widget_wpblink_metro_postlarge',
			'description' => 'Highlight a single post from any category complete with large post image.'
		);
		$this->WP_Widget(
			'wpblink_metro_postlarge',
			'[METRO] Post Highlight',
			$widget_ops
		);
	}
	function widget($args, $instance) {
		global $post;
		$post_old = $post; 
		extract( $args );
		if( !$instance["title"] ) {
			$category_info = get_category($instance["cat"]);
			$instance["title"] = $category_info->name;
		}
		echo '<div class="widget style1 pad_most">';
		echo $before_title;
		if( $instance["title"] ) 
			echo '<a href="' . get_category_link($instance["cat"]) . '">' . $instance["title"] . '</a>';
		else
			echo '<a href="' . get_category_link($instance["cat"]) . '">' . $instance["cat"] . '</a>';
		echo $after_title;
	?>
		<?php if (isset( $instance["allcats"] )) { ?>
            <?php $my_query = new WP_Query("showposts=1&offset=" . $instance["skip"]); ?>
        <?php } else { ?>
            <?php $my_query = new WP_Query("showposts=1&cat=" . $instance["cat"] . "&offset=" . $instance["skip"]); ?>
        <?php } ?>
        <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
            <?php if ( has_post_thumbnail() ) { // IF POST IMAGE EXISTS ?>
                <a href="<?php the_permalink() ?>" rel="bookmark">
                    <?php the_post_thumbnail( 'img_standard', array( 'class' => 'img img_responsive', 'title' => '' ) ); // POST IMAGE ?>
                </a>
            <?php } else { // IF NO POST IMAGE ?>
            <?php } // END IF ?>
            <h4><a href="<?php the_permalink() ?>"><?php the_title(); // POST TITLE ?></a></h4>
            <?php if (isset( $instance["showtxt"] )) { ?>
		    	<?php wpe_excerpt('wpe_excerptlength_long', 'wpe_excerptmore'); // POST EXCERPT ?>
		    <?php } else { ?>
		    <?php } ?>
            <div class="break toppad"></div>
        <?php endwhile; ?>
	<?php
		echo $after_widget;
		$post = $post_old; 
	}
	function update($new_instance, $old_instance) {
		return $new_instance;
	}
	function form($instance) {
	?>
	<p>
		<label for="<?php echo $this->get_field_id("title"); ?>">
			<?php _e( 'Title:', 'wpblink_metro' ); ?>
			<input class="widefat" id="<?php echo $this->get_field_id("title"); ?>" name="<?php echo $this->get_field_name("title"); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
		</label>
	</p>
	<p><?php _e( 'Give this widget a title, or leave blank to display the category name.', 'wpblink_metro'); ?></p>
	<hr />
	<p>
		<label for="<?php echo $this->get_field_id("cat"); ?>">
			<?php _e( 'Category: &nbsp;', 'wpblink_metro' ); ?>		
			<?php wp_dropdown_categories( array( 'name' => $this->get_field_name("cat"), 'selected' => $instance["cat"] ) ); ?>
		</label>
	</p>
	<p><?php _e( 'Select a specific category to display a post from.', 'wpblink_metro'); ?></p>
	<hr />
	<p>
		<label for="<?php echo $this->get_field_id("allcats"); ?>">
			<?php _e( 'All Categories? &nbsp;', 'wpblink_metro' ); ?>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("allcats"); ?>" name="<?php echo $this->get_field_name("allcats"); ?>"<?php checked( (bool) $instance["allcats"], true ); ?> />
		</label>
	</p>
	<p><?php _e( 'Check the box to display a post from all categories instead, overriding the above setting.', 'wpblink_metro'); ?></p>
	<hr />
	<p>
		<label for="<?php echo $this->get_field_id("skip"); ?>">
			<?php _e( 'Skip X Posts: &nbsp;', 'wpblink_metro' ); ?>
<input style="text-align: center;" id="<?php echo $this->get_field_id("skip"); ?>" name="<?php echo $this->get_field_name("skip"); ?>" type="text" value="<?php echo absint($instance["skip"]); ?>" size='3' />
		</label>
	</p>
	<p><?php _e( 'Enter how many posts to skip before displaying the posts (numerical).', 'wpblink_metro'); ?></p>
	<hr />
	<p>
		<label for="<?php echo $this->get_field_id("showtxt"); ?>">
			<?php _e( 'Show Text Excerpt? &nbsp;', 'wpblink_metro' ); ?>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("showtxt"); ?>" name="<?php echo $this->get_field_name("showtxt"); ?>"<?php checked( (bool) $instance["showtxt"], true ); ?> />
		</label>
	</p>
	<p><?php _e( 'Check the box to display the posts text excerpt.', 'wpblink_metro'); ?></p>
	<hr />
	<?php
		}
	}
	add_action( 'widgets_init', create_function('', 'return register_widget("wpblink_metro_postlarge");') );
	
	
	
	
		
// WIDGET: Post List

class wpblink_metro_postlist extends WP_Widget {
	function wpblink_metro_postlist() {
		$widget_ops = array(
			'classname' => 'widget_wpblink_metro_postlist',
			'description' => 'List posts from any or all of your categories.'
		);
		$this->WP_Widget(
			'wpblink_metro_postlist',
			'[METRO] Post List',
			$widget_ops
		);
	}
	function widget($args, $instance) {
		global $post;
		$post_old = $post; 
		extract( $args );
		if( !$instance["title"] ) {
			$category_info = get_category($instance["cat"]);
			$instance["title"] = $category_info->name;
		}
		echo '<div class="widget style2 pad_most">';
		echo $before_title;
		if( $instance["title"] ) 
			echo '<a href="' . get_category_link($instance["cat"]) . '">' . $instance["title"] . '</a>';
		else
			echo '<a href="' . get_category_link($instance["cat"]) . '">' . $instance["cat"] . '</a>';
		echo $after_title;
	?>
    <ul>
    	<?php if (isset( $instance["allcats"] )) { ?>
    		<?php $my_query = new WP_Query("showposts=" . $instance["show"] . "&offset=" . $instance["skip"]); ?>
    	<?php } else { ?>
    		<?php $my_query = new WP_Query("showposts=" . $instance["show"] . "&cat=" . $instance["cat"] . "&offset=" . $instance["skip"]); ?>
    	<?php } ?>
    	<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
    		<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
    	<?php endwhile; ?>
    </ul>
    <div class="break"></div>
	<?php
		echo $after_widget;
		$post = $post_old; 
	}
	function update($new_instance, $old_instance) {
		return $new_instance;
	}
	function form($instance) {
	?>
	<p>
		<label for="<?php echo $this->get_field_id("title"); ?>">
			<?php _e( 'Title:', 'wpblink_metro' ); ?>
			<input class="widefat" id="<?php echo $this->get_field_id("title"); ?>" name="<?php echo $this->get_field_name("title"); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
		</label>
	</p>
	<p><?php _e( 'Give this widget a title, or leave blank to display the category name.', 'wpblink_metro'); ?></p>
	<hr />
	<p>
		<label for="<?php echo $this->get_field_id("cat"); ?>">
			<?php _e( 'Category: &nbsp;', 'wpblink_metro' ); ?>		
			<?php wp_dropdown_categories( array( 'name' => $this->get_field_name("cat"), 'selected' => $instance["cat"] ) ); ?>
		</label>
	</p>
	<p><?php _e( 'Select a specific category to pull posts from.', 'wpblink_metro'); ?></p>
	<hr />
	<p>
		<label for="<?php echo $this->get_field_id("allcats"); ?>">
			<?php _e( 'All Categories? &nbsp;', 'wpblink_metro' ); ?>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("allcats"); ?>" name="<?php echo $this->get_field_name("allcats"); ?>"<?php checked( (bool) $instance["allcats"], true ); ?> />
		</label>
	</p>
	<p><?php _e( 'Check the box to pull posts from all categories instead, overriding the above setting.', 'wpblink_metro'); ?></p>
	<hr />
	<p>
		<label for="<?php echo $this->get_field_id("show"); ?>">
			<?php _e( 'Show X Posts: &nbsp;', 'wpblink_metro' ); ?>
			<input style="text-align: center;" id="<?php echo $this->get_field_id("show"); ?>" name="<?php echo $this->get_field_name("show"); ?>" type="text" value="<?php echo absint($instance["show"]); ?>" size='3' />
		</label>
	</p>
	<p><?php _e( 'Enter how many posts to display in this list (numerical).', 'wpblink_metro'); ?></p>
	<hr />
	<p>
		<label for="<?php echo $this->get_field_id("skip"); ?>">
			<?php _e( 'Skip X Posts: &nbsp;', 'wpblink_metro' ); ?>
<input style="text-align: center;" id="<?php echo $this->get_field_id("skip"); ?>" name="<?php echo $this->get_field_name("skip"); ?>" type="text" value="<?php echo absint($instance["skip"]); ?>" size='3' />
		</label>
	</p>
	<p><?php _e( 'Enter how many posts to skip before starting the list (numerical).', 'wpblink_metro'); ?></p>
	<hr />
	<?php
		}
	}
	add_action( 'widgets_init', create_function('', 'return register_widget("wpblink_metro_postlist");') );
	
	
	
	
	
// WIDGET: Post Thumbs

class wpblink_metro_postthumb extends WP_Widget {
	function wpblink_metro_postthumb() {
		$widget_ops = array(
			'classname' => 'widget_wpblink_metro_postthumb',
			'description' => 'Display posts from any or all categories with thumbnail post images.'
		);
		$this->WP_Widget(
			'wpblink_metro_postthumb',
			'[METRO] Post Thumbs',
			$widget_ops
		);
	}
	function widget($args, $instance) {
		global $post;
		$post_old = $post; 
		extract( $args );
		if( !$instance["title"] ) {
			$category_info = get_category($instance["cat"]);
			$instance["title"] = $category_info->name;
		}
		echo '<div class="widget style3 pad_most">';
		echo $before_title;
		if( $instance["title"] ) 
			echo '<a href="' . get_category_link($instance["cat"]) . '">' . $instance["title"] . '</a>';
		else
			echo '<a href="' . get_category_link($instance["cat"]) . '">' . $instance["cat"] . '</a>';
		echo $after_title;
	?>
	<?php if (isset( $instance["allcats"] )) { ?>
    	<?php $my_query = new WP_Query("showposts=" . $instance["show"] . "&offset=" . $instance["skip"]); ?>
    <?php } else { ?>
    	<?php $my_query = new WP_Query("showposts=" . $instance["show"] . "&cat=" . $instance["cat"] . "&offset=" . $instance["skip"]); ?>
    <?php } ?>
    <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
    <?php if (isset( $instance["showimg"] )) { ?>
		    	<?php if ( has_post_thumbnail() ) { // IF POST IMAGE EXISTS ?>
    		<a href="<?php the_permalink() ?>" rel="bookmark">
    			<?php the_post_thumbnail( 'img_standard', array( 'class' => 'img img_float img_third', 'title' => '' ) ); // POST IMAGE ?>
    		</a>
    	<?php } else { // IF NO POST IMAGE ?>
    	<?php } // END IF ?>
		    <?php } else { ?>
		    <?php } ?>
    	<h4><a href="<?php the_permalink() ?>"><?php the_title(); // POST TITLE ?></a></h4>
    	<?php wpe_excerpt('wpe_excerptlength_long', 'wpe_excerptmore'); // POST EXCERPT ?>
    	<div class="break seperate toppad"></div>
    <?php endwhile; ?>
	<?php
		echo $after_widget;
		$post = $post_old; 
	}
	function update($new_instance, $old_instance) {
		return $new_instance;
	}
	function form($instance) {
	?>
	<p>
		<label for="<?php echo $this->get_field_id("title"); ?>">
			<?php _e( 'Title:', 'wpblink_metro' ); ?>
			<input class="widefat" id="<?php echo $this->get_field_id("title"); ?>" name="<?php echo $this->get_field_name("title"); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
		</label>
	</p>
	<p><?php _e( 'Give this widget a title, or leave blank to display the category name.', 'wpblink_metro'); ?></p>
	<hr />
	<p>
		<label for="<?php echo $this->get_field_id("cat"); ?>">
			<?php _e( 'Category: &nbsp;', 'wpblink_metro' ); ?>		
			<?php wp_dropdown_categories( array( 'name' => $this->get_field_name("cat"), 'selected' => $instance["cat"] ) ); ?>
		</label>
	</p>
	<p><?php _e( 'Select a specific category to display posts from.', 'wpblink_metro'); ?></p>
	<hr />
	<p>
		<label for="<?php echo $this->get_field_id("allcats"); ?>">
			<?php _e( 'All Categories? &nbsp;', 'wpblink_metro' ); ?>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("allcats"); ?>" name="<?php echo $this->get_field_name("allcats"); ?>"<?php checked( (bool) $instance["allcats"], true ); ?> />
		</label>
	</p>
	<p><?php _e( 'Check the box to display posts from all categories instead, overriding the above setting.', 'wpblink_metro'); ?></p>
	<hr />
	<p>
		<label for="<?php echo $this->get_field_id("show"); ?>">
			<?php _e( 'Show X Posts: &nbsp;', 'wpblink_metro' ); ?>
			<input style="text-align: center;" id="<?php echo $this->get_field_id("show"); ?>" name="<?php echo $this->get_field_name("show"); ?>" type="text" value="<?php echo absint($instance["show"]); ?>" size='3' />
		</label>
	</p>
	<p><?php _e( 'Enter how many posts to display (numerical).', 'wpblink_metro'); ?></p>
	<hr />
	<p>
		<label for="<?php echo $this->get_field_id("skip"); ?>">
			<?php _e( 'Skip X Posts: &nbsp;', 'wpblink_metro' ); ?>
<input style="text-align: center;" id="<?php echo $this->get_field_id("skip"); ?>" name="<?php echo $this->get_field_name("skip"); ?>" type="text" value="<?php echo absint($instance["skip"]); ?>" size='3' />
		</label>
	</p>
	<p><?php _e( 'Enter how many posts to skip before displaying the posts (numerical).', 'wpblink_metro'); ?></p>
	<hr />
	<p>
		<label for="<?php echo $this->get_field_id("showimg"); ?>">
			<?php _e( 'Show Images? &nbsp;', 'wpblink_metro' ); ?>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("showimg"); ?>" name="<?php echo $this->get_field_name("showimg"); ?>"<?php checked( (bool) $instance["showimg"], true ); ?> />
		</label>
	</p>
	<p><?php _e( 'Check the box to display thumbnail images alongside each post.', 'wpblink_metro'); ?></p>
	<hr />
	<?php
		}
	}
	add_action( 'widgets_init', create_function('', 'return register_widget("wpblink_metro_postthumb");') );
	
	
	
	
	
// WIDGET: Latest Comments

class wpblink_metro_latestcomments extends WP_Widget {
	function wpblink_metro_latestcomments() {
		$widget_ops = array(
			'classname' => 'widget_wpblink_metro_latestcomments',
			'description' => 'List your latest comments.'
		);
		$this->WP_Widget(
			'wpblink_metro_latestcomments',
			'[METRO] Latest Comments',
			$widget_ops
		);
	}
	function widget($args, $instance) {
		global $post;
		$post_old = $post; 
		extract( $args );
		echo $before_widget;
		echo $before_title;
		if( $instance["title"] ) 
			echo $instance["title"];
		else
		echo 'Latest Comments';
		echo $after_title;
	?>



<?php
  global $wpdb;
  $sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type,comment_author_url, SUBSTRING(comment_content,1,50) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT 5";

  $comments = $wpdb->get_results($sql);
  $output = $pre_HTML;
  $output .= "\n<ul>";
  foreach ($comments as $comment) {
    $output .= "\n<li><a href=\"" . get_permalink($comment->ID)."#comment-" . $comment->comment_ID . "\" title=\"By ".strip_tags($comment->comment_author) . "\">" . strip_tags($comment->com_excerpt)."</a></li>";
  }
  $output .= "\n</ul>";
  $output .= $post_HTML;
  echo $output;
?>
    
	<?php
		echo $after_widget;
		$post = $post_old; 
	}
	function update($new_instance, $old_instance) {
		return $new_instance;
	}
	function form($instance) {
	?>
	<?php
		}
	}
	add_action( 'widgets_init', create_function('', 'return register_widget("wpblink_metro_latestcomments");') );
	
?>