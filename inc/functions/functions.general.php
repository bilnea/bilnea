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
				$var_length = 40;
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

// Función que devuelve un valor en métrica

if (!function_exists('b_f_size')) {
	
	function b_f_size($var_arg = '', $var_overflow = 0) {
		$var_num = preg_replace('/\s+/', '', b_f_option($var_arg, true));
		$var_num = str_replace('px', '', $var_num);
		if (ctype_digit($var_num)) {
			$var_num = $var_num+$var_overflow;
			$var_num .= 'px';
		}
		return $var_num;
	}

}

if (!function_exists('b_f_size_unit')) {
	
	function b_f_size_unit($var_size) {

		$var_number = str_replace('px', '', preg_replace('/\s+/', '', $var_size));
		if (is_numeric($var_number)) {
			$var_number .= 'px';
		}
		
		return $var_number;
	}

}


// Función que devuelve un color

if (!function_exists('b_f_color')) {
	
	function b_f_color($var_arg='') {

		$var_color = preg_replace('/\s+/', '', b_f_option($var_arg, true));

		if (ctype_digit($var_color)) {
			$var_color = '#'.$var_color;
		}

		return $var_color;
	}

}


// Añadir clase si se accede desde dispositivo móvil

if (!function_exists('b_f_mobile_class')) {
	
	function b_f_mobile_class($var_classes = '') {

		if (wp_is_mobile()){
			$var_classes[] = 'is-mobile';
		}

		return $var_classes;

	}

	add_filter('body_class','b_f_mobile_class');

}


if (!function_exists('b_f_get_file_content')) {
	
	function b_f_get_file_content($var_url) {

		if ((substr($var_url, 0, 7) != 'http://') && (substr($var_url, 0, 8) != 'https://')) {
			$var_url = get_site_url(null, $var_url);
		}

		$var_curl = curl_init();

		curl_setopt($var_curl, CURLOPT_URL, $var_url);

		curl_setopt($var_curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($var_curl,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

		$var_output = curl_exec($var_curl);

		curl_close($var_curl);

		return $var_output;

	}

}

?>