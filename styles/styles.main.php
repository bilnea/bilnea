<?php

header('Content-Type: text/css; charset=utf-8');

define('WP_USE_THEMES', false);

$var_root = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);

require_once($var_root[0].'wp-load.php' );
require_once('../inc/functions/functions.admin.php');

$var_fonts = [];

foreach (get_option('bilnea_settings') as $key => $value) {
	if (strpos($key, 'ttf-font') !== false) {
		if ($value == '') {
			$value = b_f_default($key);
		}
		$var_current_font = str_replace('b_opt_', '', explode('ttf-', $key)[0]);
		$var_size = b_f_option('b_opt_'.$var_current_font.'ttf-style');
		if (!isset($var_fonts[$value]) && $value != '') {
			$var_fonts[$value] = array($var_size);
		} else {
			if (!in_array($var_size, $var_fonts[$value]) && $value != '') {
				array_push($var_fonts[$value], $var_size);
			}
		}
	}
}

foreach (b_f_option('b_opt_custom-font') as $font) {
	$value = explode('|', $font)[0];
	$var_size = explode('|', $font)[1];
	if (!isset($var_fonts[$value]) && $value != '') {
		$var_fonts[$value] = array($var_size);
	} else {
		if (!in_array($var_size, $var_fonts[$value]) && $value != '') {
			array_push($var_fonts[$value], $var_size);
		}
	}
}

$var_temp = [];

foreach ($var_fonts as $key => $value) {
	if ($key != 'inherit') {
		array_push($var_temp, $key.':'.join($value, ','));
	}
}

?>

@charset "UTF-8";

<?php

if (count($var_temp) > 0) {
	
	?>

	/* Definición de tipografías */
	
	@import url(https://fonts.googleapis.com/css?family=<?= implode('|', $var_temp) ?>);

	<?php

}

function b_i_s_fonts($var_font) {

	// Variables globales
	global $b_g_google_fonts;

	$out = 'font-size: '.b_f_size('b_opt_'.$var_font.'_ttf-size').';'."\n";
	if ($b_g_google_fonts[str_replace(' ', '+', b_f_option('b_opt_'.$var_font.'_ttf-font'))]['name'] != '') {
		$out .= '	font-family: '.$b_g_google_fonts[str_replace(' ', '+', b_f_option('b_opt_'.$var_font.'_ttf-font'))]['name'].';'."\n";
	} else {
		$out .= '	font-family: inherit;'."\n";
	}
	if (strpos(b_f_option('b_opt_'.$var_font.'_ttf-style'), 'italic')) {
		$out .= '	font-style: \'italic\';'."\n";
	}
	if (str_replace('italic','',b_f_option('b_opt_'.$var_font.'_ttf-style')) != '') {
		$out .= '	font-weight: '.str_replace('italic','',b_f_option('b_opt_'.$var_font.'_ttf-style')).';'."\n";
	}
	$out .= '	color: '.b_f_color('b_opt_'.$var_font.'_ttf-color').';'."\n";
	if (b_f_option('b_opt_'.$var_font.'_ttf-uppercase') == 1) {
		$out .= '	text-transform: uppercase;'."\n";
	}
	if (b_f_option('b_opt_'.$var_font.'_ttf-underline') == 1) {
		$out .= '	text-decoration: underline;'."\n";
	}

	return $out;
}

?>

body {
	<?= b_i_s_fonts('text'); ?>
}
/*
b, strong {
	<?= b_i_s_fonts('bold'); ?>
}

a {
	<?= b_i_s_fonts('link'); ?>
	-webkit-transition: all .2s ease-in;
	-o-transition: all .2s ease-in;
	-webkit-transition: all .2s ease-in;
	transition: all .2s ease-in;
}

a:hover {
	<?= b_i_s_fonts('hover'); ?>
}
*/

/* Encabezados */

body.single .main_container article.post h1, 
body.single .main_container article.post h1 * {
	<?= b_i_s_fonts('h1'); ?>
}

body.single .main_container article.post h2, 
body.single .main_container article.post h2 * {
	<?= b_i_s_fonts('h2'); ?>
}

body.single .main_container article.post h3, 
body.single .main_container article.post h3 * {
	<?= b_i_s_fonts('h3'); ?>
}

body.single .main_container article.post h4, 
body.single .main_container article.post h4 * {
	<?= b_i_s_fonts('h4'); ?>
}

body.single .main_container article.post h5, 
body.single .main_container article.post h5 * {
	<?= b_i_s_fonts('h5'); ?>
}

body.single .main_container article.post h6, 
body.single .main_container article.post h6 * {
	<?= b_i_s_fonts('h6'); ?>
}

.container {
	max-width: <?= b_f_size('b_opt_interior-width') ?>;
}

<?php if (b_f_option('b_opt_body_boxed') == 1) { ?>
.main_container {
	border-left: 1px solid #e1e1e1;
	border-right: 1px solid #e1e1e1;
}
<?php
}
?>

.main_container.container,
.header-top .container,
.header .container,
.header-bot .container {
	max-width: <?= b_f_size('b_opt_exterior-width') ?>;
}

.sidebar {
	width: <?= b_f_size('b_opt_sidebar-width') ?>;
}

.has-sidebar {
	width: calc((100% - <?= b_f_size('b_opt_sidebar-width') ?>) - 40px);
}

.content {
	width: calc(100% - <?= b_f_size('b_opt_sidebar-width') ?>);
}

body {
	background-color: <?= b_f_color('b_opt_body_bg_color') ?>;
}

.main_container {
	background-color: <?= b_f_option('b_opt_main-color') ?>;
}


/* Cabecera */

#mobile-menu #main_menu > ul > li > a {
	<?= b_i_s_fonts('main-menu'); ?>
	color: <?= b_f_color('b_opt_header-color') ?>;
}

#mobile-header {
	display: none;
}

#mobile-side-menu {
	background-color: <?= b_f_color('b_opt_main-menu_ttf-color') ?>;
}

.mobile-button span,
.mobile-button span::before,
.mobile-button span::after {
	background-color: <?= b_f_color('b_opt_main-menu_ttf-color') ?>;
}

.selector-idioma-superior img {
	height: <?= b_f_size('b_opt_top-bar_ttf-size') ?>;
}

.selector-idioma-superior.desplegable .selector-abajo {
	border-top: 3px solid <?= b_f_color('b_opt_top-bar_ttf-color') ?>;
}

.sub-menu {
	display: none;
}


/* Barra lateral */

.sidebar-right {
	padding-right: b_f_size('b_opt_sidebar-width') ?>;
}

.sidebar-right {
	padding-left: b_f_size('b_opt_sidebar-width') ?>;
}

aside#sidebar {
	width: <?= b_f_size('b_opt_sidebar-width') ?>;
}

@media all and (max-width: <?= b_f_size('b_opt_responsive') ?>) {
	header#header {
		display: none
	}
	header#mobile-header {
		display: block;
	}
}

