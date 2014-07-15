<?php
// Add function to widgets_init
add_action( 'widgets_init', 'of_contact_widgets' );
add_filter('of_contact_widgets', 'do_shortcode');
// Register widget
function of_contact_widgets() {
	register_widget( 'of_contacT_Widget' );
}
// Widget class
class of_contact_widget extends WP_Widget {
	
function of_contacT_Widget() {

	// Widget settings
	$widget_ops = array(
		'classname' => 'of_contact_widget',
		'description' => __('Display contact information.', 'iwebtheme')
	);

	// Widget control settings
	$control_ops = array(
		'width' => 300,
		'height' => 350,
		'id_base' => 'of_contact_widget'
	);

	// Create the widget
	$this->WP_Widget( 'of_contact_widget', __('Contact info widget', 'iwebtheme'), $widget_ops, $control_ops );
	
}
	
function widget( $args, $instance ) {
	extract( $args );

	// Our variables from the widget settings
	$title = apply_filters('widget_title', $instance['title'] );
	$Company = $instance['Company'];
	$Address = $instance['Address'];
	$Phone = $instance['Phone'];
	$Email = $instance['Email'];

	// Before widget (defined by theme functions file)
	echo $before_widget;

	if ( $title )
		echo $before_title . $title . $after_title;


	// Display contact info
	 ?>
		<address>
		<?php if ($Company!=='') { ?>
		<strong><?php echo $Company; ?></strong><br />
		<?php } ?>	
		<?php if ($Address!=='') { ?>
		<?php echo $Address; ?>
		<?php } ?>
		</address>	
		<p>
		<?php if ($Phone!=='') { ?>
			<i class="icon-phone"></i><?php echo $Phone; ?><br>
		<?php } ?>	
		<?php if ($Email!=='') { ?>
			<i class="icon-envelope-alt"></i><a href="mailto:<?php echo $Email; ?>"><?php echo $Email; ?></a>
		<?php } ?>
		</p>
		
	
	<?php
	// After widget (defined by theme functions file)
	echo $after_widget;	
}
	
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	// Strip tags to remove HTML 
	$instance['title'] = strip_tags( $new_instance['title'] );
	$instance['Company'] = strip_tags( $new_instance['Company'] );
	$instance['Address'] = strip_tags( $new_instance['Address'] );
	$instance['Phone'] = strip_tags( $new_instance['Phone'] );
	$instance['Email'] = strip_tags( $new_instance['Email'] );
	return $instance;
}
	
	function form( $instance ) {
	
	// Set up some default widget settings
	$defaults = array(
			'title' => __( 'Contact info', 'iwebtheme'), 
			'Company' => __( 'Moderna company Inc ', 'iwebtheme' ),
			'Address' => __( 'Modernbuilding suite V124, AB 01 Someplace 16425 Earth ', 'iwebtheme' ),
			'Phone' => __( '(123) 456-7890 - (123) 555-7891', 'iwebtheme'), 
			'Email' => __( 'email@domainname.com', 'iwebtheme')
	);

		$instance = wp_parse_args( (array)$instance, $defaults );
?>
	<p><label for="<?php echo $this->get_field_id( 'title' ) ?>"><?php _e( 'Widget Title', 'iwebtheme' ) ?></label>
    	<input type="text" class="widefat" name="<?php echo $this->get_field_name( 'title' ) ?>" id="<?php echo $this->get_field_id( 'title' ) ?>" value="<?php echo $instance['title'] ?>"/></p>
	<p>
		<label for="<?php echo $this->get_field_id( 'Company' ); ?>"><?php _e('Company:', 'iwebtheme') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'Company' ); ?>" name="<?php echo $this->get_field_name( 'Company' ); ?>" value="<?php echo $instance['Company']; ?>" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'Address' ); ?>"><?php _e('Address:', 'iwebtheme') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'Address' ); ?>" name="<?php echo $this->get_field_name( 'Address' ); ?>" value="<?php echo $instance['Address']; ?>" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'Phone' ); ?>"><?php _e('Phone:', 'iwebtheme') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'Phone' ); ?>" name="<?php echo $this->get_field_name( 'Phone' ); ?>" value="<?php echo $instance['Phone']; ?>" />
		
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'Email' ); ?>"><?php _e('Email:', 'iwebtheme') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'Email' ); ?>" name="<?php echo $this->get_field_name( 'Email' ); ?>" value="<?php echo $instance['Email']; ?>" />
	</p>

<?php
	}
}
?>