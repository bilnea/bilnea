jQuery(function() {
	jQuery('div[class*="b_accordion"]').each(function() {
		var t = jQuery(this),
			a = t.attr('data-active');
		if (a != '0') {
			t.children().eq(a-1).addClass('opened');
		};
		t.children(':not(.opened)').children('.accordion_content').hide();
	})
	jQuery('.b_accordion .accordion_title').click(function() {
		var t = jQuery(this),
			p = t.parent();
		if (p.hasClass('accordion_frame') && !p.hasClass('opened')) {
			t.closest('.b_accordion').children('.opened').removeClass('opened').children('.accordion_content').slideToggle();
			p.addClass('opened').children('.accordion_content').slideToggle(400, function() {
				b_js_adjust_height();
				console.log('a');
			});
		} else {
			if (t.closest('.b_accordion').hasClass('c2close')) {
				p.removeClass('opened').children('.accordion_content').slideToggle();
			};
		};
	})
	jQuery('.b_accordion-multiple .accordion_title').click(function() {
		var t = jQuery(this),
			p = t.parent();
		if (p.hasClass('accordion_frame') && !p.hasClass('opened')) {
			p.addClass('opened').children('.accordion_content').slideToggle(400, function() {
				b_js_adjust_height();
			});
		} else if (p.hasClass('accordion_frame') && p.hasClass('opened')) {
			p.removeClass('opened').children('.accordion_content').slideToggle();
		};
	})
})