<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

?>

<h4 data-type="title">Datos personales</h4>
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
<div data-type="notice">Información que se mostrará en las páginas de textos legales, en caso de crearlas de manera automática.</div>

<h4 data-type="title">Páginas de información legal</h4>
<?php

if (function_exists('pll_languages_list')) {

	$i = 0;

	foreach (get_terms(array('taxonomy' => 'term_language', 'hide_empty' => false)) as $language) {

		?>

		<h4 style="margin-top: 10px;"><?= $language->name; ?> </h4>

		<!-- Aviso legal -->
		<div style="width: calc(50% - 10px); margin-right: 16px; display: inline-block;">
			Aviso legal
		</div>
		<div style="width: calc(50% - 10px); display: inline-block;">
			<select name="bilnea_settings[b_opt_legal-advice-<?= str_replace('pll_', '', $language->slug) ?>]" class="gran" style="margin-top: -2px; width: 100% !important;">
				<option value="none" selected>Seleccionar opción</option>
				<option value="new">Crear página</option>
				<?php
				foreach (get_pages() as $page) {
					$varid = icl_object_id($page->ID, 'category', true, str_replace('pll_', '', $language->slug));
					echo '<option value="'.$varid.'" '.selected(b_f_option('b_opt_legal-advice-'.str_replace('pll_', '', $language->slug)), $varid).'>'.$page->post_title.'</option>';
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
			<select name="bilnea_settings[b_opt_privacy-policy-<?= str_replace('pll_', '', $language->slug) ?>]" class="gran" style="margin-top: -2px; width: 100% !important;">
				<option value="none" selected>Seleccionar opción</option>
				<option value="new">Crear página</option>
				<?php
				foreach (get_pages() as $page) {
					$varid = icl_object_id($page->ID, 'category', true, str_replace('pll_', '', $language->slug));
					echo '<option value="'.$varid.'" '.selected(b_f_option('b_opt_privacy-policy-'.str_replace('pll_', '', $language->slug)), $varid).'>'.$page->post_title.'</option>';
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
			<select name="bilnea_settings[b_opt_cookies-policy-<?= str_replace('pll_', '', $language->slug) ?>]" class="gran" style="margin-top: -2px; width: 100% !important;">
				<option value="none" selected>Seleccionar opción</option>
				<option value="new">Crear página</option>
				<?php
				foreach (get_pages() as $page) {
					$varid = icl_object_id($page->ID, 'category', true, str_replace('pll_', '', $language->slug));
					echo '<option value="'.$varid.'" '.selected(b_f_option('b_opt_cookies-policy-'.str_replace('pll_', '', $language->slug)), $varid).'>'.$page->post_title.'</option>';
				}
				?>
			</select>
		</div>

		<?php

		$i++;

	}

} else {

	?>

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
<input type="checkbox" name="bilnea_settings[b_opt_create-cookies-table]" <?php checked(b_f_option('b_opt_create-cookies-table'), 1); ?> value="1"> <span>Generar tabla de cookies de manera automática</span>
<hr />
<input type="checkbox" name="bilnea_settings[b_opt_cookies-warning]" <?php checked(b_f_option('b_opt_cookies-warning'), 1); ?> value="1"> <span>Mostrar el aviso legal de cookies</span>
<hr />
<h4 data-type="title">Aviso de cookies</h4>
<?php

if (function_exists('pll_languages_list')) {

	$out = '<div>';

	foreach (get_terms(array('taxonomy' => 'term_language', 'hide_empty' => false)) as $language) {
		$out .= '<strong>'.$language->name.'</strong><textarea data-lang="'.str_replace('pll_', '', $language->slug).'" name="bilnea_settings[b_opt_cookies-advice-'.str_replace('pll_', '', $language->slug).']" rows="10" style="font-size: 12px; border-color: #ddd !important; width: 100%; box-shadow: none; border-radius: 5px; resize: none; margin: 10px 0 0 0;">'.b_f_option('b_opt_cookies-advice-'.str_replace('pll_', '', $language->slug)).'</textarea>';
	}

	$out .= '</div>';

	echo $out;

} else {

	echo '<textarea data-lang="es" name="bilnea_settings[b_opt_cookies-advice-es]" rows="10" style="font-size: 12px; border-color: #ddd !important; width: 100%; box-shadow: none; border-radius: 5px; resize: none; margin: 10px 0 0 0;">'.b_f_option('b_opt_cookies-advice-es').'</textarea>';

}

?>

<div data-type="notice">Se pueden utilizar los shortcodes {{b_link}} para la url a la política de cookies y {{b_close}} para mostrar el botón de cerrar.</div>