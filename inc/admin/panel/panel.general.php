<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

?>

<div class="main-info">
	<img src="<?php echo $var_dir.'/img/bilneador.png'; ?>" class="bilneador" />
	<div>
		<a target="_blank" rel="nofollow" href="http://bilnea.com" title="Web" class="fa-stack fa-lg" style="width: 1em; height: 1em; line-height: 1em; font-size: 1em; margin-right: 3px; text-decoration: none;">
			<i class="fa fa-square fa-stack-2x" style="font-size: 16px; line-height: 4px; color: #444;"></i>
			<i class="fa fa-globe fa-stack-1x" style="font-size: 10px; line-height: 5px; color: white; margin-left: 1px;"></i>
		</a>
		<a target="_blank" rel="nofollow" href="http://www.twitter.com/bilnea" title="Twitter">
			<i class="fa fa-twitter-square"></i>
		</a> 
		<a target="_blank" rel="nofollow" href="https://www.facebook.com/bilnea" title="Facebook">
			<i class="fa fa-facebook-square"></i>
		</a> 
		<a target="_blank" rel="nofollow" href="https://plus.google.com/u/0/b/104107449468243339016/104107449468243339016/posts" title="Google +">
			<i class="fa fa-google-plus-square"></i>
		</a> 
		<a target="_blank" rel="nofollow" href="http://www.linkedin.com/company/3047975?trk=tyah" title="Linkedin">
			<i class="fa fa-linkedin-square" ></i>
		</a> 
		<a target="_blank" rel="nofollow" href="http://www.youtube.com/user/bilneamarketing?sub_confirmation=1" title="Youtube">
			<i class="fa fa-youtube-square"></i>
		</a> 
		<a target="_blank" rel="nofollow" href="http://pinterest.com/bilnea/" title="Pinterest">
			<i class="fa fa-pinterest-square" ></i>
		</a>
		<br />
		&reg; 2016 bilnea. Versión <?= $b_g_version ?> (noviembre 2016).
		<br />
		<br />
		Todas las medidas se expresan en unidades css válidas de cada propiedad, definiendo la unidad empleada. En aquellos parámetros que no tengan definido un valor, se tomará el valor por defecto.
	</div>
</div>

<!-- Opciones generales -->
<h4>Opciones generales</h4>
<div class="general-options">
	<div style="width: 228px; display: inline-block;">Ancho exterior</div>
	<input style="text-align: right; margin-top: 0;" type="text" class="peq" name="bilnea_settings[b_opt_exterior-width]" value="<?= b_f_option('b_opt_exterior-width') ?>" placeholder="<?= b_f_default('b_opt_exterior-width') ?>">
	<br />
	<div style="width: 228px; display: inline-block;">Ancho interior</div>
	<input style="text-align: right;" type="text" class="peq" name="bilnea_settings[b_opt_interior-width]" value="<?= b_f_option('b_opt_interior-width') ?>" placeholder="<?= b_f_default('b_opt_interior-width') ?>">
	<br />
	<div style="width: 228px; display: inline-block;">Ancho barra lateral</div>
	<input style="text-align: right;" type="text" class="peq" name="bilnea_settings[b_opt_sidebar-width]" value="<?= b_f_option('b_opt_sidebar-width') ?>" placeholder="<?= b_f_default('b_opt_sidebar-width') ?>">
	<br />
	<div style="width: 228px; display: inline-block;">Alto cabecera</div>
	<input style="text-align: right;" type="text" class="peq" name="bilnea_settings[b_opt_header-height]" value="<?= b_f_option('b_opt_header-height') ?>" placeholder="<?= b_f_default('b_opt_header-height') ?>">
	<br />
	<div style="width: 228px; display: inline-block;">Alto menú</div>
	<input style="text-align: right;" type="text" class="peq" name="bilnea_settings[b_opt_menu-height]" value="<?= b_f_option('b_opt_menu-height') ?>" placeholder="<?= b_f_default('b_opt_menu-height') ?>">
	<br />
	<div style="width: 228px; display: inline-block;">Alto logotipo</div>
	<input style="text-align: right; margin-bottom: 0;" type="text" class="peq" name="bilnea_settings[b_opt_logo-height]" value="<?= b_f_option('b_opt_logo-height') ?>" placeholder="<?= b_f_default('b_opt_logo-height') ?>">
</div>
<div class="texto-color" id="back_color" style="display: inline-block; vertical-align: top; margin-right: 0px; padding-top: 0 !important;">
	Fondo de la página
	<br />
	<input type="text" class="color peq" name="bilnea_settings[b_opt_body_bg_color]" value="<?= b_f_option('b_opt_body_bg_color') ?>" placeholder="<?= b_f_default('b_opt_body_bg_color') ?>">
</div>
<hr style="margin-top: 8px;" />
<div style="width: 349px; display: inline-block;">Separación entre columnas y bloques de división</div>
<input style="text-align: right;" type="text" class="peq" name="bilnea_settings[b_opt_column_separator]" value="<?= b_f_option('b_opt_column_separator') ?>" placeholder="<?= b_f_default('b_opt_column_separator'); ?>">
<hr />
<input type="checkbox" name="bilnea_settings[b_opt_body-width]" <?php checked(b_f_option('b_opt_body-width'), 1 ); ?> value="1" class="disabler" data-connect="header-style" data-reverse>
<label for="bilnea_settings[b_opt_body-width]">Página encajada</label>
<em class="notice" style="font-size: 11px; line-height: 15px;">
	* Ancho exterior define el ancho de la caja contenedora. Ancho interior define el ancho del bloque interior.
</em>
<br />

<!-- Bloques principales -->
<div class="color-wrapper">
	Fondo barra superior
<div>
	<input type="text" class="sp-input" name="bilnea_settings[b_opt_topbar-color]" value="<?= b_f_option('b_opt_topbar-color') ?>" placeholder="<?= b_f_default('b_opt_topbar-color') ?>" />
	<input type="text" class="colora peq">
</div>
</div>
<div class="color-wrapper">
	Fondo cabecera
	<div>
		<input type="text" class="sp-input" name="bilnea_settings[b_opt_header-color]" value="<?= b_f_option('b_opt_header-color') ?>" placeholder="<?= b_f_default('b_opt_header-color') ?>" />
		<input type="text" class="colora peq">
	</div>
</div>
<div class="color-wrapper">
	Fondo cuerpo central
	<div>
		<input type="text" class="sp-input" name="bilnea_settings[b_opt_main-color]" value="<?= b_f_option('b_opt_main-color') ?>" placeholder="<?= b_f_default('b_opt_main-color') ?>" />
		<input type="text" class="colora peq">
	</div>
</div>
<div class="color-wrapper">
	Fondo pie de página
	<div>
		<input type="text" class="sp-input" name="bilnea_settings[b_opt_footer-color]" value="<?= b_f_option('b_opt_footer-color') ?>" placeholder="<?= b_f_default('b_opt_footer-color') ?>" />
		<input type="text" class="colora peq">
	</div>
</div>
<div class="color-wrapper">
	Fondo menú principal
	<div>
		<input type="text" class="sp-input" name="bilnea_settings[b_opt_menu-color]" value="<?= b_f_option('b_opt_menu-color') ?>" placeholder="<?= b_f_default('b_opt_menu-color') ?>" />
		<input type="text" class="colora peq">
	</div>
</div>
<div class="color-wrapper">
	Fondo elemento activo
	<div>
		<input type="text" class="sp-input" name="bilnea_settings[b_opt_active-color]" value="<?= b_f_option('b_opt_active-color') ?>" placeholder="<?= b_f_default('b_opt_active-color') ?>" />
		<input type="text" class="colora peq">
	</div>
</div>
<div class="color-wrapper">
	Fondo socket
	<div>
		<input type="text" class="sp-input" name="bilnea_settings[b_opt_socket-color]" value="<?= b_f_option('b_opt_socket-color') ?>" placeholder="<?= b_f_default('b_opt_socket-color') ?>" />
		<input type="text" class="colora peq">
	</div>
</div>
<div class="color-wrapper last" style="margin-bottom: 10px;">
	Fondo submenú
	<div>
		<input type="text" class="sp-input" name="bilnea_settings[b_opt_submenu-color]" value="<?= b_f_option('b_opt_submenu-color') ?>" placeholder="<?= b_f_default('b_opt_submenu-color') ?>" />
		<input type="text" class="colora peq">
	</div>
</div>

<!-- Redes sociales -->
<h4>Redes Sociales</h4>
<div id="admin-rrss">

	<?php

	$i = 1;

	$var_rrss = explode(',', b_f_option('b_opt_social-order'));
	foreach ($var_rrss as $temp_rrss) {
		($temp_rrss == 'snapchat') ? $icon = '-ghost' : $icon = '';
		($temp_rrss == 'google-plus' || $temp_rrss == 'youtube' || $temp_rrss == 'linkedin') ? $var_placeholder = 'url' : $var_placeholder = 'url o usuario';

		?>

		<div style="width: 100%; display: inline-block;" class="color-wrapper" id="<?= $temp_rrss ?>">
			<i class="fa fa-<?= $temp_rrss.$icon ?>"></i>
			<input type="text" class="gran" name="bilnea_settings[b_opt_social-<?= $temp_rrss ?>]" value="<?= b_f_option('b_opt_social-'.$temp_rrss) ?>" placeholder="<?= $var_placeholder ?>" />
			<div>
				<input type="text" class="sp-input" name="bilnea_settings[b_opt_social-<?= $temp_rrss ?>-color]" value="<?= b_f_option('b_opt_social-'.$temp_rrss.'-color') ?>" placeholder="<?= b_f_default('b_opt_social-'.$temp_rrss.'-color') ?>" />
				<input type="text" class="colora peq">
			</div>
		</div>

		<?php

	}

	?>

</div>
<input id="b_opt_social-order" type="hidden" name="bilnea_settings[b_opt_social-order]" value="<?= b_f_option('b_opt_social-order') ?>" />
<script>
	jQuery(function() {
		jQuery('#admin-rrss').sortable({
			update: function(event, ui) {
				var rrss_order = jQuery('#admin-rrss').sortable("toArray");
				jQuery('#b_opt_social-order').val(rrss_order);
			}
		});
		jQuery('#admin-rrss').disableSelection();
	});
</script>
					
<!-- Mejoras de seguridad -->
<h4>Seguridad</h4>
<input type="checkbox" name="bilnea_settings[b_opt_anticopy]" <?php checked(b_f_option('b_opt_anticopy'), 1); ?> value="1!">Activar protección anticopia
<hr />
Personalización de la url de acceso al panel
<br />
<label for="bilnea_settings[b_opt_wp-admin]"><?= get_site_url(); ?>/</label>
<input type="text" class="aurl" name="bilnea_settings[b_opt_wp-admin]" value="<?php b_f_option('b_opt_wp-admin'); ?>" placeholder="wp-admin">
<em class="notice" style="font-size: 11px; line-height: 15px;">¡IMPORTANTE! Recuerda guardar esta url. Será la nueva ruta de acceso al panel de administración de WordPress y el acceso wp-admin ya no funcionará.</em>