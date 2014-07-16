<!DOCTYPE html>
	<!-- HTML5 Boilerplate -->
	<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
	<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
	<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
	<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

		<!-- Responsive and mobile friendly stuff -->
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.5, minimum-scale=1.0" />
		<!--[if IEMobile]>
			<meta http-equiv="cleartype" content="on">
		<![endif]-->        

		<!-- META information -->
		<meta name="keywords" content="<?php $options = mytheme_option( 'misc_metakeywords' ); $echo_options = $options['misc_metakeywords']; echo stripslashes($echo_options); ?>" />
		<meta name="description" content="<?php $options = mytheme_option( 'misc_metadesc' ); $echo_options = $options['misc_metadesc']; echo stripslashes($echo_options); ?>" />
		<title>
			<?php
				/*Title for tags */
				if (function_exists('is_tag') && is_tag()) {
					bloginfo('name'); echo ' &nbsp;|&nbsp; '; single_tag_title("", true); }
					/*Title for archives */   
					elseif (is_archive()) {
						bloginfo('name'); echo ' &nbsp;|&nbsp; '; wp_title(''); echo ' Archive'; }
					/*Title for search */     
					elseif (is_search()) {
						bloginfo('name'); echo ' &nbsp;|&nbsp; '; echo 'Search Results: '.wp_specialchars($s); }
					/*Title for 404 */    
					elseif (is_404()) {
						bloginfo('name'); echo ' &nbsp;|&nbsp; '; echo 'Page Not Found '; }
					/*Title for front page */
					elseif (is_home()) {
						bloginfo('name'); echo ' &nbsp;|&nbsp; '; bloginfo('description'); }				 
					/*Title for static page */
					elseif (is_page()) {
						bloginfo('name'); echo ' &nbsp;|&nbsp; '; wp_title(''); }
					/*Title for static page */
					elseif (is_single()) {
						bloginfo('name'); echo ' &nbsp;|&nbsp; '; wp_title(''); }				 
					/*Title fallback */
				else  {
				bloginfo('name'); echo ' &nbsp;|&nbsp; '; wp_title(''); }
			?>
		</title>

		<!-- Wordpress -->
		<meta name="generator" content="WordPress <?php bloginfo('version'); ?> <?php _e( 'enhanced by WPBlink.com', 'wpblink_flatolio' ); ?>" />

		<!-- RSS & Pingback -->
		<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
		<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
		<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

		<!-- Queue libraries, stylesheets & scripts -->
		<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
		<?php wp_enqueue_script('jquery'); ?>
		<?php wp_head(); // WP_HEAD ?>
	</head>
	<body <?php body_class(); ?> data-stellar-background-ratio="0.5">
		<div id="Top"></div>
		<div id="wrapper"><!-- #wrapper -->
			<div id="headcontainer">
				<header class="group">
					<div class="header_first">
        				<?php menubutton() // MENU BUTTON ?>
					</div>
					<div class="header_second">
        				&nbsp;
                    </div>
				</header>
				<div class="break"></div>
			</div>
            
            
            <div id="slidecontainer">
            <div class="slideinner">
            <div class="group">
				<div id="expand_menu_content">
					<div class="auto">
						<?php mainmenu(); // MAIN MENU ?>
					</div>
				</div>
            
            </div>
            </div>
            </div>