<?php
/*********************************************************************************************

Load wp_head function in header.php / Enqueue Files In Header

*********************************************************************************************/
function site5framework_header_init() {
    if (!is_admin()) {

    wp_enqueue_script( 'jquery' );
	wp_enqueue_script('modernizr', get_template_directory_uri() .'/js/vendor/modernizr-2.6.1-respond-1.1.0.min.js', false, '2.6.1', false);
	wp_enqueue_script('custom', get_template_directory_uri().'/js/custom.js', false, '1.0', true);

	//registered scripts
	wp_enqueue_style( 'prettyphoto-css', get_template_directory_uri() . '/lib/prettyphoto/css/prettyPhoto.css', true, '1.0', 'all' );
	wp_enqueue_script( 'prettyphoto-js', get_template_directory_uri().'/lib/prettyphoto/jquery.prettyPhoto.js', array('jquery'), '1.0', true);
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css', true, '1.0', 'all' );
	wp_enqueue_script( 'fitvids-js', get_template_directory_uri().'/lib/fitvids/jquery.fitvids.js', array('jquery'), '1.0', true);
	wp_enqueue_script( 'jplayer.min', get_template_directory_uri().'/lib/jplayer/jquery.jplayer.min.js', array('jquery'), '1.0', true);
	wp_enqueue_style( 'jplayer-js', get_template_directory_uri() . '/lib/jplayer/jplayer.css', true, '1.0', 'all' );

	}
}
add_action('init', 'site5framework_header_init');


/*********************************************************************************************

admin hooks / portfolio media uploader

*********************************************************************************************/
function site5framework_mediauploader_init() {
    if (is_admin()) {
    wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');
	wp_enqueue_script('site5mediauploader', get_template_directory_uri().'/admin/js/site5mediauploader.js', false, '2.1', true);
}
}
add_action('init', 'site5framework_mediauploader_init');


/*********************************************************************************************

Load custom favicon in header.php

*********************************************************************************************/
function site5framework_custom_shortcut_favicon() {
	if (of_get_option('favicon') != '') {
    echo '<link rel="shortcut icon" href="'. of_get_option('favicon') .'" type="image/ico" />'."\n";
	}
	else { ?><link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() ?>/favicon.ico" type="image/ico" />
	<?php }
}
add_action('wp_head', 'site5framework_custom_shortcut_favicon');


/*********************************************************************************************

Contact Form JS

*********************************************************************************************/
function site5framework_contactform_init() {
	if (is_page_template('page-temp-contact.php') && !is_admin()) {
    wp_enqueue_script('contactform', get_template_directory_uri().'/lib/contactform/contactform.js', false, '1.0', true);
    }
}
add_action('template_redirect', 'site5framework_contactform_init');

/*********************************************************************************************

Load stats in footer.php

*********************************************************************************************/
function site5framework_analytics(){
	$output = of_get_option('stats');
	if ( $output <> "" )
	echo stripslashes($output) . "\n";
}
add_action('wp_footer','site5framework_analytics');
?>