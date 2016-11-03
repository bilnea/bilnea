<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

if (!function_exists('b_a_shortcode')) {

	function b_a_shortcode() {

		if (isset($_POST['type']) && $_POST['type'] == 'video') {
			$var_video = urldecode($_POST['variable']);
			(isset($_POST['image'])) ? $var_image = ' poster='.urldecode($_POST['image']) : $var_image = '';
			print_r(do_shortcode('[video src="'.$var_video.'" autoplay="on"'.$var_image.']'));
		}

	}

	add_action('wp_ajax_b_shortcode','b_a_shortcode');
	add_action('wp_ajax_nopriv_b_shortcode','b_a_shortcode');

}

?>