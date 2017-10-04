<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


// Botón

if (!function_exists('b_s_button')) {

	function b_s_button($atts, $content = null) {

		// Atributos
		$a = shortcode_atts(array(
			'image' => null,
			'bgcolor' => null,
			'url' => null,
			'target' => 0,
			'noindex' => 0,
			'nofollow' => 0,
			'title' => null,
			'width' => '100%',
			'height' => '100%',
		), $atts);
		$col = ''; $url = ''; $aop = ''; $med = '';

		// Variables locales
		$var_style = array();
		$var_attributes = array();
		if (esc_attr($a['width']) != null) {
			array_push($var_style, 'width: '.esc_attr($a['width']).';');
		}
		if (esc_attr($a['height']) != null) {
			array_push($var_style, 'padding-bottom: '.esc_attr($a['height']).';');
		}
		if (esc_attr($a['image']) != null) {
			if (is_numeric(esc_attr($a['image']))) {
				array_push($var_style, 'background-image: url('.wp_get_attachment_url(esc_attr($a['image'])).'); background-position: center;');
			} else {
				array_push($var_style, 'background-image: url('.str_replace('b_root', preg_replace('(^https?://)', '', get_site_url()), esc_url(esc_attr($a['image']))).'); background-position: center;');
			}
		}
		if (esc_attr($a['bgcolor']) != null) {
			array_push($var_style, 'background-color: '.esc_attr($a['bgcolor']).';');
		}
		if (count($var_style) > 0) {
			array_push($var_attributes, 'style="'.implode(' ', $var_style).'"');
		}
		if (esc_attr($a['url']) != null) {
			if (is_numeric(esc_attr($a['url']))) {
				array_push($var_attributes, 'href="'.get_permalink(esc_attr($a['url'])).'"');
			} else {
				array_push($var_attributes, 'href="'.str_replace('b_root', preg_replace('(^https?://)', '', get_site_url()), esc_url(esc_attr($a['url']))).'"');
			}
		}
		if (esc_attr($a['target']) == 'blank' || esc_attr($a['target']) == 'true') {
			array_push($var_attributes, 'target="_blank"');
		}
		if (esc_attr($a['noindex']) != null && esc_attr($a['nofollow']) != null) {
			array_push($var_attributes, 'rel="nofollow, noindex"');
		} elseif (esc_attr($a['index']) != null) {
			array_push($var_attributes, 'rel="noindex"');
		} elseif (esc_attr($a['follow']) != null) {
			array_push($var_attributes, 'rel="nofollow"');
		}
		if (esc_attr($a['title']) != null) {
			array_push($var_attributes, 'title="'.esc_attr($a['title']).'"');
		}

		return '<a'.implode(' ', $var_attributes).' class="boton-overlay"><div class="overlay">'.do_shortcode($content).'</div></a>';
	}

	add_shortcode('b_button', 'b_s_button');

}


// Acordeón

if (!function_exists('b_s_accordion')) {
	
	function b_s_accordion($atts, $content = null) {

		// Scripts
		wp_enqueue_script('b_s_accordion');

		// Shortcode panel acordeón
		add_shortcode('b_accordion_frame', 'b_s_accordion_frame');
		
		// Atributos
		$a = shortcode_atts(array(
			'class' 		=> null,
			'active' 		=> 0,
			'multiple' 		=> false,
			'close'	 		=> false,
		), $atts);

		// Variables locales
		$var_class = array('b_accordion');
		if (esc_attr($a['multiple']) == 'true') {
			array_push($var_class, 'multiple');
		}
		if (esc_attr($a['class']) != null) {
			array_push($var_class, esc_attr($a['class']));
		}
		if (esc_attr($a['close']) == 'true') {
			array_push($var_class, 'c2close');
		}

		return '<div class="'.implode(' ', $var_class).'" data-active="'.esc_attr($a['active']).'">'.do_shortcode($content).'</div>';

	}

	add_shortcode('b_accordion', 'b_s_accordion');

}

if (!function_exists('b_s_accordion_frame')) {
	
	function b_s_accordion_frame($atts, $content = null) {

		// Atributos
		$a = shortcode_atts(array(
			'title' 		=> null,
			'element' 		=> 'h4',
			'class' 		=> null,
			'id' => null,
		), $atts, 'b_a_frame');

		// Variables locales
		$var_class = array('accordion_frame');
		if (esc_attr($a['class']) != null) {
			array_push($var_class, esc_attr($a['class']));
		}
		$var_id = ((esc_attr($a['id']) != null) ? ' id="'.esc_attr($a['id']).'"' : '');

		return '<div'.$var_id.' class="'.implode(' ', $var_class).'"><'.b_f_sanitize(esc_attr($a['element'])).' class="accordion_title">'.esc_attr($a['title']).'</'.b_f_sanitize(esc_attr($a['element'])).'><div class="accordion_content">'.do_shortcode($content).'</div></div>';

	}

}


// Socket

if (!function_exists('b_s_socket')) {
	
	function b_s_socket() {

		$out = '&copy; '.date('Y').' '.get_bloginfo('name').'. ';
	

		// Variables globales
		global $b_g_language;

		// Variables locales
		$var_links = array();

		// Aviso legal
		if (is_numeric(b_f_option('b_opt_legal-advice-'.$b_g_language)) && b_f_option('socket_show_legal-advice') == 1) {
			array_push($var_links, '<a href="'.get_permalink(b_f_option('b_opt_legal-advice-'.$b_g_language)).'" target="_blank" title="'.get_the_title(b_f_option('b_opt_legal-advice-'.$b_g_language)).'" rel="noindex">'.get_the_title(b_f_option('b_opt_legal-advice-'.$b_g_language)).'</a>');
		}
							
		// Política de privacidad
		if (is_numeric(b_f_option('b_opt_privacy-policy-'.$b_g_language)) && b_f_option('socket_show_privacy-policy') == 1) {
			array_push($var_links, '<a href="'.get_permalink(b_f_option('b_opt_privacy-policy-'.$b_g_language)).'" target="_blank" title="'.get_the_title(b_f_option('b_opt_privacy-policy-'.$b_g_language)).'" rel="noindex">'.get_the_title(b_f_option('b_opt_privacy-policy-'.$b_g_language)).'</a>');
		}

		// Política de cookies
		if (is_numeric(b_f_option('b_opt_cookies-policy-'.$b_g_language)) && b_f_option('socket_show_cookies-policy') == 1) {
			array_push($var_links, '<a href="'.get_permalink(b_f_option('b_opt_cookies-policy-'.$b_g_language)).'" target="_blank" title="'.get_the_title(b_f_option('b_opt_cookies-policy-'.$b_g_language)).'" rel="noindex">'.get_the_title(b_f_option('b_opt_cookies-policy-'.$b_g_language)).'</a>');
		}

		// Firma de bilnea
		if (md5(b_f_option('socket_no-development')) != 'e8f00e69e2bc444b3c291110d037eb7d') {
			array_push($var_links, __('Made with <i class="fa fa-heart-o"></i> by', 'bilnea').' <a href="http://bilnea.com" title="'.__('bilnea. Communication & Digital Marketing Agency', 'bilnea').'" target="_blank" rel="nofollow">bilnea</a>');
		}

		$out .= implode(' | ', $var_links);

		return $out;

	}

	add_shortcode('b_socket', 'b_s_socket');
}

?>