<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


// Mapa

if (!function_exists('b_s_gallery')) {

	remove_shortcode('gallery');

	function b_s_gallery($atts) {

		// Atributos
		$a = shortcode_atts(array(
			'ids' => null,
			'space' => 0,
			'columns' => 4,
			'lightbox' => true,
			'class' => null,
		), $atts);

		// Variables globales
		$var_ids = trim(esc_attr($a['ids']));
		$var_ids = explode(',', $var_ids);

		// Variables locales
		$var_total = 0;
		$var_space = ((is_numeric(esc_attr($a['space']))) ? esc_attr($a['space']).'px' : esc_attr($a['space']));
		$var_pixel = round(1800/(int)esc_attr($a['columns']));
		$var_class = ((esc_attr($a['class']) == null) ? '' : ' '.esc_attr($a['class']));

		$out = '<div class="b_gallery shortcode_gallery'.$var_class.'" data-space="'.$var_space.'">';

		foreach ($var_ids as $var_id) {
			$var_position = 'center';
			$var_width = 1;
			if (strpos($var_id, ':') !== false) {
				$var_position = explode(':', $var_id)[1];
				$var_width = explode(':', $var_id)[2];
				$var_id = explode(':', $var_id)[0];
			}
			
			$var_total = $var_total + $var_width;
			if ($var_total > esc_attr($a['columns'])) {
				$var_width = esc_attr($a['columns']) - ($var_total - $var_width);
			}
			if ($var_total >= esc_attr($a['columns'])) {
				$var_total = 0;
			}
			$var_sizes = array($var_pixel*$var_width, $var_pixel);
			if (esc_attr($a['lightbox']) == true) {
				$out .= '<a class="x'.$var_width.esc_attr($a['columns']).'" href="'.wp_get_attachment_url($var_id).'" style="background-image: url('.wp_get_attachment_image_src($var_id, 'large')[0].'); background-position: '.$var_position.';"></a>';
			} else {
				$out .= '<div class="x'.$var_width.esc_attr($a['columns']).'" style="background-image: url('.wp_get_attachment_image_src($var_id, 'large')[0].'); background-position: '.$var_position.';">';
			}
		}

		$out .= '</div>';

		return $out;

	}

	add_shortcode('gallery', 'b_s_gallery');
	add_shortcode('b_gallery', 'b_s_gallery');

}