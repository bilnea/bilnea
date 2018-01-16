<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


// Galería

if (!function_exists('b_s_gallery')) {

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
			if ((esc_attr($a['columns']%$var_width == 0))) {
				$var_class = '1'.((esc_attr($a['columns']/$var_width)));
			} else {
				$var_class = $var_width.esc_attr($a['columns']);
			}
			$var_sizes = array($var_pixel*$var_width, $var_pixel);
			if (esc_attr($a['lightbox']) == true) {
				$out .= '<a class="x'.$var_class.'" href="'.wp_get_attachment_url($var_id).'" style="background-image: url('.wp_get_attachment_image_src($var_id, 'large')[0].'); background-position: '.$var_position.';"></a>';
			} else {
				$out .= '<div class="x'.$var_class.'" style="background-image: url('.wp_get_attachment_image_src($var_id, 'large')[0].'); background-position: '.$var_position.';">';
			}
		}

		$out .= '</div>';

		return $out;

	}

	add_shortcode('b_gallery', 'b_s_gallery');

}


if (!function_exists('b_s_video')) {

	function b_s_video($atts) {

		// Atributos
		$a = shortcode_atts(array(
			'id' => null,
			'controls' => true,
			'poster' => null,
		), $atts);

		// Variables locales
		$var_url = ((is_numeric(esc_attr($a['id']))) ? get_permalink(esc_attr($a['id'])) : wp_upload_dir()['baseurl'].'/'.esc_attr($a['id']));
		$var_path = pathinfo($var_url, PATHINFO_DIRNAME).'/'.pathinfo($var_url, PATHINFO_FILENAME);
		$var_ext = strtolower(pathinfo($var_url, PATHINFO_EXTENSION));
		return ABSPATH.explode('wp-content', $var_path)[1].'.*';
		$out = '';
		$out .= '<video '.((esc_attr($a['poster']) != null) ? 'poster="'.((is_numeric(esc_attr($a['poster']))) ? get_permalink(esc_attr($a['poster'])) : wp_upload_dir()['baseurl'].'/'.esc_attr($a['poster'])).'" ' : '').'controls="controls">'."\n";
		foreach (glob($var_path.'.*') as $var_filename) {
			$out .= '	<source src="'.$var_path.'"';
			$var_extension = strtolower(pathinfo($var_url, PATHINFO_EXTENSION));
			switch ($var_extension) {
				case 'm4v':
					$out .= ' type="video/mp4"';
					break;
				case 'ogv':
					$out .= ' type="video/ogg"';
					break;
				case 'ogg':
					$out .= ' type="video/ogg"';
					break;
				case 'webm':
					$out .= ' type="video/webm"';
					break;
			}
			$out .= '>'."\n";
		}
		$out .= '	<object type="application/x-shockwave-flash" data="'.get_template_directory_uri().'/inc/flashbox.swf" style="position: relative;">'."\n";
		$out .= '		<param name="movie" value="'.get_template_directory_uri().'/inc/flashbox.swf">'."\n";
		$out .= '		<param name="allowFullScreen" value="true">'."\n";
		$out .= '		<param name="flashVars" value="autoplay=false&amp;controls=true&amp;fullScreenEnabled=true&amp;loop=false&amp;src='.$var_path.'.'.$var_ext.'">'."\n";
		$out .= '		<embed src="'.get_template_directory_uri().'/inc/flashbox.swf" width="853" height="480" style="position:relative;" flashvars="autoplay=false&amp;controls=true&amp;fullScreenEnabled=true&amp;loop=false&amp;src='.$var_path.'.'.$var_ext.'" allowfullscreen="true" wmode="transparent" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer_en">'."\n";
		$out .= '		<img '.((esc_attr($a['poster']) != null) ? 'src="'.((is_numeric(esc_attr($a['poster']))) ? get_permalink(esc_attr($a['poster'])) : wp_upload_dir()['baseurl'].'/'.esc_attr($a['poster'])).'" ' : '').'style="position:absolute; left:0;" width="100%" title="'.__('This browser does not support video playback.', 'bilnea').'">'."\n";
		$out .= '	</object>'."\n";
		$out .= '</video>'."\n";

		return $out;

	}

	add_shortcode('b_video', 'b_s_video');

}