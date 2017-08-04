<?php

/*

bilnea WordPress theme
© 2015 bilnea (http://bilnea.com)
Desarrollado por Samuel E. Cerezo para bilnea Digital S.L.

*/


// Versiones de la plataforma

$b_g_version = '3.0';

if (!function_exists('b_f_versions')) {
	
	function b_f_versions($var_resource) {
		switch ($var_resource) {

			// Font Awesome
			case 'font-awesome':
				return '4.6.3';
				break;

			// jQuery UI
			case 'jquery-ui':
				return '1.11.4';
				break;

			// Select2
			case 'select2':
				return '4.0.3';
				break;

			// Fitvids
			case 'fitvids':
				return '1.0';
				break;

			// Query Object
			case 'query-object':
				return '2.2.3';
				break;

			// Magnific Popup
			case 'magnific-popup':
				return '1.0.0';
				break;

			// Animate Colors
			case 'animate-colors':
				return '1.6.0';
				break;

			// Hyphenator
			case 'hyphenator':
				return '5.2.0';
				break;

			// jQuery UI Mobile
			case 'jquery-ui-mobile':
				return '1.4.5';
				break;

			// Animate.css
			case 'animate-css':
				return '3.5.0';
				break;

			// Spectrum
			case 'spectrum':
				return '1.8.0';
				break;

			// Spectrum
			case 'wow':
				return '1.1.2';
				break;

			// Flipclock
			case 'flipclock':
				return '0.8.0 Beta';
				break;

			// Super Simple Slider
			case 'flexslider':
				return '2.6.3';
				break;

			// responsiveCarousel.JS
			case 'responsivecarousel':
				return '1.2.0';
				break;

			// Vide
			case 'vide':
				return '0.5.1';
				break;

		}

	}

}


// Carga de ficheros por directorio

if (!function_exists('b_f_include')) {
	
	function b_f_include($var_dir, $var_recursively = true) {

		if (is_dir($var_dir)) {

			// Variables locales
			$var_relative = str_replace(dirname(__FILE__).'/', '', $var_dir);
			$var_scan = scandir($var_dir);

			unset($var_scan[0], $var_scan[1]);

			$var_scan = b_f_sort_array($var_scan, 'first');

			foreach($var_scan as $var_file) {
				if (is_dir($var_dir.'/'.$var_file) && $var_recursively == true) {
					b_f_include($var_dir.'/'.$var_file);
				} else if (!is_dir($var_dir.'/'.$var_file)) {
					require($var_relative.'/'.$var_file);
				}
			}
		}
	}

}

if (!function_exists('b_f_sort_array')) {
	
	function b_f_sort_array(&$var_array, $var_value) {

		if (count($var_array) > 0 && strpos(implode('', $var_array), $var_value) !== false) {
			
			// Variables globales
			$var_key = array_keys(preg_grep('/('.$var_value.')/i', $var_array))[0];
			$var_value = $var_array[$var_key];

			if($var_key) {
				unset($var_array[$var_key]);
			}

			array_unshift($var_array, $var_value); 

		} 

		return $var_array;
	}

}


// Variables globales

include('inc/data/data.globals.php');


// Variables por defecto

include('inc/data/data.defaults.php');


// Funciones PHP

b_f_include(get_template_directory().'/inc/functions');


// Modificamos los puntos suspensivos utilizados al acortar texto

function custom_excerpt_more($var_more) {
	return '...';
}

add_filter( 'excerpt_more', 'custom_excerpt_more' );




















// Redes sociales. $arg = clase del elemento padre. $opt = opciones (1: iconos normales, 2: iconos cuadrados)

function b_f_rrss($arg='', $opt=1) {
	($opt == 2) ? $opt = '-square' : $opt = '';

	$txt = '<ul class="'.$arg.'">';

	$socials = explode(',', b_f_option('b_opt_social-order'));

	foreach ($socials as $social) {
		if (b_f_option('b_opt_social-'.$social) != '') {
			$url = b_f_option('b_opt_social-'.$social);
			if (strpos($url, $social.'.com') === false) {
				$url = '//'.$social.'.com/'.$url;
			}
			if (strpos($url,'http://') === false) {
				$url = '//'.$url;
			}
			$url = str_replace('////', '//', str_replace('http', '', str_replace('https', '', str_replace('http:', '', str_replace('https:', '', $url)))));
			$txt .= '<li><a href="'.$url.'" title="'.str_replace('-', ' ', ucfirst($social)).'" target="_blank" rel="nofollow"><i style="background-color: '.b_f_option('b_opt_social-'.$social.'-color').';" class="fa fa-'.$social.$opt.'"></i></a></li>';
		}
	}

	$txt .= '</ul>';

	return $txt;
}


// Favicon

if (b_f_option('b_opt_favicon') != '') {

	function b_f_favicon() {
		echo '<link rel="Shortcut Icon" href="'.b_f_option('b_opt_favicon').'" />';
		echo '<link rel="icon" type="image/png" href="'.b_f_option('b_opt_favicon').'" sizes="32x32">';
		echo '<link rel="icon" type="image/png" href="'.b_f_option('b_opt_favicon').'" sizes="192x192">';
		echo '<link rel="icon" type="image/png" href="'.b_f_option('b_opt_favicon').'" sizes="96x96">';
		echo '<link rel="icon" type="image/png" href="'.b_f_option('b_opt_favicon').'" sizes="16x16">';
		echo '<meta name="apple-mobile-web-app-title" content="'.get_option( 'blogname' ).'">';
		echo '<meta name="application-name" content="'.get_option( 'blogname' ).'">';
		echo '<meta name="msapplication-TileColor" content="'.b_f_option('b_opt_header-color').'">';
		echo '<meta name="msapplication-TileImage" content="'.b_f_option('b_opt_favicon').'">';
		echo '<meta name="theme-color" content="'.b_f_option('b_opt_header-color').'">';
	}
	add_action('wp_head', 'b_f_favicon');
}

if (b_f_option('b_opt_favicon-iphone') != '') {
	function b_f_favicon_iphone() {
		echo '<link rel="apple-touch-icon" sizes="57x57" href="'.b_f_option('b_opt_favicon-iphone').'">';
		echo '<link rel="apple-touch-icon" sizes="60x60" href="'.b_f_option('b_opt_favicon-iphone').'">';
	}
	add_action('wp_head', 'b_f_favicon_iphone');
}

if (b_f_option('b_opt_favicon-ipad') != '') {
	function b_f_favicon_ipad() {
		echo '<link rel="apple-touch-icon" sizes="72x72" href="'.b_f_option('b_opt_favicon-ipad').'">';
		echo '<link rel="apple-touch-icon" sizes="76x76" href="'.b_f_option('b_opt_favicon-ipad').'">';
	}
	add_action('wp_head', 'b_f_favicon_ipad');
}

if (b_f_option('b_opt_favicon-iphone-retina') != '') {
	function b_f_favicon_iphone_retina() {
		echo '<link rel="apple-touch-icon" sizes="114x114" href="'.b_f_option('b_opt_favicon-iphone-retina').'">';
		echo '<link rel="apple-touch-icon" sizes="120x120" href="'.b_f_option('b_opt_favicon-iphone-retina').'">';
		echo '<link rel="apple-touch-icon" sizes="144x144" href="'.b_f_option('b_opt_favicon-iphone-retina').'">';
	}
	add_action('wp_head', 'b_f_favicon_iphone_retina');
}

if (b_f_option('b_opt_favicon-ipad-retina') != '') {
	function b_f_favicon_ipad_retina() {
		echo '<link rel="apple-touch-icon" sizes="144x144" href="'.b_f_option('b_opt_favicon-ipad-retina').'">';
		echo '<link rel="apple-touch-icon" sizes="152x152" href="'.b_f_option('b_opt_favicon-ipad-retina').'">';
		echo '<link rel="apple-touch-icon" sizes="180x180" href="'.b_f_option('b_opt_favicon-ipad-retina').'">';
	}
	add_action('wp_head', 'b_f_favicon_ipad_retina');
}


// Permitir ejecutar shortcodes en widgets

add_filter('widget_text', 'do_shortcode');


if (!function_exists('b_f_login_scripts')) {
	
	function b_f_login_scripts() {

		wp_enqueue_script('jquery');
		wp_enqueue_style('custom-login-css', get_stylesheet_directory_uri().'/css/login.css');
		wp_enqueue_script('custom-login-js', get_stylesheet_directory_uri().'/js/login.js');
		wp_enqueue_style('styles.design.fonts.awesome', get_template_directory_uri().'/css/external/styles.design.fonts.awesome.css');

	}

}


// Página de acceso

function b_f_login_logo_url() {
	return home_url();
}

add_filter( 'login_headerurl', 'b_f_login_logo_url' );

function b_f_login_title() {
	ob_start();
	bloginfo('name');
	$name = ob_get_clean();
	return 'Administración web '.$name;
}

add_filter( 'login_headertitle', 'b_f_login_title' );

function b_f_login() {
	wp_enqueue_script('jquery');
	wp_enqueue_style('custom-login-css', get_stylesheet_directory_uri().'/css/login.css');
	wp_enqueue_script('custom-login-js', get_stylesheet_directory_uri().'/js/login.js');
}

add_action('login_enqueue_scripts', 'b_f_login');



// Habilitamos soporte para imágenes destacadas

add_theme_support('post-thumbnails');


// Definimos un largo para el extracto

function b_f_excerpt_length() {
	return b_f_option('b_opt_blog-excerpt-length');
}

add_filter('excerpt_length','b_f_excerpt_length', 999);


// Eliminamos los puntos suspensivos del extracto

function b_f_custom_more() {
	return '';
}

add_filter( 'excerpt_more', 'custom_excerpt_more' );


// Creamos el metabox para poder seleccionar la barra lateral

function crear_metabox_sidebar() {
	add_meta_box( 
	'custom_sidebar',
		'Barra lateral',
		'metabox_sidebar_callback',
		'post',
		'side'
	);
	add_meta_box( 
		'custom_sidebar',
		'Barra lateral',
		'metabox_sidebar_callback',
		'page',
		'side'
	);
}

function metabox_sidebar_callback($post) {
	global $wp_registered_sidebars;
	$c = get_post_custom($post->ID);
	if (isset($c['custom_sidebar'])) {
		$val = $c['custom_sidebar'][0];
	} else {
		$val = 'default';
	}
	wp_nonce_field('metabox_sidebar_callback', 'custom_sidebar_nonce');
	$out = '<p><label for="custom_sidebar">Barra lateral mostrada.</label></p>';
	$out .= '<select name="custom_sidebar" style="width: 100%;">';
	$out .= '<option';
	if ($val == 'default')
		$out .= 'selected="selected"';
	$out .= ' value="default">Barra lateral por defecto</option>';
	foreach($wp_registered_sidebars as $sidebar_id => $sidebar) {
		if (strpos($sidebar['name'], 'Footer #') === false) {
			$out .= '<option';
			if ($sidebar_id == $val)
				$out .= ' selected="selected"';
			$out .= ' value="'.$sidebar_id.'">'.$sidebar['name'].'</option>';
		}
	}
	$out .= '</select>';
	echo $out;
}

function metabox_sidebar_guardar($post_id) {
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}
	if (in_array(get_post_type($post_id), array('nav_menu_item'))) {
		return;
	}
	if (isset($_POST['custom_sidebar_nonce']) && !wp_verify_nonce($_POST['custom_sidebar_nonce'], 'metabox_sidebar_callback')) {
		return;
	}
	if (!current_user_can('edit_page', $post_id)) {
		return;
	}
	if (isset($_POST['custom_sidebar']) && $_POST['custom_sidebar'] != '') {
		$data = $_POST['custom_sidebar'];
		update_post_meta($post_id, 'custom_sidebar', $data);
	}
	
}

add_action('add_meta_boxes', 'crear_metabox_sidebar');
add_action('save_post', 'metabox_sidebar_guardar');


// Creamos una función para saber si estamos en la página del blog

function is_blog () {
	global  $post;
	$posttype = get_post_type($post );
	return ( ((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (!is_single()) || (is_tag())) && ( $posttype == 'post')  ) ? true : false ;
}

// Creamos el archivo robots.txt

remove_action('do_robots','do_robots');

function b_robots() {
	header('Content-Type: text/plain; charset=utf-8');
	do_action('do_robotstxt');
	$out = "User-agent: *\n";
	$pub = get_option('blog_public');
	if ('0' == $pub) {
		$out .= "Disallow: /\n";
	} else {
		$url = parse_url(site_url());
		$pth = (!empty( $url['path'] ) ) ? $url['path'] : '';
		$out .= "Disallow: $pth/wp-admin/\n";
		$out .= "Disallow: $path/wp-content/plugins/\n";
		$out .= "Sitemap: ".site_url()."/sitemap.xml\n";
	}
	echo apply_filters('robots_txt', $out, $pub);
}

add_action('do_robots', 'b_robots');


// Aviso legal

if (function_exists('icl_object_id')) {
	$var_languages = icl_get_languages('skip_missing=0&orderby=code');
	if (!empty($lng)) {
		foreach ($var_languages as $var_language) {
			switch ($var_language['language_code']) {
				case 'es' :
					b_f_create_page('aviso-legal', 'Aviso legal', $var_language['language_code']);
					break;
				case 'fr' :
					b_f_create_page('mentions-legales', 'Mentions légales', $var_language['language_code']);
					break;
				case 'en' :
					b_f_create_page('legal-advice', 'Legal advice', $var_language['language_code']);
					break;
				case 'pt-pt' :
					b_f_create_page('avisos-legais', 'Avisos legais', $var_language['language_code']);
					break;
			}
		}
	}
} else {
	$options = get_option('bilnea_settings');
	if ($options['b_opt_legal-advice-es'] == 'new') {
		b_f_create_page('aviso-legal', 'Aviso legal');
	}
}


// Política de privacidad

if (function_exists('icl_object_id')) {
	$lng = icl_get_languages('skip_missing=0&orderby=code');
	if (!empty($lng)) {
		foreach ($lng as $l) {
			
		}
	}
} else {
	$options = get_option('bilnea_settings');
	if ($options['b_opt_privacy-policy-es'] == 'new') {
		b_f_create_page('politica-privacidad', 'Política de privacidad');
	}
}


// Política de cookies

if (function_exists('icl_object_id')) {
	$lng = icl_get_languages('skip_missing=0&orderby=code');
	if (!empty($lng)) {
		foreach ($lng as $l) {
			
		}
	}
} else {
	$options = get_option('bilnea_settings');
	if ($options['b_opt_cookies-policy-es'] == 'new') {
		b_f_create_page('politica-cookies', 'Política de cookies');
	}
}




// Eliminar pingbacks del conteo de comentarios

function b_f_comment_count( $count ) {
	global $id;
	$comment_count = 0;
	$comments = get_approved_comments($id);
	foreach ( $comments as $comment ) {
		if ($comment->comment_type === '') {
			$comment_count++;
		}
	}
	return $comment_count;
}

add_filter( 'get_comments_number', 'b_f_comment_count', 0);


// Adaptar formulario mailpoet

if (defined('WYSIJA')) {
	$url = '';
	if (function_exists('icl_object_id')) {
		$lang = ICL_LANGUAGE_CODE;
		global $sitepress;
		if (b_f_option('b_opt_privacy-url-_'.$lang) != '') {
			$url = $sitepress->language_url(ICL_LANGUAGE_CODE).b_f_option('b_opt_privacy-url-_'.$lang);
		}
	} else {
		if (b_f_option('b_opt_privacy-url-_es') != '') {
			$url = site_url().'/'.b_f_option('b_opt_privacy-url-_es');
		}
	}
	$text = __('* I have read, understood and accept the ', 'bilnea').'<a href="'.$url.'" target="_blank">'.__('privacy policy', 'bilnea').'</a>.';
	wp_register_script('mailpoet-bilnea', get_template_directory_uri().'/js/mailpoet.js', array('jquery'), $b_g_version, true);
	$var_array = array(
		'text' => $text
	);
	wp_localize_script('mailpoet-bilnea', 'mailpoetbilnea', $var_array);
	wp_enqueue_script('mailpoet-bilnea');
}


// Eliminar comentarios en fichas de adjuntos

function b_f_attachment_comments($open, $post_id) {
	$post = get_post( $post_id );
	if ( $post->post_type == 'attachment' ) {
		return false;
	}
	return $open;
}

add_filter('comments_open', 'b_f_attachment_comments', 10, 2);


// Widgets

b_f_include(get_template_directory().'/inc/widgets');


// Shortcodes

b_f_include(get_template_directory().'/inc/shortcodes');


// Funciones Ajax

b_f_include(get_template_directory().'/inc/ajax');


// Panel de administración

b_f_include(get_template_directory().'/inc/admin', false);


?>