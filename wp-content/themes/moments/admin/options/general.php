<?php
$options[] = array("name" => "General",
			 "sicon" => "advancedsettings.png",
                   "type" => "heading");


$options[] = array("name" => "Logo Image",
                  "desc" => "You can use your own logo. Click to 'Upload' button and upload your own logo.",
                  "id" => SN."logo",
                  "std" => "$blogpath/img/logo.png",
                  "type" => "upload");

$options[] = array( "name" => "Use only image as logo",
                  "desc" => "By checking this the theme will use your uploaded image only as logo, as it is.",
                  "id" => SN."image_logo",
                  "std" => "1",
                  "type" => "checkbox");

$options[] = array("name" => "Logo Text",
                  "desc" => "This is used for the text part of the logo as you can see on demo.",
                  "id" => SN."logo_text",
                  "std" => "Moments",
                  "type" => "text");

$options[] = array( "name" => "Custom Favicon",
                  "desc" => "You can use your own custom favicon. Click to 'Upload Image' button and upload your own favicon.",
                  "id" => SN."favicon",
                  "std" => "$blogpath/favicon.ico",
                  "type" => "upload");

?>