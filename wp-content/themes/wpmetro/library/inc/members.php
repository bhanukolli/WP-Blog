<?php 
 /**
  * @package WPBlink_Metro
  * @since 1.0
  * @modified  1.0
 */
 
 
 
	/**
	 * Display the membership area
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/

	function membershiparea () { ?>
		<?php if ( !get_option('users_can_register') ) { // IF REGISTRATION DISABLED ?>
			<?php echo '&nbsp;'; // DISPLAY NOTHING ?>
		<?php } else { // IF REGISTRATION ENABLED ?>
			<?php global $current_user; get_currentuserinfo(); echo get_avatar( $current_user->ID, 512 ); ?>
			<?php if ( is_user_logged_in() ) { // IF USER IS LOGGED IN ?>
				<span class="membertxt">
					<a href="<?php echo home_url(); ?>/wp-admin/profile.php">
						<?php global $current_user; get_currentuserinfo(); echo $current_user->display_name; ?>
					</a>
				</span>
				<span class="memberurl"><?php wp_register('', ''); ?> &nbsp;/&nbsp; <?php wp_loginout(); ?></span>
			<?php } else { // IF USER IS NOT LOGGED IN ?>
				<span class="membertxt">
					<?php _e( 'You are not logged in', 'wpblink_metro' ); ?>
				</span>
				<span class="memberurl"><?php wp_register('', ''); ?> &nbsp;/&nbsp; <?php wp_loginout(); ?> &nbsp;/&nbsp; <a href="<?php echo home_url(); ?>/wp-login.php?action=lostpassword"><?php _e( 'Lost Password?', 'wpblink_metro' ); ?></a></span>
			<?php } ?>
		<?php } ?>
		<div class="break"></div>
	<?php }

?>