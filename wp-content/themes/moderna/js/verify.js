	jQuery(document).ready(function($) {
		jQuery('form#contactform').submit(function() {
			jQuery('form#contactform .error').remove();
			var hasError = false;
			jQuery('.requiredField').each(function() {
				if(jQuery.trim(jQuery(this).val()) == '') {
					var labelText = jQuery(this).attr("data-msg");
					jQuery(this).parent().append('<span class="error">'+labelText+'</span>');
					jQuery(this).addClass('inputError');
					hasError = true;
				} else if(jQuery(this).hasClass('email')) {
					var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
					if(!emailReg.test(jQuery.trim(jQuery(this).val()))) {
						var labelText = jQuery(this).prev('label').text();
						jQuery(this).parent().append('<span class="error">You entered an invalid '+labelText+'</span>');
						jQuery(this).addClass('inputError');
						hasError = true;
					}
				}
			});
			if(!hasError) {
				var formInput = jQuery(this).serialize();
				var contact_success = document.getElementById("contact_success").value;
				jQuery.post(jQuery(this).attr('action'),formInput, function(data){
					jQuery('form#contactform').slideUp("fast", function() {				   
						jQuery(this).before('<p class="thanks"> '+contact_success+'</p>');
					});
				});
			}
			
			return false;	
		});
	});