var hsc,
	lst = 0,
	eqx = 161,
	eqw = 70,
	mhh = jQuery('header#header').outerHeight(),
	mmh = jQuery('header#mobile-header').outerHeight();

jQuery(window).scroll(function(event){
	hsc = true;
});

setInterval(function() {
	if (hsc) {
		if (jQuery(window).width() < parseInt(menu.responsive.match(/\d+/)) && jQuery('.menu-movil .menu').is(':hidden')) {
			b_f_menm();
		} else {
			b_f_menu();
		}
		hsc = false;
	}
}, 250);

function b_f_menu() {
	var slt = jQuery(this).scrollTop();
	
	if(Math.abs(lst - slt) <= eqx) {
		return;
	}
	
	if (slt > lst && slt > mhh) {
		jQuery('header#header').removeClass('animated').addClass('static');
	} else {
		if(slt + jQuery(window).height() < jQuery(document).height()) {
			jQuery('header#header').removeClass('static').addClass('animated');
		}
	}
	
	lst = slt;
}

function b_f_menm() {
	var slt = jQuery(this).scrollTop();
	
	if(Math.abs(lst - slt) <= eqw) {
		return;
	}
	
	if (slt > lst && slt > mmh) {
		jQuery('.menu-movil').removeClass('fijo').addClass('movil');
	} else {
		if(slt + jQuery(window).height() < jQuery(document).height()) {
			jQuery('.menu-movil').removeClass('movil').addClass('fijo');
		}
	}
	
	lst = slt;
}