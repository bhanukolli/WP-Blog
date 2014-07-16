<?php

require_once("meta-box-class.php");

if (is_admin()){

	//All meta boxes prefix, inherited from theme Shortname
	$prefix = SN;

	$configDefaults = array(
		'pages' => array('post'),      		 // post types, accept custom post types as well, default is array('post'); optional
		'context' => 'normal',            		// where the meta box appear: normal (default), advanced, side; optional
		'priority' => 'high',            		// order of meta box: high (default), low; optional
		'fields' => array(),            		// list of meta fields (can be added by field arrays)
		'local_images' => true,          		// Use local or hosted images (meta box images for add/remove)
		'use_with_theme' => true          		//change path if used with theme set to true, false for a plugin or anything else for a custom path(default false)
		);

	//Post Formats Meta Boxes

	//AUDIO
	$post_audio_meta =  new AT_Meta_Box(array_merge($configDefaults, array('id' => 'post_format_audio', 'title' => 'Audio')));
	$post_audio_meta->addText ($prefix.'audio_post_mp3',array('name'=> 'MP3 File URL ','desc' => 'Enter the URL to the .mp3 audio file url.'));
	$post_audio_meta->addText ($prefix.'audio_post_ogg',array('name'=> 'OGG File URL ','desc' => 'Enter the URL to the .oga, .ogg audio file url'));
	$post_audio_meta->addImage($prefix.'audio_post_poster', array('name'=> 'Audio Poster Image ','desc' => 'The preview image for this audio track. Image width should be min 500px.'));
	$post_audio_meta->Finish();

	

}