<?php
// tag
 $args = array(
'smallest' => 8,
'largest' => 22,
'unit' => 'pt',
'number' => 45,
'format' => 'flat',
'separator' => '\\"\n\\"',
'orderby' => 'name',
'order' => 'ASC',
'exclude' => null,
'include' => null,
'link' => 'view',
'taxonomy' => 'post_tag',
'echo' => true,
'child_of' => null
);

add_filter('widget_tag_cloud_args','set_number_tags');
function set_number_tags($args) {
$args = array('smallest' => 9, 'largest' => 9);
return $args;
}

// =================================================================
/* clean shortcode */
function clean_shortcodes($content) {   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']',
        '<p><span>[' => '[', 
        ']</span></p>' => ']', 
        ']<br />' => ']'
    );

    $content = strtr($content, $array);
    return $content;
}
add_filter('the_content', 'clean_shortcodes');
// =================================================================



	
// Pagination ==========================================================
function pagination($pages = '', $range = 1)
{
     $showitems = ($range * 2)+1; 
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }  
 
     if(1 != $pages)
     {
         echo "<div id=\"pagination\">";
         if($paged > 1 && $showitems < $pages) 
		 echo "<span class=\"alls\">Page ".get_pagenum_link($paged - 1)." of 3 </span>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo "<a class=\"pag-next\" href=\"".get_pagenum_link($paged + 1)."\"></a>";

         echo "</div>\n";
     }
}
?>