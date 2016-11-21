<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

?>

<h4>Menú responsive</h4>
<label for="mobile_menu_opt1"><img src="<?= get_template_directory_uri().'/img/menu_movil_1.jpg'; ?>" class="icon big" /></label>
<label for="mobile_menu_opt2"><img src="<?= get_template_directory_uri().'/img/menu_movil_2.jpg'; ?>" class="icon big" /></label>
<label for="mobile_menu_opt3"><img src="<?= get_template_directory_uri().'/img/menu_movil_3.jpg'; ?>" class="icon big" style="margin-right: 0;" /></label>
<br />
<div style="width: 174px; display: inline-block;">
	<input type="radio" name="bilnea_settings[b_opt_mobile-menu]" <?php checked(b_f_option('b_opt_mobile-menu'), 1); ?> value="1" id="mobile_menu_opt1">Menú selector
</div>
<div style="width: 174px; display: inline-block;">
	<input type="radio" name="bilnea_settings[b_opt_mobile-menu]" <?php checked(b_f_option('b_opt_mobile-menu'), 2); ?> value="2" id="mobile_menu_opt2">Menú cortina
</div>
<div style="display: inline-block;">
	<input type="radio" name="bilnea_settings[b_opt_mobile-menu]" <?php checked(b_f_option('b_opt_mobile-menu'), 3); ?> value="3" id="mobile_menu_opt3">Menú deslizante
</div>
<hr>
<div style="width: 414px; margin-bottom: 16px; display: inline-block;">Dimensión de activación responsive</div>
<input style="text-align: right;" type="text" class="peq" name="bilnea_settings[b_opt_responsive]" value="<?= b_f_option('b_opt_responsive'); ?>" placeholder="<?= b_f_default('b_opt_responsive'); ?>">
<br />
<h4>Diseño</h4>
<label for="bilnea_settings[b_opt_mobile-margin]" style="overflow: hidden; display: block; width: 100%;">Márgen lateral (px o %)
<input type="text" class="peq" name="bilnea_settings[b_opt_mobile-margin]" value="<?= b_f_option('b_opt_mobile-margin'); ?>" style="float: right; right: 0;" /></label>
<label for="bilnea_settings[b_opt_mobile-htext]" style="overflow: hidden; display: block; width: 100%;">Tamaño encabezado respecto a su dimensión natural, en %
<input type="text" class="peq" name="bilnea_settings[b_opt_mobile-htext]" value="<?= b_f_option('b_opt_mobile-htext'); ?>" style="float: right; right: 0;" /></label>
<label for="bilnea_settings[b_opt_mobile-text]" style="overflow: hidden; display: block; width: 100%;">Tamaño texto corrido respecto a su dimensión natural, en %
<input type="text" class="peq" name="bilnea_settings[b_opt_mobile-text]" value="<?= b_f_option('b_opt_mobile-text'); ?>" style="float: right; right: 0;" /></label>
<hr style="margin-bottom: 0;" />
<input type="checkbox" name="bilnea_settings[b_opt_mobile-sidebar]" <?php checked(b_f_option('b_opt_mobile-sidebar'), 1); ?> value="1">
<label for="bilnea_settings[b_opt_mobile-sidebar]">Ocultar la barra lateral</label>
<h4 style="margin-top: 10px;">Barra superior</h4>
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
			$out .= '<textarea data-lang="'.$var_lang['language_code'].'" name="bilnea_settings[b_opt_mobile-header-'.$var_lang['language_code'].']" rows="5" style="font-size: 12px; border-color: #ddd !important; width: 100%; box-shadow: none; border-radius: 5px; resize: none; margin: 10px 0 0 0;">'.b_f_option('b_opt_mobile-header-'.$var_lang['language_code']).'</textarea>';
		}
		$out .= '</div>';
		echo $out;
	}
} else {
	$out = '<textarea class="current" name="bilnea_settings[b_opt_mobile-header-es]" rows="5" style="font-size: 12px; border-color: #ddd !important; width: 100%; box-shadow: none; border-radius: 5px; resize: none; margin: 10px 0 0 0;">'.b_f_option('b_opt_mobile-header-es').'</textarea>';
	echo $out;
}

?>
<em class="notice" style="font-size: 11px; line-height: 15px; margin-bottom: 10px;">Shortcodes permitidos: {{b_menu}}, {{b_logo}}, {{b_search}}, {{b_search-icon}}, {{b_rrss}}, {{b_language_selector}}, {{b_switcher}}.</em>

<h4 style="margin-top: 10px;">Menú movil</h4>
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
			$out .= '<textarea data-lang="'.$var_lang['language_code'].'" name="bilnea_settings[b_opt_mobile-menu-'.$var_lang['language_code'].']" rows="5" style="font-size: 12px; border-color: #ddd !important; width: 100%; box-shadow: none; border-radius: 5px; resize: none; margin: 10px 0 0 0;">'.b_f_option('b_opt_mobile-menu-'.$var_lang['language_code']).'</textarea>';
		}
		$out .= '</div>';
		echo $out;
	}
} else {
	$out = '<textarea class="current" name="bilnea_settings[b_opt_mobile-menu-es]" rows="5" style="font-size: 12px; border-color: #ddd !important; width: 100%; box-shadow: none; border-radius: 5px; resize: none; margin: 10px 0 0 0;">'.b_f_option('b_opt_mobile-menu-es').'</textarea>';
	echo $out;
}

?>
<em class="notice" style="font-size: 11px; line-height: 15px; margin-bottom: 10px;">Shortcodes permitidos: {{b_menu}}, {{b_logo}}, {{b_search}}, {{b_search-icon}}, {{b_rrss}}, {{b_language_selector}}, {{b_switcher}}.</em>
