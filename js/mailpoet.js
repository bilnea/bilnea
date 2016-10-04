jQuery(function() {
	jQuery('.widget_wysija_cont').each(function() {
		var t = jQuery(this);
		t.addClass('mailpoet');
		t.find(jQuery('.mailpoet input:not([type="submit"])')).addClass('input');
		t.find(jQuery('[class*="validate"][class*="email"]')).each(function() {
			jQuery(this).addClass('email');
		})
		t.find(jQuery('[class*="validate"][class*="required"]')).each(function() {
			jQuery(this).addClass('required');
		})
		t.find(jQuery('[class*="validate"][class*="required"]')).each(function() {
			jQuery(this).removeClass (function (index, css) {
				return (css.match (/(^|\s)validate\S+/g) || []).join(' ');
			});
		})
	});
	jQuery('.wysija-submit').each(function() {
		var t = jQuery(this),
			f = t.closest('form');
		var ran = 1 + Math.floor(Math.random() * 99999);
		t.before('<div class="fix-check"><input class="input required" id="legal-'+ran+'" type="checkbox" name="legal"><label for="legal-'+ran+'"></label></div><p>'+mailpoetbilnea.text+'</p>');
		t.click(function(e) {
			e.preventDefault();
			var a = 0;
			f.find(jQuery('.required')).each(function() {
				var x = jQuery(this);
				x.removeClass('invalid');
				if (x.val() == '') {
					x.addClass('invalid');
					a++;
				};
			})
			f.find(jQuery('.required.email')).each(function() {
				var x = jQuery(this);
				if(x.val() != '' && !b_js_check_email(x.val())) {
					x.addClass('invalid');
					a++;
				}
			})
			f.find(jQuery('input.required[type="checkbox"]')).each(function() {
				var x = jQuery(this);
				if (x[0].checked == false) {
					x.parent().addClass('invalid');
					a++;
				};
			})
			jQuery(f.find(jQuery('input.required[type="checkbox"]'))).next().click(function() {
				var x = jQuery(this);
				x.parent().removeClass('invalid');
			})
			f.find(jQuery('.required.invalid')).on('click focus', function() {
				jQuery(this).removeClass('invalid');
			})
			if (a == 0) {
				f.submit();
			}
		})
	});
})