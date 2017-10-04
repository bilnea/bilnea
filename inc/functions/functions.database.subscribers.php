<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


// Tabla suscriptores

if (!function_exists('b_f_table_subscribers')) {
	
	function b_f_table_subscribers() {

		if (b_f_option('b_opt_subscribers') == 1) {

			// Variables globales
			global $wpdb;

			// Variables locales
			$var_charset = $wpdb->get_charset_collate();
			$var_table = $wpdb->prefix.'subscribers';

			// Creación de la tabla
			if ($wpdb->get_var('SHOW TABLES LIKE "'.$var_table.'"') != $var_table) {
				$var_query = 'CREATE TABLE '.$var_table.' (
					`id` varchar(100) NOT NULL,
					`name` varchar(200),
					`last_name` varchar(200),
					`email` varchar(200),
					`active` boolean,
					`date` varchar(100),
					`status` varchar(100),
					`hash` varchar(200),
					`service` varchar(100),
					PRIMARY KEY (id),
					UNIQUE KEY (id)) '.$var_charset.';';

				require_once(ABSPATH.'wp-admin/includes/upgrade.php');

				dbDelta($var_query);

			}
		}
	}

	add_action('after_setup_theme', 'b_f_table_subscribers');

}

?>