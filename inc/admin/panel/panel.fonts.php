<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

// Variables globales
global $b_g_google_fonts;

?>

<h4>Estilos tipográficos</h4>

<!-- Texto plano -->
<div class="text-container">
	<strong>Texto plano</strong>
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
<div class="text-container" style="margin-bottom: 10px;">
	<strong>Enlaces activos</strong>
	<?php b_f_fonts('hover'); ?>
</div>

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
<div class="text-container" style="margin-bottom: 10px;">
	<strong>H6 Encabezado</strong>
	<?php b_f_fonts('h6'); ?>
</div>

<h4>Estilos tipográficos extra</h4>

<?php

$var_fonts = [];

foreach (get_option('bilnea_settings') as $key => $value) {
	if (strpos($key, 'ttf-font') !== false) {
		if ($value == '') {
			$value = b_f_default($key);
		}
		$var_current_font = str_replace('b_opt_', '', explode('ttf-', $key)[0]);
		$var_size = b_f_option('b_opt_'.$var_current_font.'ttf-style');
		if (!isset($var_fonts[$value]) && $value != '') {
			$var_fonts[$value] = array($var_size);
		} else {
			if (!in_array($var_size, $var_fonts[$value]) && $value != '') {
				array_push($var_fonts[$value], $var_size);
			}
		}
	}
}

$var_index = 0;
if (count($var_fonts) > 0) {

	foreach ($var_fonts as $key => $value) {

		if ($var_index > 0) {
			echo '<hr />';
		}

		$var_index++;

		?>

		<fieldset class="text-container">
			<strong><?php echo str_replace('+', ' ', $key); ?></strong>
			<div class="font_styles" style="position: relative;">
				<div>Regular<br />Cursiva</div>

				<?php

				(b_f_option('b_opt_custom-font') == null) ? $var_container = array() : $var_container = b_f_option('b_opt_custom-font');

				($b_g_google_fonts[$key]['sizes'] == null) ? $var_sizes == array() : $var_sizes = $b_g_google_fonts[$key]['sizes'];

				for ($i = 1; $i < 10; $i++) {
					$j = $i*100;
					
					(!in_array($j, $var_sizes)) ? $var_disabled = ' disabled' : $var_disabled = '';
					(in_array($j, $value)) ? $var_checked = ' checked' : $var_checked = '';

				?>

				<div>
				<input type="checkbox" value="<?= $b_g_google_fonts[$key]['name'].'|'.$j ?>"<?php echo $var_disabled.$var_checked; checked(in_array($b_g_google_fonts[$key]['name'].'|'.$j, $var_container)); ?> name="bilnea_settings[b_opt_custom-font][]">
				
				<?php

					$j = $j.'italic';

					(!in_array($j, $var_sizes)) ? $var_disabled = ' disabled' : $var_disabled = '';
					(in_array($j, $value)) ? $var_checked = ' checked' : $var_checked = '';

				?>

				<input type="checkbox" value="<?= $b_g_google_fonts[$key]['name'].'|'.$j ?>"<?php echo $var_disabled.$var_checked; checked(in_array($b_g_google_fonts[$key]['name'].'|'.$j, $var_container)); ?> name="bilnea_settings[b_opt_custom-font][]">
				</div>

			<?php

			}

			?>

			<div class="notice font"><span style="font-family: 'Roboto'; font-weight: 100;">a</span> ... <span style="font-family: 'Roboto'; font-weight: 900;">a</span><br /><span style="font-family: 'Roboto'; font-weight: 100; font-style: italic;">a</span> ... <span style="font-family: 'Roboto'; font-weight: 900; font-style: italic;">a</span></div>
			<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=<?php echo $key; ?>">
			<div style="vertical-align: top; font-size: 30px; display: inline-block; line-height: 52px; width: 160px; font-family: '<?php echo str_replace('+', ' ', $key); ?>';">AaBbCc</div>
		</div>
	</fieldset>

	<?php

	}
}

?>