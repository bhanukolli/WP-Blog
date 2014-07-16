<?php 
 /**
  * @package WPBlink_Flatolio
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
				'description' => 'Use only [FLATOLIO] prefixed widgets in this location.',
				'before_widget' => '<div class="maincontentcontainer"><div class="maincontent"><div class="section group">',
				'after_widget' => '</div></div></div>',
				'before_title' => '<h4>',
				'after_title' => '</h4>',
				'name' => 'Homepage'
			));
		}
	if (function_exists('register_sidebar'))
		{
			register_sidebar(array(
				'description' => 'Do NOT use [FLATOLIO] prefixed widgets in this location.',
				'before_widget' => '<div class="widget">',
				'after_widget' => '</div>',
				'before_title' => '<h4>',
				'after_title' => '</h4>',
				'name' => 'Post Sidebar'
			));
		}
	if (function_exists('register_sidebar'))
		{
			register_sidebar(array(
				'description' => 'Do NOT use [FLATOLIO] prefixed widgets in this location. If left empty, widgets from Post Sidebar will be displayed instead.',
				'before_widget' => '<div class="widget">',
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
	
	function widget_home() { ?>
		<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Homepage') ) : else : ?>
		<?php endif; ?>
	<?php }
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
	 * Create Advertisement widget
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/

	class wpblink_flatolio_advertisement extends WP_Widget {
		function wpblink_flatolio_advertisement() {
			$widget_ops = array(
				'classname' => 'widget_wpblink_flatolio_advertisement',
				'description' => 'Add any advertisement to a sidebar.'
			);
			$this->WP_Widget(
				'wpblink_flatolio_advertisement',
				'Advertisement',
				$widget_ops
			);
		}
		function widget( $args, $instance ) {
			extract($args);
			$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
			$text = apply_filters( 'widget_execphp', $instance['text'], $instance );
			echo $before_widget;
		?>
			<div class="advertisement pad_all">
				<?php echo $instance['filter'] ? wpautop($text) : $text; ?>
			</div>
		<?php
		echo $after_widget;
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
					<?php _e( 'Banner Code:', 'wpblink_flatolio' ); ?>
					<textarea class="widefat" rows="10" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
				</label>
			</p>
			<p><?php _e( 'Add your advertisement code for this space (300*250px for best results).', 'wpblink_flatolio'); ?></p>
            <p><?php _e( 'Add a class of img_responsive to image-based advertisements to make them responsive.', 'wpblink_flatolio'); ?></p>
			<hr />
		<?php
			}
		}
	add_action('widgets_init', create_function('', 'return register_widget("wpblink_flatolio_advertisement");'));
	
	
	
	
	
	/**
	 * Create Static Content Widget
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/

class wpblink_flatolio_static extends WP_Widget {
	function wpblink_flatolio_static() {
		$widget_ops = array(
			'classname' => 'widget_wpblink_flatolio_static',
			'description' => 'Display any static text with any image.'
		);
		$this->WP_Widget(
			'wpblink_flatolio_static',
			'[FLATOLIO] Static Contents',
			$widget_ops
		);
	}
	function widget($args, $instance) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		$about_text = apply_filters( 'widget_execphp', $instance['about_text'], $instance );
		$about_image = apply_filters( 'widget_execphp', $instance['about_image'], $instance );
		$about_button = apply_filters( 'widget_execphp', $instance['about_button'], $instance );
		$about_button_text = apply_filters( 'widget_execphp', $instance['about_button_text'], $instance );
		$about_intro = apply_filters( 'widget_execphp', $instance['about_intro'], $instance );
		echo $before_widget;
		?>
        <div class="col span_3_of_3 trans unlimited">
    <div class="widget pad_most">
        <?php if ( $about_intro ) { ?>
        <div class="centered">
        	<h1 class="light"><?php echo $instance['filter'] ? wpautop($about_intro) : $about_intro; ?></h1>
        </div>

        	<?php } else { ?>
            <div class="centered">
        	<h1 class="light"><?php _e( 'about', 'wpblink_flatolio' ); ?></h1>
        </div>
        	<?php } ?>
            <?php if ( $about_image ) { ?>
        		<img src="<?php echo $instance['filter'] ? wpautop($about_image) : $about_image; ?>" class="img img_third img_float" alt="<?php echo $instance['filter'] ? wpautop($about_intro) : $about_intro; ?>-image" />
        	<?php } else { ?>
        	<?php } ?>
        <?php if ( $about_text ) { ?>
        	<?php echo $instance['filter'] ? wpautop($about_text) : $about_text; ?>
        <?php } else { ?>
        <?php } ?>
        
        <?php if ( $about_button_text ) { ?>
			<?php if ( $about_button ) { ?>
            <div class="break"></div>
            	<a href="<?php echo $instance['filter'] ? wpautop($about_button) : $about_button; ?>" class="button"><?php echo $instance['filter'] ? wpautop($about_button_text) : $about_button_text; ?></a>
                <div class="break pad_all"></div>
            <?php } else { ?>
            <?php } ?>
		<?php } else { ?>
        <?php } ?>
            
          </div>
          </div> 
          
          <?php  
                            if ( mytheme_option( 'appearance_footbar' ) && mytheme_option( 'appearance_footbar' ) == 'choice1' ) { 
                                echo '<br />';	
                            } else { 
                            } 
                        ?> 
        
        <?php
			echo $after_widget;
			}
			function update( $new_instance, $old_instance ) {
				$instance = $old_instance;

				$instance['title'] = strip_tags($new_instance['title']);
				
				if ( current_user_can('unfiltered_html') )
					$instance['about_text'] =  $new_instance['about_text'];
				else
					$instance['about_text'] = stripslashes( wp_filter_post_kses( $new_instance['about_text'] ) );
					
				if ( current_user_can('unfiltered_html') )
					$instance['about_image'] =  $new_instance['about_image'];
				else
					$instance['about_image'] = stripslashes( wp_filter_post_kses( $new_instance['about_image'] ) );
					
				if ( current_user_can('unfiltered_html') )
					$instance['about_button'] =  $new_instance['about_button'];
				else
					$instance['about_button'] = stripslashes( wp_filter_post_kses( $new_instance['about_button'] ) );
					
				if ( current_user_can('unfiltered_html') )
					$instance['about_button_text'] =  $new_instance['about_button_text'];
				else
					$instance['about_button_text'] = stripslashes( wp_filter_post_kses( $new_instance['about_button_text'] ) );
					
				if ( current_user_can('unfiltered_html') )
					$instance['about_intro'] =  $new_instance['about_intro'];
				else
					$instance['about_intro'] = stripslashes( wp_filter_post_kses( $new_instance['about_intro'] ) );



					$instance['filter'] = isset($new_instance['filter']);
					return $instance;
				}
				function form( $instance ) {
					$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'about_text' => '', 'about_image' => '', 'about_button' => '', 'about_intro' => '', 'about_button_text' => '' ) );
					$title = strip_tags($instance['title']);
					$about_text = format_to_edit($instance['about_text']);
					$about_image = format_to_edit($instance['about_image']);
					$about_button = format_to_edit($instance['about_button']);
					$about_button_text = format_to_edit($instance['about_button_text']);
					$about_intro = format_to_edit($instance['about_intro']);

			?>
                <p>
        <label for="<?php echo $this->get_field_id("about_intro"); ?>">
            <span style="font-weight: bold;"><?php _e( 'Title:', 'wpblink_flatolio' ); ?></span>
            <textarea class="widefat" rows="1" cols="1" id="<?php echo $this->get_field_id('about_intro'); ?>" name="<?php echo $this->get_field_name('about_intro'); ?>"><?php echo $about_intro; ?></textarea>
        </label>
        <?php _e( 'Enter your custom title for this section.', 'wpblink_flatolio' ); ?>
    </p>
    <hr />
    <p>
        <label for="<?php echo $this->get_field_id("about_text"); ?>">
            <span style="font-weight: bold;"><?php _e( 'Content Text:', 'wpblink_flatolio' ); ?></span>
            <textarea class="widefat" rows="6" cols="6" id="<?php echo $this->get_field_id('about_text'); ?>" name="<?php echo $this->get_field_name('about_text'); ?>"><?php echo $about_text; ?></textarea>
        </label>
        <?php _e( 'Add your custom text here, basic HTML allowed.', 'wpblink_flatolio' ); ?>
    </p>
    <hr />
    <p>
        <label for="<?php echo $this->get_field_id("about_image"); ?>">
            <span style="font-weight: bold;"><?php _e( 'Image URL:', 'wpblink_flatolio' ); ?></span>
            <textarea class="widefat" rows="2" cols="2" id="<?php echo $this->get_field_id('about_image'); ?>" name="<?php echo $this->get_field_name('about_image'); ?>"><?php echo $about_image; ?></textarea>
        </label>
        <?php _e( 'Add the full URL (including http://) to your chosen image (800*600px (or similar) for best results (optional).', 'wpblink_flatolio' ); ?>
    </p>
    <hr />
    <p>
        <label for="<?php echo $this->get_field_id("about_button_text"); ?>">
            <span style="font-weight: bold;"><?php _e( 'Button Text:', 'wpblink_flatolio' ); ?></span>
            <textarea class="widefat" rows="1" cols="1" id="<?php echo $this->get_field_id('about_button_text'); ?>" name="<?php echo $this->get_field_name('about_button_text'); ?>"><?php echo $about_button_text; ?></textarea>
        </label>
        <?php _e( 'Enter your custom button text (optional).', 'wpblink_flatolio' ); ?>
    </p>
    <hr />
    <p>
        <label for="<?php echo $this->get_field_id("about_button"); ?>">
            <span style="font-weight: bold;"><?php _e( 'Button URL:', 'wpblink_flatolio' ); ?></span>
            <textarea class="widefat" rows="2" cols="2" id="<?php echo $this->get_field_id('about_button'); ?>" name="<?php echo $this->get_field_name('about_button'); ?>"><?php echo $about_button; ?></textarea>
        </label>
        <?php _e( 'Enter the full destination URL (including http://) for the button (optional).', 'wpblink_flatolio' ); ?>
    </p>
    <hr />
	<?php
		}
	}
	add_action( 'widgets_init', create_function('', 'return register_widget("wpblink_flatolio_static");') );
	
	
	
	
	/**
	 * Create Quote Widget
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/

class wpblink_flatolio_quote extends WP_Widget {
	function wpblink_flatolio_quote() {
		$widget_ops = array(
			'classname' => 'widget_wpblink_flatolio_quote',
			'description' => 'Display a quote slider containing upto 5 independent slides.'
		);
		$this->WP_Widget(
			'wpblink_flatolio_quote',
			'[FLATOLIO] Quote',
			$widget_ops
		);
	}
	function widget($args, $instance) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		$quote_text = apply_filters( 'widget_execphp', $instance['quote_text'], $instance );
		$quote_name = apply_filters( 'widget_execphp', $instance['quote_name'], $instance );
		
		$quote_text2 = apply_filters( 'widget_execphp', $instance['quote_text2'], $instance );
		$quote_name2 = apply_filters( 'widget_execphp', $instance['quote_name2'], $instance );
		
		$quote_text3 = apply_filters( 'widget_execphp', $instance['quote_text3'], $instance );
		$quote_name3 = apply_filters( 'widget_execphp', $instance['quote_name3'], $instance );
		
		$quote_text4 = apply_filters( 'widget_execphp', $instance['quote_text4'], $instance );
		$quote_name4 = apply_filters( 'widget_execphp', $instance['quote_name4'], $instance );
		
		$quote_text5 = apply_filters( 'widget_execphp', $instance['quote_text5'], $instance );
		$quote_name5 = apply_filters( 'widget_execphp', $instance['quote_name5'], $instance );
		
		$quote_intro = apply_filters( 'widget_execphp', $instance['quote_intro'], $instance );
		echo $before_widget;
		?>
        <div class="col span_3_of_3 trans unlimited">
    <div class="widget pad_most">
        <?php if ( $quote_intro ) { ?>
        <div class="centered">
        	<h1 class="light"><?php echo $instance['filter'] ? wpautop($quote_intro) : $quote_intro; ?></h1>
        </div>

        	<?php } else { ?>
            <div class="centered">
        	<h1 class="light"><?php _e( 'quote', 'wpblink_flatolio' ); ?></h1>
        </div>
        	<?php } ?>

            <div id="slides">
<div class="slide-wrapper">
        <?php if ( $quote_text ) { ?>
        	<span class="quote"><?php echo $instance['filter'] ? wpautop($quote_text) : $quote_text; ?></span>
        <?php } else { ?>
        <?php } ?>
        
        <?php if ( $quote_name ) { ?>
        	<div class="centered"><?php echo $instance['filter'] ? wpautop($quote_name) : $quote_name; ?></div>
        <?php } else { ?>
        <?php } ?>
</div>
<div class="slide-wrapper">
        <?php if ( $quote_text2 ) { ?>
        	<span class="quote"><?php echo $instance['filter'] ? wpautop($quote_text2) : $quote_text2; ?></span>
        <?php } else { ?>
        <?php } ?>
        
        <?php if ( $quote_name2 ) { ?>
        	<div class="centered"><?php echo $instance['filter'] ? wpautop($quote_name2) : $quote_name2; ?></div>
        <?php } else { ?>
        <?php } ?>
</div>
<div class="slide-wrapper">
        <?php if ( $quote_text3 ) { ?>
        	<span class="quote"><?php echo $instance['filter'] ? wpautop($quote_text3) : $quote_text3; ?></span>
        <?php } else { ?>
        <?php } ?>
        
        <?php if ( $quote_name3 ) { ?>
        	<div class="centered"><?php echo $instance['filter'] ? wpautop($quote_name3) : $quote_name3; ?></div>
        <?php } else { ?>
        <?php } ?>
</div>
<div class="slide-wrapper">
        <?php if ( $quote_text4 ) { ?>
        	<span class="quote"><?php echo $instance['filter'] ? wpautop($quote_text4) : $quote_text4; ?></span>
        <?php } else { ?>
        <?php } ?>
        
        <?php if ( $quote_name4 ) { ?>
        	<div class="centered"><?php echo $instance['filter'] ? wpautop($quote_name4) : $quote_name4; ?></div>
        <?php } else { ?>
        <?php } ?>
</div>
<div class="slide-wrapper">
        <?php if ( $quote_text5 ) { ?>
        	<span class="quote"><?php echo $instance['filter'] ? wpautop($quote_text5) : $quote_text5; ?></span>
        <?php } else { ?>
        <?php } ?>
        
        <?php if ( $quote_name5 ) { ?>
        	<div class="centered"><?php echo $instance['filter'] ? wpautop($quote_name5) : $quote_name5; ?></div>
        <?php } else { ?>
        <?php } ?>
</div>
</div>
<div id="myController">

<span class="jFlowPrev"></span>
<?php if ( $quote_text ) { ?>
        	<span class="jFlowControl">&nbsp;</span>
        <?php } else { ?>
        <?php } ?>
<?php if ( $quote_text2 ) { ?>
        	<span class="jFlowControl">&nbsp;</span>
        <?php } else { ?>
        <?php } ?>
<?php if ( $quote_text3 ) { ?>
        	<span class="jFlowControl">&nbsp;</span>
        <?php } else { ?>
        <?php } ?>
<?php if ( $quote_text4 ) { ?>
        	<span class="jFlowControl">&nbsp;</span>
        <?php } else { ?>
        <?php } ?>
        <?php if ( $quote_text5 ) { ?>
        	<span class="jFlowControl">&nbsp;</span>
        <?php } else { ?>
        <?php } ?>
<span class="jFlowNext"></span>

</div>

          </div>
          </div>
          
          <div class="break pad_all"></div>  
        
        <?php
			echo $after_widget;
			}
			function update( $new_instance, $old_instance ) {
				$instance = $old_instance;

				$instance['title'] = strip_tags($new_instance['title']);
				
				if ( current_user_can('unfiltered_html') )
					$instance['quote_text'] =  $new_instance['quote_text'];
				else
					$instance['quote_text'] = stripslashes( wp_filter_post_kses( $new_instance['quote_text'] ) );
					
				if ( current_user_can('unfiltered_html') )
					$instance['quote_name'] =  $new_instance['quote_name'];
				else
					$instance['quote_name'] = stripslashes( wp_filter_post_kses( $new_instance['quote_name'] ) );
					
					
					
				if ( current_user_can('unfiltered_html') )
					$instance['quote_text2'] =  $new_instance['quote_text2'];
				else
					$instance['quote_text2'] = stripslashes( wp_filter_post_kses( $new_instance['quote_text2'] ) );
					
				if ( current_user_can('unfiltered_html') )
					$instance['quote_name2'] =  $new_instance['quote_name2'];
				else
					$instance['quote_name2'] = stripslashes( wp_filter_post_kses( $new_instance['quote_name2'] ) );
					
					
					
					
				if ( current_user_can('unfiltered_html') )
					$instance['quote_text3'] =  $new_instance['quote_text3'];
				else
					$instance['quote_text3'] = stripslashes( wp_filter_post_kses( $new_instance['quote_text3'] ) );
					
				if ( current_user_can('unfiltered_html') )
					$instance['quote_name3'] =  $new_instance['quote_name3'];
				else
					$instance['quote_name3'] = stripslashes( wp_filter_post_kses( $new_instance['quote_name3'] ) );
					
					
					
					
				if ( current_user_can('unfiltered_html') )
					$instance['quote_text4'] =  $new_instance['quote_text4'];
				else
					$instance['quote_text4'] = stripslashes( wp_filter_post_kses( $new_instance['quote_text4'] ) );
					
				if ( current_user_can('unfiltered_html') )
					$instance['quote_name4'] =  $new_instance['quote_name4'];
				else
					$instance['quote_name4'] = stripslashes( wp_filter_post_kses( $new_instance['quote_name4'] ) );
					
					
					
					
				if ( current_user_can('unfiltered_html') )
					$instance['quote_text5'] =  $new_instance['quote_text5'];
				else
					$instance['quote_text5'] = stripslashes( wp_filter_post_kses( $new_instance['quote_text5'] ) );
					
				if ( current_user_can('unfiltered_html') )
					$instance['quote_name5'] =  $new_instance['quote_name5'];
				else
					$instance['quote_name5'] = stripslashes( wp_filter_post_kses( $new_instance['quote_name5'] ) );
					
					
					
					
				if ( current_user_can('unfiltered_html') )
					$instance['quote_intro'] =  $new_instance['quote_intro'];
				else
					$instance['quote_intro'] = stripslashes( wp_filter_post_kses( $new_instance['quote_intro'] ) );



					$instance['filter'] = isset($new_instance['filter']);
					return $instance;
				}
				function form( $instance ) {
					$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'quote_text' => '', 'quote_name' => '', 'quote_text2' => '', 'quote_name2' => '', 'quote_text3' => '', 'quote_name3' => '', 'quote_text4' => '', 'quote_name4' => '', 'quote_text5' => '', 'quote_name5' => '', 'quote_intro' => '' ) );
					$title = strip_tags($instance['title']);
					$quote_text = format_to_edit($instance['quote_text']);
					$quote_name = format_to_edit($instance['quote_name']);
					
					$quote_text2 = format_to_edit($instance['quote_text2']);
					$quote_name2 = format_to_edit($instance['quote_name2']);
					
					$quote_text3 = format_to_edit($instance['quote_text3']);
					$quote_name3 = format_to_edit($instance['quote_name3']);
					
					$quote_text4 = format_to_edit($instance['quote_text4']);
					$quote_name4 = format_to_edit($instance['quote_name4']);
					
					$quote_text5 = format_to_edit($instance['quote_text5']);
					$quote_name5 = format_to_edit($instance['quote_name5']);
					
					
					$quote_intro = format_to_edit($instance['quote_intro']);

			?>
                <p>
        <label for="<?php echo $this->get_field_id("quote_intro"); ?>">
            <span style="font-weight: bold;"><?php _e( 'Title:', 'wpblink_flatolio' ); ?></span>
            <textarea class="widefat" rows="1" cols="1" id="<?php echo $this->get_field_id('quote_intro'); ?>" name="<?php echo $this->get_field_name('quote_intro'); ?>"><?php echo $quote_intro; ?></textarea>
        </label>
        <?php _e( 'Enter your custom title for this section.', 'wpblink_flatolio' ); ?>
    </p>
    <hr />
    <p>
        <label for="<?php echo $this->get_field_id("quote_text"); ?>">
            <span style="font-weight: bold;"><?php _e( 'Quote Text:', 'wpblink_flatolio' ); ?></span>
            <textarea class="widefat" rows="6" cols="6" id="<?php echo $this->get_field_id('quote_text'); ?>" name="<?php echo $this->get_field_name('quote_text'); ?>"><?php echo $quote_text; ?></textarea>
        </label>
        <?php _e( 'Add your custom quote text here, basic HTML allowed.', 'wpblink_flatolio' ); ?>
    </p>
    <hr />
    <p>
        <label for="<?php echo $this->get_field_id("quote_name"); ?>">
            <span style="font-weight: bold;"><?php _e( 'Name:', 'wpblink_flatolio' ); ?></span>
            <textarea class="widefat" rows="1" cols="1" id="<?php echo $this->get_field_id('quote_name'); ?>" name="<?php echo $this->get_field_name('quote_name'); ?>"><?php echo $quote_name; ?></textarea>
        </label>
        <?php _e( 'Add your custom quote name text here (optional).', 'wpblink_flatolio' ); ?>
    </p>
    <hr />
    <p>
        <label for="<?php echo $this->get_field_id("quote_text2"); ?>">
            <span style="font-weight: bold;"><?php _e( 'Quote Text #2:', 'wpblink_flatolio' ); ?></span>
            <textarea class="widefat" rows="6" cols="6" id="<?php echo $this->get_field_id('quote_text2'); ?>" name="<?php echo $this->get_field_name('quote_text2'); ?>"><?php echo $quote_text2; ?></textarea>
        </label>
        <?php _e( 'Add your custom quote text here, basic HTML allowed.', 'wpblink_flatolio' ); ?>
    </p>
    <hr />
    <p>
        <label for="<?php echo $this->get_field_id("quote_name2"); ?>">
            <span style="font-weight: bold;"><?php _e( 'Name #2:', 'wpblink_flatolio' ); ?></span>
            <textarea class="widefat" rows="1" cols="1" id="<?php echo $this->get_field_id('quote_name2'); ?>" name="<?php echo $this->get_field_name('quote_name2'); ?>"><?php echo $quote_name2; ?></textarea>
        </label>
        <?php _e( 'Add your custom quote name text here (optional).', 'wpblink_flatolio' ); ?>
    </p>
    <hr />
    <p>
        <label for="<?php echo $this->get_field_id("quote_text3"); ?>">
            <span style="font-weight: bold;"><?php _e( 'Quote Text #3:', 'wpblink_flatolio' ); ?></span>
            <textarea class="widefat" rows="6" cols="6" id="<?php echo $this->get_field_id('quote_text3'); ?>" name="<?php echo $this->get_field_name('quote_text3'); ?>"><?php echo $quote_text3; ?></textarea>
        </label>
        <?php _e( 'Add your custom quote text here, basic HTML allowed.', 'wpblink_flatolio' ); ?>
    </p>
    <hr />
    <p>
        <label for="<?php echo $this->get_field_id("quote_name3"); ?>">
            <span style="font-weight: bold;"><?php _e( 'Name #3:', 'wpblink_flatolio' ); ?></span>
            <textarea class="widefat" rows="1" cols="1" id="<?php echo $this->get_field_id('quote_name3'); ?>" name="<?php echo $this->get_field_name('quote_name3'); ?>"><?php echo $quote_name3; ?></textarea>
        </label>
        <?php _e( 'Add your custom quote name text here (optional).', 'wpblink_flatolio' ); ?>
    </p>
    <hr />
    <p>
        <label for="<?php echo $this->get_field_id("quote_text4"); ?>">
            <span style="font-weight: bold;"><?php _e( 'Quote Text #4:', 'wpblink_flatolio' ); ?></span>
            <textarea class="widefat" rows="6" cols="6" id="<?php echo $this->get_field_id('quote_text4'); ?>" name="<?php echo $this->get_field_name('quote_text4'); ?>"><?php echo $quote_text4; ?></textarea>
        </label>
        <?php _e( 'Add your custom quote text here, basic HTML allowed.', 'wpblink_flatolio' ); ?>
    </p>
    <hr />
    <p>
        <label for="<?php echo $this->get_field_id("quote_name4"); ?>">
            <span style="font-weight: bold;"><?php _e( 'Name #4:', 'wpblink_flatolio' ); ?></span>
            <textarea class="widefat" rows="1" cols="1" id="<?php echo $this->get_field_id('quote_name4'); ?>" name="<?php echo $this->get_field_name('quote_name4'); ?>"><?php echo $quote_name4; ?></textarea>
        </label>
        <?php _e( 'Add your custom quote name text here (optional).', 'wpblink_flatolio' ); ?>
    </p>
    <hr />
    <p>
        <label for="<?php echo $this->get_field_id("quote_text5"); ?>">
            <span style="font-weight: bold;"><?php _e( 'Quote Text #5:', 'wpblink_flatolio' ); ?></span>
            <textarea class="widefat" rows="6" cols="6" id="<?php echo $this->get_field_id('quote_text5'); ?>" name="<?php echo $this->get_field_name('quote_text5'); ?>"><?php echo $quote_text5; ?></textarea>
        </label>
        <?php _e( 'Add your custom quote text here, basic HTML allowed.', 'wpblink_flatolio' ); ?>
    </p>
    <hr />
    <p>
        <label for="<?php echo $this->get_field_id("quote_name5"); ?>">
            <span style="font-weight: bold;"><?php _e( 'Name #5:', 'wpblink_flatolio' ); ?></span>
            <textarea class="widefat" rows="1" cols="1" id="<?php echo $this->get_field_id('quote_name5'); ?>" name="<?php echo $this->get_field_name('quote_name5'); ?>"><?php echo $quote_name5; ?></textarea>
        </label>
        <?php _e( 'Add your custom quote name text here (optional).', 'wpblink_flatolio' ); ?>
    </p>
    <hr />
	<?php
		}
	}
	add_action( 'widgets_init', create_function('', 'return register_widget("wpblink_flatolio_quote");') );
	
	
	
	
		
	
	/**
	 * Create Portfolio Widget
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/

class wpblink_flatolio_portfolio extends WP_Widget {
	function wpblink_flatolio_portfolio() {
		$widget_ops = array(
			'classname' => 'widget_wpblink_flatolio_portfolio',
			'description' => 'Display your latest posts from the Portfolio post-type.'
		);
		$this->WP_Widget(
			'wpblink_flatolio_portfolio',
			'[FLATOLIO] Portfolio',
			$widget_ops
		);
	}
	function widget($args, $instance) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		$portfolio_intro = apply_filters( 'widget_execphp', $instance['portfolio_intro'], $instance );
		$portfolio_button = apply_filters( 'widget_execphp', $instance['portfolio_button'], $instance );
		$portfolio_button_text = apply_filters( 'widget_execphp', $instance['portfolio_button_text'], $instance );
		?>
        <?php if ( $portfolio_intro ) { ?>
        	<?php echo '<h1 class="light_alt">'; echo $instance['filter'] ? wpautop($portfolio_intro) : $portfolio_intro; echo '</h1>'; ?>
        <?php } else { ?>
        	<?php echo '<h1 class="light_alt">'; _e( 'portfolio', 'wpblink_flatolio' ); echo '</h1>'; ?>
        <?php } ?>
        <?php echo $before_widget; ?>
        <div class="col span_1_of_3 trans unlimited">
            <div class="widget pad_more">
				<?php $my_query = new WP_Query("post_type=Portfolio&showposts=1&offset=0"); ?>
                <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
                    <?php if ( has_post_thumbnail() ) { // IF POST IMAGE EXISTS ?>
                    	<div class="overlay_wrapper">
                    		<div class="overlay_image">
                    			<div class="overlay">
                        			<a href="<?php the_permalink() ?>" rel="bookmark">
                            			<?php the_post_thumbnail( 'img_standard', array( 'class' => 'img img_responsive', 'title' => '' ) ); // POST IMAGE ?>
                            			<span><?php the_title(); // POST TITLE ?></span>
                        			</a>
                        		</div>
                        	</div>
                        </div>
                    <?php } else { // IF NO POST IMAGE ?>
                    <?php } // END IF ?>
                <?php endwhile; ?>
            </div>
		</div>
        <div class="col span_1_of_3 trans unlimited">
	        <div class="widget pad_more">
				<?php $my_query = new WP_Query("post_type=Portfolio&showposts=1&offset=1"); ?>
                <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
                    <?php if ( has_post_thumbnail() ) { // IF POST IMAGE EXISTS ?>
                    	<div class="overlay_wrapper">
                    		<div class="overlay_image">
                    			<div class="overlay">
                        			<a href="<?php the_permalink() ?>" rel="bookmark">
                            			<?php the_post_thumbnail( 'img_standard', array( 'class' => 'img img_responsive', 'title' => '' ) ); // POST IMAGE ?>
                            			<span><?php the_title(); // POST TITLE ?></span>
                        			</a>
                        		</div>
                        	</div>
                        </div>
                    <?php } else { // IF NO POST IMAGE ?>
                    <?php } // END IF ?>
                <?php endwhile; ?>
	        </div>
		</div>
        <div class="col span_1_of_3 trans unlimited">
	        <div class="widget pad_more">
				<?php $my_query = new WP_Query("post_type=Portfolio&showposts=1&offset=2"); ?>
                <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
                    <?php if ( has_post_thumbnail() ) { // IF POST IMAGE EXISTS ?>
                    	<div class="overlay_wrapper">
                    		<div class="overlay_image">
                    			<div class="overlay">
                        			<a href="<?php the_permalink() ?>" rel="bookmark">
                            			<?php the_post_thumbnail( 'img_standard', array( 'class' => 'img img_responsive', 'title' => '' ) ); // POST IMAGE ?>
                            			<span><?php the_title(); // POST TITLE ?></span>
                        			</a>
                        		</div>
                        	</div>
                        </div>
                    <?php } else { // IF NO POST IMAGE ?>
                    <?php } // END IF ?>
                <?php endwhile; ?>
				<?php if ( $portfolio_button_text ) { ?>
        			<?php if ( $portfolio_button ) { ?>
            			<div class="break pad_all"></div>
        				<a href="<?php echo $instance['filter'] ? wpautop($portfolio_button) : $portfolio_button; ?>" class="button">
							<?php echo $instance['filter'] ? wpautop($portfolio_button_text) : $portfolio_button_text; ?>
                		</a>
                		<div class="break pad_all"></div>
        			<?php } else { ?>
        			<?php } ?>
        		<?php } else { ?>
        		<?php } ?>
	        </div>
		</div>
        <?php
			echo $after_widget;
			}
			function update( $new_instance, $old_instance ) {
				$instance = $old_instance;

				$instance['title'] = strip_tags($new_instance['title']);

				if ( current_user_can('unfiltered_html') )
					$instance['portfolio_intro'] =  $new_instance['portfolio_intro'];
				else
					$instance['portfolio_intro'] = stripslashes( wp_filter_post_kses( $new_instance['portfolio_intro'] ) );
					
				if ( current_user_can('unfiltered_html') )
					$instance['portfolio_button'] =  $new_instance['portfolio_button'];
				else
					$instance['portfolio_button'] = stripslashes( wp_filter_post_kses( $new_instance['portfolio_button'] ) );
					
				if ( current_user_can('unfiltered_html') )
					$instance['portfolio_button_text'] =  $new_instance['portfolio_button_text'];
				else
					$instance['portfolio_button_text'] = stripslashes( wp_filter_post_kses( $new_instance['portfolio_button_text'] ) );



					$instance['filter'] = isset($new_instance['filter']);
					return $instance;
				}
				function form( $instance ) {
					$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'portfolio_intro' => '', 'portfolio_button' => '', 'portfolio_button_text' => '' ) );
					$title = strip_tags($instance['title']);

					$portfolio_intro = format_to_edit($instance['portfolio_intro']);
					$portfolio_button = format_to_edit($instance['portfolio_button']);
					$portfolio_button_text = format_to_edit($instance['portfolio_button_text']);

			?>
                <p>
        <label for="<?php echo $this->get_field_id("portfolio_intro"); ?>">
            <span style="font-weight: bold;"><?php _e( 'Title:', 'wpblink_flatolio' ); ?></span>
            <textarea class="widefat" rows="1" cols="1" id="<?php echo $this->get_field_id('portfolio_intro'); ?>" name="<?php echo $this->get_field_name('portfolio_intro'); ?>"><?php echo $portfolio_intro; ?></textarea>
        </label>
        <?php _e( 'Enter your custom title for this section.', 'wpblink_flatolio' ); ?>
    </p>
        <hr />
    <p>
        <label for="<?php echo $this->get_field_id("portfolio_button_text"); ?>">
            <span style="font-weight: bold;"><?php _e( 'Button Text:', 'wpblink_flatolio' ); ?></span>
            <textarea class="widefat" rows="1" cols="1" id="<?php echo $this->get_field_id('portfolio_button_text'); ?>" name="<?php echo $this->get_field_name('portfolio_button_text'); ?>"><?php echo $portfolio_button_text; ?></textarea>
        </label>
        <?php _e( 'Enter your custom button text (optional).', 'wpblink_flatolio' ); ?>
    </p>
    <hr />
    <p>
        <label for="<?php echo $this->get_field_id("portfolio_button"); ?>">
            <span style="font-weight: bold;"><?php _e( 'Button URL:', 'wpblink_flatolio' ); ?></span>
            <textarea class="widefat" rows="2" cols="2" id="<?php echo $this->get_field_id('portfolio_button'); ?>" name="<?php echo $this->get_field_name('portfolio_button'); ?>"><?php echo $portfolio_button; ?></textarea>
        </label>
        <?php _e( 'Enter the full destination URL (including http://) for the button (optional).', 'wpblink_flatolio' ); ?>
    </p>
    <hr />
	<?php
		}
	}
	add_action( 'widgets_init', create_function('', 'return register_widget("wpblink_flatolio_portfolio");') );
	
	
	
	
	
	/**
	 * Create Promotional Widget
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/

class wpblink_flatolio_promo extends WP_Widget {
	function wpblink_flatolio_promo() {
		$widget_ops = array(
			'classname' => 'widget_wpblink_flatolio_promo',
			'description' => 'Add your custom text and images to promote anything you like.'
		);
		$this->WP_Widget(
			'wpblink_flatolio_promo',
			'[FLATOLIO] Promotional Content',
			$widget_ops
		);
	}
	function widget($args, $instance) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		$promo_intro = apply_filters( 'widget_execphp', $instance['promo_intro'], $instance );
		$promo_image_1 = apply_filters( 'widget_execphp', $instance['promo_image_1'], $instance );
		$promo_text_1 = apply_filters( 'widget_execphp', $instance['promo_text_1'], $instance );
		$promo_url_1 = apply_filters( 'widget_execphp', $instance['promo_url_1'], $instance );
		$promo_image_2 = apply_filters( 'widget_execphp', $instance['promo_image_2'], $instance );
		$promo_text_2 = apply_filters( 'widget_execphp', $instance['promo_text_2'], $instance );
		$promo_url_2 = apply_filters( 'widget_execphp', $instance['promo_url_2'], $instance );
		$promo_image_3 = apply_filters( 'widget_execphp', $instance['promo_image_3'], $instance );
		$promo_text_3 = apply_filters( 'widget_execphp', $instance['promo_text_3'], $instance );
		$promo_url_3 = apply_filters( 'widget_execphp', $instance['promo_url_3'], $instance );
		$promo_image_4 = apply_filters( 'widget_execphp', $instance['promo_image_4'], $instance );
		$promo_text_4 = apply_filters( 'widget_execphp', $instance['promo_text_4'], $instance );
		$promo_url_4 = apply_filters( 'widget_execphp', $instance['promo_url_4'], $instance );
		?>
        <?php if ( $promo_intro ) { ?>
        	<?php echo '<h1 class="light_alt">'; echo $instance['filter'] ? wpautop($promo_intro) : $promo_intro; echo '</h1>'; ?>
        <?php } else { ?>
        	<?php echo '<h1 class="light_alt">'; _e( 'promotion', 'wpblink_flatolio' ); echo '</h1>'; ?>
        <?php } ?>
        <?php echo $before_widget; ?>
        <div class="col span_3_of_12 trans unlimited">
            <div class="widget pad_more centered">
            	<?php if ( $promo_url_1 ) { ?>
                    <a href="<?php echo $instance['filter'] ? wpautop($promo_url_1) : $promo_url_1; ?>" rel="bookmark">
                        <?php if ( $promo_image_1 ) { ?>
                            <img src="<?php echo $instance['filter'] ? wpautop($promo_image_1) : $promo_image_1; ?>" class="img img_responsive img_pad" alt="<?php echo $instance['filter'] ? wpautop($promo_image_1) : $promo_image_1; ?>-image" />
                        <?php } else { ?>
                        <?php } ?>
                        <?php if ( $promo_text_1 ) { ?>
                            <?php echo $instance['filter'] ? wpautop($promo_text_1) : $promo_text_1; ?>
                        <?php } else { ?>
                        <?php } ?>
                    </a>
                <?php } else { ?>
                	<?php if ( $promo_image_1 ) { ?>
                        <img src="<?php echo $instance['filter'] ? wpautop($promo_image_1) : $promo_image_1; ?>" class="img img_responsive img_pad" alt="<?php echo $instance['filter'] ? wpautop($promo_image_1) : $promo_image_1; ?>-image" />
                    <?php } else { ?>
                    <?php } ?>
                    <?php if ( $promo_text_1 ) { ?>
                        <?php echo $instance['filter'] ? wpautop($promo_text_1) : $promo_text_1; ?>
                    <?php } else { ?>
                    <?php } ?>
				<?php } ?>
            </div>
		</div>
        <div class="col span_3_of_12 trans unlimited">
            <div class="widget pad_more centered">
				<?php if ( $promo_url_2 ) { ?>
                    <a href="<?php echo $instance['filter'] ? wpautop($promo_url_2) : $promo_url_2; ?>" rel="bookmark">
                        <?php if ( $promo_image_2 ) { ?>
                            <img src="<?php echo $instance['filter'] ? wpautop($promo_image_2) : $promo_image_2; ?>" class="img img_responsive img_pad" alt="<?php echo $instance['filter'] ? wpautop($promo_image_2) : $promo_image_2; ?>-image" />
                        <?php } else { ?>
                        <?php } ?>
                        <?php if ( $promo_text_2 ) { ?>
                            <?php echo $instance['filter'] ? wpautop($promo_text_2) : $promo_text_2; ?>
                        <?php } else { ?>
                        <?php } ?>
                    </a>
                <?php } else { ?>
                	<?php if ( $promo_image_2 ) { ?>
                        <img src="<?php echo $instance['filter'] ? wpautop($promo_image_2) : $promo_image_2; ?>" class="img img_responsive img_pad" alt="<?php echo $instance['filter'] ? wpautop($promo_image_2) : $promo_image_2; ?>-image" />
                    <?php } else { ?>
                    <?php } ?>
                    <?php if ( $promo_text_2 ) { ?>
                        <?php echo $instance['filter'] ? wpautop($promo_text_2) : $promo_text_2; ?>
                    <?php } else { ?>
                    <?php } ?>
				<?php } ?>
            </div>
		</div>
        <div class="col span_3_of_12 trans unlimited">
            <div class="widget pad_more centered">
            	<?php if ( $promo_url_3 ) { ?>
                    <a href="<?php echo $instance['filter'] ? wpautop($promo_url_3) : $promo_url_3; ?>" rel="bookmark">
                        <?php if ( $promo_image_3 ) { ?>
                            <img src="<?php echo $instance['filter'] ? wpautop($promo_image_3) : $promo_image_3; ?>" class="img img_responsive img_pad" alt="<?php echo $instance['filter'] ? wpautop($promo_image_3) : $promo_image_3; ?>-image" />
                        <?php } else { ?>
                        <?php } ?>
                        <?php if ( $promo_text_3 ) { ?>
                            <?php echo $instance['filter'] ? wpautop($promo_text_3) : $promo_text_3; ?>
                        <?php } else { ?>
                        <?php } ?>
                    </a>
                <?php } else { ?>
                	<?php if ( $promo_image_3 ) { ?>
                        <img src="<?php echo $instance['filter'] ? wpautop($promo_image_3) : $promo_image_3; ?>" class="img img_responsive img_pad" alt="<?php echo $instance['filter'] ? wpautop($promo_image_3) : $promo_image_3; ?>-image" />
                    <?php } else { ?>
                    <?php } ?>
                    <?php if ( $promo_text_3 ) { ?>
                        <?php echo $instance['filter'] ? wpautop($promo_text_3) : $promo_text_3; ?>
                    <?php } else { ?>
                    <?php } ?>
				<?php } ?>
            </div>
		</div>
        <div class="col span_3_of_12 trans unlimited">
            <div class="widget pad_more centered">
				<?php if ( $promo_url_3 ) { ?>
                    <a href="<?php echo $instance['filter'] ? wpautop($promo_url_4) : $promo_url_4; ?>" rel="bookmark">
                        <?php if ( $promo_image_4 ) { ?>
                            <img src="<?php echo $instance['filter'] ? wpautop($promo_image_4) : $promo_image_4; ?>" class="img img_responsive img_pad" alt="<?php echo $instance['filter'] ? wpautop($promo_image_4) : $promo_image_4; ?>-image" />
                        <?php } else { ?>
                        <?php } ?>
                        <?php if ( $promo_text_4 ) { ?>
                            <?php echo $instance['filter'] ? wpautop($promo_text_4) : $promo_text_4; ?>
                        <?php } else { ?>
                        <?php } ?>
                    </a>
                <?php } else { ?>
                	<?php if ( $promo_image_4 ) { ?>
                        <img src="<?php echo $instance['filter'] ? wpautop($promo_image_4) : $promo_image_4; ?>" class="img img_responsive img_pad" alt="<?php echo $instance['filter'] ? wpautop($promo_image_4) : $promo_image_4; ?>-image" />
                    <?php } else { ?>
                    <?php } ?>
                    <?php if ( $promo_text_4 ) { ?>
                        <?php echo $instance['filter'] ? wpautop($promo_text_4) : $promo_text_4; ?>
                    <?php } else { ?>
                    <?php } ?>
				<?php } ?>
            </div>
		</div>
        <?php
			echo $after_widget;
			}
			function update( $new_instance, $old_instance ) {
				$instance = $old_instance;
				$instance['title'] = strip_tags($new_instance['title']);
				if ( current_user_can('unfiltered_html') )
					$instance['promo_image_1'] =  $new_instance['promo_image_1'];
				else
					$instance['promo_image_1'] = stripslashes( wp_filter_post_kses( $new_instance['promo_image_1'] ) );
				if ( current_user_can('unfiltered_html') )
					$instance['promo_text_1'] =  $new_instance['promo_text_1'];
				else
					$instance['promo_text_1'] = stripslashes( wp_filter_post_kses( $new_instance['promo_text_1'] ) );
				if ( current_user_can('unfiltered_html') )
					$instance['promo_url_1'] =  $new_instance['promo_url_1'];
				else
					$instance['promo_url_1'] = stripslashes( wp_filter_post_kses( $new_instance['promo_url_1'] ) );
				if ( current_user_can('unfiltered_html') )
					$instance['promo_image_2'] =  $new_instance['promo_image_2'];
				else
					$instance['promo_image_2'] = stripslashes( wp_filter_post_kses( $new_instance['promo_image_2'] ) );
				if ( current_user_can('unfiltered_html') )
					$instance['promo_text_2'] =  $new_instance['promo_text_2'];
				else
					$instance['promo_text_2'] = stripslashes( wp_filter_post_kses( $new_instance['promo_text_2'] ) );
				if ( current_user_can('unfiltered_html') )
					$instance['promo_url_2'] =  $new_instance['promo_url_2'];
				else
					$instance['promo_url_2'] = stripslashes( wp_filter_post_kses( $new_instance['promo_url_2'] ) );
				if ( current_user_can('unfiltered_html') )
					$instance['promo_image_3'] =  $new_instance['promo_image_3'];
				else
					$instance['promo_image_3'] = stripslashes( wp_filter_post_kses( $new_instance['promo_image_3'] ) );
				if ( current_user_can('unfiltered_html') )
					$instance['promo_text_3'] =  $new_instance['promo_text_3'];
				else
					$instance['promo_text_3'] = stripslashes( wp_filter_post_kses( $new_instance['promo_text_3'] ) );
				if ( current_user_can('unfiltered_html') )
					$instance['promo_url_3'] =  $new_instance['promo_url_3'];
				else
					$instance['promo_url_3'] = stripslashes( wp_filter_post_kses( $new_instance['promo_url_3'] ) );
				if ( current_user_can('unfiltered_html') )
					$instance['promo_image_4'] =  $new_instance['promo_image_4'];
				else
					$instance['promo_image_4'] = stripslashes( wp_filter_post_kses( $new_instance['promo_image_4'] ) );
				if ( current_user_can('unfiltered_html') )
					$instance['promo_text_4'] =  $new_instance['promo_text_4'];
				else
					$instance['promo_text_4'] = stripslashes( wp_filter_post_kses( $new_instance['promo_text_4'] ) );
				if ( current_user_can('unfiltered_html') )
					$instance['promo_url_4'] =  $new_instance['promo_url_4'];
				else
					$instance['promo_url_4'] = stripslashes( wp_filter_post_kses( $new_instance['promo_url_4'] ) );
				if ( current_user_can('unfiltered_html') )
					$instance['promo_intro'] =  $new_instance['promo_intro'];
				else
					$instance['promo_intro'] = stripslashes( wp_filter_post_kses( $new_instance['promo_intro'] ) );
					$instance['filter'] = isset($new_instance['filter']);
					return $instance;
				}
				function form( $instance ) {
					$instance = wp_parse_args( (array) $instance, array( 
						'title' => '', 
						'promo_intro' => '', 
						'promo_image_1' => '', 
						'promo_text_1' => '', 
						'promo_image_2' => '', 
						'promo_text_2' => '', 
						'promo_image_3' => '', 
						'promo_text_3' => '', 
						'promo_image_4' => '', 
						'promo_text_4' => '', 
						'promo_url_1' => '', 
						'promo_url_2' => '', 
						'promo_url_3' => '', 
						'promo_url_4' => ''
					 ) );
					$title = strip_tags($instance['title']);
					$promo_intro = format_to_edit($instance['promo_intro']);
					$promo_image_1 = format_to_edit($instance['promo_image_1']);
					$promo_text_1 = format_to_edit($instance['promo_text_1']);
					$promo_url_1 = format_to_edit($instance['promo_url_1']);
					$promo_image_2 = format_to_edit($instance['promo_image_2']);
					$promo_text_2 = format_to_edit($instance['promo_text_2']);
					$promo_url_2 = format_to_edit($instance['promo_url_2']);
					$promo_image_3 = format_to_edit($instance['promo_image_3']);
					$promo_text_3 = format_to_edit($instance['promo_text_3']);
					$promo_url_3 = format_to_edit($instance['promo_url_3']);
					$promo_image_4 = format_to_edit($instance['promo_image_4']);
					$promo_text_4 = format_to_edit($instance['promo_text_4']);
					$promo_url_4 = format_to_edit($instance['promo_url_4']);
			?>
            <p>
            	<label for="<?php echo $this->get_field_id("promo_intro"); ?>">
            		<span style="font-weight: bold;"><?php _e( 'Title:', 'wpblink_flatolio' ); ?></span>
            		<textarea class="widefat" rows="1" cols="1" id="<?php echo $this->get_field_id('promo_intro'); ?>" name="<?php echo $this->get_field_name('promo_intro'); ?>"><?php echo $promo_intro; ?></textarea>
            	</label>
            	<?php _e( 'Enter your custom title for this section.', 'wpblink_flatolio' ); ?>
            </p>
            <hr />
            <p>
            	<label for="<?php echo $this->get_field_id("promo_image_1"); ?>">
            		<span style="font-weight: bold;"><?php _e( 'Image #1 URL:', 'wpblink_flatolio' ); ?></span>
            		<textarea class="widefat" rows="2" cols="2" id="<?php echo $this->get_field_id('promo_image_1'); ?>" name="<?php echo $this->get_field_name('promo_image_1'); ?>"><?php echo $promo_image_1; ?></textarea>
            	</label>
            	<?php _e( 'Enter the full URL (including http://) of your chosen image.', 'wpblink_flatolio' ); ?>
            </p>
            <hr />
            <p>
            	<label for="<?php echo $this->get_field_id("promo_text_1"); ?>">
            		<span style="font-weight: bold;"><?php _e( 'Image #1 Text:', 'wpblink_flatolio' ); ?></span>
            		<textarea class="widefat" rows="4" cols="4" id="<?php echo $this->get_field_id('promo_text_1'); ?>" name="<?php echo $this->get_field_name('promo_text_1'); ?>"><?php echo $promo_text_1; ?></textarea>
            	</label>
            	<?php _e( 'Enter your custom text for this area.', 'wpblink_flatolio' ); ?>
            </p>
            <hr />
            <p>
            	<label for="<?php echo $this->get_field_id("promo_url_1"); ?>">
            		<span style="font-weight: bold;"><?php _e( 'Destination URL #1:', 'wpblink_flatolio' ); ?></span>
            		<textarea class="widefat" rows="4" cols="4" id="<?php echo $this->get_field_id('promo_url_1'); ?>" name="<?php echo $this->get_field_name('promo_url_1'); ?>"><?php echo $promo_url_1; ?></textarea>
            	</label>
            	<?php _e( 'Enter the full destination URL (including http://) for this section.', 'wpblink_flatolio' ); ?>
            </p>
            <hr />
            <p>
            	<label for="<?php echo $this->get_field_id("promo_image_2"); ?>">
            		<span style="font-weight: bold;"><?php _e( 'Image #2 URL:', 'wpblink_flatolio' ); ?></span>
            		<textarea class="widefat" rows="2" cols="2" id="<?php echo $this->get_field_id('promo_image_2'); ?>" name="<?php echo $this->get_field_name('promo_image_2'); ?>"><?php echo $promo_image_2; ?></textarea>
            	</label>
            	<?php _e( 'Enter the full URL (including http://) of your chosen image.', 'wpblink_flatolio' ); ?>
            </p>
            <hr />
            <p>
            	<label for="<?php echo $this->get_field_id("promo_text_2"); ?>">
            		<span style="font-weight: bold;"><?php _e( 'Image #2 Text:', 'wpblink_flatolio' ); ?></span>
            		<textarea class="widefat" rows="4" cols="4" id="<?php echo $this->get_field_id('promo_text_2'); ?>" name="<?php echo $this->get_field_name('promo_text_2'); ?>"><?php echo $promo_text_2; ?></textarea>
            	</label>
            	<?php _e( 'Enter your custom text for this area.', 'wpblink_flatolio' ); ?>
            </p>
            <hr />
            <p>
            	<label for="<?php echo $this->get_field_id("promo_url_2"); ?>">
            		<span style="font-weight: bold;"><?php _e( 'Destination URL #2:', 'wpblink_flatolio' ); ?></span>
            		<textarea class="widefat" rows="4" cols="4" id="<?php echo $this->get_field_id('promo_url_2'); ?>" name="<?php echo $this->get_field_name('promo_url_2'); ?>"><?php echo $promo_url_2; ?></textarea>
            	</label>
            	<?php _e( 'Enter the full destination URL (including http://) for this section.', 'wpblink_flatolio' ); ?>
            </p>
            <hr />
            <p>
            	<label for="<?php echo $this->get_field_id("promo_image_3"); ?>">
            		<span style="font-weight: bold;"><?php _e( 'Image #3 URL:', 'wpblink_flatolio' ); ?></span>
            		<textarea class="widefat" rows="2" cols="2" id="<?php echo $this->get_field_id('promo_image_3'); ?>" name="<?php echo $this->get_field_name('promo_image_3'); ?>"><?php echo $promo_image_3; ?></textarea>
            	</label>
            	<?php _e( 'Enter the full URL (including http://) of your chosen image.', 'wpblink_flatolio' ); ?>
            </p>
            <hr />
            <p>
            	<label for="<?php echo $this->get_field_id("promo_text_3"); ?>">
            		<span style="font-weight: bold;"><?php _e( 'Image #3 Text:', 'wpblink_flatolio' ); ?></span>
            		<textarea class="widefat" rows="4" cols="4" id="<?php echo $this->get_field_id('promo_text_3'); ?>" name="<?php echo $this->get_field_name('promo_text_3'); ?>"><?php echo $promo_text_3; ?></textarea>
            	</label>
            	<?php _e( 'Enter your custom text for this area.', 'wpblink_flatolio' ); ?>
            </p>
            <hr />
            <p>
            	<label for="<?php echo $this->get_field_id("promo_url_3"); ?>">
            		<span style="font-weight: bold;"><?php _e( 'Destination URL #3:', 'wpblink_flatolio' ); ?></span>
            		<textarea class="widefat" rows="4" cols="4" id="<?php echo $this->get_field_id('promo_url_3'); ?>" name="<?php echo $this->get_field_name('promo_url_3'); ?>"><?php echo $promo_url_3; ?></textarea>
            	</label>
            	<?php _e( 'Enter the full destination URL (including http://) for this section.', 'wpblink_flatolio' ); ?>
            </p>
            <hr />
            <p>
            	<label for="<?php echo $this->get_field_id("promo_image_4"); ?>">
            		<span style="font-weight: bold;"><?php _e( 'Image #4 URL:', 'wpblink_flatolio' ); ?></span>
            		<textarea class="widefat" rows="2" cols="2" id="<?php echo $this->get_field_id('promo_image_4'); ?>" name="<?php echo $this->get_field_name('promo_image_4'); ?>"><?php echo $promo_image_4; ?></textarea>
            	</label>
            	<?php _e( 'Enter the full URL (including http://) of your chosen image.', 'wpblink_flatolio' ); ?>
            </p>
            <hr />
            <p>
            	<label for="<?php echo $this->get_field_id("promo_text_4"); ?>">
            		<span style="font-weight: bold;"><?php _e( 'Image #4 Text:', 'wpblink_flatolio' ); ?></span>
            		<textarea class="widefat" rows="4" cols="4" id="<?php echo $this->get_field_id('promo_text_4'); ?>" name="<?php echo $this->get_field_name('promo_text_4'); ?>"><?php echo $promo_text_4; ?></textarea>
            	</label>
            	<?php _e( 'Enter your custom text for this area.', 'wpblink_flatolio' ); ?>
            </p>
            <hr />
            <p>
            	<label for="<?php echo $this->get_field_id("promo_url_4"); ?>">
            		<span style="font-weight: bold;"><?php _e( 'Destination URL #4:', 'wpblink_flatolio' ); ?></span>
            		<textarea class="widefat" rows="4" cols="4" id="<?php echo $this->get_field_id('promo_url_4'); ?>" name="<?php echo $this->get_field_name('promo_url_4'); ?>"><?php echo $promo_url_4; ?></textarea>
            	</label>
            	<?php _e( 'Enter the full destination URL (including http://) for this section.', 'wpblink_flatolio' ); ?>
            </p>
            <hr />
	<?php
		}
	}
	add_action( 'widgets_init', create_function('', 'return register_widget("wpblink_flatolio_promo");') );
	
	
	


	/**
	 * Create Posts Thumbnails Widget
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/

class wpblink_flatolio_postthumb extends WP_Widget {
	function wpblink_flatolio_postthumb() {
		$widget_ops = array(
			'classname' => 'widget_wpblink_flatolio_postthumb',
			'description' => 'Display posts from any category complete with thumbnail images.'
		);
		$this->WP_Widget(
			'wpblink_flatolio_postthumb',
			'Post Thumbnails',
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
		echo $before_widget;
		echo $before_title;
		if( $instance["title"] ) 
			echo '<a href="' . get_category_link($instance["cat"]) . '">' . $instance["title"] . '</a>';
		else
			echo '<a href="' . get_category_link($instance["cat"]) . '">' . $instance["cat"] . '</a>';
		echo $after_title;
	?>
    <div class="lightshade">
	<?php if (isset( $instance["allcats"] )) { ?>
    	<?php $my_query = new WP_Query("showposts=" . $instance["show"] . "&offset=" . $instance["skip"]); ?>
    <?php } else { ?>
    	<?php $my_query = new WP_Query("showposts=" . $instance["show"] . "&cat=" . $instance["cat"] . "&offset=" . $instance["skip"]); ?>
    <?php } ?>
    <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
    
    <a href="<?php the_permalink() ?>" rel="bookmark">
		    	<?php if ( has_post_thumbnail() ) { // IF POST IMAGE EXISTS ?>
    		
    			<?php the_post_thumbnail( 'img_standard', array( 'class' => 'img img_third_alt img_float', 'title' => '' ) ); // POST IMAGE ?>
    		
    	<?php } else { // IF NO POST IMAGE ?>
    	<?php } // END IF ?>

    	<h5><?php the_title(); // POST TITLE ?></h5>
        </a>
        
        <div class="break"></div>
    <?php endwhile; ?>
    </div>
    <div class="break seperate"></div>
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
			<?php _e( 'Title:', 'wpblink_flatolio' ); ?>
			<input class="widefat" id="<?php echo $this->get_field_id("title"); ?>" name="<?php echo $this->get_field_name("title"); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
		</label>
	</p>
	<p><?php _e( 'Give this widget a title, or leave blank to display the category name.', 'wpblink_flatolio'); ?></p>
	<hr />
	<p>
		<label for="<?php echo $this->get_field_id("cat"); ?>">
			<?php _e( 'Category: &nbsp;', 'wpblink_flatolio' ); ?>		
			<?php wp_dropdown_categories( array( 'name' => $this->get_field_name("cat"), 'selected' => $instance["cat"] ) ); ?>
		</label>
	</p>
	<p><?php _e( 'Select a specific category to display posts from.', 'wpblink_flatolio'); ?></p>
	<hr />
	<p>
		<label for="<?php echo $this->get_field_id("allcats"); ?>">
			<?php _e( 'All Categories? &nbsp;', 'wpblink_flatolio' ); ?>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("allcats"); ?>" name="<?php echo $this->get_field_name("allcats"); ?>"<?php checked( (bool) $instance["allcats"], true ); ?> />
		</label>
	</p>
	<p><?php _e( 'Check the box to display posts from all categories instead, overriding the above setting.', 'wpblink_flatolio'); ?></p>
	<hr />
	<p>
		<label for="<?php echo $this->get_field_id("show"); ?>">
			<?php _e( 'Show X Posts: &nbsp;', 'wpblink_flatolio' ); ?>
			<input style="text-align: center;" id="<?php echo $this->get_field_id("show"); ?>" name="<?php echo $this->get_field_name("show"); ?>" type="text" value="<?php echo absint($instance["show"]); ?>" size='3' />
		</label>
	</p>
	<p><?php _e( 'Enter how many posts to display (numerical).', 'wpblink_flatolio'); ?></p>
	<hr />
	<p>
		<label for="<?php echo $this->get_field_id("skip"); ?>">
			<?php _e( 'Skip X Posts: &nbsp;', 'wpblink_flatolio' ); ?>
<input style="text-align: center;" id="<?php echo $this->get_field_id("skip"); ?>" name="<?php echo $this->get_field_name("skip"); ?>" type="text" value="<?php echo absint($instance["skip"]); ?>" size='3' />
		</label>
	</p>
	<p><?php _e( 'Enter how many posts to skip before displaying the posts (numerical).', 'wpblink_flatolio'); ?></p>
	<hr />
	<?php
		}
	}
	add_action( 'widgets_init', create_function('', 'return register_widget("wpblink_flatolio_postthumb");') );
	
	
	
	
	/**
	 * Create Posts List Widget
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/

class wpblink_flatolio_postlist extends WP_Widget {
	function wpblink_flatolio_postlist() {
		$widget_ops = array(
			'classname' => 'widget_wpblink_flatolio_postlist',
			'description' => 'List posts from any category.'
		);
		$this->WP_Widget(
			'wpblink_flatolio_postlist',
			'Post List',
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
		echo $before_widget;
		echo $before_title;
		if( $instance["title"] ) 
			echo '<a href="' . get_category_link($instance["cat"]) . '">' . $instance["title"] . '</a>';
		else
			echo '<a href="' . get_category_link($instance["cat"]) . '">' . $instance["cat"] . '</a>';
		echo $after_title;
	?>
    <div class="lightshade">
    <ul>
	<?php if (isset( $instance["allcats"] )) { ?>
    	<?php $my_query = new WP_Query("showposts=" . $instance["show"] . "&offset=" . $instance["skip"]); ?>
    <?php } else { ?>
    	<?php $my_query = new WP_Query("showposts=" . $instance["show"] . "&cat=" . $instance["cat"] . "&offset=" . $instance["skip"]); ?>
    <?php } ?>
    <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
    
    <li><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); // POST TITLE ?></a></li>
    <?php endwhile; ?>
    </ul>
    </div>
    <div class="break seperate"></div>
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
			<?php _e( 'Title:', 'wpblink_flatolio' ); ?>
			<input class="widefat" id="<?php echo $this->get_field_id("title"); ?>" name="<?php echo $this->get_field_name("title"); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
		</label>
	</p>
	<p><?php _e( 'Give this widget a title, or leave blank to display the category name.', 'wpblink_flatolio'); ?></p>
	<hr />
	<p>
		<label for="<?php echo $this->get_field_id("cat"); ?>">
			<?php _e( 'Category: &nbsp;', 'wpblink_flatolio' ); ?>		
			<?php wp_dropdown_categories( array( 'name' => $this->get_field_name("cat"), 'selected' => $instance["cat"] ) ); ?>
		</label>
	</p>
	<p><?php _e( 'Select a specific category to display posts from.', 'wpblink_flatolio'); ?></p>
	<hr />
	<p>
		<label for="<?php echo $this->get_field_id("allcats"); ?>">
			<?php _e( 'All Categories? &nbsp;', 'wpblink_flatolio' ); ?>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("allcats"); ?>" name="<?php echo $this->get_field_name("allcats"); ?>"<?php checked( (bool) $instance["allcats"], true ); ?> />
		</label>
	</p>
	<p><?php _e( 'Check the box to display posts from all categories instead, overriding the above setting.', 'wpblink_flatolio'); ?></p>
	<hr />
	<p>
		<label for="<?php echo $this->get_field_id("show"); ?>">
			<?php _e( 'Show X Posts: &nbsp;', 'wpblink_flatolio' ); ?>
			<input style="text-align: center;" id="<?php echo $this->get_field_id("show"); ?>" name="<?php echo $this->get_field_name("show"); ?>" type="text" value="<?php echo absint($instance["show"]); ?>" size='3' />
		</label>
	</p>
	<p><?php _e( 'Enter how many posts to display (numerical).', 'wpblink_flatolio'); ?></p>
	<hr />
	<p>
		<label for="<?php echo $this->get_field_id("skip"); ?>">
			<?php _e( 'Skip X Posts: &nbsp;', 'wpblink_flatolio' ); ?>
<input style="text-align: center;" id="<?php echo $this->get_field_id("skip"); ?>" name="<?php echo $this->get_field_name("skip"); ?>" type="text" value="<?php echo absint($instance["skip"]); ?>" size='3' />
		</label>
	</p>
	<p><?php _e( 'Enter how many posts to skip before displaying the posts (numerical).', 'wpblink_flatolio'); ?></p>
	<hr />
	<?php
		}
	}
	add_action( 'widgets_init', create_function('', 'return register_widget("wpblink_flatolio_postlist");') );
	
	
	
		
	
	/**
	 * Create Latest Posts Widget
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/

class wpblink_flatolio_latest extends WP_Widget {
	function wpblink_flatolio_latest() {
		$widget_ops = array(
			'classname' => 'widget_wpblink_flatolio_latest',
			'description' => 'Disyplay your latest posts.'
		);
		$this->WP_Widget(
			'wpblink_flatolio_latest',
			'[FLATOLIO] Latest Posts',
			$widget_ops
		);
	}
	function widget($args, $instance) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		$latest_intro = apply_filters( 'widget_execphp', $instance['latest_intro'], $instance );
		$latest_button = apply_filters( 'widget_execphp', $instance['latest_button'], $instance );
		$latest_button_text = apply_filters( 'widget_execphp', $instance['latest_button_text'], $instance );
		?>
        <?php if ( $latest_intro ) { ?>
        	<?php echo '<h1 class="light_alt">'; echo $instance['filter'] ? wpautop($latest_intro) : $latest_intro; echo '</h1>'; ?>
        <?php } else { ?>
        	<?php echo '<h1 class="light_alt">'; _e( 'latest', 'wpblink_flatolio' ); echo '</h1>'; ?>
        <?php } ?>
        <?php echo $before_widget; ?>
        <div class="col span_1_of_3 trans unlimited">
            <div class="widget pad_more">
				<?php $my_query = new WP_Query("showposts=3&offset=0"); ?>
                <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
                    <?php if ( has_post_thumbnail() ) { // IF POST IMAGE EXISTS ?>
                    	<a href="<?php the_permalink() ?>" rel="bookmark">
							<?php the_post_thumbnail( 'img_standard', array( 'class' => 'img img_quarter img_float', 'title' => '' ) ); // POST IMAGE ?>
                            <?php the_title(); // POST TITLE ?>
                            <p class="small"><?php wpe_excerpt('wpe_excerptlength_shorter', 'wpe_excerptmore'); // POST EXCERPT ?></p>
                        </a>
                    <?php } else { // IF NO POST IMAGE ?>
                    <?php } // END IF ?>
                    <div class="break seperate"></div>
                <?php endwhile; ?>
            </div>
		</div>
        <div class="col span_1_of_3 trans unlimited">
	        <div class="widget pad_more">
				<?php $my_query = new WP_Query("showposts=3&offset=3"); ?>
                <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
                    <?php if ( has_post_thumbnail() ) { // IF POST IMAGE EXISTS ?>
                    	<a href="<?php the_permalink() ?>" rel="bookmark">
							<?php the_post_thumbnail( 'img_standard', array( 'class' => 'img img_quarter img_float', 'title' => '' ) ); // POST IMAGE ?>
                            <?php the_title(); // POST TITLE ?>
                            <p class="small"><?php wpe_excerpt('wpe_excerptlength_shorter', 'wpe_excerptmore'); // POST EXCERPT ?></p>
                        </a>
                    <?php } else { // IF NO POST IMAGE ?>
                    <?php } // END IF ?>
                    <div class="break seperate"></div>
                <?php endwhile; ?>
	        </div>
		</div>
        <div class="col span_1_of_3 trans unlimited">
	        <div class="widget pad_more">
				<?php $my_query = new WP_Query("showposts=3&offset=6"); ?>
                <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
                    <?php if ( has_post_thumbnail() ) { // IF POST IMAGE EXISTS ?>
                    	<a href="<?php the_permalink() ?>" rel="bookmark">
							<?php the_post_thumbnail( 'img_standard', array( 'class' => 'img img_quarter img_float', 'title' => '' ) ); // POST IMAGE ?>
                            <?php the_title(); // POST TITLE ?>
                            <p class="small"><?php wpe_excerpt('wpe_excerptlength_shorter', 'wpe_excerptmore'); // POST EXCERPT ?></p>
                        </a>
                    <?php } else { // IF NO POST IMAGE ?>
                    <?php } // END IF ?>
                    <div class="break seperate"></div>
                <?php endwhile; ?>
				<?php if ( $latest_button_text ) { ?>
        			<?php if ( $latest_button ) { ?>
            			<div class="break pad_small"></div>
        				<a href="<?php echo $instance['filter'] ? wpautop($latest_button) : $latest_button; ?>" class="button">
							<?php echo $instance['filter'] ? wpautop($latest_button_text) : $latest_button_text; ?>
                		</a>
                		<div class="break pad_all"></div>
        			<?php } else { ?>
        			<?php } ?>
        		<?php } else { ?>
        		<?php } ?>
	        </div>
		</div>
        <?php
			echo $after_widget;
			}
			function update( $new_instance, $old_instance ) {
				$instance = $old_instance;

				$instance['title'] = strip_tags($new_instance['title']);

				if ( current_user_can('unfiltered_html') )
					$instance['latest_intro'] =  $new_instance['latest_intro'];
				else
					$instance['latest_intro'] = stripslashes( wp_filter_post_kses( $new_instance['latest_intro'] ) );
					
				if ( current_user_can('unfiltered_html') )
					$instance['latest_button'] =  $new_instance['latest_button'];
				else
					$instance['latest_button'] = stripslashes( wp_filter_post_kses( $new_instance['latest_button'] ) );
					
				if ( current_user_can('unfiltered_html') )
					$instance['latest_button_text'] =  $new_instance['latest_button_text'];
				else
					$instance['latest_button_text'] = stripslashes( wp_filter_post_kses( $new_instance['latest_button_text'] ) );



					$instance['filter'] = isset($new_instance['filter']);
					return $instance;
				}
				function form( $instance ) {
					$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'latest_intro' => '', 'latest_button' => '', 'latest_button_text' => '' ) );
					$title = strip_tags($instance['title']);

					$latest_intro = format_to_edit($instance['latest_intro']);
					$latest_button = format_to_edit($instance['latest_button']);
					$latest_button_text = format_to_edit($instance['latest_button_text']);

			?>
                <p>
        <label for="<?php echo $this->get_field_id("latest_intro"); ?>">
            <span style="font-weight: bold;"><?php _e( 'Title:', 'wpblink_flatolio' ); ?></span>
            <textarea class="widefat" rows="1" cols="1" id="<?php echo $this->get_field_id('latest_intro'); ?>" name="<?php echo $this->get_field_name('latest_intro'); ?>"><?php echo $latest_intro; ?></textarea>
        </label>
        <?php _e( 'Enter your custom title for this section.', 'wpblink_flatolio' ); ?>
    </p>
        <hr />
    <p>
        <label for="<?php echo $this->get_field_id("latest_button_text"); ?>">
            <span style="font-weight: bold;"><?php _e( 'Button Text:', 'wpblink_flatolio' ); ?></span>
            <textarea class="widefat" rows="1" cols="1" id="<?php echo $this->get_field_id('latest_button_text'); ?>" name="<?php echo $this->get_field_name('latest_button_text'); ?>"><?php echo $latest_button_text; ?></textarea>
        </label>
        <?php _e( 'Enter your custom button text (optional).', 'wpblink_flatolio' ); ?>
    </p>
    <hr />
    <p>
        <label for="<?php echo $this->get_field_id("latest_button"); ?>">
            <span style="font-weight: bold;"><?php _e( 'Button URL:', 'wpblink_flatolio' ); ?></span>
            <textarea class="widefat" rows="2" cols="2" id="<?php echo $this->get_field_id('latest_button'); ?>" name="<?php echo $this->get_field_name('latest_button'); ?>"><?php echo $latest_button; ?></textarea>
        </label>
        <?php _e( 'Enter the full destination URL (including http://) for the button (optional).', 'wpblink_flatolio' ); ?>
    </p>
    <hr />
	<?php
		}
	}
	add_action( 'widgets_init', create_function('', 'return register_widget("wpblink_flatolio_latest");') );
	
	
	
	
	/**
	 * Create Contact Widget
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/

class wpblink_flatolio_contact extends WP_Widget {
	function wpblink_flatolio_contact() {
		$widget_ops = array(
			'classname' => 'widget_wpblink_flatolio_contact',
			'description' => 'Add your contact details, social media links and even a CF7 contact form.'
		);
		$this->WP_Widget(
			'wpblink_flatolio_contact',
			'[FLATOLIO] Contact',
			$widget_ops
		);
	}
	function widget($args, $instance) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		$contact_intro = apply_filters( 'widget_execphp', $instance['latest_contact'], $instance );
		$contact_form = apply_filters( 'widget_execphp', $instance['contact_form'], $instance );
		$contact_line = apply_filters( 'widget_execphp', $instance['contact_line'], $instance );
		$contact_line2 = apply_filters( 'widget_execphp', $instance['contact_line2'], $instance );
		$contact_line3 = apply_filters( 'widget_execphp', $instance['contact_line3'], $instance );
		$contact_line4 = apply_filters( 'widget_execphp', $instance['contact_line4'], $instance );
		$contact_line5 = apply_filters( 'widget_execphp', $instance['contact_line5'], $instance );
		$contact_email = apply_filters( 'widget_execphp', $instance['contact_email'], $instance );
		$contact_twitter = apply_filters( 'widget_execphp', $instance['contact_twitter'], $instance );
		$contact_facebook = apply_filters( 'widget_execphp', $instance['contact_facebook'], $instance );
		$contact_dribbble = apply_filters( 'widget_execphp', $instance['contact_dribbble'], $instance );
		$contact_pinterest = apply_filters( 'widget_execphp', $instance['contact_pinterest'], $instance );
		$contact_youtube = apply_filters( 'widget_execphp', $instance['contact_youtube'], $instance );
		$contact_instagram = apply_filters( 'widget_execphp', $instance['contact_instagram'], $instance );
		$contact_flickr = apply_filters( 'widget_execphp', $instance['contact_flickr'], $instance );
		?>
        <?php if ( $contact_intro ) { ?>
        	<?php echo '<h1 class="light_alt">'; echo $instance['filter'] ? wpautop($contact_intro) : $contact_intro; echo '</h1>'; ?>
        <?php } else { ?>
        	<?php echo '<h1 class="light_alt">'; _e( 'contact', 'wpblink_flatolio' ); echo '</h1>'; ?>
        <?php } ?>
        <?php echo $before_widget; ?>
        <?php if ( $contact_form ) { ?>
            <div class="col span_3_of_6 trans unlimited">
                <div class="widget pad_more">
                    <?php if ( $contact_line ) { ?>
                        <?php echo '<h3>'; echo $instance['filter'] ? wpautop($contact_line) : $contact_line; echo '</h3>'; ?>
                    <?php } else { ?>
                    <?php } ?>
                    <?php if ( $contact_line2 ) { ?>
                        <?php echo '<h5>'; echo $instance['filter'] ? wpautop($contact_line2) : $contact_line2; echo '</h5>'; ?>
                    <?php } else { ?>
                    <?php } ?>
                    <?php if ( $contact_line3 ) { ?>
                        <?php echo '<h5>'; echo $instance['filter'] ? wpautop($contact_line3) : $contact_line3; echo '</h5>'; ?>
                    <?php } else { ?>
                    <?php } ?>
                    <?php if ( $contact_line4 ) { ?>
                        <?php echo '<h5>'; echo $instance['filter'] ? wpautop($contact_line4) : $contact_line4; echo '</h5>'; ?>
                    <?php } else { ?>
                    <?php } ?>
                    <?php if ( $contact_line5 ) { ?>
                        <?php echo '<h5>'; echo $instance['filter'] ? wpautop($contact_line5) : $contact_line5; echo '</h5>'; ?>
                    <?php } else { ?>
                    <?php } ?>
                    
                    <?php if ( $contact_email ) { ?>
                        <?php echo '<h5>'; echo $instance['filter'] ? wpautop($contact_email) : $contact_email; echo '</h5>'; ?>
                    <?php } else { ?>
                    <?php } ?>
                    <?php if ( $contact_twitter ) { ?>
                        <a href="<?php echo $instance['filter'] ? wpautop($contact_twitter) : $contact_twitter; ?>" target="_blank" title="Twitter">
                        	<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_twitter.png" alt="icon-twitter" class="social-icon" />
                    	</a>
                    <?php } else { ?>
                    <?php } ?>
                    <?php if ( $contact_facebook ) { ?>
                        <a href="<?php echo $instance['filter'] ? wpautop($contact_facebook) : $contact_facebook; ?>" target="_blank" title="Facebook">
                        	<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_facebook.png" alt="icon-facebook" class="social-icon" />
                    	</a>
                    <?php } else { ?>
                    <?php } ?>
                    <?php if ( $contact_dribbble ) { ?>
                        <a href="<?php echo $instance['filter'] ? wpautop($contact_dribbble) : $contact_dribbble; ?>" target="_blank" title="Dribbble">
                        	<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_dribbble.png" alt="icon-dribbble" class="social-icon" />
                    	</a>
                    <?php } else { ?>
                    <?php } ?>
                    <?php if ( $contact_pinterest ) { ?>
                        <a href="<?php echo $instance['filter'] ? wpautop($contact_pinterest) : $contact_pinterest; ?>" target="_blank" title="Pinterest">
                        	<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_pinterest.png" alt="icon-pinterest" class="social-icon" />
                    	</a>
                    <?php } else { ?>
                    <?php } ?>
					<?php if ( $contact_youtube ) { ?>
                        <a href="<?php echo $instance['filter'] ? wpautop($contact_youtube) : $contact_youtube; ?>" target="_blank" title="Youtube">
                        	<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_youtube.png" alt="icon-youtube" class="social-icon" />
                    	</a>
                    <?php } else { ?>
                    <?php } ?>
                    <?php if ( $contact_instagram ) { ?>
                        <a href="<?php echo $instance['filter'] ? wpautop($contact_instagram) : $contact_instagram; ?>" target="_blank" title="Instagram">
                        	<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_instagram.png" alt="icon-instagram" class="social-icon" />
                    	</a>
                    <?php } else { ?>
                    <?php } ?>
                    <?php if ( $contact_flickr ) { ?>
                        <a href="<?php echo $instance['filter'] ? wpautop($contact_flickr) : $contact_flickr; ?>" target="_blank" title="Flickr">
                        	<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_flickr.png" alt="icon-flickr" class="social-icon" />
                    	</a>
                    <?php } else { ?>
                    <?php } ?>
                </div>
            </div>
            <div class="col span_3_of_6 trans unlimited">
                <div class="widget pad_more">
                    <?php if ( $contact_form ) { ?>
                        <?php echo do_shortcode( $instance['filter'] ? wpautop($contact_form) : $contact_form ); ?>
						<?php echo '<br />'; ?>
                    <?php } else { ?>
                    <?php } ?>
                </div>
            </div>
		<?php } else { ?>
        	<div class="col span_3_of_3 trans unlimited">
                <div class="widget pad_more">
                	<div class="centered">
						<?php if ( $contact_line ) { ?>
                            <?php echo '<h3>'; echo $instance['filter'] ? wpautop($contact_line) : $contact_line; echo '</h3>'; ?>
                        <?php } else { ?>
                        <?php } ?>
                        <?php if ( $contact_line2 ) { ?>
                            <?php echo '<h5>'; echo $instance['filter'] ? wpautop($contact_line2) : $contact_line2; echo '</h5>'; ?>
                        <?php } else { ?>
                        <?php } ?>
                        <?php if ( $contact_line3 ) { ?>
                            <?php echo '<h5>'; echo $instance['filter'] ? wpautop($contact_line3) : $contact_line3; echo '</h5>'; ?>
                        <?php } else { ?>
                        <?php } ?>
                        <?php if ( $contact_line4 ) { ?>
                            <?php echo '<h5>'; echo $instance['filter'] ? wpautop($contact_line4) : $contact_line4; echo '</h5>'; ?>
                        <?php } else { ?>
                        <?php } ?>
                        <?php if ( $contact_line5 ) { ?>
                            <?php echo '<h5>'; echo $instance['filter'] ? wpautop($contact_line5) : $contact_line5; echo '</h5>'; ?>
                        <?php } else { ?>
                        <?php } ?>
                        <?php if ( $contact_email ) { ?>
                        	<?php echo '<h5>'; echo $instance['filter'] ? wpautop($contact_email) : $contact_email; echo '</h5>'; ?>
                    	<?php } else { ?>
                    	<?php } ?>
                        <div class="centered">
                        <?php if ( $contact_twitter ) { ?>
                        <a href="<?php echo $instance['filter'] ? wpautop($contact_twitter) : $contact_twitter; ?>" target="_blank" title="Twitter">
                        	<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_twitter.png" alt="icon-twitter" class="social-icon-alt" />
                    	</a>
						<?php } else { ?>
                        <?php } ?>
                        <?php if ( $contact_facebook ) { ?>
                            <a href="<?php echo $instance['filter'] ? wpautop($contact_facebook) : $contact_facebook; ?>" target="_blank" title="Facebook">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_facebook.png" alt="icon-facebook" class="social-icon-alt" />
                            </a>
                        <?php } else { ?>
                        <?php } ?>
                        <?php if ( $contact_dribbble ) { ?>
                            <a href="<?php echo $instance['filter'] ? wpautop($contact_dribbble) : $contact_dribbble; ?>" target="_blank" title="Dribbble">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_dribbble.png" alt="icon-dribbble" class="social-icon-alt" />
                            </a>
                        <?php } else { ?>
                        <?php } ?>
                        <?php if ( $contact_pinterest ) { ?>
                            <a href="<?php echo $instance['filter'] ? wpautop($contact_pinterest) : $contact_pinterest; ?>" target="_blank" title="Pinterest">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_pinterest.png" alt="icon-pinterest" class="social-icon-alt" />
                            </a>
                        <?php } else { ?>
                        <?php } ?>
                        <?php if ( $contact_youtube ) { ?>
                            <a href="<?php echo $instance['filter'] ? wpautop($contact_youtube) : $contact_youtube; ?>" target="_blank" title="Youtube">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_youtube.png" alt="icon-youtube" class="social-icon-alt" />
                            </a>
                        <?php } else { ?>
                        <?php } ?>
                        <?php if ( $contact_instagram ) { ?>
                            <a href="<?php echo $instance['filter'] ? wpautop($contact_instagram) : $contact_instagram; ?>" target="_blank" title="Instagram">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_instagram.png" alt="icon-instagram" class="social-icon-alt" />
                            </a>
                        <?php } else { ?>
                        <?php } ?>
                        <?php if ( $contact_flickr ) { ?>
                            <a href="<?php echo $instance['filter'] ? wpautop($contact_flickr) : $contact_flickr; ?>" target="_blank" title="Flickr">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_flickr.png" alt="icon-flickr" class="social-icon-alt" />
                            </a>
                        <?php } else { ?>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php
			echo $after_widget;
			}
			function update( $new_instance, $old_instance ) {
				$instance = $old_instance;

				$instance['title'] = strip_tags($new_instance['title']);

				if ( current_user_can('unfiltered_html') )
					$instance['contact_intro'] =  $new_instance['contact_intro'];
				else
					$instance['contact_intro'] = stripslashes( wp_filter_post_kses( $new_instance['contact_intro'] ) );
					
			
				if ( current_user_can('unfiltered_html') )
					$instance['contact_form'] =  $new_instance['contact_form'];
				else
					$instance['contact_form'] = stripslashes( wp_filter_post_kses( $new_instance['contact_form'] ) );
					
								if ( current_user_can('unfiltered_html') )
					$instance['contact_line'] =  $new_instance['contact_line'];
				else
					$instance['contact_line'] = stripslashes( wp_filter_post_kses( $new_instance['contact_line'] ) );
					
								if ( current_user_can('unfiltered_html') )
					$instance['contact_line2'] =  $new_instance['contact_line2'];
				else
					$instance['contact_line2'] = stripslashes( wp_filter_post_kses( $new_instance['contact_line2'] ) );

								if ( current_user_can('unfiltered_html') )
					$instance['contact_line3'] =  $new_instance['contact_line3'];
				else
					$instance['contact_line3'] = stripslashes( wp_filter_post_kses( $new_instance['contact_line3'] ) );
					
								if ( current_user_can('unfiltered_html') )
					$instance['contact_line4'] =  $new_instance['contact_line4'];
				else
					$instance['contact_line4'] = stripslashes( wp_filter_post_kses( $new_instance['contact_line4'] ) );
					
								if ( current_user_can('unfiltered_html') )
					$instance['contact_line5'] =  $new_instance['contact_line5'];
				else
					$instance['contact_line5'] = stripslashes( wp_filter_post_kses( $new_instance['contact_line5'] ) );
					
					if ( current_user_can('unfiltered_html') )
					$instance['contact_email'] =  $new_instance['contact_email'];
				else
					$instance['contact_email'] = stripslashes( wp_filter_post_kses( $new_instance['contact_email'] ) );
					
					if ( current_user_can('unfiltered_html') )
					$instance['contact_twitter'] =  $new_instance['contact_twitter'];
				else
					$instance['contact_twitter'] = stripslashes( wp_filter_post_kses( $new_instance['contact_twitter'] ) );
					
					if ( current_user_can('unfiltered_html') )
					$instance['contact_facebook'] =  $new_instance['contact_facebook'];
				else
					$instance['contact_facebook'] = stripslashes( wp_filter_post_kses( $new_instance['contact_facebook'] ) );
					
					if ( current_user_can('unfiltered_html') )
					$instance['contact_dribbble'] =  $new_instance['contact_dribbble'];
				else
					$instance['contact_dribbble'] = stripslashes( wp_filter_post_kses( $new_instance['contact_dribbble'] ) );
					
					if ( current_user_can('unfiltered_html') )
					$instance['contact_pinterest'] =  $new_instance['contact_pinterest'];
				else
					$instance['contact_pinterest'] = stripslashes( wp_filter_post_kses( $new_instance['contact_pinterest'] ) );
					
					if ( current_user_can('unfiltered_html') )
					$instance['contact_youtube'] =  $new_instance['contact_youtube'];
				else
					$instance['contact_youtube'] = stripslashes( wp_filter_post_kses( $new_instance['contact_youtube'] ) );
					
					if ( current_user_can('unfiltered_html') )
					$instance['contact_instagram'] =  $new_instance['contact_instagram'];
				else
					$instance['contact_instagram'] = stripslashes( wp_filter_post_kses( $new_instance['contact_instagram'] ) );
					
					if ( current_user_can('unfiltered_html') )
					$instance['contact_flickr'] =  $new_instance['contact_flickr'];
				else
					$instance['contact_flickr'] = stripslashes( wp_filter_post_kses( $new_instance['contact_flickr'] ) );

					$instance['filter'] = isset($new_instance['filter']);
					return $instance;
				}
				function form( $instance ) {
					$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'contact_intro' => '', 'contact_form' => '', 'contact_line' => '', 'contact_line2' => '', 'contact_line3' => '', 'contact_line4' => '', 'contact_line5' => '', 'contact_email' => '' ) );
					$title = strip_tags($instance['title']);

					$contact_intro = format_to_edit($instance['contact_intro']);
					$contact_form = format_to_edit($instance['contact_form']);
					$contact_line = format_to_edit($instance['contact_line']);
					$contact_line2 = format_to_edit($instance['contact_line2']);
					$contact_line3 = format_to_edit($instance['contact_line3']);
					$contact_line4 = format_to_edit($instance['contact_line4']);
					$contact_line5 = format_to_edit($instance['contact_line5']);
					$contact_email = format_to_edit($instance['contact_email']);
					
					$contact_twitter = format_to_edit($instance['contact_twitter']);
					$contact_facebook = format_to_edit($instance['contact_facebook']);
					$contact_dribbble = format_to_edit($instance['contact_dribbble']);
					$contact_pinterest = format_to_edit($instance['contact_pinterest']);
					$contact_youtube = format_to_edit($instance['contact_youtube']);
					$contact_instagram = format_to_edit($instance['contact_instagram']);
					$contact_flickr = format_to_edit($instance['contact_flickr']);


			?>
                <p>
        <label for="<?php echo $this->get_field_id("contact_intro"); ?>">
            <span style="font-weight: bold;"><?php _e( 'Title:', 'wpblink_flatolio' ); ?></span>
            <textarea class="widefat" rows="1" cols="1" id="<?php echo $this->get_field_id('contact_intro'); ?>" name="<?php echo $this->get_field_name('contact_intro'); ?>"><?php echo $contact_intro; ?></textarea>
        </label>
        <?php _e( 'Enter your custom title for this section.', 'wpblink_flatolio' ); ?>
    </p>
        <hr />
                <p>
        <label for="<?php echo $this->get_field_id("contact_line"); ?>">
            <span style="font-weight: bold;"><?php _e( 'Text Line #1:', 'wpblink_flatolio' ); ?></span>
            <textarea class="widefat" rows="1" cols="1" id="<?php echo $this->get_field_id('contact_line'); ?>" name="<?php echo $this->get_field_name('contact_line'); ?>"><?php echo $contact_line; ?></textarea>
        </label>
        <?php _e( 'Enter your custom text for this line.', 'wpblink_flatolio' ); ?>
    </p>
        <hr />
                        <p>
        <label for="<?php echo $this->get_field_id("contact_line2"); ?>">
            <span style="font-weight: bold;"><?php _e( 'Text Line #2:', 'wpblink_flatolio' ); ?></span>
            <textarea class="widefat" rows="1" cols="1" id="<?php echo $this->get_field_id('contact_line2'); ?>" name="<?php echo $this->get_field_name('contact_line2'); ?>"><?php echo $contact_line2; ?></textarea>
        </label>
        <?php _e( 'Enter your custom text for this line.', 'wpblink_flatolio' ); ?>
    </p>
        <hr />
                        <p>
        <label for="<?php echo $this->get_field_id("contact_line3"); ?>">
            <span style="font-weight: bold;"><?php _e( 'Text Line #3:', 'wpblink_flatolio' ); ?></span>
            <textarea class="widefat" rows="1" cols="1" id="<?php echo $this->get_field_id('contact_line3'); ?>" name="<?php echo $this->get_field_name('contact_line3'); ?>"><?php echo $contact_line3; ?></textarea>
        </label>
        <?php _e( 'Enter your custom text for this line.', 'wpblink_flatolio' ); ?>
    </p>
        <hr />
                        <p>
        <label for="<?php echo $this->get_field_id("contact_line4"); ?>">
            <span style="font-weight: bold;"><?php _e( 'Text Line #4:', 'wpblink_flatolio' ); ?></span>
            <textarea class="widefat" rows="1" cols="1" id="<?php echo $this->get_field_id('contact_line4'); ?>" name="<?php echo $this->get_field_name('contact_line4'); ?>"><?php echo $contact_line4; ?></textarea>
        </label>
        <?php _e( 'Enter your custom text for this line.', 'wpblink_flatolio' ); ?>
    </p>
        <hr />
                        <p>
        <label for="<?php echo $this->get_field_id("contact_line5"); ?>">
            <span style="font-weight: bold;"><?php _e( 'Text Line #5:', 'wpblink_flatolio' ); ?></span>
            <textarea class="widefat" rows="1" cols="1" id="<?php echo $this->get_field_id('contact_line5'); ?>" name="<?php echo $this->get_field_name('contact_line5'); ?>"><?php echo $contact_line5; ?></textarea>
        </label>
        <?php _e( 'Enter your custom text for this line.', 'wpblink_flatolio' ); ?>
    </p>
        <hr />
                        <p>
        <label for="<?php echo $this->get_field_id("contact_email"); ?>">
            <span style="font-weight: bold;"><?php _e( 'Text Line #6:', 'wpblink_flatolio' ); ?></span>
            <textarea class="widefat" rows="1" cols="1" id="<?php echo $this->get_field_id('contact_email'); ?>" name="<?php echo $this->get_field_name('contact_email'); ?>"><?php echo $contact_email; ?></textarea>
        </label>
        <?php _e( 'Enter your custom text for this line.', 'wpblink_flatolio' ); ?>
    </p>
        <hr />
                <p>
        <label for="<?php echo $this->get_field_id("contact_twitter"); ?>">
            <span style="font-weight: bold;"><?php _e( 'Twitter URL:', 'wpblink_flatolio' ); ?></span>
            <textarea class="widefat" rows="1" cols="1" id="<?php echo $this->get_field_id('contact_twitter'); ?>" name="<?php echo $this->get_field_name('contact_twitter'); ?>"><?php echo $contact_twitter; ?></textarea>
        </label>
        <?php _e( 'Enter the full URL (including http://) of your Twitter page.', 'wpblink_flatolio' ); ?>
    </p>
        <hr />
                <p>
        <label for="<?php echo $this->get_field_id("contact_facebook"); ?>">
            <span style="font-weight: bold;"><?php _e( 'Facebook URL:', 'wpblink_flatolio' ); ?></span>
            <textarea class="widefat" rows="1" cols="1" id="<?php echo $this->get_field_id('contact_facebook'); ?>" name="<?php echo $this->get_field_name('contact_facebook'); ?>"><?php echo $contact_facebook; ?></textarea>
        </label>
        <?php _e( 'Enter the full URL (including http://) of your Facebook page.', 'wpblink_flatolio' ); ?>
    </p>
        <hr />
                <p>
        <label for="<?php echo $this->get_field_id("contact_dribbble"); ?>">
            <span style="font-weight: bold;"><?php _e( 'Dribbble URL:', 'wpblink_flatolio' ); ?></span>
            <textarea class="widefat" rows="1" cols="1" id="<?php echo $this->get_field_id('contact_dribbble'); ?>" name="<?php echo $this->get_field_name('contact_dribbble'); ?>"><?php echo $contact_dribbble; ?></textarea>
        </label>
        <?php _e( 'Enter the full URL (including http://) of your Dribbble page.', 'wpblink_flatolio' ); ?>
    </p>
        <hr />
                <p>
        <label for="<?php echo $this->get_field_id("contact_youtube"); ?>">
            <span style="font-weight: bold;"><?php _e( 'Youtube URL:', 'wpblink_flatolio' ); ?></span>
            <textarea class="widefat" rows="1" cols="1" id="<?php echo $this->get_field_id('contact_youtube'); ?>" name="<?php echo $this->get_field_name('contact_youtube'); ?>"><?php echo $contact_youtube; ?></textarea>
        </label>
        <?php _e( 'Enter the full URL (including http://) of your Youtube page.', 'wpblink_flatolio' ); ?>
    </p>
        <hr />
                <p>
        <label for="<?php echo $this->get_field_id("contact_pinterest"); ?>">
            <span style="font-weight: bold;"><?php _e( 'Pinterest URL:', 'wpblink_flatolio' ); ?></span>
            <textarea class="widefat" rows="1" cols="1" id="<?php echo $this->get_field_id('contact_pinterest'); ?>" name="<?php echo $this->get_field_name('contact_pinterest'); ?>"><?php echo $contact_pinterest; ?></textarea>
        </label>
        <?php _e( 'Enter the full URL (including http://) of your Pinterest page.', 'wpblink_flatolio' ); ?>
    </p>
        <hr />
                <p>
        <label for="<?php echo $this->get_field_id("contact_instagram"); ?>">
            <span style="font-weight: bold;"><?php _e( 'Instagram URL:', 'wpblink_flatolio' ); ?></span>
            <textarea class="widefat" rows="1" cols="1" id="<?php echo $this->get_field_id('contact_instagram'); ?>" name="<?php echo $this->get_field_name('contact_instagram'); ?>"><?php echo $contact_instagram; ?></textarea>
        </label>
        <?php _e( 'Enter the full URL (including http://) of your Instagram page.', 'wpblink_flatolio' ); ?>
    </p>
        <hr />
                <p>
        <label for="<?php echo $this->get_field_id("contact_flickr"); ?>">
            <span style="font-weight: bold;"><?php _e( 'Flickr URL:', 'wpblink_flatolio' ); ?></span>
            <textarea class="widefat" rows="1" cols="1" id="<?php echo $this->get_field_id('contact_flickr'); ?>" name="<?php echo $this->get_field_name('contact_flickr'); ?>"><?php echo $contact_flickr; ?></textarea>
        </label>
        <?php _e( 'Enter the full URL (including http://) of your Flickr page.', 'wpblink_flatolio' ); ?>
    </p>
        <hr />
                <p>
        <label for="<?php echo $this->get_field_id("contact_form"); ?>">
            <span style="font-weight: bold;"><?php _e( 'CF7 Shortcode:', 'wpblink_flatolio' ); ?></span>
            <textarea class="widefat" rows="4" cols="4" id="<?php echo $this->get_field_id('contact_form'); ?>" name="<?php echo $this->get_field_name('contact_form'); ?>"><?php echo $contact_form; ?></textarea>
        </label>
        <?php _e( 'Enter your Contact Form 7 Shortcode.', 'wpblink_flatolio' ); ?>
    </p>
        <hr />
	<?php
		}
	}
	add_action( 'widgets_init', create_function('', 'return register_widget("wpblink_flatolio_contact");') );
	
	
	
	

	/**
	 * Create Video Widget
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/

class wpblink_flatolio_video extends WP_Widget {
	function wpblink_flatolio_video() {
		$widget_ops = array(
			'classname' => 'widget_wpblink_flatolio_video',
			'description' => 'Embed any YouTube video responsively.'
		);
		$this->WP_Widget(
			'wpblink_flatolio_video',
			'[FLATOLIO] Video',
			$widget_ops
		);
	}
	function widget($args, $instance) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		$video_intro = apply_filters( 'widget_execphp', $instance['video_intro'], $instance );
		$video_button = apply_filters( 'widget_execphp', $instance['video_button'], $instance );
		$video_button_text = apply_filters( 'widget_execphp', $instance['video_button_text'], $instance );
		$video_code = apply_filters( 'widget_execphp', $instance['video_code'], $instance );
		?>
		<?php echo $before_widget; ?>
		<div class="col span_3_of_3 trans unlimited">
			<div class="widget pad_most">
				<?php if ( $video_intro ) { ?>
					<?php echo '<h1 class="light">'; echo $instance['filter'] ? wpautop($video_intro) : $video_intro; echo '</h1>'; ?>
				<?php } else { ?>
					<?php echo '<h1 class="light">'; _e( 'video', 'wpblink_flatolio' ); echo '</h1>'; ?>
				<?php } ?>    
				<div class="video-container">
					<iframe seamless width="1200" height="675" src="//www.youtube.com/embed/<?php echo $instance['filter'] ? wpautop($video_code) : $video_code; ?>?rel=0"></iframe>
				</div>
				<?php if ( $video_button_text ) { ?>
        			<?php if ( $video_button ) { ?>
        			    <div class="break pad_all"></div>
        				<a href="<?php echo $instance['filter'] ? wpautop($video_button) : $video_button; ?>" class="button">
							<?php echo $instance['filter'] ? wpautop($video_button_text) : $video_button_text; ?>
                		</a>
                		<div class="break pad_all"></div>
        			<?php } else { ?>
        			<?php } ?>
        		<?php } else { ?>
        		<?php } ?>
 	       </div>
		</div>
        <?php
			echo $after_widget;
			}
			function update( $new_instance, $old_instance ) {
				$instance = $old_instance;
				$instance['title'] = strip_tags($new_instance['title']);
				if ( current_user_can('unfiltered_html') )
					$instance['video_intro'] =  $new_instance['video_intro'];
				else
					$instance['video_intro'] = stripslashes( wp_filter_post_kses( $new_instance['video_intro'] ) );
					
				if ( current_user_can('unfiltered_html') )
					$instance['video_button'] =  $new_instance['video_button'];
				else
					$instance['video_button'] = stripslashes( wp_filter_post_kses( $new_instance['video_button'] ) );
					
				if ( current_user_can('unfiltered_html') )
					$instance['video_button_text'] =  $new_instance['video_button_text'];
				else
					$instance['video_button_text'] = stripslashes( wp_filter_post_kses( $new_instance['video_button_text'] ) );
					
				if ( current_user_can('unfiltered_html') )
					$instance['video_code'] =  $new_instance['video_code'];
				else
					$instance['video_code'] = stripslashes( wp_filter_post_kses( $new_instance['video_code'] ) );
					$instance['filter'] = isset($new_instance['filter']);
					return $instance;
				}
			function form( $instance ) {
				$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'video_intro' => '', 'video_button' => '', 'video_button_text' => '', 'video_code' => '' ) );
				$title = strip_tags($instance['title']);
				$video_intro = format_to_edit($instance['video_intro']);
				$video_button = format_to_edit($instance['video_button']);
				$video_button_text = format_to_edit($instance['video_button_text']);
				$video_code = format_to_edit($instance['video_code']);
		?>
        <p>
        	<label for="<?php echo $this->get_field_id("video_intro"); ?>">
        		<span style="font-weight: bold;"><?php _e( 'Title:', 'wpblink_flatolio' ); ?></span>
        		<textarea class="widefat" rows="1" cols="1" id="<?php echo $this->get_field_id('video_intro'); ?>" name="<?php echo $this->get_field_name('video_intro'); ?>"><?php echo $video_intro; ?></textarea>
        	</label>
        	<?php _e( 'Enter your custom title for this section.', 'wpblink_flatolio' ); ?>
        </p>
        <hr />
    <p>
        <label for="<?php echo $this->get_field_id("video_code"); ?>">
            <span style="font-weight: bold;"><?php _e( 'Button Text:', 'wpblink_flatolio' ); ?></span>
            <textarea class="widefat" rows="1" cols="1" id="<?php echo $this->get_field_id('video_code'); ?>" name="<?php echo $this->get_field_name('video_code'); ?>"><?php echo $video_code; ?></textarea>
        </label>
        <?php _e( 'Enter your custom button text (optional).', 'wpblink_flatolio' ); ?>
    </p>
    <hr />
    <p>
        <label for="<?php echo $this->get_field_id("video_button_text"); ?>">
            <span style="font-weight: bold;"><?php _e( 'Button Text:', 'wpblink_flatolio' ); ?></span>
            <textarea class="widefat" rows="1" cols="1" id="<?php echo $this->get_field_id('video_button_text'); ?>" name="<?php echo $this->get_field_name('video_button_text'); ?>"><?php echo $video_button_text; ?></textarea>
        </label>
        <?php _e( 'Enter your custom button text (optional).', 'wpblink_flatolio' ); ?>
    </p>
    <hr />
    <p>
        <label for="<?php echo $this->get_field_id("video_button"); ?>">
            <span style="font-weight: bold;"><?php _e( 'Button URL:', 'wpblink_flatolio' ); ?></span>
            <textarea class="widefat" rows="2" cols="2" id="<?php echo $this->get_field_id('video_button'); ?>" name="<?php echo $this->get_field_name('video_button'); ?>"><?php echo $video_button; ?></textarea>
        </label>
        <?php _e( 'Enter the full destination URL (including http://) for the button (optional).', 'wpblink_flatolio' ); ?>
    </p>
    <hr />
	<?php
		}
	}
	add_action( 'widgets_init', create_function('', 'return register_widget("wpblink_flatolio_video");') );
	
	
	
	
			
// WIDGET: Latest Comments

class wpblink_flatolio_latestcomments extends WP_Widget {
	function wpblink_flatolio_latestcomments() {
		$widget_ops = array(
			'classname' => 'widget_wpblink_flatolio_latestcomments',
			'description' => 'List your latest comments.'
		);
		$this->WP_Widget(
			'wpblink_flatolio_latestcomments',
			'Latest Comments',
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
  $output .= "\n<div class=\"lightshade\"><ul>";
  foreach ($comments as $comment) {
    $output .= "\n<li><a href=\"" . get_permalink($comment->ID)."#comment-" . $comment->comment_ID . "\" title=\"By ".strip_tags($comment->comment_author) . "\">" . strip_tags($comment->com_excerpt)."</a></li>";
  }
  $output .= "\n</ul></div>";
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
	add_action( 'widgets_init', create_function('', 'return register_widget("wpblink_flatolio_latestcomments");') );
	
?>