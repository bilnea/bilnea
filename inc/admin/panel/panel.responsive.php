<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

?>

<h4>Menú responsive</h4>
<label for="mobile_menu_opt1"><img src="<?= get_template_directory_uri().'/img/menu_movil_1.jpg'; ?>" class="icon big" /></label>
<label for="mobile_menu_opt2"><img src="<?= get_template_directory_uri().'/img/menu_movil_2.jpg'; ?>" class="icon big" /></label>
<label for="mobile_menu_opt3"><img src="<?= get_template_directory_uri().'/img/menu_movil_3.jpg'; ?>" class="icon big" style="margin-right: 0;" /></label>
<br />
<div style="width: 174px; display: inline-block;">
	<input type="radio" name="bilnea_settings[b_opt_mobile-menu]" <?php checked(b_f_option('b_opt_mobile-menu'), 1); ?> value="1" id="mobile_menu_opt1">Menú selector
</div>
<div style="width: 174px; display: inline-block;">
	<input type="radio" name="bilnea_settings[b_opt_mobile-menu]" <?php checked(b_f_option('b_opt_mobile-menu'), 2); ?> value="2" id="mobile_menu_opt2">Menú cortina
</div>
<div style="display: inline-block;">
	<input type="radio" name="bilnea_settings[b_opt_mobile-menu]" <?php checked(b_f_option('b_opt_mobile-menu'), 3); ?> value="3" id="mobile_menu_opt3">Menú deslizante
</div>
<hr>
<div style="width: 414px; margin-bottom: 16px; display: inline-block;">Dimensión de activación responsive</div>
<input style="text-align: right;" type="text" class="peq" name="bilnea_settings[b_opt_responsive]" value="<?= b_f_option('b_opt_responsive'); ?>" placeholder="<?= b_f_default('b_opt_responsive'); ?>">
<br />
<h4>Diseño</h4>
<label for="bilnea_settings[b_opt_mobile-margin]" style="overflow: hidden; display: block; width: 100%;">Márgen lateral (px o %)
<input type="text" class="peq" name="bilnea_settings[b_opt_mobile-margin]" value="<?= b_f_option('b_opt_mobile-margin'); ?>" style="float: right; right: 0;" /></label>
<label for="bilnea_settings[b_opt_mobile-htext]" style="overflow: hidden; display: block; width: 100%;">Tamaño encabezado respecto a su dimensión natural, en %
<input type="text" class="peq" name="bilnea_settings[b_opt_mobile-htext]" value="<?= b_f_option('b_opt_mobile-htext'); ?>" style="float: right; right: 0;" /></label>
<label for="bilnea_settings[b_opt_mobile-text]" style="overflow: hidden; display: block; width: 100%;">Tamaño texto corrido respecto a su dimensión natural, en %
<input type="text" class="peq" name="bilnea_settings[b_opt_mobile-text]" value="<?= b_f_option('b_opt_mobile-text'); ?>" style="float: right; right: 0;" /></label>
<hr style="margin-bottom: 0;" />
<input type="checkbox" name="bilnea_settings[b_opt_mobile-sidebar]" <?php checked(b_f_option('b_opt_mobile-sidebar'), 1); ?> value="1">
<label for="bilnea_settings[b_opt_mobile-sidebar]">Ocultar la barra lateral</label>
<hr style="margin: 0;" />
<input type="checkbox" name="bilnea_settings[b_opt_mobile-search]" <?php checked(b_f_option('b_opt_mobile-search'), 1); ?> value="1">
<label for="bilnea_settings[b_opt_mobile-search]">Mostrar buscador en menú móvil</label>
<br />
<input type="checkbox" name="bilnea_settings[b_opt_tablet-search]" <?php checked(b_f_option('b_opt_tablet-search'), 1); ?> value="1">
<label for="bilnea_settings[b_opt_tablet-search]">Mostrar buscador en cabecera para tablets</label>