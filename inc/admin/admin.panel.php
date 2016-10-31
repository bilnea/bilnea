<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


// Muestreo de fuentes tipográficas

function b_f_fonts($var_font) {

	global $b_g_google_api;

	$var_fonts = json_decode(file_get_contents(('https://www.googleapis.com/webfonts/v1/webfonts?key='.$b_g_google_api)));

	$b_g_google_fonts = array();

	foreach ($var_fonts->items as $font) {
		$var_sizes = $font->variants;
		foreach ($var_sizes as &$temp) {
			if ($temp == 'regular') { $temp = '400'; }
			if ($temp == 'italic') { $temp = '400italic'; }
		}
		$b_g_google_fonts['"'.$font->family.'", '.$font->category] = array(
			'name' => str_replace(' ', '+', $font->family),
			'sizes' => $var_sizes
		);
	}

	?>

	<!-- Selector tipográfico -->
	<div class="font-selector">
		Fuente tipográfica
		<select name="bilnea_settings[b_opt_<?= $var_font ?>_ttf-font]" class="gran font-selector">
			<option disabled="disabled">Seleccionar</option>
			<?php
			
			foreach ($b_g_google_fonts as $key => $value) {
				$var_current_font = b_f_option('b_opt_'.$var_font.'_ttf-font');
				echo '<option value="'.$key.'" '.selected($var_current_font, $key).' data="'.implode(',', $value['sizes']).'">'.str_replace('+', ' ', $value['name']).'</option>';
			}

			?>
		</select>
	</div>

	<!-- Selector tamaño -->
	<div class="font-size-picker">
		Tamaño
		<input type="text" class="sp-input" name="bilnea_settings[b_opt_<?= $var_font ?>_ttf-size]" value="<?= b_f_option('b_opt_'.$var_font.'_ttf-size'); ?>" placeholder="<?= b_f_default('b_opt_'.$var_font.'_ttf-size'); ?>">
	</div>

	<!-- Selector color -->
	<div class="font-color-picker">
		Color
		<input type="text" class="sp-input" name="bilnea_settings[b_opt_<?= $var_font ?>_ttf-color]" value="<?= b_f_option('b_opt_'.$var_font.'_ttf-color'); ?>" placeholder="<?= b_f_default('b_opt_'.$var_font.'_ttf-color'); ?>" />
		<input type="text" class="colora text peq">
	</div>

	<!-- Selector estilo -->
	<div class="font_styles" style="position: relative;">
		<div>Regular<br />Cursiva</div>
		<?php

			$var_weights = array('100','200','300','400','500','600','700','800','900');

			foreach ($var_weights as $var_weight) {

				?>

				<div>
					<input type="radio" value="<?= $var_weight ?>" name="bilnea_settings[b_opt_<?= $var_font ?>_ttf-style]" <?php checked(b_f_option('b_opt_'.$var_font.'_ttf-style'), $var_weight); ?> />
					<br />
					<input type="radio" value="<?= $var_weight ?>italic" name="bilnea_settings[b_opt_<?= $var_font ?>_ttf-style]" <?php checked(b_f_option('b_opt_'.$var_font.'_ttf-style'), $var_weight.'italic'); ?> />
				</div>

				<?php

			}

		?>

		<div class="notice font">
			<span style="font-family: 'Roboto'; font-weight: 100;">a</span> ... <span style="font-family: 'Roboto'; font-weight: 900;">a</span>
			<br />
			<span style="font-family: 'Roboto'; font-weight: 100; font-style: italic;">a</span> ... <span style="font-family: 'Roboto'; font-weight: 900; font-style: italic;">a</span>
		</div>

		<div class="font-uppercase">
			<input style="float: left; margin-top: 6px;" type="checkbox" name="bilnea_settings[b_opt_<?= $var_font ?>_ttf-uppercase]" <?php checked(b_f_option('b_opt_'.$var_font.'_ttf-uppercase'), 1); ?> value="1">Mayúsculas
			<br />
			<input style="float: left; margin-top: 6px;" type="checkbox" name="bilnea_settings[b_opt_<?= $var_font ?>_ttf-underline]" <?php checked(b_f_option('b_opt_'.$var_font.'_ttf-underline'), 1); ?> value="1">Subrayado
		</div>

	</div>
	<?php
}

if (strpos($_SERVER['HTTP_REFERER'], 'page=bilnea') === false) {
	$var_options = get_option('bilnea_settings');
	$var_options['tab'] = 1;
	update_option('bilnea_settings', $var_options);
}


// Creamos la página de administración

function b_f_options_page() {

	// Variables globales
	global $b_g_version;

	// Variables locales
	$var_dir = get_template_directory_uri();

	?>

	<script type="text/javascript">
		var img_url = '<?php echo $var_dir; ?>/img/icono-imagen.png';
	</script>
	
	<form action="options.php" method="post" id="bilnea">

		<!-- Otras oociones -->
		<input type="hidden" value="<?= b_f_option('b_opt_newsl_list') ?>" name="bilnea_settings[b_opt_newsl_list]" />

		<h2>Opciones del tema</h2>
		<div id="bilset">

			<!-- Bloque lateral -->
			<div class="lateral">
				<h3 <?php if (b_f_option('tab') === null || b_f_option('tab') == 1) { echo 'class="active"'; }?>>Opciones Generales</h3>
				<h3 <?php if (b_f_option('tab') == 2) { echo 'class="active"'; }?>>Desarrollo</h3>
				<h3 <?php if (b_f_option('tab') == 3) { echo 'class="active"'; }?>>Estilos tipográficos</h3>
				<h3 <?php if (b_f_option('tab') == 4) { echo 'class="active"'; }?>>Adaptación responsive</h3>
				<h3 <?php if (b_f_option('tab') == 5) { echo 'class="active"'; }?>>Logotipo e iconos</h3>
				<h3 <?php if (b_f_option('tab') == 6) { echo 'class="active"'; }?>>Cabecera</h3>
				<h3 <?php if (b_f_option('tab') == 7) { echo 'class="active"'; }?>>Pie de página</h3>
				<h3 <?php if (b_f_option('tab') == 8) { echo 'class="active"'; }?>>Blog</h3>
				<?php
				if (function_exists('icl_object_id')) {
				?>
				<h3 <?php if (b_f_option('tab') == 9) { echo 'class="active"'; }?>>Multidioma</h3>
				<?php
				}
				?>
				<h3 <?php if (b_f_option('tab') == 10) { echo 'class="active"'; }?>>Textos legales</h3>
				<h3 <?php if (b_f_option('tab') == 11) { echo 'class="active"'; }?>>Redirecciones y SEO</h3>
			</div>

			<!-- Bloque central -->
			<div class="central">

				<!-- Opciones Generales -->
				<div <?php if (!isset($opt['tab']) || $opt['tab'] == 1) { echo 'class="active"'; }?> id="tab1">
					
					<?php include('panel/panel.general.php'); ?>

				</div>

				<!-- Opciones Generales -->
				<div <?php if ($opt['tab'] == 2) { echo 'class="active"'; }?> id="tab2">
					
					<?php include('panel/panel.development.php'); ?>

				</div>

				<!-- Estilos tipográficos -->
				<div <?php if ($opt['tab'] == 3) { echo 'class="activo"'; }?> id="tab3">
					<h4>Texto plano</h4>

					<!-- Texto plano -->
					<div class="text-container">
						<?php b_f_fonts('text'); ?>
					</div>
					<hr />

					<!-- Negrita -->
					<div class="text-container">
						<strong>Negrita</strong>
						<?php b_f_fonts('bold'); ?>
					</div>
					<hr />

					<!-- Enlaces -->
					<div class="text-container">
						<strong>Enlaces</strong>
						<?php b_f_fonts('link'); ?>
					</div>
					<hr />

					<!-- Enlaces activos -->
					<div class="text-container">
						<strong>Enlaces activos</strong>
						<?php b_f_fonts('hover'); ?>
					</div>

					<br /><br />

					<h4>Encabezados</h4>

					<!-- H1 -->
					<div class="text-container">
						<strong>H1 Encabezado</strong>
						<?php b_f_fonts('h1'); ?>
					</div>
					<hr />

					<!-- H2 -->
					<div class="text-container">
						<strong>H2 Encabezado</strong>
						<?php b_f_fonts('h2'); ?>
					</div>
					<hr />

					<!-- H3 -->
					<div class="text-container">
						<strong>H3 Encabezado</strong>
						<?php b_f_fonts('h3'); ?>
					</div>
					<hr />

					<!-- H4 -->
					<div class="text-container">
						<strong>H4 Encabezado</strong>
						<?php b_f_fonts('h4'); ?>
					</div>
					<hr />

					<!-- H5 -->
					<div class="text-container">
						<strong>H5 Encabezado</strong>
						<?php b_f_fonts('h5'); ?>
					</div>
					<hr />

					<!-- H6 -->
					<div class="text-container">
						<strong>H6 Encabezado</strong>
						<?php b_f_fonts('h6'); ?>
					</div>

					<br /><br />

					<h4>Estilos tipográficos extra</h4>

					<?php
					$fnt = [];
					$opt = get_option('bilnea_settings');
					foreach ($opt as $oti => $val) {
						if (strpos($oti, 'ttf-font') !== false) {
							$tmp = str_replace('b_opt_', '', explode('ttf-', $oti)[0]);
							$siz = $opt['b_opt_'.$tmp.'ttf-style'];
							if (!isset($fnt[$val])) {
								$fnt[$val] = array($siz);
							} else {
								if (!in_array($siz, $fnt[$val])) {
									array_push($fnt[$val], $siz);
								}
							}
						}
					}

					$idx = 0;

					foreach ($fnt as $key => $value) {
						global $b_g_google_fonts;
						if ($idx > 0) {
							echo '<hr />';
						}
						$idx++;
					?>
					<fieldset class="text-container">
						<strong><?php echo str_replace('+', ' ', $b_g_google_fonts[$key]['name']); ?></strong>
						<div class="font_styles" style="position: relative;">
							<div>Regular<br />Cursiva</div>
								<?php
								if ($opt['b_opt_custom-font'] == null) {
									$opt['b_opt_custom-font'] = array();
								}
								for ($i = 1; $i < 10; $i++) {
									$j = $i*100;
									$dsb = ''; $ckc = '';
									if (!in_array($j, $b_g_google_fonts[$key]['sizes'])) {
										$dsb = ' disabled';
									}
									if (in_array($j, $value)) {
										$ckc = ' checked';
									}
								?>
								<div>
								<input type="checkbox" value="<?= $b_g_google_fonts[$key]['name'].'|'.$j ?>"<?= $dsb ?><?= $ckc ?> <?php checked(in_array($b_g_google_fonts[$key]['name'].'|'.$j, $opt['b_opt_custom-font'])); ?> name="bilnea_settings[b_opt_custom-font][]"><br />
								<?php
									$j = $j.'italic';
									$dsb = ''; $ckc = '';
									if (!in_array($j, $b_g_google_fonts[$key]['sizes'])) {
										$dsb = ' disabled';
									}
									if (in_array($j, $value)) {
										$ckc = ' checked';
									}
								?>
								<input type="checkbox" value="<?= $b_g_google_fonts[$key]['name'].'|'.$j ?>"<?= $dsb ?><?= $ckc ?> <?php checked(in_array($b_g_google_fonts[$key]['name'].'|'.$j, $opt['b_opt_custom-font'])); ?> name="bilnea_settings[b_opt_custom-font][]">
								</div>
							<?php
							}
							?>
							<div class="notice font"><span style="font-family: 'Roboto'; font-weight: 100;">a</span> ... <span style="font-family: 'Roboto'; font-weight: 900;">a</span><br /><span style="font-family: 'Roboto'; font-weight: 100; font-style: italic;">a</span> ... <span style="font-family: 'Roboto'; font-weight: 900; font-style: italic;">a</span></div>
							<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=<?php echo $b_g_google_fonts[$key]['name']; ?>">
							<div style="vertical-align: top; font-size: 30px; display: inline-block; line-height: 52px; width: 170px; font-family: '<?php echo str_replace('+', ' ', $b_g_google_fonts[$key]['name']); ?>';">AaBbCc</div>
						</div>
					</fieldset>
					<?php
					}
					?>

				</div>

				<!-- Adaptación responsive -->
				<div <?php if ($opt['tab'] == 4) { echo 'class="activo"'; }?> id="tab4">
					<h4>Menú responsive</h4>
					<label for="mobile_menu_opt1"><img src="<?php echo get_template_directory_uri().'/img/menu_movil_1.jpg'; ?>" class="icon big" /></label>
					<label for="mobile_menu_opt2"><img src="<?php echo get_template_directory_uri().'/img/menu_movil_2.jpg'; ?>" class="icon big" /></label>
					<label for="mobile_menu_opt3"><img src="<?php echo get_template_directory_uri().'/img/menu_movil_3.jpg'; ?>" class="icon big" style="margin-right: 0;" /></label>
					<br />
					<div style="width: 174px; display: inline-block;">
						<input type='radio' name='bilnea_settings[b_opt_mobile-menu]' <?php checked($opt['b_opt_mobile-menu'], 1); checked($opt['b_opt_mobile-menu'], 1); ?> value='1' id="mobile_menu_opt1">Menú selector
					</div>
					<div style="width: 174px; display: inline-block;">
						<input type='radio' name='bilnea_settings[b_opt_mobile-menu]' <?php checked($opt['b_opt_mobile-menu'], 2); checked($opt['b_opt_mobile-menu'], 2); ?> value='2' id="mobile_menu_opt2">Menú cortina
					</div>
					<div style="display: inline-block;">
						<input type='radio' name='bilnea_settings[b_opt_mobile-menu]' <?php checked($opt['b_opt_mobile-menu'], 3); checked($opt['b_opt_mobile-menu'], 3); ?> value='3' id="mobile_menu_opt3">Menú deslizante
					</div>
					<hr>
					<div style="width: 414px; margin-bottom: 16px; display: inline-block;">Dimensión de activación responsive</div>
					<input style="text-align: right;" type='text' class="peq" name='bilnea_settings[b_opt_responsive]' value='<?php echo $opt['b_opt_responsive']; ?>' placeholder="<?= b_f_default()['b_opt_responsive']; ?>">
					<br />
					<h4>Diseño</h4>
					<label for='bilnea_settings[b_opt_mobile-margin]'>Márgen lateral (px o %)</label>
					<input type='text' class="peq" name='bilnea_settings[b_opt_mobile-margin]' value='<?php echo $opt['b_opt_mobile-margin']; ?>' style="position: absolute; right: 0;">
					<br />
					<label for='bilnea_settings[b_opt_mobile-htext]'>Tamaño encabezado respecto a su dimensión natural, en %</label>
					<input type='text' class="peq" name='bilnea_settings[b_opt_mobile-htext]' value='<?php echo $opt['b_opt_mobile-htext']; ?>' style="position: absolute; right: 0;">
					<br />
					<label for='bilnea_settings[b_opt_mobile-text]'>Tamaño texto corrido respecto a su dimensión natural, en %</label>
					<input type='text' class="peq" name='bilnea_settings[b_opt_mobile-text]' value='<?php echo $opt['b_opt_mobile-text']; ?>' style="position: absolute; right: 0;">
					<hr style="margin-bottom: 0;" />
					<input type='checkbox' name='bilnea_settings[b_opt_mobile-sidebar]' <?php checked( $opt['b_opt_mobile-sidebar'], 1 ); ?> value='1'>
					<label for='bilnea_settings[b_opt_mobile-sidebar]'>Ocultar la barra lateral</label>
					<hr style="margin: 0;" />
					<input type='checkbox' name='bilnea_settings[b_opt_mobile-search]' <?php checked( $opt['b_opt_mobile-search'], 1 ); ?> value='1'>
					<label for='bilnea_settings[b_opt_mobile-search]'>Mostrar buscador en menú móvil</label>
					<br />
					<input type='checkbox' name='bilnea_settings[b_opt_tablet-search]' <?php checked( $opt['b_opt_tablet-search'], 1 ); ?> value='1'>
					<label for='bilnea_settings[b_opt_tablet-search]'>Mostrar buscador en cabecera para tablets</label>
				</div>

				<!-- Logotipo e iconos -->
				<div <?php if ($opt['tab'] == 5) { echo 'class="activo"'; }?> id="tab5">
					<h4>Logotipo principal</h4>
					<?php
					if (!isset($opt['b_opt_main-logo'])) :
					?>
					<div style="position: relative; margin-bottom: 10px;">
						<script type="text/javascript">
							jQuery(function() {
								jQuery('#borra_logo').parent().show();
							})
						</script>
						<div id="logo_principal" style="background-image: url(<?= b_f_default()['b_opt_main-logo']; ?>);"></div>
						<div>
							<i class="fa fa-trash" id="borra_logo"></i>
						</div>
						<div style="display: block;">
							<input type="text" id="logo_url" class="gran" name='bilnea_settings[b_opt_main-logo]' style="width: calc(100% - 32px);" value='<?= b_f_default()['b_opt_main-logo']; ?>'>
							<button type="submit" id="subir_imagen" value="Seleccionar imagen"  class="button-secondary subir-imagen">
								<i class="fa fa-search" style="font-size: 15px;"></i>
							</button>
						</div>
					</div>
					<?php
					else :
					?>
					<div style="position: relative; margin-bottom: 10px;">
						<?php
						if ($opt['b_opt_main-logo']) {
						?>
						<script type="text/javascript">
							jQuery(function() {
								jQuery('#borra_logo').parent().show();
							})
						</script>
						<div id="logo_principal" style="background-image: url(<?php echo $opt['b_opt_main-logo']; ?>);"></div>
						<?php
						} else {
						?>
						<div id="logo_principal" style="background-image: url(<?php echo $bil; ?>/img/icono-imagen.png);"></div>
						<?php
						}
						?>
						<div>
							<i class="fa fa-trash" id="borra_logo"></i>
						</div>
						<div style="display: block;">
							<input type="text" id="logo_url" class="gran" name='bilnea_settings[b_opt_main-logo]' style="width: calc(100% - 32px);" value='<?php echo $opt['b_opt_main-logo']; ?>'>
							<button type="submit" id="subir_imagen" value="Seleccionar imagen"  class="button-secondary subir-imagen">
								<i class="fa fa-search" style="font-size: 15px;"></i>
							</button>
						</div>
					</div>
					<?php
					endif;
					?>
					<h4>Favicon</h4>
					<div>
						<div class="favicon iconico" id="favicon_div"></div>
						<div>
							<i class="fa fa-trash" id="borra_logo1"></i>Icono genérico
							<br />
							<?php
							if ($opt['b_opt_favicon']) {
							?>
							<script type="text/javascript">
								jQuery('#favicon_div').attr('style', 'background-image: url(<?php echo $opt['b_opt_favicon']; ?>)');
								jQuery('#borra_logo1').show();
							</script>
							<?php
							}
							?>
							<input type="text" id="fav_main_url" class="gran" name="bilnea_settings[b_opt_favicon]" style="width: calc(100% - 32px);" value='<?php echo $opt['b_opt_favicon']; ?>'>
							<button type="submit" id="subir_fav_main" value="Seleccionar imagen"  class="button-secondary subir-imagen">
								<i class="fa fa-search" style="font-size: 15px;"></i>
							</button>
						</div>
					</div>
					<hr />
					<div>
						<div class="favicon iconico" id="iphone_div"></div>
						<div>
							<i class="fa fa-trash" id="borra_logo2"></i>Icono iPhone
							<br />
							<?php
							if ($opt['b_opt_favicon-iphone']) {
							?>
							<script type="text/javascript">
								jQuery('#iphone_div').attr('style', 'background-image: url(<?php echo $opt['b_opt_favicon-iphone']; ?>)');
								jQuery('#borra_logo2').show();
							</script>
							<?php
							}
							?>
							<input type="text" id="iph_fav_url" class="gran" name="bilnea_settings[b_opt_favicon-iphone]" style="width: calc(100% - 32px);" value='<?php echo $opt['b_opt_favicon-iphone']; ?>'>
							<button type="submit" id="subir_iph_fav" value="Seleccionar imagen"  class="button-secondary subir-imagen">
								<i class="fa fa-search" style="font-size: 15px;"></i>
							</button>
						</div>
					</div>
					<hr />
					<div>
						<div class="favicon iconico" id="iphoneret_div"></div>
						<div>
							<i class="fa fa-trash" id="borra_logo3"></i>Icono iPhone Retina
							<br />
							<?php
							if ($opt['b_opt_favicon-iphone-retina']) {
							?>
							<script type="text/javascript">
								jQuery('#iphoneret_div').attr('style', 'background-image: url(<?php echo $opt['b_opt_favicon-iphone-retina']; ?>)');
								jQuery('#borra_logo3').show();
							</script>
							<?php
							}
							?>
							<input type="text" id="iph_ret_url" class="gran" name="bilnea_settings[b_opt_favicon-iphone-retina]" style="width: calc(100% - 32px);" value='<?php echo $opt['b_opt_favicon-iphone-retina']; ?>'>
							<button type="submit" id="subir_iph_ret" value="Seleccionar imagen"  class="button-secondary subir-imagen">
								<i class="fa fa-search" style="font-size: 15px;"></i>
							</button>
						</div>
					</div>
					<hr />
					<div>
						<div class="favicon iconico" id="ipad_div"></div>
						<div>
							<i class="fa fa-trash" id="borra_logo4"></i>Icono iPad
							<br />
							<?php
							if ($opt['b_opt_favicon-ipad']) {
							?>
							<script type="text/javascript">
								jQuery('#ipad_div').attr('style', 'background-image: url(<?php echo $opt['b_opt_favicon-ipad']; ?>)');
								jQuery('#borra_logo4').show();
							</script>
							<?php
							}
							?>
							<input type="text" id="ipa_fav_url" class="gran" name="bilnea_settings[b_opt_favicon-ipad]" style="width: calc(100% - 32px);" value='<?php echo $opt['b_opt_favicon-ipad']; ?>'>
							<button type="submit" id="subir_ipa_fav" value="Seleccionar imagen"  class="button-secondary subir-imagen">
								<i class="fa fa-search" style="font-size: 15px;"></i>
							</button>
						</div>
					</div>
					<hr />
					<div>
						<div class="favicon iconico" id="ipadret_div"></div>
						<div>
							<i class="fa fa-trash" id="borra_logo5"></i>Icono iPad Retina
							<br />
							<?php
							if ($opt['b_opt_favicon-ipad-retina']) {
							?>
							<script type="text/javascript">
								jQuery('#ipadret_div').attr('style', 'background-image: url(<?php echo $opt['b_opt_favicon-ipad-retina']; ?>)');
								jQuery('#borra_logo5').show();
							</script>
							<?php
							}
							?>
							<input type="text" id="ipa_ret_url" class="gran" name="bilnea_settings[b_opt_favicon-ipad-retina]" style="width: calc(100% - 32px);" value='<?php echo $opt['b_opt_favicon-ipad-retina']; ?>'>
							<button type="submit" id="subir_ipa_ret" value="Seleccionar imagen"  class="button-secondary subir-imagen">
								<i class="fa fa-search" style="font-size: 15px;"></i>
							</button>
						</div>
					</div>
					<h4 style="margin-top: 10px;">Variantes del logotipo</h4>
					<div>
						<div class="favicon iconico" id="positive_div"></div>
						<div>
							<i class="fa fa-trash" id="borra_logo6"></i>Positivo
							<br />
							<?php
							if ($opt['b_opt_positive-logo']) {
							?>
							<script type="text/javascript">
								jQuery('#positive_div').attr('style', 'background-image: url(<?php echo $opt['b_opt_positive-logo']; ?>)');
								jQuery('#borra_logo6').show();
							</script>
							<?php
							}
							?>
							<input type="text" id="pos_logo_url" class="gran" name="bilnea_settings[b_opt_positive-logo]" style="width: calc(100% - 32px);" value='<?php echo $opt['b_opt_positive-logo']; ?>'>
							<button type="submit" id="subir_pos_log" value="Seleccionar imagen"  class="button-secondary subir-imagen">
								<i class="fa fa-search" style="font-size: 15px;"></i>
							</button>
						</div>
					</div>
					<hr />
					<div>
						<div class="favicon iconico" id="negative_div"></div>
						<div>
							<i class="fa fa-trash" id="borra_logo7"></i>Negativo
							<br />
							<?php
							if ($opt['b_opt_negative-logo']) {
							?>
							<script type="text/javascript">
								jQuery('#negative_div').attr('style', 'background-image: url(<?php echo $opt['b_opt_negative-logo']; ?>)');
								jQuery('#borra_logo7').show();
							</script>
							<?php
							}
							?>
							<input type="text" id="neg_logo_url" class="gran" name="bilnea_settings[b_opt_negative-logo]" style="width: calc(100% - 32px);" value='<?php echo $opt['b_opt_negative-logo']; ?>'>
							<button type="submit" id="subir_neg_log" value="Seleccionar imagen"  class="button-secondary subir-imagen">
								<i class="fa fa-search" style="font-size: 15px;"></i>
							</button>
						</div>
					</div>
				</div>

				<!-- Cabecera -->
				<div <?php if ($opt['tab'] == 6) { echo 'class="activo"'; }?> id="tab6">
					<h4>Depurar el código</h4>
					<input type='checkbox' name='bilnea_settings[b_opt_header-version]' <?php checked( $opt['b_opt_header-version'], 1 ); ?> value='1'>
					<label for='bilnea_settings[b_opt_header-version]'>Eliminar versión de WordPress</label>
					<br />
					<input type='checkbox' name='bilnea_settings[b_opt_header-rss]' <?php checked( $opt['b_opt_header-rss'], 1 ); ?> value='1'>
					<label for='bilnea_settings[b_opt_header-rss]'>Eliminar registros RSS</label>
					<br />
					<input type='checkbox' name='bilnea_settings[b_opt_header-links]' <?php checked( $opt['b_opt_header-links'], 1 ); ?> value='1'>
					<label for='bilnea_settings[b_opt_header-links]'>Eliminar enlaces a entradas siguiente, anterior y superior</label>
					<br /><br />
					<h4>Estructuración</h4>
					<div style="width: 50%; display: inline-block;">
						Ancho de la cabecera
					</div>
					<div style="width: 49%; display: inline-block;">
						Ancho del menú
					</div>
					<div style="width: 48%; margin-right: 2%; border-right: 1px solid #e1e1e1; display: inline-block;">
						<input type='radio' name='bilnea_settings[b_opt_header-width]' <?php checked( $opt['b_opt_header-width'], 1 ); ?> value='1'><span>Ancho completo</span>
						<br />
						<input type='radio' name='bilnea_settings[b_opt_header-width]' <?php checked( $opt['b_opt_header-width'], 2 ); ?> value='2'><span>Encajonado</span>
					</div>
					<div style="width: 49%; display: inline-block;">
						<input type='radio' name='bilnea_settings[b_opt_menu-width]' <?php checked( $opt['b_opt_menu-width'], 1 ); ?> value='1'><span>Ancho completo</span>
						<br />
						<input type='radio' name='bilnea_settings[b_opt_menu-width]' <?php checked( $opt['b_opt_menu-width'], 2 ); ?> value='2'><span>Encajonado</span>
					</div>
					<em class="notice header_notice" style="font-size: 11px; line-height: 15px;">
						Con contenido encajonado definido como opción general, estas opciones están deshabilitadas. Para activarlas, desactiva el contenido encajonado de toda la página.
					</em>
					<hr />
					<select name='bilnea_settings[header_menu]' class="gran" style="margin-top: -4px; width: 100%; margin-bottom: 0;">
						<option value='1' <?php selected( $opt['header_menu'], 1 ); ?>>Logotipo encima del menú</option>
						<option value='2' <?php selected( $opt['header_menu'], 2 ); ?>>Logotipo en línea con el menú</option>
					</select>
					<hr />
					<div style="width: 50%; display: inline-block;">
						Alineación del menú
					</div>
					<div style="width: 49%; display: inline-block;">
						Alineación del logotipo
					</div>
					<div style="width: 48%; margin-right: 2%; border-right: 1px solid #e1e1e1; display: inline-block;">
						<input type='radio' name='bilnea_settings[b_opt_menu-align]' <?php checked( $opt['b_opt_menu-align'], 1 ); ?> value='1'><span>Menú alineado a la izquierda</span>
						<br />
						<input type='radio' name='bilnea_settings[b_opt_menu-align]' <?php checked( $opt['b_opt_menu-align'], 2 ); ?> value='2'><span>Menú alineado al centro</span>
						<br />
						<input type='radio' name='bilnea_settings[b_opt_menu-align]' <?php checked( $opt['b_opt_menu-align'], 3 ); ?> value='3'><span>Menú alineado a la derecha</span>
					</div>
					<div style="width: 49%; display: inline-block;">
						<input type='radio' name='bilnea_settings[b_opt_header-logo-align]' <?php checked( $opt['b_opt_header-logo-align'], 1 ); ?> value='1'><span>Logotipo alineado a la izquierda</span>
						<br />
						<input type='radio' name='bilnea_settings[b_opt_header-logo-align]' <?php checked( $opt['b_opt_header-logo-align'], 2 ); ?> value='2'><span>Logotipo alineado al centro</span>
						<br />
						<input type='radio' name='bilnea_settings[b_opt_header-logo-align]' <?php checked( $opt['b_opt_header-logo-align'], 3 ); ?> value='3'><span>Logotipo alineado a la derecha</span>
					</div>
					<hr />
					<div style="width: 100%; display: inline-block;">
						<input type='checkbox' name='bilnea_settings[b_opt_sticky-menu]' <?php checked( $opt['b_opt_sticky-menu'], 1 ); ?> value='1' />
						<label for='bilnea_settings[b_opt_sticky-menu]'>Cabecera fija en pantalla</label>
					</div>
					<div style="width: 100%; display: inline-block;">
						<input type='checkbox' name='bilnea_settings[b_opt_sticky-menu-animated]' <?php checked( $opt['b_opt_sticky-menu-animated'], 1 ); ?> value='1' />
						<label for='bilnea_settings[b_opt_sticky-menu-animated]'>Ocultar automáticamente</label>
					</div>
					<br />
					<h4 style="margin-top: 10px;">Elementos extra</h4>
					<div style="width: 48%; display: inline-block;">
						<input type='checkbox' name='bilnea_settings[b_opt_header-search]' <?php checked( $opt['b_opt_header-search'], 1 ); ?> value='1'  />
						<label for='bilnea_settings[b_opt_header-search]'>Mostrar buscador en la cabecera</label>
					</div>
					<div style="width: 49%; display: inline-block;">
						<input type='checkbox' name='bilnea_settings[b_opt_rrss-header]' <?php checked( $opt['b_opt_rrss-header'], 1 ); ?> value='1' />
						<label for='bilnea_settings[b_opt_rrss-header]'>Mostrar redes sociales en la cabecera</label>
					</div>
					<div style="width: 46%; margin-right: 2%; border-right: 1px solid #e1e1e1; display: inline-block;" class="child">
						<input type='radio' name='bilnea_settings[b_opt_header-search-location]' <?php checked( $opt['b_opt_header-search-location'], 1 ); ?> value='1'><span>En el bloque superior</span>
						<br />
						<input type='radio' name='bilnea_settings[b_opt_header-search-location]' <?php checked( $opt['b_opt_header-search-location'], 2 ); ?> value='2'><span>En la barra del menú</span>
					</div>
					<div style="width: 49%; display: inline-block;" class="child">
						<input type='radio' name='bilnea_settings[b_opt_rrss-header-location]' <?php checked( $opt['b_opt_rrss-header-location'], 1 ); ?> value='1'><span>En el bloque superior</span>
						<br />
						<input type='radio' name='bilnea_settings[b_opt_rrss-header-location]' <?php checked( $opt['b_opt_rrss-header-location'], 2 ); ?> value='2'><span>En la barra del menú</span>
					</div>
					<hr />
					<input type='checkbox' name='bilnea_settings[b_opt_top-bar]' <?php checked( $opt['b_opt_top-bar'], 1 ); ?> value='1'> Mostrar barra superior
					<br />
					<input type='checkbox' name='bilnea_settings[b_opt_menu-top-bar]' <?php checked( $opt['b_opt_menu-top-bar'], 1 ); ?> value='1'> <span>Incluir menú en barra superior</span>
					<br />
					<input type='checkbox' name='bilnea_settings[b_opt_topbar-rss]' <?php checked( $opt['b_opt_topbar-rss'], 1 ); ?> value='1'> <span>Incluir iconos redes sociales</span>
					<hr />
					Estilo de los iconos de las redes sociales para la cabecera
					<br />
					<input type='radio' name='bilnea_settings[b_opt_header-rrss-icons]' <?php checked( $opt['b_opt_header-rrss-icons'], 1 ); ?> value='1'>Iconos normales, sin fondo.
					<br />
					<input type='radio' name='bilnea_settings[b_opt_header-rrss-icons]' <?php checked( $opt['b_opt_header-rrss-icons'], 2 ); ?> value='2'>Iconos sobre fondo cuadrado.
					<br />
					<h4 style="margin-top: 10px;">Barra superior</h4>
					<div class="text-container">
						<?php b_f_fonts('top-bar'); ?>
					</div>
					<br />
					<h4 style="margin-top: 10px;">Menú principal</h4>
					<div class="text-container">
						<?php b_f_fonts('main-menu'); ?>
					</div>
					<br />
					<h4 style="margin-top: 10px;">Submenú</h4>
					<div class="text-container">
						<?php b_f_fonts('sub-menu'); ?>
					</div>
				</div>

				<!-- Pie de página -->
				<div <?php if ($opt['tab'] == 7) { echo 'class="activo"'; }?> id="cent3">
					<h4>Footer</h4>
					<input type='checkbox' name='bilnea_settings[footer_show]' <?php checked( $opt['footer_show'], 1 ); ?> value='1'>
					<label for='bilnea_settings[footer_show]'>Mostrar el 'footer'</label>
					<br />
					Distribución del 'footer'
					<select name='bilnea_settings[b_opt_footer-menu]' class="gran" style="margin-top: -2px; width: 100%;">
						<option value='1' <?php selected( $opt['b_opt_footer-menu'], 1 ); ?>>Una columna</option>
						<option value='2' <?php selected( $opt['b_opt_footer-menu'], 2 ); ?>>Dos columnas</option>
						<option value='3' <?php selected( $opt['b_opt_footer-menu'], 3 ); ?>>Tres columnas</option>
						<option value='4' <?php selected( $opt['b_opt_footer-menu'], 4 ); ?>>Cuatro columnas</option>
						<option value='5' <?php selected( $opt['b_opt_footer-menu'], 5 ); ?>>Cinco columnas</option>
					</select>
					<br />
					<h4 style="margin-top: 10px;">Socket</h4>
					<input type='checkbox' name='bilnea_settings[socket_show]' <?php checked( $opt['socket_show'], 1 ); ?> value='1'>
					<label for='bilnea_settings[socket_show]'>Mostrar el 'socket'</label>
					<br />
					<input type='checkbox' name='bilnea_settings[socket_copy]' <?php checked( $opt['socket_copy'], 1 ); ?> value='1'>
					<label for='bilnea_settings[socket_copy]'>Mostrar copyright</label>
					<hr style="margin-bottom: 0;" />
					Ocultar el mensaje "Desarrollo web por bilnea".
					<br>
					<input type="password" class="gran" style="width: 100%;" placeholder="Introduce el código de desbloqueo" name="bilnea_settings[socket_no-development]" value="<?php echo $opt['socket_no-development']; ?>" />
					<br />
					<h4 style="margin-top: 10px;">Estructuración</h4>
					<div style="width: 50%; display: inline-block;">
						Ancho del pie de página
					</div>
					<div style="width: 49%; display: inline-block;">
						Ancho del 'socket'
					</div>
					<div style="width: 48%; margin-right: 2%; border-right: 1px solid #e1e1e1; display: inline-block;">
						<input type='radio' name='bilnea_settings[footer_width]' <?php checked( $opt['footer_width'], 1 ); ?> value='1'><span>Ancho completo</span>
						<br />
						<input type='radio' name='bilnea_settings[footer_width]' <?php checked( $opt['footer_width'], 2 ); ?> value='2'><span>Encajonado</span>
					</div>
					<div style="width: 49%; display: inline-block;">
						<input type='radio' name='bilnea_settings[socket_width]' <?php checked( $opt['socket_width'], 1 ); ?> value='1'><span>Ancho completo</span>
						<br />
						<input type='radio' name='bilnea_settings[socket_width]' <?php checked( $opt['socket_width'], 2 ); ?> value='2'><span>Encajonado</span>
					</div>
					<em class="notice header_notice" style="font-size: 11px; line-height: 15px;">
						Con contenido encajonado definido como opción general, estas opciones están deshabilitadas. Para activarlas, desactiva el contenido encajonado de toda la página.
					</em>
					
					<br />

					<h4 style="margin-top: 10px;">Tipografía pie de página</h4>
					<div class="text-container">
						<strong>Encabezado pie de página</strong>
						<?php b_f_fonts('footer-title'); ?>
					</div>
					<hr />
					<div class="text-container">
						<strong>Texto pie de página</strong>
						<?php b_f_fonts('footer'); ?>
					</div>
					<hr />
					<div class="text-container">
						<strong>Enlace pie de página</strong>
						<?php b_f_fonts('footer-link'); ?>
					</div>
					<hr />
					<div class="text-container">
						<strong>Enlace activo pie de página</strong>
						<?php b_f_fonts('footer-hover'); ?>
					</div>

					<br />

					<h4 style="margin-top: 10px;">Tipografía socket</h4>
					<div class="text-container">
						<strong>Texto pie de página</strong>
						<?php b_f_fonts('socket'); ?>
					</div>
					<hr />
					<div class="text-container">
						<strong>Enlace pie de página</strong>
						<?php b_f_fonts('socket-link'); ?>
					</div>
					<hr />
					<div class="text-container">
						<strong>Enlace activo pie de página</strong>
						<?php b_f_fonts('socket-hover'); ?>
					</div>

				</div>

				<!-- Blog -->
				<div id="tab7" <?php if ($opt['tab'] == 8) { echo 'class="activo"'; }?>>
					<h4>Formato blog</h4>
					<label for="blog_opt1"><img src="<?php echo get_template_directory_uri().'/img/bilnea-blog-1.jpg'; ?>" class="icon big" /></label>
					<label for="blog_opt2"><img src="<?php echo get_template_directory_uri().'/img/bilnea-blog-2.jpg'; ?>" class="icon big" /></label>
					<label for="blog_opt3"><img src="<?php echo get_template_directory_uri().'/img/bilnea-blog-3.jpg'; ?>" class="icon big" style="margin-right: 0;" /></label>
					<br />
					<div style="width: 174px; display: inline-block;">
						<input type='radio' name='bilnea_settings[b_opt_blog]' <?php checked($opt['b_opt_blog'], 1); checked($opt['b_opt_blog'], 1); ?> value='1' id="blog_opt1">Imagen como fondo
					</div>
					<div style="width: 174px; display: inline-block;">
						<input type='radio' name='bilnea_settings[b_opt_blog]' <?php checked($opt['b_opt_blog'], 2); checked($opt['b_opt_blog'], 2); ?> value='2' id="blog_opt2">Imagen grande
					</div>
					<div style="display: inline-block;">
						<input type='radio' name='bilnea_settings[b_opt_blog]' <?php checked($opt['b_opt_blog'], 3); checked($opt['b_opt_blog'], 3); ?> value='3' id="blog_opt3">Imagen pequeña
					</div>
					<hr>

					<div style="width: 314px; display: inline-block;">Número de entradas a mostrar por página</div>
					<input style="text-align: right; width: 200px;" type='text' class="peq" name='bilnea_settings[b_opt_blog-number]' value='<?php echo $opt['b_opt_blog-number']; ?>' placeholder="<?= b_f_default()['b_opt_blog-number']; ?>">
					<br />
					<div style="width: 314px; display: inline-block;">Ordenar entradas</div>
					<select name="bilnea_settings[b_opt_blog-order]" class="gran" style="margin-top: -2px; width: 200px;">
						<option value="random" <?php selected( $opt['b_opt_blog-order'], 'random' ); ?>>Orden aleatorio</option>
						<option value="title" <?php selected( $opt['b_opt_blog-order'], 'title' ); ?>>Ordenar por título</option>
						<option selected value="date" <?php selected( $opt['b_opt_blog-order'], 'date' ); ?>>Ordenar por fecha</option>
						<option value="author" <?php selected( $opt['b_opt_blog-order'], 'author' ); ?>>Ordenar por autor</option>
					</select>
					<input type='checkbox' name='bilnea_settings[b_opt_blog-order-desc]' <?php checked( $opt['b_opt_blog-order-desc'], 1 ); ?> value='1'> <span>Invertir orden</span>
					<hr />
					<div style="width: 50%; display: inline-block;">
						Meta información encima del título
						<br />
						<div style="width: 24px; display: inline-block;"># 1</div>
						<select name='bilnea_settings[b_opt_blog-position-1-1]' class="gran" style="margin-top: -2px; width: calc(100% - 34px);">
							<option value='1' <?php selected( $opt['b_opt_blog-position-1-1'], 1 ); ?>>Sin selección</option>
							<option value='2' <?php selected( $opt['b_opt_blog-position-1-1'], 2 ); ?>>Autor de la entrada</option>
							<option value='3' <?php selected( $opt['b_opt_blog-position-1-1'], 3 ); ?>>Fecha de publicación</option>
							<option value='4' <?php selected( $opt['b_opt_blog-position-1-1'], 4 ); ?>>Número de comentarios</option>
							<option value='5' <?php selected( $opt['b_opt_blog-position-1-1'], 5 ); ?>>Categorías de la entrada</option>
							<option value='6' <?php selected( $opt['b_opt_blog-position-1-1'], 6 ); ?>>Etiquetas de la entrada</option>
						</select>
						<br />
						<div style="width: 24px; display: inline-block;"># 2</div>
						<select name='bilnea_settings[b_opt_blog-position-1-2]' class="gran" style="margin-top: -2px; width: calc(100% - 34px);">
							<option value='1' <?php selected( $opt['b_opt_blog-position-1-2'], 1 ); ?>>Sin selección</option>
							<option value='2' <?php selected( $opt['b_opt_blog-position-1-2'], 2 ); ?>>Autor de la entrada</option>
							<option value='3' <?php selected( $opt['b_opt_blog-position-1-2'], 3 ); ?>>Fecha de publicación</option>
							<option value='4' <?php selected( $opt['b_opt_blog-position-1-2'], 4 ); ?>>Número de comentarios</option>
							<option value='5' <?php selected( $opt['b_opt_blog-position-1-2'], 5 ); ?>>Categorías de la entrada</option>
							<option value='6' <?php selected( $opt['b_opt_blog-position-1-2'], 6 ); ?>>Etiquetas de la entrada</option>
						</select>
						<br />
						<div style="width: 24px; display: inline-block;"># 3</div>
						<select name='bilnea_settings[b_opt_blog-position-1-3]' class="gran" style="margin-top: -2px; width: calc(100% - 34px);">
							<option value='1' <?php selected( $opt['b_opt_blog-position-1-3'], 1 ); ?>>Sin selección</option>
							<option value='2' <?php selected( $opt['b_opt_blog-position-1-3'], 2 ); ?>>Autor de la entrada</option>
							<option value='3' <?php selected( $opt['b_opt_blog-position-1-3'], 3 ); ?>>Fecha de publicación</option>
							<option value='4' <?php selected( $opt['b_opt_blog-position-1-3'], 4 ); ?>>Número de comentarios</option>
							<option value='5' <?php selected( $opt['b_opt_blog-position-1-3'], 5 ); ?>>Categorías de la entrada</option>
							<option value='6' <?php selected( $opt['b_opt_blog-position-1-3'], 6 ); ?>>Etiquetas de la entrada</option>
						</select>
						<br />
						<div style="width: 24px; display: inline-block;"># 4</div>
						<select name='bilnea_settings[b_opt_blog-position-1-4]' class="gran" style="margin-top: -2px; width: calc(100% - 34px);">
							<option value='1' <?php selected( $opt['b_opt_blog-position-1-4'], 1 ); ?>>Sin selección</option>
							<option value='2' <?php selected( $opt['b_opt_blog-position-1-4'], 2 ); ?>>Autor de la entrada</option>
							<option value='3' <?php selected( $opt['b_opt_blog-position-1-4'], 3 ); ?>>Fecha de publicación</option>
							<option value='4' <?php selected( $opt['b_opt_blog-position-1-4'], 4 ); ?>>Número de comentarios</option>
							<option value='5' <?php selected( $opt['b_opt_blog-position-1-4'], 5 ); ?>>Categorías de la entrada</option>
							<option value='6' <?php selected( $opt['b_opt_blog-position-1-4'], 6 ); ?>>Etiquetas de la entrada</option>
						</select>
						<br />
						<div style="width: 24px; display: inline-block;"># 5</div>
						<select name='bilnea_settings[b_opt_blog-position-1-5]' class="gran" style="margin-top: -2px; width: calc(100% - 34px);">
							<option value='1' <?php selected( $opt['b_opt_blog-position-1-5'], 1 ); ?>>Sin selección</option>
							<option value='2' <?php selected( $opt['b_opt_blog-position-1-5'], 2 ); ?>>Autor de la entrada</option>
							<option value='3' <?php selected( $opt['b_opt_blog-position-1-5'], 3 ); ?>>Fecha de publicación</option>
							<option value='4' <?php selected( $opt['b_opt_blog-position-1-5'], 4 ); ?>>Número de comentarios</option>
							<option value='5' <?php selected( $opt['b_opt_blog-position-1-5'], 5 ); ?>>Categorías de la entrada</option>
							<option value='6' <?php selected( $opt['b_opt_blog-position-1-5'], 6 ); ?>>Etiquetas de la entrada</option>
						</select>
					</div>
					<div style="width: calc(50% - 15px); display: inline-block; border-left: 1px solid #ddd; padding-left: 10px;">
						Meta información bajo el título
						<br />
						<div style="width: 24px; display: inline-block;"># 1</div>
						<select name='bilnea_settings[b_opt_blog-position-2-1]' class="gran" style="margin-top: -2px; width: calc(100% - 28px);">
							<option value='1' <?php selected( $opt['b_opt_blog-position-2-1'], 1 ); ?>>Sin selección</option>
							<option value='2' <?php selected( $opt['b_opt_blog-position-2-1'], 2 ); ?>>Autor de la entrada</option>
							<option value='3' <?php selected( $opt['b_opt_blog-position-2-1'], 3 ); ?>>Fecha de publicación</option>
							<option value='4' <?php selected( $opt['b_opt_blog-position-2-1'], 4 ); ?>>Número de comentarios</option>
							<option value='5' <?php selected( $opt['b_opt_blog-position-2-1'], 5 ); ?>>Categorías de la entrada</option>
							<option value='6' <?php selected( $opt['b_opt_blog-position-2-1'], 6 ); ?>>Etiquetas de la entrada</option>
						</select>
						<br />
						<div style="width: 24px; display: inline-block;"># 2</div>
						<select name='bilnea_settings[b_opt_blog-position-2-2]' class="gran" style="margin-top: -2px; width: calc(100% - 28px);">
							<option value='1' <?php selected( $opt['b_opt_blog-position-2-2'], 1 ); ?>>Sin selección</option>
							<option value='2' <?php selected( $opt['b_opt_blog-position-2-2'], 2 ); ?>>Autor de la entrada</option>
							<option value='3' <?php selected( $opt['b_opt_blog-position-2-2'], 3 ); ?>>Fecha de publicación</option>
							<option value='4' <?php selected( $opt['b_opt_blog-position-2-2'], 4 ); ?>>Número de comentarios</option>
							<option value='5' <?php selected( $opt['b_opt_blog-position-2-2'], 5 ); ?>>Categorías de la entrada</option>
							<option value='6' <?php selected( $opt['b_opt_blog-position-2-2'], 6 ); ?>>Etiquetas de la entrada</option>
						</select>
						<br />
						<div style="width: 24px; display: inline-block;"># 3</div>
						<select name='bilnea_settings[b_opt_blog-position-2-3]' class="gran" style="margin-top: -2px; width: calc(100% - 28px);">
							<option value='1' <?php selected( $opt['b_opt_blog-position-2-3'], 1 ); ?>>Sin selección</option>
							<option value='2' <?php selected( $opt['b_opt_blog-position-2-3'], 2 ); ?>>Autor de la entrada</option>
							<option value='3' <?php selected( $opt['b_opt_blog-position-2-3'], 3 ); ?>>Fecha de publicación</option>
							<option value='4' <?php selected( $opt['b_opt_blog-position-2-3'], 4 ); ?>>Número de comentarios</option>
							<option value='5' <?php selected( $opt['b_opt_blog-position-2-3'], 5 ); ?>>Categorías de la entrada</option>
							<option value='6' <?php selected( $opt['b_opt_blog-position-2-3'], 6 ); ?>>Etiquetas de la entrada</option>
						</select>
						<br />
						<div style="width: 24px; display: inline-block;"># 4</div>
						<select name='bilnea_settings[b_opt_blog-position-2-4]' class="gran" style="margin-top: -2px; width: calc(100% - 28px);">
							<option value='1' <?php selected( $opt['b_opt_blog-position-2-4'], 1 ); ?>>Sin selección</option>
							<option value='2' <?php selected( $opt['b_opt_blog-position-2-4'], 2 ); ?>>Autor de la entrada</option>
							<option value='3' <?php selected( $opt['b_opt_blog-position-2-4'], 3 ); ?>>Fecha de publicación</option>
							<option value='4' <?php selected( $opt['b_opt_blog-position-2-4'], 4 ); ?>>Número de comentarios</option>
							<option value='5' <?php selected( $opt['b_opt_blog-position-2-4'], 5 ); ?>>Categorías de la entrada</option>
							<option value='6' <?php selected( $opt['b_opt_blog-position-2-4'], 6 ); ?>>Etiquetas de la entrada</option>
						</select>
						<br />
						<div style="width: 24px; display: inline-block;"># 5</div>
						<select name='bilnea_settings[b_opt_blog-position-2-5]' class="gran" style="margin-top: -2px; width: calc(100% - 28px);">
							<option value='1' <?php selected( $opt['b_opt_blog-position-2-5'], 1 ); ?>>Sin selección</option>
							<option value='2' <?php selected( $opt['b_opt_blog-position-2-5'], 2 ); ?>>Autor de la entrada</option>
							<option value='3' <?php selected( $opt['b_opt_blog-position-2-5'], 3 ); ?>>Fecha de publicación</option>
							<option value='4' <?php selected( $opt['b_opt_blog-position-2-5'], 4 ); ?>>Número de comentarios</option>
							<option value='5' <?php selected( $opt['b_opt_blog-position-2-5'], 5 ); ?>>Categorías de la entrada</option>
							<option value='6' <?php selected( $opt['b_opt_blog-position-2-5'], 6 ); ?>>Etiquetas de la entrada</option>
						</select>
					</div>
					<hr />
					<div style="width: 160px; display: inline-block; vertical-align: top;">
						Categorías mostradas
						<br />
						<select multiple style="font-size: 13px; width: 100%; font-size: 12px; width: 100%; border-radius: 5px; height: 116px; padding: 4px;" name='bilnea_settings[b_opt_blog-categories][]'>
							<?php
							if (b_f_option('b_opt_blog-categories') == null) {
								$totc = array();
							} else {
								$totc = b_f_option('b_opt_blog-categories');
							}
							$catg = get_categories();
							?>
							<option value="all" <?php if (in_array('all', $totc)) { echo 'selected="selected"'; } ?>>Todas las categorías</option>
							<?php
							foreach ($catg as $cate) {
								?>
								<option value="<?= $cate->slug ?>" <?php if (in_array($cate->slug, $totc)) { echo 'selected="selected"'; } ?>><?= $cate->name ?></option>
								<?php
							}
							?>
						</select>
					</div>
					<div style="width: calc(100% - 180px); display: inline-block; margin-left: 6px; border-left: 1px solid #ddd; padding-left: 8px;">
						<input type='radio' name='bilnea_settings[b_opt_blog-excerpt]' <?php checked( $opt['b_opt_blog-excerpt'], 1 ); ?> value='1'><span>No mostrar previsualización de la entrada</span>
						<br />
						<input type='radio' name='bilnea_settings[b_opt_blog-excerpt]' <?php checked( $opt['b_opt_blog-excerpt'], 2 ); ?> value='2'><span>Mostrar extracto de cada entrada</span>
						<br />
						<input type='radio' name='bilnea_settings[b_opt_blog-excerpt]' <?php checked( $opt['b_opt_blog-excerpt'], 3 ); ?> value='3'><span>Mostrar texto completo de cada entrada</span>
						<br />
						<input type='checkbox' name='bilnea_settings[b_opt_blog-html]' <?php checked( $opt['b_opt_blog-html'], 1 ); ?> value='1'> <span>Interpretar etiquetas HTML</span>
						<br />
						<div style="width: calc(100% - 54px); display: inline-block;">Longitud del extracto, en caracteres</div>
						<input style="text-align: right; width: 50px;" type='text' class="peq" name='bilnea_settings[b_opt_blog-excerpt-length]' value='<?php echo $opt['b_opt_blog-excerpt-length']; ?>' placeholder="<?= b_f_default()['b_opt_blog-excerpt-length']; ?>">
					</div>
					<hr />
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
								<div style="width: calc(50% - 10px); padding-right: 10px; border-right: 1px solid #ddd; margin-right: 8px; display: inline-block;">
									Texto del enlace "Leer más" en <?= strtolower($l['translated_name']); ?>
									<br />
									<input style="text-align: left; width: 100%;" type='text' class="peq" name='bilnea_settings[b_opt_blog-read-more-<?= $l['language_code']?>]' value='<?php echo $opt['b_opt_blog-read-more-'.$l['language_code']]; ?>' placeholder="<?= b_f_default()['b_opt_blog-read-more-'.$l['language_code']]; ?>">
								</div>
								<div style="display: inline-block; width: calc(50% - 14px);">
									Formato de fecha para <?= strtolower($l['translated_name']); ?>
									<br />
									<input style="text-align: left; width: 100%;" type='text' class="peq" name='bilnea_settings[b_opt_blog-date-<?= $l['language_code']?>]' value='<?php echo $opt['b_opt_blog-date-'.$l['language_code']]; ?>' placeholder="<?= b_f_default()['b_opt_blog-date-'.$l['language_code']]; ?>">
								</div>
								<?php
								$int++;
							}
						}
						$sitepress->switch_lang($clg);
					} else {
						?>
						<div style="width: calc(50% - 10px); padding-right: 10px; border-right: 1px solid #ddd; margin-right: 8px; display: inline-block;">
							Texto del enlace "Leer más"
							<br />
							<input style="text-align: left; width: 100%;" type='text' class="peq" name='bilnea_settings[b_opt_blog-read-more-es]' value='<?php echo $opt['b_opt_blog-read-more-es']; ?>' placeholder="<?= b_f_default()['b_opt_blog-read-more-es']; ?>">
						</div>
						<div style="display: inline-block; width: calc(50% - 14px);">
							Formato de fecha
							<br />
							<input style="text-align: left; width: 100%;" type='text' class="peq" name='bilnea_settings[b_opt_blog-date-es]' value='<?php echo $opt['b_opt_blog-date-es']; ?>' placeholder="<?= b_f_default()['b_opt_blog-date-es']; ?>">
						</div>
						<?php
					}
					?>
				</div>

				<!-- Multidioma -->
				<?php
				if (function_exists('icl_object_id')) {
				?>
				<div <?php if ($opt['tab'] == 9) { echo 'class="activo"'; }?> id="tab8">
					<h4>Configuración multidioma para la cabecera</h4>
					<input type='checkbox' name='bilnea_settings[b_opt_language]' <?php checked( $opt['b_opt_language'], 1 ); ?> value='1'> <span>Mostrar el selector de idioma en la cabecera</span>
					<div style="display: block;" class="child">
						<input type='radio' name='bilnea_settings[b_opt_language-header]' <?php checked( $opt['b_opt_language-header'], 1 ); ?> value='1'><span>Mostrar en la barra superior</span>
						<br />
						<input type='radio' name='bilnea_settings[b_opt_language-header]' <?php checked( $opt['b_opt_language-header'], 2 ); ?> value='2'><span>Mostrar en la cabecera</span>
					</div>
					<hr />
					<div style="display: block;">
						<input type='radio' name='bilnea_settings[b_opt_language-selector-header]' <?php checked( $opt['b_opt_wpm-selector-top'], 1 ); ?> value='1'><span>Mostrar como desplegable</span>
						<br />
						<input type='radio' name='bilnea_settings[b_opt_language-selector-header]' <?php checked( $opt['b_opt_wpm-selector-top'], 2 ); ?> value='2'><span>Mostrar en línea</span>
					</div>
					<hr />
					<input type='checkbox' name='bilnea_settings[b_opt_language-flag-header]' <?php checked( $opt['b_opt_language-flag-header'], 1 ); ?> value='1'> <span>Mostrar banderas en el selector</span>
					<br />
					<input type='checkbox' name='bilnea_settings[b_opt_language-name-header]' <?php checked( $opt['b_opt_language-name-header'], 1 ); ?> value='1'> <span>Mostrar nombre del idioma en el selector</span>
					<div style="display: block;" class="child">
						<input type='radio' name='bilnea_settings[b_opt_wpm-header-language]' <?php checked( $opt['b_opt_wpm-header-language'], 1 ); ?> value='1'><span>Nombre en idioma actual</span>
						<br />
						<input type='radio' name='bilnea_settings[b_opt_wpm-header-language]' <?php checked( $opt['b_opt_wpm-header-language'], 2 ); ?> value='2'><span>Nombre en idioma nativo</span>
						<br />
						<input type='radio' name='bilnea_settings[b_opt_wpm-header-language]' <?php checked( $opt['b_opt_wpm-header-language'], 3 ); ?> value='3'><span>Denominación corta del idioma</span>
					</div>
					<h4 style="margin-top: 10px;">Configuración multidioma para el pie de página</h4>
					<input type='checkbox' name='bilnea_settings[b_opt_language-footer]' <?php checked( $opt['b_opt_language-footer'], 1 ); ?> value='1'> <span>Mostrar el selector de idioma en el 'socket'</span>
					<hr />
					<div style="display: block;">
						<input type='radio' name='bilnea_settings[b_opt_wpm-selector-socket]' <?php checked( $opt['b_opt_wpm-selector-socket'], 1 ); ?> value='1'><span>Mostrar como desplegable</span>
						<br />
						<input type='radio' name='bilnea_settings[b_opt_wpm-selector-socket]' <?php checked( $opt['b_opt_wpm-selector-socket'], 2 ); ?> value='2'><span>Mostrar en línea</span>
					</div>
					<hr />
					<input type='checkbox' name='bilnea_settings[b_opt_language-flag-footer]' <?php checked( $opt['b_opt_language-flag-footer'], 1 ); ?> value='1'> <span>Mostrar banderas en el selector</span>
					<br />
					<input type='checkbox' name='bilnea_settings[b_opt_language-name-footer]' <?php checked( $opt['b_opt_language-name-footer'], 1 ); ?> value='1'> <span>Mostrar nombre del idioma en el selector</span>
					<hr />
					<div style="display: block;">
						<input type='radio' name='bilnea_settings[b_opt_wpm-language]' <?php checked( $opt['b_opt_wpm-footer-language'], 1 ); ?> value='1'><span>Nombre en idioma actual</span>
						<br />
						<input type='radio' name='bilnea_settings[b_opt_wpm-language]' <?php checked( $opt['b_opt_wpm-footer-language'], 2 ); ?> value='2'><span>Nombre en idioma nativo</span>
						<br />
						<input type='radio' name='bilnea_settings[b_opt_wpm-language]' <?php checked( $opt['b_opt_wpm-footer-language'], 3 ); ?> value='3'><span>Denominación corta del idioma</span>
					</div>
					<em class="notice" style="font-size: 11px; line-height: 15px; margin-bottom: 10px;">
						Esta configuración utiliza funciones del plugin WPML. Sólo estarán activas cuando el plugin esté instalado y activo.
					</em>
				</div>
				<?php
				}
				?>

				<!-- Textos legales -->
				<div id="tab9" <?php if ($opt['tab'] == 10) { echo 'class="activo"'; }?>>
					<h4>Datos personales</h4>
					<div style="width: calc(50% - 10px); margin-right: 16px; display: inline-block;">
						Nombre legal
						<br />
						<input type="text" id="user_name" class="gran" name='bilnea_settings[user_name]' style="width: 100%;" value='<?php echo $opt['user_name']; ?>'>
					</div>
					<div style="width: calc(50% - 10px); display: inline-block;">
						CIF / NIF
						<br />
						<input type="text" id="user_cif" class="gran" name='bilnea_settings[user_cif]' style="width: 100%;" value='<?php echo $opt['user_cif']; ?>'>
					</div>
					<div style="width: calc(50% - 10px); margin-right: 16px; display: inline-block;">
						Correo electrónico
						<br />
						<input type="text" id="user_email" class="gran" name='bilnea_settings[user_email]' style="width: 100%;" value='<?php echo $opt['user_email']; ?>' >
					</div>
					<div style="width: calc(50% - 10px); display: inline-block;">
						Teléfono
						<br />
						<input type="text" id="user_phone" class="gran" name='bilnea_settings[user_phone]' style="width: 100%;" value='<?php echo $opt['user_phone']; ?>'>
					</div>
					Dirección postal
					<br />
					<input type="text" id="user_address" class="gran" name='bilnea_settings[user_address]' style="width: 100%;" value='<?php echo $opt['user_address']; ?>'>
					<div class="notice" style="font-size: 12px;">
						Información que se mostrará en las páginas de textos legales, en caso de crearlas de manera automática.
					</div>
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
									<input type="text" id="user_cif" class="gran" name='bilnea_settings[user_cif]' style="width: 100%;" value='<?php echo $opt['user_cif']; ?>'>
								</div>
								
								<br />
								<label for="bilnea_settings[b_opt_legal-url-_<?= $l['language_code']?>]"><?php echo $sitepress->language_url($l['language_code']); ?></label>
								<input style="font-size: 12px; -webkit-transform: translate(-5px, 1px); -moz-transform: translate(-5px, 1px); -ms-transform: translate(-5px, 1px); -o-transform: translate(-5px, 1px); transform: translate(-5px, 1px);" type='text' class="aurl" name='bilnea_settings[b_opt_legal-url-_<?= $l['language_code']?>]' value='<?php echo $opt['b_opt_legal-url-_'.$l['language_code']]; ?>'>
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
							<select name='bilnea_settings[b_opt_legal-advice-es]' class="gran" style="margin-top: -2px; width: 100% !important;">
								<option disabled="disabled" selected>Seleccionar opción</option>
								<option value="new">Crear página</option>
								<?php
								foreach (get_pages() as $page) {
									echo '<option value="'.$page->ID.'" '.selected($opt['b_opt_legal-advice-es'], $page->ID).'>'.$page->post_title.'</option>';
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
							<select name='bilnea_settings[b_opt_privacy-policy-es]' class="gran" style="margin-top: -2px; width: 100% !important;">
								<option disabled="disabled" selected>Seleccionar opción</option>
								<option value="new">Crear página</option>
								<?php
								foreach (get_pages() as $page) {
									echo '<option value="'.$page->ID.'" '.selected($opt['b_opt_privacy-policy-es'], $page->ID).'>'.$page->post_title.'</option>';
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
							<select name='bilnea_settings[b_opt_cookies-policy-es]' class="gran" style="margin-top: -2px; width: 100% !important;">
								<option disabled="disabled" selected>Seleccionar opción</option>
								<option value="new">Crear página</option>
								<?php
								foreach (get_pages() as $page) {
									echo '<option value="'.$page->ID.'" '.selected($opt['b_opt_cookies-policy-es'], $page->ID).'>'.$page->post_title.'</option>';
								}
								?>
							</select>
						</div>
					<?php
					}
					?>
					<h4 style="margin-top: 10px;">Configuración</h4>
					<input type='checkbox' name='bilnea_settings[b_opt_create-cookies-table]' <?php checked($opt['b_opt_create-cookies-table'], 1); ?> value='1'> <span>Generar tabla de cookies de manera automática</span>
					<hr />
					<input type='checkbox' name='bilnea_settings[b_opt_cookies-warning]' <?php checked($opt['b_opt_cookies-warning'], 1); ?> value='1'> <span>Mostrar el aviso legal de cookies</span>
					<div style="display: block;" class="child">
						<input type='radio' name='bilnea_settings[b_opt_show-cookies]' <?php checked($opt['b_opt_show-cookies'], 1); ?> value='1'><span>Mostrar en la zona superior</span>
						<br />
						<input type='radio' name='bilnea_settings[b_opt_show-cookies]' <?php checked($opt['b_opt_show-cookies'], 2); ?> value='2'><span>Mostrar en la zona inferior</span>
					</div>
				</div>

				<!-- Redirecciones y SEO -->
				<div id="tab10" <?php if ($opt['tab'] == 11) { echo 'class="activo"'; }?>>
					<h4>URLs</h4>
					<div class="subsubsub" style="display: block; width: 100%;">
						<a class="current">Todos (<?= wp_count_posts()->publish ?>)</a>
						<?php
						$b_var_post_types_list = array();
						foreach (get_post_types() as $type) {
							$type = get_post_type_object($type);
							if ($type->public == 1 && $type->name != 'attachment') {
								?>
								<a data-slug="<?= $type->name ?>"><?= $type->label ?> <span class="count">(<?= wp_count_posts($type->name)->publish ?>)</span></a>
								<?php
								array_push($b_var_post_types_list, $type->name);
							}
						}
						?>
					</div>
					<div class="content">
						<?php
						$args = array (
							'post_status' => array('publish'),
							'post_type' => $b_var_post_types_list,
							'nopaging' => true,
							'posts_per_page' => '1',
						);
						$query = new WP_Query($args);
						if ($query->have_posts()) {
							while ($query->have_posts()) {
								$query->the_post();
								global $post;
								echo '<hr style="margin: 0;" /><div style="display: block; width: auto;" class="'.get_post_type().'">'.get_the_title().'<input class="gran" style="width: 100%; display: block; margin-top: -2px;" type="text" data-id="'.get_the_ID().'" placeholder="'.$post->post_name.'" /></div>';
							}
						}
						wp_reset_postdata();
						?>
					</div>
				</div>
			</div>
		</div>
		<input type="hidden" id="tab" name='bilnea_settings[tab]' value='<?php echo $opt['tab']; ?>'>
		
		<?php
		settings_fields('pluginPage');
		do_settings_sections('pluginPage');
		submit_button();

		?>
		
	</form>
	<?php
}

function bilnea_subscribers_page() {
	if (b_f_option('b_opt_newsl_service') == 'wordpress') {
		$b_s_url = explode('?', $_SERVER['REQUEST_URI'], 2)[0];
		(isset($_GET['order']) && $_GET['order'] == 'asc') ? $order = 'des' : $order = 'asc';
		if (isset($_GET['orderby'])) {
			$sorts = array('b_s_date' => 'sortable asc', 'b_s_email' => 'sortable asc', 'b_s_name' => 'sortable asc', 'b_s_last_name' => 'sortable asc');
			$sorts[$_GET['orderby']] = 'sorted '.$order;
		}
		?>
		<div class="wrap">
			<h1>Boletín de noticias</h1>
			<table class="wp-list-table widefat fixed striped pages">
				<thead>
					<tr>
						<td id="cb" class="manage-column column-cb check-column">
							<label class="screen-reader-text" for="cb-select-all-1">Seleccionar todos</label>
							<input id="cb-select-all-1" type="checkbox">
						</td>
						<th style="width: 30px;"></th>
						<th scope="col" id="b_s_date" class="manage-column column-title <?= $sorts['b_s_date'] ?>">
							<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}" ?>?page=subscribers&orderby=b_s_date&order=<?= $order ?>">
								<span>Fecha</span>
								<span class="sorting-indicator"></span>
							</a>
						</th>
						<th scope="col" id="b_s_email" class="manage-column column-title <?= $sorts['b_s_email'] ?>">
							<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}" ?>?page=subscribers&orderby=email&order=<?= $order ?>">
								<span>Correo electrónico</span>
								<span class="sorting-indicator"></span>
							</a>
						</th>
						<th scope="col" id="b_s_name" class="manage-column column-title <?= $sorts['b_s_name'] ?>">
							<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}" ?>?page=subscribers&orderby=name&order=<?= $order ?>">
								<span>Nombre</span>
								<span class="sorting-indicator"></span>
							</a>
						</th>
						<th scope="col" id="b_s_last_name" class="manage-column column-title <?= $sorts['b_s_last_name'] ?>">
							<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}" ?>?page=subscribers&orderby=last_name&order=<?= $order ?>">
								<span>Apellidos</span>
								<span class="sorting-indicator"></span>
							</a>
						</th>
						<th style="width: 30px;">
						</th>
					</tr>
				</thead>
				<tbody>
					<?php
					global $wpdb;
					$table = $wpdb->prefix.'subscribers';
					if (isset($_GET['post_id']) && isset($_GET['visibility'])) {
						$wpdb->update($table, array('active' => $_GET['visibility']), array('id' => $_GET['post_id']));
					}
					$subs = $wpdb->get_results('SELECT * FROM '.$table, ARRAY_A);
					foreach ($subs as $subscriber) {
						?>
						<tr id="subscriber-<?= $subscriber['id'] ?>" class="iedit author-self level-0 post-<?= $subscriber['id'] ?> status-publish hentry">
							<th scope="row" class="check-column">
								<label class="screen-reader-text" for="cb-select-<?= $subscriber['id'] ?>">Elige suscriptor</label>
								<input id="cb-select-<?= $subscriber['id'] ?>" type="checkbox" name="post[]" value="<?= $subscriber['id'] ?>">
								<div class="locked-indicator"></div>
							</th>
							<th scope="row" class="check-column-2" style="text-align: center;">
								<?php
								$gets = array();
								$temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
								foreach ($temps as $temp) {
									$args = explode('=', $temp);
									$gets[$args[0]] = $args[1];
								}
								$gets['post_id'] = $subscriber['id'];
								if ($subscriber['active'] == 1) {
									$gets['visibility'] = 0;
								?>
									<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}" ?>?<?= http_build_query($gets) ?>"><span class="dashicons dashicons-visibility"></span></a>
								<?php
								} else {
									$gets['visibility'] = 1;
								?>
									<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}" ?>?<?= http_build_query($gets) ?>"><span class="dashicons dashicons-hidden"></span></a>
								<?php
								}
								?>
							</th>
							<td class="date column-date" data-colname="Fecha">
								<?= $subscriber['date'] ?>
							</td>
							<td class="title column-email has-row-actions column-primary page-title" data-colname="Correo electrónico">
								<a class="row-email" href="mailto:<?= $subscriber['email'] ?>"><?= $subscriber['email'] ?></a>
							</td>
							<td class="date column-date" data-colname="Nombre">
								<?= $subscriber['name'] ?>
							</td>
							<td class="date column-date" data-colname="Apellidos">
								<?= $subscriber['last_name'] ?>
							</td>
							<td style="text-align: center;">

								<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}" ?>?<?= http_build_query($gets) ?>">
									<span class="dashicons dashicons-trash"></span>
								</a>
							</td>
						</tr>
						<?php
					}
					?>
				</tbody>
			</table>
		</div>
	<?php
	} else if (b_f_option('b_opt_newsl_service') == 'benchmark') {
		if (isset($_POST['list_selector'])) {
			$options = get_option('bilnea_settings');
			$options['b_opt_newsl_list'] = $_POST['list_selector'];
			update_option('bilnea_settings', $options);
		}
		$b_s_url = explode('?', $_SERVER['REQUEST_URI'], 2)[0];
		include_once( ABSPATH.WPINC.'/class-IXR.php');
		$client = new IXR_Client( 'https://api.benchmarkemail.com/1.3', false, 443, 20);
		$args = array('login', b_f_option('b_opt_newsl_username'), b_f_option('b_opt_newsl_password'));
		call_user_func_array(array($client, 'query'), $args);
		$token = $client->getResponse();
		if (isset($_GET['delete'])) {
			$args = array('listDeleteContacts', $token, $_GET['list'], $_GET['delete']);
			call_user_func_array(array($client, 'query'), $args);
		}
		(isset($_GET['paged'])) ? $paged = $_GET['paged']  : $paged = 1;
		(isset($_GET['view'])) ? $view = $_GET['view']  : $view = 50;
		$args = array('listGet', $token, '', 1, 1000, 'name', 'asc');
		call_user_func_array(array($client, 'query'), $args);
		$lists = $client->getResponse();
		if (count($lists) > 0) {
			(isset($_GET['list'])) ? $c = $_GET['list'] : $c = $lists[0]['id'];
			?>
			<div class="wrap">
				<h1>Boletín de noticias</h1>
				<ul class="subsubsub" style="float: none;">
					<?php
						$i = 1;
						foreach ($lists as $list) {
							$gets = array();
							$temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
							foreach ($temps as $temp) {
								$args = explode('=', $temp);
								$gets[$args[0]] = $args[1];
							}
							$gets['list'] = $list['id'];
							?>
							<li class="list-<?= $list['id'] ?>">
								<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}" ?>?<?= http_build_query($gets) ?>"<?= ($list['id'] == $c) ? ' class="current"' : '' ?>><?= $list['listname'] ?> <span class="count">(<?= $list['contactcount'] ?>)</span></a><?= ($i == count($lists)) ? '' : ' |' ?>
							</li>
							<?php
							$i++;
						}
						(isset($_GET['order']) && $_GET['order'] == 'asc') ? $order = 'des' : $order = 'asc';
						$sorts = array('date' => 'sorted '.$order, 'email' => 'sortable '.$order);
						$orderby = 'date';
						if (isset($_GET['orderby'])) {
							$sorts[$_GET['orderby']] = 'sorted '.$order;
							$orderby = $_GET['orderby'];
						}
					?>
				</ul>
				<div>
					<?php
					$args = array('listGet', $token, '', 1, 1000, 'name', 'asc');
					call_user_func_array(array($client, 'query'), $args);
					$lists = $client->getResponse();
					?>
					<label>Lista por defecto: </label>
					<form action="#" method="post" name="list_form">
						<select id="list_selector" name="list_selector">
							<option selected disabled>Selecciona una lista</option>
							<?php
							foreach ($lists as $list) {
								(b_f_option('b_opt_newsl_list') == $list['id']) ? $seld = ' selected="selected"' : $seld = '';
								echo '<option value="'.$list['id'].'"'.$seld.'>'.$list['listname'].'</option>';
							}
							?>
						</select>
					</form>
					<script type="text/javascript">
						jQuery(function() {
							jQuery('#list_selector').change(function() {
								this.form.submit();
							})
						})
					</script>
				</div>
				<table class="wp-list-table widefat fixed striped pages">
				<thead>
					<tr>
						<td id="cb" class="manage-column column-cb check-column">
							<label class="screen-reader-text" for="cb-select-all-1">Seleccionar todos</label>
							<input id="cb-select-all-1" type="checkbox">
						</td>
						<th scope="col" id="b_s_date" class="manage-column column-title <?= $sorts['date'] ?>">
							<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}" ?>?list=<?= $c ?>&page=subscribers&orderby=date&order=<?= $order ?>">
								<span>Fecha</span>
								<span class="sorting-indicator"></span>
							</a>
						</th>
						<th scope="col" id="b_s_email" class="manage-column column-title <?= $sorts['email'] ?>">
							<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}" ?>?list=<?= $c ?>&page=subscribers&orderby=email&order=<?= $order ?>">
								<span>Correo electrónico</span>
								<span class="sorting-indicator"></span>
							</a>
						</th>
						<th scope="col" id="b_s_name" class="manage-column column-title <?= $sorts['b_s_name'] ?>">
							<span>Nombre</span>
						</th>
						<th scope="col" id="b_s_last_name" class="manage-column column-title <?= $sorts['b_s_last_name'] ?>">
							<span>Apellidos</span>
						</th>
						<th style="width: 30px;">
						</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$args = array('listGetContactsAllFields', $token, $c, '', (int)$paged, (int)$view, $orderby, $order);
					call_user_func_array(array($client, 'query'), $args);
					$lists = $client->getResponse();
					foreach ($lists as $list) {
						?>
						<tr id="subscriber-<?= $list['id'] ?>" class="iedit author-self level-0 post-<?= $list['id'] ?> status-publish hentry">
							<th scope="row" class="check-column">
								<label class="screen-reader-text" for="cb-select-<?= $list['id'] ?>">Elige suscriptor</label>
								<input id="cb-select-<?= $list['id'] ?>" type="checkbox" name="post[]" value="<?= $list['id'] ?>">
								<div class="locked-indicator"></div>
							</th>
							<td class="date column-date" data-colname="Fecha">
								<?php
								$date = explode(' ', $list['timestamp']);
								$months = array('Jan' => 'enero',
												'Feb' => 'febrero',
												'Mar' => 'marzo',
												'Apr' => 'abril',
												'May' => 'mayo',
												'Jun' => 'junio',
												'Jul' => 'julio',
												'Aug' => 'agosto',
												'Sep' => 'septiembre',
												'Oct' => 'octubre',
												'Nov' => 'noviembre',
												'Dec' => 'diciembre'
												);
								echo str_replace(',', '', $date[1]).' '.$months[$date[0]].' '.$date[2];
								?>
							</td>
							<td class="title column-email has-row-actions column-primary page-title" data-colname="Correo electrónico">
								<a class="row-email" href="mailto:<?= $list['email'] ?>"><?= $list['email'] ?></a>
							</td>
							<td class="date column-date" data-colname="Nombre">
								<?= $list['First Name'] ?>
							</td>
							<td class="date column-date" data-colname="Apellidos">
								<?= $list['Last Name'] ?>
							</td>
							<td style="text-align: center;">
								<?php
								$gets = array();
								$temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
								foreach ($temps as $temp) {
									$args = explode('=', $temp);
									$gets[$args[0]] = $args[1];
								}
								$gets['delete'] = $list['id'];
								?>
								<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}" ?>?<?= http_build_query($gets) ?>">
									<span class="dashicons dashicons-trash"></span>
								</a>
							</td>
						</tr>
						<?php
					}
					?>
				</tbody>
			</table>
			<div class="tablenav bottom">
				<div class="alignleft actions bulkactions">
					<label for="bulk-action-selector-bottom" class="screen-reader-text">Selecciona acción en lote</label>
					<select name="action2" id="bulk-action-selector-bottom">
						<option value="-1">Acciones en lote</option>
						<option value="delete" class="hide-if-no-js">Eliminar</option>
					</select>
					<input type="submit" id="doaction2" class="button action" value="Aplicar">
					</div>
						<div class="alignleft actions">
					</div>
					<?php
					$args = array('listGet', $token, '', 1, 1000, 'name', 'asc');
					call_user_func_array(array($client, 'query'), $args);
					$lists = $client->getResponse();
					$total;
					foreach ($lists as $list) {
						if ($list['id'] == $c) {
							$total =  $list['contactcount'];
							$total_pages = ceil((int)$total/(int)$view);
						}
					}
					?>
					<div class="tablenav-pages">
						<span class="displaying-num"><?= $total ?> elementos</span>
							<span class="pagination-links">
								<?php
								$paged = (int)$paged;
								if ($paged <= 2) {
									echo '<span class="tablenav-pages-navspan" aria-hidden="true">«</span>';
								} else {
									$gets = array();
									$temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
									foreach ($temps as $temp) {
										$args = explode('=', $temp);
										$gets[$args[0]] = $args[1];
									}
									$gets['paged'] = 1;
									echo '<a class="first-page" href="http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}".'?'.http_build_query($gets).'"><span class="screen-reader-text">Primera página</span><span aria-hidden="true">«</span></a>';
								}
								echo '&nbsp;';
								if ($paged <= 1) {
									echo '<span class="tablenav-pages-navspan" aria-hidden="true">‹</span>';
								} else {
									$gets = array();
									$temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
									foreach ($temps as $temp) {
										$args = explode('=', $temp);
										$gets[$args[0]] = $args[1];
									}
									$gets['paged'] = $paged-1;
									echo '<a class="prev-page" href="http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}".'?'.http_build_query($gets).'"><span class="screen-reader-text">Página anterior</span><span aria-hidden="true">‹</span></a>';
								}
								?>
								<span class="screen-reader-text">Página actual</span>
								<span id="table-paging" class="paging-input">
									<span class="tablenav-paging-text"><?= $paged ?> de <span class="total-pages"><?= $total_pages ?></span></span>
								</span>
								<?php
								if ($paged >= $total_pages-1) {
									echo '<span class="tablenav-pages-navspan" aria-hidden="true">›</span>';
								} else {
									$gets = array();
									$temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
									foreach ($temps as $temp) {
										$args = explode('=', $temp);
										$gets[$args[0]] = $args[1];
									}
									$gets['paged'] = $paged+1;
									echo '<a class="next-page" href="http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}".'?'.http_build_query($gets).'"><span class="screen-reader-text">Página anterior</span><span aria-hidden="true">›</span></a>';
								}
								echo '&nbsp;';
								if ($paged >= $total_pages-2) {
									echo '<span class="tablenav-pages-navspan" aria-hidden="true">»</span>';
								} else {
									$gets = array();
									$temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
									foreach ($temps as $temp) {
										$args = explode('=', $temp);
										$gets[$args[0]] = $args[1];
									}
									$gets['paged'] = $total_pages;
									echo '<a class="last-page" href="http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}".'?'.http_build_query($gets).'"><span class="screen-reader-text">Última página</span><span aria-hidden="true">»</span></a>';
								}
								?>
							</span>
					</div>
					<br class="clear">
				</div>
		</div>
		<?php
		}
	} else if (b_f_option('b_opt_newsl_service') == 'mailchimp') {
		$api_key = b_f_option('b_opt_newsl_api');
		$b_s_url = explode('?', $_SERVER['REQUEST_URI'], 2)[0];
		if (isset($_POST['list_selector'])) {
			$options = get_option('bilnea_settings');
			$options['b_opt_newsl_list'] = $_POST['list_selector'];
			update_option('bilnea_settings', $options);
		}
		function b_mailchimp($url, $request_type, $api_key, $data = array()) {
			if ($request_type == 'GET') {
				$url .= '?' . http_build_query($data);
			}
			$mch = curl_init();
			$headers = array(
				'Content-Type: application/json',
				'Authorization: Basic '.base64_encode( 'user:'. $api_key )
			);
			curl_setopt($mch, CURLOPT_URL, $url);
			curl_setopt($mch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($mch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($mch, CURLOPT_CUSTOMREQUEST, $request_type);
			curl_setopt($mch, CURLOPT_TIMEOUT, 10);
			curl_setopt($mch, CURLOPT_SSL_VERIFYPEER, false);
			if($request_type != 'GET') {
				curl_setopt($mch, CURLOPT_POST, true);
				curl_setopt($mch, CURLOPT_POSTFIELDS, json_encode($data));
			}	 
			return curl_exec($mch);
		}
		if (isset($_GET['visibility'])) {
			switch ($_GET['visibility']) {
				case '0':
					$result = json_decode( b_mailchimp_member_status($_GET['email'], 'unsubscribed', $_GET['list_id'], $api_key, 'PATCH' ) );
					if( $result->status == 400 ) {
						foreach( $result->errors as $error ) {
							echo '<p>Error: ' . $error->message . '</p>';
						}
					}
					break;
				case '1':
					$result = json_decode( b_mailchimp_member_status($_GET['email'], 'subscribed', $_GET['list_id'], $api_key, 'PATCH' ) );
					if( $result->status == 400 ) {
						foreach( $result->errors as $error ) {
							echo '<p>Error: ' . $error->message . '</p>';
						}
					}
					break;
			}
		}
		if (isset($_GET['delete'])) {
			$result = json_decode( b_mailchimp_member_status($_GET['delete'], 'unsubscribed', $_GET['list_id'], $api_key, 'DELETE' ) );
			if( $result->status == 400 ) {
				foreach( $result->errors as $error ) {
					echo '<p>Error: ' . $error->message . '</p>';
				}
			}
		}
		if (isset($_POST['action2']) && $_POST['action2'] == delete) {
			$users = explode(',', $_POST['c_ids']);
			foreach ($users as $user) {
				$userdata = explode('::', $user);
				$result = json_decode( b_mailchimp_member_status($userdata[0], 'unsubscribed', $userdata[1], $api_key, 'DELETE' ) );
			}
		}
		$url = 'https://'.substr($api_key,strpos($api_key,'-')+1).'.api.mailchimp.com/3.0/lists/';
		$data = array(
			'fields' => 'lists'
		);
		$result = json_decode(b_mailchimp($url, 'GET', $api_key, $data));
		$lists = $result->lists;
		if (count($lists) > 0) {
			(isset($_GET['list'])) ? $c = $_GET['list'] : $c = $lists[0]->id;
			?>
			<div class="wrap">
				<h1>Boletín de noticias</h1>
				<ul class="subsubsub" style="float: none;">
					<li class="all">
						<a class="current" href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}" ?>?page=subscribers">Todos <span class="count">(0)</span></a>
					</li>
					<?php
						if(!empty($lists)) {
							$total = 0;
							foreach($lists as $list) {
								$total_members = $list->stats->member_count;
								$total = $total+$total_members;
								$gets = array();
								$temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
								$gets['page'] = 'subscribers';
								$gets['list_view'] = $list->id;
								?>
								<li class="list-<?= $list->id ?>">
									|&nbsp;<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}" ?>?<?= http_build_query($gets) ?>"><?= $list->name ?> <span class="count">(<?= $total_members ?>)</span></a>
								</li>
								<?php
								$i++;
							}
							(isset($_GET['order']) && $_GET['order'] == 'asc') ? $order = 'desc' : $order = 'asc';
							$sorts = array('date' => 'sortable '.$order, 'email' => 'sortable '.$order, 'status' => 'sortable '.$order);
							$orderby = 'date';
							if (isset($_GET['orderby'])) {
								$sorts[$_GET['orderby']] = 'sorted '.$order;
								$orderby = $_GET['orderby'];
							}
							?>
							<script type="text/javascript">
								jQuery(function() {
									<?php if (isset($_GET['list_view'])) : ?>
									jQuery('.subsubsub a.current').removeClass('current');
									jQuery('.subsubsub a[href*="<?= $_GET['list_view'] ?>"]').addClass('current');
									<?php endif; ?>
									jQuery('.subsubsub .all a span').text('(<?= $total ?>)');
								})
							</script>
							<?php
						}
						?>
				</ul>
				<div class="tablenav top">
					<div style="display: inline-block;">
						<form action="#" method="post" name="list_form">
							<label>Lista por defecto: </label>
							<select id="list_selector" name="list_selector" style="margin: 4px 0 8px 0;">
								<option selected disabled>Selecciona una lista</option>
								<?php
								foreach ($lists as $list) {
									(b_f_option('b_opt_newsl_list') == $list->id) ? $seld = ' selected="selected"' : $seld = '';
									echo '<option value="'.$list->id.'"'.$seld.'>'.$list->name.'</option>';
								}
								?>
							</select>
						</form>
						<script type="text/javascript">
							jQuery(function() {
								jQuery('#list_selector').change(function() {
									this.form.submit();
								})
							})
						</script>
					</div>
					<?php
					(isset($_GET['count'])) ? $view = $_GET['count'] : $view = 25;
					(isset($_GET['paged'])) ? $paged = $_GET['paged'] : $paged = 1;
					$total;
					foreach ($lists as $list) {
						if ($list->id == $c) {
							$total = $list->stats->member_count;
							$total_pages = ceil((int)$total/(int)$view);
						}
					}
					?>
					<div class="tablenav-pages">
						<span class="displaying-num"><?= $total ?> suscriptores</span>
							<span class="pagination-links">
								<?php
								$paged = (int)$paged;
								if ($paged <= 2) {
									echo '<span class="tablenav-pages-navspan" aria-hidden="true">«</span>';
								} else {
									$gets = array();
									$temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
									foreach ($temps as $temp) {
										$args = explode('=', $temp);
										$gets[$args[0]] = $args[1];
									}
									$gets['paged'] = 1;
									echo '<a class="first-page" href="http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}".'?'.http_build_query($gets).'"><span class="screen-reader-text">Primera página</span><span aria-hidden="true">«</span></a>';
								}
								echo '&nbsp;';
								if ($paged <= 1) {
									echo '<span class="tablenav-pages-navspan" aria-hidden="true">‹</span>';
								} else {
									$gets = array();
									$temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
									foreach ($temps as $temp) {
										$args = explode('=', $temp);
										$gets[$args[0]] = $args[1];
									}
									$gets['paged'] = $paged-1;
									echo '<a class="prev-page" href="http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}".'?'.http_build_query($gets).'"><span class="screen-reader-text">Página anterior</span><span aria-hidden="true">‹</span></a>';
								}
								?>
								<span class="screen-reader-text">Página actual</span>
								<span id="table-paging" class="paging-input">
									<span class="tablenav-paging-text"><?= $paged ?> de <span class="total-pages"><?= $total_pages ?></span>
								</span>
							</span>
							<?php
							if ($paged >= $total_pages-1) {
								echo '<span class="tablenav-pages-navspan" aria-hidden="true">›</span>';
							} else {
								$gets = array();
								$temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
								foreach ($temps as $temp) {
									$args = explode('=', $temp);
									$gets[$args[0]] = $args[1];
								}
								$gets['paged'] = $paged+1;
								echo '<a class="next-page" href="http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}".'?'.http_build_query($gets).'"><span class="screen-reader-text">Página anterior</span><span aria-hidden="true">›</span></a>';
							}
							echo '&nbsp;';
							if ($paged >= $total_pages-2) {
								echo '<span class="tablenav-pages-navspan" aria-hidden="true">»</span>';
							} else {
								$gets = array();
								$temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
								foreach ($temps as $temp) {
									$args = explode('=', $temp);
									$gets[$args[0]] = $args[1];
								}
								$gets['paged'] = $total_pages;
								echo '<a class="last-page" href="http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}".'?'.http_build_query($gets).'"><span class="screen-reader-text">Última página</span><span aria-hidden="true">»</span></a>';
							}
							?>
						</span>
					</div>
				</div>
				<table class="wp-list-table widefat fixed striped pages">
				<thead>
					<tr>
						<td id="cb" class="manage-column column-cb check-column">
							<label class="screen-reader-text" for="cb-select-all-1">Seleccionar todos</label>
							<input id="cb-select-all-1" type="checkbox">
						</td>
						<td style="width: 30px;"></td>
						<th scope="col" id="b_s_date" class="manage-column column-title <?= $sorts['date'] ?>">
							<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}" ?>?list=<?= $c ?>&page=subscribers&orderby=date&order=<?= $order ?>">
								<span>Fecha</span>
								<span class="sorting-indicator"></span>
							</a>
						</th>
						<th scope="col" id="b_s_email" class="manage-column column-title <?= $sorts['email'] ?>">
							<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}" ?>?list=<?= $c ?>&page=subscribers&orderby=email&order=<?= $order ?>">
								<span>Correo electrónico</span>
								<span class="sorting-indicator"></span>
							</a>
						</th>
						<th scope="col" id="b_s_name" class="manage-column column-title <?= $sorts['b_s_name'] ?>">
							<span>Nombre</span>
						</th>
						<th scope="col" id="b_s_last_name" class="manage-column column-title <?= $sorts['b_s_last_name'] ?>">
							<span>Boletín de noticias</span>
						</th>
						<th scope="col" id="b_s_status" class="manage-column column-title <?= $sorts['status'] ?>">
							<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}" ?>?list=<?= $c ?>&page=subscribers&orderby=status&order=<?= $order ?>">
								<span>Estado</span>
								<span class="sorting-indicator"></span>
							</a>
						</th>
						<th style="width: 30px;">
						</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($lists as $list) {
						$url .= $list->id.'/members/';
						(isset($_GET['view'])) ? $count = $_GET['view'] : $count = 25;
						(isset($_GET['paged'])) ? $offset = $_GET['paged']*$count : $offset = 0;
						$total_members = $list->stats->member_count;
						($total_members > 500) ? $steps = ceil($total_members/500) : $steps = 1;
						$members = array();
						for ($i = 0; $i < $steps; $i++) { 
							$data = array(
								'fields' => 'members',
								'count' => 500,
								'offset' => $i*500
							);
							$result = json_decode(b_mailchimp($url, 'GET', $api_key, $data));
							foreach ($result->members as $member) {
								array_push($members, array(
									'id' => $member->id,
									'timestamp_signup' => $member->timestamp_signup,
									'email_address' => $member->email_address,
									'name' => $member->merge_fields->FNAME.' '.$member->merge_fields->LNAME,
									'status' => $member->status
								));
							};
						}
						if (isset($_GET['orderby'])) {
							switch ($_GET['orderby']) {
								case 'date':
									function sort_members($x, $y) {
										return strcasecmp($x['timestamp_signup'], $y['timestamp_signup']);
									}
									usort($members, 'sort_members');
									break;
								case 'email':
									function sort_members($x, $y) {
										return strcasecmp($x['email_address'], $y['email_address']);
									}
									usort($members, 'sort_members');
									break;
								case 'name':
									function sort_members($x, $y) {
										return strcasecmp($x['name'], $y['name']);
									}
									usort($members, 'sort_members');
									break;
								case 'status':
									function sort_members($x, $y) {
										return strcasecmp($x['status'], $y['status']);
									}
									usort($members, 'sort_members');
									break;
							}
						}
						if (isset($_GET['order']) && $_GET['order'] == 'desc') {
							$members = array_reverse($members);
						}
						(isset($_GET['view'])) ? $view = $_GET['view'] : $view = 25;
						(isset($_GET['paged'])) ? $paged = $_GET['paged'] : $paged = 1;
						$x = ($paged-1)*$view;
						for ($i = $x; $i < ($view*$paged); $i++) { 
							?>
							<tr id="subscriber-<?= $members[$i]['id'] ?>" class="iedit author-self level-0 post-<?= $members[$i]['id'] ?> status-publish hentry">
								<th scope="row" class="check-column">
									<label class="screen-reader-text" for="cb-select-<?= $members[$i]['id'] ?>">Elige suscriptor</label>
									<input id="cb-select-<?= $members[$i]['id'] ?>" type="checkbox" name="post[]" value="<?= $members[$i]['email_address'] ?>::<?= $list->id ?>">
									<div class="locked-indicator"></div>
								</th>
								<th scope="row" class="check-column-2" style="text-align: center;">
									<?php
									$gets = array();
									$temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
									foreach ($temps as $temp) {
										$args = explode('=', $temp);
										$gets[$args[0]] = $args[1];
									}
									$gets['email'] = $members[$i]['email_address'];
									$gets['list_id'] = $members[$i]['id'];
									if ($members[$i]['status'] == 'subscribed') {
										$gets['visibility'] = 0;
									?>
										<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}" ?>?<?= http_build_query($gets) ?>"><span class="dashicons dashicons-visibility"></span></a>
									<?php
									} else {
										$gets['visibility'] = 1;
									?>
										<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}" ?>?<?= http_build_query($gets) ?>"><span class="dashicons dashicons-hidden"></span></a>
									<?php
									}
									?>
								</th>
								<td class="date column-date" data-colname="Fecha">
									<?php
									$date = explode('-', explode('T', $members[$i]['timestamp_signup'])[0]);
									$months = array('01' => 'enero',
													'02' => 'febrero',
													'03' => 'marzo',
													'04' => 'abril',
													'05' => 'mayo',
													'06' => 'junio',
													'07' => 'julio',
													'08' => 'agosto',
													'09' => 'septiembre',
													'10' => 'octubre',
													'11' => 'noviembre',
													'12' => 'diciembre'
													);
									echo str_replace(',', '', $date[2]).' '.$months[$date[1]].' '.$date[0];
									?>
								</td>
								<td class="title column-email has-row-actions column-primary page-title" data-colname="Correo electrónico">
									<a class="row-email" href="mailto:<?= $members[$i]['email_address'] ?>"><?= $members[$i]['email_address'] ?></a>
								</td>
								<td class="name column-name" data-colname="Nombre">
									<?= $members[$i]['name'] ?>
								</td>
								<td class="list column-list" data-colname="Boletín de noticias">
									<?= $list->name ?> 
								</td>
								<td class="list column-list" data-colname="Estado">
									<?php
									switch ($members[$i]['status']) {
										case 'pending':
											echo 'Sin confirmar';
											break;
										case 'subscribed':
											echo 'Suscrito';
											break;
										case 'unsubscribed':
											echo 'Dado de baja';
											break;
										case 'cleaned':
											echo 'Baneado';
											break;
									}
									?>
								</td>
								<td style="text-align: center;">
									<?php
									$gets = array();
									$temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
									foreach ($temps as $temp) {
										$args = explode('=', $temp);
										$gets[$args[0]] = $args[1];
									}
									unset($gets['list_view']);
									$gets['delete'] = $members[$i]['email_address'];
									?>
									<a href="<?= 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}" ?>?<?= http_build_query($gets) ?>">
										<span class="dashicons dashicons-trash"></span>
									</a>
								</td>
							</tr>
							<?php
						}
					}
					?>
				</tbody>
			</table>
			<div class="tablenav bottom">
				<div class="alignleft actions bulkactions">
					<label for="bulk-action-selector-bottom" class="screen-reader-text">Selecciona acción en lote</label>
					<form action="" method="post" name="actions" id="form_actions">
						<select name="action2" id="bulk-action-selector-bottom">
							<option value="-1">Acciones en lote</option>
							<option value="delete" class="hide-if-no-js">Eliminar</option>
						</select>
						<input type="hidden" id="c_ids" name="c_ids" />
						<input type="submit" id="doaction2" class="button action" value="Aplicar" />
					</form>
					<script type="text/javascript">
						function update_checkboxes() {
							var all_checkboxes = [];
							jQuery('[name="post[]"]:checked').each(function() {
								all_checkboxes.push(jQuery(this).val());
							});
							jQuery('#c_ids').val(all_checkboxes.join(','));
						}
						jQuery(function() {
							jQuery('#cb-select-all-1').click(function() {
								if (this.checked) {
									jQuery('[name="post[]"]').each(function() {
										this.checked = true;                        
									});
								} else {
									jQuery('[name="post[]"]').each(function() {
										this.checked = false;                        
									});
								}
							});
							jQuery('[id*="cb-select"]').click(update_checkboxes);
							jQuery('#doaction2').click(function(event) {
								event.preventDefault();
								if (jQuery('#bulk-action-selector-bottom').val() != '-1') {
									switch (jQuery('#bulk-action-selector-bottom').val()) {
										case 'delete':
											update_checkboxes;
											jQuery('#form_actions').submit();
											break;
									}
								};
							});
						});
					</script>
				</div>
				<?php
				(isset($_GET['count'])) ? $view = $_GET['count'] : $view = 25;
				(isset($_GET['paged'])) ? $paged = $_GET['paged'] : $paged = 1;
				$total;
				foreach ($lists as $list) {
					if ($list->id == $c) {
						$total = $list->stats->member_count;
						$total_pages = ceil((int)$total/(int)$view);
					}
				}
				?>
				<div class="tablenav-pages">
					<span class="displaying-num"><?= $total ?> suscriptores</span>
							<span class="pagination-links">
								<?php
								$paged = (int)$paged;
								if ($paged <= 2) {
									echo '<span class="tablenav-pages-navspan" aria-hidden="true">«</span>';
								} else {
									$gets = array();
									$temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
									foreach ($temps as $temp) {
										$args = explode('=', $temp);
										$gets[$args[0]] = $args[1];
									}
									$gets['paged'] = 1;
									echo '<a class="first-page" href="http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}".'?'.http_build_query($gets).'"><span class="screen-reader-text">Primera página</span><span aria-hidden="true">«</span></a>';
								}
								echo '&nbsp;';
								if ($paged <= 1) {
									echo '<span class="tablenav-pages-navspan" aria-hidden="true">‹</span>';
								} else {
									$gets = array();
									$temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
									foreach ($temps as $temp) {
										$args = explode('=', $temp);
										$gets[$args[0]] = $args[1];
									}
									$gets['paged'] = $paged-1;
									echo '<a class="prev-page" href="http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}".'?'.http_build_query($gets).'"><span class="screen-reader-text">Página anterior</span><span aria-hidden="true">‹</span></a>';
								}
								?>
								<span class="screen-reader-text">Página actual</span>
								<span id="table-paging" class="paging-input">
									<span class="tablenav-paging-text"><?= $paged ?> de <span class="total-pages"><?= $total_pages ?></span></span>
								</span>
								<?php
								if ($paged >= $total_pages-1) {
									echo '<span class="tablenav-pages-navspan" aria-hidden="true">›</span>';
								} else {
									$gets = array();
									$temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
									foreach ($temps as $temp) {
										$args = explode('=', $temp);
										$gets[$args[0]] = $args[1];
									}
									$gets['paged'] = $paged+1;
									echo '<a class="next-page" href="http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}".'?'.http_build_query($gets).'"><span class="screen-reader-text">Página anterior</span><span aria-hidden="true">›</span></a>';
								}
								echo '&nbsp;';
								if ($paged >= $total_pages-2) {
									echo '<span class="tablenav-pages-navspan" aria-hidden="true">»</span>';
								} else {
									$gets = array();
									$temps = explode('&', explode('?', $_SERVER['REQUEST_URI'], 2)[1]);
									foreach ($temps as $temp) {
										$args = explode('=', $temp);
										$gets[$args[0]] = $args[1];
									}
									$gets['paged'] = $total_pages;
									echo '<a class="last-page" href="http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'."{$_SERVER['HTTP_HOST']}{$b_s_url}".'?'.http_build_query($gets).'"><span class="screen-reader-text">Última página</span><span aria-hidden="true">»</span></a>';
								}
								?>
							</span>
					</div>
					<br class="clear">
				</div>
		</div>
		<?php
		}
	}
}

?>