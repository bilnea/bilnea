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

?>