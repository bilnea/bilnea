<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

?>

<!-- Buscador -->
<h4>Buscador</h4>
Limitar la búsqueda a los tipos de objetos
<div style="display: block; clear: both;"></div>

<?php

foreach (get_post_types() as $var_type) {
	if (!in_array($var_type, array('attachment', 'revision', 'nav_menu_item'))) {
		echo '<div style="width: 30%; display: inline-block;"><input type="checkbox" name="bilnea_settings[b_opt_search-include][]" value="'.$var_type.'" /> '.__(ucfirst($var_type), 'bilnea').'</div>';
	}
}

?>

<div style="display: block; clear: both;"></div>
Mostrar los resultados en este orden
<select multiple name="bilnea_settings[b_opt_search-order]" style="display: block; width: 100%;">
	
	<?php

	foreach (get_post_types() as $var_type) {
		if (!in_array($var_type, array('attachment', 'revision', 'nav_menu_item'))) {
			echo '<option value="'.$var_type.'" '.selected(b_f_option('b_opt_search-order'), $var_type).'> '.__(ucfirst($var_type), 'bilnea').'</option>';
		}
	}

	?>

</select>

<!-- Formulario de contacto -->
<h4>Formulario de contacto y envío de correo</h4>
<div style="overflow: hidden;">
	<div style="width: calc(50% - 7px); display: inline-block; float: left; margin-right: 14px;">
		Correo electrónico de destino
		<input type="text" class="gran" style="width: 100%;" name="bilnea_settings[b_opt_form-email]" value="<?= b_f_option('b_opt_form-email'); ?>" placeholder="<?= b_f_default('b_opt_form-email'); ?>" />
	</div>
	<div style="width: calc(50% - 7px); display: inline-block;">
		Página de redirección al enviar
		<select name="bilnea_settings[b_opt_form-thanks]" class="gran" style="margin-top: -4px; width: 100%; margin-bottom: 0;">
			<option selected disabled>Selecciona una página</option>
			<option value="none" <?php selected(b_f_option('b_opt_form-thanks'), 'none') ?>>Sin redirección</option>
			<option disabled>----------</option>

			<?php 

			$args = array(
				'sort_order' => 'asc',
				'sort_column' => 'post_title',
				'post_type' => 'page',
				'post_status' => 'publish'
			);

			$pages = get_pages($args);

			foreach ($pages as $page) {
				echo '<option value="'.$page->ID.'" '.selected(b_f_option('b_opt_form-thanks'), $page->ID).'>'.$page->post_title.'</option>';
			}

			?>

		</select>
	</div>
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

<!-- Suscriptores -->
<h4>Boletín de noticias</h4>
<input type="checkbox" name="bilnea_settings[b_opt_subscribers]" <?php checked(b_f_option('b_opt_subscribers'), 1 ); ?> value="1" class="disabler" data-connect="subscribers">Activar módulo de boletín de noticias<br />
<hr />
<div style="overflow: hidden;" data-connect="subscribers">
	<div style="width: calc(50% - 7px); display: inline-block; margin-right: 14px; float: left;">
		Servicio de boletines
		<select name="bilnea_settings[b_opt_newsl_service]" class="gran" style="margin-top: -4px; width: 100%; margin-bottom: 0;">
			<option selected disabled>Selecciona un servicio</option>
			<option value="wordpress" <?php selected(b_f_option('b_opt_newsl_service'), 'wordpress') ?>>Wordpress</option>
			<option value="mailchimp" <?php selected(b_f_option('b_opt_newsl_service'), 'mailchimp') ?>>Mailchimp</option>
			<option value="benchmark" <?php selected(b_f_option('b_opt_newsl_service'), 'benchmark') ?>>Benchmark</option>
		</select>
	</div>
	<div style="width: calc(50% - 7px); display: inline-block;">
		Página de redirección al enviar
		<select name="bilnea_settings[b_opt_newsl_redirect]" class="gran" style="margin-top: -4px; width: 100%; margin-bottom: 0;">
			<option selected disabled>Selecciona una página</option>
			<option value="none" <?php selected(b_f_option('b_opt_newsl_redirect'), 'none') ?>>Sin redirección</option>
			<option disabled>----------</option>
			<?php $args = array(
				'sort_order' => 'asc',
				'sort_column' => 'post_title',
				'post_type' => 'page',
				'post_status' => 'publish'
			); 
			$var_page = get_pages($args);
			foreach ($var_page as $page) {
				echo '<option value="'.$page->ID.'" '.selected(b_f_option('b_opt_newsl_redirect'), $page->ID).'>'.$page->post_title.'</option>';
			}
			?>
		</select>
	</div>
	<div style="width: 100%; display: inline-block; float: left; margin-right: 14px; margin-top: 7px;">
		<input type="text" class="gran" style="width: 100%;" name="bilnea_settings[b_opt_newsl_api]" value="<?= b_f_option('b_opt_newsl_api') ?>" placeholder="API Key" />
	</div>

</div>
<div class="notice" style="font-size: 11px; line-height: 15px; display: block !important;">Crea un listado de suscriptores que se recolecten desde los formularios presentes en la web. Activa los shortcodes relacionados con esta funcionalidad.</div>
<br />

<h4>API Keys</h4>
<div>Google Maps</div>
<div>
	<input type="text" class="gran" style="width: 100%;" name="bilnea_settings[b_opt_apis_gmaps]" value="<?= b_f_option('b_opt_apis_gmaps') ?>" placeholder="API Key" />
</div>
<hr style="margin-bottom: 0;" />
<div>Twitter</div>
<div>
	<input type="text" class="gran" style="width: 100%;" name="bilnea_settings[b_opt_apis_twitter_api-key]" value="<?= b_f_option('b_opt_apis_twitter_api-key') ?>" placeholder="API Key" />
	<input type="text" class="gran" style="width: 100%;" name="bilnea_settings[b_opt_apis_twitter_api-secret]" value="<?= b_f_option('b_opt_apis_twitter_api-secret') ?>" placeholder="API Secret" />
</div>
<br />

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