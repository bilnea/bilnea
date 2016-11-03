<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

?>

<h4>Logotipo principal</h4>
<?php
if (b_f_option('b_opt_main-logo') == null) :
?>
<div style="position: relative; margin-bottom: 10px;">
	<script type="text/javascript">
		jQuery(function() {
			jQuery('#borra_logo').parent().show();
		})
	</script>
	<div id="logo_principal" style="background-image: url(<?= b_f_default('b_opt_main-logo') ?>);"></div>
	<div>
		<i class="fa fa-trash" id="borra_logo"></i>
	</div>
	<div style="display: block;">
		<input type="text" id="logo_url" class="gran" name="bilnea_settings[b_opt_main-logo]" style="width: calc(100% - 32px);" value="<?= b_f_default('b_opt_main-logo'); ?>">
		<button type="submit" id="subir_imagen" value="Seleccionar imagen"  class="button-secondary subir-imagen">
			<i class="fa fa-search" style="font-size: 12px;"></i>
		</button>
	</div>
</div>
<?php
else :
?>
<div style="position: relative; margin-bottom: 10px;">
	<?php
	if (b_f_option('b_opt_main-logo')) {
	?>
	<script type="text/javascript">
		jQuery(function() {
			jQuery('#borra_logo').parent().show();
		})
	</script>
	<div id="logo_principal" style="background-image: url(<?= b_f_option('b_opt_main-logo') ?>);"></div>
	<?php
	} else {
	?>
	<div id="logo_principal" style="background-image: url(<?= get_template_directory_uri() ?>/img/icono-imagen.png);"></div>
	<?php
	}
	?>
	<div>
		<i class="fa fa-trash" id="borra_logo"></i>
	</div>
	<div style="display: block;">
		<input type="text" id="logo_url" class="gran" name="bilnea_settings[b_opt_main-logo]" style="width: calc(100% - 32px);" value="<?= b_f_option('b_opt_main-logo'); ?>">
		<button type="submit" id="subir_imagen" value="Seleccionar imagen"  class="button-secondary subir-imagen">
			<i class="fa fa-search" style="font-size: 12px;"></i>
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
		if (b_f_option('b_opt_favicon')) {
		?>
		<script type="text/javascript">
			jQuery('#favicon_div').attr('style', 'background-image: url(<?= b_f_option('b_opt_favicon'); ?>)');
			jQuery('#borra_logo1').show();
		</script>
		<?php
		}
		?>
		<input type="text" id="fav_main_url" class="gran" name="bilnea_settings[b_opt_favicon]" style="width: calc(100% - 32px);" value="<?= b_f_option('b_opt_favicon') ?>">
		<button type="submit" id="subir_fav_main" value="Seleccionar imagen"  class="button-secondary subir-imagen">
			<i class="fa fa-search" style="font-size: 12px;"></i>
		</button>
	</div>
</div>
<hr style="margin: 6px 0;" />
<div>
	<div class="favicon iconico" id="iphone_div"></div>
	<div>
		<i class="fa fa-trash" id="borra_logo2"></i>Icono iPhone
		<br />
		<?php
		if (b_f_option('b_opt_favicon-iphone')) {
		?>
		<script type="text/javascript">
			jQuery('#iphone_div').attr('style', 'background-image: url(<?= b_f_option('b_opt_favicon-iphone') ?>)');
			jQuery('#borra_logo2').show();
		</script>
		<?php
		}
		?>
		<input type="text" id="iph_fav_url" class="gran" name="bilnea_settings[b_opt_favicon-iphone]" style="width: calc(100% - 32px);" value='<?= b_f_option('b_opt_favicon-iphone'); ?>'>
		<button type="submit" id="subir_iph_fav" value="Seleccionar imagen"  class="button-secondary subir-imagen">
			<i class="fa fa-search" style="font-size: 12px;"></i>
		</button>
	</div>
</div>
<hr style="margin: 6px 0;" />
<div>
	<div class="favicon iconico" id="iphoneret_div"></div>
	<div>
		<i class="fa fa-trash" id="borra_logo3"></i>Icono iPhone Retina
		<br />
		<?php
		if ($opt['b_opt_favicon-iphone-retina']) {
		?>
		<script type="text/javascript">
			jQuery('#iphoneret_div').attr('style', 'background-image: url(<?= b_f_option('b_opt_favicon-iphone-retina') ?>)');
			jQuery('#borra_logo3').show();
		</script>
		<?php
		}
		?>
		<input type="text" id="iph_ret_url" class="gran" name="bilnea_settings[b_opt_favicon-iphone-retina]" style="width: calc(100% - 32px);" value="<?= b_f_option('b_opt_favicon-iphone-retina'); ?>">
		<button type="submit" id="subir_iph_ret" value="Seleccionar imagen"  class="button-secondary subir-imagen">
			<i class="fa fa-search" style="font-size: 12px;"></i>
		</button>
	</div>
</div>
<hr style="margin: 6px 0;" />
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
			<i class="fa fa-search" style="font-size: 12px;"></i>
		</button>
	</div>
</div>
<hr style="margin: 6px 0;" />
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
			<i class="fa fa-search" style="font-size: 12px;"></i>
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
			<i class="fa fa-search" style="font-size: 12px;"></i>
		</button>
	</div>
</div>
<hr style="margin: 6px 0;" />
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
			<i class="fa fa-search" style="font-size: 12px;"></i>
		</button>
	</div>
</div>