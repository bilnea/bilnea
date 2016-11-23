<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


// Boletín de noticias

if (!function_exists('b_f_newsletter')) {

	if (b_f_option('b_opt_subscribers') == 1) {

		function b_f_newsletter($atts, $content = null) {

			// Atributos
			$a = shortcode_atts(array(
				'type' => 'name,email',
				'redirect' => b_f_option('b_opt_newsl_redirect'),
			), $atts);

			// Variables locales
			$var_random = rand(100000, 999999);
			$var_temp = explode(',', str_replace(' ', '', $a['type']));

			$out = '<div class="b_newsletters">';
			$out .= '<input class="input" type="text" name="s_name" placeholder="'.__('* Name', 'bilnea').'" />';
			if (in_array('last', $var_temp)) {
				$out .= '<input type="text" name="s_last" placeholder="'.__('* Last name', 'bilnea').'" />';
			}
			$out .= '<input class="input" type="email" name="s_email" placeholder="'.__('* Email', 'bilnea').'" />';
			$out .= '<input class="b_input_checkbox" value="true" type="checkbox" id="s_legal-'.$var_random.'" name="s_legal-'.$var_random.'" />';

			$var_placeholder = __('Privacy policy', 'bilnea');

			switch (substr(explode(' ', $var_placeholder)[0], -1)) {
				case 'a':
					$art = _x('the', 'female', 'bilnea');
					break;
				default:
					$art = _x('the', 'male', 'bilnea');
					break;
			}

			$out .= '<label for="s_legal-'.$var_random.'">* '.__('I have read, understood and accept', 'bilnea').' '.$art.' <a href="'.esc_attr($a['url']).'" title="'.$var_placeholder.'" target="_blank">'.strtolower($var_placeholder).'</a>.</label>';
			$out .= '<div class="s_submit">'.__('Suscribe', 'bilnea').'</div>';

			if (b_f_option('b_opt_newsl_service') == 'mailchimp') {
				$api_key = b_f_option('b_opt_newsl_api');
				wp_enqueue_script('b_mailchimp', get_template_directory_uri().'/js/mailchimp.js', array('jquery'), $version, true);
			}

			$out .= '<input type="hidden" class="redirect_to" value="'.esc_attr($a['redirect']).'" />';
			$out .= '</div>';

			return $out;
			
		}
		
		add_shortcode('b_newsletters', 'b_f_newsletter');
	}
}