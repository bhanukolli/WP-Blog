<?php
/**
 * @package WPBlink_FlexPost
 * @since 1.0
 */
 
	function my_wp_head() {
		$options = get_option( 'mytheme_options' );
		$cp_metro1 = $options['cp_metro1'];
		$cp_metro1_shade1 = $options['cp_metro1_shade1'];
		$cp_metro1_shade2 = $options['cp_metro1_shade2'];
		$cp_metro2 = $options['cp_metro2'];
		$cp_metro3 = $options['cp_metro3'];
		$cp_metro4 = $options['cp_metro4'];
		$cp_metro5 = $options['cp_metro5'];
		$cp_body = $options['cp_body'];
		$cp_alt = $options['cp_alt'];
		$cp_link = $options['cp_link'];
	
		echo "<style>
		

.widget,
.pagination span,
.pagination a,
.comment_wrapper,
h3.innertitle,
.overlay span.overlay_title,
.col,
.codeslide,
.code,
blockquote,
pre
{
	background: #$cp_metro1;
}

.img_half
{
	border-left: 2em solid #$cp_metro1;
}


.style1 
{
	background: #$cp_metro2 !important;
}

span.format_float,
.overlay span
{
	background: #$cp_metro2;
}

.style2
{
	background: #$cp_metro3 !important;
}

#headcontainer,
.edit-link a,
div.jp-relatedposts,
.ui-tooltip
{
	background: #$cp_metro3;
}

.style3
{
	background: #$cp_metro4 !important;
}

#expand_menu_content,
#expand_search_content,
#expand_social_content,
#expand_member_content,
.mainmenu li a:hover, 
.mainmenu li a:active,
.pagination a:hover,
.pagination .current,
.edit-link a:focus,
.edit-link a:active,
.edit-link a:hover,
a.comment-reply-link,
a.comment-reply-link:hover,
a.comment-reply-link:focus,
a.comment-reply-link:active,
#respond .comment-form-author label,
#respond .comment-form-email label,
#respond .comment-form-url label,
#respond .comment-form-comment label,
#respond input#submit
{
	background: #$cp_metro4;
}

.leftfloat,
.rightfloat,
.wp-caption
{
	color: #$cp_link;
}

.style4
{
	background: #$cp_metro5 !important;
}

.contentstyle
{
	color: #$cp_body;
}

.contentstyle a,
.contentstyle a:visited,
.contentstyle a:hover, 
.contentstyle a:active,
.contentstyle a:hover, 
.contentstyle a:active,
span.memberurl,
span.membertxt,
a,
a:visited,
a:hover, 
a:active,
.sitename a,
.sitename a:visited, 
.sitename a:active,
.sitedesc a,
.sitedesc a:visited, 
.sitedesc a:active,
.sitedesc a:hover,
.overlay span,
.overlay span.overlay_title,
body .ui-tooltip,
header,
#subheadcontent,
#maincontent,
#innercontent,
footer,
.auto,
.mainmenu li a, 
.mainmenu li a:link, 
.mainmenu li a:visited,
.mainmenu li a:hover, 
.mainmenu li a:active,
.pagination span,
.pagination a,
.pagination a:hover,
.pagination .current,
.commentlist > li.comment,
.comment-meta .fn,
.edit-link a,
.edit-link a:focus,
.edit-link a:active,
.edit-link a:hover,
a.comment-reply-link,
a.comment-reply-link:hover,
a.comment-reply-link:focus,
a.comment-reply-link:active,
#respond .comment-form-author label,
#respond .comment-form-email label,
#respond .comment-form-url label,
#respond .comment-form-comment label,
#respond .comment-notes,
#respond .logged-in-as,
p.logged-in-as a,
p.logged-in-as a:visited,
p.logged-in-as a:hover,
#respond input#submit,
#respond .logged-in-as,
#reply-title,
#ticker,
.tickerfloat,
.codeslide,
.code,
blockquote,
pre
{
	color: #$cp_link;
}

h3.innertitle
{
	color: #$cp_link !important;
}

.seperate
{
	border: 1px dotted #$cp_link;
}

p.jp-relatedposts-post-context
{
	color: #$cp_link !important;
}

h6.postsubtitle
{
	color: #$cp_alt;
}

.commentlist > li.comment
{
	background: #$cp_metro1_shade1;
}

.commentlist .children li.comment
{
	background: #$cp_metro1_shade2;
}

		</style>";
		

	}
	add_action( 'wp_head', 'my_wp_head' );

?>