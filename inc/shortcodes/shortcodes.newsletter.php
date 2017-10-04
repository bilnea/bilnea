<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


// Boletín de noticias

if (!function_exists('b_f_newsletter')) {

	if (b_f_option('b_opt_subscribers') == 1) {

		function b_f_newsletter($atts, $content = null) {

			// Variables globales
			global $b_g_language, $b_g_version;

			// Atributos
			$a = shortcode_atts(array(
				'type' => 'name,email',
				'redirect' => b_f_option('b_opt_newsl-thanks-'.$b_g_language),
				'url' => get_permalink(b_f_option('b_opt_privacy-policy-'.$b_g_language)),
			), $atts);

			// Variables locales
			$var_random = rand(100000, 999999);
			$var_temp = explode(',', str_replace(' ', '', $a['type']));

			// Javascript del formulario
			$var_temp = array(
				'text' => __('There are errors on the form. Please fix them before continuing', 'bilnea'),
				'empty' => __('Fill in all the required fields', 'bilnea'),
				'email' => __('Enter a valid email address', 'bilnea'),
				'legal' => __('You must accept the legal advice', 'bilnea'),
				'unsubscribing' => __('Unsubscribing...')
			);

			if (b_f_option('b_opt_newsl_service') == 'mailchimp') {
				wp_register_script('shortcodes.mailchimp', get_template_directory_uri().'/js/internal/shortcodes.mailchimp.js', array('jquery'), $b_g_version, true);
				wp_localize_script('shortcodes.mailchimp', 'nws_errors', $var_temp);
				wp_enqueue_script('shortcodes.mailchimp');
			}


			if ($content == null) {
				
				$out = '<div class="b_newsletters">';
				$out .= '<input class="input" type="text" name="s_name" placeholder="* '.__('Name', 'bilnea').'" />';
				if (in_array('last', $var_temp)) {
					$out .= '<input type="text" name="s_last" placeholder="* '.__('Last name', 'bilnea').'" />';
				}
				$out .= '<input class="input" type="email" name="s_email" placeholder="* '.__('Email', 'bilnea').'" />';
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
				$out .= '<span class="s_delete">'.__('If you want to unsubscribe from our newsletter, click', 'bilnea').' <a>'.__('here', 'bilnea').'.</a></span>';
				$out .= '<div class="s_submit">'.__('Subscribe', 'bilnea').'</div>';
				$out .= '<input type="hidden" class="redirect_to" name="s_redirect" value="'.esc_attr($a['redirect']).'" />';
				$out .= '</div><div class="response"></div>';

				return $out;

			} else {

				// Enlace aviso legal
				$var_legal = '<input class="b_input_checkbox" value="true" type="checkbox" id="s_legal-'.$var_random.'" name="s_legal-'.$var_random.'" />';

				$var_placeholder = __('Privacy policy', 'bilnea');

				switch (substr(explode(' ', $var_placeholder)[0], -1)) {
					case 'a':
						$var_article = _x('the', 'female', 'bilnea');
						break;
					default:
						$var_article = _x('the', 'male', 'bilnea');
						break;
				}

				$var_legal .= '<label for="s_legal-'.$var_random.'">* '.__('I have read, understood and accept', 'bilnea').' '.$var_article.' <a href="'.esc_attr($a['url']).'" title="'.$var_placeholder.'" target="_blank">'.strtolower($var_placeholder).'</a>.</label>';

				// Pseudo shortcodes
				$var_shortcodes = array('{{b_nw_name}}', '{{b_nw_last-name}}', '{{b_nw_email}}', '{{b_nw_legal}}', '{{b_nw_unsubscribe}}', '{{b_nw_send}}');
				$var_replace = array(
					'<input class="input" type="text" name="s_name" placeholder="* '.__('Name', 'bilnea').'" />',
					'<input type="text" name="s_last" placeholder="* '.__('Last name', 'bilnea').'" />',
					'<input class="input" type="email" name="s_email" placeholder="* '.__('Email', 'bilnea').'" />',
					$var_legal,
					'<span class="s_delete">'.__('If you want to unsubscribe from our newsletter, click', 'bilnea').' <a>'.__('here', 'bilnea').'.</a></span>',
					'<div class="s_submit" data-send="'.__('Subscribe', 'bilnea').'" data-sending="'.__('Subscribing', 'bilnea').'">'.__('Subscribe', 'bilnea').'</div>'
				);

				return '<div class="b_newsletters">'.do_shortcode(str_replace($var_shortcodes, $var_replace, $content.'<input name="s_redirect" type="hidden" class="redirect_to" value="'.esc_attr($a['redirect']).'" />')).'</div><div class="response"></div>';

			}
			
		}
		
		add_shortcode('b_newsletter', 'b_f_newsletter');
		add_shortcode('b_newsletters', 'b_f_newsletter');
	}
}