<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

?>

<h4 data-type="title">Cabecera de página</h4>

<?php

if (function_exists('pll_languages_list')) {

	$count = 0;

	foreach (get_terms(array('taxonomy' => 'term_language', 'hide_empty' => false)) as $language) {

		echo ($count != 0) ? '<br /><br />' : '';

		?>

		<strong style="display: block;"><?= $language->name ?></strong>

		<?= b_f_admin_elementor('Cabecera de página', 'header-'.str_replace('pll_', '', str_replace('pll_', '', $language->slug))) ?>

		<hr />

		<?= b_f_admin_elementor('Cabecera móvil', 'mobile-header-'.str_replace('pll_', '', str_replace('pll_', '', $language->slug))) ?>

		<hr />

		<?= b_f_admin_elementor('Menú móvil', 'mobile-menu-'.str_replace('pll_', '', str_replace('pll_', '', $language->slug))) ?>

		<?php

		$count++;

	}

} else {

	echo b_f_admin_elementor('Cabecera de página', 'header-es');

	echo b_f_admin_elementor('Cabecera móvil', 'mobile-header-es');

	echo b_f_admin_elementor('Menú móvil', 'mobile-menu-es');

}

?>

<hr />

<div data-type="block">
	<input type="checkbox" name="bilnea_settings[b_opt_sticky-menu]" <?php checked(b_f_option('b_opt_sticky-menu'), 1); ?> value="1" />
	<label for="bilnea_settings[b_opt_sticky-menu]">Cabecera fija en pantalla</label>
</div>

<div data-type="block">
	<input type="checkbox" name="bilnea_settings[b_opt_sticky-menu-animated]" <?php checked(b_f_option('b_opt_sticky-menu-animated'), 1); ?> value="1" />
	<label for="bilnea_settings[b_opt_sticky-menu-animated]">Ocultar automáticamente</label>
</div>

<h4 data-type="title">Pie de página</h4>

<?php

if (function_exists('pll_languages_list')) {

	$count = 0;

	foreach (get_terms(array('taxonomy' => 'term_language', 'hide_empty' => false)) as $language) {

		echo ($count != 0) ? '<br /><br />' : '';

		?>

		<strong style="display: block;"><?= $language->name ?></strong>

		<?= b_f_admin_elementor('Pie de página', 'footer-'.str_replace('pll_', '', str_replace('pll_', '', $language->slug))) ?>

		<?php

		$count++;

	}

} else {

	echo b_f_admin_elementor('Pie de página', 'footer-es');

}

?>