jQuery('form[data-id]').each(function() {
	var ran = jQuery(this).attr('data-id'),
		mailer = eval('form_'+ran).mailphp;

	jQuery(function() {
		jQuery('body').on('keyup', 'input.captcha', function() {
			var key = event.keyCode || event.charCode;
			var inputs = jQuery('input.captcha');
			if ((jQuery(this).val().length === this.size) && key != 32) {
				inputs.eq(inputs.index(this) + 1).focus();
			} 
			if( key == 8 || key == 46 ) {
				var indexNum = inputs.index(this);
				if(indexNum != 0) {
					inputs.eq(inputs.index(this) - 1).val('').focus();
				}
			}
		});
		jQuery('.input.required:not([name="email"])').on('keyup', function() {
			var t = jQuery(this);
			if (t.val() == '') {
				t.addClass('invalid').removeClass('valid');
			} else {
				t.addClass('valid').removeClass('invalid');
			}
		});
		jQuery('.input:not(required)').on('keyup', function() {
			var t = jQuery(this);
			if (t.val() == '') {
				t.removeClass('valid');
			} else {
				t.addClass('valid');
			}
		});
		jQuery('input.captcha.required').on('keyup', function() {
			var t = jQuery(this),
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
		jQuery('input.required[type="checkbox"]').change(function() {
			var t = jQuery(this);
			if (t.is(':checked')) {
				t.addClass('valid').removeClass('invalid');
			} else {
				t.addClass('invalid').removeClass('valid');
			}
		});
		jQuery('.input.required[name="email"]').on('keyup', function() {
			var t = jQuery(this);
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
		jQuery('#form-send').click(function() {
			var f = jQuery(this).prev(),
				g = 0;
			jQuery(f.find(jQuery('input.required, textarea.required'))).each(function() {
				var t = jQuery(this);
				t.removeClass('invalid');
				if (t.val() == '') {
					t.addClass('invalid');
					g++;
				};
			})
			if(f.find(jQuery('input[name="email"]')).val() != '' && !b_js_check_email(f.find(jQuery('input[name="email"]')).val())) {
				f.find(jQuery('input[name="email"]')).addClass('invalid');
				g++;
			}
			jQuery(f.find(jQuery('input.captcha'))).each(function() {
				var t = jQuery(this);
				if (t.val() != t.attr('placeholder')) {
					t.addClass('invalid');
					g++;
				};
			})
			jQuery(f.find(jQuery('select.required'))).each(function() {
				var t = jQuery(this);
				if (t.children('option:selected').is(':disabled')) {
					t.addClass('invalid');
					g++;
				};
			})
			jQuery(f.find(jQuery('input.required[type="checkbox"]'))).each(function() {
				var t = jQuery(this);
				if (t[0].checked == false) {
					t.addClass('invalid');
					g++;
				};
			})
			jQuery(f.find(jQuery('input.required[type="checkbox"]'))).next().click(function() {
				var t = jQuery(this);
				t.parent().removeClass('invalid');
			})
			jQuery(f.find(jQuery('input[type="file"].invalid'))).each(function() {
				g++
			})
			jQuery('.required.invalid').on('click focus', function() {
				jQuery(this).removeClass('invalid');
			})
			if (g == 0 && eval('form_'+ran).redirect == 'false') {
				var a = f.next().data('send'),
					b = f.next().data('sending');
				jQuery.ajax({
					url: mailer,
					type: 'POST',
					data: f.serialize()+'&cid='+f.find(jQuery('div.captcha')).data('id')+'&eid='+f.data('id'),
					beforeSend: function() {
						f.next().text(b).addClass('sending');
					},
					success: function (data) {
						f.next().text(a).removeClass('sending');
						f.next().next().html(data);
					}
				});
			};
			if (g == 0 && eval('form_'+ran).redirect == 'true') {
				jQuery.ajax({
					url: mailer,
					type: 'POST',
					data: f.serialize()+'&cid='+f.find(jQuery('div.captcha')).data('id')+'&eid='+f.data('id'),
					success: function (data) {
						window.location.replace(eval('form_'+ran).thanks);
					}
				});
			};
		})
	});
});

jQuery(function() {
	jQuery('.file-button > *').click(function() {
		jQuery(this).parent().next().click();
	})
	jQuery('input[type="file"]').change(function() {
		var n = [],
			t = jQuery(this);
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
				jQuery('<span>'+n[i]+'</span>').appendTo(t.prev().children('.text'));
			};
        }
    });
})