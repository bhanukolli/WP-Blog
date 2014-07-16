<?php
    $options[] = array( "name" => "Left Sidebar",
    					"sicon" => "metatag.png",
						"type" => "heading");

    $options[] = array( "name" => "Main Left Sidebar",
                        "desc" => "Use this settings for main left sidebar position.",
                        "id" => SN."sidebar",
                        "std" => "fixed",
                        "type" => "select",
                        "class" => "tiny", //mini, tiny, small
                        "options" => $layouts_array);

?>