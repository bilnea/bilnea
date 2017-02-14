jQuery(function($) {
	$('.b_newsletters input:not([name="email"])').on('keyup', function() {
		var t = $(this);
		if (t.val() == '') {
			t.addClass('invalid').removeClass('valid');
		} else {
			t.addClass('valid').removeClass('invalid');
		}
	});
	$('.b_newsletters input[type="checkbox"][id^="s_legal-"]').change(function() {
		var t = $(this);
		if (t.is(':checked')) {
			t.addClass('valid').removeClass('invalid');
		} else {
			t.addClass('invalid').removeClass('valid');
		}
	});
	$('.b_newsletters input[name="email"]').on('keyup', function() {
		var t = $(this);
		if (t.val() == '') {
			t.addClass('invalid').removeClass('valid');
		} else {
			if (b_js_check_email(t.val())) {
				t.addClass('valid').removeClass('invalid');
			} else {
				t.addClass('invalid').removeClass('valid');
			}
		}
	});
	$('.b_newsletters .s_submit').on('click', function() {
		var f = $(this).closest('.b_newsletters'),
			g = 0,
			x = '',
			q = $(this),
			errors = [nws_errors.text];
		f.next('.response').html('');
		$(f.find($('[name="s_name"], [name="s_last"], [name="s_email"]'))).each(function() {
			var t = $(this);
			t.removeClass('invalid');
			if (t.val() == '') {
				t.addClass('invalid');
				g++;
				t = '1';
				errors.push(nws_errors.empty);
			};
		});
		if (f.find($('input[name$="email"]')).val() != '' && !b_js_check_email(f.find($('input[name$="email"]')).val())) {
			f.find($('input[name$="email"]')).addClass('invalid');
			g++;
			t = '2';
			errors.push(nws_errors.email);
		};
		$(f.find($('input[type="checkbox"][id^="s_legal-"]'))).each(function() {
			var t = $(this);
			if (t[0].checked == false) {
				t.addClass('invalid');
				g++;
				t = '5';
				errors.push(nws_errors.legal);
			};
		});
		if (g == 0) {
			var a = q.data('send'),
				b = q.data('sending');
			$.ajax({
				url: bilnea.root_url+'/wp-admin/admin-ajax.php',
				type: 'POST',
				data: f.find($(':input')).serialize()+'&action=b_mailchimpsubscribe',
				beforeSend: function() {
					q.text(b).addClass('sending');
				},
				success: function (data) {
					q.text(a).removeClass('sending');
					q.closest('.b_newsletters').next().html(data);
				}
			});
		} else {
			$.unique(errors);
			f.next('.response').html('<div class="errors">'+errors.join('. ')+'.</div>');
		}
	});
})