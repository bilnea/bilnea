<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


// Eliminación de elementos de prueba

wp_delete_post(1, true);
wp_delete_post(2, true);


// Mostrar título

if (!function_exists('b_f_title')) {

	function b_f_title() {
		add_theme_support('title-tag');
	}

	add_action('after_setup_theme', 'b_f_title');

}


// Localización del tema

if (!function_exists('b_f_locale')) {
	
	function b_f_locale() {
		return 'es_ES';
	}

	load_theme_textdomain('bilnea', get_template_directory().'/languages');
	load_default_textdomain();

	add_filter('locale', 'b_f_locale');

}


// Eliminación archivos

$var_old_files = ['readme.html','wp-config-sample.php','licencia.txt','license.txt'];

foreach ($var_old_files as $var_old_file) {
	if (file_exists(ABSPATH.$var_old_file)) {
		unlink(ABSPATH.$var_old_file);
	}
}


// Redefinición de slugs

if (!function_exists('b_f_rewrite')) {

	function b_f_rewrite() {

		// Variables globales
		global $wp_rewrite;

		$wp_rewrite->author_base = __('author', 'bilnea');
		$wp_rewrite->search_base = __('search', 'bilnea');
		$wp_rewrite->comments_base = __('comments', 'bilnea');
		$wp_rewrite->pagination_base = __('page', 'bilnea');
		$wp_rewrite->flush_rules();
	}

	add_action('init', 'b_f_rewrite');

}


// Desactivar creación automática de párrafos en páginas

if (!function_exists('b_f_wpautop')) {
	
	function b_f_wpautop($content) {
		'page' === get_post_type() && remove_filter('the_content', 'wpautop');
		return $content;
	}

	add_filter('the_content', 'b_f_wpautop', 0);

}


// Desactivar el formato automático del contenido

remove_filter('the_content', 'wptexturize');


// Eliminar versión de WordPress

if (!function_exists('b_f_version')) {
	
	function b_f_version($var_url) {
		if (strpos($var_url, 'ver='.get_bloginfo('version'))) {
			$var_url = remove_query_arg('ver', $var_url);
		}
		return $var_url;
	}

	add_filter('style_loader_src', 'b_f_version', 9999);
	add_filter('script_loader_src', 'b_f_version', 9999);

}


// Borrar registros de WordPress

if (!function_exists('b_f_remove_info')) {

	function b_f_remove_info() {
	
		remove_action('wp_head', 'wp_generator');
		remove_action('wp_head', 'feed_links', 2);
		remove_action('wp_head', 'feed_links_extra', 3);
		remove_action('wp_head', 'index_rel_link');
		remove_action('wp_head', 'start_post_rel_link', 10, 0);
		remove_action('wp_head', 'parent_post_rel_link', 10, 0);
		remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
		remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
		remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );

	}

	add_action('init', 'b_f_remove_info');

}


if (!function_exists('b_f_e_menu')) {

	function b_f_e_menu() {
		add_submenu_page('bilnea', 'Widgets', 'Widgets', 'manage_options', 'edit.php?post_type=elementor_library');
	}

	add_action('admin_menu', 'b_f_e_menu');

}


if (!function_exists('b_f_e_seo')) {
	
	function b_f_e_seo($columns) {
		unset($columns['wpseo-score']);
		unset($columns['wpseo-score-readability']);
		unset($columns['wpseo-title']);
		unset($columns['wpseo-metadesc']);
		unset($columns['wpseo-focuskw']);
		unset($columns['wpseo-links']);
		unset($columns['wpseo-linked']);
		unset($columns['gadwp_stats']);
		return $columns;
	}

	add_filter('manage_edit-elementor_library_columns', 'b_f_e_seo', 10, 1);

}


if (!function_exists('b_f_e_metaboxes')) {
	
	function b_f_e_metaboxes() {
		remove_meta_box('wpseo_meta', 'elementor_library', 'normal');
		remove_meta_box('authordiv', 'elementor_library', 'normal');
	}

	add_action('add_meta_boxes', 'b_f_e_metaboxes', 100);

}


if (!function_exists('b_f_e_thumbnail')) {

	function b_f_e_thumbnail() {
		remove_post_type_support('elementor_library', 'thumbnail');
	}

	add_action('init', 'b_f_e_thumbnail');

}

?>