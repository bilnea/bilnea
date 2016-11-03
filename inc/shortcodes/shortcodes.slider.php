<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


// Proyección

if (!function_exists('b_s_slider')) {

	function b_s_slider($atts, $content = null) {
		
		// Variables globales
		global $b_g_version;
		global $b_g_sliders;

		// Scripts
		wp_enqueue_script('functions-slider', get_template_directory_uri().'/js/internal/functions.slider.js', array('jquery'), $b_g_version, true);

		// Shortcodes dependientes
		add_shortcode('b_show', 'b_s_slideshow');

		// Atributos
		$a = shortcode_atts(array(
			'start' => true,
			'on' => 1,
			'fade' => 400,
			'time' => 7,
			'buttons' => true,
			'width' => 1,
			'height' => '400px',
			'id' => null,
		), $atts);

		// Variables locales
		$var_style = ''; 
		$var_class = '';

		(esc_attr($a['id']) != null) ? $var_id = ' id="'.esc_attr($a['id']).'"' : $var_id = '';

		if (esc_attr($a['width']) == 0) {
			$var_class = ' container';
		} elseif (esc_attr($a['width']) > 0 && esc_attr($a['width']) <= 1) {
			$var_style .= 'width: '.(esc_attr($a['width'])*100).'%;';
		} elseif (is_numeric(esc_attr($a['width']))) {
			$var_style .= 'width: '.esc_attr($a['width']).'px';
		} else {
			$var_style .= 'width: '.esc_attr($a['width']);
		}

		if (esc_attr($a['height']) > 0 && esc_attr($a['height']) <= 1) {
			$var_style .= ' height: '.(esc_attr($a['height'])*100).'vh;';
		} elseif (is_numeric(esc_attr($a['height']))) {
			$var_style .= ' height: '.esc_attr($a['height']).'px';
		} else {
			$var_style .= ' height: '.esc_attr($a['height']);
		}

		// Script específico
		$out  = '<div class="slider-'.$b_g_sliders.$var_class.'" style="'.$var_style.'"'.$var_id.'>'.do_shortcode($content).'</div>'."\n";
		$out .= '<script type="text/javascript">'."\n";
		$out .= 'jQuery(function() {'."\n";
		$out .= '	jQuery(\'.slider-'.$b_g_sliders.'\').sss({'."\n";
		$out .= '		slideShow: '.esc_attr($a['start']).','."\n";
		$out .= '		startOn:  '.(esc_attr($a['on'])-1).','."\n";
		$out .= '		transition:  '.esc_attr($a['fade']).','."\n";
		$out .= '		speed:  '.(esc_attr($a['time'])*1000).','."\n";
		$out .= '		showNav:  '.esc_attr($a['buttons'])."\n";
		$out .= '	})'."\n";
		$out .= '})'."\n";
		$out .= '</script>';

		$b_g_sliders++;

		return $out;
		
	}

	add_shortcode('b_slider', 'b_s_slider');

}


// Diapositiva

if (!function_exists('b_s_slideshow')) {

	function b_s_slideshow($atts, $content = null) {

		// Atributos
		$a = shortcode_atts(array(
			'url' => null,
			'position' => 'cc',
			'class' => null,
			'link' => null,
			'target' => null,
			'rel' => 'follow',
		), $atts);

		// Alineación
		switch (esc_attr($a['position'])) {
			case 'cc': $var_position = 'center'; break;
			case 'ct': $var_position = 'center top'; break;
			case 'tc': $var_position = 'center top'; break;
			case 'cb': $var_position = 'center bottom'; break;
			case 'bc': $var_position = 'center bottom'; break;
			case 'lc': $var_position = 'left center'; break;
			case 'cl': $var_position = 'left center'; break;
			case 'rc': $var_position = 'right center'; break;
			case 'cr': $var_position = 'right center'; break;
			case 'lt': $var_position = 'left top'; break;
			case 'tl': $var_position = 'left top'; break;
			case 'rt': $var_position = 'right top'; break;
			case 'tr': $var_position = 'right top'; break;
			case 'lb': $var_position = 'left bottom'; break;
			case 'bl': $var_position = 'left bottom'; break;
			case 'rb': $var_position = 'right bottom'; break;
			case 'br': $var_position = 'right bottom'; break;
			default: $var_position = esc_attr($a['position']); break;
		}

		// Variables locales
		if (esc_attr($a['url']) != null) {
			if (is_numeric(esc_attr($a['url']))) {
				$var_style = ' style="background-image: url('.wp_get_attachment_url(esc_attr($a['url'])).'); background-position: '.$var_position.';"';
			} else {
				$var_style = ' style="background-image: url('.str_replace('b_root', preg_replace('(^https?://)', '', get_site_url()), esc_url(esc_attr($a['url']))).'); background-position: '.$var_position.';"'; 
			}
		}

		(esc_attr($a['class']) != null) ? $var_class = ' data-class="'.esc_attr($a['class']).'"' : $var_class = '';

		if (esc_attr($a['link']) != null) {
			(is_numeric(esc_attr($a['link']))) ? $var_link = get_permalink(esc_attr($a['link'])) : $var_link = esc_attr($a['link']);
			(esc_attr($a['target']) != null) ? $var_atts = ' target="_blank"' : $var_atts = '';

			if (esc_attr($a['rel']) == 'nofollow') {
				$var_atts .= ' rel="nofollow"';
			}
			return '<a href="'.$var_link.'"'.$var_atts.$var_style.$var_class.'>'.do_shortcode($content).'</a>';
		} else { 
			return '<div'.$var_style.$var_class.'>'.do_shortcode($content).'</div>';
		}

	}
}

?>