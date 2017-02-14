<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


if (!function_exists('b_f_to_bytes')) {
	
	function b_f_to_bytes($var_size){
		$var_unit = substr($var_size,0,-2);
		switch(strtoupper(substr($var_size,-2))){
			case 'KB':
				return $var_unit * 1024;
			case 'MB':
				return $var_unit * pow(1024,2);
			case 'GB':
				return $var_unit * pow(1024,3);
			case 'TB':
				return $var_unit * pow(1024,4);
			case 'PB':
				return $var_unit * pow(1024,5);
			default:
				return $var_size;
		}
	}
}


if (!function_exists('b_f_get_excerpt')) {

	function b_f_get_excerpt($var_text, $var_length = null, $var_offset = 0, $var_words = true) {

		// Variables locales
		$var_text = strip_shortcodes($var_text);
		$var_text = strip_tags($var_text);
		$var_text = preg_replace('#\s*\{{.+\}}\s*#U', ' ', $var_text);

		if ($var_words == true) {
			if ($var_length == null) {
				$var_length = b_f_option('b_opt_blog-excerpt-length');
			}
			$var_cutted = false;
			$array_words = explode(' ', $var_text);
			if (count($array_words) > (int)$var_length) {
				$array_words = array_splice($array_words, 0, $var_length, '');
				$var_cutted = true;
			}
			$var_excerpt = join(' ', $array_words);
			$var_excerpt = rtrim($var_excerpt, '.,;:');
			if ($var_cutted == true) {
				$var_excerpt .= '...';
			}
		} else {
			if ($var_length == null) {
				$var_length = b_f_option('b_opt_blog-excerpt-length');
			}
			if(strlen($var_text) > $var_length) {
				$var_excerpt = substr($var_text, $var_offset, $var_length-3);
				$array_words = strrpos($var_excerpt, ' ');
				$var_excerpt = substr($var_excerpt, 0, $array_words);
				$var_excerpt = rtrim($var_excerpt, '.,;:');
				$var_excerpt .= '...';
			} else {
				$var_excerpt = $var_text;
			}
		}
		
		return $var_excerpt;
	}
}

?>