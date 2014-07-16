<?php 
 /**
  * @package WPBlink_Flatolio
  * @since 1.0
  * @modified  1.0
 */
 
	/**
	 * Create theme shortcodes
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/
	
	function shortcode_red( $atts, $content = null ) {
		return '<div class="shortcode_red">' . $content . '</div>';
	}
	add_shortcode('red', 'shortcode_red');	
	
	function shortcode_blue( $atts, $content = null ) {
		return '<div class="shortcode_blue">' . $content . '</div>';
	}
	add_shortcode('blue', 'shortcode_blue');
	
	function shortcode_green( $atts, $content = null ) {
		return '<div class="shortcode_green">' . $content . '</div>';
	}
	add_shortcode('green', 'shortcode_green');
	
	function shortcode_orange( $atts, $content = null ) {
		return '<div class="shortcode_orange">' . $content . '</div>';
	}
	add_shortcode('orange', 'shortcode_orange');
	
	function shortcode_purple( $atts, $content = null ) {
		return '<div class="shortcode_purple">' . $content . '</div>';
	}
	add_shortcode('purple', 'shortcode_purple');		

	function leftfloat_shortcode( $atts, $content = null ) {
		return '<div class="leftfloat">' . $content . '</div>';
	}
	add_shortcode('leftfloat', 'leftfloat_shortcode');
	
	function rightfloat_shortcode( $atts, $content = null ) {
		return '<div class="rightfloat">' . $content . '</div>';
	}
	add_shortcode('rightfloat', 'rightfloat_shortcode');

?>