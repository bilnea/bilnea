<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

?>

<h4>Estructuración</h4>
<div data-connect="header-style">
	<div style="width: 50%; display: inline-block;">
		Ancho de la cabecera
	</div>
	<div style="width: 49%; display: inline-block;">
		Ancho del menú
	</div>
	<div style="width: 48%; margin-right: 2%; border-right: 1px solid #e1e1e1; display: inline-block;">
		<input type="radio" name="bilnea_settings[b_opt_header-width]" <?php checked(b_f_option('b_opt_header-width'), 1); ?> value="1"><span>Ancho completo</span>
		<br />
		<input type="radio" name="bilnea_settings[b_opt_header-width]" <?php checked(b_f_option('b_opt_header-width'), 2); ?> value="2"><span>Encajonado</span>
	</div>
	<div style="width: 49%; display: inline-block;">
		<input type="radio" name="bilnea_settings[b_opt_menu-width]" <?php checked(b_f_option('b_opt_menu-width'), 1); ?> value="1"><span>Ancho completo</span>
		<br />
		<input type="radio" name="bilnea_settings[b_opt_menu-width]" <?php checked(b_f_option('b_opt_menu-width'), 2); ?> value="2"><span>Encajonado</span>
	</div>
</div>
<em class="notice header_notice" style="font-size: 11px; line-height: 15px; margin-bottom: 10px;">
	Con contenido encajonado definido como opción general, estas opciones están deshabilitadas. Para activarlas, desactiva el contenido encajonado de toda la página.
</em>
<div style="width: 100%; display: inline-block;">
	<input type="checkbox" name="bilnea_settings[b_opt_sticky-menu]" <?php checked(b_f_option('b_opt_sticky-menu'), 1); ?> value="1" />
	<label for="bilnea_settings[b_opt_sticky-menu]">Cabecera fija en pantalla</label>
</div>
<div style="width: 100%; display: inline-block;">
	<input type="checkbox" name="bilnea_settings[b_opt_sticky-menu-animated]" <?php checked(b_f_option('b_opt_sticky-menu-animated'), 1); ?> value="1" />
	<label for="bilnea_settings[b_opt_sticky-menu-animated]">Ocultar automáticamente</label>
</div>

<h4 style="margin-top: 10px;">Barra superior</h4>
<input type="checkbox" name="bilnea_settings[b_opt_top-bar]" <?php checked(b_f_option('b_opt_top-bar'), 1); ?> value="1"> Mostrar barra superior
<hr />
Maquetación y contenido
<?php

if (function_exists('icl_object_id')) {

	// Variables globakles
	global $sitepress;

	// Variables locales
	$var_language = $sitepress->get_current_language();
	$sitepress->switch_lang('es');
	$var_languages = icl_get_languages('skip_missing=0&orderby=name');
	if (!empty($var_languages)) {
		$int = 0;
		$out = '<div class="lang-wrapper">';
		foreach ($var_languages as $var_lang) {
			$out .= ($int != 0) ? ' | ' : '';
			$out .= '<a class="lang-switcher" data-lang="'.$var_lang['language_code'].'">'.ucfirst($var_lang['translated_name']).'</a>';
			$int++;
		}
		$out .= '</div><div class="lang-wrapper">';
		foreach ($var_languages as $var_lang) {
			$out .= '<textarea data-lang="'.$var_lang['language_code'].'" name="bilnea_settings[b_opt_header-top-content-'.$var_lang['language_code'].']" rows="5" style="font-size: 12px; border-color: #ddd !important; width: 100%; box-shadow: none; border-radius: 5px; resize: none; margin: 10px 0 0 0;">'.b_f_option('b_opt_header-top-content-'.$var_lang['language_code']).'</textarea>';
		}
		$out .= '</div>';
		echo $out;
	}
} else {
	$out = '<textarea class="current" name="bilnea_settings[b_opt_header-top-content-es]" rows="5" style="font-size: 12px; border-color: #ddd !important; width: 100%; box-shadow: none; border-radius: 5px; resize: none; margin: 10px 0 0 0;">'.b_f_option('b_opt_header-top-content-es').'</textarea>';
	echo $out;
}

?>
<em class="notice" style="font-size: 11px; line-height: 15px; margin-bottom: 10px;">Shortcodes permitidos: {{b_menu}}, {{b_logo}}, {{b_search}}, {{b_rrss}}, {{b_language_selector}}.</em>

<h4 style="margin-top: 10px;">Barra principal</h4>
Maquetación y contenido
<?php

if (function_exists('icl_object_id')) {

	// Variables globakles
	global $sitepress;

	// Variables locales
	$var_language = $sitepress->get_current_language();
	$sitepress->switch_lang('es');
	$var_languages = icl_get_languages('skip_missing=0&orderby=name');
	if (!empty($var_languages)) {
		$int = 0;
		$out = '<div class="lang-wrapper">';
		foreach ($var_languages as $var_lang) {
			$out .= ($int != 0) ? ' | ' : '';
			$out .= '<a class="lang-switcher" data-lang="'.$var_lang['language_code'].'">'.ucfirst($var_lang['translated_name']).'</a>';
			$int++;
		}
		$out .= '</div><div class="lang-wrapper">';
		foreach ($var_languages as $var_lang) {
			$out .= '<textarea data-lang="'.$var_lang['language_code'].'" name="bilnea_settings[b_opt_header-main-content-'.$var_lang['language_code'].']" rows="5" style="font-size: 12px; border-color: #ddd !important; width: 100%; box-shadow: none; border-radius: 5px; resize: none; margin: 10px 0 0 0;">'.b_f_option('b_opt_header-main-content-'.$var_lang['language_code']).'</textarea>';
		}
		$out .= '</div>';
		echo $out;
	}
} else {
	$out = '<textarea class="current" name="bilnea_settings[b_opt_header-main-content-es]" rows="5" style="font-size: 12px; border-color: #ddd !important; width: 100%; box-shadow: none; border-radius: 5px; resize: none; margin: 10px 0 0 0;">'.b_f_option('b_opt_header-main-content-es').'</textarea>';
	echo $out;
}

?>
<em class="notice" style="font-size: 11px; line-height: 15px; margin-bottom: 10px;">Shortcodes permitidos: {{b_menu}}, {{b_logo}}, {{b_search}}, {{b_rrss}}, {{b_language_selector}}.</em>

<h4 style="margin-top: 10px;">Estilos tipográficos</h4>
<div class="text-container">
	<strong>Barra superior</strong>
	<?php b_f_fonts('top-bar'); ?>
</div>
<hr />
<div class="text-container">
	<strong>Menú principal</strong>
	<?php b_f_fonts('main-menu'); ?>
</div>
<hr />
<div class="text-container">
	<strong>Submenú</strong>
	<?php b_f_fonts('sub-menu'); ?>
</div>