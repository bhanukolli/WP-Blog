<?php
    $options[] = array( "name" => "Typography",
    					"sicon" => "font.png",
						"type" => "heading");

	$options[] = array( "name" => "Custom Fonts",
					"desc" => "You can change fonts settings for various areas by entering the fonts details in the fields below.",
					"id" => SN."customfontsinfo",
					"std" => "",
					"type" => "info");

    $options[] = array( "name" => "Enable Google Fonts",
                        "desc" => "By unchecking this the theme will use default fonts.",
                        "id" => SN."customtypography",
                        "std" => "1",
                        "type" => "checkbox");

    $options[] = array( "name" => "Logo Google Font Link",
                        "desc" => "Ex: &lt;link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,900' rel='stylesheet' type='text/css'&gt;",
                        "id" => SN."logofontlink",
                        "std" => "&lt;link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,900' rel='stylesheet' type='text/css'&gt;",
                        "type" => "textarea");

    $options[] = array( "name" => "Logo Google Font Family",
                        "desc" => "Ex: font-family: 'Source Sans Pro', sans-serif;",
                        "id" => SN."logofontface",
                        "std" => "font-family: 'Source Sans Pro', sans-serif;",
                        "type" => "text");

    $options[] = array( "name" => "Headings Google Font Link",
                        "desc" => "Ex: &lt;link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,900' rel='stylesheet' type='text/css'&gt;",
                        "id" => SN."headingfontlink",
                        "std" => "&lt;link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,900' rel='stylesheet' type='text/css'&gt;",
                        "type" => "textarea");

    $options[] = array( "name" => "Headings Google Font Family",
                        "desc" => "Ex: font-family: 'Source Sans Pro', sans-serif;",
                        "id" => SN."headingfontface",
                        "std" => "font-family: 'Source Sans Pro', sans-serif;",
                        "type" => "text");

    $options[] = array( "name" => "Body Google Font Link",
                        "desc" => "Ex: &lt;link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,900' rel='stylesheet' type='text/css'&gt;",
                        "id" => SN."bodyfontlink",
                        "std" => "&lt;link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,900' rel='stylesheet' type='text/css'&gt;",
                        "type" => "textarea");

    $options[] = array( "name" => "Body Google Font Family",
                        "desc" => "Ex: font-family: 'Source Sans Pro', sans-serif;",
                        "id" => SN."bodyfontface",
                        "std" => "font-family: 'Source Sans Pro', sans-serif;",
                        "type" => "text");

?>