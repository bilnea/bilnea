jQuery(function() {
	jQuery('.parallax, [class*="parallax"]').each(function() {
		var t = jQuery(this),
			i = t.css('background-image'),
			p = t.css('background-position'),
			v = t.css('background-size'),
			w = t.outerWidth(),
			h = t.outerHeight(),
			s = 0.05,
			c = t.attr('class').split(/\s+/);
		if (t.data('speed')) {
			s = t.data('speed');
		};
		jQuery.each(c, function(index, value) {
			if (/^parallax-/.test(value)) {
				s = parseFloat('0.'+value.split('-')[1]);
			}
		});
		i = /^url\((['"]?)(.*)\1\)$/.exec(i);
		i = i ? i[2] : "";
		t.css('background', 'transparent').css('overflow: hidden');
		jQuery('<div class="parallax-bg" style="background-image: url('+i+'); background-position: '+p+'; background-size: '+v+';" data-speed="'+s+'"></div>').appendTo(t);
	});
	parallax();
})

function parallax() {
		var s = jQuery(window).scrollTop();
		jQuery('.parallax-bg').each(function() {
			var t = jQuery(this),
				e = t.data('speed'),
				s = ((t.parent('[class*="parallax"]').offset().top - (jQuery(window).scrollTop() + jQuery(window).height()))*e)+'px';
			t.height(((jQuery(window).height()*parseFloat(e))+t.parent('[class*="parallax"]').height())*(1+parseFloat(e))).css('top', s);
		});
}

jQuery(window).scroll(function(e){
	parallax();
});