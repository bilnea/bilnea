jQuery(function($) {
	$('#comment_author, #comment_email, #comment_message').on('keyup', function() {
		var t = $(this);
		if (t.val() == '') {
			t.addClass('invalid').removeClass('valid');
		} else {
			t.addClass('valid').removeClass('invalid');
		}
	});
	$('#comment_email').on('keyup', function() {
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
	$('#commentform').on('submit', function(e) {
		var f = $(this),
			g = 0,
			x = '',
			errors = [comments_errors.text];
		f.parent().next('.response').html('');
		$(f.find($('#comment_author, #comment_email, #comment_message'))).each(function() {
			var t = $(this);
			t.removeClass('invalid');
			if (t.val() == '') {
				t.addClass('invalid');
				g++;
				t = '1';
				errors.push(comments_errors.empty);
			};
		});
		if (f.find($('#comment_email')).length && (f.find($('#comment_email')).val() != '' && !b_js_check_email(f.find($('#comment_email')).val()))) {
			f.find($('#comment_email')).addClass('invalid');
			g++;
			t = '2';
			errors.push(comments_errors.email);
		};
		if (g == 0) {
			go = true;
			f.submit();
		} else {
			e.preventDefault();
			$.unique(errors);
			f.parent().next('.response').html('<div class="errors">'+errors.join('. ')+'.</div>');
		}
	});
});