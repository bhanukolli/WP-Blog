<?php
/**
 * @package WPBlink_Flatolio
 * @since 1.0
 */
 
	function my_wp_head() {
		$options = get_option( 'mytheme_options' );
		$cp_highlight = $options['cp_highlight'];

	
		echo "<style>

body,		
#myController span.jFlowSelected,
ul.related li,
.overlay span,
.ui-tooltip,
.mainmenu li a:hover, 
.mainmenu li a:active,
.wpcf7-submit,
div.wpcf7-mail-sent-ok,
div.wpcf7-mail-sent-ng,
.button,
a.comment-reply-link,
a.comment-reply-link:hover,
a.comment-reply-link:focus,
a.comment-reply-link:active,
#respond .comment-form-author label,
#respond .comment-form-email label,
#respond .comment-form-url label,
#respond .comment-form-comment label,
#respond input#submit,
.expand_excerpt_button,
.pagination .current {
	background: #$cp_highlight;
}

#myController span.jFlowSelected,
a:hover, 
a:active,
a.button:hover, 
a.button:active {
	color: #$cp_highlight;
}

a.button,
a.button:hover, 
a.button:active {
	border: 2px solid #$cp_highlight;
}

		</style>";
		
		
		
if ( mytheme_option( 'appearance_headbar' ) && mytheme_option( 'appearance_headbar' ) != 'choice1' ) { 

echo "<style>
	#headcontainer {
		background: #$cp_highlight;
	}
	#expand_menu_content {
		background: #$cp_highlight;
	}
</style>";	
	
 } else { 
 } 
 
 if ( mytheme_option( 'appearance_footbar' ) && mytheme_option( 'appearance_footbar' ) == 'choice1' ) { 

echo "<style>
	#footercontainer {
		position: fixed;
	}
</style>";	
	
 } else { 
 } 
        
        
        
		

	}
	add_action( 'wp_head', 'my_wp_head' );

?>