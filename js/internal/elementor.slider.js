jQuery(function($) {
	$('.elementor-slides').each(function() {
		$(this).slick($(this).data('slider_options'));
	});
});