<?php
/*********************************************************************************************

This theme uses wp_nav_menu() in one location.

*********************************************************************************************/
register_nav_menus(                      		// wp3+ menus
		array(
			'main_nav' => 'The Main Menu',   // main nav in header
		)
	);
	
function site5_main_nav($container_class) {
	// display the wp3 menu if available
    wp_nav_menu(
    	array(
    		'menu' => 'main_nav', /* menu name */
    		'theme_location' => 'main_nav', /* where in the theme it's assigned */
			'container' =>'nav',
			'container_class' => $container_class, 
    		'fallback_cb' => 'site5_main_nav_fallback' /* menu fallback */
    	)
    );
}

// this is the fallback for header menu
function site5_main_nav_fallback() {
	echo'';
}

?>