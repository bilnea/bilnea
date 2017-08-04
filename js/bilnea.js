jQuery(function($) {
	var hh = $('header#header').outerHeight();
	$('header#header.sticky + .content-wrapper').css('padding-top', hh);
	$('aside#sidebar').prev().addClass('has-sidebar');
	$('a').each(function() {
		$(this).attr('data-ajax','false');
		if ($(this).text().replace(/\s+/g, '') == '' && $(this).find($('img')).length) {
			$(this).addClass('image-link');
		};
	})
	$('.x11, .x12, .x13, .x14, .x15, .x16, .x17, .x18, .x19, .x10, .x23, .x25, .x34, .x35, .x45, .x27, .x29, .x56, .x37, .x38, .x30, .x47, .x49, .x40, .x57, .x58, .x59, .x67, .x78, .x79, .x70, .x89, .x90').each(function() {
		if (!$(this).parent().hasClass('row') && !$(this).parent().hasClass('post')) { $(this).parent().addClass('row'); };
	})
	$('.row').each(function() {
		var t = 0;
		$(this).children().each(function() {
			if (t == 0 || t >= 1) {
				$(this).addClass('first');
				t = 0;
			};
			switch (true) {
				case $(this).hasClass('x11'):
					t += (1/1); break;
				case $(this).hasClass('x12'):
					t += (1/2); break;
				case $(this).hasClass('x13'):
					t += (1/3); break;
				case $(this).hasClass('x14'):
					t += (1/4); break;
				case $(this).hasClass('x15'):
					t += (1/5); break;
				case $(this).hasClass('x16'):
					t += (1/6); break;
				case $(this).hasClass('x17'):
					t += (1/7); break;
				case $(this).hasClass('x18'):
					t += (1/8); break;
				case $(this).hasClass('x19'):
					t += (1/9); break;
				case $(this).hasClass('x10'):
					t += (1/10); break;
				case $(this).hasClass('x23'):
					t += (2/3); break;
				case $(this).hasClass('x25'):
					t += (2/5); break;
				case $(this).hasClass('x34'):
					t += (3/4); break;
				case $(this).hasClass('x35'):
					t += (3/5); break;
				case $(this).hasClass('x45'):
					t += (4/5); break;
				case $(this).hasClass('x27'):
					t += (2/7); break;
				case $(this).hasClass('x29'):
					t += (2/9); break;
				case $(this).hasClass('x56'):
					t += (5/6); break;
				case $(this).hasClass('x37'):
					t += (3/7); break;
				case $(this).hasClass('x38'):
					t += (3/8); break;
				case $(this).hasClass('x30'):
					t += (3/10); break;
				case $(this).hasClass('x47'):
					t += (4/7); break;
				case $(this).hasClass('x49'):
					t += (4/9); break;
				case $(this).hasClass('x40'):
					t += (4/10); break;
				case $(this).hasClass('x57'):
					t += (5/7); break;
				case $(this).hasClass('x58'):
					t += (5/8); break;
				case $(this).hasClass('x59'):
					t += (5/9); break;
				case $(this).hasClass('x67'):
					t += (6/7); break;
				case $(this).hasClass('x78'):
					t += (7/8); break;
				case $(this).hasClass('x79'):
					t += (7/9); break;
				case $(this).hasClass('x70'):
					t += (7/10); break;
				case $(this).hasClass('x89'):
					t += (8/9); break;
				case $(this).hasClass('x90'):
					t += (9/10); break;
			}
		});
		$(this).children().each(function() {
			if ($(this).hasClass('first')) {
				$(this).prev().addClass('last');
			};
		});
		$(this).children().last().addClass('last');
	});
	$('.selector-idioma-superior.desplegable > li > a').click(function(e) {
		e.preventDefault();
		$('.selector-idioma-superior.desplegable ul:visible').fadeOut(400);
		$('.selector-idioma-superior.desplegable ul:hidden').fadeIn(400);
	});
	$('.selector-idioma-superior.desplegable > li ul > li').mouseenter(function() {
		$('.selector-idioma-superior.desplegable > li ul').removeClass('visible');
	});
	$('.selector-idioma-superior.desplegable > li ul > li').mouseleave(function(event) {
		$('.selector-idioma-superior.desplegable > li ul').addClass('visible');
		setTimeout(b_js_hover(), 500);
	});
	$('#commentform #b_sdiv').insertBefore($('#comment_post_ID').parent());
	$('#commentform #submit').click(function(e) {
		var f = $('#commentform'),
			a = 0;
		$(f.find($('#author, #email, #comment'))).each(function() {
			var t = $(this);
			t.removeClass('invalido');
			if (t.val() == '') {
				t.addClass('invalido');
				a++;
			};
		})
		if(f.find($('#email')).val() != '' && !b_js_check_email(f.find($('#email')).val())) {
			f.find($('#email')).addClass('invalido');
			a++;
		}
		$(f.find($('#b_schk'))).each(function() {
			var t = $(this);
			if (t[0].checked == false) {
				t.parent().addClass('invalido');
				a++;
			};
		})
		$(f.find($('#b_schk'))).next().click(function() {
			var t = $(this);
			t.parent().removeClass('invalido');
		})
		$(f.find($('#author.invalido, #email.invalido, #comment.invalido'))).on('click focus', function() {
			jQuery(this).removeClass('invalido');
		})
		if (a != 0) {
			e.preventDefault();
		};
	});
	$('input[type="checkbox"]').each(function() {
		var t = $(this);
		$('<div class="fix-check"></div>').insertAfter(t);
		$('<label for="'+t.attr('id')+'"></label>').appendTo(t.next());
		t.prependTo(t.next());
	})
	$('.mobile-button').click(function() {
		$('.sub-menu').hide();
		if (!$(this).hasClass('active')) {
			$(this).addClass('active');
			$('html,body').animate({
					scrollTop: 0
			}, 400, function() {
				$('#mobile-header, body').addClass('menu-fixed');
				$('#mobile-menu').addClass('open');
				b_js_animate();
			});
		} else {
			$(this).removeClass('active');
			$('html,body').animate({
					scrollTop: 0
			}, 400, function() {
				$('#mobile-header, body').removeClass('menu-fixed');
				$('#mobile-menu').removeClass('open');
			});
			jQuery('.animate').removeClass('animate');
		}
	});
	$('#mobile-header .menu-item-has-children').click(function() {
		if ($(this).hasClass('open')) {
			$(this).find('.sub-menu').hide();
			$('#mobile-header .menu-item').removeClass('open');
		} else {
			$('li.open .sub-menu').hide();
			$('#mobile-header .menu-item').removeClass('open');
			$(this).find('.sub-menu').show();
			$(this).addClass('open')
		};
	});
	b_js_center_logo();
});

jQuery(window).on('resize', function() {
	b_js_center_logo();
})

jQuery(window).on('load resize', function() {
	b_js_adjust_height();
})

jQuery(window).on('load scroll', function() {
	var a = jQuery(window).scrollTop();
	if (a > 0) {
		jQuery('header#header').addClass('scrolled');
	} else {
		jQuery('header#header').removeClass('scrolled');
	}
})

function b_js_adjust_height() {
	jQuery('.auto-height').each(function() {
		var a = 0;
		jQuery(this).siblings('.auto-height').each(function() {
			var b = jQuery(this).outerHeight();
			if (b > a) { a = b; };
		});
		jQuery(this).parent().children('.auto-height').outerHeight(a);
	})
}

function b_js_center_logo() {
	var a = jQuery('header#header .header').outerHeight(),
		b = jQuery('header#header .logo_wrapper').outerHeight(),
		c = jQuery('header#header nav').outerHeight();
	if (jQuery('header#header .logo_wrapper').css('display') == 'inline-block' && a > b) {
		d = ((a - b) / 2);
		jQuery('header#header .logo_wrapper').css('margin', d+'px 0');
	};
}

function b_js_hover() {
	jQuery('.selector-idioma-superior.desplegable ul.visible').fadeOut(400).removeClass('visible');
}

function b_js_leading_zeros(str, max) {
	return str.length < max ? b_js_leading_zeros('0'+str, max) : str;
}

function b_js_animate() {
	jQuery('#mobile-menu #main_menu > ul > li').each(function(index) {
		var t = jQuery(this);
		setTimeout(function(){
			t.children('a').addClass('animate');
		}, index*60);
	});
}

function b_js_shortcode_generator(attr) {
	jQuery.post(main_theme+'/inc/shortcode.generator.php', {shortcode: encodeURIComponent(attr)}).done(function(data) {
    	return data;
	});
}

function b_js_check_email(email) {
	var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	return re.test(email);
}