<?php

/*

bilnea WordPress theme
© 2015 bilnea (http://bilnea.com)
Desarrollado por Samuel E. Cerezo para bilnea Digital S.L.

*/



// Variables iniciales

$num_slid = 0;


// Borrar elementos de prueba

wp_delete_post(1, true);
wp_delete_post(2, true);

// Mostrar título

function b_f_title() {
	add_theme_support('title-tag');
}

add_action('after_setup_theme', 'b_f_title');


// Valores por defecto

require_once('inc/defaults.php');


// Localización del tema

load_theme_textdomain('bilnea', get_template_directory().'/languages');

function b_f_locale() {
	return 'es_ES';
}

load_default_textdomain();

add_filter('locale', 'b_f_locale');


// Archivos necesarios

$new_files = ['404.php','css/login.css','js/login.js','css/main.css','js/main.js', 'loader.php'];

if(!file_exists(get_stylesheet_directory().'/css')) {
	mkdir(get_stylesheet_directory().'/css', 0755, true);
}

if(!file_exists(get_stylesheet_directory().'/js')) {
	mkdir(get_stylesheet_directory().'/js', 0755, true);
}

if(!file_exists(get_stylesheet_directory().'/tmp')) {
	mkdir(get_stylesheet_directory().'/tmp', 0755, true);
}

foreach ($new_files as $new) {
	if(!file_exists(get_stylesheet_directory().'/'.$new)) {
		$fh = fopen(get_stylesheet_directory().'/'.$new, 'w');
	}
}

if(!file_exists(get_stylesheet_directory().'/tmp/index.html')) {
	$file = fopen(get_stylesheet_directory().'/tmp/index.html', 'w');
	$txt = '';
	$txt .= '<html>'."\n";
	$txt .= '	<head>'."\n";
	$txt .= '		<meta charset="UTF-8">'."\n";
	$txt .= '		<title>En desarrollo</title>'."\n";
	$txt .= '		<meta name="robots" content="noindex,nofollow" />'."\n";
	$txt .= '		<link rel="shortcut icon" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyhpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMDY3IDc5LjE1Nzc0NywgMjAxNS8wMy8zMC0yMzo0MDo0MiAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTUgKE1hY2ludG9zaCkiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6NTZCNUZBRjg3MEZDMTFFNTk1MjM4Q0M2MDNCNTIwNDMiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6NTZCNUZBRjk3MEZDMTFFNTk1MjM4Q0M2MDNCNTIwNDMiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo1NkI1RkFGNjcwRkMxMUU1OTUyMzhDQzYwM0I1MjA0MyIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo1NkI1RkFGNzcwRkMxMUU1OTUyMzhDQzYwM0I1MjA0MyIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PihBn8wAAAEPSURBVHja7NQ9agJBGMbx9RtJsFCirY3gIYKkSCUEa1s7m+ARvIUXsLASLCy8gEWa5ALRdEKwCImakIiT/8ArLLjjvtM78GNh95mHmdHdwBgTKFxhgAla57LJQDeamKGFBoquYDqmqIQHdPECg3fUMY+ccWb5d1ia07FC2zXPVVbFWgoO2OE7VDpF2ecMH2W7xy0u8YmtPLfneBs10VV4DB/whTHe8Cf3r1HzKcyHnhdwL9dcKJPz+ZWNXBO4ke3bkYrIqFYYHr/4kPMzcWFNoV3VXrKJuHBaUWgzFeUbpX71gkuh999mpShc+xQOY8oWePL5fKUwMtHjBz3JqD9fVhZ9vGIjntFBxjXvX4ABABLRY7Vz/Di1AAAAAElFTkSuQmCC"/>'."\n";
	$txt .= '		<link rel="stylesheet" type="text/css" href="'.get_stylesheet_directory_uri().'/tmp/main.css">'."\n";
	$txt .= '	</head>'."\n";
	$txt .= '	<body>'."\n";
	$txt .= '		<div>'."\n";
	$txt .= '			<img class="bilneador" src="http://servidorbilnea.com/sanmarino/wp-content/themes/bilnea/img/bilneador.png">'."\n";
	$txt .= '			<h1>Estamos trabajando duro</h1>'."\n";
	$txt .= '			<h2>En breve conocerás este gran proyecto</h2>'."\n";
	$txt .= '			<a href="bilnea.com" rel="nofollow">'."\n";
	$txt .= '				<img class="logo" src="http://servidorbilnea.com/sanmarino/wp-content/themes/bilnea/img/logo-bilnea.png">'."\n";
	$txt .= '			</a>'."\n";
	$txt .= '			© 2016 bilnea Digital S.L. <a href="mailto:hola@bilnea.com">hola@bilnea.com</a>'."\n";
	$txt .= '		</div>'."\n";
	$txt .= '	</body>'."\n";
	$txt .= '</html>'."\n";

	file_put_contents(get_stylesheet_directory().'/tmp/index.html', $txt);
}

if(!file_exists(get_stylesheet_directory().'/tmp/main.css')) {
	$file = fopen(get_stylesheet_directory().'/tmp/main.css', 'w');
	$txt = '';
	$txt .= '@import url(https://fonts.googleapis.com/css?family=Montserrat:400,700);'."\n";
	$txt .= 'html, body {'."\n";
	$txt .= '	height: 100%;'."\n";
	$txt .= '	text-align: center;'."\n";
	$txt .= '	background-color: #fdfdfd;'."\n";
	$txt .= '	margin: 0;'."\n";
	$txt .= '	padding: 0;'."\n";
	$txt .= '}'."\n";
	$txt .= 'body {'."\n";
	$txt .= '	display: table;'."\n";
	$txt .= '	vertical-align: middle;'."\n";
	$txt .= '	width: 100%;'."\n";
	$txt .= '	font-size: 14px;'."\n";
	$txt .= '}'."\n";
	$txt .= 'body > div {'."\n";
	$txt .= '	vertical-align: middle;'."\n";
	$txt .= '	display: table-cell;'."\n";
	$txt .= '	padding-bottom: 100px;'."\n";
	$txt .= '}'."\n";
	$txt .= '* {'."\n";
	$txt .= '	font-family: \'Montserrat\';'."\n";
	$txt .= '	position: relative;'."\n";
	$txt .= '}'."\n";
	$txt .= 'h2 {'."\n";
	$txt .= '	color: #444;'."\n";
	$txt .= '	font-weight: normal;'."\n";
	$txt .= '}'."\n";
	$txt .= 'h2::after {'."\n";
	$txt .= '	position: absolute;'."\n";
	$txt .= '	top: -12px;'."\n";
	$txt .= '	width: 60px;'."\n";
	$txt .= '	height: 4px;'."\n";
	$txt .= '	background-color: #008fbe;'."\n";
	$txt .= '	content: \'\';'."\n";
	$txt .= '	margin-left: -30px;'."\n";
	$txt .= '	left: 50%;'."\n";
	$txt .= '}'."\n";
	$txt .= '.bilneador {'."\n";
	$txt .= '	max-width: 240px;'."\n";
	$txt .= '}'."\n";
	$txt .= 'a {'."\n";
	$txt .= '	text-decoration: none;'."\n";
	$txt .= '	opacity: 1;'."\n";
	$txt .= '	color: #008fbe;'."\n";
	$txt .= '	-webkit-transition: all 0.3s ease;'."\n";
	$txt .= '	   -moz-transition: all 0.3s ease;'."\n";
	$txt .= '	    -ms-transition: all 0.3s ease;'."\n";
	$txt .= '	     -o-transition: all 0.3s ease;'."\n";
	$txt .= '	        transition: all 0.3s ease;'."\n";
	$txt .= '}'."\n";
	$txt .= 'a:hover {'."\n";
	$txt .= '	opacity: 0.8'."\n";
	$txt .= '}'."\n";
	$txt .= '.logo {'."\n";
	$txt .= '	max-width: 120px;'."\n";
	$txt .= '	display: block;'."\n";
	$txt .= '	margin: 80px auto 20px auto;'."\n";
	$txt .= '}'."\n";

	file_put_contents(get_stylesheet_directory().'/tmp/main.css', $txt);
}


// Archivos innecesarios

$old_files = ['readme.html','wp-config-sample.php','licencia.txt','license.txt'];

foreach ($old_files as $old) {
	if(file_exists(ABSPATH.$old)) {
		unlink(ABSPATH.$old);
	}
}


// Desactivar creación automática de párrafos en páginas

function b_f_tags($content) {
	'page' === get_post_type() && remove_filter('the_content', 'wpautop');
	return $content;
}

add_filter('the_content', 'b_f_tags', 0);


// Desactivar el formato automático del contenido

remove_filter('the_content', 'wptexturize');


// Eliminar versión de WordPress

function b_f_version($url) {
    if (strpos($url, 'ver='.get_bloginfo('version'))) {
        $url = remove_query_arg('ver', $url);
    }
    return $url;
}

add_filter('style_loader_src', 'b_f_version', 9999);
add_filter('script_loader_src', 'b_f_version', 9999);


// Gestor de medios

function b_f_media() {
	wp_enqueue_style('thickbox');
	wp_enqueue_script('thickbox');
	wp_enqueue_script('media-upload');
	wp_enqueue_media();
}

add_action('admin_enqueue_scripts', 'b_f_media');


// Añadir tema al panel de administración

function b_f_admin_menu() { 
	add_menu_page('Opciones del tema', 'bilnea', 'manage_options', 'bilnea', 'bilnea_options_page', get_template_directory_uri().'/img/b-bilnea.png', 75);
}

add_action('admin_menu', 'b_f_admin_menu');


// Variable para almacenar las opciones del tema

function b_f_variables() { 
	register_setting( 'pluginPage', 'bilnea_settings' );
}

add_action('admin_init', 'b_f_variables');


// Carga del panel de administración del tema

require_once('inc/admin.php');


// Modificamos los puntos suspensivos utilizados al acortar texto

function custom_excerpt_more($more) {
	return '';
}

add_filter( 'excerpt_more', 'custom_excerpt_more' );


// Función que devuelve el valor de una opción

function b_f_option($term) {
	$set = get_option('bilnea_settings', b_f_default());
	$sat = $set[$term];
	if ($sat == '') {
		$sat = b_f_default()[$term];
	}
	return $sat;
}


// Función que devuelve un valor en métrica

function b_f_size($arg='', $ovf=0) {
	$num = preg_replace('/\s+/', '', b_f_option($arg));
	$num = str_replace('px', '', $num);
	if (ctype_digit($num)) {
		$num = $num+$ovf;
		$num .= 'px';
	}
	return $num;
}


// Función que devuelve un color

function b_f_color($arg='') {
	$col = preg_replace('/\s+/', '', b_f_option($arg));
	if (ctype_digit($col)) {
		$col = '#'.$col;
	}
	return $col;
}


// Borrar registros de WordPress

if (b_f_option('b_opt_header-version') == 1) {
	remove_action('wp_head', 'wp_generator');
}

if (b_f_option('b_opt_header-rss') == 1) {
	remove_action('wp_head', 'feed_links', 2);
	remove_action('wp_head', 'feed_links_extra', 3);
}

if (b_f_option('b_opt_header-links') == 1) {
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'start_post_rel_link', 10, 0);
	remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );
}


// Menús de navegación

register_nav_menus(array('menu_main' 	=> 'Menú principal'));
register_nav_menus(array('menu_footer'	=> 'Barra inferior'));
register_nav_menus(array('menu_top' 	=> 'Barra superior'));
register_nav_menus(array('menu_widget' 	=> 'Menú widget'));


// Barras laterales

function b_f_sidebar() {
	register_sidebar(
		array(
			'id' => 'sidebar',
			'name' => 'Barra lateral',
			'description' => 'Barra lateral del sitio',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="side-title">',
			'after_title' => '</h4>',
			'empty_title'=> '',	
		)
	);
	register_sidebar(
		array(
			'id' => 'sidebar_page',
			'name' => 'Barra lateral página',
			'description' => 'Barra lateral de página',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="side-title">',
			'after_title' => '</h4>',
			'empty_title'=> '',	
		)
	);
	register_sidebar(
		array(
			'id' => 'sidebar_blog',
			'name' => 'Barra lateral blog',
			'description' => 'Barra lateral del blog',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="side-title">',
			'after_title' => '</h4>',
			'empty_title'=> '',	
		)
	);
	register_sidebar(
		array(
			'id' => 'sidebar_alter1',
			'name' => 'Barra lateral alternativa #1',
			'description' => 'Barra lateral alternativa',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="side-title">',
			'after_title' => '</h4>',
			'empty_title'=> '',	
		)
	);
	register_sidebar(
		array(
			'id' => 'sidebar_alter2',
			'name' => 'Barra lateral alternativa #2',
			'description' => 'Barra lateral alternativa',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="side-title">',
			'after_title' => '</h4>',
			'empty_title'=> '',	
		)
	);
	for ($i=0; $i < b_f_option('b_opt_footer-menu'); $i++) { 
		switch ($i) {
			case 0:
				$txt = 'Primera';
				break;
			case 1:
				$txt = 'Segunda';
				break;
			case 2:
				$txt = 'Tercera';
				break;
			case 3:
				$txt = 'Cuarta';
				break;
			case 4:
				$txt = 'Quinta';
				break;
		}
		register_sidebar(
			array(
				'id' => 'footer_'.($i+1),
				'name' => 'Footer #'.($i+1),
				'description' => $txt.' columna del pie de página',
				'before_title' => '<h4 class="footer-title">',
				'after_title' => '</h4>',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'empty_title'=> '',	
			)
		);
	}
} 

add_action( 'widgets_init', 'b_f_sidebar' );


// Scripts y Hojas de estilo del tema

function b_f_load()  {
	global $post;
	global $version;

	// Font Awesome
	wp_enqueue_style('font-awesome', get_template_directory_uri().'/css/font-awesome.css');

	// Última versión de Font Awesome
	wp_enqueue_style('font-awesome-cdn', 'http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css');
	
	// Hojas de estilos
	wp_enqueue_style('style-css', get_stylesheet_directory_uri().'/style.css', array());
	wp_enqueue_style('style-php', get_template_directory_uri().'/styles/style.php', array());
	wp_enqueue_style('main-css', get_stylesheet_directory_uri().'/css/main.css', array());

	// Scripts del tema
	wp_enqueue_script('fitvids', get_template_directory_uri().'/js/fitvids.js', array('jquery'), $version, true);
	wp_enqueue_script('main-js', get_stylesheet_directory_uri().'/js/main.js', array('jquery'), $version, true);
	wp_register_script('bilnea', get_template_directory_uri().'/js/bilnea.js', array('jquery'), $version, true);
	$var_array = array(
		'post_id' => $post->ID,
		'main_theme_uri' => get_template_directory_uri()
	);
	wp_localize_script('bilnea', 'bilnea', $var_array);
	wp_enqueue_script('bilnea');
	wp_enqueue_script('anchor', get_template_directory_uri().'/js/anchor.js', array('jquery'), $version, true);

	// Query object
	wp_enqueue_script('query-object', get_template_directory_uri().'/js/jquery.query-object.js', array('jquery'), $version, true);

	// Anticopia
	if (b_f_option('b_opt_anticopy') == 1) {
		wp_enqueue_script('anticopy', get_template_directory_uri().'/js/anticopy.js', array(), $version, true);
	}

	// Lightbox
	if (b_f_option('b_opt_lightbox') == 1) {
		wp_enqueue_script('lightbox', get_template_directory_uri().'/js/magnific-popup.js', array('jquery'), $version, false);
		wp_enqueue_style('lightbox', get_template_directory_uri().'/css/magnific-popup.css');
	}

	// Slider
	wp_register_script('slider', get_template_directory_uri().'/js/slider.js', array('jquery'), $version, true);

	// Acordeón
	wp_register_script('b_s_accordion', get_template_directory_uri().'/js/accordion.js', array('jquery'), $version, true);

	// Animación de colores
	wp_enqueue_script('animate-colors', get_template_directory_uri().'/js/jquery.animate-colors.js', array('jquery'), $version, true);

	// jQuery UI
	wp_register_script('jquery-ui', get_template_directory_uri().'/js/jquery-ui.js', array('jquery'), $version, true);
	wp_register_style('jquery-ui-css', get_template_directory_uri().'/css/jquery-ui.css', array());
	wp_register_style('jquery-ui-css-theme', get_template_directory_uri().'/css/jquery-ui-theme.css', array());

	// Parallax
	wp_enqueue_script('parallax', get_template_directory_uri().'/js/parallax.js', array('jquery','bilnea'), $version, true);

	// Animate.css
	wp_enqueue_style('animate', get_template_directory_uri().'/css/animate.css', array());

	// Wow!
	wp_enqueue_script('wow', get_template_directory_uri().'/js/wow.js', array('jquery'), $version, true);

	// Animación del menú
	if (b_f_option('b_opt_sticky-menu-animated') == 1) {
		wp_register_script('menu', get_template_directory_uri().'/js/menu.js', array('jquery'), $version, true);
		$men_array = array(
			'responsive' => b_f_option('b_opt_responsive')
		);
		wp_localize_script('menu', 'menu', $men_array);
		wp_enqueue_script('menu');
	}

	// Hyphenator
	if (b_f_option('b_opt_hyphenator') == 1) {
		wp_register_script('hyphenator', get_template_directory_uri().'/js/hyphenator.js', array('jquery'), $version, true);
		$hyp_array = array(
			'selector' => b_f_option('b_opt_hyphenator-selector')
		);
		wp_localize_script('hyphenator', 'hyphenator', $hyp_array);
		wp_enqueue_script('hyphenator');
	}

	// Mapas
	wp_register_script('map', get_template_directory_uri().'/js/map.js', array('jquery'), $version, true);
	wp_register_script('google-map', 'https://maps.googleapis.com/maps/api/js?signed_in=false&callback=initMap', array('map'), $version, false);

	// Condicionales aplicados a los scripts
	add_filter('script_loader_tag', function ($tag, $handle) {
		if ('google-map' !== $handle)
			return $tag;
			return str_replace("&#038;", "&", str_replace(' src', ' async defer src', $tag));
	}, 10, 2);
	$asp = $_SERVER['REQUEST_URI'];
	$tkn = explode('/', $asp);
	$jsp = $tkn[sizeof($tkn)-1];
	if (b_f_option('b_opt_jquery-ui') == 1) {
		wp_enqueue_script('jquery-ui');
		wp_enqueue_style('jquery-ui-css');
		wp_enqueue_style('jquery-ui-css-theme');
	}
	if (b_f_option('b_opt_jquery-mobile') == 1) {
		wp_enqueue_script('jquery-mobile', get_template_directory_uri().'/js/jquery-mobile.js', array('bilnea'), $version, true);
		if (b_f_option('b_opt_jquery-mobile-css') == 1) {
			wp_enqueue_style('jquery-mobile-css', get_template_directory_uri().'/css/jquery-mobile.css', array());
		} else {
			wp_enqueue_script('jquery-mobile-js', get_template_directory_uri().'/js/jquery-mobile-min.js', array('jquery-mobile'));
		}
	}
	
	// Scripts específicos de la página
	if (file_exists(get_stylesheet_directory().'/js/'.$post->post_type.'-'.$post->ID.'.js')) {
		wp_enqueue_script($post->post_type.'-'.$post->ID.'-js', get_stylesheet_directory_uri().'/js/'.$post->post_type.'-'.$post->ID.'.js', array('jquery'), $version, true );
	}
	if (file_exists(get_stylesheet_directory_uri().'/css/'.$post->post_type.'-'.$post->ID.'.css')) {
		wp_enqueue_style($post->post_type.'-'.$post->ID.'-css', get_stylesheet_directory_uri().'/css/'.$post->post_type.'-'.$post->ID.'.css', array(), $version, true );
	}

	// Hoja de estilos responsive
	if (b_f_option('responsive_active') != 1) {
		wp_enqueue_style('responsive', get_template_directory_uri().'/css/responsive.css', array(), '', 'all and (max-width: '.b_f_option('b_opt_responsive').')');
	}
}

add_action('wp_enqueue_scripts', 'b_f_load');


// Añadir clase si se accede desde dispositivo móvil

function b_f_mobile_class($classes = '') {
	if ( wp_is_mobile() ){
		$classes[] = 'is-mobile';
	}
	return $classes;
}

add_filter('body_class','b_f_mobile_class');


// Añadir redes sociales al menú superior

if (b_f_option('b_opt_topbar-rss') == 1) {
	function b_f_topbar_rss($items, $args) {
		if($args->theme_location == 'menu_top')
			return $items.b_f_rrss('b_opt_topbar-rss',b_f_option('b_opt_header-rrss-icons'));

		return $items;
	}

	add_filter('wp_nav_menu_items','b_f_topbar_rss', 10, 2);
}


// Añadir selector de idioma al menú superior

if (function_exists('icl_object_id') && b_f_option('b_opt_language-header') == 1 && b_f_option('b_opt_language') == 1 && b_f_option('b_opt_topbar') == 1) {
	function b_f_topbar_language($items, $args) {
		if ($args->theme_location == 'menu_top') {
			$iny = '';
			$inz = '';
			$tot = 0;
			$idi = icl_get_languages('skip_missing=0&orderby=code');
			if (!empty($idi)) {
				if (b_f_option('b_opt_wpm-selector-top') == 2) { $cl = ' inline'; } else { $cl = ' dropdown'; }
				$iny .= '<ul class="language-selector top'.$cl.'">';
				foreach ($idi as $i) {
					if (!$i['active']) {
						$inz .= '<li><a href="'.$i['url'].'">';
						if (b_f_option('bandera_pais_head') == 1) {
							$inz .= '<img src="'.$i['country_flag_url'].'" height="12" alt="'.$i['language_code'].'" width="18" class="flag" />';
						}
						if (b_f_option('b_opt_language') == 1 && b_f_option('b_opt_wpm-language') == 1) {
							$inz .= $i['translated_name'];
						}
						if (b_f_option('b_opt_language') == 1 && b_f_option('b_opt_wpm-language') == 2) {
							$inz .= $i['native_name'];
						}
						$inz .= '</a></li>';
						$tot++;
					}
				}
				foreach ($idi as $i) {
					if ($i['active'] == 1) {
						$iny .= '<li><a href="'.$i['url'].'">';
						if (b_f_option('bandera_pais_head') == 1) {
							$iny .= '<img src="'.$i['country_flag_url'].'" height="12" alt="'.$i['language_code'].'" width="18" class="flag" />';
						}
						if (b_f_option('b_opt_language') == 1 && b_f_option('b_opt_wpm-language') == 1) {
							$iny .= $i['translated_name'];
						}
						if (b_f_option('b_opt_language') == 1 && b_f_option('b_opt_wpm-language') == 2) {
							$iny .= $i['native_name'];
						}
						$iny .= '<div class="selector"></div></a>';
						if ($tot > 0) {
							if (b_f_option('b_opt_wpm-selector-top') == 2) {
								$iny .= $inz;
							} else {
								$iny .= '<ul>'.$inz.'</ul>';
							}
						}
						$iny .= '</li>';
					}
				}
			}
			return $items.$iny;
		}
		return $items;
	}

	add_filter('wp_nav_menu_items','b_f_topbar_language', 10, 2);
}


// Redes sociales. $arg = clase del elemento padre. $opt = opciones (1: iconos normales, 2: iconos cuadrados)

function b_f_rrss($arg='',$opt=1) {

	switch ($opt) {
		case 2:
			$opt = '-square';
			break;
		
		default:
			$opt = '';
			break;
	}

	$txt = '';

	if (b_f_option('b_opt_social-facebook') != '' || b_f_option('b_opt_social-twitter') != '' || b_f_option('b_opt_social-google-plus') != '' || b_f_option('b_opt_social-youtube') != '' || b_f_option('b_opt_social-linkedin') != '' || b_f_option('b_opt_social-instagram') != '' || b_f_option('b_opt_social-pinterest') != '') {
		$wrk = true;
	} else {
		$wrk = false;
	}

	if ($wrk) { $txt = '<ul class="'.$arg.'">'; }

	if (b_f_option('b_opt_social-facebook') != '') {
		$fcb = b_f_option('b_opt_social-facebook');
		if (strpos($fcb,'facebook.com') === false) {
			$fcb = '//facebook.com/'.$fcb;
		}
		if (strpos($fcb,'http://') === false) {
			$fcb = '//'.$fcb;
		}
		$fcb = str_replace('http', '', str_replace('https', '', str_replace('http:', '', str_replace('https:', '', $fcb))));
		$txt .= '<li><a href="'.$fcb.'" title="Facebook" target="_blank" rel="nofollow"><i class="fa fa-facebook'.$opt.'"></i></a></li>';
	}

	if (b_f_option('b_opt_social-twitter') != '') {
		$twt = b_f_option('b_opt_social-twitter');
		if (strpos($twt,'twitter.com') === false) {
			if ($twt[0] == '@') $twt = ltrim($twt, '@');
			$twt = 'http://twitter.com/'.$twt;
		}
		if (strpos($twt,'http://') === false) {
			$twt = 'http://'.$twt;
		}
		$twt = str_replace('http', '', str_replace('https', '', str_replace('http:', '', str_replace('https:', '', $twt))));
		$txt .= '<li><a href="'.$twt.'" title="Twitter" target="_blank" rel="nofollow"><i class="fa fa-twitter'.$opt.'"></i></a></li>';
	}

	if (b_f_option('b_opt_social-google-plus') != '') {
		$gop = b_f_option('b_opt_social-google-plus');
		if (strpos($gop,'http://') === false) {
			$gop = 'http://'.$gop;
		}
		$gop = str_replace('http', '', str_replace('https', '', str_replace('http:', '', str_replace('https:', '', $gop))));
		$txt .= '<li><a href="'.$gop.'" title="Google+" target="_blank" rel="nofollow"><i class="fa fa-google-plus'.$opt.'"></i></a></li>';
	}

	if (b_f_option('b_opt_social-youtube') != '') {
		$ytb = b_f_option('b_opt_social-youtube');
		if (strpos($ytb,'http://') === false) {
			$ytb = 'http://'.$ytb;
		}
		$ytb = str_replace('http', '', str_replace('https', '', str_replace('http:', '', str_replace('https:', '', $ytb))));
		$txt .= '<li><a href="'.$ytb.'" title="Youtube" target="_blank" rel="nofollow"><i class="fa fa-youtube'.$opt.'"></i></a></li>';
	}

	if (b_f_option('b_opt_social-linkedin') != '') {
		$lkn = b_f_option('b_opt_social-linkedin');
		if (strpos($lkn,'http://') === false) {
			$lkn = 'http://'.$lkn;
		}
		$lkn = str_replace('http', '', str_replace('https', '', str_replace('http:', '', str_replace('https:', '', $lkn))));
		$txt .= '<li><a href="'.$lkn.'" title="Linkedin" target="_blank" rel="nofollow"><i class="fa fa-linkedin'.$opt.'"></i></a></li>';
	}

	if (b_f_option('b_opt_social-instagram') != '') {
		$itg = b_f_option('b_opt_social-instagram');
		if (strpos($itg,'instagram.com') === false) {
			if ($itg[0] == '@') $itg = ltrim($itg, '@');
			$itg = 'http://instagram.com/'.$itg;
		}
		if (strpos($itg,'http://') === false) {
			$itg = 'http://'.$itg;
		}
		$itg = str_replace('http', '', str_replace('https', '', str_replace('http:', '', str_replace('https:', '', $itg))));
		$txt .= '<li><a href="'.$itg.'" title="Instagram" target="_blank" rel="nofollow"><i class="fa fa-instagram'.$opt.'"></i></a></li>';
	}

	if (b_f_option('b_opt_social-pinterest') != '') {
		$pin = b_f_option('b_opt_social-pinterest');
		if (strpos($pin,'pinterest.com') === false) {
			$pin = 'http://pinterest.com/'.$pin;
		}
		if (strpos($pin,'http://') === false) {
			$pin = 'http://'.$pin;
		}
		$pin = str_replace('http', '', str_replace('https', '', str_replace('http:', '', str_replace('https:', '', $pin))));
		$txt .= '<li><a href="'.$pin.'" title="Pinterest" target="_blank" rel="nofollow"><i class="fa fa-pinterest'.$opt.'"></i></a></li>';
	}

	if ($wrk) { $txt .= '</ul>'; }

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


// Proteger acceso al panel de administración

if ((b_f_option('b_opt_wp-admin') != '' && b_f_option('b_opt_wp-admin') != 'wp-admin') && !is_user_logged_in()) {
	if ($_SERVER['PHP_SELF'] != '/wp-admin/admin-ajax.php') {
		if ((strpos($_SERVER['REQUEST_URI'], 'wp-login.php') || strpos($_SERVER['REQUEST_URI'], 'wp-admin')) && !strpos($_SERVER['HTTP_REFERER'], b_f_option('b_opt_wp-admin'))) {
			include_once(get_stylesheet_directory().'/404.php');
			die();
		} else if (strpos($_SERVER['REQUEST_URI'], b_f_option('b_opt_wp-admin'))) {
			wp_enqueue_script('jquery');
			wp_enqueue_style('custom-login-css', get_stylesheet_directory_uri().'/css/login.css');
			wp_enqueue_script('custom-login-js', get_stylesheet_directory_uri().'/js/login.js');
			include_once(ABSPATH.'/wp-login.php');
			die();
		}
	}
} else if ((b_f_option('b_opt_wp-admin') != '' && b_f_option('b_opt_wp-admin') != 'wp-admin') && is_user_logged_in()) {
	if (strpos($_SERVER['REQUEST_URI'], b_f_option('b_opt_wp-admin'))) {
		wp_enqueue_script('jquery');
		wp_enqueue_style('custom-login-css', get_stylesheet_directory_uri().'/css/login.css');
		wp_enqueue_script('custom-login-js', get_stylesheet_directory_uri().'/js/login.js');
		include_once(ABSPATH.'/wp-login.php');
		die();
	}
}

function b_f_go_home() {
	wp_redirect(home_url());
	exit();
}

add_action('wp_logout','b_f_go_home');


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


// Añadir buscador en la barra del menú

function b_f_search_in_menu($items, $args) {
	if( $args->theme_location == 'menu_main' ) {
		ob_start();
		get_search_form();
		$search = ob_get_clean();
		return $items.'<li id="menu-item-search">'.$search.'</li>';
	}
	return $items;
}

if (b_f_option('b_opt_header-search') == 1 && b_f_option('b_opt_header-search-location') == 2) {
	add_filter('wp_nav_menu_items','b_f_search_in_menu', 10, 2);
}

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
	if(isset($c['custom_sidebar'])) {
		$val = $c['custom_sidebar'][0];
	} else {
		$val = 'default';
	}
	wp_nonce_field(plugin_basename( __FILE__ ), 'custom_sidebar_nonce');
	$out = '<p><label for="custom_sidebar">Selecciona la barra lateral que se mostrará.</label></p>';
	$out .= '<select name="custom_sidebar" style="width: 100%;">';
	$out .= '<option';
	if($val == 'default')
		$out .= 'selected="selected"';
	$out .= ' value="default">Barra lateral por defecto</option>';
	foreach($wp_registered_sidebars as $sidebar_id => $sidebar) {
		if (strpos($sidebar['name'], 'Footer #') === false) {
			$out .= '<option';
			if($sidebar_id == $val)
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
	if (!wp_verify_nonce( $_POST['custom_sidebar_nonce'], plugin_basename(__FILE__))) {
		return;
	}
	if (!current_user_can('edit_page', $post_id)) {
		return;
 	}
	$data = $_POST['custom_sidebar'];
	update_post_meta($post_id, 'custom_sidebar', $data);
}

add_action('add_meta_boxes', 'crear_metabox_sidebar');
add_action('save_post', 'metabox_sidebar_guardar');


// Creamos una función para saber si estamos en la página del blog

function is_blog () {
	global  $post;
	$posttype = get_post_type($post );
	return ( ((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (!is_single()) || (is_tag())) && ( $posttype == 'post')  ) ? true : false ;
}


// Añadimos uns verificación de seguridad en el formulario de comentarios del blog
/*
function b_f_visitor_ip() {
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$vip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$vip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$vip = $_SERVER['REMOTE_ADDR'];
	}
	return apply_filters('dm_get_ip', $vip);
}

function b_f_blog_spam($commentdata) {
	$ukey = md5(b_f_visitor_ip().date('Y-m-d', time()));
	if(isset($_POST['bilnea_grant']) && trim($_POST['bilnea_grant']) == $ukey) {
		return $commentdata;
	} else {
		die('No SPAM allowed');
	}
}

if(function_exists('add_action')) {
	$ukey = md5(b_f_visitor_ip().date('Y-m-d', time()));
	add_action('preprocess_comment', 'b_f_blog_spam');
	wp_register_script('blog-spam', get_template_directory_uri().'/js/blog-spam.js', array('jquery'), $version, true);
	$var_array = array(
		'key' => $ukey
	);
	wp_localize_script('blog-spam', 'blogspam', $var_array);
	wp_enqueue_script('blog-spam');
}
*/

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


// Cremos la página de cookies

if (b_f_option('b_opt_create-cookies-page') == 1) {
	b_f_create_page('cookies');
} else {
	if (function_exists('icl_object_id')) {
		$lng = icl_get_languages('skip_missing=0&orderby=code');
		if (!empty($lng)) {
			foreach ($lng as $l) {
				$options = get_option('bilnea_settings');
				$options['cookies_id_'.$l['language_code']] = '';
				$options['b_opt_cookies-url-_'.$l['language_code']] = '';
				update_option('bilnea_settings', $options);
			}
		}
	} else {
		$options = get_option('bilnea_settings');
		$options['cookies_id_es'] = '';
		$options['b_opt_cookies-url-_es'] = '';
		update_option('bilnea_settings', $options);
	}
}

if (b_f_option('b_opt_create-legal-page') == 1) {
	b_f_create_page('legal');
} else {
	if (function_exists('icl_object_id')) {
		$lng = icl_get_languages('skip_missing=0&orderby=code');
		if (!empty($lng)) {
			foreach ($lng as $l) {
				$options = get_option('bilnea_settings');
				$options['legal_id_'.$l['language_code']] = '';
				$options['b_opt_legal-url-_'.$l['language_code']] = '';
				update_option('bilnea_settings', $options);
			}
		}
	} else {
		$options = get_option('bilnea_settings');
		$options['legal_id_es'] = '';
		$options['b_opt_legal-url-_es'] = '';
		update_option('bilnea_settings', $options);
	}
}

if (b_f_option('b_opt_create-privacy-page') == 1) {
	b_f_create_page('privacy');
} else {
	if (function_exists('icl_object_id')) {
		$lng = icl_get_languages('skip_missing=0&orderby=code');
		if (!empty($lng)) {
			foreach ($lng as $l) {
				$options = get_option('bilnea_settings');
				$options['privacy_id_'.$l['language_code']] = '';
				$options['b_opt_privacy-url-_'.$l['language_code']] = '';
				update_option('bilnea_settings', $options);
			}
		}
	} else {
		$options = get_option('bilnea_settings');
		$options['privacy_id_es'] = '';
		$options['b_opt_privacy-url-_es'] = '';
		update_option('bilnea_settings', $options);
	}
}

function b_f_create_page($pgn) {
	if (function_exists('icl_object_id')) {
		$lng = icl_get_languages('skip_missing=0&orderby=code');
		if (!empty($lng)) {
			global $sitepress;
			global $wpdb;
			$idioma = $sitepress->get_default_language();
			$main_id = '';
			foreach ($lng as $l) {
				include_once(get_template_directory().'/inc/'.$l['language_code'].'/'.$pgn.'.php');
				if (b_f_option($pgn.'_id_'.$l['language_code']) == '' && $l['language_code'] == $idioma && get_page_by_title(b_f_default()['name_'.$pgn.'_'.$l['language_code']]) == NULL) {
					$page = array(
						'post_title'    => b_f_default()['name_'.$pgn.'_'.$l['language_code']],
						'post_content'  => $txt,
						'post_status'   => 'publish',
						'post_author'   => 1,
						'post_type'     => 'page',
						'post_name'     => b_f_default()['socket_'.$pgn.'_'.$l['language_code']],
						'post_parent'	=> 0,
						'page_template'	=> 'blank-page.php'
					);
					$new_id = wp_insert_post($page);
					$options = get_option('bilnea_settings');
					$options[$pgn.'_id_'.$l['language_code']] = $new_id;
					$options['socket_'.$pgn.'_'.$l['language_code']] = b_f_default()['socket_'.$pgn.'_'.$l['language_code']];
					update_option('bilnea_settings', $options);
					$main_id = $new_id;
					$wpdb->update($wpdb->prefix.'icl_translations', array('element_type'=>"post_page", 'trid'=>$main_id, 'language_code'=>$l['language_code']), array('element_id'=>$new_id));
				}
			}
			foreach ($lng as $l) {
				include_once(get_template_directory().'/inc/'.$l['language_code'].'/'.$pgn.'.php');
				if (b_f_option($pgn.'_id_'.$l['language_code']) == '' && $l['language_code'] != $idioma && get_page_by_title(b_f_default()['name_'.$pgn.'_'.$l['language_code']]) == NULL) {
					$page = array(
						'post_title'    => b_f_default()['name_'.$pgn.'_'.$l['language_code']],
						'post_content'  => $txt,
						'post_status'   => 'publish',
						'post_author'   => 1,
						'post_type'     => 'page',
						'post_name'     => b_f_default()['socket_'.$pgn.'_'.$l['language_code']],
						'post_parent'	=> 0,
						'page_template'	=> 'blank-page.php'
					);
					$new_id = wp_insert_post($page);
					$options = get_option('bilnea_settings');
					$options[$pgn.'_id_'.$l['language_code']] = $new_id;
					$options['socket_'.$pgn.'_'.$l['language_code']] = b_f_default()['socket_'.$pgn.'_'.$l['language_code']];
					update_option('bilnea_settings', $options);
					$wpdb->update($wpdb->prefix.'icl_translations', array('element_type'=>"post_page", 'language_code'=>$l['language_code'], 'trid'=>$main_id, 'source_language_code'=>$idioma), array('element_id'=>$new_id));
				}
			}
		}
	} else {
		include_once('/inc/es/'.$pgn.'.php');

		if (b_f_option($pgn.'_id_es') == '' && get_page_by_title(b_f_default()['name_'.$pgn.'_es']) == NULL) {
			$page = array(
				'post_title'    => b_f_default()['name_'.$pgn.'_es'],
				'post_content'  => $txt,
				'post_status'   => 'publish',
				'post_author'   => 1,
				'post_type'     => 'page',
				'post_name'     => b_f_option('socket_'.$pgn.'_es'),
				'post_parent'	=> 0,
				'page_template'	=> 'blank-page.php'
			);
			wp_insert_post($page);
			$pig = get_page_by_title(b_f_default()['name_'.$pgn.'_es']);
			$options = get_option('bilnea_settings');
			$options[$pgn.'_id_es'] = $pig->ID;
			update_option('bilnea_settings', $options);
		}
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
	wp_register_script('mailpoet-bilnea', get_template_directory_uri().'/js/mailpoet.js', array('jquery'), $version, true);
	$var_array = array(
		'text' => $text
	);
	wp_localize_script('mailpoet-bilnea', 'mailpoetbilnea', $var_array);
	wp_enqueue_script('mailpoet-bilnea');
}


// Eliminar comentarios en fichas de adjuntos

function b_f_attachment_comments($open, $post_id) {
	$post = get_post( $post_id );
	if( $post->post_type == 'attachment' ) {
		return false;
	}
	return $open;
}

add_filter('comments_open', 'b_f_attachment_comments', 10, 2);


// Reordenar el formulario de comentarios

function b_f_comment_form($fld) {
	$com = $fld['comment'];
	unset($fld['comment']);
	$fld['comment'] = $com;
	return $fld;
}

add_filter('comment_form_fields', 'b_f_comment_form');


// Deshabilitar el editor visual para páginas

function b_f_rich_editor($content) {
	global $post_type;

	if ('page' == $post_type) {
		return false;
	}
	return $content;
}

add_filter('user_can_richedit', 'b_f_rich_editor');


// Reemplazar pseudshortcode directorio principal

function b_f_p_root($content) {
	$content = str_replace('[b_root]', get_site_url(), $content);
	$content = str_replace('{{b_root}}', get_site_url(), $content);
	return $content;
}

add_filter('the_content','b_f_p_root');


// Reemplazar pseudshortcode directorio uploads

function b_f_p_upload($content) {
	$dir = wp_upload_dir();
	$dir = $dir['baseurl'];
	$content = str_replace('[b_upload]', $dir, $content);
	$content = str_replace('{{b_upload}}', $dir, $content);
	return $content;
}

add_filter('the_content','b_f_p_upload');


// Reemplazar pseudoshortcode objeto

function b_f_i_url($arg) {
	if (get_post_type($arg[1]) == 'attachment') {
		return wp_get_attachment_url($arg[1]);
	} else {
		return get_permalink($arg[1]);
	}
}

function b_f_p_id($content) {
	$content = preg_replace_callback("/{{b_id-([0-9]+)}}/", "b_f_i_url", $content);
	return $content;
}

add_filter('the_content','b_f_p_id');


// Función para crear extracto desde el contenido

function b_f_get_excerpt($a, $z=null, $y=0, $x = false) {
	if ($x == true) {
		if ($z == null) {
			$z = b_f_option('b_opt_blog-excerpt-length');
		}
		$d = false;
		$b = split(' ', $a);
		if (count($b) > $z) {
			$b = array_splice($b, 0, $z);
			$d = true;
		}
		$e = join(' ', $b);
		$e = rtrim($e, '.,;:');
		if ($d == true) {
			$e .= '...';
		}
	} else {
		if ($z == null) {
			$z = b_f_option('b_opt_blog-excerpt-length');
		}
		if(strlen($a) > $z) {
			$e = substr($a, $y, $z-3);
			$b = strrpos($e, ' ');
			$e = substr($e, 0, $b);
			$e = rtrim($e, '.,;:');
			$e .= '...';
		} else {
			$e = $a;
		}
	}
	
	return $e;
}

// Incluimos los datos externos

require_once('inc/data.php');


// Incluimos los widgets

require_once('inc/widgets.php');


// Incluimos los shortcodes

require_once('inc/shortcodes.php');