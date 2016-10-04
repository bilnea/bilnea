jQuery(function() {
	jQuery('.b_newsletters .s_submit').on('click', function() {
		var t = jQuery(this),
			n = t.parent().children('[name="s_name"]').val(),
			l = t.parent().children('[name="s_last"]').val() || '',
			e = t.parent().children('[name="s_email"]').val(),
			r = t.parent().children('.redirect_to').val();
		var data = {
			email: e,
			name: n,
			last: l,
			redirect: r,
			action: 'mailchimpsubscribe'
		}
		jQuery.ajax({
			url: bilnea.main_uri+'/wp-admin/admin-ajax.php',
			type: 'POST',
			data: data,
			success: function(data) {
				console.log(data);
				jQuery(data).appendTo('head');
			}
		});
	});
})