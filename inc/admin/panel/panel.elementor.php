<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

?>

<h4 data-type="title">Páginas de elementor</h4>

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

	<?= b_f_admin_elementor('Página de entradas', 'index') ?>

	<hr />

	<?php

	foreach (get_post_types(array('public' => true), 'objects') as $slug => $type) {

		if (!in_array($slug, array('page', 'attachment', 'elementor_library'))) {

			?>

			<?= b_f_admin_elementor('Página individual para "'.$type->labels->name.'"', $slug) ?>

			<hr />

			<?php

		}

	}

	?>

	<?= b_f_admin_elementor('Página 404', '404') ?>

	<?php

	foreach (get_taxonomies(array('public' => true), 'objects') as $slug => $taxonomy) {

		if ($slug != 'post_format' && $slug != 'product_shipping_class') {

			?>

			<hr />

			<?= b_f_admin_elementor('Página de archivos para taxonomía "'.$taxonomy->labels->name.'"', $slug) ?>

			<?php

		}

	}

	if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {

		echo '<hr />';
		
		echo b_f_admin_elementor('Página de la tienda', 'store');

	}

}

?>