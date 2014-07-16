<?php
    $options[] = array( "name" => "Meta",
    					"sicon" => "metatag.png",
						"type" => "heading");

    $options[] = array( "name" => "Meta",
                        "desc" => "Use this settings for meta tags. Uncheck it if you use a SEO plugin.",
                        "id" => SN."meta",
                        "std" => "0",
                        "type" => "checkbox");

    $options[] = array( "name" => "Meta Description",
						"id" => SN."metadescription",
						"std" => "Moments - Premium wordpress theme solution for your blog.",
						"type" => "textarea");

    $options[] = array( "name" => "Meta Keywords",
						"std" => "clean proffesional wordpress theme, flexible wordpress theme,premium wordpress theme ",
						"id" => SN."metakeywords",
                        "type" => "textarea");

?>