<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'page=bilnea') === false) {
	$var_options = get_option('bilnea_settings');
	$var_options['tab'] = 1;
	update_option('bilnea_settings', $var_options);
}


// Página de administración

function b_f_options_page() {

	// Variables globales
	global $b_g_version;

	// Variables locales
	$var_dir = get_template_directory_uri();

	if (isset($_GET['settings-updated'])) {

	?>

	<div id="message" class="updated" style="margin: 20px 20px 0 0;">
		<p>
			<strong><?php _e('Settings saved.') ?></strong>
		</p>
	</div>

	<?php

	}

	?>

	<script type="text/javascript">
		var img_url = '<?php echo $var_dir; ?>/img/icono-imagen.png';
	</script>
	
	<form action="options.php" method="post" id="bilnea">

		<!-- Otras oociones -->
		<input type="hidden" value="<?= b_f_option('b_opt_newsl_list') ?>" name="bilnea_settings[b_opt_newsl_list]" />

		<h2>Opciones del tema</h2>
		<div data-type="settings">

			<!-- Bloque lateral -->
			<aside>
				<h3 <?php if (b_f_option('tab') === null || b_f_option('tab') == 1) { echo 'class="activo"'; }?>>Opciones generales</h3>
				<h3 <?php if (b_f_option('tab') == 2) { echo 'class="activo"'; }?>>Desarrollo</h3>
				<h3 <?php if (b_f_option('tab') == 3) { echo 'class="activo"'; }?>>Buscador</h3>
				<h3 <?php if (b_f_option('tab') == 4) { echo 'class="activo"'; }?>>Servicios externos</h3>
				<h3 <?php if (b_f_option('tab') == 5) { echo 'class="activo"'; }?>>Estilos tipográficos</h3>
				<h3 <?php if (b_f_option('tab') == 6) { echo 'class="activo"'; }?>>Adaptación responsive</h3>
				<h3 <?php if (b_f_option('tab') == 7) { echo 'class="activo"'; }?>>Cabecera y pie de página</h3>
				<h3 <?php if (b_f_option('tab') == 8) { echo 'class="activo"'; }?>>Elementor</h3>
				<h3 <?php if (b_f_option('tab') == 9) { echo 'class="activo"'; }?>>Textos legales</h3>
				<h3 <?php if (b_f_option('tab') == 10) { echo 'class="activo"'; }?>>Redirecciones y SEO</h3>
				<h3 <?php if (b_f_option('tab') == 11) { echo 'class="activo"'; }?>>Copias de seguridad</h3>
				<h3 <?php if (b_f_option('tab') == 12) { echo 'class="activo"'; }?>>Ayuda</h3>
				<h3 <?php if (b_f_option('tab') == 13) { echo 'class="activo"'; }?>>Créditos</h3>
			</aside>

			<!-- Bloque central -->
			<main>

				<!-- Opciones Generales -->
				<div <?php if (b_f_option('tab') === null || b_f_option('tab') == 1) { echo 'class="activo"'; }?> id="tab1">
					<?php include('panel/panel.general.php'); ?>
				</div>

				<!-- Desarrollo -->
				<div <?php if (b_f_option('tab') == 2) { echo 'class="activo"'; }?> id="tab3">
					<?php include('panel/panel.development.php'); ?>
				</div>

				<!-- Buscador -->
				<div <?php if (b_f_option('tab') == 3) { echo 'class="activo"'; }?> id="tab4">
					<?php include('panel/panel.search.php'); ?>
				</div>

				<!-- Servicios externos -->
				<div <?php if (b_f_option('tab') == 4) { echo 'class="activo"'; }?> id="tab5">
					<?php include('panel/panel.services.php'); ?>
				</div>

				<!-- Estilos tipográficos -->
				<div <?php if (b_f_option('tab') == 5) { echo 'class="activo"'; }?> id="tab6">
					<?php include('panel/panel.fonts.php'); ?>
				</div>

				<!-- Adaptación responsive -->
				<div <?php if (b_f_option('tab') == 6) { echo 'class="activo"'; }?> id="tab7">
					<?php include('panel/panel.responsive.php'); ?>
				</div>

				<!-- Cabecera -->
				<div <?php if (b_f_option('tab') == 7) { echo 'class="activo"'; }?> id="tab9">
					<?php include('panel/panel.header-footer.php'); ?>
				</div>

				<!-- Blog -->
				<div <?php if (b_f_option('tab') == 8) { echo 'class="activo"'; }?> id="tab11">
					<?php include('panel/panel.elementor.php'); ?>
				</div>

				<!-- Textos legales -->
				<div <?php if (b_f_option('tab') == 9) { echo 'class="activo"'; } ?> id="tab12">
					<?php include('panel/panel.legal.php'); ?>
				</div>

				<!-- Redirecciones y SEO -->
				<div <?php if (b_f_option('tab') == 10) { echo 'class="activo"'; } ?> id="tab13">
					<?php include('panel/panel.seo.php'); ?>
				</div>

				<!-- Copias de seguridad -->
				<div <?php if (b_f_option('tab') == 11) { echo 'class="activo"'; } ?> id="tab14">
					<?php include('panel/panel.backup.php'); ?>
				</div>

				<!-- Ayuda -->
				<div <?php if (b_f_option('tab') == 12) { echo 'class="activo"'; } ?> id="tab15">
					<?php include('panel/panel.help.php'); ?>
				</div>

				<!-- Créditos -->
				<div <?php if (b_f_option('tab') == 13) { echo 'class="activo"'; } ?> id="tab16">
					<?php include('panel/panel.credits.php'); ?>
				</div>

			</main>
		</div>
		
		<input type="hidden" id="tab" name="bilnea_settings[tab]" value="<?= b_f_option('tab'); ?>">
		
		<?php

		settings_fields('pluginPage');
		do_settings_sections('pluginPage');
		submit_button();

		?>
		
	</form>

	<?php
	
}

?>