<?php 
 /**
  * @package WPBlink_Metro
  * @since 1.0
  * @modified  1.0
 */
 
 
 
	/**
	 * Create the toolbar within the header
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/

	function toolbar() { ?>	
        <a id="expand_menu" title=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_menu.png" alt="icon-menu" class="expand_menu_button" /></a>
        <?php if ( mytheme_option( 'select_social' ) && mytheme_option( 'select_social' ) == 'choice1' ) { ?>
            <a id="expand_social" title=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_social.png" alt="icon-social" class="expand_social_button" /></a>
        <?php } else { ?>
        <?php } ?>	
        <?php if ( mytheme_option( 'select_search' ) && mytheme_option( 'select_search' ) == 'choice1' ) { ?>
            <a id="expand_search" title=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_search.png" alt="icon-search" class="expand_search_button" /></a>
        <?php } else { ?>
        <?php } ?>
        <?php if ( !get_option('users_can_register') ) { // IF REGISTRATION DISABLED ?>
        <?php } else { // IF REGISTRATION ENABLED ?>
            <a id="expand_member" title=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_member.png" alt="icon-member" class="expand_member_button" /></a>
        <?php } // END IF ?>
	<?php }
?>