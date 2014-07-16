<?php 
 /**
  * @package WPBlink_Flatolio
  * @since 1.0
  * @modified  1.0
 */
 
	/**
	 * Create main dropdown menu
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/
	
	function mainmenu() { ?>
		<div id="menucontainer">
			<?php wp_nav_menu( array('menu_class' => 'mainmenu', 'menu_id' => '', 'container_class' => 'mainmenu', 'theme_location' => 'main_menu', 'depth' => '4', 'fallback_cb' => 'mainmenu_fallback' )); ?>
        </div>
	<?php }



	/**
	 * Create main dropdown menu fallback
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/
	
	function mainmenu_fallback() { ?>
		<div class="mainmenu">
			<ul id="menu-menu-1" class="mainmenu">
				<li><a href="<?php echo home_url(); ?>"><?php _e('Home','wpblink_flatolio'); ?></a></li>
				<?php wp_list_categories('title_li='); ?>
			</ul>
		</div>
	<?php }
	
	
	
	
	/**
	 * Create the button that opens the menu
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/
	
	function menubutton() { ?>
		<a id="expand_menu" title=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_menu.png" alt="icon-menu" class="expand_menu_button" /></a>
	<?php }
		
?>