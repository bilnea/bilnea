<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

?>

<h4>Datos personales</h4>
<div style="width: calc(50% - 10px); margin-right: 16px; display: inline-block;">
	Nombre o Razón Social
	<br />
	<input type="text" id="user_name" class="gran" name="bilnea_settings[user_name]" style="width: 100%;" value="<?= b_f_option('user_name') ?>" />
</div>
<div style="width: calc(50% - 10px); display: inline-block;">
	CIF / NIF
	<br />
	<input type="text" id="user_cif" class="gran" name="bilnea_settings[user_cif]" style="width: 100%;" value="<?= b_f_option('user_cif') ?>" />
</div>
<div style="width: calc(50% - 10px); margin-right: 16px; display: inline-block;">
	Correo electrónico
	<br />
	<input type="text" id="user_email" class="gran" name="bilnea_settings[user_email]" style="width: 100%;" value="<?= b_f_option('user_email') ?>" />
</div>
<div style="width: calc(50% - 10px); display: inline-block;">
	Teléfono
	<br />
	<input type="text" id="user_phone" class="gran" name="bilnea_settings[user_phone]" style="width: 100%;" value="<?= b_f_option('user_phone') ?>" />
</div>
Dirección postal
<br />
<input type="text" id="user_address" class="gran" name="bilnea_settings[user_address]" style="width: 100%;" value="<?= b_f_option('user_address') ?>" />
<em class="notice" style="font-size: 12px;">
	Información que se mostrará en las páginas de textos legales, en caso de crearlas de manera automática.
</em>

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

			<h4 style="margin-top: 10px;">Páginas en <?= strtolower($var_language['translated_name']); ?> </h4>

			<!-- Aviso legal -->
			<div style="width: calc(50% - 10px); margin-right: 16px; display: inline-block;">
				Aviso legal
			</div>
			<div style="width: calc(50% - 10px); display: inline-block;">
				<select name="bilnea_settings[b_opt_legal-advice-<?= $var_language['language_code'] ?>]" class="gran" style="margin-top: -2px; width: 100% !important;">
					<option value="none" selected>Seleccionar opción</option>
					<option value="new">Crear página</option>
					<?php
					foreach (get_pages() as $page) {
						$var_id = icl_object_id($page->ID, 'category', true, $var_language['language_code']);
						echo '<option value="'.$var_id.'" '.selected(b_f_option('b_opt_legal-advice-'.$var_language['language_code']), $var_id).'>'.$page->post_title.'</option>';
					}
					?>
				</select>
			</div>
			<hr />

			<!-- Política de privacidad -->
			<div style="width: calc(50% - 10px); margin-right: 16px; display: inline-block;">
				Política de privacidad
			</div>
			<div style="width: calc(50% - 10px); display: inline-block;">
				<select name="bilnea_settings[b_opt_privacy-policy-<?= $var_language['language_code'] ?>]" class="gran" style="margin-top: -2px; width: 100% !important;">
					<option value="none" selected>Seleccionar opción</option>
					<option value="new">Crear página</option>
					<?php
					foreach (get_pages() as $page) {
						$var_id = icl_object_id($page->ID, 'category', true, $var_language['language_code']);
						echo '<option value="'.$var_id.'" '.selected(b_f_option('b_opt_privacy-policy-'.$var_language['language_code']), $var_id).'>'.$page->post_title.'</option>';
					}
					?>
				</select>
			</div>
			<hr />

			<!-- Aviso legal -->
			<div style="width: calc(50% - 10px); margin-right: 16px; display: inline-block;">
				Política de cookies
			</div>
			<div style="width: calc(50% - 10px); display: inline-block;">
				<select name="bilnea_settings[b_opt_cookies-policy-<?= $var_language['language_code'] ?>]" class="gran" style="margin-top: -2px; width: 100% !important;">
					<option value="none" selected>Seleccionar opción</option>
					<option value="new">Crear página</option>
					<?php
					foreach (get_pages() as $page) {
						$var_id = icl_object_id($page->ID, 'category', true, $var_language['language_code']);
						echo '<option value="'.$var_id.'" '.selected(b_f_option('b_opt_cookies-policy-'.$var_language['language_code']), $var_id).'>'.$page->post_title.'</option>';
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

	?>

	<h4>Páginas</h4>

	<!-- Aviso legal -->
	<div style="width: calc(50% - 10px); margin-right: 16px; display: inline-block;">
		Aviso legal
	</div>
	<div style="width: calc(50% - 10px); display: inline-block;">
		<select name="bilnea_settings[b_opt_legal-advice-es]" class="gran" style="margin-top: -2px; width: 100% !important;">
			<option value="none" selected>Seleccionar opción</option>
			<option value="new">Crear página</option>
			<?php
			foreach (get_pages() as $page) {
				echo '<option value="'.$page->ID.'" '.selected(b_f_option('b_opt_legal-advice-es'), $page->ID).'>'.$page->post_title.'</option>';
			}
			?>
		</select>
	</div>
	<hr />

	<!-- Política de privacidad -->
	<div style="width: calc(50% - 10px); margin-right: 16px; display: inline-block;">
		Política de privacidad
	</div>
	<div style="width: calc(50% - 10px); display: inline-block;">
		<select name="bilnea_settings[b_opt_privacy-policy-es]" class="gran" style="margin-top: -2px; width: 100% !important;">
			<option value="none" selected>Seleccionar opción</option>
			<option value="new">Crear página</option>
			<?php
			foreach (get_pages() as $page) {
				echo '<option value="'.$page->ID.'" '.selected(b_f_option('b_opt_privacy-policy-es'), $page->ID).'>'.$page->post_title.'</option>';
			}
			?>
		</select>
	</div>
	<hr />

	<!-- Aviso legal -->
	<div style="width: calc(50% - 10px); margin-right: 16px; display: inline-block;">
		Política de cookies
	</div>
	<div style="width: calc(50% - 10px); display: inline-block;">
		<select name="bilnea_settings[b_opt_cookies-policy-es]" class="gran" style="margin-top: -2px; width: 100% !important;">
			<option value="none" selected>Seleccionar opción</option>
			<option value="new">Crear página</option>
			<?php
			foreach (get_pages() as $page) {
				echo '<option value="'.$page->ID.'" '.selected(b_f_option('b_opt_cookies-policy-es'), $page->ID).'>'.$page->post_title.'</option>';
			}
			?>
		</select>
	</div>
<?php
}
?>
<h4 style="margin-top: 10px;">Configuración</h4>
<input type="checkbox" name="bilnea_settings[b_opt_create-cookies-table]" <?php checked($opt['b_opt_create-cookies-table'], 1); ?> value="1"> <span>Generar tabla de cookies de manera automática</span>
<hr />
<input type="checkbox" name="bilnea_settings[b_opt_cookies-warning]" <?php checked($opt['b_opt_cookies-warning'], 1); ?> value="1"> <span>Mostrar el aviso legal de cookies</span>