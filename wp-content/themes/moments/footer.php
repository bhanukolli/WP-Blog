	    </div>
	    <!-- end .main -->

    </div>
    <!-- end #main-container -->

    <!-- begin footer-container -->
    <div class="footer-container">
		<footer class="wrapper">

	<!-- social stuff -->
    <div id="social" class="widget">

            <?php if(of_get_option('contact_email')!="#" && of_get_option('contact_email')!=""){ ?>
            	<a href="mailto:<?php echo antispambot(of_get_option('contact_email'),1);?>"><i class="fa fa-envelope fa-2"></i></a>
            <?php } ?>

            <?php if(of_get_option('twitter')!="#" && of_get_option('twitter')!=""){ ?>
            	<a href="http://twitter.com/<?php echo of_get_option('twitter');?>" ><i class="fa fa-twitter fa-2"></i></a>
            <?php } ?>

            <?php if(of_get_option('dribbble')!="#" && of_get_option('dribbble')!=""){ ?>
            	<a href="<?php echo of_get_option('dribbble');?>"><i class="fa fa-dribbble fa-2"></i></a>
            <?php } ?>

            <?php if(of_get_option('facebook')!="#" && of_get_option('facebook')!=""){ ?>
            	<a href="<?php echo of_get_option('facebook');?>"><i class="fa fa-facebook-square fa-2"></i></a>
            <?php } ?>

            <?php if(of_get_option('googleplus')!="#" && of_get_option('googleplus')!=""){ ?>
            	<a href="<?php echo of_get_option('googleplus');?>"><i class="fa fa-google-plus fa-2"></i></a>
            <?php } ?>

            <?php if(of_get_option('vimeo')!="#" && of_get_option('vimeo')!=""){ ?>
            	<a href="<?php echo of_get_option('vimeo');?>"><i class="fa fa-vimeo-square fa-2"></i></a>
            <?php } ?>

             <?php if(of_get_option('linkedin')!="#" && of_get_option('linkedin')!=""){ ?>
            	<a href="<?php echo of_get_option('linkedin');?>"><i class="fa fa-linkedin fa-2"></i></a>
            <?php } ?>

            <?php if(of_get_option('google')!="#" && of_get_option('google')!=""){ ?>
            	<a href="<?php echo of_get_option('google');?>"><i class="fa fa-vimeo-square fa-2"></i></a>
            <?php } ?>

            <?php if(of_get_option('github')!="#" && of_get_option('github')!=""){ ?>
            	<a href="<?php echo of_get_option('github');?>"><i class="fa fa-github fa-2"></i></a>
            <?php } ?>

            <?php if(of_get_option('extrss')!="#" && of_get_option('extrss')!=""){ ?>
            	<a href="<?php echo of_get_option('extrss'); ?>"><i class="fa fa-rss fa-2"></i></a>
            	<?php } elseif(of_get_option('rss')== 1)  { ?>
            	<a href="<?php bloginfo('rss2_url'); ?>"><i class="fa fa-rss fa-2"></i></a>
            <?php } ?>
    </div>
    <!-- end social stuff -->

			<!-- begin copyright -->
			<?php echo of_get_option('footer_copyright')  ?>
			<!-- end copyright -->

			<!-- Site5 Credits-->
			<br>Created by <a href="http://www.s5themes.com/">Site5 WordPress Themes</a>. Experts in <a href="http://gk.site5.com/t/668">WordPress Hosting</a>
			<!-- end Site5 Credits-->
		</footer>
    </div>
    <!-- end footer-container -->

<?php wp_footer(); ?>

	</body>
</html>