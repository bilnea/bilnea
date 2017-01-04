<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

?>

<!-- Buscador -->
<h4 style="margin-top: 16px;">Buscador</h4>
Limitar la búsqueda a los tipos de objetos
<div style="display: block; clear: both;"></div>

<?php

$var_exclude = array('attachment', 'revision', 'nav_menu_item', 'custom_css', 'customize_changeset');

foreach (get_post_types() as $var_type) {
	if (!in_array($var_type, $var_exclude)) {
		(in_array($var_type, b_f_option('b_opt_search-include'))) ? $var_selected = ' checked' : $var_selected = '';
		echo '<div style="width: 30%; display: inline-block;"><input type="checkbox" name="bilnea_settings[b_opt_search-include][]"'.$var_selected.' value="'.$var_type.'" /> '.get_post_type_object($var_type)->labels->name.'</div>';
	}
}

?>

<div style="display: block; clear: both;"></div>
Mostrar los resultados en este orden
<select multiple name="bilnea_settings[b_opt_search-order][]" style="display: block; width: 100%;">
	
	<?php

	foreach (get_post_types() as $var_type) {
		if (!in_array($var_type, $var_exclude)) {
			(in_array($var_type, b_f_option('b_opt_search-include'))) ? $var_selected = ' selected' : $var_selected = '';
			echo '<option value="'.$var_type.'" '.selected(b_f_option('b_opt_search-order'), $var_type).$var_selected.'> '.get_post_type_object($var_type)->labels->name.'</option>';
		}
	}

	?>

</select>
<br /><br />

<!-- Formulario de contacto -->
<h4>Formulario de contacto y envío de correo</h4>
<div style="overflow: hidden;">

	<?php

	if (function_exists('icl_object_id')) {

		// Variables globales
		global $sitepress;

		// Variables locales
		$var_languages = icl_get_languages('skip_missing=0&orderby=name');
		$var_count = 0;

		if (!empty($var_languages)) {
			foreach ($var_languages as $var_language) {
				$sitepress->switch_lang($var_language['language_code']);
				echo ($var_count != 0) ? '<br /><hr style="margin: 8px 0;" />' : '';

				?>

				<strong style="display: block;"><?= $var_language['translated_name'] ?></strong>
				<div style="width: calc(50% - 7px); display: inline-block; float: left; margin-right: 14px;">
					Correo electrónico de destino
					<input type="text" class="gran" style="width: 100%; margin-top: 5px !important;" name="bilnea_settings[b_opt_form-email-<?= $var_language['language_code'] ?>]" value="<?= b_f_option('b_opt_form-email-'.$var_language['language_code']); ?>" placeholder="<?= b_f_default('b_opt_form-email-'.$var_language['language_code']); ?>" />
				</div>
				<div style="width: calc(50% - 7px); display: inline-block;">
					Página de redirección al enviar
					<select name="bilnea_settings[b_opt_form-thanks-<?= $var_language['language_code'] ?>]" class="gran" style="margin-top: -4px; width: 100%; margin-bottom: 0;">
						<option selected disabled>Selecciona una página</option>
						<option value="none" <?php selected(b_f_option('b_opt_form-thanks-'.$var_language['language_code']), 'none') ?>>Sin redirección</option>

						<?php 

						$args = array(
							'sort_order' => 'asc',
							'sort_column' => 'post_title',
							'post_type' => 'page',
							'post_status' => 'publish'
						);

						$pages = get_pages($args);

						foreach ($pages as $page) {
							echo '<option value="'.$page->ID.'" '.selected(b_f_option('b_opt_form-thanks-'.$var_language['language_code']), $page->ID).'>'.$page->post_title.'</option>';
						}

						?>

					</select>
				</div>

				<?php

				$var_count++;
				$sitepress->switch_lang('es');
			}
		}

	} else {

		?>

		<div style="width: calc(50% - 7px); display: inline-block; float: left; margin-right: 14px;">
			Correo electrónico de destino
			<input type="text" class="gran" style="width: 100%;" name="bilnea_settings[b_opt_form-email-es]" value="<?= b_f_option('b_opt_form-email-es'); ?>" placeholder="<?= b_f_default('b_opt_form-email-es'); ?>" />
		</div>
		<div style="width: calc(50% - 7px); display: inline-block;">
			Página de redirección al enviar
			<select name="bilnea_settings[b_opt_form-thanks-es]" class="gran" style="margin-top: -4px; width: 100%; margin-bottom: 0;">
				<option selected disabled>Selecciona una página</option>
				<option value="none" <?php selected(b_f_option('b_opt_form-thanks-es'), 'none') ?>>Sin redirección</option>

				<?php 

				$args = array(
					'sort_order' => 'asc',
					'sort_column' => 'post_title',
					'post_type' => 'page',
					'post_status' => 'publish'
				);

				$pages = get_pages($args);

				foreach ($pages as $page) {
					echo '<option value="'.$page->ID.'" '.selected(b_f_option('b_opt_form-thanks-es'), $page->ID).'>'.$page->post_title.'</option>';
				}

				?>

			</select>
		</div>

		<?php

	}

	?>

</div>
<hr style="margin-bottom: 4px;" />
<input type="checkbox" name="bilnea_settings[b_opt_smtp]" <?php checked(b_f_option('b_opt_smtp'), 1); ?> value="1" class="disabler" data-connect="smtp-sender">Envío de emails a través de SMTP
<div data-connect="smtp-sender" style="margin-bottom: 10px;">
	<hr style="margin-bottom: 4px;" />
	<div style="width: 213px; display: inline-block;">Servidor SMTP</div>
	<input type="text" class="gran" name="bilnea_settings[b_opt_smtp-server]" value="<?= b_f_option('b_opt_smtp-server'); ?>" style="width: 239px;" /><span> : </span><input style="width: 50px;" type="text" class="peq" name="bilnea_settings[b_opt_smtp-port]" value="<?= b_f_option('b_opt_smtp-port'); ?>" placeholder="25" />
	<br />
	<div style="width: 213px; display: inline-block;">Usuario</div>
	<input type="text" class="gran" name="bilnea_settings[b_opt_smtp-user]" value="<?= b_f_option('b_opt_smtp-user'); ?>" />
	<br />
	<div style="width: 213px; display: inline-block;">Contraseña</div>
	<input type="text" class="gran" name="bilnea_settings[b_opt_smtp-pass]" value="<?= b_f_option('b_opt_smtp-pass'); ?>" />
	<hr />
	<div style="display: inline-block;">
		<input type="checkbox" name="bilnea_settings[b_opt_smtp-auth]" <?php checked(b_f_option('b_opt_smtp-auth'), 1); ?> value="1">El servidor requiere autenticación
		<br />
		<input type="checkbox" name="bilnea_settings[b_opt_smtp-secure]" <?php checked(b_f_option('b_opt_smtp-secure'), 1); ?> value="1" data-connect="smtp-secure" class="disabler">El servidor requiere una conexión segura
	</div>
	<div style="display: inline-block; padding-left: 6px; margin-left: 20px;" data-connect="smtp-secure">
		<input type="radio" name="bilnea_settings[b_opt_lightbox-smtp-protocol]" <?php checked(b_f_option('b_opt_lightbox-smtp-protocol'), 'ssl' ); ?> value="ssl">Protocolo SSL
		<br />
		<input type="radio" name="bilnea_settings[b_opt_lightbox-smtp-protocol]" <?php checked(b_f_option('b_opt_lightbox-smtp-protocol'), 'tls' ); ?> value="tls">Protocolo TLS
	</div>
</div>

<!-- Precarga -->
<h4>Precarga</h4>
<input type="checkbox" name="bilnea_settings[b_opt_loader]" <?php checked(b_f_option('b_opt_loader'), 1); ?> value="1">Activar módulo de precarga<br />
<div class="notice" style="font-size: 11px; line-height: 15px; display: block !important;">Activa un elemento flotante que desaparecerá una vez terminada la carga de la página. Este elemento se puede modificar editando el archivo 'loader.php'.</div>
<br />

<!-- Lightbox -->
<h4>Lightbox</h4>
<input type="checkbox" name="bilnea_settings[b_opt_lightbox]" <?php checked(b_f_option('b_opt_lightbox'), 1); ?> value="1" class="disabler" data-connect="lightbox">Activar lightbox<br />
<div data-connect="lightbox">
	<div style="display: inline-block;">
		<input type="radio" name="bilnea_settings[b_opt_lightbox-location]" <?php checked(b_f_option('b_opt_lightbox-location'), 1); ?> value="1">Para todas las imágenes y elementos multimedia
	</div>
	<br />
	<div style="display: inline-block;">
		<input type="radio" name="bilnea_settings[b_opt_lightbox-location]" <?php checked(b_f_option('b_opt_lightbox-location'), 2); ?> value="2">Bajo demanda (a través de shortcode)
	</div>
</div>
<br />

<!-- Hyphenator -->
<h4 style="margin-top: 10px;">Legibilidad</h4>
<input type="checkbox" name="bilnea_settings[b_opt_hyphenator]" <?php checked(b_f_option('b_opt_hyphenator'), 1); ?> value="1" class="disabler" data-connect="hyphenator">Activar hyphenator *
<div data-connect="hyphenator">
	Clase CSS sobre la que se actuará
	<input type="text" class="gran" style="width: 100%;" name="bilnea_settings[b_opt_hyphenator-selector]" value="<?= b_f_option('b_opt_hyphenator-selector') ?>" placeholder="<?= b_f_default('b_opt_hyphenator-selector'); ?>" />
</div>
<div class="notice" style="font-size: 11px; line-height: 15px; display: block !important;">* Separa sílabas de manera automática en los saltos de línea para ajustar el párrafo al ancho del elemento contenedor.</div>


<!-- Scripts -->
<h4 style="margin-top: 10px;">Tecnologías de terceros</h4>
<input type="checkbox" name="bilnea_settings[b_opt_jquery-ui]" <?php checked(b_f_option('b_opt_jquery-ui'), 1); ?> value="1">Activar jQuery UI<br />
<input type="checkbox" name="bilnea_settings[b_opt_jquery-mobile]" <?php checked(b_f_option('b_opt_jquery-mobile'), 1); ?> value="1">Activar jQuery mobile<br />
<input type="checkbox" name="bilnea_settings[b_opt_jquery-mobile-css]" <?php checked(b_f_option('b_opt_jquery-mobile-css'), 1); ?> value="1">Activar estilos visuales de jQuery mobile<br />
<input type="checkbox" name="bilnea_settings[b_opt_select2]" <?php checked(b_f_option('b_opt_select2'), 1); ?> value="1">Activar Select2

<!-- Mantenimiento -->
<h4 style="margin-top: 10px;">Mantenimiento</h4>
<input type="checkbox" name="bilnea_settings[b_opt_construction]" <?php checked(b_f_option('b_opt_construction'), 1 ); ?> value="1">Activar modo mantenimiento
<em class="notice" style="font-size: 11px; line-height: 15px; display: block !important;">
	La página de mantenimiento se puede personalizar editando los archivos 'index.html' y 'main.css' ubicados en la carpeta 'tmp' del tema activo.<br />Para acceder a la web, utiliza la url <?= get_site_url(); ?>/?key=bilnea
</em>