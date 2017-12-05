<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


// Añadir soporte a WooCommerce

if (!function_exists('b_f_i_woocommerce_support')) {
	
	function b_f_i_woocommerce_support() {
		add_theme_support('woocommerce');
	}

	add_action('after_setup_theme', 'b_f_i_woocommerce_support');

}

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start() {
  echo '<section class="woocommerce-wrapper">';
}

function my_theme_wrapper_end() {
  echo '</section>';
}

?>