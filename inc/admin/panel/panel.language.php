<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

?>

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