<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


// Últimas entradas

if (!function_exists('b_s_recent_posts')) {

	function b_s_recent_posts($atts){

		// Atributos
		$a = shortcode_atts(array(
			'category' => null,
			'posts' => 3,
			'columns' => 3,
			'excerpt' => 'true',
			'image' => 'true',
			'date' => 'true',
			'author' => 'true',
			'order' => 'date',
			'featured' => 'false',
			'type' => 'post',
		), $atts);

		// Variables locales
		$var_categories = explode(',', str_replace(', ', ',', esc_attr($a['category'])));

		function f_t_alter(&$var_item) {
			$var_item = get_cat_ID($var_item);
		}

		array_walk($var_categories, 'f_t_alter');

		// Opciones
		$args = array(
			'post_type' => esc_attr($a['type']),
			'orderby' => esc_attr($a['order']),
			'posts_per_page' => esc_attr($a['method']),
			'showposts' => esc_attr($a['posts']),
			'cat' => implode(',', $var_categories),
			'post__not_in' => array(get_the_ID())
		);

		// Búsqueda
		$query = new WP_Query($args);

		$var_class = 'x1'.esc_attr($a['columns']);

		$out = '<div class="recent-posts">';

		$i = 1;
		
		while($query->have_posts()) : $query->the_post();

			if ((esc_attr($a['featured']) == 'true' && $i == 1) || esc_attr($a['featured']) == 'false') {

				$out .= '<div class="'.$var_class.' featured-post auto-height">';

				if (esc_attr($a['image']) == 'true') {
					$out .= '<a class="recent-posts-image" href="'.get_permalink().'" title="'.get_the_title().'"';
					if (has_post_thumbnail()) {
						$out .= ' style="background-image: url('.wp_get_attachment_image_src(get_post_thumbnail_id(),'full', true)[0].'); background-size: cover;"';
					}
					$out .= '></a>';
				}

				if (esc_attr($a['date']) == 'true' || esc_attr($a['author']) == 'true') {
					$out .= '<div class="meta-info">';
					if (esc_attr($a['author']) == 'true') {
						$out .= '<span class="author">'.__('Published by ', 'bilnea').get_the_author().'</span> ';
					}
					if (esc_attr($a['date']) == 'true' && esc_attr($a['author']) == 'true') {
						$out .= '<span class="date">'.__('the', 'bilnea').' ';
					} else if (esc_attr($a['date']) == 'true') {
						$out .= '<span class="date">';
					}
					if (esc_attr($a['date']) == 'true') {
						$out .= get_the_date().'</span>';
					}
					$out .= '</div>';
				}

				$out .= '<a href="'.get_permalink().'" title="'.get_the_title().'"><h4>'.get_the_title().'</h4></a>';

				if (esc_attr($a['excerpt']) == 'true') {
					if (get_the_excerpt() != '') {
						$out .= '<div class="excerpt">'.get_the_excerpt().'</div>';
					} else {
						$out .= '<div class="excerpt">'.b_f_get_excerpt(get_the_content()).'</div>';
					}
					
					$out .= '<a class="read-more" href="'.get_permalink().'">'.__('Read more', 'bilnea').'</a>';
				}

				$out .= '</div>';
			}

			$i++;

		endwhile;

		if (esc_attr($a['featured']) == 'true') {

			$out .= '<div class="'.$var_class.'">';

			$i = 1;

			while($query->have_posts()) : $query->the_post();

				if ($i > 1) {

					$out .= '<div>';

					if (esc_attr($a['image']) == 'true') {
						$out .= '<a class="recent-posts-image" href="'.get_permalink().'" title="'.get_the_title().'"';
						if (has_post_thumbnail()) {
							$out .= ' style="background-image: url('.wp_get_attachment_image_src(get_post_thumbnail_id(),'full', true)[0].'); background-size: cover;"';
						}
						$out .= '></a>';
					}

					if (esc_attr($a['date']) == 'true' || esc_attr($a['author']) == 'true') {
						$out .= '<div class="meta-info">';
						if (esc_attr($a['author']) == 'true') {
							$out .= '<span class="author">'.__('Published by ', 'bilnea').get_the_author().'</span> ';
						}
						if (esc_attr($a['date']) == 'true' && esc_attr($a['author']) == 'true') {
							$out .= '<span class="date">'.__('the', 'bilnea').' ';
						} else if (esc_attr($a['date']) == 'true') {
							$out .= '<span class="date">';
						}
						if (esc_attr($a['date']) == 'true') {
							$out .= get_the_date().'</span>';
						}
						$out .= '</div>';
					}

					$out .= '<a href="'.get_permalink().'" title="'.get_the_title().'"><h4>'.get_the_title().'</h4></a>';
					
					if (esc_attr($a['excerpt']) == 'true') {
						if (get_the_excerpt() != '') {
							$out .= '<div class="excerpt">'.get_the_excerpt().'</div>';
						} else {
							$out .= '<div class="excerpt">'.b_f_get_excerpt(get_the_content()).'</div>';
						}
						
						$out .= '<a class="read-more" href="'.get_permalink().'">'.__('Read more', 'bilnea').'</a>';
					}

					$out .= '</div>';

				}

				$i++;

			endwhile;

			$out .= '</div>';
		}

		wp_reset_postdata();

		$out .= '</div>';

		return $out;

	}

	add_shortcode('b_recents', 'b_s_recent_posts');
}


// Categorías

if (!function_exists('b_s_categories')) {
	
	function b_s_categories($atts) {

		// Atributos
		$a = shortcode_atts(array(
			'orderby' => 'name',
			'all' => __('All', 'bilnea'),
			'term' => 'category',
			'class' => null,
		), $atts);

		// Variables locales
		$var_options = array(
			'hide_empty' => 0,
			'title_li' => '',
			'echo' => 0,
			'show_option_all' => esc_attr($a['all']),
			'taxonomy' => esc_attr($a['term'])
		);

		return '<ul class="category-wrapper '.esc_attr($a['class']).'">'.wp_list_categories($var_options).'</ul>';
	}

	add_shortcode('b_categories', 'b_s_categories');

}


// Cita

if (!function_exists('b_s_quote')) {
	
	function b_s_quote($atts, $content = null) {

		// Atributos
		$a = shortcode_atts(array(
			'author' => null,
			'class' => null,
		), $atts);
		
		(esc_attr($a['class']) != null) ? $var_class = ' '.esc_attr($a['class']) : $var_class = '';

		$out = '<div class="quote '.$var_class.'">';
		$out .= $content;
		$out .= '<span class="author">'.esc_attr($a['author']).'</span>';
		$out .= '</div>';

		return $out;
	}

	add_shortcode('b_quote', 'b_s_quote');

}


// Caja Twitter

if (!function_exists('b_s_tweeter')) {
	
	function b_s_tweeter($atts, $content = null) {

		// Atributos
		$a = shortcode_atts(array(
			'author' => null,
		), $atts);

		// Variables locales
		$var_author = esc_attr($a['author']);
		if ($var_author != '') {
			return '<div class="tweeter">'.$content.'<div class="tweet-author"><a target="_blank" rel="nofollow" href="https://twitter.com/'.$var_author.'">@'.$var_author.'</div><div class="tweet-link"><a href="https://twitter.com/home?status='.urlencode($content).'%20via%20@'.$var_author.'" class="fa fa-twitter" target="_blank" rel="nofollow">&nbsp;&nbsp;'.__('Tweet this', 'bilnea').'</a></div></div>';
		} else {
			if (b_f_option('b_opt_social-twitter') != '') {
				if (strpos(b_f_option('b_opt_social-twitter'),'twitter.com') === false) {
					if (b_f_option('b_opt_social-twitter')[0] == '@') {
						$var_user = ltrim(b_f_option('b_opt_social-twitter'), '@');
					} else {
						$var_user = b_f_option('b_opt_social-twitter');
					}
				} else {
					preg_match("|https?://(www\.)?twitter\.com/(#!/)?@?([^/]*)|", "http://twitter.com/samuelcerezo", $var_matches);
					$var_user = $var_matches[3];
				}
				return '<div class="tweeter">'.$content.'<div class="tweet-link"><a href="https://twitter.com/home?status='.urlencode($content).'%20vía%20@'.$var_user.'" class="fa fa-twitter" target="_blank" rel="nofollow">&nbsp;&nbsp;'.__('Tweet this', 'bilnea').'</a></div></div>';
			} else {
				return '<div class="tweeter">'.$content.'<div class="tweet-link"><a href="https://twitter.com/home?status='.urlencode($content).'" class="fa fa-twitter" target="_blank" rel="nofollow">&nbsp;&nbsp;'.__('Tweet this', 'bilnea').'</a></div></div>';
			}
		}
	}

	add_shortcode('b_tweet', 'b_s_tweeter');

}


// Caja destacada

if (!function_exists('b_s_borded')) {
	
	function b_s_borded($atts, $content = null) {

		// Atributos
		$a = shortcode_atts(array(
			'color' => null,
		), $atts);

		// Variables locales
		$var_color = esc_attr($a['color']);

		switch ($var_color) {
			case 'verde':
				$var_style = 'color: #9fe8bc;';
				break;
			case 'gris':
				$var_style = 'color: #efefef;';
				break;
			case 'rojo':
				$var_style = 'color: #e8a49f;';
				break;
			default:
				$var_style = 'color: '.$var_color.';';
				break;
		}

		if ($var_color != '') {
			$out = '<div class="b_borded" style="'.$var_style.'">'.$content.'</div>';
		} else {
			$out = '<div class="b_borded">'.$content.'</div>';
		}

		return $out;
	}

	add_shortcode('b_borded', 'b_s_borded');

}


// Caja sombreada

if (!function_exists('b_s_framed')) {
	
	function b_s_framed($atts, $content = null) {

		// Atributos
		$a = shortcode_atts(array(
			'color' => null,
		), $atts);

		// Variables locales
		$var_color = esc_attr($a['color']);

		switch ($var_color) {
			case 'verde':
				$var_style = 'background-color: #9fe8bc;';
				break;
			case 'gris':
				$var_style = 'background-color: #efefef;';
				break;
			case 'rojo':
				$var_style = 'background-color: #e8a49f;';
				break;
			default:
				$var_style = 'background-color: '.$var_color.';';
				break;
		}
		if ($var_color != '') {
			$out = '<div class="b_frame" style="'.$var_style.'">'.$content.'</div>';
		} else {
			$out = '<div class="b_frame">'.$content.'</div>';
		}
		return $out;
	}

	add_shortcode('b_frame', 'b_s_framed');
	
}

?>