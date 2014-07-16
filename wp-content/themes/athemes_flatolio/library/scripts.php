<?php 
 /**
  * @package WPBlink_Flatolio
  * @since 1.0
  * @modified  1.0
 */
 


	/**
	 * Load javascript files as needed
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/
	
	function theme_scripts_method() {
		
		$respond= get_template_directory_uri() . "/js/respond.src.js";
		wp_deregister_script( 'respond' );
		wp_register_script( 'respond', $respond);
		wp_enqueue_script( 'respond');
		
		$tooltip= get_template_directory_uri() . "/js/tooltip.js";
		wp_deregister_script( 'tooltip' );
		wp_register_script( 'tooltip', $tooltip);
		wp_enqueue_script( 'tooltip');
		
		$expand= get_template_directory_uri() . "/js/expand.js";
		wp_deregister_script( 'expand' );
		wp_register_script( 'expand', $expand);
		wp_enqueue_script( 'expand');
		
		$backtop= get_template_directory_uri() . "/js/top.js";
		wp_deregister_script( 'backtop' );
		wp_register_script( 'backtop', $backtop);
		wp_enqueue_script( 'backtop');	
				
		$logo= get_template_directory_uri() . "/js/logo.js";
		wp_deregister_script( 'logo' );
		wp_register_script( 'logo', $logo);
		wp_enqueue_script( 'logo');
		
		$jflow= get_template_directory_uri() . "/js/jflow.plus.js";
		wp_deregister_script( 'jflow' );
		wp_register_script( 'jflow', $jflow);
		wp_enqueue_script( 'jflow');
	
		$jquerytools= get_template_directory_uri() . "/js/jquery.tools.min.js";
		wp_deregister_script( 'jquerytools' );
		wp_register_script( 'jquerytools', $jquerytools);
		wp_enqueue_script( 'jquerytools');
		
		$jqueryui= get_template_directory_uri() . "/js/jquery-ui-1.10.2.js";
		wp_deregister_script( 'jqueryui' );
		wp_register_script( 'jqueryui', $jqueryui);
		wp_enqueue_script( 'jqueryui');	
		
		$slider= get_template_directory_uri() . "/js/slider.js";
		wp_deregister_script( 'slider' );
		wp_register_script( 'slider', $slider);
		wp_enqueue_script( 'slider');
		
		$selectivizr= get_template_directory_uri() . "/js/selectivizr-min.js";
		wp_deregister_script( 'selectivizr' );
		wp_register_script( 'selectivizr', $selectivizr);
		wp_enqueue_script( 'selectivizr');
		
		$modernizr= get_template_directory_uri() . "/js/modernizr-2.5.3-min.js";
		wp_deregister_script( 'modernizr' );
		wp_register_script( 'modernizr', $modernizr);
		wp_enqueue_script( 'modernizr');
		
	
	}
	add_action('wp_enqueue_scripts', 'theme_scripts_method');
	



	/**
	 * Load logo uploader javascript files (only when needed)
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/
		
	function customlogo_options_enqueue_scripts() {

	wp_register_script( 'customlogo-upload', get_template_directory_uri() .'/js/logo.js', array('jquery','media-upload','thickbox') );	

		if ( 'appearance_page_customlogo-settings' == get_current_screen() -> id ) {
			wp_enqueue_script('jquery');
			wp_enqueue_script('thickbox');
			wp_enqueue_style('thickbox');
			wp_enqueue_script('media-upload');
			wp_enqueue_script('customlogo-upload');
		}
	}
	add_action('admin_enqueue_scripts', 'customlogo_options_enqueue_scripts');
	
	
	
	
	/**
	 * Load colorpicker javascript files (only when needed)
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/
		
	function colorpicker_options_enqueue_scripts() {


		if ( 'appearance_page_mytheme-options' == get_current_screen() -> id ) {
			$jscolor= get_template_directory_uri() . "/js/jscolor/jscolor.js";
			wp_deregister_script( 'jscolor' );
			wp_register_script( 'jscolor', $jscolor);
			wp_enqueue_script( 'jscolor');
		}
	}
	add_action('admin_enqueue_scripts', 'colorpicker_options_enqueue_scripts');

?>