<?php
/**
 * @package WordPress
 * @subpackage Moderna Theme
 */
?>
<!-- FOOTER -->
	<footer>
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-6">
				<?php dynamic_sidebar('footer-1'); ?>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6">
				<?php dynamic_sidebar('footer-2'); ?>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6">
				<?php dynamic_sidebar('footer-3'); ?>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6">
				<?php dynamic_sidebar('footer-4'); ?>
			</div>
		</div>
	</div>
	<div id="sub-footer">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="copyright">
						<p>
							<span><?php echo iwebtheme_smof_data('footer_text'); ?></span>
						</p>
					</div>
				</div>
				<div class="col-lg-6">
				
				<?php if(iwebtheme_smof_data('sw_social') != 0) { ?>
								<ul class="social-network">
									<?php if(iwebtheme_smof_data('so_fb') != "") { ?>
									<li><a data-placement="top" title="Facebook" target="_blank" href="<?php echo iwebtheme_smof_data('so_fb'); ?>"><i class="fa fa-facebook"></i></a></li>
									<?php } ?>
									<?php if(iwebtheme_smof_data('so_twitter') != "") { ?>
									<li><a data-placement="top" target="_blank" title="Twitter" href="<?php echo iwebtheme_smof_data('so_twitter'); ?>"><i class="fa fa-twitter"></i></a></li>
									<?php } ?>
									<?php if(iwebtheme_smof_data('so_linkedin') != "") { ?>
									<li><a data-placement="top" target="_blank" title="Linkedin" href="<?php echo iwebtheme_smof_data('so_linkedin'); ?>"><i class="fa fa-linkedin"></i></a></li>
									<?php } ?>
									<?php if(iwebtheme_smof_data('so_pinterest') != "") { ?>
									<li><a data-placement="top" target="_blank" title="Pinterest" href="<?php echo iwebtheme_smof_data('so_pinterest'); ?>"><i class="fa fa-pinterest"></i></a></li>
									<?php } ?>
									<?php if(iwebtheme_smof_data('so_googleplus') != "") { ?>
									<li><a data-placement="top" target="_blank" title="Google plus" href="<?php echo iwebtheme_smof_data('so_googleplus'); ?>"><i class="fa fa-google-plus"></i></a></li>
									<?php } ?>
								</ul>
							<?php } ?>

				</div>
			</div>
		</div>
	</div>
	</footer>
</div>
<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
	
<?php echo stripslashes(iwebtheme_smof_data('google_analytics')); ?>
<?php wp_footer(); ?>
</body>
</html>