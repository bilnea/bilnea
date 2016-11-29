<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

if (!function_exists('b_f_fonts')) {
	
	function b_f_fonts($var_font) {

		global $b_g_google_api;

		$var_fonts = json_decode(file_get_contents(('https://www.googleapis.com/webfonts/v1/webfonts?key='.$b_g_google_api)));

		$b_g_google_fonts = array();

		foreach ($var_fonts->items as $font) {
			$var_sizes = $font->variants;
			foreach ($var_sizes as &$temp) {
				if ($temp == 'regular') { $temp = '400'; }
				if ($temp == 'italic') { $temp = '400italic'; }
			}
			$b_g_google_fonts['"'.$font->family.'", '.$font->category] = array(
				'name' => str_replace(' ', '+', $font->family),
				'sizes' => $var_sizes
			);
		}

		?>

		<!-- Selector tipográfico -->
		<div class="font-selector">
			<select name="bilnea_settings[b_opt_<?= $var_font ?>_ttf-font]" class="gran font-selector">
				<option disabled="disabled">Selecciona una tipografía</option>
				<option value="inherit" <?= selected($var_current_font, 'inherit') ?> data="">Heredada</option>

				<?php
				
				foreach ($b_g_google_fonts as $key => $value) {
					$var_current_font = b_f_option('b_opt_'.$var_font.'_ttf-font', true);
					echo '<option value="'.$value['name'].'" '.selected($var_current_font, $value['name']).' data="'.implode(',', $value['sizes']).'">'.str_replace('+', ' ', $value['name']).'</option>';
				}

				?>

			</select>
		</div>

		<!-- Selector tamaño -->
		<div class="font-size-picker">
			<input type="text" class="sp-input" name="bilnea_settings[b_opt_<?= $var_font ?>_ttf-size]" value="<?= b_f_option('b_opt_'.$var_font.'_ttf-size'); ?>" placeholder="<?= b_f_default('b_opt_'.$var_font.'_ttf-size'); ?>">
		</div>

		<!-- Selector color -->
		<div class="font-color-picker">
			<input type="text" class="sp-input" name="bilnea_settings[b_opt_<?= $var_font ?>_ttf-color]" value="<?= b_f_option('b_opt_'.$var_font.'_ttf-color'); ?>" placeholder="<?= b_f_default('b_opt_'.$var_font.'_ttf-color'); ?>" />
			<input type="text" class="colora text peq">
		</div>

		<!-- Selector estilo -->
		<div class="font_styles" style="position: relative;">
			<div><span>Regular</span><span>Cursiva</span></div>
			<?php

				$var_weights = array('100','200','300','400','500','600','700','800','900');

				foreach ($var_weights as $var_weight) {

					?>

					<div>
						<input type="radio" value="<?= $var_weight ?>" name="bilnea_settings[b_opt_<?= $var_font ?>_ttf-style]" <?php checked(b_f_option('b_opt_'.$var_font.'_ttf-style'), $var_weight); ?> />
						<input type="radio" value="<?= $var_weight ?>italic" name="bilnea_settings[b_opt_<?= $var_font ?>_ttf-style]" <?php checked(b_f_option('b_opt_'.$var_font.'_ttf-style'), $var_weight.'italic'); ?> />
					</div>

					<?php

				}

			?>

			<div class="notice font">
				<span style="font-family: 'Roboto'; font-weight: 100;">a</span> ... <span style="font-family: 'Roboto'; font-weight: 900;">a</span>
				<br />
				<span style="font-family: 'Roboto'; font-weight: 100; font-style: italic;">a</span> ... <span style="font-family: 'Roboto'; font-weight: 900; font-style: italic;">a</span>
			</div>

			<div class="font-uppercase">
				<span>
					<input type="checkbox" name="bilnea_settings[b_opt_<?= $var_font ?>_ttf-uppercase]" <?php checked(b_f_option('b_opt_'.$var_font.'_ttf-uppercase'), 1); ?> value="1">Mayúsculas
				</span>
				<span>
					<input type="checkbox" name="bilnea_settings[b_opt_<?= $var_font ?>_ttf-underline]" <?php checked(b_f_option('b_opt_'.$var_font.'_ttf-underline'), 1); ?> value="1">Subrayado
				</span>
			</div>

		</div>
		<?php
	}

}


if (!function_exists('b_f_smtp_server')) {

	function b_f_smtp_server(PHPMailer $var_smtp) {

		$var_smtp->Host = b_f_option('b_opt_smtp-server');
		$var_smtp->Port = b_f_option('b_opt_smtp-port');
		$var_smtp->Username = b_f_option('b_opt_smtp-user');
		$var_smtp->Password = b_f_option('b_opt_smtp-pass');

		if (b_f_option('b_opt_smtp-auth') == 1) {
			$var_smtp->SMTPAuth = true;
		}

		if (b_f_option('b_opt_smtp-secure') == 1 && b_f_option('b_opt_smtp-protocol') == 'ssl') {
			$var_smtp->SMTPSecure = 'ssl';
		}

		if (b_f_option('b_opt_smtp-secure') == 1 && b_f_option('b_opt_smtp-protocol') == 'tls') {
			$var_smtp->SMTPSecure = 'tls';
		}
		
	    $var_smtp->IsSMTP();

	}

}


if (!function_exists('b_f_create_page')) {
	
	function b_f_create_page($var_page, $var_title, $var_language = 'es', $var_noindex = true) {

		include_once('inc/'.$var_language.'/'.$var_page.'.php');

		$var_create_page = array(
			'post_title'    => $var_title,
			'post_content'  => $txt,
			'post_status'   => 'publish',
			'post_author'   => 1,
			'post_type'     => 'page',
			'post_name'     => $var_page,
			'post_parent'	=> 0,
			'page_template'	=> 'blank-page.php'
		);

		$var_id = wp_insert_post($var_create_page);

		$var_options = get_option('bilnea_settings');

		$var_options['b_opt_'.$var_page.'-'.$var_language] = $var_id;

		update_option('bilnea_settings', $var_options);

		if ($var_noindex  == true) {
			add_post_meta($var_id, '_yoast_wpseo_meta-robots-noindex', '1');
		}
	}

}

?>