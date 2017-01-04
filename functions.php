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

			// Super Simple Slider
			case 'supersimpleslider':
				return '2004';
				break;

		}

	}

}


// Carga de ficheros por directorio

if (!function_exists('b_f_include')) {
	
	function b_f_include($var_dir, $var_recursively = true) {
		if(is_dir($var_dir)) {
			$var_relative = str_replace(dirname(__FILE__).'/', '', $var_dir);
			$var_scan = scandir($var_dir);
			unset($var_scan[0], $var_scan[1]);
			foreach($var_scan as $var_file) {
				if(is_dir($var_dir.'/'.$var_file) && $var_recursively == true) {
					b_f_include($var_dir.'/'.$var_file);
				} else if (!is_dir($var_dir.'/'.$var_file)) {
					require($var_relative.'/'.$var_file);
				}
			}
		}
	}

}


// Variables globales

include('inc/data/data.globals.php');


// Variables por defecto

include('inc/data/data.defaults.php');


// Funciones PHP

b_f_include(get_template_directory().'/inc/functions');


// Borrado de elementos de prueba

wp_delete_post(1, true);
wp_delete_post(2, true);


// Mostrar título

function b_f_title() {
	add_theme_support('title-tag');
}

add_action('after_setup_theme', 'b_f_title');


// Localización del tema

load_theme_textdomain('bilnea', get_template_directory().'/languages');

function b_f_locale() {
	return 'es_ES';
}

load_default_textdomain();

add_filter('locale', 'b_f_locale');


// Preparación scripts

if (!function_exists('b_f_load_scripts')) {
	
	function b_f_load_scripts()  {

		// Variables globales
		global $b_g_version;

		// Scripts del tema
		wp_register_script('functions.main', get_template_directory_uri().'/js/internal/functions.main.js', array('jquery'), $b_g_version, true);
		wp_register_script('functions.anchor', get_template_directory_uri().'/js/internal/functions.anchor.js', array('jquery'), $b_g_version, true);
		wp_register_script('functions.accordion', get_template_directory_uri().'/js/internal/functions.accordion.js', array('jquery'), $b_g_version, true);
		wp_register_script('functions.design.parallax', get_template_directory_uri().'/js/internal/functions.design.parallax.js', array('jquery'), $b_g_version, true);
		wp_register_script('functions.design.menu', get_template_directory_uri().'/js/internal/functions.design.menu.js', array('jquery'), $b_g_version, true);
		wp_register_script('functions.admin', get_template_directory_uri().'/js/internal/functions.admin.js', array(), $b_g_version, true);
			
		// Scripts del tema hijo
		wp_register_script('functions.child.main', get_stylesheet_directory_uri().'/js/main.js', array('jquery'), $b_g_version, true);
		wp_register_script('functions.child.admin', get_stylesheet_directory_uri().'/js/admin.js', array('jquery', 'functions.admin'), $b_g_version, true);

		// jQuery UI
		wp_register_script('functions.core.jquery.ui', get_template_directory_uri().'/js/external/functions.core.jquery.ui.js', array('jquery'), b_f_versions('jquery-ui'), true);

		// Select2
		wp_register_script('functions.design.select2', get_template_directory_uri().'/js/external/functions.design.select2.js', array('jquery'), b_f_versions('select2'), true);

		// Fitvids
		wp_register_script('functions.design.fitvids', get_template_directory_uri().'/js/external/functions.design.fitvids.js', array('jquery'), b_f_versions('fitvids'), true);

		// Query object
		wp_register_script('functions.core.jquery.queryobject', get_template_directory_uri().'/js/external/functions.core.jquery.queryobject.js', array('jquery'), b_f_versions('query-object'), true);

		// Anticopia
		wp_register_script('functions.anticopy', get_template_directory_uri().'/js/internal/functions.anticopy.js', array(), $b_g_version, true);

		// Lightbox
		wp_register_script('functions.design.magnificpopup', get_template_directory_uri().'/js/external/functions.design.magnificpopup.js', array('jquery'), b_f_versions('magnific-popup'), false);
		$var_temp = array(
			'labels' => array(
				'of' => __('of', 'bilnea')
			)
		);
		wp_localize_script('functions.main', 'magnificpopup', $var_temp);
		wp_register_script('functions.design.magnificpopup.internal', get_template_directory_uri().'/js/internal/functions.design.magnificpopup.js', array('functions.design.magnificpopup'), b_f_versions('magnific-popup'), false);

		// Animación de colores
		wp_register_script('functions.design.animatecolors', get_template_directory_uri().'/js/external/functions.design.animatecolors.js', array('jquery'), b_f_versions('animate-colors'), true);

		// Wow!
		wp_register_script('functions.design.wow', get_template_directory_uri().'/js/external/functions.design.wow.js', array('jquery'), b_f_versions('wow'), true);

		// Hyphenator
		wp_register_script('functions.design.hyphenator', get_template_directory_uri().'/js/external/functions.design.hyphenator.js', array('jquery'), b_f_versions('hyphenator'), true);

		// jQuery UI Mobile
		wp_register_script('functions.core.jquery.mobile', get_template_directory_uri().'/js/external/functions.core.jquery.mobile.js', array('bilnea'), b_f_versions('jquery-ui-mobile'), true);

		// Spectrum
		wp_register_script('functions.functionality.spectrum', get_template_directory_uri().'/js/external/functions.functionality.spectrum.js', array('jquery'), b_f_versions('spectrum'), true);

		// Super Simple Slider
		wp_register_script('functions.slider', get_template_directory_uri().'/js/internal/functions.slider.js', array('jquery'), b_f_versions('supersimpleslider'), false);

	}

}


// Carga scripts Frontend

if (!function_exists('b_f_frontend_scripts')) {
	
	function b_f_frontend_scripts() {

		// Variables globales
		global $post;
		global $b_g_version;

		// Variables locales
		$var_log = 'Scripts loaded:\n';

		// Carga scripts
		b_f_load_scripts();

		$var_temp = array(
			'version' => $b_g_version,
			'root_url' => site_url()
		);
		wp_localize_script('functions.main', 'bilnea', $var_temp);
		wp_enqueue_script('functions.main');
		wp_enqueue_script('functions.anchor');
		wp_enqueue_script('functions.accordion');
		wp_enqueue_script('functions.child.main');

		wp_enqueue_script('functions.design.fitvids');
		$var_log .= 'Fitvids '.b_f_versions('fitvids').'\n';

		wp_enqueue_script('functions.core.jquery.queryobject');
		$var_log .= 'Query Object '.b_f_versions('query-object').'\n';

		wp_enqueue_script('functions.design.wow');
		$var_log .= 'Wow '.b_f_versions('wow').'\n';

		wp_enqueue_script('functions.design.animatecolors');
		$var_log .= 'Animated Colors '.b_f_versions('animate-colors').'\n';

		if (b_f_option('b_opt_anticopy') == 1) {
			wp_enqueue_script('functions.anticopy');
		}

		if (b_f_option('b_opt_lightbox') == 1) {
			wp_enqueue_script('functions.design.magnificpopup');
			wp_enqueue_script('functions.design.magnificpopup.internal');
			$var_log .= 'Magnific Popup '.b_f_versions('magnific-popup').'\n';
		}

		if (b_f_option('b_opt_sticky-menu-animated') == 1) {
			$var_temp = array(
				'responsive' => b_f_option('b_opt_responsive')
			);
			wp_localize_script('functions.design.menu', 'menu', $var_temp);
			wp_enqueue_script('functions.design.menu');
		}

		if (b_f_option('b_opt_hyphenator') == 1) {
			$var_temp = array(
				'selector' => b_f_option('b_opt_hyphenator-selector')
			);
			wp_localize_script('functions.design.hyphenator', 'hyphenator', $var_temp);
			wp_enqueue_script('functions.design.hyphenator');
			$var_log .= 'Hyphenator '.b_f_versions('hyphenator').'\n';
		}

		if (b_f_option('b_opt_jquery-ui') == 1) {
			wp_enqueue_script('functions.core.jquery.ui');
			$var_log .= 'jQuery UI '.b_f_versions('jquery-ui').'\n';
		}

		if (b_f_option('b_opt_select2') == 1) {
			wp_enqueue_script('functions.design.select2');
			$var_log .= 'Select2 '.b_f_versions('select2').'\n';
		}

		if (b_f_option('b_opt_jquery-mobile') == 1) {
			wp_enqueue_script('functions.core.jquery.mobile');
			$var_log .= 'jQuery UI Mobile '.b_f_versions('jquery-ui-mobile').'\n';
		}

		if (has_shortcode($post->post_content, 'b_slider')) {
			wp_enqueue_script('functions.slider');
			$var_log .= 'Super Simple Slider '.b_f_versions('supersimpleslider').'\n';
		}

		// Scripts específicos de la página
		if (file_exists(get_stylesheet_directory().'/js/'.$post->post_type.'-'.$post->ID.'.js')) {
			wp_enqueue_script($post->post_type.'-'.$post->ID.'-js', get_stylesheet_directory_uri().'/js/'.$post->post_type.'-'.$post->ID.'.js', array('jquery'), $b_g_version, true );
		}

		add_filter('script_loader_tag', function ($var_tag, $var_handle) {
			if ('functions.google.map' !== $var_handle) {
				return $var_tag;
			} else {
				return str_replace("&#038;", "&", str_replace(' src', ' async defer src', $var_tag));
			}
		}, 10, 2);

		?>

		<script type="text/javascript">
			console.log('<?= $var_log ?>');
		</script>

		<?php

	}

	add_action('wp_enqueue_scripts', 'b_f_frontend_scripts');

}


// Carga scripts Backend

if (!function_exists('b_f_backend_scripts')) {
	
	function b_f_backend_scripts() {

		// Variables globales
		global $b_g_version;

		// Variables locales
		$var_log = 'Scripts loaded:\n';

		// Carga scripts
		b_f_load_scripts();

		$var_temp = array(
			'version' => $b_g_version
		);
		foreach ($_GET as $key => $value) {
			$var_temp['get'][$key] = $value;
		}
		wp_localize_script('functions.admin', 'bilnea', $var_temp);
		wp_enqueue_script('functions.admin');
		wp_enqueue_script('functions.accordion');
		wp_enqueue_script('functions.child.admin');

		wp_enqueue_script('functions.core.jquery.ui');
		$var_log .= 'jQuery UI '.b_f_versions('jquery-ui').'\n';

		wp_enqueue_script('functions.design.select2');
		$var_log .= 'Select2 '.b_f_versions('select2').'\n';

		wp_enqueue_script('functions.functionality.spectrum');
		$var_log .= 'Spectrum '.b_f_versions('spectrum').'\n';

		add_filter('script_loader_tag', function ($var_tag, $var_handle) {
			if ('functions.google.map' !== $var_handle) {
				return $var_tag;
			} else {
				return str_replace("&#038;", "&", str_replace(' src', ' async defer src', $var_tag));
			}
		}, 10, 2);
			
		?>

		<script type="text/javascript">
			console.log('<?= $var_log ?>');
		</script>

		<?php

		wp_enqueue_script('wp-color-picker');

		wp_enqueue_script('thickbox');
		wp_enqueue_script('media-upload');
		wp_enqueue_media();

	}

	add_action('admin_enqueue_scripts', 'b_f_backend_scripts');

}


// Preparación hojas de estilos

if (!function_exists('b_f_load_styles')) {
	
	function b_f_load_styles()  {

		// Variables globales
		global $b_g_version;

		// Hojas de estilos del tema
		wp_register_style('styles.bilnea', get_stylesheet_directory_uri().'/style.css', false, $b_g_version);
		wp_register_style('styles.main', get_template_directory_uri().'/styles/styles.main.php', false, $b_g_version);
		wp_register_style('styles.admin', get_template_directory_uri().'/css/internal/styles.admin.css', array('styles.functionality.spectrum'), $b_g_version);
		

		// Hojas de estilos del tema hijo
		wp_register_style('styles.child.main', get_stylesheet_directory_uri().'/css/main.css', false, $b_g_version);
		wp_register_style('styles.child.admin', get_stylesheet_directory_uri().'/css/admin.css', false, $b_g_version);

		// Font Awesome
		wp_register_style('styles.design.fonts.awesome', get_template_directory_uri().'/css/external/styles.design.fonts.awesome.css', false, b_f_versions('font-awesome'));

		// Lightbox
		wp_register_style('styles.design.magnificpopup', get_template_directory_uri().'/css/external/styles.design.magnificpopup.css', false, b_f_versions('magnificpopup'));

		// jQuery UI
		wp_register_style('styles.core.jquery.ui', get_template_directory_uri().'/css/external/styles.core.jquery.ui.theme.css', false, b_f_versions('jquery-ui'));
		wp_register_style('styles.core.jquery.ui.theme', get_template_directory_uri().'/css/external/styles.core.jquery.ui.theme.css', false, b_f_versions('jquery-ui'));

		// Select2
		wp_register_style('styles.design.select2', get_template_directory_uri().'/css/external/styles.design.select2.css', false, b_f_versions('select2'));

		// Animate.css
		wp_register_style('styles.design.animate', get_template_directory_uri().'/css/external/styles.design.animate.css', false, b_f_versions('animate-css'));

		// Spectrum
		wp_register_style('styles.functionality.spectrum', get_template_directory_uri().'/css/external/styles.functionality.spectrum.css', false, b_f_versions('spectrum'));

	}

}


// Hojas de estilos del frontend

if (!function_exists('b_f_frontend_styles')) {
	
	function b_f_frontend_styles() {

		// Variables globales
		global $post;
		global $b_g_version;

		// Variables locales
		$var_log = 'Styles loaded:\n';

		// Carga estilos
		b_f_load_styles();

		wp_enqueue_style('styles.bilnea');
		wp_enqueue_style('styles.main');
		wp_enqueue_style('styles.child.main');

		wp_enqueue_style('styles.design.fonts.awesome');
		$var_log .= 'Font Awesome '.b_f_versions('font-awesome').'\n';

		wp_enqueue_style('styles.design.animate');
		$var_log .= 'Animate.css '.b_f_versions('animate-css').'\n';

		if (b_f_option('b_opt_lightbox') == 1) {
			wp_enqueue_style('styles.design.magnificpopup');
		}

		if (b_f_option('b_opt_jquery-ui') == 1) {
			wp_enqueue_style('styles.core.jquery.ui');
			wp_enqueue_style('styles.core.jquery.ui.theme');
		}

		if (b_f_option('b_opt_select2') == 1) {
			wp_enqueue_style('styles.design.select2');
		}

		if (b_f_option('b_opt_jquery-mobile') == 1 && b_f_option('b_opt_jquery-mobile-css') == 1) {
			wp_enqueue_style('styles.core.jquery.mobile', get_template_directory_uri().'/css/external/styles.core.jquery.mobile.css', array());
		}

		// Hojas de estilo específicas de la página
		if (file_exists(get_stylesheet_directory_uri().'/css/'.$post->post_type.'-'.$post->ID.'.css')) {
			wp_enqueue_style($post->post_type.'-'.$post->ID.'-css', get_stylesheet_directory_uri().'/css/'.$post->post_type.'-'.$post->ID.'.css', array(), $b_g_version, true );
		}

		?>

		<script type="text/javascript">
			console.log('<?= $var_log ?>');
		</script>

		<?php

	}

	add_action('wp_enqueue_scripts', 'b_f_frontend_styles');

}


// Hojas de estilos del backend

if (!function_exists('b_f_backend_styles')) {
	
	function b_f_backend_styles() {

		// Variables globales
		global $b_g_version;

		// Variables locales
		$var_log = 'Styles loaded:\n';

		// Carga estilos
		b_f_load_styles();

		wp_enqueue_style('styles.functionality.spectrum');

		wp_enqueue_style('styles.admin');
		wp_enqueue_style('styles.child.admin');

		wp_enqueue_style('styles.design.fonts.awesome');
		$var_log .= 'Font Awesome '.b_f_versions('font-awesome').'\n';

		if (b_f_option('b_opt_lightbox') == 1) {
			wp_enqueue_style('styles.design.magnificpopup');
		}

		wp_enqueue_style('styles.core.jquery.ui');
		wp_enqueue_style('styles.core.jquery.ui.theme');

		wp_enqueue_style('styles.design.select2');

		?>

		<script type="text/javascript">
			console.log('<?= $var_log ?>');
		</script>

		<?php

		wp_enqueue_style('wp-color-picker');

		wp_enqueue_style('thickbox');

	}

	add_action('admin_enqueue_scripts', 'b_f_backend_styles');

}







// Archivos necesarios

$new_files = ['404.php','css/login.css','js/login.js','css/main.css','js/main.js', 'css/admin.css','loader.php'];

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

if(!file_exists(get_stylesheet_directory().'/js/loader.js')) {
	$file = fopen(get_stylesheet_directory().'/js/loader.js', 'w');
	$txt = '';
	$txt .= 'var b_f_load = 0;'."\n";
	$txt .= 'document.onreadystatechange = function(e) {'."\n";
	$txt .= '	if(document.readyState=="interactive") {'."\n";
	$txt .= '		var all = document.getElementsByTagName("*");'."\n";
	$txt .= '		for (var i=0, max=all.length; i < max; i++) {'."\n";
	$txt .= '			set_ele(all[i]);'."\n";
	$txt .= '		}'."\n";
	$txt .= '	}'."\n";
	$txt .= '}'."\n";
	$txt .= ''."\n";
	$txt .= 'function check_element(ele) {'."\n";
	$txt .= '	var all = document.getElementsByTagName("*");'."\n";
	$txt .= '	var totalele=all.length;'."\n";
	$txt .= '	var per_inc=100/all.length;'."\n";
	$txt .= ''."\n";
	$txt .= '	if(jQuery(ele).on()) {'."\n";
	$txt .= '		b_f_load = (Math.ceil((per_inc+b_f_load)*10000))/10000;'."\n";
	$txt .= '		if (b_f_load >= 100) {'."\n";
	$txt .= '			jQuery(\'#loader-wrap\').fadeOut(100, function() {'."\n";
	$txt .= '				jQuery(\'#loader-wrap\').remove();'."\n";
	$txt .= '			})'."\n";
	$txt .= '		}'."\n";
	$txt .= '	} else {'."\n";
	$txt .= '		set_ele(ele);'."\n";
	$txt .= '	}'."\n";
	$txt .= '}'."\n";
	$txt .= ''."\n";
	$txt .= 'function set_ele(set_element) {'."\n";
	$txt .= '	check_element(set_element);'."\n";
	$txt .= '}'."\n";

	file_put_contents(get_stylesheet_directory().'/js/loader.js', $txt);
}

// Archivos innecesarios

$old_files = ['readme.html','wp-config-sample.php','licencia.txt','license.txt'];

foreach ($old_files as $old) {
	if(file_exists(ABSPATH.$old)) {
		unlink(ABSPATH.$old);
	}
}


// Redefinición de slugs

function re_rewrite_rules() {
	global $wp_rewrite;
	$wp_rewrite->author_base = __('author', 'bilnea');
	$wp_rewrite->search_base = __('search', 'bilnea');
	$wp_rewrite->comments_base = __('comments', 'bilnea');
	$wp_rewrite->pagination_base = __('page', 'bilnea');
	$wp_rewrite->flush_rules();
}

add_action('init', 're_rewrite_rules');


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


// Añadir tema al panel de administración

function b_f_admin_menu() { 
	add_menu_page('Opciones del tema', 'bilnea', 'manage_options', 'bilnea', 'b_f_options_page', get_template_directory_uri().'/img/b-bilnea.png', 75);
}

add_action('admin_menu', 'b_f_admin_menu');

function b_f_subscribers_menu() { 
	add_submenu_page('bilnea', 'Suscriptores', 'Suscriptores', 'manage_options', 'subscribers', 'bilnea_subscribers_page');
}

if (b_f_option('b_opt_subscribers') == 1) {
	add_action('admin_menu', 'b_f_subscribers_menu');
}


// Variable para almacenar las opciones del tema

function b_f_variables() { 
	register_setting( 'pluginPage', 'bilnea_settings' );
}

add_action('admin_init', 'b_f_variables');



// Modificamos los puntos suspensivos utilizados al acortar texto

function custom_excerpt_more($more) {
	return '...';
}

add_filter( 'excerpt_more', 'custom_excerpt_more' );





// Función que devuelve un valor en métrica

function b_f_size($arg='', $ovf=0) {
	$num = preg_replace('/\s+/', '', b_f_option($arg, true));
	$num = str_replace('px', '', $num);
	if (ctype_digit($num)) {
		$num = $num+$ovf;
		$num .= 'px';
	}
	return $num;
}

function b_f_size_unit($var_size) {
	$var_number = str_replace('px', '', preg_replace('/\s+/', '', $var_size));
	if (is_numeric($var_number)) {
		$var_number .= 'px';
	}
	return $var_number;
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


// Boletín de noticias




// Menús de navegación

register_nav_menus(array('menu_main' 	=> 'Menú principal'));
register_nav_menus(array('menu_footer'	=> 'Barra inferior'));
register_nav_menus(array('menu_top' 	=> 'Barra superior'));
register_nav_menus(array('menu_mobile' 	=> 'Menú móvil'));
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




// Añadir clase si se accede desde dispositivo móvil

function b_f_mobile_class($classes = '') {
	if ( wp_is_mobile() ){
		$classes[] = 'is-mobile';
	}
	return $classes;
}

add_filter('body_class','b_f_mobile_class');


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


// Proteger acceso al panel de administración

if ((b_f_option('b_opt_wp-admin') != '' && b_f_option('b_opt_wp-admin') != 'wp-admin') && !is_user_logged_in()) {
	if ($_SERVER['PHP_SELF'] != '/wp-admin/admin-ajax.php') {
		if (((strpos($_SERVER['REQUEST_URI'], 'wp-login.php') && !isset($_POST['log'])) || strpos($_SERVER['REQUEST_URI'], 'wp-admin')) && !strpos($_SERVER['HTTP_REFERER'], b_f_option('b_opt_wp-admin'))) {
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
		wp_enqueue_style('styles.design.fonts.awesome', get_template_directory_uri().'/css/external/styles.design.fonts.awesome.css');
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
	if ($options['b_opt_aviso-legal-es'] == 'new') {
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
	if ($options['b_opt_politica-privacidad-es'] == 'new') {
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
	if ($options['b_opt_politica-cookies-es'] == 'new') {
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
	$content = str_replace('[b_uploads]', $dir, $content);
	$content = str_replace('{{b_uploads}}', $dir, $content);
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

function b_f_i_menu($arg) {
	return wp_nav_menu(array('menu' => $arg[1], 'container_id' => 'menu-'.$arg[1], 'echo' => false));
}


// Función para crear extracto desde el contenido

function b_f_get_excerpt($a, $z = null, $y = 0, $x = true) {
	$a = strip_shortcodes($a);
	$a = strip_tags($a);
	$a = preg_replace('#\s*\{{.+\}}\s*#U', ' ', $a);
	if ($x == true) {
		if ($z == null) {
			$z = b_f_option('b_opt_blog-excerpt-length');
		}
		$d = false;
		$b = explode(' ', $a);
		if (count($b) > (int)$z) {
			$b = array_splice($b, 0, $z, '');
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


// Soporte para Mailchimp






// Envío de formularios




// Función para convertir a bytes

if (!function_exists('b_f_to_bytes')) {
	
	function b_f_to_bytes($var_size){
		$var_unit = substr($var_size,0,-2);
		switch(strtoupper(substr($var_size,-2))){
			case 'KB':
				return $var_unit * 1024;
			case 'MB':
				return $var_unit * pow(1024,2);
			case 'GB':
				return $var_unit * pow(1024,3);
			case 'TB':
				return $var_unit * pow(1024,4);
			case 'PB':
				return $var_unit * pow(1024,5);
			default:
				return $var_size;
		}
	}
}


// Miniaturas en la zona de administración

function b_f_thumbnail_columns($var_columns) {
	$var_new_columns = array();
	foreach ($var_columns as $key => $value) {
		if ($key == 'title') {
			$var_new_columns['admin_thumb'] = '';
		}
		$var_new_columns[$key] = $value;
	}
	return $var_new_columns;
}

function b_f_thumbnail_columns_data($var_column, $var_post_id) {
	switch ($var_column) {
		case 'admin_thumb':
			echo '<a style="background-image: url('.wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'thumbnail')[0].');" href="'.get_edit_post_link().'"></a>';
			break;
	}
}

foreach (get_post_types() as $post_type) {
	if (post_type_supports($post_type, 'thumbnail')) {
		add_filter('manage_posts_columns', 'b_f_thumbnail_columns');
		add_action('manage_posts_custom_column', 'b_f_thumbnail_columns_data', 10, 2);
	}
}


// Soporte para SVG

if (!function_exists('b_f_svg')) {

	function b_f_svg($var_mime_types) {
		$var_mime_types['svg'] = 'image/svg+xml';
		return $var_mime_types;
	}

	add_filter('upload_mimes', 'b_f_svg');
}


// Widgets

b_f_include(get_template_directory().'/inc/widgets');


// Shortcodes

b_f_include(get_template_directory().'/inc/shortcodes');


// Funciones Ajax

b_f_include(get_template_directory().'/inc/ajax');


// Panel de administración

b_f_include(get_template_directory().'/inc/admin', false);


?>