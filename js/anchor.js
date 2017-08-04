jQuery(function($) {
	$('a[href*=#]:not([href=#])').click(function() {
		jQuery('#mobile-header:visible button.mobile-button').click();
		var t = 0;
		if ($(this).attr('data-top')) {
			t = $(this).attr('data-top');
		}
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				$('html,body').animate({
					scrollTop: target.offset().top-t
				}, 1000);
				return false;
			}
		}
	});
})