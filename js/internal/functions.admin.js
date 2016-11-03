console.log('bilnea Theme '+bilnea.version+'\n');

jQuery(function($) {
	var inp = 'input[name="bilnea_settings';
	$('.lateral h3').click(function() {
		if (!$(this).hasClass('active')) {
			$('.lateral h3').removeClass('active');
			$(this).addClass('active');
			var indice = $('.lateral h3').index(this);
			$('#pestanya').val(indice+1);
			$('.central .active').fadeOut(250, function() {
				$('.central .active').removeClass('active');
				$('.central > div:nth-child('+(indice+1)+')').fadeIn(250).addClass('active');
			})
		};
	})
	$('#subir_imagen').click(function(e) {
		e.preventDefault();
		var imagen = wp.media({
			title: 'Seleccionar imagen',
			multiple: false
		}).open().on(
			'select', function(e) {
				var imagen_sel = imagen.state().get('selection').first(),
					imagen_url = imagen_sel.toJSON().url;
				$('#logo_url').val(imagen_url);
				$('#logo_principal').attr('style', 'background-image: url('+imagen_url+')');
				$('#borra_logo').parent().show();
			}
		)
	})
	$('#subir_logo_inicio').click(function(e) {
		e.preventDefault();
		var imagen = wp.media({
			title: 'Seleccionar imagen',
			multiple: false
		}).open().on(
			'select', function(e) {
				var imagen_sel = imagen.state().get('selection').first(),
					imagen_url = imagen_sel.toJSON().url;
				$('#logo_url_login').val(imagen_url);
				$('#logo_inicio').attr('style', 'background-image: url('+imagen_url+')');
				$('#borra_logo_login').parent().show();
			}
		)
	})
	$('#subir_fav_main').click(function(e) {
		e.preventDefault();
		var imagen = wp.media({
			title: 'Seleccionar imagen',
			multiple: false
		}).open().on(
			'select', function(e) {
				var imagen_sel = imagen.state().get('selection').first(),
					imagen_url = imagen_sel.toJSON().url;
				$('#fav_main_url').val(imagen_url);
				$('#favicon_div').attr('style', 'background-image: url('+imagen_url+')');
				$('#borra_logo1').show();
			}
		)
	})
	$('#subir_iph_fav').click(function(e) {
		e.preventDefault();
		var imagen = wp.media({
			title: 'Seleccionar imagen',
			multiple: false
		}).open().on(
			'select', function(e) {
				var imagen_sel = imagen.state().get('selection').first(),
					imagen_url = imagen_sel.toJSON().url;
				$('#iph_fav_url').val(imagen_url);
				$('#iphone_div').attr('style', 'background-image: url('+imagen_url+')');
				$('#borra_logo2').show();
			}
		)
	})
	$('#subir_iph_ret').click(function(e) {
		e.preventDefault();
		var imagen = wp.media({
			title: 'Seleccionar imagen',
			multiple: false
		}).open().on(
			'select', function(e) {
				var imagen_sel = imagen.state().get('selection').first(),
					imagen_url = imagen_sel.toJSON().url;
				$('#iph_ret_url').val(imagen_url);
				$('#iphoneret_div').attr('style', 'background-image: url('+imagen_url+')');
				$('#borra_logo3').show();
			}
		)
	})
	$('#subir_ipa_fav').click(function(e) {
		e.preventDefault();
		var imagen = wp.media({
			title: 'Seleccionar imagen',
			multiple: false
		}).open().on(
			'select', function(e) {
				var imagen_sel = imagen.state().get('selection').first(),
					imagen_url = imagen_sel.toJSON().url;
				$('#ipa_fav_url').val(imagen_url);
				$('#ipad_div').attr('style', 'background-image: url('+imagen_url+')');
				$('#borra_logo4').show();
			}
		)
	})
	$('#subir_ipa_ret').click(function(e) {
		e.preventDefault();
		var imagen = wp.media({
			title: 'Seleccionar imagen',
			multiple: false
		}).open().on(
			'select', function(e) {
				var imagen_sel = imagen.state().get('selection').first(),
					imagen_url = imagen_sel.toJSON().url;
				$('#ipa_ret_url').val(imagen_url);
				$('#ipadret_div').attr('style', 'background-image: url('+imagen_url+')');
				$('#borra_logo5').show();
			}
		)
	})
	$('#subir_pos_log').click(function(e) {
		e.preventDefault();
		var imagen = wp.media({
			title: 'Seleccionar imagen',
			multiple: false
		}).open().on(
			'select', function(e) {
				var imagen_sel = imagen.state().get('selection').first(),
					imagen_url = imagen_sel.toJSON().url;
				$('#pos_logo_url').val(imagen_url);
				$('#positive_div').attr('style', 'background-image: url('+imagen_url+')');
				$('#borra_logo6').show();
			}
		)
	})
	$('#subir_neg_log').click(function(e) {
		e.preventDefault();
		var imagen = wp.media({
			title: 'Seleccionar imagen',
			multiple: false
		}).open().on(
			'select', function(e) {
				var imagen_sel = imagen.state().get('selection').first(),
					imagen_url = imagen_sel.toJSON().url;
				$('#neg_logo_url').val(imagen_url);
				$('#negative_div').attr('style', 'background-image: url('+imagen_url+')');
				$('#borra_logo7').show();
			}
		)
	})
	$('#logo_principal').click(function() {
		$('#subir_imagen').click();
	})
	$('#logo_inicio').click(function() {
		$('#subir_logo_inicio').click();
	})
	$('#favicon_div').click(function() {
		$('#subir_fav_main').click();
	})
	$('#iphone_div').click(function() {
		$('#subir_iph_fav').click();
	})
	$('#iphoneret_div').click(function() {
		$('#subir_iph_ret').click();
	})
	$('#ipad_div').click(function() {
		$('#subir_ipa_fav').click();
	})
	$('#ipadret_div').click(function() {
		$('#subir_ipa_ret').click();
	})
	$('#positive_div').click(function() {
		$('#subir_pos_log').click();
	})
	$('#negative_div').click(function() {
		$('#subir_neg_log').click();
	})
	$('.color').each(function() {
		var c = $(this).closest('.color-container').next().find($('.color-alt')).val();
		if (c != '') {
			$(this).spectrum({
				color: c,
				preferredFormat: "hex",
				flat: true,
				showInput: true,
				allowEmpty:true,
				showButtons: false
			});
		} else {
			$(this).spectrum({
				preferredFormat: "hex",
				flat: true,
				showInput: true,
				allowEmpty:true,
				showButtons: false
			});
		}
	});
	$('.colorp').each(function() {
		var t = $(this),
			c = t.prev().val();
		if (c == '') {
			c = t.prev().attr('placeholder');
		};
		t.spectrum({
			color: c,
			preferredFormat: "rgb",
			allowEmpty:true,
			showButtons: false,
			showAlpha: false,
			clickoutFiresChange: true,
			move: function(color) {
				t.prev().val(color.toRgbString());
			}
		});
	});
	$('.colora').each(function() {
		var t = $(this),
			c = t.prev().val();
		if (c == '') {
			c = t.prev().attr('placeholder');
		};
		t.spectrum({
			color: c,
			preferredFormat: "rgb",
			allowEmpty:true,
			showButtons: false,
			showAlpha: true,
			clickoutFiresChange: true,
			move: function(color) {
				t.prev().val(color.toRgbString());
			}
		});
	});
	$('#borra_logo').click(function() {
		$('#logo_url').val('');
		$('#logo_principal').attr('style', 'background-image: url('+img_url+')');
		$('#borra_logo').parent().hide();
	})
	$('#borra_logo1').click(function() {
		$('#fav_main_url').val('');
		$('#favicon_div').attr('style', 'background-image: url()');
		$('#borra_logo1').hide();
	})
	$('#borra_logo2').click(function() {
		$('#iph_fav_url').val('');
		$('#iphone_div').attr('style', 'background-image: url()');
		$('#borra_logo2').hide();
	})
	$('#borra_logo3').click(function() {
		$('#iph_ret_url').val('');
		$('#iphoneret_div').attr('style', 'background-image: url()');
		$('#borra_logo3').hide();
	})
	$('#borra_logo4').click(function() {
		$('#ipa_fav_url').val('');
		$('#ipad_div').attr('style', 'background-image: url()');
		$('#borra_logo4').hide();
	})
	$('#borra_logo5').click(function() {
		$('#ipa_ret_url').val('');
		$('#ipadret_div').attr('style', 'background-image: url()');
		$('#borra_logo5').hide();
	})
	$('#borra_logo6').click(function() {
		$('#pos_logo_url').val('');
		$('#positive_div').attr('style', 'background-image: url()');
		$('#borra_logo6').hide();
	})
	$('#borra_logo7').click(function() {
		$('#neg_logo_url').val('');
		$('#negative_div').attr('style', 'background-image: url()');
		$('#borra_logo7').hide();
	});
	$('input.disabler').each(function() {
		var t = $(this),
			d = t.attr('data-connect');
		if (t.is('[data-reverse]')) {
			if (t.is(':checked')) {
				var c = true;
			} else {
				var c = false;
			}
		} else {
			if (t.is(':checked')) {
				var c = false;
			} else {
				var c = true;
			}
		}
		if (c == false) {
			$('[data-connect="'+d+'"]:not(input)').css('color', 'inherit');
			$('[data-connect="'+d+'"]:not(input) input, [data-connect="'+d+'"]:not(input) select').each(function() {
				var e = $(this);
				e.removeAttr('disabled');
			});
		} else {
			$('[data-connect="'+d+'"]:not(input)').css('color', '#999');
			$('[data-connect="'+d+'"]:not(input) input, [data-connect="'+d+'"]:not(input) select').each(function() {
				var e = $(this);
				e.attr('disabled', 'disabled');
				e.prop('checked', false);
			});
			$('[data-connect="'+d+'"]:not(input) [data-connect]').each(function() {
				var p = $(this);
				p.css('color', '#999');
				p.find($('input, select')).each(function() {
					var e = $(this);
					e.attr('disabled', 'disabled');
					e.prop('checked', false);
				});
			});
		};
	});
	$('input.disabler').change(function() {
		var t = $(this),
			d = t.attr('data-connect');
		if (t.is('[data-reverse]')) {
			if (t.is(':checked')) {
				var c = true;
			} else {
				var c = false;
			}
		} else {
			if (t.is(':checked')) {
				var c = false;
			} else {
				var c = true;
			}
		}
		if (c == false) {
			$('[data-connect="'+d+'"]:not(input)').css('color', 'inherit');
			$('[data-connect="'+d+'"]:not(input) input, [data-connect="'+d+'"]:not(input) select').each(function() {
				var e = $(this);
				e.removeAttr('disabled');
			});
		} else {
			$('[data-connect="'+d+'"]:not(input)').css('color', '#999');
			$('[data-connect="'+d+'"]:not(input) input, [data-connect="'+d+'"]:not(input) select').each(function() {
				var e = $(this);
				e.attr('disabled', 'disabled');
				e.prop('checked', false);
			});
			$('[data-connect="'+d+'"]:not(input) [data-connect]').each(function() {
				var p = $(this);
				p.css('color', '#999');
				p.find($('input, select')).each(function() {
					var e = $(this);
					e.attr('disabled', 'disabled');
					e.prop('checked', false);
				});
			});
		};
	});


/*

	if ($(inp+'[b_opt_body_boxed]"]').is(':checked')) {
		$(inp+'[header_width]"][value="2"]').attr('checked', 'checked');
		$(inp+'[header_width]"]').attr('disabled', 'disabled');
		$(inp+'[header_width]"]').prop('checked', false);
		$(inp+'[header_width]"] + span').css('color', '#999');
		$(inp+'[b_opt_menu-width]"][value="2"]').attr('checked', 'checked');
		$(inp+'[b_opt_menu-width]"]').attr('disabled', 'disabled');
		$(inp+'[b_opt_menu-width]"]').prop('checked', false);
		$(inp+'[b_opt_menu-width]"] + span').css('color', '#999');
		$(inp+'[footer_width]"][value="2"]').attr('checked', 'checked');
		$(inp+'[footer_width]"]').attr('disabled', 'disabled');
		$(inp+'[footer_width]"]').prop('checked', false);
		$(inp+'[footer_width]"] + span').css('color', '#999');
		$(inp+'[socket_width]"][value="2"]').attr('checked', 'checked');
		$(inp+'[socket_width]"]').attr('disabled', 'disabled');
		$(inp+'[socket_width]"]').prop('checked', false);
		$(inp+'[socket_width]"] + span').css('color', '#999');
		$('.header_notice').show();
	} else {
		$(inp+'[header_width]"]').removeAttr('disabled');
		$(inp+'[header_width]"] + span').css('color', '#444');
		$(inp+'[b_opt_menu-width]"]').removeAttr('disabled');
		$(inp+'[b_opt_menu-width]"] + span').css('color', '#444');
		$(inp+'[footer_width]"]').removeAttr('disabled');
		$(inp+'[footer_width]"] + span').css('color', '#444');
		$(inp+'[socket_width]"]').removeAttr('disabled');
		$(inp+'[socket_width]"] + span').css('color', '#444');
		$('.header_notice').hide();
	}
	$(inp+'[b_opt_body_boxed]"]').change(function() {
		if (this.checked) {
			$(inp+'[header_width]"][value="2"]').attr('checked', 'checked');
			$(inp+'[header_width]"]').attr('disabled', 'disabled');
			$(inp+'[header_width]"]').prop('checked', false);
			$(inp+'[header_width]"] + span').css('color', '#999');
			$(inp+'[b_opt_menu-width]"][value="2"]').attr('checked', 'checked');
			$(inp+'[b_opt_menu-width]"]').attr('disabled', 'disabled');
			$(inp+'[b_opt_menu-width]"]').prop('checked', false);
			$(inp+'[b_opt_menu-width]"] + span').css('color', '#999');
			$(inp+'[footer_width]"][value="2"]').attr('checked', 'checked');
			$(inp+'[footer_width]"]').attr('disabled', 'disabled');
			$(inp+'[footer_width]"]').prop('checked', false);
			$(inp+'[footer_width]"] + span').css('color', '#999');
			$(inp+'[socket_width]"][value="2"]').attr('checked', 'checked');
			$(inp+'[socket_width]"]').attr('disabled', 'disabled');
			$(inp+'[socket_width]"]').prop('checked', false);
			$(inp+'[socket_width]"] + span').css('color', '#999');
			$('.header_notice').show();
		} else {
			$(inp+'[header_width]"]').removeAttr('disabled');
			$(inp+'[header_width]"] + span').css('color', '#444');
			$(inp+'[b_opt_menu-width]"]').removeAttr('disabled');
			$(inp+'[b_opt_menu-width]"] + span').css('color', '#444');
			$(inp+'[footer_width]"]').removeAttr('disabled');
			$(inp+'[footer_width]"] + span').css('color', '#444');
			$(inp+'[socket_width]"]').removeAttr('disabled');
			$(inp+'[socket_width]"] + span').css('color', '#444');
			$('.header_notice').hide();
		}
	});
	if ($(inp+'[header_rrss]"]').is(':checked')) {
		$(inp+'[header_rrss_donde]"]').removeAttr('disabled');
		$(inp+'[header_rrss_donde]"] + span').css('color', '#444');
	} else {
		$(inp+'[header_rrss_donde]"]').attr('disabled', 'disabled');
		$(inp+'[header_rrss_donde]"]').prop('checked', false);
		$(inp+'[header_rrss_donde]"] + span').css('color', '#999');
	}
	$(inp+'[header_rrss]"]').change(function() {
		if (this.checked) {
			$(inp+'[header_rrss_donde]"]').removeAttr('disabled');
			$(inp+'[header_rrss_donde]"] + span').css('color', '#444');

			
		} else {
			$(inp+'[header_rrss_donde]"]').attr('disabled', 'disabled');
			$(inp+'[header_rrss_donde]"]').prop('checked', false);
			$(inp+'[header_rrss_donde]"] + span').css('color', '#999');
		}
	});
	if ($(inp+'[b_opt_header-search]"]').is(':checked')) {
		$(inp+'[b_opt_header-search-location]"]').removeAttr('disabled');
		$(inp+'[b_opt_header-search-location]"] + span').css('color', '#444');
	} else {
		$(inp+'[b_opt_header-search-location]"]').attr('disabled', 'disabled');
		$(inp+'[b_opt_header-search-location]"]').prop('checked', false);
		$(inp+'[b_opt_header-search-location]"] + span').css('color', '#999');
	}
	$(inp+'[b_opt_header-search]"]').change(function() {
		if (this.checked) {
			$(inp+'[b_opt_header-search-location]"]').removeAttr('disabled');
			$(inp+'[b_opt_header-search-location]"] + span').css('color', '#444');
			
		} else {
			$(inp+'[b_opt_header-search-location]"]').attr('disabled', 'disabled');
			$(inp+'[b_opt_header-search-location]"]').prop('checked', false);
			$(inp+'[b_opt_header-search-location]"] + span').css('color', '#999');
		}
	});
	if ($('select[name="bilnea_settings[header_menu]"]').val() != 2) {
		$(inp+'[header_logo_align]"]').removeAttr('disabled');
		$(inp+'[header_logo_align]"] + span').css('color', '#444');
	} else {
		$(inp+'[header_logo_align]"]').attr('disabled', 'disabled');
		$(inp+'[header_logo_align]"]').prop('checked', false);
		$(inp+'[header_logo_align]"] + span').css('color', '#999');
	}
	$('select[name="bilnea_settings[header_menu]"]').on('change', function() {
		if (this.value != 2) {
			$(inp+'[header_logo_align]"]').removeAttr('disabled');
			$(inp+'[header_logo_align]"] + span').css('color', '#444');
		} else {
			$(inp+'[header_logo_align]"]').attr('disabled', 'disabled');
			$(inp+'[header_logo_align]"]').prop('checked', false);
			$(inp+'[header_logo_align]"] + span').css('color', '#999');
		}
	});
	if ($(inp+'[b_opt_lightbox]"]').is(':checked')) {
		$(inp+'[b_opt_lightbox-location]"]').removeAttr('disabled');
		$(inp+'[b_opt_lightbox-location]"]').parent().css('color', '#444');
		if (!$(inp+'[b_opt_lightbox-location]"]:checked').val()) {
			$(inp+'[b_opt_lightbox-location]"][value="1"]').attr('checked', 'checked');
		}
	} else {
		$(inp+'[b_opt_lightbox-location]"]').attr('disabled', 'disabled');
		$(inp+'[b_opt_lightbox-location]"]').prop('checked', false);
		$(inp+'[b_opt_lightbox-location]"]').parent().css('color', '#999');
	}
	$(inp+'[b_opt_lightbox]"]').change(function() {
		if (this.checked) {
			$(inp+'[b_opt_lightbox-location]"]').removeAttr('disabled');
			$(inp+'[b_opt_lightbox-location]"]').parent().css('color', '#444');
			if (!$(inp+'[b_opt_lightbox-location]"]:checked').val()) {
				$(inp+'[b_opt_lightbox-location]"][value="1"]').attr('checked', 'checked');
			}
		} else {
			$(inp+'[b_opt_lightbox-location]"]').attr('disabled', 'disabled');
			$(inp+'[b_opt_lightbox-location]"]').prop('checked', false);
			$(inp+'[b_opt_lightbox-location]"]').parent().css('color', '#999');
		}
	});
	if ($(inp+'[b_opt_smtp]"]').is(':checked')) {
		$(inp+'[b_opt_smtp-server]"]').removeAttr('disabled').prev().css('color', '#444');
		$(inp+'[b_opt_smtp-user]"]').removeAttr('disabled').prev().css('color', '#444');
		$(inp+'[b_opt_smtp-pass]"]').removeAttr('disabled').prev().css('color', '#444');
		$(inp+'[b_opt_smtp-port]"]').removeAttr('disabled').prev().css('color', '#444');
	} else {
		$(inp+'[b_opt_smtp-server]"]').attr('disabled', 'disabled').prev().css('color', '#999');
		$(inp+'[b_opt_smtp-user]"]').attr('disabled', 'disabled').prev().css('color', '#999');
		$(inp+'[b_opt_smtp-pass]"]').attr('disabled', 'disabled').prev().css('color', '#999');
		$(inp+'[b_opt_smtp-port]"]').attr('disabled', 'disabled').prev().css('color', '#999');
	}
	$(inp+'[b_opt_smtp]"]').change(function() {
		if (this.checked) {
			$(inp+'[b_opt_smtp-server]"]').removeAttr('disabled').prev().css('color', '#444');
			$(inp+'[b_opt_smtp-user]"]').removeAttr('disabled').prev().css('color', '#444');
			$(inp+'[b_opt_smtp-pass]"]').removeAttr('disabled').prev().css('color', '#444');
			$(inp+'[b_opt_smtp-port]"]').removeAttr('disabled').prev().css('color', '#444');
		} else {
			$(inp+'[b_opt_smtp-server]"]').attr('disabled', 'disabled').prev().css('color', '#999');
			$(inp+'[b_opt_smtp-user]"]').attr('disabled', 'disabled').prev().css('color', '#999');
			$(inp+'[b_opt_smtp-pass]"]').attr('disabled', 'disabled').prev().css('color', '#999');
			$(inp+'[b_opt_smtp-port]"]').attr('disabled', 'disabled').prev().css('color', '#999');
		}
	});

*/
	$('.font-selector').each(function() {
		var t = $(this),
			s = t.find(':selected').attr('data').split(',');
		t.closest('.text-container').find('input[type="radio"]').each(function() {
			var r = $(this);
			if ($.inArray(r.val(), s) == -1) {
				r.attr('disabled', 'disabled');
			};
		})
	})
	$('.font_styles').each(function() {
		var t = $(this);
		if (!t.find('input[type="radio"]:checked').val()) {
			t.find('input[type="radio"]').each(function() {
				var c = $(this),
					v = c.val().substring(0, 3);
				if (v >= 400) {
					c.attr('checked', 'checked');
					return (v < 400);
				}
			})
		};
	});
	$('.font-selector').change(function() {
		var t = $(this),
			s = t.find(':selected').attr('data').split(',');
		t.closest('.text-container').find('input[type="radio"]').each(function() {
			var r = $(this);
			r.removeAttr('disabled');
			if ($.inArray(r.val(), s) == -1) {
				r.prop('checked', false).attr('disabled', 'disabled');
			};
		})
		if (!t.closest('.text-container').find('input[type="radio"]:checked').val()) {
			t.closest('.text-container').find('input[type="radio"]').each(function() {
				var c = $(this),
					v = c.val().substring(0, 3);
				if (v >= 400) {
					c.click();
					return (v < 400);
				}
			})
		};
	})
	$('input[type="radio"][name*="ttf-style"]').click(function() {
		var n = $(this).attr('name');
		$('input[type="radio"][name="'+n+'"]').not(this).removeAttr('checked');
	});
	$('.sp-input').on('keyup change', function() {
		$(this).next().spectrum('set', $(this).val());
	});
	$('select').select2();
})