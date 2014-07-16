<?php
/* ------------------------------------------------------------------------- *
 *  These are default functions used by the theme
/* ------------------------------------------------------------------------- */



/*  Output first category
/* ------------------------------------ */
function ac_output_first_category( $class = '' ) {
	global $post;
	$output_category = '';
	
	$gpt = get_post_type( get_the_ID() );
	
	if ( $class != '' ) {
		$show_class = 'class="' . $class . '" ';
	} else {
		$show_class = '';	
	}
	
	$category = get_the_category();
	if ( $category ) {
		$output_category = 
			'<a href="' . get_category_link( $category[0]->term_id ) . '" ' . $show_class . 'title="' . sprintf( __( "View all posts in %s", "acosmin" ), $category[0]->name ) . '" ' . '>' . $category[0]->name.'</a> ';
	}
	
	if( $gpt != 'page') {
		echo $output_category;
	}
}



/*  Output comments number
/* ------------------------------------ */
function ac_comments_number() {
	$num_comments = get_comments_number();
	$comments = '';
	
	if ( comments_open() ) {
		if ( $num_comments == 0 ) {
			$comments = __('0 Comments', 'acosmin');
		} elseif ( $num_comments > 1 ) {
			$comments = $num_comments . __(' Comments', 'acosmin');
		} else {
			$comments = __('1 Comment', 'acosmin');
		}
	}
	
	echo $comments;
}



/*  Basic template hooks
/* ------------------------------------ */
function ac_after_body() {
	// After the <body> tag
	do_action( 'ac_after_body_hook' );
}

function ac_before_body_closed() {
	// Before the </body> tag
	do_action( 'ac_before_body_closed_hook' );
}



/*  Check if page is paginated
/* ------------------------------------ */
function ac_check_paged() {
	global $wp_query, $page, $post;
	if( $page < 2) { return true; } else { return false; }
}



/*  Custom feed url
/* ------------------------------------ */
function ac_custom_rss_feed( $output, $feed ) {
    if ( strpos( $output, 'comments' ) )
        return $output;
	
	$custom_feed = of_get_option( 'ac_custom_rss_url' );

    return esc_url( $custom_feed );
}

if ( of_get_option( 'ac_custom_rss_url' ) != '' ) {
	add_action( 'feed_link', 'ac_custom_rss_feed', 10, 2 );
}



/*  Favicon
/* ------------------------------------ */
function ac_favicon() {
    $favicon_desktop = of_get_option( 'ac_favicon_desktop' );
	
	$output = '<link rel="shortcut icon" href="' . esc_url( $favicon_desktop ) . '">';
	
	if ( $favicon_desktop != '') {
		echo $output . "\n";
	} else {
		return;	
	}
}
add_action( 'wp_head', 'ac_favicon', 2);
?>