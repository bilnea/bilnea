function anticopia(e) {
	// listado de teclas no permitidas
	var nok = new Array('a', 'n', 'c', 'x', 'v', 'j', 'e'),
		key,
		ctr;
	if(window.event) {
		key = window.event.keyCode;
		if(window.event.ctrlKey||window.event.metaKey)
			ctr = true;
		else
			ctr = false;
	} else {
		key = e.which;
		if(e.ctrlKey||e.metaKey)
			ctr = true;
		else
			ctr = false;
	}
	if(ctr) {
		for(i=0; i<nok .length; i++) {
			if(nok[i].toLowerCase() == String.fromCharCode(key).toLowerCase()) {
				return false;
			}
		}
	}
	return true;
}