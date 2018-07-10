<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

?>


<!-- Formulario de contacto -->

<h4 data-type="title">Formularios y envío de correo</h4>

<?php

	if (function_exists('pll_languages_list')) {

		// Variables locales
		$count = 0;

		foreach (get_terms(array('taxonomy' => 'term_language', 'hide_empty' => false)) as $language) {

			echo ($count != 0) ? '<br /><hr style="margin: 8px 0;" />' : '';

			?>

			<strong style="display: block;"><?= $language->name ?></strong>
			<div style="width: calc(50% - 7px); display: inline-block; float: left; margin-right: 14px;">
				Correo electrónico de destino
				<input type="text" class="gran" style="width: 100%; margin-top: 5px !important;" name="bilnea_settings[b_opt_form-email-<?= str_replace('pll_', '', $language->slug) ?>]" value="<?= b_f_option('b_opt_form-email-'.str_replace('pll_', '', $language->slug)); ?>" placeholder="<?= b_f_default('b_opt_form-email-'.str_replace('pll_', '', $language->slug)); ?>" />
			</div>
			<div style="width: calc(50% - 7px); display: inline-block;">
				Página de redirección al enviar
				<select name="bilnea_settings[b_opt_form-thanks-<?= str_replace('pll_', '', $language->slug) ?>]" class="gran" style="margin-top: -4px; width: 100%; margin-bottom: 0;">
					<option selected disabled>Selecciona una página</option>
					<option value="none" <?php selected(b_f_option('b_opt_form-thanks-'.str_replace('pll_', '', $language->slug)), 'none') ?>>Sin redirección</option>

					<?php

					$args = array(
						'sort_order' => 'asc',
						'sort_column' => 'post_title',
						'post_type' => 'page',
						'post_status' => 'publish'
					);

					$pages = get_pages($args);

					foreach ($pages as $page) {
						echo '<option value="'.$page->ID.'" '.selected(b_f_option('b_opt_form-thanks-'.str_replace('pll_', '', $language->slug)), $page->ID).'>'.$page->post_title.'</option>';
					}

					?>

				</select>
			</div>

			<?php

			$count++;
		}

	} else {

		?>

		<div data-type="block">
			Correo electrónico de destino
			<input type="text" data-size="50" data-float="right" name="bilnea_settings[b_opt_form-email-es]" value="<?= b_f_option('b_opt_form-email-es'); ?>" placeholder="<?= b_f_default('b_opt_form-email-es'); ?>" />
		</div>

		<hr />

		<div data-type="block">
			Mensaje en correo electrónico de respuesta
			<textarea data-size="100" data-type="textarea" name="bilnea_settings[b_opt_response-email-es]" value="<?= b_f_option('b_opt_response-email-es'); ?>" rows="5" placeholder="<?= b_f_default('b_opt_response-email-es'); ?>" /></textarea>
		</div>

		<hr />

		<?php

	}

	if (function_exists('pll_languages_list')) {

		// Variables locales
		$count = 0;

		foreach (get_terms(array('taxonomy' => 'term_language', 'hide_empty' => false)) as $language) {

			?>

			<br /><hr style="margin: 8px 0;" />
			<strong style="display: block;"><?= $language->name ?></strong>
			<div style="width: 100%; display: inline-block; float: left; margin-right: 14px;">
				Mensaje en correo electrónico de respuesta
				<input type="text" class="gran" style="width: 100%; margin-top: 5px !important;" name="bilnea_settings[b_opt_response-email-<?= str_replace('pll_', '', $language->slug) ?>]" value="<?= b_f_option('b_opt_response-email-'.str_replace('pll_', '', $language->slug)); ?>" placeholder="<?= b_f_default('b_opt_response-email-'.str_replace('pll_', '', $language->slug)); ?>" />
			</div>

			<?php

		}
	}

?>

<input type="checkbox" data-type="checkbox" name="bilnea_settings[b_opt_smtp]" <?php checked(b_f_option('b_opt_smtp'), 1); ?> value="1" class="disabler" data-connect="smtp-sender">Envío de emails a través de SMTP

<div data-type="block" data-connect="smtp-sender">
	Servidor SMTP
	<div data-float="right" style="text-align: right;">
		<input type="text" data-size="75" data-type="text" name="bilnea_settings[b_opt_smtp-server]" value="<?= b_f_option('b_opt_smtp-server'); ?>" />
		<span> : </span>
		<input type="text" data-size="10" data-type="text" name="bilnea_settings[b_opt_smtp-port]" value="<?= b_f_option('b_opt_smtp-port'); ?>" placeholder="25" />
	</div>
</div>

<div data-type="block" data-connect="smtp-sender" data-size="100">
	<input type="checkbox" data-type="checkbox" name="bilnea_settings[b_opt_smtp-auth]" <?php checked(b_f_option('b_opt_smtp-auth'), 1); ?> value="1" data-connect="smtp-auth" class="disabler">El servidor requiere autenticación
	<div data-type="block" data-connect="smtp-secure" data-float="right" data-connect="smtp-secure">
		<input data-type="radio" type="radio" name="bilnea_settings[b_opt_lightbox-smtp-protocol]" <?php checked(b_f_option('b_opt_lightbox-smtp-protocol'), 'ssl' ); ?> value="ssl">Protocolo SSL
	</div>
</div>

<div data-type="block" data-connect="smtp-sender" data-size="100">
	<input type="checkbox" data-type="checkbox" name="bilnea_settings[b_opt_smtp-secure]" <?php checked(b_f_option('b_opt_smtp-secure'), 1); ?> value="1" data-connect="smtp-secure" class="disabler">El servidor requiere una conexión segura
	<div data-type="block" data-connect="smtp-secure" data-float="right" data-connect="smtp-secure">
		<input data-type="radio" type="radio" name="bilnea_settings[b_opt_lightbox-smtp-protocol]" <?php checked(b_f_option('b_opt_lightbox-smtp-protocol'), 'tls' ); ?> value="tls">Protocolo TLS
	</div>
	<div data-type="block" data-connect="smtp-auth" data-size="100">
		Usuario
		<input type="text" data-type="text" data-float="right" data-size="33" name="bilnea_settings[b_opt_smtp-user]" value="<?= b_f_option('b_opt_smtp-user'); ?>" />
	</div>

	<div data-type="block" data-connect="smtp-auth" data-size="100">
		Contraseña
		<input type="text" data-type="text" data-float="right" data-size="33" name="bilnea_settings[b_opt_smtp-pass]" value="<?= b_f_option('b_opt_smtp-pass'); ?>" />
	</div>
</div>


<!-- Compresión -->

<h4 data-type="title">Compresión</h4>

<div data-type="block">
	<input data-type="checkbox" type="checkbox" name="bilnea_settings[b_opt_minify_js]" <?php checked(b_f_option('b_opt_minify_js'), 1); ?> value="1">Comprimir JS
</div>

<div data-type="block">
	<input data-type="checkbox" type="checkbox" name="bilnea_settings[b_opt_minify_css]" <?php checked(b_f_option('b_opt_minify_css'), 1); ?> value="1">Comprimir CSS
</div>


<!-- Precarga -->

<h4 data-type="title">Precarga</h4>

<div>
	<input type="checkbox" name="bilnea_settings[b_opt_loader]" <?php checked(b_f_option('b_opt_loader'), 1); ?> value="1">Activar módulo de precarga
</div>

<div data-type="notice">Activa un elemento flotante que desaparecerá una vez terminada la carga de la página. Este elemento se puede modificar editando el archivo 'loader.php'.</div>


<!-- Lightbox -->

<h4 data-type="title">Mesa de luz</h4>

<div data-type="block">
	<input type="checkbox" name="bilnea_settings[b_opt_lightbox]" <?php checked(b_f_option('b_opt_lightbox'), 1); ?> value="1" class="disabler" data-connect="lightbox">Activar la mesa de luz
</div>

<div data-type="block" data-connect="lightbox">
	<div data-type="block">
		<input type="radio" name="bilnea_settings[b_opt_lightbox-location]" <?php checked(b_f_option('b_opt_lightbox-location'), 1); ?> value="1">Para todas las imágenes y elementos multimedia
	</div>
	<div data-type="block">
		<input type="radio" name="bilnea_settings[b_opt_lightbox-location]" <?php checked(b_f_option('b_opt_lightbox-location'), 2); ?> value="2">Bajo demanda (a través de shortcode)
	</div>
</div>


<!-- Hyphenator -->

<h4 data-type="title">Legibilidad</h4>

<div data-type="block">
	<input type="checkbox" name="bilnea_settings[b_opt_hyphenator]" <?php checked(b_f_option('b_opt_hyphenator'), 1); ?> value="1" class="disabler" data-connect="hyphenator">Activar hyphenator *
</div>


<div data-type="block" data-connect="hyphenator">
	Clase CSS sobre la que se actuará
	<input type="text" data-float="right" data-size="33" name="bilnea_settings[b_opt_hyphenator-selector]" value="<?= b_f_option('b_opt_hyphenator-selector') ?>" placeholder="<?= b_f_default('b_opt_hyphenator-selector'); ?>" />
</div>

<div data-type="notice">* Separa sílabas de manera automática en los saltos de línea para ajustar el párrafo al ancho del elemento contenedor.</div>


<!-- Scripts -->

<h4 data-type="title">Plugins</h4>

<div data-type="block">
	<input type="checkbox" name="bilnea_settings[b_opt_jquery-ui]" <?php checked(b_f_option('b_opt_jquery-ui'), 1); ?> value="1">Activar jQuery UI<br />
	<input type="checkbox" name="bilnea_settings[b_opt_jquery-mobile]" <?php checked(b_f_option('b_opt_jquery-mobile'), 1); ?> value="1">Activar jQuery mobile<br />
	<input type="checkbox" name="bilnea_settings[b_opt_jquery-mobile-css]" <?php checked(b_f_option('b_opt_jquery-mobile-css'), 1); ?> value="1">Activar estilos visuales de jQuery mobile<br />
	<input type="checkbox" name="bilnea_settings[b_opt_select2]" <?php checked(b_f_option('b_opt_select2'), 1); ?> value="1">Activar Select2
</div>