console.log('bilnea Theme '+bilnea.version+'\n');

jQuery(function($) {
	var inp = 'input[name="bilnea_settings';
	$('.lateral h3').click(function() {
		if (!$(this).hasClass('activo')) {
			$('.lateral h3').removeClass('activo');
			$(this).addClass('activo');
			var indice = $('.lateral h3').index(this);
			$('#tab').val(indice+1);
			$('.central .activo').fadeOut(250, function() {
				$('.central .activo').removeClass('activo');
				$('.central > div:nth-child('+(indice+1)+')').fadeIn(250).addClass('activo');
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
	$('#search-order').select2().on('select2:select', function(e){
		var s = $(e.params.data.element);
		var p = s.parent();
		if (p.length > 0) {
			s.data('select2-originaloptgroup', p);
		}
		s.detach().appendTo($(e.target));
		$(e.target).trigger('change');
	})
	$('#bilset select').select2();
	$('.lang-switcher:not(.current)').click(function() {
		var t = $(this),
			l = t.attr('data-lang');
		t.siblings('.current').removeClass('current');
		t.addClass('current');
		t.parent().next().children('.current').removeClass('current');
		t.parent().next().children('[data-lang="'+l+'"]').addClass('current');
	});
	$('.lang-wrapper > *:first-child').each(function() {
		$(this).addClass('current');
	});
	$('.wp-list-table tbody').sortable({
		revert: true,
		placeholder: {
			element: function(currentItem) {
				var tds = $('.wp-list-table tbody > tr:first-child > td:visible').length+1;
				return $('<tr class="bilnea-sortable-placeholder"><td colspan="'+tds+'">Mover aquí</td></tr>')[0];
			},
			update: function(container, p) {

			}
		},
		stop: function(container, p) {
				opts = {
					url: ajaxurl,
					type: 'POST',
					async: true,
					cache: false,
					dataType: 'json',
					data:{
						action: 'b_order_admin',
						sorting: $('.wp-list-table tbody').sortable('toArray').toString().replace(',,', ',')
					},
					success: function(response) {
						console.log('Elementos ordenados correctamente.');
						return; 
					},
					error: function(xhr,textStatus,e) {
						alert('Ha ocurrido un error al actualizar el orden de los elementos.');
						return; 
					}
				};
				$.ajax(opts);
				return;
			}
		});
	$('.wp-list-table tbody ul, .wp-list-table tbody li').disableSelection();
})