jQuery(function($) {

	var eliminar = [
		'.ui-loader'
	]
	$.each(eliminar, function(index, value) {
		$(value).remove();
	})
})