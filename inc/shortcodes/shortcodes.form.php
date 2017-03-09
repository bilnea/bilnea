<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


// Formulario

if (!function_exists('b_s_form')) {

	function b_s_form($atts, $content = null) {

		// Variables globales
		global $b_g_version;
		global $b_g_hash;
		global $b_g_forms;
		global $b_g_language;

		// Atributos
		$a = shortcode_atts(array(
			'id' => null,
			'class' => null,
			'response' => true,
			'to' => b_f_option('b_opt_form-email-'.$b_g_language),
			'message' => __('Your message has been sent sucesfully. Your request will delay. A copy has been sent to your email.', 'bilnea'),
			'send' => __('Send', 'bilnea'),
			'redirect' => b_f_option('b_opt_form-thanks-'.$b_g_language),
			'subject' => sprintf(esc_html__('Message sent from %s website form', 'bilnea'), get_option('blogname')),
			'name' => 'Página "'.get_the_title(get_the_ID()).'". Formulario '.$b_g_forms,
		), $atts);

		// Número aleatorio para identificar al formulario
		$var_random = rand(0, 99999999);

		// Dirección IP del visitante
		$var_ip = '';
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$var_ip=' '.$_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$var_ip=' '.$_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$var_ip=' '.$_SERVER['REMOTE_ADDR'];
		}
		
		// Variables específicas
		(esc_attr($a['class']) != null) ? $var_class = ' '.esc_attr($a['class']) : $var_class = '';
		(esc_attr($a['id']) != null) ? $var_id = ' id="'.esc_attr($a['id']).'"' : $var_id = '';

		// Javascript del formulario
		wp_register_script('functions.form', get_template_directory_uri().'/js/internal/functions.form.js', array(), $b_g_version, true);
		$var_temp = array(
			'text' => __('There are errors on the form. Please fix them before continuing', 'bilnea'),
			'empty' => __('Fill in all the required fields', 'bilnea'),
			'email' => __('Enter a valid email address', 'bilnea'),
			'captcha' => __('Enter a correct captcha value', 'bilnea'),
			'legal' => __('You must accept the legal advice', 'bilnea')
		);
		wp_localize_script('functions.form', 'form_errors', $var_temp);
		wp_enqueue_script('functions.form');

		// Construcción del formulario
		$out = '<form class="form'.$var_class.'"'.$var_id.' method="post" data-id="'.$var_random.'" data-name="'.$b_g_forms.'">';
		$out .= do_shortcode($content);
		$out .= '<input type="hidden" value="'.b_f_i_encrypt_decrypt('encrypt', esc_attr($a['to'])).'" name="b_i_to" />';
		$out .= '<input type="hidden" value="'.b_f_i_encrypt_decrypt('encrypt', esc_attr($a['message'])).'" name="b_i_sucess" />';
		$out .= '<input type="hidden" value="'.b_f_i_encrypt_decrypt('encrypt', esc_attr($a['subject'])).'" name="b_i_subject" />';
		$out .= '<input type="hidden" value="'.b_f_i_encrypt_decrypt('encrypt', esc_attr($a['name'])).'" name="b_i_formname" />';
		$out .= '<input type="hidden" value="'.b_f_i_encrypt_decrypt('encrypt', get_the_ID()).'" name="b_i_page" />';
		$out .= '<input type="hidden" value="'.$var_ip.'" name="b_i_ip" />';
		$out .= '<input type="hidden" value="" name="b_i_names" />';
		if (esc_attr($a['response']) == true) {
			$out .= '<input type="hidden" value="true" name="b_i_response" />';
		}

		// Redirección del formulario
		if (esc_attr($a['redirect']) == 'true' && is_numeric(b_f_option('b_opt_form-thanks'))) {
			$out .= '<input type="hidden" value="'.b_f_i_encrypt_decrypt('encrypt', b_f_option('b_opt_form-thanks')).'" name="b_i_redirect" />';
		}
		if (is_numeric(esc_attr($a['redirect']))) {
			$out .= '<input type="hidden" value="'.b_f_i_encrypt_decrypt('encrypt', esc_attr($a['redirect'])).'" name="b_i_redirect" />';
		}

		$out .= '</form>';
		$out .= '<div class="response"></div>';

		$b_g_forms++;

		return $out;
	}

	add_shortcode('b_form', 'b_s_form');

}

// Campo del formulario

if (!function_exists('b_s_input')) {

	function b_s_input($atts) {

		// Variables globales
		global $b_g_language;

		// Atributos
		$a = shortcode_atts(array(
			'id' => null,
			'class' => null,
			'type' => 'text',
			'required' => 'false',
			'placeholder' => '',
			'length' => 5,
			'allow' => '',
			'options' => null,
			'data' => null,
			'size' => '5MB',
			'label' => null,
			'url' => b_f_option('b_opt_privacy-policy-'.$b_g_language),
			'name' => null,
			'prefix' => null,
			'sending' => __('Sending', 'bilnea')
		), $atts);

		// Número aleatorio para identificar el campo
		$var_random = rand(10000, 99999);
		
		// Variables específicas
		(esc_attr($a['class']) != null) ? $var_class = ' '.esc_attr($a['class']) : $var_class = '';
		(esc_attr($a['name']) != null) ? $var_name = esc_attr($a['name']) : $var_name = '';
		if (esc_attr($a['required']) == 'true') {
			$var_class .= ' required';
			$var_required = '* ';
		} else {
			$var_required = '';
		}
		(esc_attr($a['id']) != null) ? $var_id = ' id="'.esc_attr($a['id']).'"' : $var_id = '';
		(esc_attr($a['placeholder']) == 'null') ? $var_placeholder = '' : $var_placeholder = esc_attr($a['placeholder']);

		// Construcción del campo
		switch (esc_attr($a['type'])) {

			// Correo electrónico
			case 'email':
				if ($var_name == '') { $var_name = 'Correo electrónico'; }
				if (esc_attr($a['placeholder']) == '') { $var_placeholder = __('Email', 'bilnea'); }
				if (esc_attr($a['label']) == 'true') {
					return '<label>'.$var_required.$var_placeholder.'<input class="input'.$var_class.'"'.$var_id.' type="text" name="b_i_email" data-name="Correo electrónico" /></label>';
				} else {
					return '<input class="input'.$var_class.'"'.$var_id.' type="text" name="b_i_email" placeholder="'.$var_required.$var_placeholder.'" data-name="'.$var_name.'" />';
				}
				break;

			// Mensaje
			case 'message':
				if ($var_name == '') { $var_name = 'Mensaje'; }
				if (esc_attr($a['placeholder']) == '') { $var_placeholder = __('Message', 'bilnea'); }
				if (esc_attr($a['label']) == 'true') {
					return '<label>'.$var_required.$var_placeholder.'<textarea name="b_i_message" class="input'.$var_class.'"'.$var_id.' data-name="'.$var_name.'" rows="'.esc_attr($a['length']).'"></textarea></label>';
				} else {
					return '<textarea name="b_i_message" class="input'.$var_class.'"'.$var_id.' placeholder="'.$var_required.$var_placeholder.'" data-name="'.$var_name.'" rows="'.esc_attr($a['length']).'"></textarea>';
				}
				break;

			// Selector de provincia
			case 'state':

				// Datos externos
				include('data/states.php');

				if ($var_name == '') { $var_name = 'Provincia'; }
				if (esc_attr($a['placeholder']) == '') { $var_placeholder = __('State', 'bilnea'); }
				if (esc_attr($a['label']) == 'true') {
					$out = '<label>'.$var_required.$var_placeholder.'<select name="b_i_custom_state" class="input'.$var_class.'"'.$var_id.' data-name="'.$var_name.'">';
				} else {
					$out = '<select name="b_i_state" class="input'.$var_class.'"'.$var_id.' data-name="'.$var_name.'"><option selected disabled>'.$var_required.$var_placeholder.'</option>';
				}
				if (esc_attr($a['data']) == null) {
					foreach ($b_d_state as $key => $value) {
						$out .= '<option value="'.$key.'--'.$value.'">'.$value.'</option>';
					}
				}
				$out .= '</select>';
				if (esc_attr($a['label']) == 'true') { $out .= '</label>'; }
				return $out;
				break;

			// Aviso legal
			case 'legal':
				if (esc_attr($a['placeholder']) == '') {
					if (is_numeric(esc_attr($a['url']))) {
						$var_placeholder = get_the_title(esc_attr($a['url']));
					} else {
						$var_placeholder = __('Privacy policy', 'bilnea');
					}
				}
				if (is_numeric(esc_attr($a['url']))) {
					$var_url = get_permalink(esc_attr($a['url']));
				} else {
					$var_url = esc_attr($a['url']);
				}
				switch (substr(explode(' ', $var_placeholder)[0], -1)) {
					case 'a':
						$var_gendre = _x('the', 'female', 'bilnea');
						break;
					default:
						$var_gendre = _x('the', 'male', 'bilnea');
						break;
				}
				$out  = '<input class="b_input_checkbox'.$var_class.'" id="legal-'.$var_random.'" type="checkbox" name="b_i_legal">';
				$out .= '<label for="legal-'.$var_random.'" class="'.esc_attr($a['class']).'">'.$var_required.__('I have read, understood and accept', 'bilnea').' '.$var_gendre.' <a href="'.$var_url.'" title="'.$var_placeholder.'" target="_blank">'.mb_strtolower($var_placeholder).'</a>.</label>';
				return $out;
				break;

			// Verificación captcha
			case 'captcha':
				session_start();
				$var_captcha = rand(0, 99999999);
				do {
					$var_md5 = md5(microtime()*mktime());
					preg_replace('([1aeilou0])', "", $var_md5 );
				} while (strlen($var_md5) < esc_attr($a['length']));
				$var_key = substr( $var_md5, 0, esc_attr($a['length']) );
				$_SESSION['key-'.$var_captcha] = md5($var_key);
				$var_character = str_split($var_key);
				if (esc_attr($a['label']) == 'true') {
					$out = '<div class="captcha input'.$var_class.'"'.$var_id.' data-id="'.$var_captcha.'">'.$var_required.sprintf(__('Fill in the following field with <strong>"%s"</strong>', 'bilnea'), $var_key).'<br />';
					$out .= '<input type="text" class="captcha required" name="captcha[]" id="captcha_unique" size="'.esc_attr($a['length']).'" maxlength="'.esc_attr($a['length']).'">';
				} else {
					$out = '<div class="captcha input'.$var_class.'"'.$var_id.' data-id="'.$var_captcha.'">'.$var_required.__('Fill in the following fields.', 'bilnea').'<br />';
					$i = 1;
					foreach ($var_character as $let) {
						$out .= '<input type="text" class="captcha required" name="captcha[]" id="captcha_'.$i.'" placeholder="'.$let.'" size="1" maxlength="1">';
						$i++;
					}
					$out .= '</div>';
				}
				return $out;
				break;

			// Archivo adjunto
			case 'file':
				$ftp = '';
				if (esc_attr($a['allow']) != '') { $ftp = ' accept="'.esc_attr($a['allow']).'"'; }
				return '<div class="file-button"><div class="icon"></div><div class="text">'.esc_attr($a['placeholder']).'</div></div><input class="input'.$var_class.'"'.$var_id.' type="file"'.$ftp.' name="'.esc_attr($a['type']).'" multiple data-empty="'.__('No selected file', 'bilnea').'" data-size="'.b_f_to_bytes(esc_attr($a['size'])).'" data-size-error="'.__('Maximum size exceeded', 'bilnea').'" />';
				break;

			// Selector de semana
			case 'week':

				// Carga de scripts
				wp_enqueue_script('jquery-ui');
				wp_enqueue_style('jquery-ui-css');
				wp_enqueue_style('jquery-ui-css-theme');

				// Construcción del selector
				if (esc_attr($a['label']) == 'true') {
					$out = '<label>'.$var_required.$var_placeholder.'<input class="weekpicker-'.$var_random.' input'.$var_class.'"'.$var_id.' type="text" name="b_i_custom_week" data-name="'.$var_name.'" /></label>'."\n";
				} else {
					$out = '<input class="weekpicker-'.$var_random.' input'.$var_class.'"'.$var_id.' type="text" name="b_i_custom_week" placeholder="'.$var_required.$var_placeholder.'" data-name="'.$var_name.'" />'."\n";
				}
				if ($var_name == '') { $var_name = $var_placeholder; }

				// Script específico
				$out .= '<script type="text/javascript">'."\n";
				$out .= '	jQuery(function($) {'."\n";
				$out .= '		var startDate;'."\n";
				$out .= '		var endDate;'."\n";
				$out .= '		var selectCurrentWeek = function() {'."\n";
				$out .= '			window.setTimeout(function () {'."\n";
				$out .= '				$(\'.weekpickerdiv-'.$var_random.'\').find(\'.ui-datepicker-current-day a\').addClass(\'ui-state-active\')'."\n";
				$out .= '			}, 1);'."\n";
				$out .= '		}'."\n";
				$out .= '		$(\'.weekpicker-'.$var_random.'\').datepicker( {'."\n";
				$out .= '			beforeShow: function(input, inst) {'."\n";
				$out .= '				$(\'#ui-datepicker-div\').addClass(\'weekpickerdiv-'.$var_random.'\');'."\n";
				$out .= '			},'."\n";
				$out .= '			showOtherMonths: true,'."\n";
				$out .= '			selectOtherMonths: true,'."\n";
				$out .= '			showAnim: "fadeIn",'."\n";
				$out .= '			onSelect: function(dateText, inst) { '."\n";
				$out .= '				var date = $(this).datepicker(\'getDate\');'."\n";
				$out .= '				startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay());'."\n";
				$out .= '				endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 6);'."\n";
				$out .= '				var dateFormat = inst.settings.dateFormat || $.datepicker._defaults.dateFormat;'."\n";
				$out .= '				if (typeof callback == \'function\') { callback(\''.$var_random.'\', startDate, endDate); };'."\n";
				$out .= '				selectCurrentWeek();'."\n";
				$out .= '			},'."\n";
				$out .= '			beforeShowDay: function(date) {'."\n";
				$out .= '				var cssClass = \'\';'."\n";
				$out .= '				if(date >= startDate && date <= endDate)'."\n";
				$out .= '					cssClass = \'ui-datepicker-current-day\';'."\n";
				$out .= '				return [true, cssClass];'."\n";
				$out .= '			},'."\n";
				$out .= '			onChangeMonthYear: function(year, month, inst) {'."\n";
				$out .= '				selectCurrentWeek();'."\n";
				$out .= '			}'."\n";
				$out .= '		});'."\n";
				$out .= '		$(\'.weekpickerdiv-'.$var_random.' .ui-datepicker-calendar tr\').live(\'mousemove\', function() { $(this).find(\'td a\').addClass(\'ui-state-hover\'); });'."\n";
				$out .= '		$(\'.weekpickerdiv-'.$var_random.' .ui-datepicker-calendar tr\').live(\'mouseleave\', function() { $(this).find(\'td a\').removeClass(\'ui-state-hover\'); });'."\n";
				$out .= '	});'."\n";
				$out .= '</script>'."\n";
				return $out;
				break;

			// Selector de día
			case 'day':

				// Carga de scripts
				wp_enqueue_script('jquery-ui');
				wp_enqueue_style('jquery-ui-css');
				wp_enqueue_style('jquery-ui-css-theme');

				// Construcción del selector
				if (esc_attr($a['label']) == 'true') {
					$out = '<label>'.$var_required.$var_placeholder.'<input class="datepicker-'.$var_random.' input'.$var_class.'"'.$var_id.' type="text" name="b_i_custom_day" data-name="'.$var_name.'" /></label>'."\n";
				} else {
					$out = '<input class="datepicker-'.$var_random.' input'.$var_class.'"'.$var_id.' type="text" name="b_i_custom_day" placeholder="'.$var_required.$var_placeholder.'" data-name="'.$var_name.'" />'."\n";
				}
				if ($var_name == '') { $var_name = $var_placeholder; }
				
				// Script específico
				$out .= '<script type="text/javascript">'."\n";
				$out .= '	jQuery(function($) {'."\n";
				$out .= '		var startDate;'."\n";
				$out .= '		var endDate;'."\n";
				$out .= '		var selectCurrentWeek = function() {'."\n";
				$out .= '			window.setTimeout(function () {'."\n";
				$out .= '				$(\'.datepickerdiv-'.$var_random.'\').find(\'.ui-datepicker-current-day a\').addClass(\'ui-state-active\')'."\n";
				$out .= '			}, 1);'."\n";
				$out .= '		}'."\n";
				$out .= '		$(\'.datepicker-'.$var_random.'\').datepicker( {'."\n";
				$out .= '			beforeShow: function(input, inst) {'."\n";
				$out .= '				$(\'#ui-datepicker-div\').addClass(\'datepickerdiv-'.$var_random.'\');'."\n";
				$out .= '			},'."\n";
				$out .= '			showOtherMonths: true,'."\n";
				$out .= '			selectOtherMonths: true,'."\n";
				$out .= '			showAnim: "fadeIn",'."\n";
				$out .= '		});'."\n";
				$out .= '	});'."\n";
				$out .= '</script>'."\n";
				return $out;
				break;

			// Selector
			case 'select':
				if ($var_name == '') { $var_name = $var_placeholder; }
				$var_key = rand(0, 99999999);
				if (esc_attr($a['placeholder']) == '') { $var_placeholder = __('Select an option', 'bilnea'); }
				if (esc_attr($a['required']) == 'true') {
					$var_placeholder = '* '.$var_placeholder;
				}
				if (esc_attr($a['label']) == 'true') {
					$out = '<label>'.$var_placeholder.'<select class="input'.$var_class.'"'.$var_id.' name="b_i_custom_select-'.$var_key.'" data-name="'.$var_name.'">'."\n";
				} else {
					$out = '<select class="input'.$var_class.'"'.$var_id.' name="b_i_custom_select-'.$var_key.'" data-name="'.$var_name.'">'."\n";
					$out .= '  <option disabled selected>'.$var_placeholder.'</option>'."\n";
				}
				$var_options = explode('|', esc_attr($a['options']));
				foreach ($var_options as $option) {
					if (count(explode('::', $option)) > 1) {
						$option = explode('::', $option);
						$out .= '  <option value="'.$option[0].'">'.$option[1].'</option>'."\n";
					} else {
						$out .= '  <option value="'.$option.'">'.$option.'</option>'."\n";
					}
				}
				$out .= '</select>'."\n";
				if (esc_attr($a['placeholder']) == '') { $out .= '</label>'; }
				return $out;
				break;

			// Selector
			case 'mailer':
				if ($var_name == '') { $var_name = $var_placeholder; }
				$var_key = rand(0, 99999999);
				if (esc_attr($a['placeholder']) == '') { $var_placeholder = __('Select an option', 'bilnea'); }
				if (esc_attr($a['required']) == 'true') {
					$var_placeholder = '* '.$var_placeholder;
				}
				if (esc_attr($a['label']) == 'true') {
					$out = '<label>'.$var_placeholder.'<select class="input'.$var_class.'"'.$var_id.' name="b_i_custom_select-'.$var_key.'" data-name="'.$var_name.'">'."\n";
				} else {
					$out = '<select class="input'.$var_class.'"'.$var_id.' name="b_i_custom_mailer-'.$var_key.'" data-name="'.$var_name.'">'."\n";
					$out .= '  <option disabled selected>'.$var_placeholder.'</option>'."\n";
				}
				$var_options = explode('|', esc_attr($a['options']));
				foreach ($var_options as $option) {
					if (count(explode('::', $option)) > 1) {
						$option = explode('::', $option);
						$out .= '  <option value="'.b_f_i_encrypt_decrypt('encrypt', $option[0]).'">'.$option[1].'</option>'."\n";
					} else {
						$out .= '  <option value="'.$option.'">'.$option.'</option>'."\n";
					}
				}
				$out .= '</select>'."\n";
				if (esc_attr($a['placeholder']) == '') { $out .= '</label>'; }
				return $out;
				break;

			// Radio
			case 'radio':
				$var_key = rand(0, 99999999);
				if ($var_name == '') { $var_name = 'Opción'; }
				$var_options = explode('|', esc_attr($a['options']));
				if (esc_attr($a['label']) == 'true') {
					$out = '<fieldset><legend>'.$var_required.$var_placeholder.'</legend>';
				} else {
					$out = '';
				}
				foreach ($var_options as $option) {
					$var_random = rand(0, 999);
					if (count(explode(':', $option)) > 1) {
						$option = explode(':', $option);
						$out .= '  <input data-name="'.$var_name.'" class="b_input_radio'.$var_class.'"type="radio" value="'.$option[0].'" name="b_i_custom_radio-'.$var_key.'" id="radio-'.$var_random.'"><label for="radio-'.$var_random.'">'.$option[1].'</label>'."\n";
					} else {
						$out .= '  <input data-name="'.$var_name.'" class="b_input_radio'.$var_class.'"type="radio" value="'.$option.'" name="b_i_custom_radio-'.$var_key.'" id="radio-'.$var_random.'"><label for="radio-'.$var_random.'">'.$option.'</label>'."\n";
					}
				}
				if (esc_attr($a['label']) == 'true') { $out .= '</fieldset>'; }
				return $out;
				break;

			// Nombre (Aparecerá como remitente del mensaje)
			case 'name':
				if ($var_name == '') { $var_name = 'Nombre'; }
				if ($var_placeholder == '' || $var_placeholder = 'null') {
					$var_placeholder = __('Name', 'bilnea');
				}
				if (esc_attr($a['label']) == 'true') {
					return '<label>'.$var_required.$var_placeholder.'<input class="input'.$var_class.'"'.$var_id.' type="text" name="b_i_'.esc_attr($a['type']).'" data-name="'.$var_name.'" /></label>';
				} else {
					return '<input class="input'.$var_class.'"'.$var_id.' type="text" name="b_i_'.esc_attr($a['type']).'" placeholder="'.$var_required.$var_placeholder.'" data-name="'.$var_name.'" />';
				}
				break;

			// Apellidos (Aparecerá como remitente del mensaje)
			case 'last-name':
				if ($var_name == '') { $var_name = 'Apellidos'; }
				if ($var_placeholder == '' || $var_placeholder = 'null') {
					$var_placeholder = __('Last name', 'bilnea');
				}
				if (esc_attr($a['label']) == 'true') {
					return '<label>'.$var_required.$var_placeholder.'<input class="input'.$var_class.'"'.$var_id.' type="text" name="b_i_'.esc_attr($a['type']).'" data-name="'.$var_name.'" /></label>';
				} else {
					return '<input class="input'.$var_class.'"'.$var_id.' type="text" name="b_i_'.esc_attr($a['type']).'" placeholder="'.$var_required.$var_placeholder.'" data-name="'.$var_name.'" />';
				}
				break;

			// Asunto
			case 'subject':
				if ($var_placeholder == '' || $var_placeholder = 'null') {
					$var_placeholder = __('Subject', 'bilnea');
				}
				if (esc_attr($a['label']) == 'true') {
					return '<label>'.$var_required.$var_placeholder.'<input class="input'.$var_class.'"'.$var_id.' type="text" name="b_i_custom_'.esc_attr($a['type']).'"'.((esc_attr($a['prefix']) != null) ? ' data-prefix="'.esc_attr($a['prefix']).'"' : '').' /></label>';
				} else {
					return '<input class="input'.$var_class.'"'.$var_id.' type="text" name="b_i_custom_'.esc_attr($a['type']).'" placeholder="'.$var_required.$var_placeholder.'"'.((esc_attr($a['prefix']) != null) ? ' data-prefix="'.esc_attr($a['prefix']).'"' : '').' />';
				}
				break;

			// Boton de envío
			case 'send':
				if ($var_placeholder == '' || $var_placeholder = 'null') {
					$var_placeholder = __('Send', 'bilnea');
				}
				if (esc_attr($a['sending']) == '') {
					$var_sending = $var_placeholder;
				} else {
					$var_sending = esc_attr($a['sending']);
				}
				return '<div class="form-send" data-send="'.$var_placeholder.'" data-sending="'.$var_sending.'">'.$var_placeholder.'</div>';
				break;

			// Otros campos
			default:
				if ($var_name == '') { $var_name = $var_placeholder; }
				if (substr(esc_attr($a['type']), 0, 9) === 'textarea_') {
					$var_type = str_replace('textarea_', '', esc_attr($a['type']));
					if (esc_attr($a['label']) == 'true') {
						return '<label>'.$var_required.$var_placeholder.'<textarea rows="'.esc_attr($a['length']).'" class="input'.$var_class.'"'.$var_id.' type="text" name="b_i_custom_'.$var_type.'" data-name="'.$var_name.'"></textarea></label>';
					} else {
						return '<textarea rows="'.esc_attr($a['length']).'" class="input'.$var_class.'"'.$var_id.' type="text" name="b_i_custom_'.$var_type.'" placeholder="'.$var_required.$var_placeholder.'" data-name="'.$var_name.'"></textarea>';
					}
				} else if (substr(esc_attr($a['type']), 0, 7) === 'select_') {
					if ($var_name == '') { $var_name = $var_placeholder; }
					$var_key = str_replace('select_', '', esc_attr($a['type']));
					if (esc_attr($a['placeholder']) == '') { $var_placeholder = __('Select an option', 'bilnea'); }
					if (esc_attr($a['required']) == 'true') {
						$var_placeholder = '* '.$var_placeholder;
					}
					if (esc_attr($a['label']) == 'true') {
						$out = '<label>'.$var_placeholder.'<select class="input'.$var_class.'"'.$var_id.' name="b_i_custom_select-'.$var_key.'" data-name="'.$var_name.'">'."\n";
					} else {
						$out = '<select class="input'.$var_class.'"'.$var_id.' name="b_i_custom_select-'.$var_key.'" data-name="'.$var_name.'">'."\n";
						$out .= '  <option disabled selected>'.$var_placeholder.'</option>'."\n";
					}
					$var_options = explode('|', esc_attr($a['options']));
					foreach ($var_options as $option) {
						if (count(explode(':', $option)) > 1) {
							$option = explode(':', $option);
							$out .= '  <option value="'.$option[0].'">'.$option[1].'</option>'."\n";
						} else {
							$out .= '  <option value="'.$option.'">'.$option.'</option>'."\n";
						}
					}
					$out .= '</select>'."\n";
					if (esc_attr($a['placeholder']) == '') { $out .= '</label>'; }
					return $out;
				} else {
					if (esc_attr($a['label']) == 'true') {
						return '<label>'.$var_required.$var_placeholder.'<input class="input'.$var_class.'"'.$var_id.' type="text" name="b_i_custom_'.esc_attr($a['type']).'" data-name="'.$var_name.'" /></label>';
					} else {
						return '<input class="input'.$var_class.'"'.$var_id.' type="text" name="b_i_custom_'.esc_attr($a['type']).'" placeholder="'.$var_required.$var_placeholder.'" data-name="'.$var_name.'" />';
					}
				}
				break;
		}
	}

	add_shortcode('b_input', 'b_s_input');

}

?>