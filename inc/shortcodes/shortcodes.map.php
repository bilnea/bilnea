<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


// Mapa

if (!function_exists('b_s_map')) {

	function b_s_map($atts, $content = null) {

		// Variables globales
		global $b_g_version;

		// Shortcodes dependientes
		add_shortcode('b_marker', 'b_s_marker');
		add_shortcode('b_map_style', 'b_s_map_style');

		// Atributos
		$a = shortcode_atts(array(
			'center' => '37.992900,-1.114391',
			'width' => '1/1',
			'height' => '350px',
			'poi' => 'false',
			'zoom' => 14,
			'drag' => 'true',
			'scroll' => 'true',
			'controls' => 'true',
			'm_control' => 'true',
			'z_control' => 'true',
			'drag' => 'true',
			'class' => null,
		), $atts);

		// Opciones
		(b_f_option('b_opt_apis_gmaps') != '') ? $var_api_key = '&key='.b_f_option('b_opt_apis_gmaps') : $var_api_key = '';

		// Scripts
		wp_enqueue_script('functions-map', get_template_directory_uri().'/js/internal/functions.map.js', array('jquery'), $b_g_version, true);
		wp_enqueue_script('functions-google-map', 'https://maps.googleapis.com/maps/api/js?callback=initMap'.$var_api_key, array('functions-map'), '', false);

		// Variables locales
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
		}

		if (esc_attr($a['class']) != null) {
			$var_class .= ' '.esc_attr($a['class']);
		}

		// Mejora en dispositivos móviles
		wp_is_mobile() ? $var_drag = 'false' : $var_drag = 'true';

		$var_center = esc_attr($a['center']);
		$var_random = rand(100000, 999999);
		$out = '<div id="map-'.$var_random.'" style="width: '.esc_attr($a['width']).'; height: '.esc_attr($a['height']).';" class="'.$var_class.'"></div>'."\n";
		$out .= '<script type="text/javascript">'."\n";
		$out .= '	var map_'.$var_random.';'."\n";
		$out .= '	var map_'.$var_random.';'."\n";
		$out .= '	var center_'.$var_random.' = {lat: '.explode(',', $var_center)[0].', lng: '.explode(',', $var_center)[1].'};'."\n";
		$out .= '	var poi_'.$var_random.' = \''.esc_attr($a['poi']).'\';'."\n";
		$out .= '	var zoom_'.$var_random.' = '.esc_attr($a['zoom']).';'."\n";
		$out .= '	var drag_'.$var_random.' = '.$var_drag.';'."\n";
		$out .= '	var scroll_'.$var_random.' = '.esc_attr($a['scroll']).';'."\n";
		$out .= '	var controls_'.$var_random.' = '.esc_attr($a['controls']).';'."\n";
		$out .= '	var m_control_'.$var_random.' = '.esc_attr($a['m_control']).';'."\n";
		$out .= '	var z_control_'.$var_random.' = '.esc_attr($a['z_control']).';'."\n";
		$out .= '	var markers_'.$var_random.' = new Array();'."\n";
		if (has_shortcode($content, 'b_map_style')) {
			$out .= '	var styles_'.$var_random.' = '.preg_replace("/(.*)(\[b_map_style\])(.*)(\[\/b_map_style\])(.*)/s", "$3", $content).';'."\n";
		} else {
			$out .= '	var_styles_'.$var_random.' = \'\';'."\n";
		}
		$out .= '</script><div class="map-options" data-id="'.$var_random.'">'.do_shortcode($content).'</div>'."\n";

		return $out;
	}

	add_shortcode('b_map', 'b_s_map');

}

if (!function_exists('b_s_marker')) {

	function b_s_marker($atts, $content = null) {

		// Atributos
		$a = shortcode_atts(array(
			'position' => '37.992900,-1.114391',
			'icon' => null,
			'size' => '40',
		), $atts);


		$out = '<script type="text/javascript" id="b_map_script">'."\n";
		$out .= '	var a = jQuery(\'#b_map_script\').closest(\'.map-options\').attr(\'data-id\');'."\n";
		$out .= '	jQuery(\'#b_map_script\').remove(\'attr\', \'id\');'."\n";
		$out .= '		var marker = {'."\n";
		$out .= '			position: {lat: '.explode(',', str_replace(' ', '', esc_attr($a['position'])))[0].', lng: '.explode(',', str_replace(' ', '', esc_attr($a['position'])))[1].'},'."\n";
		$out .= '			map: \'map_\'+a,'."\n";
		if (esc_attr($a['icon']) != null) {
			$out .= '			icon: {'."\n";
			if (is_numeric(esc_attr($a['icon']))) {
				$u = wp_get_attachment_url(esc_attr($a['icon']));
				$out .= '				url: \''.$u.'\','."\n";
			} else {
				$out .= '				url: \''.esc_attr($a['icon']).'\','."\n";
			}
			$out .= '				size: \''.trim(esc_attr($a['size'])).'\''."\n";
			$out .= '			},'."\n";
			if ($content != null) {
				$out .= '		info: \''.$content.'\''."\n";
			}
		}
		$out .= '		};'."\n";
		$out .= '		var b = window[\'markers_\'+a];'."\n";
		$out .= '		b.push(marker);'."\n";
		$out .= '</script>'."\n";

		return $out;

	}	
}

if (!function_exists('b_s_map_style')) {

	function b_s_map_style() {

		return '';

	}	
}

?>