<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

?>


<!-- Buscador -->

<h4 data-type="title">Buscador</h4>

<div data-type="block">

	Limitar la búsqueda a los tipos de entradas

</div>

<div data-type="block">

	<?php

	$var_exclude = array('attachment', 'revision', 'nav_menu_item', 'custom_css', 'customize_changeset', 'oembed_cache', 'elementor_library');
	$var_search_types = ((b_f_option('b_opt_search-include') == null) ? array() : b_f_option('b_opt_search-include'));

	foreach (get_post_types() as $var_type) {
		if (!in_array($var_type, $var_exclude)) {
			$var_selected = (in_array($var_type, $var_search_types) ? ' checked' : '');
			echo '<div data-size="33" data-type="block"><input type="checkbox" name="bilnea_settings[b_opt_search-include][]"'.$var_selected.' value="'.$var_type.'" /> '.get_post_type_object($var_type)->labels->name.'</div>';
		}
	}

	?>
	
</div>

<hr />

<div data-type="black">
	
	Mostrar los resultados en este orden
	<select id="search-order" multiple name="bilnea_settings[b_opt_search-order][]" style="display: block; width: 100%;">
		
		<?php
		foreach (b_f_option('b_opt_search-order') as $var_type) {
			echo '<option value="'.$var_type.'" selected>'.get_post_type_object($var_type)->labels->name.'</option>';
		}

		foreach (get_post_types() as $var_type) {
			if (!in_array($var_type, $var_exclude) && !in_array($var_type, b_f_option('b_opt_search-order'))) {
				echo '<option value="'.$var_type.'">'.get_post_type_object($var_type)->labels->name.'</option>';
			}
		}

		?>

	</select>

</div>

<h4 data-type="title">Bloque de resultado</h4>

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
			$out .= '<textarea data-lang="'.$var_lang['language_code'].'" name="bilnea_settings[b_opt_search-block-'.$var_lang['language_code'].']" rows="10" style="font-size: 12px; border-color: #ddd !important; width: 100%; box-shadow: none; border-radius: 5px; resize: none; margin: 10px 0 0 0;">'.b_f_option('b_opt_search-block-'.$var_lang['language_code']).'</textarea>';
		}
		$out .= '</div>';
		echo $out;
	}
} else {

	?>

	<div data-type="block">Maquetación de un bloque de los resultados.</div>

	<div data-type="block" data-size="50">
		
		<select name="bilnea_settings[b_opt_widget-search-es]" style="margin-top: -2px; width: 100% !important;">
			<option value="none" selected>Seleccionar widget</option>

			<?php

				$args = array(
					'post_type'		 => 'elementor_library',
					'posts_per_page' => -1,
					'post_status'	 => 'publish'
				);

				foreach (get_posts($args) as $widget) {
					echo '<option value="'.$widget->ID.'" '.selected(b_f_option('b_opt_widget-search-es'), $widget->ID).'>'.$widget->post_title.'</option>';
				}

			?>

		</select>

	</div>

	<div data-type="block" data-size="50" data-float="right">

		<?php

		if (b_f_option('b_opt_widget-search-es') && current_user_can('edit_pages')) {
			echo '<a data-type="elementor-link" target="_blank" href="'.trim(site_url(), '/').'/wp-admin/post.php?post='.b_f_option('b_opt_widget-search-es').'&action=elementor">Editar bloque</a>';
		}

		?>
		
	</div>

	<?php

}

?>

<div data-type="notice">Shortcodes permitidos: {{b_title}}, {{b_link}}, {{b_date}}, {{b_content}}, {{b_excerpt}}, {{b_author-name}}, {{b_author-link}}, {{b_author-image}}, {{b_relevance}}. La etiqueta {{b_author}}{{/b_author}} encapsula el contenido mostrado u oculto si se muestra la ficha de autor.</div>


<!-- Opciones del buscador -->

<h4 data-type="title">Opciones</h4>

<div data-type="block">
	Mostrar fecha en los siguientes tipos de entradas
</div>

<?php

$var_search_types = ((b_f_option('b_opt_search-date') == null) ? array() : b_f_option('b_opt_search-date'));

foreach (get_post_types() as $var_type) {
	if (!in_array($var_type, $var_exclude)) {
		$var_selected = (in_array($var_type, $var_search_types) ? ' checked' : '');
		echo '<div data-type="block" data-size="33"><input type="checkbox" name="bilnea_settings[b_opt_search-date][]"'.$var_selected.' value="'.$var_type.'" /> '.get_post_type_object($var_type)->labels->name.'</div>';
	}
}

?>

<hr />

<div data-type="block">
	Mostrar ficha de autor en los siguientes tipos de entradas
</div>

<?php

$var_search_types = ((b_f_option('b_opt_search-author') == null) ? array() : b_f_option('b_opt_search-author'));

foreach (get_post_types() as $var_type) {
	if (!in_array($var_type, $var_exclude)) {
		$var_selected = (in_array($var_type, $var_search_types) ? ' checked' : '');
		echo '<div data-type="block" data-size="33"><input type="checkbox" name="bilnea_settings[b_opt_search-author][]"'.$var_selected.' value="'.$var_type.'" /> '.get_post_type_object($var_type)->labels->name.'</div>';
	}
}

?>

<div data-type="notice">Utilizar conjuntamente con la etiqueta {{b_author}}{{/b_author}} en la maquetación del bloque.</div>

