jQuery(function() {
	jQuery('.parallax, [data-class*="parallax"]').each(function() {
		var t = jQuery(this),
			i = t.css('background-image'),
			p = t.css('background-position'),
			v = t.css('background-size'),
			w = t.outerWidth(),
			h = t.outerHeight(),
			s = 0.2;
		if (t.data('speed')) {
			s = t.data('speed');
		};
		i = /^url\((['"]?)(.*)\1\)$/.exec(i);
		i = i ? i[2] : "";
		t.css('background', 'transparent').css('overflow: hidden');
		jQuery('<div class="parallax-bg" style="background-image: url('+i+'); background-position: '+p+'; background-size: '+v+';" data-speed="'+s+'"></div>').appendTo(t);
	})
})

function parallax() {
		var s = jQuery(window).scrollTop();
		jQuery('.parallax-bg').each(function() {
			var t = jQuery(this),
				e = t.data('speed'),
				s = (jQuery(window).scrollTop()*e)+'px';
			t.css('top', s);
		});
}

jQuery(window).scroll(function(e){
		parallax();
});