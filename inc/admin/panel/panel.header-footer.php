<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

?>

<h4 data-type="title">Favicon</h4>
<div>
	<div class="favicon iconico" id="favicon_div"></div>
	<div style="position: relative; transform: translateY(3px);">
		<span>Seleccionar imagen</span> / <span id="borra_logo">Borrar</span>
		<br />
		<?php
		if (b_f_option('b_opt_favicon')) {
		?>
		<script type="text/javascript">
			jQuery('#favicon_div').attr('style', 'background-image: url(<?= b_f_option('b_opt_favicon'); ?>)');
			jQuery('#borra_logo').show();
		</script>
		<?php
		}
		?>
		<input type="text" id="fav_main_url" class="gran" name="bilnea_settings[b_opt_favicon]" style="width: calc(100% - 32px);" value="<?= b_f_option('b_opt_favicon') ?>">
		<button type="submit" id="subir_fav_main" value="Seleccionar imagen"  class="button-secondary subir-imagen">
			<i class="fa fa-search" style="font-size: 12px;"></i>
		</button>
	</div>
</div>

<h4 data-type="title">Cabecera de página</h4>

<?php

if (function_exists('icl_object_id')) {

	// Variables globales
	global $sitepress;

	// Variables locales
	$var_languages = icl_get_languages('skip_missing=0&orderby=name');

	if (!empty($var_languages)) {

		$i = 0;

		foreach ($var_languages as $var_language) {

			$sitepress->switch_lang($var_language['language_code']);

			?>

			<div style="width: calc(50% - 10px); margin-right: 16px; display: inline-block;">
				Cabecera de página (<?= strtolower($var_language['translated_name']); ?>)
			</div>

			<div style="width: calc(50% - 10px); display: inline-block;">

				<select name="bilnea_settings[b_opt_widget-header-<?= $var_language['language_code'] ?>]" class="gran" style="margin-top: -2px; width: 100% !important;">
					<option value="none" selected>Seleccionar widget</option>

					<?php

					$args = array(
						'post_type'		 => 'elementor_library',
						'posts_per_page' => -1,
						'post_status'	 => 'publish'
					);

					foreach (get_posts($args) as $widget) {
						echo '<option value="'.$widget->ID.'" '.selected(b_f_option('b_opt_widget-header-'.$var_language['language_code']), $widget->ID).'>'.$widget->post_title.'</option>';
					}

					?>

				</select>

			</div>

			<hr />

			<div style="width: calc(50% - 10px); margin-right: 16px; display: inline-block;">
				Cabecera móvil (<?= strtolower($var_language['translated_name']); ?>)
			</div>

			<div style="width: calc(50% - 10px); display: inline-block;">

				<select name="bilnea_settings[b_opt_widget-mobile-header-<?= $var_language['language_code'] ?>]" class="gran" style="margin-top: -2px; width: 100% !important;">
					<option value="none" selected>Seleccionar widget</option>

					<?php

					$args = array(
						'post_type'		 => 'elementor_library',
						'posts_per_page' => -1,
						'post_status'	 => 'publish'
					);

					foreach (get_posts($args) as $widget) {
						echo '<option value="'.$widget->ID.'" '.selected(b_f_option('b_opt_widget-mobile-header-'.$var_language['language_code']), $widget->ID).'>'.$widget->post_title.'</option>';
					}

					?>

				</select>

			</div>

			<hr />

			<div style="width: calc(50% - 10px); margin-right: 16px; display: inline-block;">
				Menú móvil (<?= strtolower($var_language['translated_name']); ?>)
			</div>

			<div style="width: calc(50% - 10px); display: inline-block;">

				<select name="bilnea_settings[b_opt_widget-mobile-menu-<?= $var_language['language_code'] ?>]" class="gran" style="margin-top: -2px; width: 100% !important;">
					<option value="none" selected>Seleccionar widget</option>

					<?php

					$args = array(
						'post_type'		 => 'elementor_library',
						'posts_per_page' => -1,
						'post_status'	 => 'publish'
					);

					foreach (get_posts($args) as $widget) {
						echo '<option value="'.$widget->ID.'" '.selected(b_f_option('b_opt_widget-mobile-menu-'.$var_language['language_code']), $widget->ID).'>'.$widget->post_title.'</option>';
					}

					?>

				</select>

			</div>
			
			<?php

			$i++;
		}

	}

	$sitepress->switch_lang('es');

} else {

	echo b_f_admin_elementor('Cabecera de página', 'header');

	echo b_f_admin_elementor('Cabecera móvil', 'mobile-header');

	echo b_f_admin_elementor('Menú móvil', 'mobile-menu');

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

if (function_exists('icl_object_id')) {

	// Variables globales
	global $sitepress;

	// Variables locales
	$var_languages = icl_get_languages('skip_missing=0&orderby=name');

	if (!empty($var_languages)) {

		$i = 0;

		foreach ($var_languages as $var_language) {

			$sitepress->switch_lang($var_language['language_code']);

			?>

			<div style="width: calc(50% - 10px); margin-right: 16px; display: inline-block;">
				Cabecera de página (<?= strtolower($var_language['translated_name']); ?>)
			</div>

			<div style="width: calc(50% - 10px); display: inline-block;">

				<select name="bilnea_settings[b_opt_widget-header-<?= $var_language['language_code'] ?>]" class="gran" style="margin-top: -2px; width: 100% !important;">
					<option value="none" selected>Seleccionar widget</option>

					<?php

					$args = array(
						'post_type'		 => 'elementor_library',
						'posts_per_page' => -1,
						'post_status'	 => 'publish'
					);

					foreach (get_posts($args) as $widget) {
						echo '<option value="'.$widget->ID.'" '.selected(b_f_option('b_opt_widget-header-'.$var_language['language_code']), $widget->ID).'>'.$widget->post_title.'</option>';
					}

					?>

				</select>

			</div>

			<hr />

			<div style="width: calc(50% - 10px); margin-right: 16px; display: inline-block;">
				Cabecera móvil (<?= strtolower($var_language['translated_name']); ?>)
			</div>

			<div style="width: calc(50% - 10px); display: inline-block;">

				<select name="bilnea_settings[b_opt_widget-mobile-header-<?= $var_language['language_code'] ?>]" class="gran" style="margin-top: -2px; width: 100% !important;">
					<option value="none" selected>Seleccionar widget</option>

					<?php

					$args = array(
						'post_type'		 => 'elementor_library',
						'posts_per_page' => -1,
						'post_status'	 => 'publish'
					);

					foreach (get_posts($args) as $widget) {
						echo '<option value="'.$widget->ID.'" '.selected(b_f_option('b_opt_widget-mobile-header-'.$var_language['language_code']), $widget->ID).'>'.$widget->post_title.'</option>';
					}

					?>

				</select>

			</div>

			<hr />

			<div style="width: calc(50% - 10px); margin-right: 16px; display: inline-block;">
				Menú móvil (<?= strtolower($var_language['translated_name']); ?>)
			</div>

			<div style="width: calc(50% - 10px); display: inline-block;">

				<select name="bilnea_settings[b_opt_widget-mobile-menu-<?= $var_language['language_code'] ?>]" class="gran" style="margin-top: -2px; width: 100% !important;">
					<option value="none" selected>Seleccionar widget</option>

					<?php

					$args = array(
						'post_type'		 => 'elementor_library',
						'posts_per_page' => -1,
						'post_status'	 => 'publish'
					);

					foreach (get_posts($args) as $widget) {
						echo '<option value="'.$widget->ID.'" '.selected(b_f_option('b_opt_widget-mobile-menu-'.$var_language['language_code']), $widget->ID).'>'.$widget->post_title.'</option>';
					}

					?>

				</select>

			</div>
			
			<?php

			$i++;
		}

	}

	$sitepress->switch_lang('es');

} else {

	echo b_f_admin_elementor('Pie de página', 'footer');

}

?>