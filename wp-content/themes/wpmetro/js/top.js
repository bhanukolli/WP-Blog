jQuery(function () {
	jQuery('.backtotop').click(function () {
		jQuery('html,body').animate({
			scrollTop: 0
		}, 500);
	return false;
	});
});