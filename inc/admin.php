<?php

// Creamos la función que llamará al selector de fuentes

require_once('fonts.php');

function b_f_fonts($fon) {
	$opt = get_option('bilnea_settings');
	?>
	<div style="display: inline-block; width: calc(100% - 256px);">
		Fuente tipográfica
		<select name='bilnea_settings[b_opt_<?= $fon ?>_ttf-font]' class="gran font-selector" style="margin-top: -2px; width: 100% !important;">
			<option disabled="disabled">Seleccionar</option>
			<?php
			global $fun;
			foreach ($fun as $fn1 => $fn2) {
				if ($opt['b_opt_'.$fon.'_ttf-font'] == '') {
					b_f_default()['b_opt_'.$fon.'_ttf-font'];
				} else {
					$fnt = $opt['b_opt_'.$fon.'_ttf-font'];
				}
			?>
				<option value='<?= $fn1 ?>' <?php selected($fnt, $fn1); ?> data="<?= join(',',$fn2['sizes']) ?>"><?= str_replace('+', ' ', $fn2['name']) ?></option>
			<?php
			}
			?>
		</select>
	</div>
	<div style="display: inline-block; width: 70px; margin-left: 8px;">
		Tamaño
		<input type='text' class="sp-input" name='bilnea_settings[b_opt_<?= $fon ?>_ttf-size]' value='<?php echo $opt['b_opt_'.$fon.'_ttf-size']; ?>' placeholder="<?= b_f_default()['b_opt_'.$fon.'_ttf-size']; ?>">
	</div>
	<div style="display: inline-block; width: 160px; position: relative; margin-left: 8px;">
		Color
		<input type="text" class="sp-input" name="bilnea_settings[b_opt_<?= $fon ?>_ttf-color]" value="<?php echo $opt['b_opt_'.$fon.'_ttf-color']; ?>" placeholder="<?= b_f_default()['b_opt_'.$fon.'_ttf-color']; ?>" />
		<input type="text" class="colora text peq">
	</div>
	<div class="font_styles" style="position: relative;">
		<div>Regular<br />Cursiva</div>
		<div><input type="radio" value="100" name="bilnea_settings[b_opt_<?= $fon ?>_ttf-style]" <?php checked( $opt['b_opt_'.$fon.'_ttf-style'], '100' ); ?> /><br /><input type="radio" value="100italic" name="bilnea_settings[b_opt_<?= $fon ?>_ttf-style]" /></div>
		<div><input type="radio" value="200" name="bilnea_settings[b_opt_<?= $fon ?>_ttf-style]" <?php checked( $opt['b_opt_'.$fon.'_ttf-style'], '200' ); ?> /><br /><input type="radio" value="200italic" name="bilnea_settings[b_opt_<?= $fon ?>_ttf-style]" /></div>
		<div><input type="radio" value="300" name="bilnea_settings[b_opt_<?= $fon ?>_ttf-style]" <?php checked( $opt['b_opt_'.$fon.'_ttf-style'], '300' ); ?> /><br /><input type="radio" value="300italic" name="bilnea_settings[b_opt_<?= $fon ?>_ttf-style]" /></div>
		<div><input type="radio" value="400" name="bilnea_settings[b_opt_<?= $fon ?>_ttf-style]" <?php checked( $opt['b_opt_'.$fon.'_ttf-style'], '400' ); ?> /><br /><input type="radio" value="400italic" name="bilnea_settings[b_opt_<?= $fon ?>_ttf-style]" /></div>
		<div><input type="radio" value="500" name="bilnea_settings[b_opt_<?= $fon ?>_ttf-style]" <?php checked( $opt['b_opt_'.$fon.'_ttf-style'], '500' ); ?> /><br /><input type="radio" value="500italic" name="bilnea_settings[b_opt_<?= $fon ?>_ttf-style]" /></div>
		<div><input type="radio" value="600" name="bilnea_settings[b_opt_<?= $fon ?>_ttf-style]" <?php checked( $opt['b_opt_'.$fon.'_ttf-style'], '600' ); ?> /><br /><input type="radio" value="600italic" name="bilnea_settings[b_opt_<?= $fon ?>_ttf-style]" /></div>
		<div><input type="radio" value="700" name="bilnea_settings[b_opt_<?= $fon ?>_ttf-style]" <?php checked( $opt['b_opt_'.$fon.'_ttf-style'], '700' ); ?> /><br /><input type="radio" value="700italic" name="bilnea_settings[b_opt_<?= $fon ?>_ttf-style]" /></div>
		<div><input type="radio" value="800" name="bilnea_settings[b_opt_<?= $fon ?>_ttf-style]" <?php checked( $opt['b_opt_'.$fon.'_ttf-style'], '800' ); ?> /><br /><input type="radio" value="800italic" name="bilnea_settings[b_opt_<?= $fon ?>_ttf-style]" /></div>
		<div><input type="radio" value="900" name="bilnea_settings[b_opt_<?= $fon ?>_ttf-style]" <?php checked( $opt['b_opt_'.$fon.'_ttf-style'], '900' ); ?> /><br /><input type="radio" value="900italic" name="bilnea_settings[b_opt_<?= $fon ?>_ttf-style]" /></div>
		<div class="notice font"><span style="font-family: 'Roboto'; font-weight: 100;">a</span> ... <span style="font-family: 'Roboto'; font-weight: 900;">a</span><br /><span style="font-family: 'Roboto'; font-weight: 100; font-style: italic;">a</span> ... <span style="font-family: 'Roboto'; font-weight: 900; font-style: italic;">a</span></div>
		<div style="width: auto; margin-left: 8px; font-size: 13px; margin-top: 2px; vertical-align: bottom; margin-bottom: -1px;">
			<input style="float: left; margin-top: 6px;" type='checkbox' name='bilnea_settings[b_opt_<?= $fon ?>_ttf-uppercase]' <?php checked( $opt['b_opt_'.$fon.'_ttf-uppercase'], 1 ); ?> value='1'>Mayúsculas
			<br />
			<input style="float: left; margin-top: 6px; margin-right: -2px;" type='checkbox' name='bilnea_settings[b_opt_<?= $fon ?>_ttf-underline]' <?php checked( $opt['b_opt_'.$fon.'_ttf-underline'], 1 ); ?> value='1'>Subrayado
		</div>
	</div>
	<?php
}

if (strpos($_SERVER['HTTP_REFERER'], 'page=bilnea') === false) {
	$options = get_option('bilnea_settings');
	$options['pestanya'] = 1;
	update_option('bilnea_settings', $options);
}


// Creamos la página de administración

function bilnea_options_page() { 

	$opt = get_option('bilnea_settings');
	$bil = get_template_directory_uri();

	?>

	<!-- Ficheros de script con las funciones javascript-->
	<script src="<?php echo esc_attr($bil.'/js/'); ?>spectrum.js"></script>
	<script type="text/javascript">
		var img_url = '<?php echo $bil; ?>/img/icono-imagen.png';
	</script>
	<script src="<?php echo esc_attr($bil.'/js/'); ?>admin.js"></script>

	<!-- Ficheros de estilos -->
	<link rel="stylesheet" href="<?php echo esc_attr($bil.'/css/'); ?>admin.css" />
	<link rel="stylesheet" href="<?php echo esc_attr($bil.'/css/'); ?>spectrum.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	
	<form action="options.php" method="post" id="bilnea">
		<h2>Opciones del tema</h2>
		<div id="bilset">

			<!-- Bloque lateral -->
			<div class="lateral">
				<h3 <?php if (!isset($opt['pestanya']) || $opt['pestanya'] == 1) { echo 'class="activo"'; }?>>Opciones Generales</h3>
				<h3 <?php if ($opt['pestanya'] == 2) { echo 'class="activo"'; }?>>Desarrollo</h3>
				<h3 <?php if ($opt['pestanya'] == 3) { echo 'class="activo"'; }?>>Estilos tipográficos</h3>
				<h3 <?php if ($opt['pestanya'] == 4) { echo 'class="activo"'; }?>>Adaptación responsive</h3>
				<h3 <?php if ($opt['pestanya'] == 5) { echo 'class="activo"'; }?>>Logotipo e iconos</h3>
				<h3 <?php if ($opt['pestanya'] == 6) { echo 'class="activo"'; }?>>Cabecera</h3>
				<h3 <?php if ($opt['pestanya'] == 7) { echo 'class="activo"'; }?>>Pie de página</h3>
				<h3 <?php if ($opt['pestanya'] == 8) { echo 'class="activo"'; }?>>Blog</h3>
				<?php
				if (function_exists('icl_object_id')) {
				?>
				<h3 <?php if ($opt['pestanya'] == 9) { echo 'class="activo"'; }?>>Multidioma</h3>
				<?php
				}
				?>
				<h3 <?php if ($opt['pestanya'] == 10) { echo 'class="activo"'; }?>>Textos legales</h3>
			</div>

			<!-- Bloque central -->
			<div class="central">

				<!-- Opciones Generales -->
				<div <?php if (!isset($opt['pestanya']) || $opt['pestanya'] == 1) { echo 'class="activo"'; }?> id="tab1">
					<div class="main-info">
						<img src="<?php echo $bil.'/img/bilneador.png'; ?>" style="max-width: 300px; margin: auto; display: block;" />
						<div style="text-align: center; margin-bottom: 20px; font-size: 11px; font-style: italic; line-height: 15px;">
							<a target="_blank" rel="nofollow" href="http://bilnea.com" title="Web" class="fa-stack fa-lg" style="width: 1em; height: 1em; line-height: 1em; font-size: 1em; margin-right: 3px; text-decoration: none;">
								<i class="fa fa-square fa-stack-2x" style="font-size: 16px; line-height: 4px; color: #444;"></i>
								<i class="fa fa-globe fa-stack-1x" style="font-size: 10px; line-height: 5px; color: white; margin-left: 1px;"></i>
							</a>
							<a target="_blank" rel="nofollow" href="http://www.twitter.com/bilnea" title="Twitter"><i class="fa fa-twitter-square" style="color: #444; font-size: 16px; margin-bottom: 8px;"></i></a> 
							<a target="_blank" rel="nofollow" href="https://www.facebook.com/bilnea" title="Facebook"><i class="fa fa-facebook-square" style="color: #444; font-size: 16px; margin-bottom: 8px;"></i></a> 
							<a target="_blank" rel="nofollow" href="https://plus.google.com/u/0/b/104107449468243339016/104107449468243339016/posts" title="Google +"><i class="fa fa-google-plus-square" style="color: #444; font-size: 16px; margin-bottom: 8px;"></i></a> 
							<a target="_blank" rel="nofollow" href="http://www.linkedin.com/company/3047975?trk=tyah" title="Linkedin"><i class="fa fa-linkedin-square" style="color: #444; font-size: 16px; margin-bottom: 8px;"></i></a> 
							<a target="_blank" rel="nofollow" href="http://www.youtube.com/user/bilneamarketing?sub_confirmation=1" title="Youtube"><i class="fa fa-youtube-square" style="color: #444; font-size: 16px; margin-bottom: 8px;"></i></a> 
							<a target="_blank" rel="nofollow" href="http://pinterest.com/bilnea/" title="Pinterest"><i class="fa fa-pinterest-square" style="color: #444; font-size: 16px; margin-bottom: 8px;"></i></a>
							<br />
							&reg; 2016 bilnea. Versión 2.0 (junio 2016).
							<br /><br />
							Todas las medidas se expresan en unidades css válidas de cada propiedad, definiendo la unidad empleada. Los colores se expresan en formato hexadecimal. En aquellos parámetros que no tengan definido un valor, se tomará el valor por defecto.
						</div>
					</div>

					<h4>Opciones generales</h4>
					<div style="display: inline-block; border-right: 1px solid #eee; padding-right: 5px; margin-right: 8px;">
						<div style="width: 228px; display: inline-block;">Ancho exterior</div>
						<input style="text-align: right;" type='text' class="peq" name='bilnea_settings[b_opt_exterior-width]' value='<?php echo $opt['b_opt_exterior-width']; ?>' placeholder="<?= b_f_default()['b_opt_exterior-width']; ?>">
						<br />
						<div style="width: 228px; display: inline-block;">Ancho interior</div>
						<input style="text-align: right;" type='text' class="peq" name='bilnea_settings[b_opt_interior-width]' value='<?php echo $opt['b_opt_interior-width']; ?>' placeholder="<?= b_f_default()['b_opt_interior-width']; ?>">
						<br />
						<div style="width: 228px; display: inline-block;">Ancho barra lateral</div>
						<input style="text-align: right;" type='text' class="peq" name='bilnea_settings[b_opt_sidebar-width]' value='<?php echo $opt['b_opt_sidebar-width']; ?>' placeholder="<?= b_f_default()['b_opt_sidebar-width']; ?>">
						<br />
						<div style="width: 228px; display: inline-block;">Alto cabecera</div>
						<input style="text-align: right;" type='text' class="peq" name='bilnea_settings[b_opt_header-height]' value='<?php echo $opt['b_opt_header-height']; ?>' placeholder="<?= b_f_default()['b_opt_header-height']; ?>">
						<br />
						<div style="width: 228px; display: inline-block;">Alto menú</div>
						<input style="text-align: right;" type='text' class="peq" name='bilnea_settings[b_opt_menu-height]' value='<?php echo $opt['b_opt_menu-height']; ?>' placeholder="<?= b_f_default()['b_opt_menu-height']; ?>">
						<br />
						<div style="width: 228px; display: inline-block;">Alto logotipo</div>
						<input style="text-align: right;" type='text' class="peq" name='bilnea_settings[b_opt_logo-height]' value='<?php echo $opt['b_opt_logo-height']; ?>' placeholder="<?= b_f_default()['b_opt_logo-height']; ?>">
					</div>
					<div class="texto-color" id="back_color" style="display: inline-block; vertical-align: top; margin-right: 0px;">
						Fondo de la página
						<br />
						<input type='text' class="color peq" name='bilnea_settings[b_opt_body_bg_color]' value='<?php echo $opt['b_opt_body_bg_color']; ?>' placeholder="<?= b_f_default()['b_opt_body_bg_color']; ?>">
					</div>
					<hr />
					<div style="width: 349px; display: inline-block;">Separación entre columnas y bloques de división</div>
					<input style="text-align: right;" type='text' class="peq" name='bilnea_settings[b_opt_column_separator]' value='<?php echo $opt['b_opt_column_separator']; ?>' placeholder="<?= b_f_default()['b_opt_column_separator']; ?>">
					<hr />
					<input type='checkbox' name='bilnea_settings[b_opt_body-width]' <?php checked( $opt['b_opt_body-width'], 1 ); ?> value='1'>
					<label for='bilnea_settings[b_opt_body-width]'>Página encajada</label>
					<hr />
					<em style="font-size: 11px; color: #333; line-height: 15px; display: block;">
						* Ancho exterior define el ancho de la caja contenedora. Ancho interior define el ancho del bloque interior.
					</em>
					<br />
					<h4>Colores</h4>

					<!-- Bloques principales -->
					<div class="color-wrapper">
						Fondo barra superior
						<div>
							<input type="text" class="sp-input" name="bilnea_settings[b_opt_topbar-color]" value="<?php echo $opt['b_opt_topbar-color']; ?>" placeholder="<?= b_f_default()['b_opt_topbar-color']; ?>" />
							<input type="text" class="colora peq">
						</div>
					</div>
					<div class="color-wrapper">
						Fondo cabecera
						<div>
							<input type="text" class="sp-input" name="bilnea_settings[b_opt_header-color]" value="<?php echo $opt['b_opt_header-color']; ?>" placeholder="<?= b_f_default()['b_opt_header-color']; ?>" />
							<input type="text" class="colora peq">
						</div>
					</div>
					<div class="color-wrapper">
						Fondo cuerpo central
						<div>
							<input type="text" class="sp-input" name="bilnea_settings[b_opt_main-color]" value="<?php echo $opt['b_opt_main-color']; ?>" placeholder="<?= b_f_default()['b_opt_main-color']; ?>" />
							<input type="text" class="colora peq">
						</div>
					</div>
					<div class="color-wrapper">
						Fondo pie de página
						<div>
							<input type="text" class="sp-input" name="bilnea_settings[b_opt_footer-color]" value="<?php echo $opt['b_opt_footer-color']; ?>" placeholder="<?= b_f_default()['b_opt_footer-color']; ?>" />
							<input type="text" class="colora peq">
						</div>
					</div>
					<div class="color-wrapper">
						Fondo menú principal
						<div>
							<input type="text" class="sp-input" name="bilnea_settings[b_opt_menu-color]" value="<?php echo $opt['b_opt_menu-color']; ?>" placeholder="<?= b_f_default()['b_opt_menu-color']; ?>" />
							<input type="text" class="colora peq">
						</div>
					</div>
					<div class="color-wrapper">
						Fondo elemento activo
						<div>
							<input type="text" class="sp-input" name="bilnea_settings[b_opt_active-color]" value="<?php echo $opt['b_opt_active-color']; ?>" placeholder="<?= b_f_default()['b_opt_active-color']; ?>" />
							<input type="text" class="colora peq">
						</div>
					</div>
					<div class="color-wrapper">
						Fondo socket
						<div>
							<input type="text" class="sp-input" name="bilnea_settings[b_opt_socket-color]" value="<?php echo $opt['b_opt_socket-color']; ?>" placeholder="<?= b_f_default()['b_opt_socket-color']; ?>" />
							<input type="text" class="colora peq">
						</div>
					</div>
					<div class="color-wrapper last">
						Fondo submenú
						<div>
							<input type="text" class="sp-input" name="bilnea_settings[b_opt_submenu-color]" value="<?php echo $opt['b_opt_submenu-color']; ?>" placeholder="<?= b_f_default()['b_opt_submenu-color']; ?>" />
							<input type="text" class="colora peq">
						</div>
					</div>
	
					<!-- Redes sociales -->
					<br />
					<h4>Redes Sociales</h4>
					<div style="width: 213px; display: inline-block;">Facebook</div>
					<input type='text' class="gran" name='bilnea_settings[b_opt_social-facebook]' value='<?php echo $opt['b_opt_social-facebook']; ?>' placeholder="url o usuario">
					<br />
					<div style="width: 213px; display: inline-block;">Twitter</div>
					<input type='text' class="gran" name='bilnea_settings[b_opt_social-twitter]' value='<?php echo $opt['b_opt_social-twitter']; ?>' placeholder="url o usuario">
					<br />
					<div style="width: 213px; display: inline-block;">Google+</div>
					<input type='text' class="gran" name='bilnea_settings[b_opt_social-google-plus]' value='<?php echo $opt['b_opt_social-google-plus']; ?>' placeholder="url">
					<br />
					<div style="width: 213px; display: inline-block;">Youtube</div>
					<input type='text' class="gran" name='bilnea_settings[b_opt_social-youtube]' value='<?php echo $opt['b_opt_social-youtube']; ?>' placeholder="url">
					<br />
					<div style="width: 213px; display: inline-block;">Linkedin</div>
					<input type='text' class="gran" name='bilnea_settings[b_opt_social-linkedin]' value='<?php echo $opt['b_opt_social-linkedin']; ?>' placeholder="url">
					<br />
					<div style="width: 213px; display: inline-block;">Instagram</div>
					<input type='text' class="gran" name='bilnea_settings[b_opt_social-instagram]' value='<?php echo $opt['b_opt_social-instagram']; ?>' placeholder="url o usuario">
					<br />
					<div style="width: 213px; display: inline-block;">Pinterest</div>
					<input type='text' class="gran" name='bilnea_settings[b_opt_social-pinterest]' value='<?php echo $opt['b_opt_social-pinterest']; ?>' placeholder="url o usuario">
					<br /><br />
					
					<!-- Mejoras de seguridad -->
					<h4>Seguridad</h4>
					<input type='checkbox' name='bilnea_settings[b_opt_anticopy]' <?php checked( $opt['b_opt_anticopy'], 1 ); ?> value='1'>Activar protección anticopia
					<br />
					<input type='checkbox' name='bilnea_settings[b_opt_antibot]' <?php checked( $opt['b_opt_antibot'], 1 ); ?> value='1'>Protección antibot en formulario de comentarios del blog
					<hr />
					Personalización de la url de acceso al panel
					<br />
					<label for='bilnea_settings[b_opt_wp-admin]'><?php echo get_site_url(); ?>/</label>
					<input type='text' class="aurl" name='bilnea_settings[b_opt_wp-admin]' value='<?php echo $opt['b_opt_wp-admin']; ?>' placeholder="wp-admin">
					<em class="notice" style="font-size: 11px; line-height: 15px;">¡IMPORTANTE! Recuerda guardar esta url. Será la nueva ruta de acceso al panel de administración de WordPress y el acceso wp-admin ya no funcionará.</em>
				</div>

				<!-- Opciones Generales -->
				<div <?php if ($opt['pestanya'] == 2) { echo 'class="activo"'; }?> id="tab2">
					<!-- Formulario de contacto -->
					<h4>Formulario de contacto y envío de correo</h4>
					<div style="overflow: hidden;">
						<div style="width: calc(50% - 7px); display: inline-block; float: left; margin-right: 14px;">
							Correo electrónico de destino
							<input type="text" class="gran" style="width: 100%;" name="bilnea_settings[b_opt_form-email]" value="<?php echo $opt['b_opt_form-email']; ?>" placeholder="<?= b_f_default()['b_opt_form-email']; ?>" />
						</div>
						<div style="width: calc(50% - 7px); display: inline-block;">
							Página de redirección al enviar
							<select name='bilnea_settings[b_opt_form-thanks]' class="gran" style="margin-top: -4px; width: 100%; margin-bottom: 0;">
								<option selected disabled>Selecciona una página</option>
								<option value="none" <?php selected($opt['b_opt_form-thanks'], 'none') ?>>Sin redirección</option>
								<option disabled>----------</option>
								<?php $args = array(
									'sort_order' => 'asc',
									'sort_column' => 'post_title',
									'post_type' => 'page',
									'post_status' => 'publish'
								); 
								$pages = get_pages($args);
								foreach ($pages as $page) {
									echo '<option value="'.$page->ID.'" '.selected($opt['b_opt_form-thanks'], $page->ID).'>'.$page->post_title.'</option>';
								}
								?>
							</select>
						</div>
					</div>
					<hr style="margin-bottom: 4px;" />
					<input type='checkbox' name='bilnea_settings[b_opt_smtp]' <?php checked( $opt['b_opt_smtp'], 1 ); ?> value='1'>Envío de emails a través de SMTP
					<hr style="margin-bottom: 4px;" />
					<div style="width: 213px; display: inline-block;">Servidor SMTP</div>
					<input type='text' class="gran" name='bilnea_settings[b_opt_smtp-server]' value='<?php echo $opt['b_opt_smtp-server']; ?>' />
					<br />
					<div style="width: 213px; display: inline-block;">Usuario</div>
					<input type='text' class="gran" name='bilnea_settings[b_opt_smtp-user]' value='<?php echo $opt['b_opt_smtp-user']; ?>' />
					<br />
					<div style="width: 213px; display: inline-block;">Contraseña</div>
					<input type='text' class="gran" name='bilnea_settings[b_opt_smtp-pass]' value='<?php echo $opt['b_opt_smtp-pass']; ?>' />
					<br />
					<br />

					<!-- Suscriptores -->
					<h4>Boletín de noticias</h4>
					<input type='checkbox' name='bilnea_settings[b_opt_subscribers]' <?php checked( $opt['b_opt_subscribers'], 1 ); ?> value='1'>Activar módulo de boletín de noticias<br />
					<hr />
					<div style="overflow: hidden;">
						<div style="width: calc(33.3333% - 10px); display: inline-block; margin-right: 14px; float: left;">
							<select name='bilnea_settings[b_opt_newsl_service]' class="gran" style="margin-top: -4px; width: 100%; margin-bottom: 0;">
								<option selected disabled>Selecciona un servicio</option>
								<option value="wordpress" <?php selected($opt['b_opt_newsl_service'], 'wordpress') ?>>Wordpress</option>
								<option value="benchmark" <?php selected($opt['b_opt_newsl_service'], 'benchmark') ?>>Benchmark</option>
							</select>
						</div>
						<div style="width: calc(33.3333% - 9px); display: inline-block; float: left; margin-right: 14px;">
							<input type="text" class="gran" style="width: 100%;" name="bilnea_settings[b_opt_newsl_username]" value="<?php echo $opt['b_opt_newsl_username']; ?>" placeholder="Usuario" />
						</div>
						<div style="width: calc(33.3333% - 9px); display: inline-block;">
							<input type="password" class="gran" style="width: 100%;" name="bilnea_settings[b_opt_newsl_password]" value="<?php echo $opt['b_opt_newsl_password']; ?>" placeholder="Contraseña" />
						</div>
					</div>
					<div class="notice" style="font-size: 11px; line-height: 15px; display: block !important;">Crea un listado de suscriptores que se recolecten desde los formularios presentes en la web. Activa los shortcodes relacionados con esta funcionalidad.</div>
					<br />

					<!-- API Keys -->
					<h4>API Keys</h4>
					<div>Google Maps</div>
					<div>
						<input type="text" class="gran" style="width: 100%;" name="bilnea_settings[b_opt_apis_gmaps]" value="<?php echo $opt['b_opt_apis_gmaps']; ?>" placeholder="API Key" />
					</div>
					<br />

					<!-- Precarga -->
					<h4>Precarga</h4>
					<input type='checkbox' name='bilnea_settings[b_opt_loader]' <?php checked( $opt['b_opt_loader'], 1 ); ?> value='1'>Activar módulo de precarga<br />
					<div class="notice" style="font-size: 11px; line-height: 15px; display: block !important;">Activa un elemento flotante que desaparecerá una vez terminada la carga de la página. Este elemento se puede modificar editando el archivo 'loader.php'.</div>
					<br />

					<!-- Lightbox -->
					<h4>Lightbox</h4>
					<input type='checkbox' name='bilnea_settings[b_opt_lightbox]' <?php checked( $opt['b_opt_lightbox'], 1 ); ?> value='1'>Activar lightbox<br />
					<div style="display: inline-block;">
						<input type='radio' name='bilnea_settings[b_opt_lightbox-location]' <?php checked( $opt['b_opt_lightbox-location'], 1 ); ?> value='1'>Para todas las imágenes y elementos multimedia
					</div>
					<br />
					<div style="display: inline-block;">
						<input type='radio' name='bilnea_settings[b_opt_lightbox-location]' <?php checked( $opt['b_opt_lightbox-location'], 2 ); ?> value='2'>Bajo demanda (a través de shortcode)
					</div>
					<br />

					<!-- hyphenator -->
					<h4 style="margin-top: 10px;">Legibilidad</h4>
					<input type='checkbox' name='bilnea_settings[b_opt_hyphenator]' <?php checked( $opt['b_opt_hyphenator'], 1 ); ?> value='1'>Activar hyphenator *<br />
					Clase CSS sobre la que se actuará
					<input type="text" class="gran" style="width: 100%;" name="bilnea_settings[b_opt_hyphenator-selector]" value="<?php echo $opt['b_opt_hyphenator-selector']; ?>" placeholder="<?php echo b_f_default()['b_opt_hyphenator-selector']; ?>" />
					<div class="notice" style="font-size: 11px; line-height: 15px; display: block !important;">* Separa sílabas de manera automática en los saltos de línea para ajustar el párrafo al ancho del elemento contenedor.</div>


					<!-- Scripts -->
					<h4 style="margin-top: 10px;">Tecnologías de terceros</h4>
					<input type='checkbox' name='bilnea_settings[b_opt_jquery-ui]' <?php checked( $opt['b_opt_jquery-ui'], 1 ); ?> value='1'>Activar jQuery UI<br />
					<input type='checkbox' name='bilnea_settings[b_opt_jquery-mobile]' <?php checked( $opt['b_opt_jquery-mobile'], 1 ); ?> value='1'>Activar jQuery mobile<br />
					<input type='checkbox' name='bilnea_settings[b_opt_jquery-mobile-css]' <?php checked( $opt['b_opt_jquery-mobile-css'], 1 ); ?> value='1'>Activar estilos visuales de jQuery mobile<br />
					<input type='checkbox' name='bilnea_settings[b_opt_select2]' <?php checked( $opt['b_opt_select2'], 1 ); ?> value='1'>Activar Select2
					<br />
					Gestión de usuarios
					<select>
						
					</select>
					<!-- Mantenimiento -->
					<h4 style="margin-top: 10px;">Mantenimiento</h4>
					<input type='checkbox' name='bilnea_settings[b_opt_construction]' <?php checked( $opt['b_opt_construction'], 1 ); ?> value='1'>Activar modo mantenimiento
					<em class="notice" style="font-size: 11px; line-height: 15px; display: block !important;">
						La página de mantenimiento se puede personalizar editando los archivos 'index.html' y 'main.css' ubicados en la carpeta 'tmp' del tema activo.<br />Para acceder a la web, utiliza la url <?php echo get_site_url(); ?>/?key=bilnea
					</em>

				</div>

				<!-- Estilos tipográficos -->
				<div <?php if ($opt['pestanya'] == 3) { echo 'class="activo"'; }?> id="tab3">
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
							$tmp = str_replace('b_opt_', '', split('ttf-', $oti)[0]);
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
						global $fun;
						if ($idx > 0) {
							echo '<hr />';
						}
						$idx++;
					?>
					<fieldset class="text-container">
						<strong><?php echo str_replace('+', ' ', $fun[$key]['name']); ?></strong>
						<div class="font_styles" style="position: relative;">
							<div>Regular<br />Cursiva</div>
								<?php
								if ($opt['b_opt_custom-font'] == null) {
									$opt['b_opt_custom-font'] = array();
								}
								for ($i = 1; $i < 10; $i++) {
									$j = $i*100;
									$dsb = ''; $ckc = '';
									if (!in_array($j, $fun[$key]['sizes'])) {
										$dsb = ' disabled';
									}
									if (in_array($j, $value)) {
										$ckc = ' checked';
									}
								?>
								<div>
								<input type="checkbox" value="<?= $fun[$key]['name'].'|'.$j ?>"<?= $dsb ?><?= $ckc ?> <?php checked(in_array($fun[$key]['name'].'|'.$j, $opt['b_opt_custom-font'])); ?> name="bilnea_settings[b_opt_custom-font][]"><br />
								<?php
									$j = $j.'italic';
									$dsb = ''; $ckc = '';
									if (!in_array($j, $fun[$key]['sizes'])) {
										$dsb = ' disabled';
									}
									if (in_array($j, $value)) {
										$ckc = ' checked';
									}
								?>
								<input type="checkbox" value="<?= $fun[$key]['name'].'|'.$j ?>"<?= $dsb ?><?= $ckc ?> <?php checked(in_array($fun[$key]['name'].'|'.$j, $opt['b_opt_custom-font'])); ?> name="bilnea_settings[b_opt_custom-font][]">
								</div>
							<?php
							}
							?>
							<div class="notice font"><span style="font-family: 'Roboto'; font-weight: 100;">a</span> ... <span style="font-family: 'Roboto'; font-weight: 900;">a</span><br /><span style="font-family: 'Roboto'; font-weight: 100; font-style: italic;">a</span> ... <span style="font-family: 'Roboto'; font-weight: 900; font-style: italic;">a</span></div>
							<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=<?php echo $fun[$key]['name']; ?>">
							<div style="vertical-align: top; font-size: 30px; display: inline-block; line-height: 52px; width: 170px; font-family: '<?php echo str_replace('+', ' ', $fun[$key]['name']); ?>';">AaBbCc</div>
						</div>
					</fieldset>
					<?php
					}
					?>

				</div>

				<!-- Adaptación responsive -->
				<div <?php if ($opt['pestanya'] == 4) { echo 'class="activo"'; }?> id="tab4">
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
				<div <?php if ($opt['pestanya'] == 5) { echo 'class="activo"'; }?> id="tab5">
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
				<div <?php if ($opt['pestanya'] == 6) { echo 'class="activo"'; }?> id="tab6">
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
					<input type='checkbox' name='bilnea_settings[b_opt_menu-top-bar]' <?php checked( $opt['menu-top-bar'], 1 ); ?> value='1'> <span>Incluir menú en barra superior</span>
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
				<div <?php if ($opt['pestanya'] == 7) { echo 'class="activo"'; }?> id="cent3">
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
				<div id="tab7" <?php if ($opt['pestanya'] == 8) { echo 'class="activo"'; }?>>
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
				<div <?php if ($opt['pestanya'] == 9) { echo 'class="activo"'; }?> id="tab8">
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
				<div id="tab9" <?php if ($opt['pestanya'] == 10) { echo 'class="activo"'; }?>>
					<h4>Configuración general</h4>
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
						<input type="text" id="user_email" class="gran" name='bilnea_settings[user_email]' style="width: 100%;" value='<?php echo $opt['user_email']; ?>' placeholder='<?= b_f_default()['user_email']; ?>'>
					</div>
					<div style="width: calc(50% - 10px); display: inline-block;">
						Teléfono
						<br />
						<input type="text" id="user_phone" class="gran" name='bilnea_settings[user_phone]' style="width: 100%;" value='<?php echo $opt['user_phone']; ?>'>
					</div>
					Dirección postal
					<br />
					<input type="text" id="user_address" class="gran" name='bilnea_settings[user_address]' style="width: 100%;" value='<?php echo $opt['user_address']; ?>'>
					<br />
					<h4 style="margin-top: 10px;">Aviso legal</h4>
					<input type='checkbox' name='bilnea_settings[b_opt_create-legal-page]' <?php checked( $opt['b_opt_create-legal-page'], 1 ); ?> value='1'> <span>Crear página de aviso legal</span>
					<?php
					if (function_exists('icl_object_id')) {
						global $sitepress;
						$clg = $sitepress->get_current_language();
						$sitepress->switch_lang('es');
						$lng = icl_get_languages('skip_missing=0&orderby=code');
						if (!empty($lng)) {
							$int = 0;
							?>
							<div class="notice" style="font-size: 12px;">
								<?php
								foreach ($lng as $l) {
									if ($int > 0) { echo '<hr />'; }
									?>
									Url de aviso legal en <?= strtolower($l['translated_name']); ?> <em>(en blanco no muestra enlace)</em>
									<br />
									<label for="bilnea_settings[b_opt_legal-url-_<?= $l['language_code']?>]"><?php echo $sitepress->language_url($l['language_code']); ?></label>
									<input style="font-size: 12px; -webkit-transform: translate(-5px, 1px); -moz-transform: translate(-5px, 1px); -ms-transform: translate(-5px, 1px); -o-transform: translate(-5px, 1px); transform: translate(-5px, 1px);" type='text' class="aurl" name='bilnea_settings[b_opt_legal-url-_<?= $l['language_code']?>]' value='<?php echo $opt['b_opt_legal-url-_'.$l['language_code']]; ?>'>
									<?php
									$int++;
								}
								?>
							</div>
						<?php
						}
						$sitepress->switch_lang($clg);
					} else {
						?>
						<div class="notice" style="font-size: 12px;">
							Url de aviso legal <em>(en blanco no muestra enlace)</em>
							<br />
							<label for="bilnea_settings[b_opt_legal-url-_es"><?php echo get_site_url(); ?>/</label>
							<input type='text' class="aurl" name='bilnea_settings[b_opt_legal-url-_es]' value='<?php echo $opt['b_opt_legal-url-_es']; ?>'>
						</div>
						<?php
					}
					?>
					<h4 style="margin-top: 10px;">Política de privacidad</h4>
					<input type='checkbox' name='bilnea_settings[b_opt_create-privacy-page]' <?php checked( $opt['b_opt_create-privacy-page'], 1 ); ?> value='1'> <span>Crear página de política de privacidad</span>
					<?php
					if (function_exists('icl_object_id')) {
						global $sitepress;
						$clg = $sitepress->get_current_language();
						$sitepress->switch_lang('es');
						$lng = icl_get_languages('skip_missing=0&orderby=code');
						if (!empty($lng)) {
							$int = 0;
							?>
							<div class="notice" style="font-size: 12px;">
								<?php
								foreach ($lng as $l) {
									if ($int > 0) { echo '<hr />'; }
									?>
									Url de política de privacidad en <?= strtolower($l['translated_name']); ?> <em>(en blanco no muestra enlace)</em>
									<br />
									<label for="bilnea_settings[b_opt_privacy-url-_<?= $l['language_code']?>]"><?php echo $sitepress->language_url($l['language_code']); ?></label>
									<input style="font-size: 12px; -webkit-transform: translate(-5px, 1px); -moz-transform: translate(-5px, 1px); -ms-transform: translate(-5px, 1px); -o-transform: translate(-5px, 1px); transform: translate(-5px, 1px);" type='text' class="aurl" name='bilnea_settings[b_opt_privacy-url-_<?= $l['language_code']?>]' value='<?php echo $opt['b_opt_privacy-url-_'.$l['language_code']]; ?>'>
									<?php
									$int++;
								}
								?>
							</div>
						<?php
						}
						$sitepress->switch_lang($clg);
					} else {
						?>
						<div class="notice" style="font-size: 12px;">
							Url de política de privacidad <em>(en blanco no muestra enlace)</em>
							<br />
							<label for="bilnea_settings[b_opt_privacy-url-_es]"><?php echo get_site_url(); ?>/</label>
							<input type='text' class="aurl" name='bilnea_settings[b_opt_privacy-url-_es]' value='<?php echo $opt['b_opt_privacy-url-_es']; ?>'>
						</div>
						<?php
					}
					?>
					<h4 style="margin-top: 10px;">Política de cookies</h4>
					<input type='checkbox' name='bilnea_settings[b_opt_create-cookies-page]' <?php checked($opt['b_opt_create-cookies-page'], 1); ?> value='1'> <span>Crear página de política de cookies</span>
					<br />
					<input type='checkbox' name='bilnea_settings[b_opt_create-cookies-table]' <?php checked($opt['b_opt_create-cookies-table'], 1); ?> value='1'> <span>Generar tabla de cookies de manera automática</span>
					<hr />
					<input type='checkbox' name='bilnea_settings[b_opt_cookies-warning]' <?php checked($opt['b_opt_cookies-warning'], 1); ?> value='1'> <span>Mostrar el aviso legal de cookies</span>
					<div style="display: block;" class="child">
						<input type='radio' name='bilnea_settings[b_opt_show-cookies]' <?php checked($opt['b_opt_show-cookies'], 1); ?> value='1'><span>Mostrar en la zona superior</span>
						<br />
						<input type='radio' name='bilnea_settings[b_opt_show-cookies]' <?php checked($opt['b_opt_show-cookies'], 2); ?> value='2'><span>Mostrar en la zona inferior</span>
					</div>
					<?php
					if (function_exists('icl_object_id')) {
						global $sitepress;
						$clg = $sitepress->get_current_language();
						$sitepress->switch_lang('es');
						$lng = icl_get_languages('skip_missing=0&orderby=code');
						if (!empty($lng)) {
							$int = 0;
							?>
							<div class="notice" style="font-size: 12px;">
								<?php
								foreach ($lng as $l) {
									if ($int > 0) { echo '<hr />'; }
									?>
									Url de política de cookies en <?= strtolower($l['translated_name']); ?> <em>(en blanco no muestra enlace)</em>
									<br />
									<label for="bilnea_settings[b_opt_legal-url-_<?= $l['language_code']?>]"><?php echo $sitepress->language_url($l['language_code']); ?></label>
									<input style="font-size: 12px; -webkit-transform: translate(-5px, 1px); -moz-transform: translate(-5px, 1px); -ms-transform: translate(-5px, 1px); -o-transform: translate(-5px, 1px); transform: translate(-5px, 1px);" type='text' class="aurl" name='bilnea_settings[b_opt_legal-url-_<?= $l['language_code']?>]' value='<?php echo $opt['b_opt_legal-url-_'.$l['language_code']]; ?>'>
									<?php
									$int++;
								}
								?>
							</div>
						<?php
						}
						$sitepress->switch_lang($clg);
					} else {
						?>
						<div class="notice" style="font-size: 12px;">
							Url de política de cookies <em>(en blanco no muestra enlace)</em>
							<br />
							<label for="bilnea_settings[b_opt_legal-url-_es"><?php echo get_site_url(); ?>/</label>
							<input type='text' class="aurl" name='bilnea_settings[b_opt_legal-url-_es]' value='<?php echo $opt['b_opt_legal-url-_es']; ?>'>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		</div>
		<input type="hidden" id="pestanya" name='bilnea_settings[pestanya]' value='<?php echo $opt['pestanya']; ?>'>
		
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
				<ul class="subsubsub">
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
	}
}

?>