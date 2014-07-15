<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = 'iweb_';

global $meta_boxes;

$meta_boxes = array();


/* =========================================*/
// Flexslider meta
/* =========================================*/

$meta_boxes[] = array(
	'id' => 'pageoptions',
	'title' => 'Section options',
	'pages' => array( 'flexslider' ),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(

		array(
				'name'		=> 'Slider title',
				'id'		=> $prefix . "flexslider_title",
				'type'		=> 'text',
				'std'		=> 'Modern Design',
				'desc'		=> 'Enter your Flexslider title',
		),
		array(
				'name'		=> 'Slider caption',
				'id'		=> $prefix . "flexslider_caption",
				'type'		=> 'textarea',
				'std'		=> 'Duis fermentum auctor ligula ac malesuada. Mauris et metus odio, in pulvinar urna',
				'desc'		=> 'Enter your Flexslider caption',
		),
		array(
				'name'		=> 'Slider button text',
				'id'		=> $prefix . "flexslider_btntext",
				'type'		=> 'text',
				'std'		=> 'LEARN MORE',
				'desc'		=> 'Enter your Flexslider button text',
		),
		array(
				'name'		=> 'Slider button link URL',
				'id'		=> $prefix . "flexslider_btnurl",
				'type'		=> 'text',
				'std'		=> 'http://iweb-studio.com',
				'desc'		=> 'Enter your Flexslider button link URL',
		),
		// flexslider image
		array(
			'name' => 'Flexslider image',
			'id'   => "{$prefix}flexslider_img",
			'type' => 'plupload_image',
			'desc' => 'Select or upload your image and set as slider image',
			'max_file_uploads' => 1,
		),
		
	)
);

// ================================== end flexslider meta box



/* =========================================*/
// Portfolio meta
/* =========================================*/
$meta_boxes[] = array(
	'id' => 'portfolio_info',
	'title' => 'Portfolio detail options',
	'pages' => array( 'portfolio'),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		array(
				'name'		=> 'Project overview',
				'id'		=> $prefix . "project_overview",
				'type'		=> 'textarea',
				'std'		=> 'Vestibulum pulvinar adipiscing turpis vitae at ultrices. Suspendisse eu lectus dui, vitae lob in ortis lorem convallis semper felis. Fusce ravida nibh et ante accusan molestie.',
				'desc'		=> 'Short paragraph of project overview',
		),

	)
);


// ============================================= *//



/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function YOUR_PREFIX_register_meta_boxes()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $meta_boxes;
	foreach ( $meta_boxes as $meta_box )
	{
		new RW_Meta_Box( $meta_box );
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'YOUR_PREFIX_register_meta_boxes' );