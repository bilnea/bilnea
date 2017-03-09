<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


// Creación archivos tema hijo

$var_new_files = ['404.php','css/login.css','js/login.js','css/main.css','js/main.js', 'js/admin.js', 'css/admin.css','loader.php'];

if (!file_exists(get_stylesheet_directory().'/css')) {
	mkdir(get_stylesheet_directory().'/css', 0755, true);
}

if (!file_exists(get_stylesheet_directory().'/js')) {
	mkdir(get_stylesheet_directory().'/js', 0755, true);
}

if (!file_exists(get_stylesheet_directory().'/tmp')) {
	mkdir(get_stylesheet_directory().'/tmp', 0755, true);
}

foreach ($var_new_files as $var_new_file) {
	if (!file_exists(get_stylesheet_directory().'/'.$var_new_file)) {
		fopen(get_stylesheet_directory().'/'.$var_new_file, 'w');
	}
}

if (!file_exists(get_stylesheet_directory().'/tmp/index.html')) {
	fopen(get_stylesheet_directory().'/tmp/index.html', 'w');
	$txt = '';
	$txt .= '<html>'."\n";
	$txt .= '	<head>'."\n";
	$txt .= '		<meta charset="UTF-8">'."\n";
	$txt .= '		<title>En desarrollo</title>'."\n";
	$txt .= '		<meta name="robots" content="noindex,nofollow" />'."\n";
	$txt .= '		<link rel="shortcut icon" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyhpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMDY3IDc5LjE1Nzc0NywgMjAxNS8wMy8zMC0yMzo0MDo0MiAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTUgKE1hY2ludG9zaCkiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6NTZCNUZBRjg3MEZDMTFFNTk1MjM4Q0M2MDNCNTIwNDMiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6NTZCNUZBRjk3MEZDMTFFNTk1MjM4Q0M2MDNCNTIwNDMiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo1NkI1RkFGNjcwRkMxMUU1OTUyMzhDQzYwM0I1MjA0MyIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo1NkI1RkFGNzcwRkMxMUU1OTUyMzhDQzYwM0I1MjA0MyIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PihBn8wAAAEPSURBVHja7NQ9agJBGMbx9RtJsFCirY3gIYKkSCUEa1s7m+ARvIUXsLASLCy8gEWa5ALRdEKwCImakIiT/8ArLLjjvtM78GNh95mHmdHdwBgTKFxhgAla57LJQDeamKGFBoquYDqmqIQHdPECg3fUMY+ccWb5d1ia07FC2zXPVVbFWgoO2OE7VDpF2ecMH2W7xy0u8YmtPLfneBs10VV4DB/whTHe8Cf3r1HzKcyHnhdwL9dcKJPz+ZWNXBO4ke3bkYrIqFYYHr/4kPMzcWFNoV3VXrKJuHBaUWgzFeUbpX71gkuh999mpShc+xQOY8oWePL5fKUwMtHjBz3JqD9fVhZ9vGIjntFBxjXvX4ABABLRY7Vz/Di1AAAAAElFTkSuQmCC"/>'."\n";
	$txt .= '		<link rel="stylesheet" type="text/css" href="'.get_stylesheet_directory_uri().'/tmp/main.css">'."\n";
	$txt .= '	</head>'."\n";
	$txt .= '	<body>'."\n";
	$txt .= '		<div>'."\n";
	$txt .= '			<img class="bilneador" src="http://servidorbilnea.com/sanmarino/wp-content/themes/bilnea/img/bilneador.png">'."\n";
	$txt .= '			<h1>Estamos trabajando duro</h1>'."\n";
	$txt .= '			<h2>En breve conocerás este gran proyecto</h2>'."\n";
	$txt .= '			<a href="bilnea.com" rel="nofollow">'."\n";
	$txt .= '				<img class="logo" src="http://servidorbilnea.com/sanmarino/wp-content/themes/bilnea/img/logo-bilnea.png">'."\n";
	$txt .= '			</a>'."\n";
	$txt .= '			© 2016 bilnea Digital S.L. <a href="mailto:hola@bilnea.com">hola@bilnea.com</a>'."\n";
	$txt .= '		</div>'."\n";
	$txt .= '	</body>'."\n";
	$txt .= '</html>'."\n";

	file_put_contents(get_stylesheet_directory().'/tmp/index.html', $txt);
}

if (!file_exists(get_stylesheet_directory().'/tmp/main.css')) {
	fopen(get_stylesheet_directory().'/tmp/main.css', 'w');
	$txt = '';
	$txt .= '@import url(https://fonts.googleapis.com/css?family=Montserrat:400,700);'."\n";
	$txt .= 'html, body {'."\n";
	$txt .= '	height: 100%;'."\n";
	$txt .= '	text-align: center;'."\n";
	$txt .= '	background-color: #fdfdfd;'."\n";
	$txt .= '	margin: 0;'."\n";
	$txt .= '	padding: 0;'."\n";
	$txt .= '}'."\n";
	$txt .= 'body {'."\n";
	$txt .= '	display: table;'."\n";
	$txt .= '	vertical-align: middle;'."\n";
	$txt .= '	width: 100%;'."\n";
	$txt .= '	font-size: 14px;'."\n";
	$txt .= '}'."\n";
	$txt .= 'body > div {'."\n";
	$txt .= '	vertical-align: middle;'."\n";
	$txt .= '	display: table-cell;'."\n";
	$txt .= '	padding-bottom: 100px;'."\n";
	$txt .= '}'."\n";
	$txt .= '* {'."\n";
	$txt .= '	font-family: \'Montserrat\';'."\n";
	$txt .= '	position: relative;'."\n";
	$txt .= '}'."\n";
	$txt .= 'h2 {'."\n";
	$txt .= '	color: #444;'."\n";
	$txt .= '	font-weight: normal;'."\n";
	$txt .= '}'."\n";
	$txt .= 'h2::after {'."\n";
	$txt .= '	position: absolute;'."\n";
	$txt .= '	top: -12px;'."\n";
	$txt .= '	width: 60px;'."\n";
	$txt .= '	height: 4px;'."\n";
	$txt .= '	background-color: #008fbe;'."\n";
	$txt .= '	content: \'\';'."\n";
	$txt .= '	margin-left: -30px;'."\n";
	$txt .= '	left: 50%;'."\n";
	$txt .= '}'."\n";
	$txt .= '.bilneador {'."\n";
	$txt .= '	max-width: 240px;'."\n";
	$txt .= '}'."\n";
	$txt .= 'a {'."\n";
	$txt .= '	text-decoration: none;'."\n";
	$txt .= '	opacity: 1;'."\n";
	$txt .= '	color: #008fbe;'."\n";
	$txt .= '	-webkit-transition: all 0.3s ease;'."\n";
	$txt .= '	   -moz-transition: all 0.3s ease;'."\n";
	$txt .= '	    -ms-transition: all 0.3s ease;'."\n";
	$txt .= '	     -o-transition: all 0.3s ease;'."\n";
	$txt .= '	        transition: all 0.3s ease;'."\n";
	$txt .= '}'."\n";
	$txt .= 'a:hover {'."\n";
	$txt .= '	opacity: 0.8'."\n";
	$txt .= '}'."\n";
	$txt .= '.logo {'."\n";
	$txt .= '	max-width: 120px;'."\n";
	$txt .= '	display: block;'."\n";
	$txt .= '	margin: 80px auto 20px auto;'."\n";
	$txt .= '}'."\n";

	file_put_contents(get_stylesheet_directory().'/tmp/main.css', $txt);
}

if (!file_exists(get_stylesheet_directory().'/js/loader.js')) {
	$file = fopen(get_stylesheet_directory().'/js/loader.js', 'w');
	$txt = '';
	$txt .= 'var b_f_load = 0;'."\n";
	$txt .= 'document.onreadystatechange = function(e) {'."\n";
	$txt .= '	if (document.readyState=="interactive") {'."\n";
	$txt .= '		var all = document.getElementsByTagName("*");'."\n";
	$txt .= '		for (var i=0, max=all.length; i < max; i++) {'."\n";
	$txt .= '			set_ele(all[i]);'."\n";
	$txt .= '		}'."\n";
	$txt .= '	}'."\n";
	$txt .= '}'."\n";
	$txt .= ''."\n";
	$txt .= 'function check_element(ele) {'."\n";
	$txt .= '	var all = document.getElementsByTagName("*");'."\n";
	$txt .= '	var totalele=all.length;'."\n";
	$txt .= '	var per_inc=100/all.length;'."\n";
	$txt .= ''."\n";
	$txt .= '	if (jQuery(ele).on()) {'."\n";
	$txt .= '		b_f_load = (Math.ceil((per_inc+b_f_load)*10000))/10000;'."\n";
	$txt .= '		if (b_f_load >= 100) {'."\n";
	$txt .= '			jQuery(\'#loader-wrap\').fadeOut(100, function() {'."\n";
	$txt .= '				jQuery(\'#loader-wrap\').remove();'."\n";
	$txt .= '			})'."\n";
	$txt .= '		}'."\n";
	$txt .= '	} else {'."\n";
	$txt .= '		set_ele(ele);'."\n";
	$txt .= '	}'."\n";
	$txt .= '}'."\n";
	$txt .= ''."\n";
	$txt .= 'function set_ele(set_element) {'."\n";
	$txt .= '	check_element(set_element);'."\n";
	$txt .= '}'."\n";

	file_put_contents(get_stylesheet_directory().'/js/loader.js', $txt);
}

?>