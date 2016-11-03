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
<h4 style="margin-top: 10px;">Páginas</h4>
<?php
if (function_exists('icl_object_id')) {
	global $sitepress;
	$clg = $sitepress->get_current_language();
	$sitepress->switch_lang('es');
	$lng = icl_get_languages('skip_missing=0&orderby=code');
	if (!empty($lng)) {
		$int = 0;
		foreach ($lng as $l) {
			if ($int > 0) { echo '<hr />'; }
			?>
			<div style="width: calc(50% - 10px); margin-right: 16px; display: inline-block;">
				Aviso legal en <?= strtolower($l['translated_name']); ?> 
			</div>
			<div style="width: calc(50% - 10px); display: inline-block;">
				CIF / NIF
				<br />
				<input type="text" id="user_cif" class="gran" name="bilnea_settings[user_cif]" style="width: 100%;" value="<?php echo $opt['user_cif']; ?>">
			</div>
			
			<br />
			<label for="bilnea_settings[b_opt_legal-url-_<?= $l['language_code']?>]"><?php echo $sitepress->language_url($l['language_code']); ?></label>
			<input style="font-size: 12px; -webkit-transform: translate(-5px, 1px); -moz-transform: translate(-5px, 1px); -ms-transform: translate(-5px, 1px); -o-transform: translate(-5px, 1px); transform: translate(-5px, 1px);" type="text" class="aurl" name="bilnea_settings[b_opt_legal-url-_<?= $l['language_code']?>]" value="<?= b_f_option('b_opt_legal-url-_'.$l['language_code']) ?>">
			<?php
			$int++;
		}
		?>
	<?php
	}
	$sitepress->switch_lang($clg);
} else {
	?>
	<!-- Aviso legal -->
	<div style="width: calc(50% - 10px); margin-right: 16px; display: inline-block;">
		Aviso legal
	</div>
	<div style="width: calc(50% - 10px); display: inline-block;">
		<select name="bilnea_settings[b_opt_legal-advice-es]" class="gran" style="margin-top: -2px; width: 100% !important;">
			<option disabled="disabled" selected>Seleccionar opción</option>
			<option value="new">Crear página</option>
			<?php
			foreach (get_pages() as $page) {
				echo '<option value="'.$page->ID.'" '.selected($opt['b_opt_legal-advice-es'], $page->ID).'">'.$page->post_title.'</option>';
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
			<option disabled="disabled" selected>Seleccionar opción</option>
			<option value="new">Crear página</option>
			<?php
			foreach (get_pages() as $page) {
				echo '<option value="'.$page->ID.'" '.selected($opt['b_opt_privacy-policy-es'], $page->ID).'">'.$page->post_title.'</option>';
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
			<option disabled="disabled" selected>Seleccionar opción</option>
			<option value="new">Crear página</option>
			<?php
			foreach (get_pages() as $page) {
				echo '<option value="'.$page->ID.'" '.selected($opt['b_opt_cookies-policy-es'], $page->ID).'">'.$page->post_title.'</option>';
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