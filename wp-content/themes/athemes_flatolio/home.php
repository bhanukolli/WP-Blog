<?php get_header(); // HEADER ?>
    <div id="subheadcontainer">
        <div id="subheadcontent">
            <div class="section group"><!-- section -->
                <div class="col span_3_of_3 trans unlimited centered"><!-- col -->
					<?php if ( mytheme_option( 'site_name' ) && mytheme_option( 'site_name' ) != '' ) { ?>
						<h1 class="sitename"><a href="<?php echo home_url(); ?>"><?php $options = get_option( 'mytheme_options' ); $echo_options = $options['site_name']; echo stripslashes($echo_options); ?></a></h1>
					<?php } else { ?>
						<h1 class="sitename"><a href="<?php echo home_url(); ?>"><?php echo get_bloginfo('name'); ?></a></h1>
					<?php } ?>
					<?php if ( mytheme_option( 'site_desc' ) && mytheme_option( 'site_desc' ) != '' ) { ?>
						<h4 class="sitedesc"><a href="<?php echo home_url(); ?>"><?php $options = get_option( 'mytheme_options' ); $echo_options = $options['site_desc']; echo stripslashes($echo_options); ?></a></h4>
					<?php } else { ?>
						<h4 class="sitedesc"><a href="<?php echo home_url(); ?>"><?php echo get_bloginfo('description'); ?></a></h4>
					<?php } ?>
					<?php $customlogo_options = get_option('theme_customlogo_options'); ?>
					<?php if ( $customlogo_options['logo'] != '' ) { ?>
        				<div class="clickable_trans">
							<a href="<?php echo home_url(); ?>"> </a>
            				<img src="<?php echo $customlogo_options['logo']; ?>" alt="sitelogo" class="img img_logo centered" />
            			</div>
					<?php } else { ?>
					<?php } ?>
                </div><!-- /col -->
            </div><!-- /section -->
        </div>
    </div>
	<?php widget_home(); // SIDEBAR WIDGETS ?>    
<?php get_footer(); // FOOTER ?>