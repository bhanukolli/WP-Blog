<?php
/*********************************************************************************************

Adding Translation Option

*********************************************************************************************/
load_theme_textdomain( 'site5framework', get_template_directory().'/languages' );
$locale = get_locale();
$locale_file = get_template_directory()."/languages/$locale.php";
if ( is_readable($locale_file) ) require_once($locale_file);


/*********************************************************************************************

Load site5framework Theme Options

*********************************************************************************************/
require('theme-options.php');


/*********************************************************************************************
/*********************************************************************************************

Add Thumbnail Support

*********************************************************************************************/
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 100, 100, true ); // Normal post thumbnails
add_image_size( 'single-post-thumbnail', 665, 304, TRUE );

/*********************************************************************************************

Add Podt Formats Support

*********************************************************************************************/

add_theme_support( 'post-formats', array('aside','gallery','image','link','quote','video','audio'));


/*********************************************************************************************

Add Custom Background Support

*********************************************************************************************/
$defaults = array(
	'default-color'				=> 'FAF9F5',
	'default-image' 			=> '',
	'wp-head-callback'       	=> '_custom_background_cb',
	'admin-head-callback'    	=> '',
	'admin-preview-callback'	 => ''
);
add_theme_support( 'custom-background', $defaults );


function is_post_type($type){
    global $wp_query;
    if($type == get_post_type($wp_query->post->ID))  { return true; }
    return false;
}

/*********************************************************************************************

Show Homepage Checkbox in WP Menu

*********************************************************************************************/
function home_page_menu_args( $args ) {
$args['show_home'] = true;
return $args;
}
add_filter( 'wp_page_menu_args', 'home_page_menu_args' );

/*********************************************************************************************

Print objects

*********************************************************************************************/

function s5pr($obj) {
	echo "<pre style='clear:both'>";
	print_r($obj);
	echo "</pre>";
}

/*********************************************************************************************

Fix rel validation on category links

*********************************************************************************************/
add_filter( 'the_category', 'add_nofollow_cat' );
function add_nofollow_cat( $text ) { $text = str_replace('rel="category tag"', "", $text); return $text; }

/*********************************************************************************************

Fix video overlay mode on Win

*********************************************************************************************/

function add_youtube_video_wmode_transparent($html) {
  if (strpos($html, "<iframe" ) !== false) {
    $search = array('?rel=0');
    $replace = array('?rel=0&wmode=transparent');
    $html = str_replace($search, $replace, $html);
    return $html;
  } else {
      return $html;
  }
}

add_filter( 'the_content', 'add_youtube_video_wmode_transparent' );

add_filter( 'use_default_gallery_style', '__return_false' );
?>