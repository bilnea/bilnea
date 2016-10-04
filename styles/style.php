<?php

header('Content-Type: text/css; charset=utf-8');

define('WP_USE_THEMES', false);

$url = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);

require_once('../inc/fonts.php');

require_once($url[0].'wp-load.php' );

$fnt = [];
$opt = get_option('bilnea_settings')['b_opt_custom-font'];
foreach ($opt as $val) {
	$ttf = explode('|', $val)[0];
	$siz = explode('|', $val)[1];
	if (!isset($fnt[$ttf])) {
		$fnt[$ttf] = array($siz);
	} else {
		if (!in_array($siz, $fnt[$ttf])) {
			array_push($fnt[$ttf], $siz);
		}
	}
}

$fin = [];
foreach ($fnt as $key => $value) {
	array_push($fin, $key.':'.join($value, ','));
}

?>

@charset "UTF-8";

/* Definición de tipografías */

@import url(http://fonts.googleapis.com/css?family=<?= implode('|', $fin) ?>);

/* Estilos generales */

.main_container  * {
	font-size: <?= b_f_size('b_opt_text_ttf-size') ?>;
	font-family: <?= b_f_option('b_opt_text_ttf-font') ?>;
	<?php if (strpos(b_f_option('b_opt_text_ttf-style'), 'italic')) { ?>
	font-style: 'italic';
	<?php } ?>
	font-weight: <?= str_replace('italic','',b_f_option('b_opt_text_ttf-style')) ?>;
	color: <?= b_f_color('b_opt_text_ttf-color') ?>;
	<?php if (b_f_option('b_opt_text_ttf-uppercase') == 1) : ?>
	text-transform: uppercase;
	<?php endif; ?>
	<?php if (b_f_option('b_opt_text_ttf-underline') == 1) : ?>
	text-decoration: underline;
	<?php endif; ?>
}

.main_container  b, .main_container  b *,
.main_container  strong,
.main_container  strong * {
	font-size: <?= b_f_size('b_opt_bold_ttf-size') ?>;
	font-family: <?= b_f_option('b_opt_bold_ttf-font') ?>;
	<?php if (strpos(b_f_option('b_opt_bold_ttf-style'), 'italic')) { ?>
	font-style: 'italic';
	<?php } ?>
	font-weight: <?= str_replace('italic','',b_f_option('b_opt_bold_ttf-style')) ?>;
	color: <?= b_f_color('b_opt_bold_ttf-color') ?>;
	<?php if (b_f_option('b_opt_bold_ttf-uppercase') == 1) : ?>
	text-transform: uppercase;
	<?php endif; ?>
	<?php if (b_f_option('b_opt_bold_ttf-underline') == 1) : ?>
	text-decoration: underline;
	<?php endif; ?>
}

.main_container a, .main_container a * {
	font-size: <?= b_f_size('b_opt_link_ttf-size') ?>;
	font-family: <?= b_f_option('b_opt_link_ttf-font') ?>;
	<?php if (strpos(b_f_option('b_opt_link_ttf-style'), 'italic')) { ?>
	font-style: 'italic';
	<?php } ?>
	font-weight: <?= str_replace('italic','',b_f_option('b_opt_link_ttf-style')) ?>;
	color: <?= b_f_color('b_opt_link_ttf-color') ?>;
	<?php if (b_f_option('b_opt_link_ttf-uppercase') == 1) : ?>
	text-transform: uppercase;
	<?php endif; ?>
	<?php if (b_f_option('b_opt_link_ttf-underline') == 1) : ?>
	text-decoration: underline;
	<?php endif; ?>
}

/* Encabezados */

h1, h1 * {
	font-size: <?= b_f_size('b_opt_h1_ttf-size') ?>;
	font-family: <?= b_f_option('b_opt_h1_ttf-font') ?>;
	<?php if (strpos(b_f_option('b_opt_h1_ttf-style'), 'italic')) { ?>
	font-style: 'italic';
	<?php } ?>
	font-weight: <?= str_replace('italic','',b_f_option('b_opt_h1_ttf-style')) ?>;
	color: <?= b_f_color('b_opt_h1_ttf-color') ?>;
	<?php if (b_f_option('b_opt_h1_ttf-uppercase') == 1) : ?>
	text-transform: uppercase;
	<?php endif; ?>
	<?php if (b_f_option('b_opt_h1_ttf-underline') == 1) : ?>
	text-decoration: underline;
	<?php endif; ?>
}

h2, h2 * {
	font-size: <?= b_f_size('b_opt_h2_ttf-size') ?>;
	font-family: <?= b_f_option('b_opt_h2_ttf-font') ?>;
	<?php if (strpos(b_f_option('b_opt_h2_ttf-style'), 'italic')) { ?>
	font-style: 'italic';
	<?php } ?>
	font-weight: <?= str_replace('italic','',b_f_option('b_opt_h2_ttf-style')) ?>;
	color: <?= b_f_color('b_opt_h2_ttf-color') ?>;
	<?php if (b_f_option('b_opt_h2_ttf-uppercase') == 1) : ?>
	text-transform: uppercase;
	<?php endif; ?>
	<?php if (b_f_option('b_opt_h2_ttf-underline') == 1) : ?>
	text-decoration: underline;
	<?php endif; ?>
}

h3, h3 * {
	font-size: <?= b_f_size('b_opt_h3_ttf-size') ?>;
	font-family: <?= b_f_option('b_opt_h3_ttf-font') ?>;
	<?php if (strpos(b_f_option('b_opt_h3_ttf-style'), 'italic')) { ?>
	font-style: 'italic';
	<?php } ?>
	font-weight: <?= str_replace('italic','',b_f_option('b_opt_h3_ttf-style')) ?>;
	color: <?= b_f_color('b_opt_h3_ttf-color') ?>;
	<?php if (b_f_option('b_opt_h3_ttf-uppercase') == 1) : ?>
	text-transform: uppercase;
	<?php endif; ?>
	<?php if (b_f_option('b_opt_h3_ttf-underline') == 1) : ?>
	text-decoration: underline;
	<?php endif; ?>
}

h4, h4 * {
	font-size: <?= b_f_size('b_opt_h4_ttf-size') ?>;
	font-family: <?= b_f_option('b_opt_h4_ttf-font') ?>;
	<?php if (strpos(b_f_option('b_opt_h4_ttf-style'), 'italic')) { ?>
	font-style: 'italic';
	<?php } ?>
	font-weight: <?= str_replace('italic','',b_f_option('b_opt_h4_ttf-style')) ?>;
	color: <?= b_f_color('b_opt_h4_ttf-color') ?>;
	<?php if (b_f_option('b_opt_h4_ttf-uppercase') == 1) : ?>
	text-transform: uppercase;
	<?php endif; ?>
	<?php if (b_f_option('b_opt_h4_ttf-underline') == 1) : ?>
	text-decoration: underline;
	<?php endif; ?>
}

h5, h5 * {
	font-size: <?= b_f_size('b_opt_h5_ttf-size') ?>;
	font-family: <?= b_f_option('b_opt_h5_ttf-font') ?>;
	<?php if (strpos(b_f_option('b_opt_h5_ttf-style'), 'italic')) { ?>
	font-style: 'italic';
	<?php } ?>
	font-weight: <?= str_replace('italic','',b_f_option('b_opt_h5_ttf-style')) ?>;
	color: <?= b_f_color('b_opt_h5_ttf-color') ?>;
	<?php if (b_f_option('b_opt_h5_ttf-uppercase') == 1) : ?>
	text-transform: uppercase;
	<?php endif; ?>
	<?php if (b_f_option('b_opt_h5_ttf-underline') == 1) : ?>
	text-decoration: underline;
	<?php endif; ?>
}

h6, h6 * {
	font-size: <?= b_f_size('b_opt_h6_ttf-size') ?>;
	font-family: <?= b_f_option('b_opt_h6_ttf-font') ?>;
	<?php if (strpos(b_f_option('b_opt_h6_ttf-style'), 'italic')) { ?>
	font-style: 'italic';
	<?php } ?>
	font-weight: <?= str_replace('italic','',b_f_option('b_opt_h6_ttf-style')) ?>;
	color: <?= b_f_color('b_opt_h6_ttf-color') ?>;
	<?php if (b_f_option('b_opt_h6_ttf-uppercase') == 1) : ?>
	text-transform: uppercase;
	<?php endif; ?>
	<?php if (b_f_option('b_opt_h6_ttf-underline') == 1) : ?>
	text-decoration: underline;
	<?php endif; ?>
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
.header-mid .container,
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
	background-color: <?= b_f_color('b_opt_main-color') ?>;
}

.row > * {
	display: inline-block;
	float: left;
	margin-left: <?= b_f_size('b_opt_column_separator') ?>;
}

html[lang="ar"] .row > * {
	float: right;
	margin-left: 0;
	margin-right: <?= b_f_size('b_opt_column_separator') ?>;
}

.x11 {
	width: 100.0000%;
}

.x12 {
	width: 50.00000%;
	width: calc((100% - (<?= b_f_size('b_opt_column_separator') ?> * 1)) / 2);
}

.x13 {
	width: 33.33333%;
	width: calc((100% - (<?= b_f_size('b_opt_column_separator') ?> * 2)) / 3);
}

.x14 {
	width: 25.00000%;
	width: calc((100% - (<?= b_f_size('b_opt_column_separator') ?> * 3)) / 4);
}

.x15 {
	width: 20.00000%;
	width: calc((100% - (<?= b_f_size('b_opt_column_separator') ?> * 4)) / 5);
}

.x16 {
	width: 16.66666%;
	width: calc((100% - (<?= b_f_size('b_opt_column_separator') ?> * 5)) / 6);
}

.x17 {
	width: 14.28571%;
	width: calc((100% - (<?= b_f_size('b_opt_column_separator') ?> * 6)) / 7);
}

.x18 {
	width: 12.50000%;
	width: calc((100% - (<?= b_f_size('b_opt_column_separator') ?> * 7)) / 8);
}

.x19 {
	width: 11.11111%;
	width: calc((100% - (<?= b_f_size('b_opt_column_separator') ?> * 8)) / 9);
}

.x10 {
	width: 10%;
	width: calc((100% - (<?= b_f_size('b_opt_column_separator') ?> * 9)) / 10);
}

.x23 {
	width: 66.66666%;
	width: calc((((100% - (<?= b_f_size('b_opt_column_separator') ?> * 2)) / 3) * 2) + 1 * <?= b_f_size('b_opt_column_separator') ?>);
}

.x25 {
	width: 40.00000%;
	width: calc((((100% - (<?= b_f_size('b_opt_column_separator') ?> * 4)) / 5) * 2) + 1 * <?= b_f_size('b_opt_column_separator') ?>);
}

.x34 {
	width: 75.00000%;
	width: calc((((100% - (<?= b_f_size('b_opt_column_separator') ?> * 3)) / 4) * 3) + 2 * <?= b_f_size('b_opt_column_separator') ?>);
}

.x35 {
	width: 60.00000%;
	width: calc((((100% - (<?= b_f_size('b_opt_column_separator') ?> * 4)) / 5) * 3) + 2 * <?= b_f_size('b_opt_column_separator') ?>);
}

.x45 {
	width: 80.00000%;
	width: calc((((100% - (<?= b_f_size('b_opt_column_separator') ?> * 4)) / 5) * 4) + 3 * <?= b_f_size('b_opt_column_separator') ?>);
}

.x56 {
	width: 83.33333%;
	width: calc((((100% - (<?= b_f_size('b_opt_column_separator') ?> * 5)) / 6) * 5) + 4 * <?= b_f_size('b_opt_column_separator') ?>);
}

/* Cabecera */

.header-top {
	background-color: <?= b_f_color('b_opt_topbar-color') ?>;
}

.header-top, .header-top * {
	font-size: <?= b_f_size('b_opt_top-bar_ttf-size') ?>;
	font-family: <?= b_f_option('b_opt_top-bar_ttf-font') ?>;
	<?php if (strpos(b_f_option('b_opt_top-bar_ttf-style'), 'italic')) { ?>
	font-style: 'italic';
	<?php } ?>
	font-weight: <?= str_replace('italic','',b_f_option('b_opt_top-bar_ttf-style')) ?>;
	color: <?= b_f_color('b_opt_top-bar_ttf-color') ?>;
	<?php if (b_f_option('b_opt_top-bar_ttf-uppercase') == 1) : ?>
	text-transform: uppercase;
	<?php endif; ?>
	<?php if (b_f_option('b_opt_top-bar_ttf-underline') == 1) : ?>
	text-decoration: underline;
	<?php endif; ?>
}

header#header {
	background-color: <?= b_f_color('b_opt_header-color') ?>;
}

header#header .header > .container {
	height: <?= b_f_size('b_opt_header-height') ?>;
}

#main-header #searchsubmit {
	color: <?= b_f_color('b_opt_menu-color') ?>;
}

header .logo.image-link {
	height: <?= b_f_size('b_opt_logo-height') ?>;
}

header#header nav li a {
	line-height: <?= b_f_size('b_opt_menu-height') ?>;
}

header#header nav .menu > li > a {
	height. <?= b_f_size('b_opt_menu-height') ?>;
	display: inline-block;
}

header#header ul.menu li:hover:after,
header#header ul.menu li[class*="current"]::after {
	background-color: <?= b_f_color('b_opt_active-color') ?>;
}

header#header nav li,
header#header nav li * {
	font-size: <?= b_f_size('b_opt_main-menu_ttf-size') ?>;
	font-family: <?= b_f_option('b_opt_main-menu_ttf-font') ?>;
	<?php if (strpos(b_f_option('b_opt_main-menu_ttf-style'), 'italic')) { ?>
	font-style: 'italic';
	<?php } ?>
	font-weight: <?= str_replace('italic','',b_f_option('b_opt_main-menu_ttf-style')) ?>;
	color: <?= b_f_color('b_opt_main-menu_ttf-color') ?>;
	<?php if (b_f_option('b_opt_main-menu_ttf-uppercase') == 1) : ?>
	text-transform: uppercase;
	<?php endif; ?>
	<?php if (b_f_option('b_opt_main-menu_ttf-underline') == 1) : ?>
	text-decoration: underline;
	<?php endif; ?>
}

#mobile-menu #main_menu > ul > li > a {
	font-size: <?= b_f_size('b_opt_main-menu_ttf-size') ?>;
	font-family: <?= b_f_option('b_opt_main-menu_ttf-font') ?>;
	<?php if (strpos(b_f_option('b_opt_main-menu_ttf-style'), 'italic')) { ?>
	font-style: 'italic';
	<?php } ?>
	font-weight: <?= str_replace('italic','',b_f_option('b_opt_main-menu_ttf-style')) ?>;
	color: <?= b_f_color('b_opt_header-color') ?>;
	<?php if (b_f_option('b_opt_main-menu_ttf-uppercase') == 1) : ?>
	text-transform: uppercase;
	<?php endif; ?>
	<?php if (b_f_option('b_opt_main-menu_ttf-underline') == 1) : ?>
	text-decoration: underline;
	<?php endif; ?>
}

.mobile-button {
	background-color: <?= b_f_color('b_opt_active-color') ?>;
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

/* Pie de página */

#footer {
	background-color: <?= b_f_color('b_opt_footer-color') ?>;
}

#footer * {
	font-size: <?= b_f_size('b_opt_footer_ttf-size') ?>;
	font-family: <?= b_f_option('b_opt_footer_ttf-font') ?>;
	<?php if (strpos(b_f_option('b_opt_footer_ttf-style'), 'italic')) { ?>
	font-style: 'italic';
	<?php } ?>
	font-weight: <?= str_replace('italic','',b_f_option('b_opt_footer_ttf-style')) ?>;
	color: <?= b_f_color('b_opt_footer_ttf-color') ?>;
	<?php if (b_f_option('b_opt_footer_ttf-uppercase') == 1) : ?>
	text-transform: uppercase;
	<?php endif; ?>
	<?php if (b_f_option('b_opt_footer_ttf-underline') == 1) : ?>
	text-decoration: underline;
	<?php endif; ?>
}

#footer .footer-title {
	font-size: <?= b_f_size('b_opt_footer-title_ttf-size') ?>;
	font-family: <?= b_f_option('b_opt_footer-title_ttf-font') ?>;
	<?php if (strpos(b_f_option('b_opt_footer-title_ttf-style'), 'italic')) { ?>
	font-style: 'italic';
	<?php } ?>
	font-weight: <?= str_replace('italic','',b_f_option('b_opt_footer-title_ttf-style')) ?>;
	color: <?= b_f_color('b_opt_footer-title_ttf-color') ?>;
	<?php if (b_f_option('b_opt_footer-title_ttf-uppercase') == 1) : ?>
	text-transform: uppercase;
	<?php endif; ?>
	<?php if (b_f_option('b_opt_footer-title_ttf-underline') == 1) : ?>
	text-decoration: underline;
	<?php endif; ?>
}

#footer a {
	font-size: <?= b_f_size('b_opt_footer-link_ttf-size') ?>;
	font-family: <?= b_f_option('b_opt_footer-link_ttf-font') ?>;
	<?php if (strpos(b_f_option('b_opt_footer-link_ttf-style'), 'italic')) { ?>
	font-style: 'italic';
	<?php } ?>
	font-weight: <?= str_replace('italic','',b_f_option('b_opt_footer-link_ttf-style')) ?>;
	color: <?= b_f_color('b_opt_footer-link_ttf-color') ?>;
	<?php if (b_f_option('b_opt_footer-link_ttf-uppercase') == 1) : ?>
	text-transform: uppercase;
	<?php endif; ?>
	<?php if (b_f_option('b_opt_footer-link_ttf-underline') == 1) : ?>
	text-decoration: underline;
	<?php endif; ?>
}

#footer a:hover {
	font-size: <?= b_f_size('b_opt_footer-hover_ttf-size') ?>;
	font-family: <?= b_f_option('b_opt_footer-hover_ttf-font') ?>;
	<?php if (strpos(b_f_option('b_opt_footer-hover_ttf-style'), 'italic')) { ?>
	font-style: 'italic';
	<?php } ?>
	font-weight: <?= str_replace('italic','',b_f_option('b_opt_footer-hover_ttf-style')) ?>;
	color: <?= b_f_color('b_opt_footer-hover_ttf-color') ?>;
	<?php if (b_f_option('b_opt_footer-hover_ttf-uppercase') == 1) : ?>
	text-transform: uppercase;
	<?php endif; ?>
	<?php if (b_f_option('b_opt_footer-hover_ttf-underline') == 1) : ?>
	text-decoration: underline;
	<?php endif; ?>
}

#socket {
	background-color: <?= b_f_color('b_opt_socket-color') ?>;
}

#socket * {
	font-size: <?= b_f_size('b_opt_socket_ttf-size') ?>;
	font-family: <?= b_f_option('b_opt_socket_ttf-font') ?>;
	<?php if (strpos(b_f_option('b_opt_socket_ttf-style'), 'italic')) { ?>
	font-style: 'italic';
	<?php } ?>
	font-weight: <?= str_replace('italic','',b_f_option('b_opt_socket_ttf-style')) ?>;
	color: <?= b_f_color('b_opt_socket_ttf-color') ?>;
	<?php if (b_f_option('b_opt_socket_ttf-uppercase') == 1) : ?>
	text-transform: uppercase;
	<?php endif; ?>
	<?php if (b_f_option('b_opt_socket_ttf-underline') == 1) : ?>
	text-decoration: underline;
	<?php endif; ?>
}


#socket a {
	font-size: <?= b_f_size('b_opt_socket-link_ttf-size') ?>;
	font-family: <?= b_f_option('b_opt_socket-link_ttf-font') ?>;
	<?php if (strpos(b_f_option('b_opt_socket-link_ttf-style'), 'italic')) { ?>
	font-style: 'italic';
	<?php } ?>
	font-weight: <?= str_replace('italic','',b_f_option('b_opt_socket-link_ttf-style')) ?>;
	color: <?= b_f_color('b_opt_socket-link_ttf-color') ?>;
	<?php if (b_f_option('b_opt_socket-link_ttf-uppercase') == 1) : ?>
	text-transform: uppercase;
	<?php endif; ?>
	<?php if (b_f_option('b_opt_socket-link_ttf-underline') == 1) : ?>
	text-decoration: underline;
	<?php endif; ?>
}

#socket a:hover {
	font-size: <?= b_f_size('b_opt_socket-hover_ttf-size') ?>;
	font-family: <?= b_f_option('b_opt_socket-hover_ttf-font') ?>;
	<?php if (strpos(b_f_option('b_opt_socket-hover_ttf-style'), 'italic')) { ?>
	font-style: 'italic';
	<?php } ?>
	font-weight: <?= str_replace('italic','',b_f_option('b_opt_socket-hover_ttf-style')) ?>;
	color: <?= b_f_color('b_opt_socket-hover_ttf-color') ?>;
	<?php if (b_f_option('b_opt_socket-hover_ttf-uppercase') == 1) : ?>
	text-transform: uppercase;
	<?php endif; ?>
	<?php if (b_f_option('b_opt_socket-hover_ttf-underline') == 1) : ?>
	text-decoration: underline;
	<?php endif; ?>
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
	.container {
		padding-left: <?= b_f_size('b_opt_mobile-margin') ?> !important;
		padding-right: <?= b_f_size('b_opt_mobile-margin') ?> !important;
		width: auto !important;
	}
	* {
		<?php
		$un = preg_replace('/[0-9]+/', '', b_f_option('b_opt_text_ttf-size'));
		$un .= ($un == '') ? 'px' : '';
		$nu = preg_replace('/[^0-9]/', '', b_f_size('b_opt_text_ttf-size'));
		?>
		font-size: <?php echo ($nu*(b_f_option('b_opt_mobile-text')/100)).$un; ?>;
	}
	b, b *,
	strong,
	strong * {
		<?php
		$un = preg_replace('/[0-9]+/', '', b_f_option('b_opt_bold_ttf-size'));
		$un .= ($un == '') ? 'px' : '';
		$nu = preg_replace('/[^0-9]/', '', b_f_size('b_opt_bold_ttf-size'));
		?>
		font-size: <?php echo ($nu*(b_f_option('b_opt_mobile-text')/100)).$un; ?>;
	}
	a, a * {
		<?php
		$un = preg_replace('/[0-9]+/', '', b_f_option('b_opt_link_ttf-size'));
		$un .= ($un == '') ? 'px' : '';
		$nu = preg_replace('/[^0-9]/', '', b_f_size('b_opt_link_ttf-size'));
		?>
		font-size: <?php echo ($nu*(b_f_option('b_opt_mobile-text')/100)).$un; ?>;
	}
	h1 {
		<?php
		$un = preg_replace('/[0-9]+/', '', b_f_option('b_opt_h1_ttf-size'));
		$un .= ($un == '') ? 'px' : '';
		$nu = preg_replace('/[^0-9]/', '', b_f_size('b_opt_h1_ttf-size'));
		?>
		font-size: <?php echo ($nu*(b_f_option('b_opt_mobile-htext')/100)).$un; ?>;
	}
	h2 {
		<?php
		$un = preg_replace('/[0-9]+/', '', b_f_option('b_opt_h2_ttf-size'));
		$un .= ($un == '') ? 'px' : '';
		$nu = preg_replace('/[^0-9]/', '', b_f_size('b_opt_h2_ttf-size'));
		?>
		font-size: <?php echo ($nu*(b_f_option('b_opt_mobile-htext')/100)).$un; ?>;
	}
	h3 {
		<?php
		$un = preg_replace('/[0-9]+/', '', b_f_option('b_opt_h3_ttf-size'));
		$un .= ($un == '') ? 'px' : '';
		$nu = preg_replace('/[^0-9]/', '', b_f_size('b_opt_h3_ttf-size'));
		?>
		font-size: <?php echo ($nu*(b_f_option('b_opt_mobile-htext')/100)).$un; ?>;
	}
	h4 {
		<?php
		$un = preg_replace('/[0-9]+/', '', b_f_option('b_opt_h4_ttf-size'));
		$un .= ($un == '') ? 'px' : '';
		$nu = preg_replace('/[^0-9]/', '', b_f_size('b_opt_h4_ttf-size'));
		?>
		font-size: <?php echo ($nu*(b_f_option('b_opt_mobile-htext')/100)).$un; ?>;
	}
	h5 {
		<?php
		$un = preg_replace('/[0-9]+/', '', b_f_option('b_opt_h5_ttf-size'));
		$un .= ($un == '') ? 'px' : '';
		$nu = preg_replace('/[^0-9]/', '', b_f_size('b_opt_h5_ttf-size'));
		?>
		font-size: <?php echo ($nu*(b_f_option('b_opt_mobile-htext')/100)).$un; ?>;
	}
	h6 {
		<?php
		$un = preg_replace('/[0-9]+/', '', b_f_option('b_opt_h6_ttf-size'));
		$un .= ($un == '') ? 'px' : '';
		$nu = preg_replace('/[^0-9]/', '', b_f_size('b_opt_h6_ttf-size'));
		?>
		font-size: <?php echo ($nu*(b_f_option('b_opt_mobile-htext')/100)).$un; ?>;
	}
	<?php if (b_f_option('b_opt_mobile-sidebar') == 1) : ?>
	aside#sidebar {
		display: none;
	}
	<?php endif; ?>
}

