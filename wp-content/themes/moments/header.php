<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

<!-- begin head -->
<head>
	<meta charset="utf-8">
	<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
	<title><?php wp_title(' | ', true, 'right'); ?> <?php bloginfo('name'); ?></title>

	<!-- begin meta -->
	<meta name="viewport" content="width=device-width">
	<?php if (of_get_option('meta') == '1'){?>
<meta name="keywords" content="<?php echo of_get_option('metakeywords'); ?>" />
	<meta name="description" content="<?php echo of_get_option('metadescription'); ?>" />
	<?php }else {?>
	<?php }?><!-- end meta -->

	<!-- main stylesheet -->
	<link rel="stylesheet" media="all" href="<?php bloginfo('stylesheet_url'); ?>"/>
	<!-- main stylesheet -->


<!--//################################# Begin Custom Typography #################################//-->
<?php if(of_get_option('customtypography') == '1') { ?>
<?php if(of_get_option('headingfontlink') != '') { ?>
<?php echo stripslashes(html_entity_decode(of_get_option('headingfontlink')));?>
<?php } ?>

<?php if(of_get_option('bodyfontlink') != '') { ?>
<?php echo stripslashes(html_entity_decode(of_get_option('bodyfontlink')));?>
<?php } ?>

<?php if(of_get_option('logofontlink') != '') { ?>
<?php echo stripslashes(html_entity_decode(of_get_option('logofontlink')));?>
<?php } ?>
<?php load_template( get_template_directory() . '/custom.typography.css.php' );?>

<?php } ?>
<!--//################################# End Custom Typography #################################//-->

<!--//################################# Begin Custom Colors #################################//-->
<?php load_template( get_template_directory() . '/custom.colors.css.php' );?>

<!--//################################# End Custom Colors #################################//-->

<!-- begin wp_head -->
<?php wp_head(); ?>
<!-- end wp_head -->

</head>
<!-- end head -->

	<body <?php body_class(); ?> <?php if(of_get_option('layout') != 'left' && of_get_option('layout') != ''):?>id="right-sidebar"<?php endif;?>>

		<!--[if lt IE 7]>
            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
        <![endif]-->

		<div class="main-container">

			<!-- begin header_container -->
			<div <?php if(of_get_option('sidebar') ==fixed){?>class="header_container_fixed"<?php }else{?>class="header_container_flat"<?php }?>>

				<!-- begin header -->
				<header class="wrapper clearfix">

					<!-- begin logo -->
					<h1 <?php if(of_get_option('image_logo') != 1){?>class="textlogo"<?php }else{?>class="logo"<?php }?> title="<?php  echo get_bloginfo('name');?>">
						<a href="<?php bloginfo('url');?>">

	                    <?php if(of_get_option('image_logo') != 1){?>

	                        <?php if(of_get_option('logo_text')) : echo of_get_option('logo_text'); endif;?>

	                        <?php }else{?>

                            <?php if(of_get_option('logo')) : echo '<img src="'.of_get_option('logo').'" alt="'.get_bloginfo('name').'" class="styled"/>'; endif;?>
						<?php }?>

                    	</a>
					</h1>
					<h2 class="description"><?php  echo get_bloginfo('description');?></h2>
					<!-- end logo -->

               		<div class="mini_divider"></div>

               		<!-- begin main navigation -->
                    <?php if ( has_nav_menu( 'main_nav' ) ) {?>
                    	<?php  site5_main_nav(''); ?>
                  	<?php }?>
	                <!-- end main navigation -->

	                <div class="mini_divider"></div>

	                <!-- begin search form -->
	                	<?php get_search_form(); ?>
                	<!-- end search form -->

	                <div class="mini_divider"></div>

	            </header>
	            <!-- end header -->

	         </div>
        	<!-- end header_container -->


        <!-- begin main -->
        <div class="main wrapper clearfix">