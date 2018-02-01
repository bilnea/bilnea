<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

?>

<!-- Suscriptores -->

<h4 data-type="title">Boletín de noticias</h4>

<div data-type="block">
	<input type="checkbox" name="bilnea_settings[b_opt_subscribers]" <?php checked(b_f_option('b_opt_subscribers'), 1 ); ?> value="1" class="disabler" data-connect="subscribers">Activar módulo de boletín de noticias
</div>

<hr />

<div data-type="block" data-size="33" data-connect="subscribers">
	Servicio
	<select name="bilnea_settings[b_opt_newsl_service]" class="gran" style="margin-top: -4px; width: 100%; margin-bottom: 0;">
		<option selected disabled>Selecciona un servicio</option>
		<option value="wordpress" <?php selected(b_f_option('b_opt_newsl_service'), 'wordpress') ?>>Wordpress</option>
		<option value="mailchimp" <?php selected(b_f_option('b_opt_newsl_service'), 'mailchimp') ?>>Mailchimp</option>
		<option value="benchmark" <?php selected(b_f_option('b_opt_newsl_service'), 'benchmark') ?>>Benchmark</option>
	</select>
</div>

<div data-type="block" data-size="66" data-connect="subscribers">
	API Key
	<input type="text" class="gran" style="width: 100%;" name="bilnea_settings[b_opt_newsl_api]" value="<?= b_f_option('b_opt_newsl_api') ?>" />
</div>

<hr />

<div data-type="block">
	<input type="checkbox" name="bilnea_settings[b_opt_double_opt_in]" <?php checked(b_f_option('b_opt_double_opt_in'), 1 ); ?> value="1">Activar la doble confirmación
</div>

<?php

	if (b_f_option('b_opt_newsl_api') != '') {
		$var_lists = json_decode(b_f_i_mailchimp('https://'.substr(b_f_option('b_opt_newsl_api'),strpos(b_f_option('b_opt_newsl_api'),'-')+1).'.api.mailchimp.com/3.0/lists/', 'GET', b_f_option('b_opt_newsl_api'), array('fields' => 'lists')))->lists;
	}
	

	if (function_exists('icl_object_id')) {

		// Variables globales
		global $sitepress;

		// Variables locales
		$var_languages = icl_get_languages('skip_missing=0&orderby=name');
		$var_count = 0;

		if (!empty($var_languages)) {
			foreach ($var_languages as $var_language) {
				$sitepress->switch_lang($var_language['language_code']);

				?>

				<hr />
				<strong style="display: block;"><?= $var_language['translated_name'] ?></strong>
				<div style="width: calc(50% - 7px); display: inline-block; float: left; margin-right: 14px;">
					Lista de suscripción
					<select id="b_opt_newsl_list-<?= $var_language['language_code'] ?>" name="bilnea_settings[b_opt_newsl_list-<?= $var_language['language_code'] ?>]" class="gran" style="margin-top: -4px; width: 100%; margin-bottom: 0;">
						<option selected disabled>Selecciona una lista</option>
						<option value="none" <?php selected(b_f_option('b_opt_newsl_list-'.$var_language['language_code']), 'none') ?>>Sin suscripción</option>
						<?php
						foreach ($var_lists as $var_list) {
							(b_f_option('b_opt_newsl_list-'.$var_language['language_code']) == $var_list->id) ? $var_selected = ' selected="selected"' : $var_selected = '';
							echo '<option value="'.$var_list->id.'"'.$var_selected.'>'.$var_list->name.' ('.$var_list->stats->member_count.')</option>';
						}
						?>
					</select>
				</div>
				<div style="width: calc(50% - 7px); display: inline-block;">
					Página de redirección al enviar
					<select name="bilnea_settings[b_opt_newsl-thanks-<?= $var_language['language_code'] ?>]" class="gran" style="margin-top: -4px; width: 100%; margin-bottom: 0;">
						<option selected disabled>Selecciona una página</option>
						<option value="none" <?php selected(b_f_option('b_opt_newsl-thanks-'.$var_language['language_code']), 'none') ?>>Sin redirección</option>

						<?php 

						$args = array(
							'sort_order' => 'asc',
							'sort_column' => 'post_title',
							'post_type' => 'page',
							'post_status' => 'publish'
						);

						$pages = get_pages($args);

						foreach ($pages as $page) {
							echo '<option value="'.$page->ID.'" '.selected(b_f_option('b_opt_newsl-thanks-'.$var_language['language_code']), $page->ID).'>'.$page->post_title.'</option>';
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

	<hr />

	<div data-type="block" data-size="50">
		Lista de suscripción
		<select id="b_opt_newsl_list-es" name="bilnea_settings[b_opt_newsl_list-es]" data-type="select" data-size="100">
			<option selected disabled>Selecciona una lista</option>
			<option value="none" <?php selected(b_f_option('b_opt_newsl_list-es'), 'none') ?>>Sin suscripción</option>
			<?php
			foreach ($var_lists as $var_list) {
				(b_f_option('b_opt_newsl_list-es') == $var_list->id) ? $var_selected = ' selected="selected"' : $var_selected = '';
				echo '<option value="'.$var_list->id.'"'.$var_selected.'>'.$var_list->name.' ('.$var_list->stats->member_count.')</option>';
			}
			?>
		</select>
	</div>

	<div data-type="block" data-size="50" data-float="right">
		Página de redirección al enviar
		<select name="bilnea_settings[b_opt_newsl-thanks-es]" data-type="select" data-size="100">
			<option selected disabled>Selecciona una página</option>
			<option value="none" <?php selected(b_f_option('b_opt_newsl-thanks-es'), 'none') ?>>Sin redirección</option>

			<?php 

			$args = array(
				'sort_order' => 'asc',
				'sort_column' => 'post_title',
				'post_type' => 'page',
				'post_status' => 'publish'
			);

			$pages = get_pages($args);

			foreach ($pages as $page) {
				echo '<option value="'.$page->ID.'" '.selected(b_f_option('b_opt_newsl-thanks-es'), $page->ID).'>'.$page->post_title.'</option>';
			}

			?>

		</select>
	</div>

		<?php

	}

	?>


<div data-type="notice">Crea un listado de suscriptores que se recolecten desde los formularios presentes en la web. Activa los shortcodes relacionados con esta funcionalidad.</div>

<h4 data-type="title">API Keys</h4>

<div data-type="block">
	Google Maps
	<input type="text" data-type="text" data-size="100" name="bilnea_settings[b_opt_apis_gmaps]" value="<?= b_f_option('b_opt_apis_gmaps') ?>" placeholder="API Key" />
</div>

<hr />

<div data-type="block">
	Twitter
	<input type="text" data-type="text" data-size="100" name="bilnea_settings[b_opt_apis_twitter_api-key]" value="<?= b_f_option('b_opt_apis_twitter_api-key') ?>" placeholder="API Key" />
	<input type="text" data-type="text" data-size="100" name="bilnea_settings[b_opt_apis_twitter_api-secret]" value="<?= b_f_option('b_opt_apis_twitter_api-secret') ?>" placeholder="API Secret" />
</div>