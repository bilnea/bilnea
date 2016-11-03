<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

// Variables globales

global $shortcode_tags;

?>

<h4>Shortcodes propios</h4>

<select style="width: 100%;">
	<option disabled selected>Seleccionar shortcode</option>

	<?php

	foreach ($shortcode_tags as $key => $value) {
		if (substr($key, 0, 2) == 'b_') {
			echo '<option value="'.$key.'">['.$key.']</option>';
		}
	}

	?>

</select>
<div style="margin-top: 10px;">
	<div class="active">
		Selecciona un shortcode para conocer su funcionamiento y utilización.
	</div>
	<fieldset id="b_row">
		<legend>[b_row]</legend>
		<hr />
		Crea una fila.<br />
		<strong style="margin-top: 10px;">Atributos</strong><br />
		<em>bgcolor (string)</em><br />
		Define un color de fondo.
	</fieldset>
</div>