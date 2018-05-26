<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


// Creación archivos tema hijo

$var_new_files = ['css/login.css','js/login.js','css/main.css','js/main.js', 'js/admin.js', 'css/admin.css','loader.php'];

if (!file_exists(get_stylesheet_directory().'/css')) {
	mkdir(get_stylesheet_directory().'/css', 0755, true);
}

if (!file_exists(get_stylesheet_directory().'/js')) {
	mkdir(get_stylesheet_directory().'/js', 0755, true);
}

foreach ($var_new_files as $var_new_file) {
	if (!file_exists(get_stylesheet_directory().'/'.$var_new_file)) {
		fopen(get_stylesheet_directory().'/'.$var_new_file, 'w');
	}
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