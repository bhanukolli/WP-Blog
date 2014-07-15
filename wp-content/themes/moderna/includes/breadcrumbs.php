<?php function get_breadcrumbs()
{
    global $wp_query;
    if ( !is_home() ){
        // Start the UL
        echo '<ul class="breadcrumb">';
		echo '<li><a href="'. home_url() .'"><i class="fa fa-home"></i></a></li>';
        // Add the Home link
        if ( is_category() )
        {
            $catTitle = single_cat_title( "", false );
            $cat = get_cat_ID( $catTitle );
			echo '<li>';
            echo get_category_parents( $cat, TRUE, " " );
			echo '</li>';
        }
        elseif ( is_archive() && !is_category() )
        {
            echo ' <span class="bread_arrow">/ </span><span class="current_crumb">Archives</span>';
        }
        elseif ( is_search() ) {
 
            echo ' <span class="bread_arrow">/ </span><span class="current_crumb">'.__('Search Results','iwebtheme').'</span>';
        }
        elseif ( is_404() )
        {
            echo ' <span class="bread_arrow">/ </span><span class="current_crumb">'.__('404 Not Found','iwebtheme').'</span>';
        }
		
        elseif ( is_singular( 'portfolio' ) )
        {
			echo ' <span class="sub-title"> / </span>';
            echo the_title('','', FALSE) ."";
        }
		
        elseif ( is_single() )
        {
		
            $categories = get_the_category();
			$category_id ='';
			foreach($categories as $category) {
				if ($category->cat_name!== 'broder') {
					$category_id = get_cat_ID( $category->cat_name );
				}
			}
			echo '<li>';
            echo get_category_parents( $category_id, TRUE, '' );
			echo '</li>';
			echo '<li>';
            echo the_title('','', FALSE) ."</li> ";
        }

        elseif ( is_page() )
        {
            $post = $wp_query->get_queried_object();
 
            if ( $post->post_parent == 0 ){
 
                echo '<li class="active">'.the_title('','', FALSE).'</li>';
 
            } else {
                $title = the_title('','', FALSE);
                $ancestors = array_reverse( get_post_ancestors( $post->ID ) );
                array_push($ancestors, $post->ID);
 
                foreach ( $ancestors as $ancestor ){
                    if( $ancestor != end($ancestors) ){
                        echo '<li><a href="'. get_permalink($ancestor) .'">'. strip_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) ) .'</a></li>';
                    } else {
                        echo '<li>'. strip_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) ) .'</li>';
                    }
                }
            }
        }
        // End the UL
        echo "</ul>";
    } else {
		echo '<ul class="breadcrumb">';
		echo '<li><a href="'. home_url() .'"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>';
		echo "</ul>";
	}
}
?>
<?php
return get_breadcrumbs();
?>