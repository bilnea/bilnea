<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


// Valor de una opción

function b_f_option($var_option, $var_default = false) {

	if (isset(get_option('bilnea_settings')[$var_option])) {
		$var_value = get_option('bilnea_settings')[$var_option];
	} else {
		$var_value = null;
	}

	if ($var_value == '' && $var_default == true) {
		$var_value = b_f_default($var_option);
	}

	return $var_value;

}

?>