<?php 
 /**
  * @package WPBlink_Flatolio
  * @since 1.0
  * @modified  1.0
 */
 
 
 
	/**
	 * Build integrated image logo uploader
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/
	 
	function customlogo_get_default_options() {
		$options = array(
			'logo' => ''
		);
	return $options;
	}
	
	function customlogo_options_init() {
		$customlogo_options = get_option( 'theme_customlogo_options' );
		if ( false === $customlogo_options ) {
			$customlogo_options = customlogo_get_default_options();
			add_option( 'theme_customlogo_options', $customlogo_options );
		}
	}
	add_action( 'after_setup_theme', 'customlogo_options_init' );
	
	function customlogo_options_setup() {
		global $pagenow;
		if ('media-upload.php' == $pagenow || 'async-upload.php' == $pagenow) {
			add_filter( 'gettext', 'replace_thickbox_text' , 1, 2 );
		}
	}
	add_action( 'admin_init', 'customlogo_options_setup' );
	
	function replace_thickbox_text($translated_text, $text ) {	
		if ( 'Insert into Post' == $text ) {
			$referer = strpos( wp_get_referer(), 'customlogo-settings' );
			if ( $referer != '' ) {
				return __('Use as Logo', 'customlogo' );
			}
		}
		return $translated_text;
	}
	
	function customlogo_menu_options() {
		add_theme_page('Logo', 'Logo', 'edit_theme_options', 'customlogo-settings', 'customlogo_admin_options_page');
	}
	add_action('admin_menu', 'customlogo_menu_options');
	
	function customlogo_admin_options_page() {
	?>
	<div class="wrap">
        <div id="icon-themes" class="icon32"><br /></div>
        <h2><?php _e( 'Custom Logo', 'wpblink_flatolio' ); ?></h2>
        <?php settings_errors( 'customlogo-settings-errors' ); ?>
        <form id="form-customlogo-options" action="options.php" method="post" enctype="multipart/form-data">
            <?php
                settings_fields('theme_customlogo_options');
                do_settings_sections('customlogo');
            ?>
            <p class="submit">
                <input name="theme_customlogo_options[submit]" id="submit_options_form" type="submit" class="button-primary" value="<?php esc_attr_e('Save Settings', 'wpblink_flatolio'); ?>" />
                <input name="theme_customlogo_options[reset]" type="submit" class="button-secondary" value="<?php esc_attr_e('Reset Defaults', 'wpblink_flatolio'); ?>" />		
            </p>
        </form>
    </div>
	<?php
	}
	
	function customlogo_options_validate( $input ) {
		$default_options = customlogo_get_default_options();
		$valid_input = $default_options;
		$customlogo_options = get_option('theme_customlogo_options');
		$submit = ! empty($input['submit']) ? true : false;
		$reset = ! empty($input['reset']) ? true : false;
		$delete_logo = ! empty($input['delete_logo']) ? true : false;
		if ( $submit ) {
			if ( $customlogo_options['logo'] != $input['logo']  && $customlogo_options['logo'] != '' )
				delete_image( $customlogo_options['logo'] );
			$valid_input['logo'] = $input['logo'];
			}
		elseif ( $reset ) {
			delete_image( $customlogo_options['logo'] );
			$valid_input['logo'] = $default_options['logo'];
		}
		elseif ( $delete_logo ) {
			delete_image( $customlogo_options['logo'] );
		$valid_input['logo'] = '';
		}
		return $valid_input;
	}
	function delete_image( $image_url ) {
		global $wpdb;
		$query = "SELECT ID FROM wp_posts where guid = '" . esc_url($image_url) . "' AND post_type = 'attachment'";  
		$results = $wpdb -> get_results($query);
		foreach ( $results as $row ) {
			wp_delete_attachment( $row -> ID );
		}	
	}
	
	function customlogo_options_settings_init() {
		register_setting( 'theme_customlogo_options', 'theme_customlogo_options', 'customlogo_options_validate' );
		add_settings_section('customlogo_settings_header', __( 'Logo Options', 'wpblink_flatolio' ), 'customlogo_settings_header_text', 'customlogo');
		add_settings_field('customlogo_setting_logo',  __( 'Logo', 'wpblink_flatolio' ), 'customlogo_setting_logo', 'customlogo', 'customlogo_settings_header');
		add_settings_field('customlogo_setting_logo_preview',  __( 'Logo Preview', 'wpblink_flatolio' ), 'customlogo_setting_logo_preview', 'customlogo', 'customlogo_settings_header');
	}
	add_action( 'admin_init', 'customlogo_options_settings_init' );
	
	function customlogo_setting_logo_preview() {
		$customlogo_options = get_option( 'theme_customlogo_options' );  ?>
		<div id="upload_logo_preview" style="min-height: 100px;">
			<img style="max-width:100%;" src="<?php echo esc_url( $customlogo_options['logo'] ); ?>" />
		</div>
	<?php
	}
	
	function customlogo_settings_header_text() {
	?>
		<p><?php _e( 'You can upload any custom image to use as your logo.', 'wpblink_flatolio' ); ?></p>
		<p><b><?php _e( '(Rectangular images for best results).', 'wpblink_flatolio' ); ?></b></p>
	<?php
	}
	
	function customlogo_setting_logo() {
		$customlogo_options = get_option( 'theme_customlogo_options' );
	?>
		<input type="hidden" id="logo_url" name="theme_customlogo_options[logo]" value="<?php echo esc_url( $customlogo_options['logo'] ); ?>" />
		<input id="upload_logo_button" type="button" class="button" value="<?php _e( 'Upload Logo', 'wpblink_flatolio' ); ?>" />
			<?php if ( '' != $customlogo_options['logo'] ): ?>
				<input id="delete_logo_button" name="theme_customlogo_options[delete_logo]" type="submit" class="button" value="<?php _e( 'Delete Logo', 'wpblink_flatolio' ); ?>" />
			<?php endif; ?>
		<?php
	}
	
	

	
	/**
	 * Display custom logo or sitename & description text
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/
		
	function sitename () { ?>
		<?php $customlogo_options = get_option('theme_customlogo_options'); ?>
		<?php if ( $customlogo_options['logo'] != '' ) { ?>
        	<div class="clickable_trans">
				<a href="<?php echo home_url(); ?>"> </a>
            	<img src="<?php echo $customlogo_options['logo']; ?>" alt="sitelogo" class="img img_logo" />
            </div>
		<?php } else { ?>
			<?php if ( mytheme_option( 'site_name' ) && mytheme_option( 'site_name' ) != '' ) { ?>
				<h1 class="sitename"><a href="<?php echo home_url(); ?>"><?php $options = get_option( 'mytheme_options' ); $echo_options = $options['site_name']; echo stripslashes($echo_options); ?></a></h1>
			<?php } else { ?>
				<h1 class="sitename"><a href="<?php echo home_url(); ?>"><?php echo get_bloginfo('name'); ?></a></h1>
			<?php } ?>
			<?php if ( mytheme_option( 'site_desc' ) && mytheme_option( 'site_desc' ) != '' ) { ?>
				<h5 class="sitedesc"><a href="<?php echo home_url(); ?>"><?php $options = get_option( 'mytheme_options' ); $echo_options = $options['site_desc']; echo stripslashes($echo_options); ?></a></h5>
			<?php } else { ?>
				<h5 class="sitedesc"><a href="<?php echo home_url(); ?>"><?php echo get_bloginfo('description'); ?></a></h5>
			<?php } ?>
		<?php } ?>
	<?php }

?>