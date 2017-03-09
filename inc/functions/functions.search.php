<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


// Limitar búsqueda

if (!function_exists('b_f_limit_search')) {
	
	function b_f_limit_search($query) {

		if(is_search()) {

			// Variables locales
			$var_search_objects = array('nav_menu_item');

			foreach(b_f_option('b_opt_search-include', true) as $var_type) {
				array_push($var_search_objects, $var_type);
			}

			$query->set('post_type', $var_search_objects);

			$meta_query = $query->get('meta_query');

			$meta_query[] = array(
				'key' => '_yoast_wpseo_meta-robots-noindex',
				'compare' => 'NOT EXISTS',
			);

			$query->set('meta_query',$meta_query);
			
		}

		return $query;
	}

	add_action('pre_get_posts', 'b_f_limit_search');
	
}


if (!function_exists('b_f_search_order')) {
	
	function b_f_search_order($orderby) {

		// Variables globales
		global $wpdb;

		if (is_search()) {

			$var_orderby = 'CASE';

			foreach (b_f_option('b_opt_search-order') as $key => $value) {
				$var_orderby .= ' WHEN '.$wpdb->posts.'.post_type = "'.$value.'" THEN '.($key+1);
			}

			$var_orderby .= ' ELSE '.$wpdb->posts.'.post_type END ASC';

			return $var_orderby;

		}

		return $orderby;

	}

	add_filter('posts_orderby', 'b_f_search_order', 10, 1);

}

