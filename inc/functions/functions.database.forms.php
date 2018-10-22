<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


// Tabla formularios de contacto

if (!function_exists('b_f_table_contact')) {

	function b_f_table_contact() {

		// Variables globales
		global $wpdb;

		// Variables locales
		$var_charset = $wpdb->get_charset_collate();
		$var_table = $wpdb->prefix.'form_users';

		// Creación de la tabla
		if ($wpdb->get_var('SHOW TABLES LIKE "'.$var_table.'"') != $var_table) {
			$var_query = 'CREATE TABLE '.$var_table.' (
					`id` INT NOT NULL AUTO_INCREMENT,
					`data` longtext,
					`attachments` longtext,
					`ip` varchar(100),
					`page` varchar(200),
					`date` varchar(200),
					`email` varchar(200),
					`formname` varchar(100),
					`status` varchar(100),
					`read` varchar(20) DEFAULT "no",
					`lang` varchar(10) DEFAULT "es",
					`response` longtext
					PRIMARY KEY (id),
					UNIQUE KEY (id)) '.$var_charset.';';

				require_once(ABSPATH.'wp-admin/includes/upgrade.php');

				dbDelta($var_query);

		}
	}

	add_action('after_setup_theme', 'b_f_table_contact');

}

?>