<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories 		= array();  
		$of_categories_obj 	= get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp 	= array_unshift($of_categories, "Select a category:");    
	       
		//Access the WordPress Pages via an Array
		$of_pages 			= array();
		$of_pages_obj 		= get_pages('sort_column=post_parent,menu_order');    
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp 		= array_unshift($of_pages, "Select a page:");       
	
		//Testing 
		$of_options_select 	= array("one","two","three","four","five"); 
		$of_options_radio 	= array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		
		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		( 
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
			), 
			"enabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_four"	=> "Block Four",
			),
		);
		
		
		//Background Images Reader
		// bg texture patterns
		$bg_body_path = get_stylesheet_directory(). '/images/bg/'; // change this to where you store your bg images
		$bg_body_url = get_template_directory_uri().'/images/bg/'; // change this to where you store your bg images
		$bg_body = array();
		
		if ( is_dir($bg_body_path) ) {
		    if ($bg_body_dir = opendir($bg_body_path) ) { 
		        while ( ($bg_body_file = readdir($bg_body_dir)) !== false ) {
		            if(stristr($bg_body_file, ".png") !== false || stristr($bg_body_file, ".jpg") !== false) {
		                $bg_body[] = $bg_body_url . $bg_body_file;
		            }
		        }    
		    }
		}


		//Stylesheets Reader
		$alt_stylesheet_path = SKIN_PATH;
		$alt_stylesheets = array();
		
		if ( is_dir($alt_stylesheet_path) ) 
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
		    { 
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }    
		    }
		}
		
		//css bg
		$alt_bg_path = BG_PATH;
		$alt_bg = array();
		
		if ( is_dir($alt_bg_path) ) 
		{
		    if ($alt_bg_dir = opendir($alt_bg_path) ) 
		    { 
		        while ( ($alt_bg_file = readdir($alt_bg_dir)) !== false ) 
		        {
		            if(stristr($alt_bg_file, ".css") !== false)
		            {
		                $alt_bg[] = $alt_bg_file;
		            }
		        }    
		    }
		}

		
		
		//bg 
		$bg_properties = array("repeat","no-repeat"); 
		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr 		= wp_upload_dir();
		$all_uploads_path 	= $uploads_arr['path'];
		$all_uploads 		= get_option('of_uploads');
		$other_entries 		= array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat 		= array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos 			= array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();


// General setting
$of_options[] = array( 	"name" 		=> "General Settings",
						"type" 		=> "heading"
				);
					
$url =  ADMIN_DIR . 'assets/images/';
$of_options[] = array( 	"name" 		=> __('Sidebar position', 'iwebtheme'),
						"desc" 		=> __('Select sidebar alignment. Choose between right or left','iwebtheme'),
						"id" 		=> "sidebar_pos",
						"std" 		=> "right",
						"type" 		=> "images",
						"options" 	=> array(
							'right' 	=> $url . '2cr.png',
							'left' 	=> $url . '2cl.png'
						)
				);
				

$of_options[] = array( 	"name" 		=> __('Custom Favicon','iwebtheme'),
						"desc" 		=> __('Upload a 16px x 16px Png/Gif image that will represent your website\'s favicon','iwebtheme'),
						"id" 		=> "favicon",
						// Use the shortcodes [site_url] or [site_url_secure] for setting default URLs
						"std" 		=> "",
						"mod"		=> "min",
						"type" 		=> "media"
				);

				
$of_options[] = array( 	"name" 		=> __('Tracking Code','iwebtheme'),
						"desc" 		=> __('Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.','iwebtheme'),
						"id" 		=> "google_analytics",
						"std" 		=> "",
						"type" 		=> "textarea"
				);
			
				
// Header
$of_options[] = array( 	"name" 		=> "Header",
						"type" 		=> "heading"
				);
					
$of_options[] = array( 	"name" 		=> "",
						"desc" 		=> "",
						"id" 		=> "introduction",
						"std" 		=> "Top Logo",
						"icon" 		=> true,
						"type" 		=> "info"
				);
				
// logo	image			
$of_options[] = array( 	"name" 		=> "logo text",
						"desc" 		=> __('Enter your logo text','iwebtheme'),
						"id" 		=> "top_textlogo",
						"std" 		=> "",
						"type" 		=> "text"
				); 
				
$of_options[] = array( 	"name" 		=> __('Use image as logo','iwebtheme'),
						"desc" 		=> __('Switch ON or OFF to enable disable logo image, Logo text will disabled when you choose to use image logo','iwebtheme'),
						"id" 		=> "disable_imglogo",
						"std" 		=> 0,
						"folds" => 1,
						"type" 		=> "switch"
				);		
				
// logo	image			
$of_options[] = array( 	"name" 		=> "logo image",
						"desc" 		=> __('Upload your top logo image','iwebtheme'),
						"id" 		=> "top_imglogo",
						"fold" => "disable_imglogo",
						"std" 		=> "",
						"type" 		=> "upload"
				); 

// Homepage
$of_options[] = array( 	"name" 		=> "Homepage",
						"type" 		=> "heading"
				);
$of_options[] = array( 	"name" 		=> "",
						"desc" 		=> "",
						"id" 		=> "introduction",
						"std" 		=> "Homepage",
						"icon" 		=> true,
						"type" 		=> "info"
				);				
				
$of_options[] = array( 	"name" 		=> __('Call action','iwebtheme'),
						"desc" 		=> __('Switch ON or OFF to enable disable call action under homepage slider','iwebtheme'),
						"id" 		=> "disable_cta",
						"std" 		=> 1,
						"folds" => 1,
						"type" 		=> "switch"
				);	
				
$of_options[] = array( 	"name" 		=> "Call action text",
						"desc" 		=> __('Enter your call action text, HTML tag allowed','iwebtheme'),
						"id" 		=> "home_cta",
						"fold" => "disable_cta",
						"std" 		=> "<h2><span>Moderna</span> HTML Business Template</h2>",
						"type" 		=> "textarea"
				); 
				
				
// Footer
$of_options[] = array( 	"name" 		=> "Footer",
						"type" 		=> "heading"
				);

				
				
$of_options[] = array( 	"name" 		=> "",
						"desc" 		=> "",
						"id" 		=> "introduction",
						"std" 		=> "Copyright info",
						"icon" 		=> true,
						"type" 		=> "info"
				);
				
				
$of_options[] = array( 	"name" 		=> __('Footer Text','iwebtheme'),
						"desc" 		=> __('Footer copyright text on bottom right','iwebtheme'),
						"id" 		=> "footer_text",
						"std" 		=> "&copy; Moderna 2014 All right reserved. By Bootstraptaste",
						"type" 		=> "textarea"
				);
				
	$of_options[] = array( 	"name" 		=> "",
						"desc" 		=> "",
						"id" 		=> "introduction",
						"std" 		=> "Footer Social links",
						"icon" 		=> true,
						"type" 		=> "info"
				);
			
$of_options[] = array( 	"name" 		=> __('Social links','iwebtheme'),
						"desc" 		=> __('Switch ON or OFF to enable disable footer social links','iwebtheme'),
						"id" 		=> "sw_social",
						"std" 		=> 1,
						"type" 		=> "switch"
				);		

$of_options[] = array( 	"name" 		=> __('Facebook URL','iwebtheme'),
						"desc" 		=> __('Enter your facebook profile url','iwebtheme'),
						"id" 		=> "so_fb",
						"std" 		=> "https://facebook.com/username",
						"fold"      => "sw_social",
						"type" 		=> "text"
				);	
				
$of_options[] = array( 	"name" 		=> __('Twitter profile URL','iwebtheme'),
						"desc" 		=> __('Enter your twitter profile url','iwebtheme'),
						"id" 		=> "so_twitter",
						"std" 		=> "https://twitter.com/",
						"fold"      => "sw_social",
						"type" 		=> "text"
				);		
				
$of_options[] = array( 	"name" 		=> __('Linkedin URL','iwebtheme'),
						"desc" 		=> __('Enter your linkedin profile url','iwebtheme'),
						"id" 		=> "so_linkedin",
						"std" 		=> "https://linkedin.com/",
						"fold"      => "sw_social",
						"type" 		=> "text"
				);	

$of_options[] = array( 	"name" 		=> __('Pinterest URL','iwebtheme'),
						"desc" 		=> __('Enter URL of your pinterest profile','iwebtheme'),
						"id" 		=> "so_pinterest",
						"std" 		=> "https://pinterest.com/",
						"fold"      => "sw_social",
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> __('Google plus URL','iwebtheme'),
						"desc" 		=> __('Enter URL of your GOogle plus profile','iwebtheme'),
						"id" 		=> "so_googleplus",
						"std" 		=> "https://google.com",
						"fold"      => "sw_social",
						"type" 		=> "text"
				);
	
				
// Styling				
$of_options[] = array( 	"name" 		=> "Styling Options",
						"type" 		=> "heading"
				);
				
$of_options[] = array( 	"name" 		=> "",
						"desc" 		=> "",
						"id" 		=> "introduction",
						"std" 		=> "Theme color skin",
						"icon" 		=> true,
						"type" 		=> "info"
				);
				
$of_options[] = array( 	"name" 		=> "Pre-defined skin color",
						"desc" 		=> "Select your themes alternative color scheme.",
						"id" 		=> "alt_stylesheet",
						"std" 		=> "default.css",
						"type" 		=> "select",
						"options" 	=> $alt_stylesheets
				);
				
$of_options[] = array( 	"name" 		=> "Use your own color",
						"desc" 		=> "Selected color will be used as theme accent color and override selected skin color above! Just click 'clear' button to cancel and use pre-defined skin color above",
						"id" 		=> "own_color",
						"std" 		=> "",
						"type" 		=> "color"
				);

				
				
// Typography				
$of_options[] = array( 	"name" 		=> "Typography",
						"type" 		=> "heading"
				);
				
$of_options[] = array( 	"name" 		=> "",
						"desc" 		=> "",
						"id" 		=> "introduction",
						"std" 		=> "Primary Font <br /><p style=\"font-size: 12px; font-weight: normal; \">Default font: Open Sans --> used in Body, Heading h1-h6</p>",
						"icon" 		=> true,
						"type" 		=> "info"
				);		

$of_options[] = array( 	"name" 		=> __('Use standard font','iwebtheme'),
						"desc" 		=> __('check to activate and change default body font with other standard font','iwebtheme'),
						"id" 		=> "check_defaultfont",
						"std" 		=> 0,
						"folds" 	=> 0,
						"type" 		=> "checkbox"
				);				
				
$of_options[] = array( 	"name" 		=> "Body Content Font",
						"desc" 		=> "Specify the body font family use standard font",
						"id" 		=> "body_standardfont",
						"std" 		=> array('face' => 'Default'),
						"fold" 		=> "check_defaultfont", /* the checkbox hook */
						"type" 		=> "typography"
				);  

				
$of_options[] = array( 	"name" 		=> __('Use google font for Body','iwebtheme'),
						"desc" 		=> __('check to activate and use google font for body font family','iwebtheme'),
						"id" 		=> "check_gfont",
						"std" 		=> 1,
						"folds" 	=> 0,
						"type" 		=> "checkbox"
				);
				
$of_options[] = array( 	"name" => "",
						"desc" => "Default: Open Sans.",
						"id" => "_font",
						"std" => "Open Sans",
						"fold" 		=> "check_gfont", /* the checkbox hook */
						"type" => "select_google_font",
						"options" =>  iweb_listgooglefontoptions() );
				
$of_options[] = array( 	"name" 		=> "",
						"desc" 		=> "",
						"id" 		=> "introduction",
						"std" 		=> "Secondary Font <br /><p style=\"font-size: 12px; font-weight: normal; \">Default font: Noto Serif --> used in blockquote, .pullquote-left, .pullquote-right, pricing box H6</p>",
						"icon" 		=> true,
						"type" 		=> "info"
				);								
					
$of_options[] = array( 	"name" 		=> __('Use standard font','iwebtheme'),
						"desc" 		=> __('check to activate and change default Secondary font with other standard font','iwebtheme'),
						"id" 		=> "check_hdefaultfont",
						"std" 		=> 0,
						"folds" 	=> 0,
						"type" 		=> "checkbox"
				);	
				
$of_options[] = array( 	"name" 		=> "Select from standard font family",
						"desc" 		=> "Specify the body font properties",
						"id" 		=> "heading_fontstyle",
						"std" 		=> array('face' => 'Default'),
						"fold" 		=> "check_hdefaultfont", /* the checkbox hook */
						"type" 		=> "typography"
				);  

				
$of_options[] = array( 	"name" 		=> __('Use google font','iwebtheme'),
						"desc" 		=> __('activate and use google font will override selected standard font family above','iwebtheme'),
						"id" 		=> "check_gfontheading",
						"std" 		=> 1,
						"folds" 	=> 1,
						"type" 		=> "checkbox"
				);

				
$of_options[] = array( 	"name" => "",
						"desc" => "Select google web font",
						"id" => "_headingfont",
						"std" => "Noto Serif",
						"fold" 		=> "check_gfontheading", /* the checkbox hook */
						"type" => "select_google_font",
						"options" =>  iweb_listgooglefontoptions() );

	
// Custom CSS
$of_options[] = array( 	"name" 		=> __('Custom CSS','iwebtheme'),
						"type" 		=> "heading"
				);	
				
$of_options[] = array( 	"name" 		=> "Custom CSS",
						"desc" 		=> "Quickly add some CSS to your theme by adding it to this block.",
						"id" 		=> "custom_css",
						"std" 		=> "",
						"type" 		=> "textarea"
				);
				



//Portfolio
$of_options[] = array( 	"name" 		=> __('Portfolio','iwebtheme'),
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> __('Portfolio page pagination','iwebtheme'),
						"desc" 		=> __('Switch ON or OFF to enable disable pagination on portfolio page','iwebtheme'),
						"id" 		=> "disable_portpagination",
						"std" 		=> 1,
						"folds" => 1,
						"type" 		=> "switch"
				);		

$of_options[] = array( "name" => __('Portfolio item count per page when paginated', 'iwebtheme'),
					"desc" => __('Enter how many portfolio item on each page when pagination enabled', 'iwebtheme'),
					"id" => "port_count",
					"std" => "8",
					"fold" => "disable_portpagination",
					"type" => "text");				

				
//Contact Settings
$of_options[] = array( 	"name" 		=> "Contact Settings",
						"type" 		=> "heading"
				);
				
$of_options[] = array( "name" => __('Enable or Disable map on contact page', 'iwebtheme'),
					"desc" => __('Check to enable map on contact page', 'iwebtheme'),
					"id" => "map_enable",
					"std" => 1,
          			"folds" => 1,
					"type" => "checkbox"); 

									
				$of_options[] = array( "name" => "",
									"desc" => __('Enter your address', 'iwebtheme'),
									"id" => "map_address",
									"std" => "Level 13, 2 Elizabeth St, Melbourne Victoria 3000 Australia",
									"fold" => "map_enable", /* the checkbox hook */
									"type" => "textarea");
				
$of_options[] = array( 	"name" 		=> "Email address",
						"desc" 		=> "Enter your working email address",
						"id" 		=> "contact_email",
						"std" 		=> "name@email.com",
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> "Success message",
						"desc" 		=> "This is a sample hidden option 2",
						"id" 		=> "contact_success",
						"std" 		=> "Thanks your email has been sent successfully",
						"type" 		=> "text"
				);		

		

// 404
$of_options[] = array( 	"name" 		=> "Error 404 Page",
						"type" 		=> "heading"
				);
					
$of_options[] = array( 	"name" 		=> "",
						"desc" 		=> "",
						"id" 		=> "introduction",
						"std" 		=> "404 Error Page",
						"icon" 		=> true,
						"type" 		=> "info"
				);	
$of_options[] = array( 	"name" 		=> "Page title",
						"desc" 		=> "Page title for 404 error page",
						"id" 		=> "error_title",
						"std" 		=> "OUPS! NOT FOUND!",
						"type" 		=> "text"
				);				

$of_options[] = array( 	"name" 		=> "Page content",
						"desc" 		=> "Content for 404 error page, support HTML tag as shown in example default value",
						"id" 		=> "error_content",
						"std" 		=> "You can view our <a href='#'>portfolio</a>, or read the <a href='#'>blog</a>",
						"type" 		=> "textarea"
				);					
				

				
// Backup Options
$of_options[] = array( 	"name" 		=> "Backup Options",
						"type" 		=> "heading",
						"icon"		=> ADMIN_IMAGES . "icon-slider.png"
				);
				
$of_options[] = array( 	"name" 		=> "Backup and Restore Options",
						"id" 		=> "of_backup",
						"std" 		=> "",
						"type" 		=> "backup",
						"desc" 		=> 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
				);
				
$of_options[] = array( 	"name" 		=> "Transfer Theme Options Data",
						"id" 		=> "of_transfer",
						"std" 		=> "",
						"type" 		=> "transfer",
						"desc" 		=> 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".',
				);
				
	}//End function: of_options()
}//End chack if function exists: of_options()
?>
