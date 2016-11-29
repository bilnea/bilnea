<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

?>

<h4>Blog</h4>
<div style="width: 314px; display: inline-block;">Número de entradas a mostrar por página</div>
<input style="text-align: right; width: 200px;" type="text" class="peq" name="bilnea_settings[b_opt_blog-number]" value="<?= b_f_option('b_opt_blog-number') ?>" placeholder="<?= b_f_default('b_opt_blog-number') ?>">
<br />
<div style="width: 314px; display: inline-block;">Ordenar entradas</div>
<select name="bilnea_settings[b_opt_blog-order]" class="gran" style="margin-top: -2px; width: 200px;">
	<option value="random" <?php selected(b_f_option('b_opt_blog-order'), 'random'); ?>>Orden aleatorio</option>
	<option value="title" <?php selected(b_f_option('b_opt_blog-order'), 'title'); ?>>Ordenar por título</option>
	<option selected value="date" <?php selected(b_f_option('b_opt_blog-order'), 'date'); ?>>Ordenar por fecha</option>
	<option value="author" <?php selected(b_f_option('b_opt_blog-order'), 'author'); ?>>Ordenar por autor</option>
</select>
<input type="checkbox" name="bilnea_settings[b_opt_blog-order-desc]" <?php checked(b_f_option('b_opt_blog-order-desc'), 1 ); ?> value="1"> <span>Invertir orden</span>
<h4 style="margin-top: 10px;">Maquetación de la página de entradas</h4>
Maquetación de la página de entradas.
<br />
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
			$out .= '<textarea data-lang="'.$var_lang['language_code'].'" name="bilnea_settings[b_opt_blog-content-page-'.$var_lang['language_code'].']" rows="10" style="font-size: 12px; border-color: #ddd !important; width: 100%; box-shadow: none; border-radius: 5px; resize: none; margin: 10px 0 0 0;">'.b_f_option('b_opt_blog-content-page-'.$var_lang['language_code']).'</textarea>';
		}
		$out .= '</div>';
		echo $out;
	}
} else {
	$out = '<textarea name="bilnea_settings[b_opt_blog-content-page-es]" rows="10" style="font-size: 12px; border-color: #ddd !important; width: 100%; box-shadow: none; border-radius: 5px; resize: none; margin: 10px 0 0 0;">'.b_f_option('b_opt_blog-content-page-es').'</textarea>';
	echo $out;
}

?>

<em class="notice" style="font-size: 11px; line-height: 15px; margin-bottom: 10px;">Shortcodes permitidos: {{b_blog}}, {{b_pagination}}.</em>
<h4>Maquetación de entrada</h4>
<strong>Entrada par</strong>
<br />
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
			$out .= '<textarea data-lang="'.$var_lang['language_code'].'" name="bilnea_settings[b_opt_blog-content-even-'.$var_lang['language_code'].']" rows="10" style="font-size: 12px; border-color: #ddd !important; width: 100%; box-shadow: none; border-radius: 5px; resize: none; margin: 10px 0 0 0;">'.b_f_option('b_opt_blog-content-even-'.$var_lang['language_code']).'</textarea>';
		}
		$out .= '</div>';
		echo $out;
	}
} else {
	$out = '<textarea name="bilnea_settings[b_opt_blog-content-even-es]" rows="10" style="font-size: 12px; border-color: #ddd !important; width: 100%; box-shadow: none; border-radius: 5px; resize: none; margin: 10px 0 0 0;">'.b_f_option('b_opt_blog-content-even-es').'</textarea>';
	echo $out;
}

?>
<strong>Entrada impar</strong>
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
			$out .= '<textarea data-lang="'.$var_lang['language_code'].'" name="bilnea_settings[b_opt_blog-content-odd-'.$var_lang['language_code'].']" rows="10" style="font-size: 12px; border-color: #ddd !important; width: 100%; box-shadow: none; border-radius: 5px; resize: none; margin: 10px 0 0 0;">'.b_f_option('b_opt_blog-content-odd-'.$var_lang['language_code']).'</textarea>';
		}
		$out .= '</div>';
		echo $out;
	}
} else {
	$out = '<textarea name="bilnea_settings[b_opt_blog-content-odd-es]" rows="10" style="font-size: 12px; border-color: #ddd !important; width: 100%; box-shadow: none; border-radius: 5px; resize: none; margin: 10px 0 0 0;">'.b_f_option('b_opt_blog-content-odd-es').'</textarea>';
	echo $out;
}

?>
<em class="notice" style="font-size: 11px; line-height: 15px; margin-bottom: 10px;">Shortcodes permitidos: {{b_title}}, {{b_permalink}}, {{b_excerpt}}, {{b_content}}, {{b_date}}, {{b_categories}}, {{b_author}}, {{b_tags}}, {{b_image-500x500}} (los valores definen la dimensión de la imagen destacada), {{b_comments-number}}, {{b_share}}.</em>
<h4>Maquetación de la página individual</h4>
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
			$out .= '<textarea data-lang="'.$var_lang['language_code'].'" name="bilnea_settings[b_opt_blog-content-single-'.$var_lang['language_code'].']" rows="10" style="font-size: 12px; border-color: #ddd !important; width: 100%; box-shadow: none; border-radius: 5px; resize: none; margin: 10px 0 0 0;">'.b_f_option('b_opt_blog-content-single-'.$var_lang['language_code']).'</textarea>';
		}
		$out .= '</div>';
		echo $out;
	}
} else {
	$out = '<textarea name="bilnea_settings[b_opt_blog-content-single-es]" rows="10" style="font-size: 12px; border-color: #ddd !important; width: 100%; box-shadow: none; border-radius: 5px; resize: none; margin: 10px 0 0 0;">'.b_f_option('b_opt_blog-content-single-es').'</textarea>';
	echo $out;
}

?>
<em class="notice" style="font-size: 11px; line-height: 15px; margin-bottom: 10px;">Shortcodes permitidos: {{b_title}}, {{b_permalink}}, {{b_excerpt}}, {{b_content}}, {{b_date}}, {{b_categories}}, {{b_author}}, {{b_tags}}, {{b_image-500x500}} (los valores definen la dimensión de la imagen destacada), {{b_comments-number}}, {{b_share}}.</em>
<h4>Opciones de visualización</h4>
<div style="display: block; vertical-align: top;">
	Categorías mostradas (en blanco muestra todas)
	<br />
	<select multiple style="font-size: 13px; width: 100%; font-size: 12px; width: 100%; border-radius: 5px; height: 116px; padding: 4px;" name='bilnea_settings[b_opt_blog-categories-showed][]'>
		<?php
		if (b_f_option('b_opt_blog-categories-showed') == null) {
			$var_category_container = array();
		} else {
			$var_category_container = b_f_option('b_opt_blog-categories-showed');
		}
		?>
		<option value="all" <?php if (in_array('all', $var_category_container)) { echo 'selected="selected"'; } ?>>Todas las categorías</option>
		<?php
		foreach (get_categories() as $var_category) {
			?>
			<option value="<?= $var_category->slug ?>" <?php if (in_array($var_category->slug, $var_category_container)) { echo 'selected="selected"'; } ?>><?= $var_category->name ?></option>
			<?php
		}
		?>
	</select>
</div>
<hr />
<div style="display: block; vertical-align: top;">
	Categorías ocultas (en blanco muestra todas)
	<br />
	<select multiple style="font-size: 13px; width: 100%; font-size: 12px; width: 100%; border-radius: 5px; height: 116px; padding: 4px;" name='bilnea_settings[b_opt_blog-categories-hidden][]'>
		<?php
		if (b_f_option('b_opt_blog-categories-hidden') == null) {
			$var_category_container = array();
		} else {
			$var_category_container = b_f_option('b_opt_blog-categories-hidden');
		}
		?>
		<option value="all" <?php if (in_array('all', $var_category_container)) { echo 'selected="selected"'; } ?>>Todas las categorías</option>
		<?php
		foreach (get_categories() as $var_category) {
			?>
			<option value="<?= $var_category->slug ?>" <?php if (in_array($var_category->slug, $var_category_container)) { echo 'selected="selected"'; } ?>><?= $var_category->name ?></option>
			<?php
		}
		?>
	</select>
</div>
<hr />
<?php
if (function_exists('icl_object_id')) {

	// Variables globakles
	global $sitepress;

	// Variables locales
	$var_language = $sitepress->get_current_language();
	$sitepress->switch_lang('es');
	$var_languages = icl_get_languages('skip_missing=0&orderby=code');
	if (!empty($var_languages)) {
		$int = 0;
		foreach ($var_languages as $var_lang) {
			if ($int > 0) { echo '<hr />'; }
			?>
			<div style="width: calc(50% - 10px); padding-right: 10px; border-right: 1px solid #ddd; margin-right: 8px; display: inline-block;">
				Texto del enlace "Leer más" en <?= strtolower($var_lang['translated_name']); ?>
				<br />
				<input style="text-align: left; width: 100%;" type="text" class="peq" name="bilnea_settings[b_opt_blog-read-more-<?= $var_lang['language_code']?>]" value="<?= b_f_option('b_opt_blog-read-more-'.$var_lang['language_code']) ?>" placeholder="<?= b_f_default('b_opt_blog-read-more-'.$var_lang['language_code']); ?>">
			</div>
			<div style="display: inline-block; width: calc(50% - 14px);">
				Formato de fecha para <?= strtolower($var_lang['translated_name']); ?>
				<br />
				<input style="text-align: left; width: 100%;" type="text" class="peq" name="bilnea_settings[b_opt_blog-date-<?= $var_lang['language_code']?>]" value="<?= b_f_option('b_opt_blog-date-'.$var_lang['language_code']) ?>" placeholder="<?= b_f_default('b_opt_blog-date-'.$var_lang['language_code']); ?>">
			</div>
			<?php
			$int++;
		}
	}
	$sitepress->switch_lang($var_language);
} else {
	?>
	<div style="width: calc(50% - 10px); padding-right: 10px; border-right: 1px solid #ddd; margin-right: 8px; display: inline-block;">
		Texto del enlace "Leer más"
		<br />
		<input style="text-align: left; width: 100%;" type="text" class="peq" name="bilnea_settings[b_opt_blog-read-more-es]" value="<?= b_f_option('b_opt_blog-read-more-es') ?>" placeholder="<?= b_f_default('b_opt_blog-read-more-es'); ?>">
	</div>
	<div style="display: inline-block; width: calc(50% - 14px);">
		Formato de fecha
		<br />
		<input style="text-align: left; width: 100%;" type="text" class="peq" name="bilnea_settings[b_opt_blog-date-es]" value="<?= b_f_option('b_opt_blog-date-es') ?>" placeholder="<?= b_f_default('b_opt_blog-date-es'); ?>">
	</div>
	<?php
}
?>