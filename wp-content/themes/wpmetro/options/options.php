<?php
 /**
  * @package WPBlink_FlexPost
  * @since 1.0
  * @modified  1.0
 */
 
class My_Theme_Options {
	
	private $sections;
	private $checkboxes;
	private $settings;
	
	/**
	 * Construct
	 *
	 * @since 1.0
	 */
	public function __construct() {
		
		// This will keep track of the checkbox options for the validate_settings function.
		$this->checkboxes = array();
		$this->settings = array();
		$this->get_option();
		
		$this->sections['general']      = __( 'General', 'wpblink_flexpost' );
		$this->sections['appearance']   = __( 'Appearance', 'wpblink_flexpost' );
		$this->sections['social']   = __( 'Social', 'wpblink_flexpost' );
		$this->sections['miscellaneous']   = __( 'Miscellaneous', 'wpblink_flexpost' );
		
		add_action( 'admin_menu', array( &$this, 'add_pages' ) );
		add_action( 'admin_init', array( &$this, 'register_settings' ) );
		
		if ( ! get_option( 'mytheme_options' ) )
			$this->initialize_settings();
		
	}
	
	/**
	 * Add options page
	 *
	 * @since 1.0
	 */
	public function add_pages() {
		
		$admin_page = add_theme_page( __( 'Theme Options', 'wpblink_flexpost' ), __( 'Theme Options', 'wpblink_flexpost' ), 'manage_options', 'mytheme-options', array( &$this, 'display_page' ) );
		
		add_action( 'admin_print_scripts-' . $admin_page, array( &$this, 'scripts' ) );
		add_action( 'admin_print_styles-' . $admin_page, array( &$this, 'styles' ) );
		
	}
	
	/**
	 * Create settings field
	 *
	 * @since 1.0
	 */
	public function create_setting( $args = array() ) {
		
		$defaults = array(
			'id'      => 'default_field',
			'title'   => __( 'Default Field', 'wpblink_flexpost' ),
			'desc'    => __( 'This is a default description.', 'wpblink_flexpost' ),
			'std'     => '',
			'type'    => 'text',
			'section' => 'general',
			'choices' => array(),
			'class'   => ''
		);
			
		extract( wp_parse_args( $args, $defaults ) );
		
		$field_args = array(
			'type'      => $type,
			'id'        => $id,
			'desc'      => $desc,
			'std'       => $std,
			'choices'   => $choices,
			'label_for' => $id,
			'class'     => $class
		);
		
		if ( $type == 'checkbox' )
			$this->checkboxes[] = $id;
		
		add_settings_field( $id, $title, array( $this, 'display_setting' ), 'mytheme-options', $section, $field_args );
	}
	
	/**
	 * Display options page
	 *
	 * @since 1.0
	 */
	public function display_page() {
		
		echo '<div class="wrap">';
	
		if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] == true )
			echo '<div class="updated fade"><p>' . __( 'Theme options updated.', 'wpblink_flexpost' ) . '</p></div>';
		
		echo '<form action="options.php" method="post">';
	
		settings_fields( 'mytheme_options' );
		echo '<div class="ui-tabs">
		
		<h2 class="options_title">' . __( 'Theme Options', 'wpblink_flexpost' ) . '</h2>
		
			<ul class="ui-tabs-nav">';
		
		foreach ( $this->sections as $section_slug => $section )
			echo '<li><a href="#' . $section_slug . '">' . $section . '</a></li>';
		
		echo '</ul>';
		do_settings_sections( $_GET['page'] );
		
		echo '</div>
		<p class="submit"><input name="Submit" type="submit" class="button-primary" value="' . __( 'Save Changes', 'wpblink_flexpost' ) . '" /></p>
		
	</form>';
	
	echo '<script type="text/javascript">
		jQuery(document).ready(function($) {
			var sections = [];';
			
			foreach ( $this->sections as $section_slug => $section )
				echo "sections['$section'] = '$section_slug';";
			
			echo 'var wrapped = $(".wrap h3").wrap("<div class=\"ui-tabs-panel\">");
			wrapped.each(function() {
				$(this).parent().append($(this).parent().nextUntil("div.ui-tabs-panel"));
			});
			$(".ui-tabs-panel").each(function(index) {
				$(this).attr("id", sections[$(this).children("h3").text()]);
				if (index > 0)
					$(this).addClass("ui-tabs-hide");
			});
			$(".ui-tabs").tabs({
				fx: { opacity: "toggle", duration: "fast" }
			});
			
			$("input[type=text], textarea").each(function() {
				if ($(this).val() == $(this).attr("placeholder") || $(this).val() == "")
					$(this).css("color", "#999");
			});
			
			$("input[type=text], textarea").focus(function() {
				if ($(this).val() == $(this).attr("placeholder") || $(this).val() == "") {
					$(this).val("");
					$(this).css("color", "#000");
				}
			}).blur(function() {
				if ($(this).val() == "" || $(this).val() == $(this).attr("placeholder")) {
					$(this).val($(this).attr("placeholder"));
					$(this).css("color", "#999");
				}
			});
			
			$(".wrap h3, .wrap table").show();
			
			// This will make the "warning" checkbox class really stand out when checked.
			// I use it here for the Reset checkbox.
			$(".warning").change(function() {
				if ($(this).is(":checked"))
					$(this).parent().css("background", "#e74c3c").css("color", "#fff").css("fontWeight", "bold");
				else
					$(this).parent().css("background", "none").css("color", "inherit").css("fontWeight", "normal");
			});
			
			// Browser compatibility
			if ($.browser.mozilla) 
			         $("form").attr("autocomplete", "off");
		});
	</script>
</div>';
		
	}
	
	/**
	 * Description for section
	 *
	 * @since 1.0
	 */
	public function display_section() {
		// code
	}
	
	/**
	 * Description for About section
	 *
	 * @since 1.0
	 */
	public function display_about_section() {
		
		// This displays on the "About" tab. Echo regular HTML here, like so:
		// echo '<p>Copyright 2014 me@example.com</p>';
		
	}
	
	/**
	 * HTML output for text field
	 *
	 * @since 1.0
	 */
	public function display_setting( $args = array() ) {
		
		extract( $args );
		
		$options = get_option( 'mytheme_options' );
		
		if ( ! isset( $options[$id] ) && $type != 'checkbox' )
			$options[$id] = $std;
		elseif ( ! isset( $options[$id] ) )
			$options[$id] = 0;
		
		$field_class = '';
		if ( $class != '' )
			$field_class = ' ' . $class;
		
		switch ( $type ) {
			
			case 'heading':
				echo '</td></tr><tr valign="top"><td colspan="2"><h4>' . $desc . '</h4>';
				break;
			
			case 'checkbox':
				
				echo '<input class="checkbox' . $field_class . '" type="checkbox" id="' . $id . '" name="mytheme_options[' . $id . ']" value="1" ' . checked( $options[$id], 1, false ) . ' /> <label for="' . $id . '">' . $desc . '</label>';
				
				break;
			
			case 'select':
				echo '<select class="select' . $field_class . '" name="mytheme_options[' . $id . ']">';
				
				foreach ( $choices as $value => $label )
					echo '<option value="' . esc_attr( $value ) . '"' . selected( $options[$id], $value, false ) . '>' . $label . '</option>';
				
				echo '</select>';
				
				if ( $desc != '' )
					echo '<br /><span class="description">' . $desc . '</span>';
				
				break;
			
			case 'radio':
				$i = 0;
				foreach ( $choices as $value => $label ) {
					echo '<input class="radio' . $field_class . '" type="radio" name="mytheme_options[' . $id . ']" id="' . $id . $i . '" value="' . esc_attr( $value ) . '" ' . checked( $options[$id], $value, false ) . '> <label for="' . $id . $i . '">' . $label . '</label>';
					if ( $i < count( $options ) - 1 )
						echo '<br />';
					$i++;
				}
				
				if ( $desc != '' )
					echo '<span class="description">' . $desc . '</span>';
				
				break;
			
			case 'textarea':
				echo '<textarea class="' . $field_class . '" id="' . $id . '" name="mytheme_options[' . $id . ']" placeholder="' . $std . '" rows="5" cols="30">' . wp_htmledit_pre( $options[$id] ) . '</textarea>';
				
				if ( $desc != '' )
					echo '<br /><span class="description">' . $desc . '</span>';
				
				break;
			
			case 'password':
				echo '<input class="regular-text' . $field_class . '" type="password" id="' . $id . '" name="mytheme_options[' . $id . ']" value="' . esc_attr( $options[$id] ) . '" />';
				
				if ( $desc != '' )
					echo '<br /><span class="description">' . $desc . '</span>';
				
				break;
			
			case 'text':
			default:
		 		echo '<input class="regular-text' . $field_class . '" type="text" id="' . $id . '" name="mytheme_options[' . $id . ']" placeholder="' . $std . '" value="' . esc_attr( $options[$id] ) . '" />';
		 		
		 		if ( $desc != '' )
		 			echo '<br /><span class="description">' . $desc . '</span>';
		 		
		 		break;
		 	
		}
		
	}
	
	/**
	 * Settings and defaults
	 * 
	 * @since 1.0
	 */
	public function get_option() {
		
		/* General Settings
		===========================================*/
		
		
		$this->settings['title_sitename'] = array(
			'section' => 'general',
			'title'   => '', // Not used for headings.
			'desc'    => 'Sitename',
			'type'    => 'heading'
		);
		
		$this->settings['site_name'] = array(
			'title'   => __( 'Sitename Text', 'wpblink_flexpost' ),
			'desc'    => __( 'Enter your custom sitename text (Not used if a logo uploaded.).', 'wpblink_flexpost' ),
			'std'     => '',
			'type'    => 'text',
			'section' => 'general'
		);
		
		$this->settings['site_desc'] = array(
			'title'   => __( 'Description Text', 'wpblink_flexpost' ),
			'desc'    => __( 'Enter your custom site description text (Not used if a logo uploaded.).', 'wpblink_flexpost' ),
			'std'     => '',
			'type'    => 'text',
			'section' => 'general'
		);
		
		
		
		
		$this->settings['title_homepage'] = array(
			'section' => 'general',
			'title'   => '', // Not used for headings.
			'desc'    => 'Homepage',
			'type'    => 'heading'
		);
		
		$this->settings['layout_config'] = array(
			'section' => 'general',
			'title'   => __( 'Layout Config', 'wpblink_flexpost' ),
			'desc'    => __( 'Select your preferred homepage configuration.', 'wpblink_flexpost' ),
			'type'    => 'radio',
			'std'     => 'choice1',
			'choices' => array(
				'choice1' => 'Short (19 Posts)',
				'choice2' => 'Medium (37 Posts)',
				'choice3' => 'Long (56 Posts)',
				'choice4' => 'Super Long (75 Posts)'
			)
		);
		


		
		$this->settings['title_general'] = array(
			'section' => 'general',
			'title'   => '', // Not used for headings.
			'desc'    => 'General',
			'type'    => 'heading'
		);
		
		$this->settings['date_format'] = array(
			'section' => 'general',
			'title'   => __( 'Date Format', 'wpblink_flexpost' ),
			'desc'    => __( 'Select your preferred global date format.', 'wpblink_flexpost' ),
			'type'    => 'radio',
			'std'     => 'choice1',
			'choices' => array(
				'choice1' => 'Month Day Year',
				'choice2' => 'Day Month Year',
				'choice3' => 'Year Month Day',
				'choice4' => 'Year Day Month'
			)
		);
		
		$this->settings['select_search'] = array(
			'section' => 'general',
			'title'   => __( 'Search Field', 'wpblink_flexpost' ),
			'desc'    => __( 'Do you wish to display the built-in search field?', 'wpblink_flexpost' ),
			'type'    => 'radio',
			'std'     => 'choice1',
			'choices' => array(
				'choice1' => 'Enable',
				'choice2' => 'Disable'
			)
		);
		
		$this->settings['select_tickertape'] = array(
			'section' => 'general',
			'title'   => __( 'Tickertape', 'wpblink_flexpost' ),
			'desc'    => __( 'Do you wish to display the scrolling posts tickertape within the header?', 'wpblink_flexpost' ),
			'type'    => 'radio',
			'std'     => 'choice1',
			'choices' => array(
				'choice1' => 'Enable',
				'choice2' => 'Disable'
			)
		);
		

		
		
		
		

		
		$this->settings['title_footer'] = array(
			'section' => 'general',
			'title'   => '', // Not used for headings.
			'desc'    => 'Footer',
			'type'    => 'heading'
		);
		
		
		$this->settings['select_btt'] = array(
			'section' => 'general',
			'title'   => __( 'Back To Top Button', 'wpblink_flexpost' ),
			'desc'    => __( 'Do you wish to enable the Back To Top button within the footer?', 'wpblink_flexpost' ),
			'type'    => 'radio',
			'std'     => 'choice1',
			'choices' => array(
				'choice1' => 'Enable',
				'choice2' => 'Disable'
			)
		);
		
		$this->settings['copyright'] = array(
			'title'   => __( 'Copyright Text', 'wpblink_flexpost' ),
			'desc'    => __( 'Add your custom copyright text here (HTML allowed for linking)<br />Or leave blank to display dynamic copyright text.', 'wpblink_flexpost' ),
			'std'     => '',
			'type'    => 'textarea',
			'section' => 'general',
			'class'   => 'code'
		);
		
		
		/* Appearance
		===========================================*/

	
		$this->settings['title_colorpickers'] = array(
			'section' => 'appearance',
			'title'   => '', // Not used for headings.
			'desc'    => 'Color Scheme',
			'type'    => 'heading'
		);
		
		$this->settings['cp_body'] = array(
			'section' => 'appearance',
			'title' => __( 'Body Text', 'wpblink_flexpost' ),
			'desc' => __( 'Choose a neutral color for your body text (leave blank for default value).', 'wpblink_flexpost' ),
			'class' => "color {pickerMode:'HSV',pickerFaceColor:'#333333',pickerBorder: 0}", // Custom class for CSS
			'type' => 'text',
			'std' => '98c5c9',
		);
		
		$this->settings['cp_alt'] = array(
			'section' => 'appearance',
			'title' => __( 'Alternative Text', 'wpblink_flexpost' ),
			'desc' => __( 'Choose a neutral color for your alternative body text (leave blank for default value).', 'wpblink_flexpost' ),
			'class' => "color {pickerMode:'HSV',pickerFaceColor:'#333333',pickerBorder: 0}", // Custom class for CSS
			'type' => 'text',
			'std' => '6eadb3',
		);
		
		$this->settings['cp_link'] = array(
			'section' => 'appearance',
			'title' => __( 'Link Text', 'wpblink_flexpost' ),
			'desc' => __( 'Choose a neutral color for your body text (leave blank for default value).', 'wpblink_flexpost' ),
			'class' => "color {pickerMode:'HSV',pickerFaceColor:'#333333',pickerBorder: 0}", // Custom class for CSS
			'type' => 'text',
			'std' => 'ffffff',
		);
		
		$this->settings['cp_metro1'] = array(
			'section' => 'appearance',
			'title' => __( 'Metro #1', 'wpblink_flexpost' ),
			'desc' => __( 'Choose a vibrant color for this metro color (leave blank for default value).', 'wpblink_flexpost' ),
			'class' => "color {pickerMode:'HSV',pickerFaceColor:'#333333',pickerBorder: 0}", // Custom class for CSS
			'type' => 'text',
			'std' => '3b83f9',
		);
		
		$this->settings['cp_metro1_shade1'] = array(
			'section' => 'appearance',
			'title' => __( 'Metro #1 Shade #1', 'wpblink_flexpost' ),
			'desc' => __( 'Choose a darker shade of Metro #1 color (leave blank for default value).', 'wpblink_flexpost' ),
			'class' => "color {pickerMode:'HSV',pickerFaceColor:'#333333',pickerBorder: 0}", // Custom class for CSS
			'type' => 'text',
			'std' => '276ee3',
		);
		
		$this->settings['cp_metro1_shade2'] = array(
			'section' => 'appearance',
			'title' => __( 'Metro #1 Shade #2', 'wpblink_flexpost' ),
			'desc' => __( 'Choose an even darker shade of Metro #1 color (leave blank for default value).', 'wpblink_flexpost' ),
			'class' => "color {pickerMode:'HSV',pickerFaceColor:'#333333',pickerBorder: 0}", // Custom class for CSS
			'type' => 'text',
			'std' => '185ed0',
		);
		
		$this->settings['cp_metro2'] = array(
			'section' => 'appearance',
			'title' => __( 'Metro #2', 'wpblink_flexpost' ),
			'desc' => __( 'Choose a vibrant color for this metro color (leave blank for default value).', 'wpblink_flexpost' ),
			'class' => "color {pickerMode:'HSV',pickerFaceColor:'#333333',pickerBorder: 0}", // Custom class for CSS
			'type' => 'text',
			'std' => 'd64b2a',
		);
		
		$this->settings['cp_metro3'] = array(
			'section' => 'appearance',
			'title' => __( 'Metro #3', 'wpblink_flexpost' ),
			'desc' => __( 'Choose a vibrant color for this metro color (leave blank for default value).', 'wpblink_flexpost' ),
			'class' => "color {pickerMode:'HSV',pickerFaceColor:'#333333',pickerBorder: 0}", // Custom class for CSS
			'type' => 'text',
			'std' => 'be153e',
		);
		
		$this->settings['cp_metro4'] = array(
			'section' => 'appearance',
			'title' => __( 'Metro #4', 'wpblink_flexpost' ),
			'desc' => __( 'Choose a vibrant color for this metro color (leave blank for default value).', 'wpblink_flexpost' ),
			'class' => "color {pickerMode:'HSV',pickerFaceColor:'#333333',pickerBorder: 0}", // Custom class for CSS
			'type' => 'text',
			'std' => '21aeb0',
		);
		
		$this->settings['cp_metro5'] = array(
			'section' => 'appearance',
			'title' => __( 'Metro #5', 'wpblink_flexpost' ),
			'desc' => __( 'Choose a vibrant color for this metro color (leave blank for default value).', 'wpblink_flexpost' ),
			'class' => "color {pickerMode:'HSV',pickerFaceColor:'#333333',pickerBorder: 0}", // Custom class for CSS
			'type' => 'text',
			'std' => '5334b3',
		);
		

		

		
		
		$this->settings['title_customstyling'] = array(
			'section' => 'appearance',
			'title'   => '', // Not used for headings.
			'desc'    => 'Custom Styling',
			'type'    => 'heading'
		);
		
	
		$this->settings['custom_css'] = array(
			'title'   => __( 'Custom CSS', 'wpblink_flexpost' ),
			'desc'    => __( 'Enter any custom CSS here to apply it to your theme.', 'wpblink_flexpost' ),
			'std'     => '',
			'type'    => 'textarea',
			'section' => 'appearance',
			'class'   => 'code'
		);
		
		
		
	
		
		
		
		
		/* Social
		===========================================*/

		$this->settings['title_social'] = array(
			'section' => 'social',
			'title'   => '', // Not used for headings.
			'desc'    => 'Social URLs',
			'type'    => 'heading'
		);
		
		$this->settings['select_social_post'] = array(
			'section' => 'social',
			'title'   => __( 'Post Social Icons', 'wpblink_flexpost' ),
			'desc'    => __( 'Select wether to activate the AddToAny social post buttons.', 'wpblink_flexpost' ),
			'type'    => 'radio',
			'std'     => 'choice1',
			'choices' => array(
				'choice1' => 'Enable',
				'choice2' => 'Disable'
			)
		);
		
		$this->settings['select_social'] = array(
			'section' => 'social',
			'title'   => __( 'Header Social Icons', 'wpblink_flexpost' ),
			'desc'    => __( 'You can choose not to display any social icons at all within the header, disabling all of the below settings.', 'wpblink_flexpost' ),
			'type'    => 'radio',
			'std'     => 'choice1',
			'choices' => array(
				'choice1' => 'Enable',
				'choice2' => 'Disable'
			)
		);
		
		$this->settings['social_fb'] = array(
			'title'   => __( 'Facebook URL', 'wpblink_flexpost' ),
			'desc'    => __( 'Add the full URL to your Facebook page.', 'wpblink_flexpost' ),
			'std'     => '',
			'type'    => 'text',
			'section' => 'social',
			'class' => 'code'
		);
		
		$this->settings['social_tw'] = array(
			'title'   => __( 'Twitter URL', 'wpblink_flexpost' ),
			'desc'    => __( 'Add the full URL to your Twitter page.', 'wpblink_flexpost' ),
			'std'     => '',
			'type'    => 'text',
			'section' => 'social',
			'class' => 'code'
		);
		
		$this->settings['social_yt'] = array(
			'title'   => __( 'YouTube URL', 'wpblink_flexpost' ),
			'desc'    => __( 'Add the full URL to your YouTube page.', 'wpblink_flexpost' ),
			'std'     => '',
			'type'    => 'text',
			'section' => 'social',
			'class' => 'code'
		);
		
		$this->settings['social_ig'] = array(
			'title'   => __( 'Instagram URL', 'wpblink_flexpost' ),
			'desc'    => __( 'Add the full URL to your Instagram page.', 'wpblink_flexpost' ),
			'std'     => '',
			'type'    => 'text',
			'section' => 'social',
			'class' => 'code'
		);
		
		$this->settings['social_pi'] = array(
			'title'   => __( 'Pinterest URL', 'wpblink_flexpost' ),
			'desc'    => __( 'Add the full URL to your Pinterest page.', 'wpblink_flexpost' ),
			'std'     => '',
			'type'    => 'text',
			'section' => 'social',
			'class' => 'code'
		);
		
		$this->settings['social_sc'] = array(
			'title'   => __( 'SoundCloud URL', 'wpblink_flexpost' ),
			'desc'    => __( 'Add the full URL to your SoundCloud page.', 'wpblink_flexpost' ),
			'std'     => '',
			'type'    => 'text',
			'section' => 'social',
			'class' => 'code'
		);
		
		$this->settings['social_gp'] = array(
			'title'   => __( 'Google Plus URL', 'wpblink_flexpost' ),
			'desc'    => __( 'Add the full URL to your Google Plus page.', 'wpblink_flexpost' ),
			'std'     => '',
			'type'    => 'text',
			'section' => 'social',
			'class' => 'code'
		);
		
		$this->settings['social_fr'] = array(
			'title'   => __( 'Flickr URL', 'wpblink_flexpost' ),
			'desc'    => __( 'Add the full URL to your Flickr page.', 'wpblink_flexpost' ),
			'std'     => '',
			'type'    => 'text',
			'section' => 'social',
			'class' => 'code'
		);
		
		$this->settings['social_li'] = array(
			'title'   => __( 'LinkedIn URL', 'wpblink_flexpost' ),
			'desc'    => __( 'Add the full URL to your LinkedIn page.', 'wpblink_flexpost' ),
			'std'     => '',
			'type'    => 'text',
			'section' => 'social',
			'class' => 'code'
		);
		
		$this->settings['social_dr'] = array(
			'title'   => __( 'Dribbble URL', 'wpblink_flexpost' ),
			'desc'    => __( 'Add the full URL to your Dribbble page.', 'wpblink_flexpost' ),
			'std'     => '',
			'type'    => 'text',
			'section' => 'social',
			'class' => 'code'
		);
		
		$this->settings['social_vm'] = array(
			'title'   => __( 'Vimeo URL', 'wpblink_flexpost' ),
			'desc'    => __( 'Add the full URL to your Vimeo page.', 'wpblink_flexpost' ),
			'std'     => '',
			'type'    => 'text',
			'section' => 'social',
			'class' => 'code'
		);
		
		$this->settings['social_da'] = array(
			'title'   => __( 'Deviant Art URL', 'wpblink_flexpost' ),
			'desc'    => __( 'Add the full URL to your Deviant Art page.', 'wpblink_flexpost' ),
			'std'     => '',
			'type'    => 'text',
			'section' => 'social',
			'class' => 'code'
		);
		
		$this->settings['social_sk'] = array(
			'title'   => __( 'Skype URL', 'wpblink_flexpost' ),
			'desc'    => __( 'Add the full URL to your Skype page.', 'wpblink_flexpost' ),
			'std'     => '',
			'type'    => 'text',
			'section' => 'social',
			'class' => 'code'
		);

		
		
		/* Miscellaneous Settings
		===========================================*/
		
	
		$this->settings['title_comments'] = array(
			'section' => 'miscellaneous',
			'title'   => '', // Not used for headings.
			'desc'    => 'Comments',
			'type'    => 'heading'
		);
		
		$this->settings['comments_selector'] = array(
			'section' => 'miscellaneous',
			'title'   => __( 'Comments Selector', 'wpblink_flexpost' ),
			'desc'    => __( 'Select a commenting system to use, if any.', 'wpblink_flexpost' ),
			'type'    => 'radio',
			'std'     => 'choice1',
			'choices' => array(
				'choice1' => 'Disqus.com',
				'choice2' => 'Wordpress Threaded with Gravatars',
				'choice3' => 'None'
			)
		);
		
		
		$this->settings['comments_disqus'] = array(
			'title'   => __( 'Disqus Universal Code', 'wpblink_flexpost' ),
			'desc'    => __( 'If you selected to use the Disqus commenting system, paste your UNIVERSAL CODE here to activate comments.', 'wpblink_flexpost' ),
			'std'     => '',
			'type'    => 'textarea',
			'section' => 'miscellaneous',
			'class' => 'code'
		);
		
		
		$this->settings['title_seo'] = array(
			'section' => 'miscellaneous',
			'title'   => '', // Not used for headings.
			'desc'    => 'SEO',
			'type'    => 'heading'
		);
		
		$this->settings['misc_metadesc'] = array(
			'title'   => __( 'META Description', 'wpblink_flexpost' ),
			'desc'    => __( 'Add your custom META description text (optional).', 'wpblink_flexpost' ),
			'std'     => '',
			'type'    => 'textarea',
			'section' => 'miscellaneous',
			'class'   => 'code'
		);
		
		$this->settings['misc_metakeywords'] = array(
			'title'   => __( 'META Keywords', 'wpblink_flexpost' ),
			'desc'    => __( 'Add your custom META keywords, seperated by commas (optional).', 'wpblink_flexpost' ),
			'std'     => '',
			'type'    => 'textarea',
			'section' => 'miscellaneous',
			'class'   => 'code'
		);
		
		$this->settings['title_analytics'] = array(
			'section' => 'miscellaneous',
			'title'   => '', // Not used for headings.
			'desc'    => 'Analytics',
			'type'    => 'heading'
		);
		
		$this->settings['misc_analytics'] = array(
			'title'   => __( 'Tracking Code', 'wpblink_flexpost' ),
			'desc'    => __( 'Add your analytics tracking code here (optional).', 'wpblink_flexpost' ),
			'std'     => '',
			'type'    => 'textarea',
			'section' => 'miscellaneous',
			'class'   => 'code'
		);

		
	}
	
	/**
	 * Initialize settings to their default values
	 * 
	 * @since 1.0
	 */
	public function initialize_settings() {
		
		$default_settings = array();
		foreach ( $this->settings as $id => $setting ) {
			if ( $setting['type'] != 'heading' )
				$default_settings[$id] = $setting['std'];
		}
		
		update_option( 'mytheme_options', $default_settings );
		
	}
	
	/**
	* Register settings
	*
	* @since 1.0
	*/
	public function register_settings() {
		
		register_setting( 'mytheme_options', 'mytheme_options', array ( &$this, 'validate_settings' ) );
		
		foreach ( $this->sections as $slug => $title ) {
			if ( $slug == 'about' )
				add_settings_section( $slug, $title, array( &$this, 'display_about_section' ), 'mytheme-options' );
			else
				add_settings_section( $slug, $title, array( &$this, 'display_section' ), 'mytheme-options' );
		}
		
		$this->get_option();
		
		foreach ( $this->settings as $id => $setting ) {
			$setting['id'] = $id;
			$this->create_setting( $setting );
		}
		
	}
	
	/**
	* jQuery Tabs
	*
	* @since 1.0
	*/
	public function scripts() {
		
		wp_print_scripts( 'jquery-ui-tabs' );
		
	}
	
	/**
	* Styling for the theme options page
	*
	* @since 1.0
	*/
	public function styles() {
		
		wp_register_style( 'mytheme-admin', get_template_directory_uri() . '/options/options.css' );
		wp_enqueue_style( 'mytheme-admin' );
		
	}
	
	/**
	* Validate settings
	*
	* @since 1.0
	*/
	public function validate_settings( $input ) {
		
		if ( ! isset( $input['reset_theme'] ) ) {
			$options = get_option( 'mytheme_options' );
			
			foreach ( $this->checkboxes as $id ) {
				if ( isset( $options[$id] ) && ! isset( $input[$id] ) )
					unset( $options[$id] );
			}
			
			return $input;
		}
		return false;
		
	}
	
}

$theme_options = new My_Theme_Options();

function mytheme_option( $option ) {
	$options = get_option( 'mytheme_options' );
	if ( isset( $options[$option] ) )
		return $options[$option];
	else
		return false;
}
?>