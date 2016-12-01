<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


// Orden de elementos

if (!function_exists('b_a_sort_admin')) {

	function b_a_sort_admin() {

		$order = explode(',', $_POST['order']);

		$i = 0;
		foreach ($order as $element) {
			$var_temp = explode('-', $element);
			if ($var_temp[0] == 'tag') {
				update_term_meta($var_temp[1], 'custom-order', $i);
			} else {
				wp_update_post(array('ID' => $var_temp[1], 'menu_order' => $i));
			}
			$i++;
		}

	}

	add_action('wp_ajax_b_order_admin','b_a_sort_admin');
	add_action('wp_ajax_nopriv_b_order_admin','b_a_sort_admin');

}

?>