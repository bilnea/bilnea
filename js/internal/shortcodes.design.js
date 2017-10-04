jQuery(function($) {

	$('.x11, .x12, .x13, .x14, .x15, .x16, .x17, .x18, .x19, .x10, .x23, .x25, .x34, .x35, .x45, .x27, .x29, .x56, .x37, .x38, .x30, .x47, .x49, .x40, .x57, .x58, .x59, .x67, .x78, .x79, .x70, .x89, .x90').each(function() {
		if (!$(this).parent().hasClass('row') && !$(this).parent().hasClass('post')) { $(this).parent().addClass('row'); };
	});

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
			};
		});

		$(this).children().each(function() {
			if ($(this).hasClass('first')) {
				$(this).prev().addClass('last');
			};
		});

		$(this).children().last().addClass('last');

	});

});