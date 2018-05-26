<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

?>

<div class="main-info">

	<?php

	if (date('md') >= '1220' && date('md') <= '1231') {
		include 'xtras/data.xmas.php';
	} else {
		?>
		<img src="<?php echo $var_dir.'/img/bilneador.png'; ?>" class="bilneador" />
		<?php
	}

	?>

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
		&reg; <?= date('Y') ?> bilnea. Versión <?= $b_g_version ?> (enero 2018).
		<br />
		<br />
		Todas las medidas se expresan en unidades css válidas de cada propiedad, definiendo la unidad empleada. En aquellos parámetros que no tengan definido un valor, se tomará el valor por defecto.
	</div>
</div>


<!-- Opciones generales -->

<h4 data-type="title">Opciones generales</h4>

<div data-type="block">
	Ancho cuerpo central
	<input data-type="input" data-size="33" data-float="right" style="text-align: right; margin-top: 0;" type="text" name="bilnea_settings[b_opt_main-width]" value="<?= b_f_option('b_opt_main-width') ?>" placeholder="<?= b_f_default('b_opt_main-width') ?>">
</div>

<hr />

<div data-type="block">
	Personalización de la url de acceso al panel
	<br />
	<label for="bilnea_settings[b_opt_wp-admin]"><?= get_site_url(); ?>/</label>
	<input type="text" class="b_url" name="bilnea_settings[b_opt_wp-admin]" value="<?= b_f_option('b_opt_wp-admin'); ?>" placeholder="wp-admin">
</div>

<div data-type="notice">
	¡IMPORTANTE! Recuerda guardar esta url. Será la nueva ruta de acceso al panel de administración de WordPress y el acceso wp-admin ya no funcionará.
</div>

<!-- Favicon -->

<h4 data-type="title">Icono web</h4>

<div data-type="block">
	<div class="favicon iconico" id="favicon"></div>
	<div>
		<i class="fa fa-trash" id="del-favicon"></i>Icono del sitio web
		<br />
		<?php
		if (b_f_option('b_opt_favicon')) {
		?>
		<script type="text/javascript">
			jQuery('#favicon').attr('style', 'background-image: url(<?= b_f_option('b_opt_favicon'); ?>)');
			jQuery('#del-favicon').show();
		</script>
		<?php
		}
		?>
		<input type="text" id="fav_main_url" class="gran" name="bilnea_settings[b_opt_favicon]" style="width: calc(100% - 32px);" value="<?= b_f_option('b_opt_favicon') ?>">
		<button type="submit" id="subir_fav_main" value="Seleccionar imagen" class="button-secondary subir-imagen">
			<i class="fa fa-search" style="font-size: 12px;"></i>
		</button>
	</div>
</div>


<!-- Redes sociales -->

<h4 data-type="title">Redes sociales</h4>

<div id="admin-rrss">

	<?php

	$i = 1;

	$var_rrss = explode(',', b_f_option('b_opt_social-order', true));
	foreach ($var_rrss as $temp_rrss) {
		switch ($temp_rrss) {
			case 'snapchat':
				$icon = $temp_rrss.'-ghost';
				break;
			case 'telegram':
				$icon = 'paper-plane';
				break;
			default:
				$icon = $temp_rrss;
				break;
		}
		switch ($temp_rrss) {
			case 'google-plus':
			case 'youtube':
			case 'linkedin':
			case 'rss':
				$var_placeholder = 'url';
				break;
			case 'whatsapp':
				$var_placeholder = 'número de teléfono';
				break;
			case 'telegram':
				$var_placeholder = 'usuario';
				break;
			default:
				$var_placeholder = 'url o usuario';
				break;
		}

		?>

		<div data-type="block">

			<i class="fa fa-<?= $icon ?>" data-type="icon"></i>

			<input type="text" data-type="text" name="bilnea_settings[b_opt_social-<?= $temp_rrss ?>]" value="<?= b_f_option('b_opt_social-'.$temp_rrss) ?>" placeholder="<?= $var_placeholder ?>" data-size="50" />
			
			<input type="text" data-alpha="true" data-type="color" name="bilnea_settings[b_opt_social-<?= $temp_rrss ?>-color]" value="<?= b_f_option('b_opt_social-'.$temp_rrss.'-color') ?>" placeholder="<?= b_f_default('b_opt_social-'.$temp_rrss.'-color') ?>" />
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