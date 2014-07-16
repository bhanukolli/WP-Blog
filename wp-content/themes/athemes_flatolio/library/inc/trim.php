<?php 
 /**
  * @package WPBlink_Flatolio
  * @since 1.0
  * @modified  1.0
 */
 
	/**
	 * Trim post title functions
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/

	function trim_title_short() {
		$title = get_the_title();
		$limit = "38";
		$pad=" &#43;";
		if(strlen($title) <= $limit) {
			echo $title;
		} else {
			$title = substr($title, 0, $limit) . $pad;
			echo $title;
		}
	}
	function trim_title_moderate() {
		$title = get_the_title();
		$limit = "46";
		$pad=" ...";
		if(strlen($title) <= $limit) {
			echo $title;
		} else {
			$title = substr($title, 0, $limit) . $pad;
		echo $title;
		}
	}
	function trim_title_long() {
		$title = get_the_title();
		$limit = "56";
		$pad=" ...";
		if(strlen($title) <= $limit) {
			echo $title;
		} else {
			$title = substr($title, 0, $limit) . $pad;
			echo $title;
		}
	}



	/**
	 * Trim post excerpt functions
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/
	
	function wpe_excerptlength_shortest($length) {
		return 8;
	}
	function wpe_excerptlength_shorter($length) {
		return 10;
	}
	function wpe_excerptlength_short($length) {
		return 14;
	}
	function wpe_excerptlength_moderate($length) {
		return 22;
	}
	function wpe_excerptlength_long($length) {
		return 30;
	}
	function wpe_excerptlength_longer($length) {
		return 38;
	}
	function wpe_excerptlength_longest($length) {
		return 32;
	}
	
	function wpe_excerptmore($more) {
		return ' ... ';
	}
	function wpe_excerpt($length_callback='', $more_callback='') {
		global $post;
		if(function_exists($length_callback)){
			add_filter('excerpt_length', $length_callback);
		}
		if(function_exists($more_callback)){
			add_filter('excerpt_more', $more_callback);
		}
		$output = get_the_excerpt();
		$output = apply_filters('wptexturize', $output);
		$output = apply_filters('convert_chars', $output);
		$output = $output;
		echo $output;
	}
	
	
	
	/**
	 * Trim titles from category * page lists
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/
	
	function ft_rtt_remove_title_attribute( $output ){
		$output = preg_replace('/title=\"(.*?)\"/','',$output);
		return $output;
	}
	add_filter('wp_list_categories','ft_rtt_remove_title_attribute');
	add_filter('wp_list_pages','ft_rtt_remove_title_attribute');

?>