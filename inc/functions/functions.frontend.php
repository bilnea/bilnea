<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


if (!function_exists('w_enhaced_menu')) {
	function w_enhaced_menu($items) {
		foreach ($items as $item) {
			$item->url = do_shortcode($item->url);
		}
		return $items;   
	}
	add_filter('wp_nav_menu_objects', 'w_enhaced_menu');
}


if (!function_exists('b_f_comment_form')) {

	function b_f_comment_form($var_fields) {
		$var_comments = $var_fields['comment'];
		unset($var_fields['comment']);
		$var_fields['comment'] = $var_comments;

		return $var_fields;

	}

	add_filter('comment_form_fields', 'b_f_comment_form');

}

?>