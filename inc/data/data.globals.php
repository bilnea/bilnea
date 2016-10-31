<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

(function_exists('icl_object_id')) ? $b_g_language = ICL_LANGUAGE_CODE : $b_g_language = 'es';

$b_g_sliders = 0;

$b_g_forms = 1;

$b_g_hash = 'Hrjb(_GfXr%zNr_sB+Sf591j|X4A)WHMJdeqW,>(';

$b_g_google_api = 'AIzaSyAMhKy2BWliADhIlYvQHQTaAOVmWFZ--98';

$b_g_months = array(
	__('January', 'bilnea'),
	__('February', 'bilnea'),
	__('March', 'bilnea'),
	__('April', 'bilnea'),
	__('May', 'bilnea'),
	__('June', 'bilnea'),
	__('July', 'bilnea'),
	__('August', 'bilnea'),
	__('September', 'bilnea'),
	__('October', 'bilnea'),
	__('November', 'bilnea'),
	__('December', 'bilnea')
);

$var_fonts = json_decode(file_get_contents(('https://www.googleapis.com/webfonts/v1/webfonts?key='.$b_g_google_api)));

$b_g_google_fonts = array();

foreach ($var_fonts->items as $font) {
	$var_sizes = $font->variants;
	foreach ($var_sizes as &$temp) {
		if ($temp == 'regular') { $temp = '400'; }
		if ($temp == 'italic') { $temp = '400italic'; }
	}
	$b_g_google_fonts['"'.$font->family.'", '.$font->category] = array(
		'name' => str_replace(' ', '+', $font->family),
		'sizes' => $var_sizes
	);
}

?>