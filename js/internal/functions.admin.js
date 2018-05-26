console.log('bilnea Theme '+bilnea.version+'\n');

jQuery(function($) {

	$('[data-type="color"]').wpColorPicker();

	$('[data-type="settings"] h3').click(function() {
		if (!$(this).hasClass('activo')) {
			$('[data-type="settings"] h3').removeClass('activo');
			$(this).addClass('activo');
			var indice = $('[data-type="settings"] h3').index(this);
			$('#tab').val(indice+1);
			$('[data-type="settings"] main .activo').fadeOut(250, function() {
				$('[data-type="settings"] main .activo').removeClass('activo');
				$('[data-type="settings"] main > div:nth-child('+(indice+1)+')').fadeIn(250).addClass('activo');
			})
		};
	})



	$(document).ajaxSuccess(function(e, request, settings){
		if ($('.term-meta-featured-image-wrap').length > 0) {
			$('.term-meta-featured-image-wrap .thumbnail').css('background-image', 'none');
			$('.term-meta-featured-image-wrap input#term-meta-featured-image').val('');
		}
	});
	var inp = 'input[name="bilnea_settings';
	
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
				$('#favicon').attr('style', 'background-image: url('+imagen_url+')');
				$('#del-favicon').show();
			}
		)
	})
	$('#logo_inicio').click(function() {
		$('#subir_logo_inicio').click();
	})
	$('#favicon').click(function() {
		$('#subir_fav_main').click();
	})
	$('.color').each(function() {
		var c = $(this).closest('.color-container').next().find($('.color-alt')).val();
		if (c != '') {
			$(this).spectrum({
				color: c,
				preferredFormat: "rgb",
				flat: true,
				showInput: true,
				allowEmpty:true,
				showAlpha: true,
				showButtons: false
			});
		} else {
			$(this).spectrum({
				preferredFormat: "rgb",
				flat: true,
				showInput: true,
				allowEmpty:true,
				showAlpha: true,
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
			showAlpha: true,
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
	$('#del-favicon').click(function() {
		$('#fav_main_url').val('');
		$('#favicon').attr('style', 'background-image: url()');
		$('#del-favicon').hide();
	})
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
	$('[data-type="settings"] select').select2();
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
	$('.wp-list-table tbody ul, .wp-list-table tbody li').disableSelection();
})