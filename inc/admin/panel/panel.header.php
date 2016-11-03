<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

?>

<h4>Estructuración</h4>
<div data-connect="header-style">
	<div style="width: 50%; display: inline-block;">
		Ancho de la cabecera
	</div>
	<div style="width: 49%; display: inline-block;">
		Ancho del menú
	</div>
	<div style="width: 48%; margin-right: 2%; border-right: 1px solid #e1e1e1; display: inline-block;">
		<input type="radio" name="bilnea_settings[b_opt_header-width]" <?php checked(b_f_option('b_opt_header-width'), 1); ?> value="1"><span>Ancho completo</span>
		<br />
		<input type="radio" name="bilnea_settings[b_opt_header-width]" <?php checked(b_f_option('b_opt_header-width'), 2); ?> value="2"><span>Encajonado</span>
	</div>
	<div style="width: 49%; display: inline-block;">
		<input type="radio" name="bilnea_settings[b_opt_menu-width]" <?php checked(b_f_option('b_opt_menu-width'), 1); ?> value="1"><span>Ancho completo</span>
		<br />
		<input type="radio" name="bilnea_settings[b_opt_menu-width]" <?php checked(b_f_option('b_opt_menu-width'), 2); ?> value="2"><span>Encajonado</span>
	</div>
</div>
<em class="notice header_notice" style="font-size: 11px; line-height: 15px; margin-bottom: 10px;">
	Con contenido encajonado definido como opción general, estas opciones están deshabilitadas. Para activarlas, desactiva el contenido encajonado de toda la página.
</em>
<div style="width: 50%; display: inline-block;">
	Alineación del menú
</div>
<div style="width: 49%; display: inline-block;">
	Alineación del logotipo
</div>
<div style="width: 48%; margin-right: 2%; border-right: 1px solid #e1e1e1; display: inline-block;">
	<input type="radio" name="bilnea_settings[b_opt_menu-align]" <?php checked(b_f_option('b_opt_menu-align'), 1); ?> value="1"><span>Menú alineado a la izquierda</span>
	<br />
	<input type="radio" name="bilnea_settings[b_opt_menu-align]" <?php checked(b_f_option('b_opt_menu-align'), 2); ?> value="2"><span>Menú alineado al centro</span>
	<br />
	<input type="radio" name="bilnea_settings[b_opt_menu-align]" <?php checked(b_f_option('b_opt_menu-align'), 3); ?> value="3"><span>Menú alineado a la derecha</span>
</div>
<div style="width: 49%; display: inline-block;">
	<input type="radio" name="bilnea_settings[b_opt_header-logo-align]" <?php checked(b_f_option('b_opt_header-logo-align'), 1); ?> value="1"><span>Logotipo alineado a la izquierda</span>
	<br />
	<input type="radio" name="bilnea_settings[b_opt_header-logo-align]" <?php checked(b_f_option('b_opt_header-logo-align'), 2); ?> value="2"><span>Logotipo alineado al centro</span>
	<br />
	<input type="radio" name="bilnea_settings[b_opt_header-logo-align]" <?php checked(b_f_option('b_opt_header-logo-align'), 3); ?> value="3"><span>Logotipo alineado a la derecha</span>
</div>
<select name="bilnea_settings[header_menu]" class="gran" style="margin-top: -4px; width: 100%; margin-bottom: 0;">
	<option value="1" <?php selected(b_f_option('header_menu'), 1); ?>>Logotipo encima del menú</option>
	<option value="2" <?php selected(b_f_option('header_menu'), 2); ?>>Logotipo en línea con el menú</option>
</select>
<div style="width: 100%; display: inline-block;">
	<input type="checkbox" name="bilnea_settings[b_opt_sticky-menu]" <?php checked(b_f_option('b_opt_sticky-menu'), 1); ?> value="1" />
	<label for="bilnea_settings[b_opt_sticky-menu]">Cabecera fija en pantalla</label>
</div>
<div style="width: 100%; display: inline-block;">
	<input type="checkbox" name="bilnea_settings[b_opt_sticky-menu-animated]" <?php checked(b_f_option('b_opt_sticky-menu-animated'), 1); ?> value="1" />
	<label for="bilnea_settings[b_opt_sticky-menu-animated]">Ocultar automáticamente</label>
</div>
<br />
<h4 style="margin-top: 10px;">Barra superior</h4>
<input type="checkbox" name="bilnea_settings[b_opt_top-bar]" <?php checked(b_f_option('b_opt_top-bar'), 1); ?> value="1"> Mostrar barra superior
<br />
<input type="checkbox" name="bilnea_settings[b_opt_menu-top-bar]" <?php checked(b_f_option('b_opt_menu-top-bar'), 1); ?> value="1"> <span>Incluir menú en barra superior</span>
<br />
<input type="checkbox" name="bilnea_settings[b_opt_topbar-rss]" <?php checked(b_f_option('b_opt_topbar-rss'), 1); ?> value="1"> <span>Incluir iconos redes sociales</span>
<br />
<input type="checkbox" name="bilnea_settings[_opt_header-search]" <?php checked(b_f_option('_opt_header-search'), 1); ?> value="1"> <span>Incluir buscador</span>
<hr />
Estilo de los iconos de las redes sociales para la cabecera
<br />
<input type="radio" name="bilnea_settings[b_opt_header-rrss-icons]" <?php checked(b_f_option('b_opt_header-rrss-icons'), 1); ?> value="1">Iconos normales, sin fondo.
<br />
<input type="radio" name="bilnea_settings[b_opt_header-rrss-icons]" <?php checked(b_f_option('b_opt_header-rrss-icons'), 2); ?> value="2">Iconos sobre fondo cuadrado.
<br />
<h4 style="margin-top: 10px;">Estilos tipográficos</h4>
<div class="text-container">
	<strong>Barra superior</strong>
	<?php b_f_fonts('top-bar'); ?>
</div>
<hr />
<div class="text-container">
	<strong>Menú principal</strong>
	<?php b_f_fonts('main-menu'); ?>
</div>
<hr />
<div class="text-container">
	<strong>Submenú</strong>
	<?php b_f_fonts('sub-menu'); ?>
</div>