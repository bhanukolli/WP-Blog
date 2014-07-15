<?php
/**
 * @package WordPress
 * @subpackage Moderna Theme
*/

// Set the content width
if ( ! isset( $content_width )) 
    $content_width = 960;
	
/*============================================
Includes 
=============================================*/
require_once('functions/wp_bootstrap_navwalker.php');
require_once('functions/aq_resizer.php');
require_once('functions/theme-functions.php');
require_once('functions/comments.php');
require_once('functions/moderna-meta.php');
require_once('functions/googlefont.php');
// Admin 
require_once ('admin/index.php');

/* Global admin options */
if ( ! function_exists('iwebtheme_smof_data') ) {
	function iwebtheme_smof_data($id, $fallback = false) {
		global $smof_data;
		if ( $fallback == false ) $fallback = '';
		$output = ( isset($smof_data[$id]) && $smof_data[$id] !== '' ) ? $smof_data[$id] : $fallback;
		return $output;
	}
}
global $post;

function iwebtheme_moderna_theme_setup() {
/* Theme supports */
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-formats', array('gallery', 'link', 'quote', 'audio', 'video')); 
/* --- post image functionality --- */
if ( function_exists( 'add_theme_support' ))
	add_theme_support( 'post-thumbnails' );

if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'full-size',  9999, 9999, false );
	add_image_size( 'small-thumb',  54, 54, true );
}
/* --- Localization --- */
load_theme_textdomain( 'iwebtheme', get_template_directory().'/lang' );

/* --- action --- */
add_action('wp_enqueue_scripts', 'iwebtheme_enqueue_css');
add_action('wp_head','iwebtheme_build_custom_css'); 
add_action('wp_enqueue_scripts', 'iwebtheme_enqueue_js');
add_action( 'tgmpa_register', 'iwebtheme_theme_register_required_plugins' );
add_action('wp_footer','iwebtheme_custom_js',100);

/* --- filters --- */
add_filter('widget_text', 'do_shortcode');
}
add_action( 'after_setup_theme', 'iwebtheme_moderna_theme_setup' );

/*============================================
 css
=============================================*/
function iwebtheme_enqueue_css() {	
	//load css files
	wp_enqueue_style('bootstrap', get_template_directory_uri(). '/css/bootstrap.min.css', 'style');
	wp_enqueue_style('fancybox', get_template_directory_uri() . '/css/fancybox/jquery.fancybox.css', 'style');
	wp_enqueue_style('flexslider', get_template_directory_uri() . '/css/flexslider.css', 'style');
	wp_enqueue_style('style', get_template_directory_uri() . '/style.css', 'style');

	$premadeskin = iwebtheme_smof_data( 'alt_stylesheet' );
	if(empty($premadeskin)) {
			wp_enqueue_style('skin', get_template_directory_uri() . '/skins/default.css', 'color');
		}	
		if(!empty($premadeskin)) {
			wp_enqueue_style('skin', get_template_directory_uri() . '/skins/'.$premadeskin, 'color');
		}	
}

/*============================================
Custom css
=============================================*/
function iwebtheme_build_custom_css(){
		$iwebtheme_buildcss = '';
		$iwebtheme_buildcss .= iwebtheme_setting_css();
		$iwebtheme_buildcss .= iwebtheme_option_css();

		if(!empty($iwebtheme_buildcss)){
			$iwebtheme_wrap_buildcss ='';
			$iwebtheme_wrap_buildcss .="<style type=\"text/css\">\n";
			$iwebtheme_wrap_buildcss .= $iwebtheme_buildcss;
			$iwebtheme_wrap_buildcss .="</style>\n";
			echo $iwebtheme_wrap_buildcss;
		}
}

// get custom css from theme options
function iwebtheme_option_css(){
	$iwebtheme_custom_css = iwebtheme_smof_data( 'custom_css' );
	
	
		if(iwebtheme_smof_data( 'custom_css' ) != '') {
			$iwebtheme_custom_css = iwebtheme_smof_data( 'custom_css' );
			return "\n".$iwebtheme_custom_css."\n";
		}
}

function iwebtheme_setting_css(){

	//custom color
	$setting_css = '';
	$custom_color = iwebtheme_smof_data('own_color');
		if ($custom_color != '') {		
			$setting_css .= ".custom-carousel-nav.right:hover, .custom-carousel-nav.left:hover, .dropdown-menu li:hover,.dropdown-menu li a:hover,
.dropdown-menu li > a:focus,.dropdown-submenu:hover > a, .dropdown-menu .active > a,.dropdown-menu .active > a:hover,.pagination ul > .active > a:hover,
.pagination ul > .active > a,.pagination ul > .active > span,.flex-control-nav li a:hover, .flex-control-nav li a.active,.breadcrumb,.modal.styled .modal-header,.icon-square:hover,
.icon-rounded:hover,.icon-circled:hover,.fancybox-close:hover,.fancybox-nav:hover span,.nivo-directionNav a:hover,[class^=\"icon-\"].active,
[class*=\"icon-\"].active  {";
			$setting_css .= "background-color:".$custom_color." !important;";
			$setting_css .= "}";
			$setting_css .= ".navbar-brand span,header .nav li.current-menu-ancestor.current-menu-parent a,header .nav li a:hover,
header .nav li a:focus,header .nav li.active a,header .nav li.active a:hover,header .nav li a.dropdown-toggle:hover,header .nav li a.dropdown-toggle:focus,
header .nav li.active ul.dropdown-menu li a:hover,header .nav li.active ul.dropdown-menu li.active a,.navbar-default .navbar-nav > .active > a,
.navbar-default .navbar-nav > .active > a:hover,.navbar-default .navbar-nav > .active > a:focus,.navbar-default .navbar-nav > .open > a,
.navbar-default .navbar-nav > .open > a:hover,.navbar-default .navbar-nav > .open > a:focus,.dropdown-menu > .active > a,
.dropdown-menu > .active > a:hover,.dropdown-menu > .active > a:focus,#sendmessage,.cta-text h2 span,.post-meta .comments a:hover,.widget ul li a:hover,.recent-post .text h5 a:hover,form#contactform span.error,a, a:hover,a:focus,a:active, footer a.text-link:hover, strike, .post-meta span a:hover, footer a.text-link, 
ul.meta-post li a:hover, ul.cat li a:hover, ul.recent li h6 a:hover, ul.portfolio-categ li.active a, ul.portfolio-categ li.active a:hover, ul.portfolio-categ li a:hover,ul.related-post li h4 a:hover, span.highlight,article .post-heading h3 a:hover,
.navbar .nav > .active > a,.navbar .nav > .active > a:hover,.navbar .nav > li > a:hover,.navbar .nav > li > a:focus,.navbar .nav > .active > a:focus, .validation  {";
			$setting_css .= "color: ".$custom_color.";";
			$setting_css .= "}";
			$setting_css .= "footer,#sub-footer,.da-dots span,.da-slide .da-link:hover,.pricing-box.special .pricing-offer,#pagination a:hover,.item-thumbs .hover-wrap .overlay-img-thumb,.pricing-box-alt.special .pricing-heading,.widget ul.tags li a:hover,.tagcloud a:hover,.btn-theme,.btn-dark:hover,.btn-dark:focus,.btn-dark:active,.box-bottom  {";
			$setting_css .= "background: ".$custom_color.";";
			$setting_css .= "}";
			$setting_css .= "#sequence-theme .status {";
			$setting_css .= "background: url(".get_template_directory_uri()."/images/status-bar-dark.png) -940px 0 repeat-y;";
			$setting_css .= "}";
			$setting_css .= ".pagination ul > li.active > a,
.pagination ul > li.active > span, a.thumbnail:hover, input[type=\"text\"].search-form:focus {";
			$setting_css .= "border: 1px solid ".$custom_color." !important;";
			$setting_css .= "}";
			$setting_css .= "textarea:focus,
input[type=\"text\"]:focus,input[type=\"password\"]:focus,input[type=\"datetime\"]:focus,input[type=\"datetime-local\"]:focus,
input[type=\"date\"]:focus,input[type=\"month\"]:focus,input[type=\"time\"]:focus,input[type=\"week\"]:focus,input[type=\"number\"]:focus,
input[type=\"email\"]:focus,input[type=\"url\"]:focus,input[type=\"search\"]:focus,input[type=\"tel\"]:focus,input[type=\"color\"]:focus,
.uneditable-input:focus,input:focus  {";
			$setting_css .= "border-color: ".$custom_color.";";
			$setting_css .= "}";
			$setting_css .= ".pullquote-left {";
			$setting_css .= "border-left: 5px solid ".$custom_color.";";
			$setting_css .= "}";
			$setting_css .= ".pullquote-right {";
			$setting_css .= "border-right: 5px solid ".$custom_color.";";
			$setting_css .= "}";
			$setting_css .= "ul.clients li:hover {";
			$setting_css .= "border: 4px solid ".$custom_color.";";
			$setting_css .= "}";
			$setting_css .= ".post-meta {";
			$setting_css .= "border-top: 4px solid ".$custom_color.";";
			$setting_css .= "}";
			$setting_css .= "::selection {";
			$setting_css .= "background-color:".$custom_color." !important;";
			$setting_css .= "}";
			$setting_css .= "::-moz-selection {";
			$setting_css .= "background-color:".$custom_color." !important;";
			$setting_css .= "}";
			$setting_css .= ".latest-post-sidebar img:hover,ul#flickrfeed li a:hover,.flex-caption h3,.latest-post-sidebar img:hover,ul#flickrfeed li a:hover {";
			$setting_css .= "border-color:".$custom_color." !important;";
			$setting_css .= "}";
			$setting_css .= ".btn-dark:hover,.btn-dark:focus,.btn-dark:active,.btn-theme {";
			$setting_css .= "border: 1px solid ".$custom_color.";";
			$setting_css .= "}";
		}

		// typography
		$check_defaultfont = '';
		$check_defaultfont = iwebtheme_smof_data('check_defaultfont');
		$body_standardfont = '';
		$body_standardfont = iwebtheme_smof_data('body_standardfont');
		$check_gfont = '';
		$check_gfont = iwebtheme_smof_data('check_gfont');
		$body_gfont = '';
		$body_gfont = iwebtheme_smof_data('_font');
		$check_fontprop = '';
		$check_fontprop = iwebtheme_smof_data('check_fontprop');
		$body_fontstyle = iwebtheme_smof_data('body_fontstyle');
		$check_hdefaultfont = '';
		$check_hdefaultfont = iwebtheme_smof_data('check_hdefaultfont');
		$heading_fontstyle = iwebtheme_smof_data('heading_fontstyle');
		$check_gfontheading = '';
		$check_gfontheading = iwebtheme_smof_data('check_gfontheading');
		$_headingfont = '';
		$_headingfont = iwebtheme_smof_data('_headingfont');
		
		
		//body
		if (($check_defaultfont != 0) && ($body_standardfont['face'] != 'default') ) {	
			$setting_css .= "body,h1,h2, h3, h4, h5, h6 {";
			$setting_css .= "font-family:".$body_standardfont['face'].";";
			$setting_css .= "}";
		}
		if (($check_gfont != 0) && ($body_gfont != 'Open Sans') ) {	
		echo "<link href='http://fonts.googleapis.com/css?family=$body_gfont' rel='stylesheet' type='text/css'>";
			$setting_css .= "body,h1,h2, h3, h4, h5, h6 {";
			$setting_css .= "font-family:".$body_gfont.";";
			$setting_css .= "}";
		}	
		
		
		//secondary
		if (($check_hdefaultfont != 0) && ($heading_fontstyle['face'] != 'Noto Serif') ) {	
			$setting_css .= ".pricing-box-alt .pricing-terms  h6,.post-quote blockquote,blockquote,.pullquote-left,.pullquote-right{";
			$setting_css .= "font-family:".$heading_fontstyle['face'].";";
			$setting_css .= "}";
		}		
		if (($check_gfontheading != 0) && ($_headingfont != '') ) {	
		echo "<link href='http://fonts.googleapis.com/css?family=$_headingfont' rel='stylesheet' type='text/css'>";
			$setting_css .= ".pricing-box-alt .pricing-terms  h6,.post-quote blockquote,blockquote,.pullquote-left,.pullquote-right{";
			$setting_css .= "font-family:".$_headingfont.";";
			$setting_css .= "}";
		}		
		
	return $setting_css;
}

/*============================================
Enqueue js
=============================================*/
function iwebtheme_enqueue_js() {
	
	//load js files
	wp_enqueue_script('jquery', get_template_directory_uri() . '/js/jquery.js', 'jquery');
	wp_enqueue_script('easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js','jquery', '1.3.0', TRUE);
	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js','jquery', '1.4.8', TRUE);
	wp_enqueue_script('fancybox', get_template_directory_uri() . '/js/jquery.fancybox.pack.js','jquery', '1.9.2', TRUE);

	wp_enqueue_script('fancybox-media', get_template_directory_uri() . '/js/jquery.fancybox-media.js','jquery', '2.2.0', TRUE);
	wp_enqueue_script('prettify', get_template_directory_uri() . '/js/google-code-prettify/prettify.js','jquery', '1.4.8', TRUE);
	wp_enqueue_script('quicksand', get_template_directory_uri() . '/js/portfolio/jquery.quicksand.js','jquery', '1.9.2', TRUE);
	wp_enqueue_script('portfolio', get_template_directory_uri() . '/js/portfolio/setting.js','jquery', '1.9.2', TRUE);
	wp_enqueue_script('flexslider', get_template_directory_uri() . '/js/jquery.flexslider.js','jquery', '1.9.2', TRUE);
	wp_enqueue_script('animate', get_template_directory_uri() . '/js/animate.js','jquery', '1.9.2', TRUE);

	if(is_page_template('templates/page-contact.php')) {
		wp_enqueue_script('maps','http://maps.google.com/maps/api/js?sensor=true','jquery', '1.3', TRUE);
		wp_enqueue_script('gmap', get_template_directory_uri() . '/js/jquery.gmap.min.js','jquery', '2.1.2', TRUE);
	}
	
	//load comment reply js
	if(is_single() || is_page()) {
		wp_enqueue_script('comment-reply');
	}
	wp_enqueue_script('verify', get_template_directory_uri() . '/js/verify.js','jquery', '1.0', TRUE);
	
	wp_enqueue_script('custom', get_template_directory_uri() . '/js/custom.js','jquery', '1.0.0', TRUE);

}

/*============================================
Custom js
=============================================*/

function iwebtheme_custom_js(){

	$script_out = '';
	$script_out .= '<script type="text/javascript">'."\n";
	$script_out .= 'jQuery(document).ready(function($){'."\n";
	if(is_page_template('templates/page-contact.php')) {
	$script_out .= iwebtheme_googlemap();
	}
	$script_out .= '});'."\n";
	$script_out .= "\n".'</script>'."\n\n\n";
	echo $script_out;
}

function iwebtheme_googlemap(){
	$address = iwebtheme_smof_data('map_address');
	$script = '';
	$script .= "jQuery('#googlemaps').gMap({"."\n";
	$script .= "maptype: 'ROADMAP',"."\n";
    $script .= 'scrollwheel: false,'."\n";
    $script .= "zoom: 16,"."\n";
    $script .= 'markers: ['."\n\n";
	$script .= "{"."\n";	
	$script .= "address: '".$address."',"."\n\n";
    $script .= "html: '',"."\n";
    $script .= "popup: false,"."\n";        		
    $script .= "}"."\n";
    $script .= "],"."\n";
	$script .= "});"."\n";
	return $script;
}

/*============================================
Register menu navigation
=============================================*/
register_nav_menus(
	array(
	'main'=>__('Main Menu'),
	'bottom'=>__('Footer Menu'),
	)
);




/*============================================
Theme widgets
=============================================*/
$widgets = array(
				'includes/widget-contact-info.php',
				'includes/widget-flickr.php',
				'includes/widget-default.php',
				);

// Allow child themes/plugins to add widgets to be loaded.
$widgets = apply_filters( 'of_widgets', $widgets );
				
foreach ( $widgets as $w ) {
	locate_template( $w, true );
}
	


/*============================================
Register sidebars
=============================================*/

register_sidebar(array(
		'name' => 'Primary Sidebar',
		'id'   => 'primary-sidebar',
		'description'   => 'These are widgets for primary sidebar.',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widgetheading">',
		'after_title'   => '</h5>'
));	


if ( function_exists('register_sidebar'))
	register_sidebar(array(
		'name' => 'Footer Column 1',
		'id' => 'footer-1',
		'description' => 'Widgets in this area will be shown in the top footer column 1.',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widgetheading">',
		'after_title'   => '</h5>'
));
if ( function_exists('register_sidebar'))
	register_sidebar(array(
		'name' => 'Footer Column 2',
		'id' => 'footer-2',
		'description' => 'Widgets in this area will be shown in the top footer column 2.',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widgetheading">',
		'after_title'   => '</h5>'
));
if ( function_exists('register_sidebar'))
	register_sidebar(array(
		'name' => 'Footer Column 3',
		'id' => 'footer-3',
		'description' => 'Widgets in this area will be shown in the top footer column 3.',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widgetheading">',
		'after_title'   => '</h5>'
));
if ( function_exists('register_sidebar'))
	register_sidebar(array(
		'name' => 'Footer Column 4',
		'id' => 'footer-4',
		'description' => 'Widgets in this area will be shown in the top footer column 4',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widgetheading">',
		'after_title'   => '</h5>'
));



// TGM plugin
require_once('functions/class-tgm-plugin-activation.php');



function iwebtheme_theme_register_required_plugins() {
	$plugins = array(

			array(
				'name'     				=> 'iWebtheme moderna Shortcodes', // The plugin name
				'slug'     				=> 'iwebtheme-moderna-shortcodes', // The plugin slug (typically the folder name)
				'source'   				=> get_template_directory_uri() . '/plugins/iwebtheme-moderna-shortcodes.zip', // The plugin source
				'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'     				=> 'Meta Box', // The plugin name
				'slug'     				=> 'meta-box', // The plugin slug (typically the folder name)
				'source'   				=> get_template_directory_uri() . '/plugins/meta-box.zip', // The plugin source
				'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'     				=> 'iWebtheme Moderna CPT', // The plugin name
				'slug'     				=> 'iwebtheme-moderna-cpt', // The plugin slug (typically the folder name)
				'source'   				=> get_template_directory_uri() . '/plugins/iwebtheme-moderna-cpt.zip', // The plugin source
				'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'     				=> 'Font Awesome timymce', // The plugin name
				'slug'     				=> 'incredible-font-awesome', // The plugin slug (typically the folder name)
				'source'   				=> get_template_directory_uri() . '/plugins/incredible-font-awesome.zip', // The plugin source
				'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'     				=> 'Bootstrap 3 Shortcodes', // The plugin name
				'slug'     				=> 'bootstrap-3-shortcodes', // The plugin slug (typically the folder name)
				'source'   				=> get_template_directory_uri() . '/plugins/bootstrap-3-shortcodes.zip', // The plugin source
				'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			),
	);

	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'iwebtheme';

	$config = array(
		'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
			'strings'      		=> array(
				'page_title'                       			=> __( 'Install Required Plugins', $theme_text_domain ),
				'menu_title'                       			=> __( 'Install Plugins', $theme_text_domain ),
				'installing'                       			=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
				'oops'                             			=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
				'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
				'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
				'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
				'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
				'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
				'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
				'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
				'return'                           			=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
				'plugin_activated'                 			=> __( 'Plugin activated successfully.', $theme_text_domain ),
				'complete' 									=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
				'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
			)
	);

	tgmpa( $plugins, $config );
}
?>