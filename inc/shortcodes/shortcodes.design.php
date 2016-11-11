<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


// Shortcode para crear filas

if (!function_exists('b_s_row')) {

	function b_s_row($atts, $content = null) {

		// Variables globales
		global $b_g_version;

		// Scripts
		wp_enqueue_script('functions-design', get_template_directory_uri().'/js/internal/functions.design.js', array('jquery'), $b_g_version, true);

		// Atributos
		$atts = array_change_key_case((array)$atts, CASE_LOWER);

		$a = shortcode_atts(array(
			'width'=> 'full',
			'class' => null,
			'id' => null,
			'bgcolor' => null,
			'wrap' => 'false',
			'space' => b_f_size('b_opt_column_separator'),
		), $atts);

		// Variables locales
		(esc_attr($a['width']) != 'full') ? $var_class = 'container' : $var_class = '';
		(esc_attr($a['id']) != null) ? $var_id = ' id="'.esc_attr($a['id']).'"' : $var_id = '';
		(esc_attr($a['bgcolor']) != null) ? $var_style = ' style="background-color: '.esc_attr($a['bgcolor']).';"' : $var_style = '';

		if (esc_attr($a['class']) != null) {
			$var_class .= ' '.esc_attr($a['class']);
		}

		if (esc_attr($a['wrap']) == 'true' && esc_attr($a['width']) == 'full') {
			return '<div class="'.$var_class.'"'.$var_id.$var_style.'><div class="container" data-space="'.b_f_size_unit(esc_attr($a['space'])).'">'.do_shortcode($content).'</div></div>';
		} else {
			return '<div class="'.$var_class.'"'.$var_id.$var_style.' data-space="'.b_f_size_unit(esc_attr($a['space'])).'">'.do_shortcode($content).'</div>';
		}

	}

	add_shortcode('b_row', 'b_s_row');

}


// Shortcode para crear cajas

if (!function_exists('b_s_box')) {

	function b_s_box($atts, $content = null) {

		// Variables globales
		global $b_g_version;

		// Scripts
		wp_enqueue_script('shortcodes-design-js', get_template_directory_uri().'/js/internal/shortcodes.design.js', array('jquery'), $b_g_version, true);

		// Atributos
		$atts = array_change_key_case((array)$atts, CASE_LOWER);

		$a = shortcode_atts(array(
			'width' => 1,
			'class' => null,
			'id' => null,
			'height' => null,
			'bgcolor' => null,
		), $atts);

		// Definición del tamaño de la caja
		switch (esc_attr($a['width'])) {
			case '1/1': $var_class = 'x11'; break;
			case '1/2': $var_class = 'x12'; break;
			case '1/3': $var_class = 'x13'; break;
			case '1/4': $var_class = 'x14'; break;
			case '1/5': $var_class = 'x15'; break;
			case '1/6': $var_class = 'x16'; break;
			case '1/7': $var_class = 'x17'; break;
			case '1/8': $var_class = 'x18'; break;
			case '1/9': $var_class = 'x19'; break;
			case '1/10': $var_class = 'x10'; break;
			case '2/2': $var_class = 'x11'; break;
			case '2/3': $var_class = 'x23'; break;
			case '2/4': $var_class = 'x12'; break;
			case '2/5': $var_class = 'x25'; break;
			case '2/6': $var_class = 'x13'; break;
			case '2/7': $var_class = 'x27'; break;
			case '2/8': $var_class = 'x14'; break;
			case '2/9': $var_class = 'x29'; break;
			case '2/10': $var_class = 'x15'; break;
			case '3/3': $var_class = 'x11'; break;
			case '3/4': $var_class = 'x34'; break;
			case '3/5': $var_class = 'x35'; break;
			case '3/6': $var_class = 'x12'; break;
			case '3/7': $var_class = 'x37'; break;
			case '3/8': $var_class = 'x38'; break;
			case '3/9': $var_class = 'x13'; break;
			case '3/10': $var_class = 'x30'; break;
			case '4/4': $var_class = 'x14'; break;
			case '4/5': $var_class = 'x45'; break;
			case '4/6': $var_class = 'x23'; break;
			case '4/7': $var_class = 'x47'; break;
			case '4/8': $var_class = 'x12'; break;
			case '4/9': $var_class = 'x49'; break;
			case '4/10': $var_class = 'x40'; break;
			case '5/5': $var_class = 'x11'; break;
			case '5/6': $var_class = 'x56'; break;
			case '5/7': $var_class = 'x57'; break;
			case '5/8': $var_class = 'x58'; break;
			case '5/9': $var_class = 'x59'; break;
			case '5/10': $var_class = 'x12'; break;
			case '6/6': $var_class = 'x11'; break;
			case '6/7': $var_class = 'x67'; break;
			case '6/8': $var_class = 'x34'; break;
			case '6/9': $var_class = 'x69'; break;
			case '6/10': $var_class = 'x35'; break;
			case '7/7': $var_class = 'x11'; break;
			case '7/8': $var_class = 'x78'; break;
			case '7/9': $var_class = 'x79'; break;
			case '7/10': $var_class = 'x70'; break;
			case '8/8': $var_class = 'x11'; break;
			case '8/9': $var_class = 'x89'; break;
			case '8/10': $var_class = 'x45'; break;
			case '9/9': $var_class = 'x11'; break;
			case '9/10': $var_class = 'x90'; break;
			default: $var_class = 'x11'; break;
		}

		// Variables locales
		if (esc_attr($a['height']) == 'adjust') { $var_class .= ' auto-height'; }
		if (esc_attr($a['class']) != null) { $var_class .= ' '.esc_attr($a['class']); }

		(esc_attr($a['id']) != null) ? $var_id = ' id="'.esc_attr($a['id']).'"' : $var_id = '';
		(esc_attr($a['bgcolor']) != null) ? $var_style = ' style="background-color: '.esc_attr($a['bgcolor']).';"' : $var_style = '';

		return '<div class="'.$var_class.'"'.$var_id.$var_style.'>'.do_shortcode($content).'</div>';
		
	}

	add_shortcode('b_box', 'b_s_box');
	add_shortcode('b_box_inside', 'b_s_box');

}

?>