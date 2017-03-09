<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


if (!function_exists('b_f_i_url')) {

	function b_f_i_url($arg) {

		if (get_post_type($arg[1]) == 'attachment') {

			return wp_get_attachment_url($arg[1]);

		} else {

			return get_permalink($arg[1]);

		}

	}

}


if (!function_exists('b_f_p_id')) {

	function b_f_p_id($content) {

		$content = preg_replace_callback("/{{b_id-([0-9]+)}}/", "b_f_i_url", $content);

		return $content;
	}

}


if (!function_exists('b_f_i_menu')) {

	function b_f_i_menu($arg) {

		return wp_nav_menu(array('menu' => $arg[1], 'container_id' => 'menu-'.$arg[1], 'echo' => false));
	}
	
}


if (!function_exists('b_f_p_root')) {

	function b_f_p_root($content) {

		$content = str_replace('[b_root]', get_site_url(), $content);
		$content = str_replace('{{b_root}}', get_site_url(), $content);

		return $content;
	}

}


if (!function_exists('b_f_p_upload')) {

	function b_f_p_upload($content) {

		$dir = wp_upload_dir();
		$dir = $dir['baseurl'];
		$content = str_replace('[b_upload]', $dir, $content);
		$content = str_replace('{{b_upload}}', $dir, $content);
		$content = str_replace('[b_uploads]', $dir, $content);
		$content = str_replace('{{b_uploads}}', $dir, $content);

		return $content;

	}

}


add_filter('the_content','b_f_p_id');
add_filter('the_content','b_f_p_root');
add_filter('the_content','b_f_p_upload');


if (!function_exists('b_f_shortcode')) {
	
	function b_f_shortcode($var_content = null, $var_shortcode = true) {

		$content = (($var_shortcode == true) ? do_shortcode($var_content) : $var_content);

		return b_f_p_id(b_f_p_root(b_f_p_upload($content)));

	}

}

?>