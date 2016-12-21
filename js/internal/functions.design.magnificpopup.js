jQuery(function($) {
	$('[href*="youtu.be"]:not([href*="/user/"])').each(function() {
		var t = $(this);
		t.attr('href', t.attr('href').replace('youtu.be/', 'youtube.com/watch?v='));
	});
	$('a[rel*="gal"]').each(function() {
		var t = $(this),
			r = t.attr('rel');
		if (!t.parent().hasClass('b_gallery')) {
			t.parent().addClass('b_gallery');
		};
	});
	$('.b_gallery').each(function() {
		$(this).magnificPopup({
			delegate: 'a',
			type: 'image',
			gallery: {
				enabled: true,
				tCounter: '<span class="mfp-counter">%curr% '+magnificpopup.labels.of+' %total%</span>'
			}
		});
	});
	$('*:not(.b_gallery) > a[href$=".jpg"], *:not(.b_gallery) > a[href$=".jpeg"], *:not(.b_gallery) > a[href$=".gif"], *:not(.b_gallery) > a[href$=".png"]').magnificPopup({
		type: 'image'
	});
	$('a[href*="youtube.com"]:not([href*="/user/"]):not([href*="/channel/"]), a[href*="vimeo.com"]').magnificPopup({
		type: 'iframe',
		patterns: {
			youtube: {
				index: 'youtube.com/', 
				id: 'v=', 
				src: '//www.youtube.com/embed/%id%?autoplay=1' 
			},
			vimeo: {
				index: 'vimeo.com/',
				id: '/',
				src: '//player.vimeo.com/video/%id%?autoplay=1'
			}
		},
		srcAction: 'iframe_src', 
	})
	$('a[href$=".mp4"], a[href$=".m4v"], a[href$=".mp3"], a[href$=".m4a"], a[href$=".mov"], a[href$=".webm"], a[href$=".mpg"], a[href$=".mpeg"], a[href$=".ogg"], a[href$=".ogm"], a[href$=".wmv"]').each(function() {
		var t = $(this),
			url_vid = t.attr('href'),
			vars = { type: 'video', variable: encodeURIComponent(url_vid), action: 'b_shortcode' }
		if (t.has('img') && t.text() == '') {
			data['image'] = encodeURIComponent(t.find($('img')).attr('src'));
		}
		$.ajax({
			url: bilnea.main_uri+'/wp-admin/admin-ajax.php',
			type: 'POST',
			data: vars,
			success: function (data) {
				t.magnificPopup({
					type:'inline',
					items: {
						src: data 
					}
				});
			}
		});
	});
})