jQuery(function($) {

	$('select[name^="b_i_select"]').on('change', function() {
		$(this).addClass('selected');
	});

	$('form[data-id]').each(function() {

		var f = $(this),
			r = $(this).attr('data-id'),
			x = {};

		f.children('.elementor-row').each(function() {
			var t = $(this),
				c = Math.round(100/t.children().length);
			if (t.html() == '') {
				t.remove();
			}
			t.children('.elementor-column').addClass('elementor-col-'+c);
		});

		$(this).find('[data-name]').each(function() {
			var t = $(this);
			x[t.attr('name')] = t.attr('data-name');
		});

		$(this).find('[name="b_i_names"]').val(JSON.stringify(x));

		f.find('input.captcha').on('keyup', function() {
			var k = event.keyCode || event.charCode,
				i = f.find('input.captcha');
			if (($(this).val().length === this.size) && k != 32) {
				i.eq(i.index(this) + 1).focus();
			} 
			if (k == 8 || k == 46) {
				var j = i.index(this);
				if (j != 0) {
					i.eq(i.index(this)-1).val('').focus();
				}
			}
		});

		f.find('.input[data-required="true"]:not([data-type="email"])').on('keyup', function() {
			var t = $(this);
			if (t.val() == '') {
				t.closest('.form-control').addClass('invalid').removeClass('valid');
			} else {
				t.closest('.form-control').addClass('valid').removeClass('invalid');
			}
		});

		f.find('.input:not([data-required="true"])').on('keyup', function() {
			var t = $(this);
			if (t.val() == '') {
				t.closest('.form-control').removeClass('valid');
			} else {
				t.closest('.form-control').addClass('valid');
			}
		});
		f.find('input.captcha[data-required="true"]').on('keyup', function() {
			var t = $(this),
				p = t.attr('placeholder');
			if (t.val() == '') {
				t.closest('.form-control').addClass('invalid').removeClass('valid');
			} else {
				if (t.val() == p) {
					t.closest('.form-control').addClass('valid').removeClass('invalid');
				} else {
					t.closest('.form-control').addClass('invalid').removeClass('valid');
				}
			}
		});
		f.find('input[data-required="true"][type="checkbox"]').change(function() {
			var t = $(this);
			if (t.is(':checked')) {
				t.closest('.form-control').addClass('valid').removeClass('invalid');
			} else {
				t.closest('.form-control').addClass('invalid').removeClass('valid');
			}
		});
		f.find('.input[data-required="true"][data-type="email"]').on('keyup', function() {
			var t = $(this);
			if (t.val() == '') {
				t.closest('.form-control').addClass('invalid').removeClass('valid');
			} else {
				if (b_js_check_email(t.val())) {
					t.closest('.form-control').addClass('valid').removeClass('invalid');
				} else {
					t.closest('.form-control').addClass('invalid').removeClass('valid');
				}
			}
		});
		f.find('.form-send').click(function() {
			var m = $(this),
				g = 0,
				x = '',
				e = window['form_messages_'+r],
				p = [],
				errors = [e.text];
			f.find('.response').html('');
			f.find('input[data-reply="yes"]').each(function() {
				var t = $(this);
				p.push(t.val());
			});
			f.find('[name="b_i_reply"]').val(p.join(','));
			f.find('input[data-required="true"], textarea[data-required="true"]').each(function() {
				var t = $(this);
				t.removeClass('invalid');
				if (t.val() == '') {
					t.addClass('invalid');
					g++;
					t = '1';
					errors.push(e.empty);
				};
			});
			f.find('input[data-type="email"]').each(function() {
				var t = $(this);
				t.removeClass('invalid');
				if (t.val() != '' && !b_js_check_email(t.val())) {
					g++;
					t = '2';
					errors.push(e.email);
				}
			});
			f.find('input.captcha').each(function() {
				var t = $(this);
				if (t.val() != t.attr('placeholder')) {
					t.addClass('invalid');
					g++;
					t = '3';
					errors.push(e.captcha);
				};
			});
			f.find('select[data-required="true"]').each(function() {
				var t = $(this);
				if (t.children('option:selected').is(':disabled')) {
					t.addClass('invalid');
					g++;
					t = '4';
					errors.push(e.empty);
				};
			});
			f.find('input[data-required="true"][type="checkbox"][id^="legal-"]').each(function() {
				var t = $(this);
				if (t[0].checked == false) {
					t.addClass('invalid');
					g++;
					t = '5';
					errors.push(e.legal);
				};
			});
			f.find('input[data-required="true"][type="checkbox"]:not(.invalid)').each(function() {
				var t = $(this);
				if (t[0].checked == false) {
					t.addClass('invalid');
					g++;
					t = '5';
					errors.push(e.empty);
				};
			});
			f.find('input[data-required="true"][type="checkbox"]').next().click(function() {
				var t = $(this);
				t.parent().removeClass('invalid');
			});
			f.find('input[type="file"].invalid').each(function() {
				g++;
				t = '6';
				errors.push(e.empty);
			});
			f.find('.file-button.invalid').each(function() {
				g++;
				errors.push($(this).children('.text').text());
			});
			f.find('[data-required="true"].invalid').on('click focus', function() {
				$(this).removeClass('invalid');
			});
			if (g == 0) {
				var a = m.data('send'),
					b = m.data('sending');
				f.ajaxSubmit({
					beforeSubmit: function(arr, $form, options) {
						m.text(b).addClass('sending');
					},
					url: bilnea.site_url+'/wp-admin/admin-ajax.php',
					data: {
						eid: f.data('id'),
						action: 'b_send_form',
						redirect: f.find('input[name="b_i_redirect"]').val()
					},
					success: function(responseText, statusText, xhr, $form) {
						m.text(a).removeClass('sending');
						f.children('.response').html(responseText);
						if (f.find($('input[type="file"]')).length) {
							f.find($('input[type="file"]')).each(function() {
								var m = $(this).attr('data-init');
								$(this).prev('.file-button').children('.text').text(m);
							})
						};
					}
				});
			} else {
				$.unique(errors);
				f.find('.response').html('<div class="errors">'+errors.join('. ')+'.</div>');
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
		} else {
			t.prev().removeClass('invalid');
		}
		if (n.length == 0) {
			t.prev().children('.text').html('<span>'+t.attr('data-empty')+'</span>');
		} else {
			if (n.length == 1) {
				console.log(n);
				$('<span>'+n[0]+'</span>').appendTo(t.prev().children('.text'));
			} else if (n.length > 1) {
				$('<span>'+n.length+' '+e.files_selected+'</span>').appendTo(t.prev().children('.text'));
			};
        }
    });
})

jQuery(function($) {
	if ($('select[name^="b_i_custom_mailer"]').length) {
		$('select[name^="b_i_custom_mailer"]').on('change', function(e) {
			var t = $(this),
				v = t.val();
			t.closest('form').find(jQuery('[name="b_i_to"]')).val(v);
		});
	};
});