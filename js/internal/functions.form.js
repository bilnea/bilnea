jQuery(function($) {
	$('form[data-id]').each(function() {
		var ran = $(this).attr('data-id');
		var x = {};
		$(this).find($('[data-name]')).each(function() {
			var t = $(this);
			x[t.attr('name')] = t.attr('data-name');
		});
		$(this).find($('[name="b_i_names"]')).val(JSON.stringify(x));

		$('body').on('keyup', 'input.captcha', function() {
			var key = event.keyCode || event.charCode;
			var inputs = $('input.captcha');
			if (($(this).val().length === this.size) && key != 32) {
				inputs.eq(inputs.index(this) + 1).focus();
			} 
			if( key == 8 || key == 46 ) {
				var indexNum = inputs.index(this);
				if(indexNum != 0) {
					inputs.eq(inputs.index(this) - 1).val('').focus();
				}
			}
		});
		$('.input.required:not([name="email"])').on('keyup', function() {
			var t = $(this);
			if (t.val() == '') {
				t.addClass('invalid').removeClass('valid');
			} else {
				t.addClass('valid').removeClass('invalid');
			}
		});
		$('.input:not(required)').on('keyup', function() {
			var t = $(this);
			if (t.val() == '') {
				t.removeClass('valid');
			} else {
				t.addClass('valid');
			}
		});
		$('input.captcha.required').on('keyup', function() {
			var t = $(this),
				p = t.attr('placeholder');
			if (t.val() == '') {
				t.addClass('invalid').removeClass('valid');
			} else {
				if (t.val() == p) {
					t.addClass('valid').removeClass('invalid');
				} else {
					t.addClass('invalid').removeClass('valid');
				}
			}
		});
		$('input.required[type="checkbox"]').change(function() {
			var t = $(this);
			if (t.is(':checked')) {
				t.addClass('valid').removeClass('invalid');
			} else {
				t.addClass('invalid').removeClass('valid');
			}
		});
		$('.input.required[name="email"]').on('keyup', function() {
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
		$(this).find($('.form-send')).click(function() {
			var m = $(this);
			var f = $(this).closest('form'),
				g = 0,
				x = '',
				errors = [form_errors.text];
			f.next('.response').html('');
			$(f.find($('input.required, textarea.required'))).each(function() {
				var t = $(this);
				t.removeClass('invalid');
				if (t.val() == '') {
					t.addClass('invalid');
					g++;
					t = '1';
					errors.push(form_errors.empty);
				};
			});
			if (f.find($('input[name$="email"]')).val() != '' && !b_js_check_email(f.find($('input[name$="email"]')).val())) {
				f.find($('input[name$="email"]')).addClass('invalid');
				g++;
				t = '2';
				errors.push(form_errors.email);
			};
			$(f.find($('input.captcha'))).each(function() {
				var t = $(this);
				if (t.val() != t.attr('placeholder')) {
					t.addClass('invalid');
					g++;
					t = '3';
					errors.push(form_errors.captcha);
				};
			});
			$(f.find($('select.required'))).each(function() {
				var t = $(this);
				if (t.children('option:selected').is(':disabled')) {
					t.addClass('invalid');
					g++;
					t = '4';
					errors.push(form_errors.empty);
				};
			});
			$(f.find($('input.required[type="checkbox"][id^="legal-"]'))).each(function() {
				var t = $(this);
				if (t[0].checked == false) {
					t.addClass('invalid');
					g++;
					t = '5';
					errors.push(form_errors.legal);
				};
			});
			$(f.find($('input.required[type="checkbox"]:not(.invalid)'))).each(function() {
				var t = $(this);
				if (t[0].checked == false) {
					t.addClass('invalid');
					g++;
					t = '5';
					errors.push(form_errors.empty);
				};
			});
			$(f.find($('input.required[type="checkbox"]'))).next().click(function() {
				var t = $(this);
				t.parent().removeClass('invalid');
			});
			$(f.find($('input[type="file"].invalid'))).each(function() {
				g++;
				t = '6';
				errors.push(form_errors.empty);
			});
			$('.required.invalid').on('click focus', function() {
				$(this).removeClass('invalid');
			});
			if (g == 0) {
				var a = m.data('send'),
					b = m.data('sending'),
					data = new FormData(f);
				if (f.find($('[type="file"]')).length) {
					$.each(f.find($('[type="file"]'))[0].files, function(i, file) {
						data.append('file[]', file);
					});
				};
				data.append('cid', f.find($('div.captcha')).data('id'));
				data.append('eid', f.data('id'));
				data.append('action', 'b_send_form');
				$.ajax({
					url: bilnea.root_url+'/wp-admin/admin-ajax.php',
					type: 'POST',
					data: f.serialize()+'&cid='+f.find($('div.captcha')).data('id')+'&eid='+f.data('id')+'&redirect='+f.data('redirect')+'&action=b_send_form',
					beforeSend: function() {
						m.text(b).addClass('sending');
					},
					success: function (data) {
						m.text(a).removeClass('sending');
						m.closest('form').next().html(data);
					}
				});
			} else {
				$.unique(errors);
				f.next('.response').html('<div class="errors">'+errors.join('. ')+'.</div>');
			}
		})
	});
});

jQuery(function($) {
	$('.file-button > *').click(function() {
		$(this).parent().next().click();
	})
	$('input[type="file"]').change(function() {
		var n = [],
			t = $(this);
		t.prev().children('.text').html('');
		var s = 0;
		for (var i = 0; i < t.get(0).files.length; ++i) {
			n.push(t.get(0).files[i].name);
			s = s+t.get(0).files[i].size;
		}
		if (s > t.attr('data-size')) {
			t.prev().addClass('invalid');
			n = [t.attr('data-size-error')];
		}
		if (n.length == 0) {
			t.prev().children('.text').html('<span>'+t.attr('data-empty')+'</span>');
		} else {
			for (var i = 0; i < n.length; i++) {
				$('<span>'+n[i]+'</span>').appendTo(t.prev().children('.text'));
			};
        }
    });
})