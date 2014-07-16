<?php
/*********************************************************************************************

Register Global Sidebars

*********************************************************************************************/
function site5framework_widgets_init() {

	register_sidebar( array (
    'name' => __( 'Sidebar Widgets', 'site5framework' ),
    'id' => 'sidebar',
    'before_widget' => '<div id="%1$s" class="widget_sidebar %2$s" >',
    'after_widget' => "</div>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
	) );

	register_sidebar( array (
    'name' => __( 'Page Widgets', 'site5framework' ),
    'id' => 'pagewidget',
    'before_widget' => '<div id="%1$s" class="widget_pagewidget %2$s" >',
    'after_widget' => "</div>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
	) );

}

add_action( 'init', 'site5framework_widgets_init' );
?>