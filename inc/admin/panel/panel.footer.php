<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

?>

<h4>Estructuración</h4>
<div data-connect="header-style">
	<div style="width: 50%; display: inline-block;">
		Ancho del pie de página
	</div>
	<div style="width: 49%; display: inline-block;">
		Ancho del 'socket'
	</div>
	<div style="width: 48%; margin-right: 2%; border-right: 1px solid #e1e1e1; display: inline-block;">
		<input type="radio" name="bilnea_settings[footer_width]" <?php checked(b_f_option('footer_width'), 1); ?> value="1"><span>Ancho completo</span>
		<br />
		<input type="radio" name="bilnea_settings[footer_width]" <?php checked(b_f_option('footer_width'), 2); ?> value="2"><span>Encajonado</span>
	</div>
	<div style="width: 49%; display: inline-block;">
		<input type="radio" name="bilnea_settings[socket_width]" <?php checked(b_f_option('socket_width'), 1); ?> value="1"><span>Ancho completo</span>
		<br />
		<input type="radio" name="bilnea_settings[socket_width]" <?php checked(b_f_option('socket_width'), 2); ?> value="2"><span>Encajonado</span>
	</div>
</div>
<em class="notice header_notice" style="font-size: 11px; line-height: 15px;">
	Con contenido encajonado definido como opción general, estas opciones están deshabilitadas. Para activarlas, desactiva el contenido encajonado de toda la página.
</em>
<div style="width: 48%; margin-right: 2% !important; border-right: 1px solid #ddd; display: inline-block; margin: 10px 0 10px 0;">
	<input type="checkbox" name="bilnea_settings[footer_show]" <?php checked(b_f_option('footer_show'), 1); ?> value="1">
	<label for="bilnea_settings[footer_show]">Mostrar el 'footer'</label>
	<br />
	<input type="checkbox" name="bilnea_settings[socket_show]" <?php checked(b_f_option('socket_show'), 1); ?> value="1">
	<label for="bilnea_settings[socket_show]">Mostrar el 'socket'</label>
	<br />
	<input type="checkbox" name="bilnea_settings[socket_copy]" <?php checked(b_f_option('socket_copy'), 1); ?> value="1">
	<label for="bilnea_settings[socket_copy]">Mostrar copyright</label>
</div>
<div style="width: 49%; display: inline-block; margin: 10px 0 10px 0;">
	<input type="checkbox" name="bilnea_settings[socket_show_legal-advice]" <?php checked(b_f_option('socket_show_legal-advice'), 1); ?> value="1">
	<label for="bilnea_settings[socket_show_legal-advice]">Mostrar Aviso legal</label>
	<br />
	<input type="checkbox" name="bilnea_settings[socket_show_privacy-policy]" <?php checked(b_f_option('socket_show_privacy-policy'), 1); ?> value="1">
	<label for="bilnea_settings[socket_show_privacy-policy]">Mostrar Política de privacidad</label>
	<br />
	<input type="checkbox" name="bilnea_settings[socket_show_cookies-policy]" <?php checked(b_f_option('socket_show_cookies-policy'), 1); ?> value="1">
	<label for="bilnea_settings[socket_show_cookies-policy]">Mostrar Política de cookies</label>
</div>
<hr />
Número de columnas del footer
<input type="text" name="bilnea_settings[b_opt_footer-menu]" class="peq" style="width: 100px; float: right; margin: 0 0 2px 0;" placeholder="<?php b_f_default('b_opt_footer-menu') ?>" value="<?= b_f_option('b_opt_footer-menu') ?>">
<hr />
Ocultar el mensaje "Desarrollo web por bilnea".
<br>
<input type="password" class="gran" style="width: 100%;" placeholder="Introduce el código de desbloqueo" name="bilnea_settings[socket_no-development]" value="<?php echo $opt['socket_no-development']; ?>" />
<br />
<h4 style="margin-top: 10px;">Estilos tipográficos</h4>
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
<hr />
<div class="text-container">
	<strong>Texto socket</strong>
	<?php b_f_fonts('socket'); ?>
</div>
<hr />
<div class="text-container">
	<strong>Enlace socket</strong>
	<?php b_f_fonts('socket-link'); ?>
</div>
<hr />
<div class="text-container">
	<strong>Enlace activo socket</strong>
	<?php b_f_fonts('socket-hover'); ?>
</div>