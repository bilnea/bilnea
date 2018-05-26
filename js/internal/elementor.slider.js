jQuery(function($) {
	$('.elementor-slides').not('.slick-initialized').each(function() {
		$(this).slick($(this).data('slider_options'));
	});
});