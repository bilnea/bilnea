<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


if (!function_exists('b_f_sanitize')) {

	function b_f_sanitize($var_string) {

		return preg_replace("/[^a-zA-Z0-9]+/", "", html_entity_decode($var_string, ENT_QUOTES));

	}

}

?>