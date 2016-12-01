<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

$args = array(
	'posts_per_page' => b_f_option('b_opt_blog-number', true),
	'paged' => $var_paged,
	'orderby' => b_f_option('b_opt_blog-order')
);

if ($var_archive == true) {
	$args['cat'] == get_queried_object()->term_id;
}

if (b_f_option('b_opt_blog-order-desc') == 1) {
	$args['order'] = 'ASC';
}

if (b_f_option('b_opt_blog-order') == 'manual') {
	$args['orderby'] = 'meta_value_num';
	$args['meta_key'] = 'custom-order';
}

?>