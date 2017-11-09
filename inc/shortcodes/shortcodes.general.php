<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


// Generador de enlaces

if (!function_exists('b_s_link')) {

	function b_s_link($atts, $content = null) {

		// Atributos
		$a = shortcode_atts(array(
			'id' => null,
			'class' => null,
			'nofollow' => false,
			'noindex' => false,
			'target' => null,
			'options' => null,
		), $atts);

		$out = '<a href="'.get_permalink(esc_attr($a['id']), false).'" title="'.get_the_title(esc_attr($a['id'])).'"';

		// Variables locales
		if (esc_attr($a['class']) != null) {
			$out .= ' class="'.esc_attr($a['class']).'"';
		}
		if (esc_attr($a['nofollow']) == true && esc_attr($a['noindex']) == false) {
			$out .= ' rel="nofollow"';
		} else if (esc_attr($a['nofollow']) == false && esc_attr($a['noindex']) == true) {
			$out .= ' rel="noindex"';
		} else if (esc_attr($a['nofollow']) == true && esc_attr($a['noindex']) == true) {
			$out .= ' rel="nofollow,noindex"';
		}
		if (esc_attr($a['target']) == true || esc_attr($a['target']) == 'blank') {
			$out .= ' target="_blank"';
		}
		if ($content == null) {
			$content = get_the_title(esc_attr($a['id']));
		}

		$out .= '>'.do_shortcode($content).'</a>';

		return $out;

	}

	add_shortcode('b_link', 'b_s_link');

}


// Generador de urls

if (!function_exists('b_s_url')) {

	function b_s_url($atts) {
		$a = shortcode_atts(array(
			'id' => null,
		), $atts);
		return get_permalink(esc_attr($a['id']), false);
	}

	add_shortcode('b_url', 'b_s_url');

}


// Directorio principal

if (!function_exists('b_s_root')) {

	function b_s_root() {
		return get_site_url();
	}

	add_shortcode('b_root', 'b_s_root');

}


// Directorio de medios

if (!function_exists('b_s_upload')) {

	function b_s_upload() {
		return wp_upload_dir()['baseurl'];
	}

	add_shortcode('b_uploads', 'b_s_upload');
	add_shortcode('b_upload', 'b_s_upload');

}


// Zona de widgets

if (!function_exists('b_s_widget_area')) {

	function b_s_widget_area($atts) {

		// Atributos
		$a = shortcode_atts(array(
			'class' => null,
			'sidebar' => null,
		), $atts);

		// Variables locales
		if (esc_attr($a['sidebar']) != null) {
			$var_sidebar = esc_attr($a['sidebar']);
		} else {
			if(isset(get_post_custom(get_the_ID())['custom_sidebar'])) {
				$var_sidebar = get_post_custom(get_the_ID())['custom_sidebar'][0];
			} else {
				$var_sidebar = 'default';
			}
		}
		
		$out  = '<aside id="sidebar" class="barra-lateral sidebar-right '.esc_attr($a['class']).'">';

		// Carga de la zona de widgets
		if ($var_sidebar != 'default') {
			ob_start();
			get_sidebar($var_sidebar);
			$out .= ob_get_clean();
		} else {
			ob_start();
			get_sidebar();
			$out .= ob_get_clean();
		}

		$out .= '</aside>';

		return $out;
	}

	add_shortcode('b_sidebar', 'b_s_widget_area');

}


// Migas de pan

if (!function_exists('b_s_breadcrumb')) {
	
	function b_s_breadcrumb($atts) {

		// Atributos
		$a = shortcode_atts(array(
			'separator' => '»',
			'home' => __('Home', 'bilnea'),
			'length' => '1000000',
			'parent' => null
		), $atts);

		//Variables globales
		global $post;
		global $cat;
		global $author;

		// Variables locales
		$var_separator = '<span class="delimiter">'.esc_attr($a['separator']).'</span>';
		$var_home = esc_attr($a['home']);
		$var_length = esc_attr($a['length']);
		$var_date = array(
			'year' => get_the_time('Y'),
			'month' => get_the_time('F'),
			'day' => get_the_time('d'),
			'week' => get_the_time('l')
		);

		if (!is_front_page()) {         
			$out = '<div class="breadcrumb">';
			if ($var_home != 'none') {
				if ($var_home == '/') {
					$out .= '<a href="'.get_option('home').'">/</a> ';
				} else {
					$out .= '<a href="'.get_option('home').'">'.$var_home.'</a> '.$var_separator.' ';
				}
			}
			if (is_single()) {
				$var_category = get_the_category();
				$var_categories = count($var_category);
				if ($var_categories <= 1) {
					$out .= get_category_parents($var_category[0],  true,' '.$var_separator.' ');
					$out .= ' '.get_the_title();
				} else {
					$out .= the_category('<span class="delimiter">|</span>', multiple);
					if (strlen(get_the_title()) >= $var_length) {
						$out .= ' '.$var_separator.' '.trim(substr(get_the_title(), 0, $var_length)).'...';
					} else {
						$out .= ' '.$var_separator.' '.get_the_title();
					}
				}
			} elseif (is_category()) {
				$out .= __('Categories', 'bilnea').': "'.get_category_parents($cat, true,' '.$var_separator.' ').'"' ;
			} elseif (is_tag()) {
				$out .= __('Tags', 'bilnea').': "'.single_tag_title('', false).'"';
			} elseif (is_day()) {
				$out .= '<a href="'.get_year_link($var_date['year']).'">'.$var_date['year'].'</a> '.$var_separator.' ';
				$out .= '<a href="'.get_month_link($var_date['month']).'">'.$var_date['month'].'</a> '.$var_separator.' '.$var_date['day'].' ('.$var_date['week'].')';
			} elseif (is_month()) {
				$out .= '<a href="'.get_year_link($var_date['year']).'">'.$var_date['year'].'</a> '.$var_separator.' '.$var_date['month'];
			} elseif (is_year()) {
				$out .= $var_date['year'];
			} elseif (is_search()) {
				$out .= printf(__('Search results for "%1$s"', 'bilnea'), get_search_query());
			} elseif (is_page() && !$post->post_parent) {
				if (esc_attr($a['parent']) != null) {
					$out .= '<a href="'.get_permalink(esc_attr($a['parent'])).'">'.get_the_title(esc_attr($a['parent'])).'</a> '.$var_separator.' ';
				}
				$out .= get_the_title();
			} elseif (is_page() && $post->post_parent) {
				if (esc_attr($a['parent']) != null) {
					$out .= '<a href="'.get_permalink(esc_attr($a['parent'])).'">'.get_the_title(esc_attr($a['parent'])).'</a> '.$var_separator.' ';
				}
				$post_array = get_post_ancestors($post);
				krsort($post_array); 
				foreach ($post_array as $key => $value) {
					$out .= '<a href="'.get_permalink($value).'">'.get_the_title($value).'</a> '.$var_separator.' ';
				}
				$out .= get_the_title();
			} elseif (is_author()) {
				$var_user = get_userdata($author);
				$out .=  __('Publications of', 'bilnea').': '.$var_user->display_name;
			} elseif (is_404()) {
				$out .=  __('Not found', 'bilnea');
			} else {
			}
			$out .= '</div>';

			return $out;

		}   
	}

	add_shortcode('b_breadcrumb', 'b_s_breadcrumb');

}


// Título

if (!function_exists('b_s_title')) {
	
	function b_s_title() {
		return get_the_title();
	}

	add_shortcode('b_title', 'b_s_title');

}


// Archivos

if (!function_exists('b_s_file')) {

	function b_s_file($atts, $content = null) {

		// Atributo
		$a = shortcode_atts(array(
			'class' => null,
			'id' => null,
			'target' => null,
			'echo' => false,
		), $atts);

		// Variables locales
		(esc_attr($a['class']) != null) ? $var_class = esc_attr($a['class']) : $var_class = '';
		(esc_attr($a['target']) != null) ? $var_target = ' target="blank"': $var_target = '';

		$out = '';

		if (esc_attr($a['id']) != null) {
			$var_id = esc_attr($a['id']);
			$var_url = wp_get_attachment_url($var_id);
			$var_extension = strtolower(pathinfo($var_url, PATHINFO_EXTENSION));
			$var_filename = basename($var_url);
			if ($content == null) {
				$content = $var_filename;
			}
			$var_class .= ' '.$var_extension;
			if (($var_extension == 'png') || ($var_extension == 'gif') || ($var_extension == 'tiff') || ($var_extension == 'jpg') || ($var_extension == 'jpeg')) {
				$out = '<img src="'.$var_url.'" class="'.$var_class.'" />';
			} else if ($var_extension == 'svg') {
				$out = b_f_get_file_content($var_url);
			} else {
				$out = '<a href="'.$var_url.'"'.$var_target.' class="'.$var_class.'">'.$content.'</a>';
			}
		}
		if (esc_attr($a['echo']) == true) {
			return $var_url;
		} else {
			return $out;
		}
	}

	add_shortcode('b_file', 'b_s_file');
}


?>