<?php
/*
Template Name: Contact page
*/
get_header();
?>
<section id="inner-headline">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<?php get_template_part('includes/breadcrumbs'); ?>
				</div>
			</div>	
		</div>
</section>	
<section id="content" class="nopadtop">
		<?php if(iwebtheme_smof_data('map_enable') != 0) { ?>
			<div id="googlemaps" class="google-map">
			</div>		
		<?php } ?>
		
<div class="container">
	<div class="row">
	<div class="col-lg-12">
		<h4><?php echo __('Get in touch with us by filling','iwebtheme'); ?> <strong><?php echo __('contact form below','iwebtheme'); ?></strong></h4>

				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="contactform" method="post" class="validateform">

					<div class="row">
						<div class="col-lg-4 field">
							<input type="text" class="requiredField" name="contactName" id="contactName" placeholder="* <?php echo __('Enter your full name','iwebtheme'); ?>" data-rule="maxlen:4" data-msg="<?php echo __('Please enter at least 4 chars','iwebtheme'); ?>" />
							<div class="validation">
							</div>
						</div>
						
						<div class="col-lg-4 field">
							<input type="text" class="requiredField" name="email" id="email" placeholder="* <?php echo __('Enter your email address','iwebtheme'); ?>" data-rule="email" data-msg="<?php echo __('Please enter a valid email','iwebtheme'); ?>" />
							<div class="validation">
							</div>
						</div>
						
						<div class="col-lg-4 field">
							<input type="text" name="subject" id="subject" placeholder="<?php echo __('Enter your subject','iwebtheme'); ?>" data-rule="maxlen:4" data-msg="<?php echo __('Please enter at least 4 chars','iwebtheme'); ?>" />
							<div class="validation">
							</div>
						</div>
						
						<div class="col-lg-12 margintop10 field">
							<textarea rows="12" name="comments" class="requiredField" id="comments" class="input-block-level" placeholder="* <?php echo __('Your message here','iwebtheme'); ?>..." data-rule="required" data-msg="<?php echo __('Please write something','iwebtheme'); ?>"></textarea>
							<div class="validation clearfix">
							</div>
						</div>
						<div class="col-lg-12 field">
							<p>
								<button name="Mysubmitted" id="Mysubmitted" class="btn btn-theme margintop20 pull-left" type="submit"><?php echo __('Submit message','iwebtheme'); ?></button>
								<span class="pull-right margintop20">* <?php echo __('Please fill all required form field, thanks','iwebtheme'); ?>!</span>
							</p>
							<input type="hidden" name="submitted" id="submitted" value="true" />
							<input type="hidden" name="contact_success" id="contact_success" value="<?php echo iwebtheme_smof_data('contact_success');?>" />
						</div>					
					</div>
					
				</form>

	
	</div>
	</div>
</div>
</section>
<?php
get_template_part('includes/contact-function'); 
?>	
<?php get_footer(); ?>