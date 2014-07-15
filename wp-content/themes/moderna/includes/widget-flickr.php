<?php
// Add function to widgets_init
add_action( 'widgets_init', 'iweb_flickr_widgets' );

// Register widget
function iweb_flickr_widgets() {
	register_widget( 'iweb_flickr_widget' );
}

// Widget class
class iweb_flickr_widget extends WP_Widget {
	
function iweb_flickr_widget() {

	// Widget settings
	$widget_ops = array(
		'classname' => 'iweb_flickr_widget',
		'description' => __('Display Flickr photos.', 'iwebtheme')
	);

	// Widget control settings
	$control_ops = array(
		'id_base' => 'iweb_flickr_widget'
	);

	// Create the widget
	$this->WP_Widget( 'iweb_flickr_widget', __('Flickr Photos', 'iwebtheme'), $widget_ops, $control_ops );
	
}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
function widget( $args, $instance ) {
	extract( $args );

	// Our variables from the widget settings
	$title = apply_filters('widget_title', $instance['title'] );
	$uniqueid = $instance['uniqueid'];
	$flickrID = $instance['flickrID'];
	$postcount = $instance['postcount'];

	// Before widget (defined by theme functions file)
	echo $before_widget;

	// Display the widget title if one was input
	if ( $title )
		echo $before_title . $title . $after_title;

	// Display Flickr Photos
	 ?>
	<div class="flickr_badge">
	<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $postcount; ?>&amp;display=random&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $flickrID; ?>"></script>
	</div>
	
	<?php
	// After widget (defined by theme functions file)
	echo $after_widget;	
}

/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	// Strip tags to remove HTML 
	$instance['title'] = strip_tags( $new_instance['title'] );
	$instance['uniqueid'] = strip_tags( $new_instance['uniqueid'] );
	$instance['flickrID'] = strip_tags( $new_instance['flickrID'] );
	$instance['postcount'] = strip_tags( $new_instance['postcount'] );
	return $instance;
}


/*-----------------------------------------------------------------------------------*/
/*	Widget Settings (Displays the widget settings controls on the widget panel)
/*-----------------------------------------------------------------------------------*/
	 
function form( $instance ) {

	// Set up some default widget settings
	$defaults = array(
		'title' => 'Flickr Photos',
		'flickrID' => '91212552@N07',
		'uniqueid' => '1',
		'postcount' => '6',
		'size' => 's',
	);
	
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'iwebtheme') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'uniqueid' ); ?>"><?php _e('Enter unique number ID for multi instance flickr widget:', 'iwebtheme') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'uniqueid' ); ?>" name="<?php echo $this->get_field_name( 'uniqueid' ); ?>" value="<?php echo $instance['uniqueid']; ?>" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'flickrID' ); ?>"><?php _e('Flickr ID, you can get via http://idgettr.com:', 'iwebtheme') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'flickrID' ); ?>" name="<?php echo $this->get_field_name( 'flickrID' ); ?>" value="<?php echo $instance['flickrID']; ?>" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'postcount' ); ?>"><?php _e('Number of Photos:', 'iwebtheme') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" value="<?php echo $instance['postcount']; ?>" />
	</p>
	<?php
	}
}
?>