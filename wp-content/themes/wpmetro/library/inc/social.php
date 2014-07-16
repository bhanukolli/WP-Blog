<?php 
 /**
  * @package WPBlink_Metro
  * @since 1.0
  * @modified  1.0
 */
 
 
 
	/**
	 * Display various social networking icons
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @access    public
	 * @since     1.0
	 * @modified  1.0
	*/
	
	function socialicons() { ?>
		<?php if ( mytheme_option( 'social_fb' ) && mytheme_option( 'social_fb' ) != '' ) { ?>
            <a href="<?php $options = mytheme_option( 'social_fb' ); $echo_options = $options['social_fb']; echo stripslashes($echo_options); ?>" target="_blank" title="Facebook">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_facebook.png" alt="icon-facebook" class="social-icon" />
            </a>
        <?php } else { ?>
        <?php } ?>
        
        <?php if ( mytheme_option( 'social_tw' ) && mytheme_option( 'social_tw' ) != '' ) { ?>
            <a href="<?php $options = mytheme_option( 'social_tw' ); $echo_options = $options['social_tw']; echo stripslashes($echo_options); ?>" target="_blank" title="Twitter">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_twitter.png" alt="icon-twitter" class="social-icon" />
            </a>
        <?php } else { ?>
        <?php } ?>
        
        <?php if ( mytheme_option( 'social_yt' ) && mytheme_option( 'social_yt' ) != '' ) { ?>
            <a href="<?php $options = mytheme_option( 'social_yt' ); $echo_options = $options['social_yt']; echo stripslashes($echo_options); ?>" target="_blank" title="YouTube">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_youtube.png" alt="icon-youtube" class="social-icon" />
            </a>
        <?php } else { ?>
        <?php } ?>
        
        <?php if ( mytheme_option( 'social_ig' ) && mytheme_option( 'social_ig' ) != '' ) { ?>
            <a href="<?php $options = mytheme_option( 'social_ig' ); $echo_options = $options['social_ig']; echo stripslashes($echo_options); ?>" target="_blank" title="Instagram">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_instagram.png" alt="icon-instagram" class="social-icon" />
            </a>
        <?php } else { ?>
        <?php } ?>
        
        <?php if ( mytheme_option( 'social_pi' ) && mytheme_option( 'social_pi' ) != '' ) { ?>
            <a href="<?php $options = mytheme_option( 'social_pi' ); $echo_options = $options['social_pi']; echo stripslashes($echo_options); ?>" target="_blank" title="Pinterest">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_pinterest.png" alt="icon-pinterest" class="social-icon" />
            </a>
        <?php } else { ?>
        <?php } ?>
        
        <?php if ( mytheme_option( 'social_sc' ) && mytheme_option( 'social_sc' ) != '' ) { ?>
            <a href="<?php $options = mytheme_option( 'social_sc' ); $echo_options = $options['social_sc']; echo stripslashes($echo_options); ?>" target="_blank" title="SoundCloud">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_soundcloud.png" alt="icon-soundcloud" class="social-icon" />
            </a>
        <?php } else { ?>
        <?php } ?> 
        
        <?php if ( mytheme_option( 'social_gp' ) && mytheme_option( 'social_gp' ) != '' ) { ?>
            <a href="<?php $options = mytheme_option( 'social_gp' ); $echo_options = $options['social_gp']; echo stripslashes($echo_options); ?>" target="_blank" title="Google Plus">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_google.png" alt="icon-google" class="social-icon" />
            </a>
        <?php } else { ?>
        <?php } ?> 
        
        <?php if ( mytheme_option( 'social_fr' ) && mytheme_option( 'social_fr' ) != '' ) { ?>
            <a href="<?php $options = mytheme_option( 'social_fr' ); $echo_options = $options['social_fr']; echo stripslashes($echo_options); ?>" target="_blank" title="Flickr">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_flickr.png" alt="icon-flickr" class="social-icon" />
            </a>
        <?php } else { ?>
        <?php } ?>
        
        <?php if ( mytheme_option( 'social_li' ) && mytheme_option( 'social_li' ) != '' ) { ?>
            <a href="<?php $options = mytheme_option( 'social_li' ); $echo_options = $options['social_li']; echo stripslashes($echo_options); ?>" target="_blank" title="LinkedIn">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_linkedin.png" alt="icon-linkedin" class="social-icon" />
            </a>
        <?php } else { ?>
        <?php } ?>  
        
        <?php if ( mytheme_option( 'social_dr' ) && mytheme_option( 'social_dr' ) != '' ) { ?>
            <a href="<?php $options = mytheme_option( 'social_dr' ); $echo_options = $options['social_dr']; echo stripslashes($echo_options); ?>" target="_blank" title="Dribbble">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_dribbble.png" alt="icon-dribbble" class="social-icon" />
            </a>
        <?php } else { ?>
        <?php } ?>
        
        <?php if ( mytheme_option( 'social_vm' ) && mytheme_option( 'social_vm' ) != '' ) { ?>
            <a href="<?php $options = mytheme_option( 'social_vm' ); $echo_options = $options['social_vm']; echo stripslashes($echo_options); ?>" target="_blank" title="Vimeo">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_vimeo.png" alt="icon-vimeo" class="social-icon" />
            </a>
        <?php } else { ?>
        <?php } ?> 
        
        <?php if ( mytheme_option( 'social_da' ) && mytheme_option( 'social_da' ) != '' ) { ?>
            <a href="<?php $options = mytheme_option( 'social_da' ); $echo_options = $options['social_da']; echo stripslashes($echo_options); ?>" target="_blank" title="DeviantArt">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_deviantart.png" alt="icon-deviantart" class="social-icon" />
            </a>
        <?php } else { ?>
        <?php } ?>
        
        <?php if ( mytheme_option( 'social_sk' ) && mytheme_option( 'social_sk' ) != '' ) { ?>
            <a href="<?php $options = mytheme_option( 'social_sk' ); $echo_options = $options['social_sk']; echo stripslashes($echo_options); ?>" target="_blank" title="Skype">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_skype.png" alt="icon-skype" class="social-icon" />
            </a>
        <?php } else { ?>
        <?php } ?> 
	<?php }

?>