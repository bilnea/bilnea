<?php





function b_f_button($atts, $content = null) {
	$a = shortcode_atts(array(
		'img' => get_template_directory_uri().'/img/empty-grid.png',
		'bgcolor' => null,
		'url' => null,
		'target' => 0,
		'index' => 0,
		'follow' => 0,
		'title' => null,
		'width' => '100%',
		'height' => '100%',
	), $atts);
	$img = ''; $col = ''; $url = ''; $aop = ''; $med = '';
	if (esc_attr($a['width']) != null) { $med .= ' width: '.esc_attr($a['width']).';'; }
	if (esc_attr($a['height']) != null) { $med .= ' padding-bottom: '.esc_attr($a['height']).';'; }
	if (esc_attr($a['img']) != null) { $img = ' style="background-image: url('.str_replace('b_root', preg_replace('(^https?://)', '', get_site_url()), esc_url(esc_attr($a['img']))).'); background-position: center;'.$med.'"'; }
	if (esc_attr($a['bgcolor']) != null) { $col = ' style="background-color: '.esc_attr($a['bgcolor']).';"'; }
	if (esc_attr($a['url']) != null) {
		if (is_numeric(esc_attr($a['url']))) {
			$url = ' href="'.get_permalink(esc_attr($a['url']), false).'"';
		} else {
			$url = ' href="'.str_replace('b_root', preg_replace('(^https?://)', '', get_site_url()), esc_url(esc_attr($a['url']))).'"';
		}
	}
	if (esc_attr($a['target']) == 1) { $aop .= ' target="_blank"'; }
	if (esc_attr($a['index']) == 1 && esc_attr($a['f']) == 1) { $aop .= ' rel="nofollow, noindex"'; }
	elseif (esc_attr($a['index']) == 1) { $aop .= ' rel="noindex"'; }
	elseif (esc_attr($a['follow']) == 1) { $aop .= ' rel="nofollow"'; }
	if (esc_attr($a['title']) != null) { $aop .= ' title="'.esc_attr($a['title']).'"'; }
	return '<a'.$url.$aop.$img.' class="boton-overlay"><div class="overlay"'.$col.'>'.do_shortcode($content).'</div></a>';
}

add_shortcode('b_button', 'b_f_button');

function b_f_link($atts, $content = null) {
	$a = shortcode_atts(array(
		'id' => null,
		'class' => null,
		'nofollow' => false,
		'noindex' => false,
		'target' => null,
		'options' => null,
	), $atts);
	$out = '<a href="'.get_permalink(esc_attr($a['id']), false).'" title="'.get_the_title(esc_attr($a['id'])).'"';
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

add_shortcode('b_link', 'b_f_link');

function b_f_url($atts) {
	$a = shortcode_atts(array(
		'id' => null,
	), $atts);
	return get_permalink(esc_attr($a['id']), false);
}

add_shortcode('b_url', 'b_f_url');


// b_f_input
// Genera campos de formulario

function b_f_input($atts) {

	// Variables globales
	global $b_g_lang;

	// Atributos
	$a = shortcode_atts(array(
		'id' => null,
		'class' => null,
		'type' => 'text',
		'required' => 'false',
		'placeholder' => '',
		'length' => 5,
		'allow' => '',
		'options' => null,
		'data' => null,
		'size' => '5MB',
		'label' => null,
		'url' => b_f_option('b_opt_privacy-policy-'.$b_g_lang),
	), $atts);

	// Número aleatorio para identificar el campo
	$var_random = rand(10000, 99999);
	
	// Variables específicas
	(esc_attr($a['class']) != null) ? $var_class = ' '.esc_attr($a['class']) : $var_class = '';
	if (esc_attr($a['required']) == 'true') {
		$var_class .= ' required';
		$var_required = '* ';
	} else {
		$var_required = '';
	}
	(esc_attr($a['id']) != null) ? $var_id = ' id="'.esc_attr($a['id']).'"' : $var_id = '';
	(esc_attr($a['placeholder']) == 'null') ? $var_placeholder = '' : $var_placeholder = esc_attr($a['placeholder']);

	// Construcción del campo
	switch (esc_attr($a['type'])) {

		// Correo electrónico
		case 'email':
			if (esc_attr($a['placeholder']) == '') { $var_placeholder = __('Email', 'bilnea'); }
			if (esc_attr($a['label']) == 'true') {
				return '<label>'.$var_required.$var_placeholder.'<input class="input'.$var_class.'"'.$var_id.' type="text" name="b_i_email" /></label>';
			} else {
				return '<input class="input'.$var_class.'"'.$var_id.' type="text" name="b_i_email" placeholder="'.$var_required.$var_placeholder.'" />';
			}
			break;

		// Mensaje
		case 'message':
			if (esc_attr($a['placeholder']) == '') { $var_placeholder = __('Message', 'bilnea'); }
			if (esc_attr($a['label']) == 'true') {
				return '<label>'.$var_required.$var_placeholder.'<textarea name="b_i_message" class="input'.$var_class.'"'.$var_id.'></textarea></label>';
			} else {
				return '<textarea name="b_i_message" class="input'.$var_class.'"'.$var_id.' placeholder="'.$var_required.$var_placeholder.'"></textarea>';
			}
			break;

		// Selector de provincia
		case 'state':

			// Datos externos
			require_once('data/states.php');

			if (esc_attr($a['placeholder']) == '') { $var_placeholder = __('State', 'bilnea'); }
			if (esc_attr($a['label']) == 'true') {
				$out = '<label>'.$var_required.$var_placeholder.'<select name="b_i_state" class="input'.$var_class.'"'.$var_id.'>';
			} else {
				$out = '<select name="b_i_state" class="input'.$var_class.'"'.$var_id.'><option selected disabled>'.$var_required.$var_placeholder.'</option>';
			}
			if (esc_attr($a['data']) == null) {
				foreach ($b_d_state as $key => $value) {
					$out .= '<option value="'.$key.'--'.$value.'">'.$value.'</option>';
				}
			}
			$out .= '</select>';
			if (esc_attr($a['label']) == 'true') { $out .= '</label>'; }
			return $out;
			break;

		// Aviso legal
		case 'legal':
			if (esc_attr($a['placeholder']) == '') { $var_placeholder = __('Privacy policy', 'bilnea'); }
			switch (substr(explode(' ', $var_placeholder)[0], -1)) {
				case 'a':
					$var_gendre = _x('the', 'female', 'bilnea');
					break;
				default:
					$var_gendre = _x('the', 'male', 'bilnea');
					break;
			}
			$out  = '<input class="b_input_checkbox'.$var_class.'" id="legal-'.$var_random.'" type="checkbox" name="b_i_legal">';
			$out .= '<label for="legal-'.$var_random.'" class="'.esc_attr($a['class']).'">'.$var_required.__('I have read, understood and accept', 'bilnea').' '.$var_gendre.' <a href="'.esc_attr($a['url']).'" title="'.$var_placeholder.'" target="_blank">'.strtolower($var_placeholder).'</a>.</label>';
			return $out;
			break;

		// Verificación captcha
		case 'captcha':
			session_start();
			$var_captcha = rand(0, 99999999);
			do {
				$var_md5 = md5(microtime()*mktime());
				preg_replace('([1aeilou0])', "", $var_md5 );
			} while (strlen($var_md5) < esc_attr($a['length']));
			$var_key = substr( $var_md5, 0, esc_attr($a['length']) );
			$_SESSION['key-'.$var_captcha] = md5($var_key);
			$var_character = str_split($var_key);
			if (esc_attr($a['label']) == 'true') {
				$out = '<div class="captcha input'.$var_class.'"'.$var_id.' data-id="'.$var_captcha.'">'.$var_required.sprintf(__('Fill in the following field with <strong>"%s"</strong>', 'bilnea'), $var_key).'<br />';
				$out .= '<input type="text" class="captcha required" name="captcha[]" id="captcha_unique" size="'.esc_attr($a['length']).'" maxlength="'.esc_attr($a['length']).'">';
			} else {
				$out = '<div class="captcha input'.$var_class.'"'.$var_id.' data-id="'.$var_captcha.'">'.$var_required.__('Fill in the following fields.', 'bilnea').'<br />';
				$i = 1;
				foreach ($var_character as $let) {
					$out .= '<input type="text" class="captcha required" name="captcha[]" id="captcha_'.$i.'" placeholder="'.$let.'" size="1" maxlength="1">';
					$i++;
				}
				$out .= '</div>';
			}
			return $out;
			break;

		// Archivo adjunto
		case 'file':
			$ftp = '';
			if (esc_attr($a['allow']) != '') { $ftp = ' accept="'.esc_attr($a['allow']).'"'; }
			return '<div class="file-button"><div class="icon"></div><div class="text">'.esc_attr($a['placeholder']).'</div></div><input class="input'.$var_class.'"'.$var_id.' type="file"'.$ftp.' name="'.esc_attr($a['type']).'" multiple data-empty="'.__('No selected file', 'bilnea').'" data-size="'.b_f_to_bytes(esc_attr($a['size'])).'" data-size-error="'.__('Maximum size exceeded', 'bilnea').'" />';
			break;

		// Selector de semana
		case 'week':

			// Carga de scripts
			wp_enqueue_script('jquery-ui');
			wp_enqueue_style('jquery-ui-css');
			wp_enqueue_style('jquery-ui-css-theme');

			// Construcción del selector
			if (esc_attr($a['label']) == 'true') {
				$out = '<label>'.$var_required.$var_placeholder.'<input class="weekpicker-'.$var_random.' input'.$var_class.'"'.$var_id.' type="text" name="weekpicker" /></label>'."\n";
			} else {
				$out = '<input class="weekpicker-'.$var_random.' input'.$var_class.'"'.$var_id.' type="text" name="weekpicker" placeholder="'.$var_required.$var_placeholder.'" />'."\n";
			}

			// Script específico
			$out .= '<script type="text/javascript">'."\n";
			$out .= '	jQuery(function($) {'."\n";
			$out .= '		var startDate;'."\n";
			$out .= '		var endDate;'."\n";
			$out .= '		var selectCurrentWeek = function() {'."\n";
			$out .= '			window.setTimeout(function () {'."\n";
			$out .= '				$(\'.weekpickerdiv-'.$var_random.'\').find(\'.ui-datepicker-current-day a\').addClass(\'ui-state-active\')'."\n";
			$out .= '			}, 1);'."\n";
			$out .= '		}'."\n";
			$out .= '		$(\'.weekpicker-'.$var_random.'\').datepicker( {'."\n";
			$out .= '			beforeShow: function(input, inst) {'."\n";
			$out .= '				$(\'#ui-datepicker-div\').addClass(\'weekpickerdiv-'.$var_random.'\');'."\n";
			$out .= '			},'."\n";
			$out .= '			showOtherMonths: true,'."\n";
			$out .= '			selectOtherMonths: true,'."\n";
			$out .= '			showAnim: "fadeIn",'."\n";
			$out .= '			onSelect: function(dateText, inst) { '."\n";
			$out .= '				var date = $(this).datepicker(\'getDate\');'."\n";
			$out .= '				startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay());'."\n";
			$out .= '				endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 6);'."\n";
			$out .= '				var dateFormat = inst.settings.dateFormat || $.datepicker._defaults.dateFormat;'."\n";
			$out .= '				if (typeof callback == \'function\') { callback(\''.$var_random.'\', startDate, endDate); };'."\n";
			$out .= '				selectCurrentWeek();'."\n";
			$out .= '			},'."\n";
			$out .= '			beforeShowDay: function(date) {'."\n";
			$out .= '				var cssClass = \'\';'."\n";
			$out .= '				if(date >= startDate && date <= endDate)'."\n";
			$out .= '					cssClass = \'ui-datepicker-current-day\';'."\n";
			$out .= '				return [true, cssClass];'."\n";
			$out .= '			},'."\n";
			$out .= '			onChangeMonthYear: function(year, month, inst) {'."\n";
			$out .= '				selectCurrentWeek();'."\n";
			$out .= '			}'."\n";
			$out .= '		});'."\n";
			$out .= '		$(\'.weekpickerdiv-'.$var_random.' .ui-datepicker-calendar tr\').live(\'mousemove\', function() { $(this).find(\'td a\').addClass(\'ui-state-hover\'); });'."\n";
			$out .= '		$(\'.weekpickerdiv-'.$var_random.' .ui-datepicker-calendar tr\').live(\'mouseleave\', function() { $(this).find(\'td a\').removeClass(\'ui-state-hover\'); });'."\n";
			$out .= '	});'."\n";
			$out .= '</script>'."\n";
			return $out;
			break;

		// Selector de día
		case 'day':

			// Carga de scripts
			wp_enqueue_script('jquery-ui');
			wp_enqueue_style('jquery-ui-css');
			wp_enqueue_style('jquery-ui-css-theme');

			// Construcción del selector
			if (esc_attr($a['label']) == 'true') {
				$out = '<label>'.$var_required.$var_placeholder.'<input class="datepicker-'.$var_random.' input'.$var_class.'"'.$var_id.' type="text" name="datepicker" /></label>'."\n";
			} else {
				$out = '<input class="datepicker-'.$var_random.' input'.$var_class.'"'.$var_id.' type="text" name="datepicker" placeholder="'.$var_required.$var_placeholder.'" />'."\n";
			}
			
			// Script específico
			$out .= '<script type="text/javascript">'."\n";
			$out .= '	jQuery(function($) {'."\n";
			$out .= '		var startDate;'."\n";
			$out .= '		var endDate;'."\n";
			$out .= '		var selectCurrentWeek = function() {'."\n";
			$out .= '			window.setTimeout(function () {'."\n";
			$out .= '				$(\'.datepickerdiv-'.$var_random.'\').find(\'.ui-datepicker-current-day a\').addClass(\'ui-state-active\')'."\n";
			$out .= '			}, 1);'."\n";
			$out .= '		}'."\n";
			$out .= '		$(\'.datepicker-'.$var_random.'\').datepicker( {'."\n";
			$out .= '			beforeShow: function(input, inst) {'."\n";
			$out .= '				$(\'#ui-datepicker-div\').addClass(\'datepickerdiv-'.$var_random.'\');'."\n";
			$out .= '			},'."\n";
			$out .= '			showOtherMonths: true,'."\n";
			$out .= '			selectOtherMonths: true,'."\n";
			$out .= '			showAnim: "fadeIn",'."\n";
			$out .= '		});'."\n";
			$out .= '	});'."\n";
			$out .= '</script>'."\n";
			return $out;
			break;

		// Selector
		case 'select':
			$var_key = rand(0, 99999999);
			if (esc_attr($a['placeholder']) == '') { $var_placeholder = __('Select an option', 'bilnea'); }
			if (esc_attr($a['label']) == 'true') {
				$out = '<label><select class="input'.$var_class.'"'.$var_id.' name="b_i_select-'.$var_key.'">'."\n";
			} else {
				$out = '<select class="input'.$var_class.'"'.$var_id.' name="b_i_select-'.$var_key.'">'."\n";
				$out .= '  <option disabled selected>'.$var_placeholder.'</option>'."\n";
			}
			$var_options = explode('|', esc_attr($a['options']));
			foreach ($var_options as $option) {
				if (count(explode(':', $option)) > 1) {
					$option = explode(':', $option);
					$out .= '  <option value="'.$option[0].'">'.$option[1].'</option>'."\n";
				} else {
					$out .= '  <option value="'.$option.'">'.$option.'</option>'."\n";
				}
			}
			$out .= '</select>'."\n";
			if (esc_attr($a['placeholder']) == '') { $out .= '</label>'; }
			return $out;
			break;

		// Radio
		case 'radio':
			$var_key = rand(0, 99999999);
			$var_options = explode('|', esc_attr($a['options']));
			if (esc_attr($a['label']) == 'true') {
				$out = '<fieldset><legend>'.$var_required.$var_placeholder.'</legend>';
			} else {
				$out = '';
			}
			foreach ($var_options as $option) {
				$var_random = rand(0, 999);
				if (count(explode(':', $option)) > 1) {
					$option = explode(':', $option);
					$out .= '  <input class="b_input_radio'.$var_class.'"type="radio" value="'.$option[0].'" name="b_i_radio-'.$var_key.'" id="radio-'.$var_random.'"><label for="radio-'.$var_random.'">'.$option[1].'</label>'."\n";
				} else {
					$out .= '  <input class="b_input_radio'.$var_class.'"type="radio" value="'.$option.'" name="b_i_radio-'.$var_key.'" id="radio-'.$var_random.'"><label for="radio-'.$var_random.'">'.$option.'</label>'."\n";
				}
			}
			if (esc_attr($a['label']) == 'true') { $out .= '</fieldset>'; }
			return $out;
			break;

		// Otros campos
		default:
			return '<input class="input'.$var_class.'"'.$var_id.' type="text" name="b_i_custom_'.esc_attr($a['type']).'" placeholder="'.$ob.$var_placeholder.'" />';
			break;
	}
}

add_shortcode('b_input', 'b_f_input');


// b_f_form
// Genera un formulario.

function b_form($atts, $content = null) {

	// Atributos
	$a = shortcode_atts(array(
		'id' => null,
		'class' => null,
		'email' => true,
		'to' => b_f_option('b_opt_form-email'),
		'message' => __('Your message has been sent sucesfully. Your request will delay. A copy has been sent to your email.', 'bilnea'),
		'send' => __('Send', 'bilnea'),
		'redirect' => b_f_option('b_opt_form-thanks'),
		'subject' => sprintf(esc_html__('Message sent from %s website form', 'bilnea'), get_option('blogname'))
	), $atts);

	// Variables globales
	global $b_g_version;

	// Número aleatorio para identificar al formulario
	$var_random = rand(0, 99999999);

	// Dirección IP del visitante
	$var_ip = '';
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$var_ip = ' '.$_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$var_ip = ' '.$_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$var_ip = ' '.$_SERVER['REMOTE_ADDR'];
	}
	
	// Variables específicas
	(esc_attr($a['class']) != null) ? $var_class = ' '.esc_attr($a['class']) : $var_class = '';
	(esc_attr($a['id']) != null) ? $var_id = ' id="'.esc_attr($a['id']).'"' : $var_id = '';

	// Variables de sesión
	$_SESSION['b_form_'.$var_random.'-to'] = esc_attr($a['to']);
	$_SESSION['b_form_'.$var_random.'-success'] = esc_attr($a['message']);
	$_SESSION['b_form_'.$var_random.'-subject'] = esc_attr($a['subject']);

	// Redirección del formulario
	if (esc_attr($a['redirect']) == 'true' && is_numeric(b_f_option('b_opt_form-thanks'))) {
		$_SESSION['b_form_'.$var_random.'-redirect'] = b_f_option('b_opt_form-thanks');
	}
	if (is_numeric(esc_attr($a['redirect']))) {
		$_SESSION['b_form_'.$var_random.'-redirect'] = esc_attr($a['redirect']);
	}

	// Javascript del formulario
	wp_enqueue_script('b_form', get_template_directory_uri().'/js/form.js', array(), $b_g_version, true);

	// Construcción del formulario
	$out = '<form class="form'.$var_class.'"'.$var_id.' method="post" data-id="'.$var_random.'">';
	$out .= do_shortcode($content);
	$out .= '<input type="hidden" value="'.$var_ip.'" name="b_form_ip" id="ip" />';
	$out .= '</form>';
	$out .= '<div id="form-send" data-send="'.esc_attr($a['send']).'" data-sending="'.__('Sending', 'bilnea').'" data-id="'.$var_random.'">'.esc_attr($a['send']).'</div>';
	$out .= '<div class="response"></div>';

	return $out;
}

add_shortcode('b_form', 'b_form');

function root() {
	return get_site_url();
}

add_shortcode('b_root', 'root');

function uploads() {
	return wp_upload_dir()['baseurl'];
}

add_shortcode('b_uploads', 'uploads');

function b_f_s_recent_posts($atts){
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
	$cat = explode(',', str_replace(', ', ',', esc_attr($a['category'])));
	function alterar(&$item) {
		$item = get_cat_ID($item);
	}
	array_walk($cat, 'alterar');
	$query = new WP_Query(
		array(
			'post_type' => esc_attr($a['type']),
			'orderby' => esc_attr($a['order']),
			'posts_per_page' => esc_attr($a['method']),
			'showposts' => esc_attr($a['posts']),
			'cat' => implode(',', $cat),
		)
	);
	switch (esc_attr($a['columns'])) {
		case 1: $fw = 'x11'; break;
		case 2: $fw = 'x12'; break;
		case 3: $fw = 'x13'; break;
		case 4: $fw = 'x14'; break;
		case 5: $fw = 'x15'; break;
		case 6: $fw = 'x16'; break;
	}
	$e = '<div class="recent-posts">';
	$i = 1;
	while($query->have_posts()) : $query->the_post();
		if ((esc_attr($a['featured']) == 'true' && $i == 1) || esc_attr($a['featured']) == 'false') {
			$e .= '<div class="'.$fw.' featured-post auto-height">';
			if (esc_attr($a['image']) == 'true') {
				$e .= '<a class="recent-posts-image" href="'.get_permalink().'" title="'.get_the_title().'"';
				if (has_post_thumbnail()) {
					$e .= ' style="background-image: url('.wp_get_attachment_image_src(get_post_thumbnail_id(),'full', true)[0].'); background-size: cover;"';
				}
				$e .= '></a>';
			}
			if (esc_attr($a['date']) == 'true' || esc_attr($a['author']) == 'true') {
				$e .= '<div class="meta-info">';
				if (esc_attr($a['author']) == 'true') {
					$e .= '<span class="author">'.__('Published by ', 'bilnea').get_the_author().'</span> ';
				}
				if (esc_attr($a['date']) == 'true' && esc_attr($a['author']) == 'true') {
					$e .= '<span class="date">'.__('the', 'bilnea').' ';
				} else if (esc_attr($a['date']) == 'true') {
					$e .= '<span class="date">';
				}
				if (esc_attr($a['date']) == 'true') {
					$e .= get_the_date().'</span>';
				}
				$e .= '</div>';
			}
			$e .= '<a href="'.get_permalink().'" title="'.get_the_title().'"><h4>'.get_the_title().'</h4></a>';
			if (esc_attr($a['excerpt']) == 'true') {
				if (get_the_excerpt() != '') {
					$e .= '<div class="excerpt">'.get_the_excerpt().'</div>';
				} else {
					$e .= '<div class="excerpt">'.b_f_get_excerpt(get_the_content()).'</div>';
				}
				
				$e .= '<a class="read-more" href="'.get_permalink().'">'.__('Read more', 'bilnea').'</a>';
			}
			$e .= '</div>';
		}
		$i++;
	endwhile;
	if (esc_attr($a['featured']) == 'true') {
		$e .= '<div class="'.$fw.'">';
		$i = 1;
		while($query->have_posts()) : $query->the_post();
			if ($i > 1) {
				$e .= '<div>';
				if (esc_attr($a['image']) == 'true') {
					$e .= '<a class="recent-posts-image" href="'.get_permalink().'" title="'.get_the_title().'"';
					if (has_post_thumbnail()) {
						$e .= ' style="background-image: url('.wp_get_attachment_image_src(get_post_thumbnail_id(),'full', true)[0].'); background-size: cover;"';
					}
					$e .= '></a>';
				}
				if (esc_attr($a['date']) == 'true' || esc_attr($a['author']) == 'true') {
					$e .= '<div class="meta-info">';
					if (esc_attr($a['author']) == 'true') {
						$e .= '<span class="author">'.__('Published by ', 'bilnea').get_the_author().'</span> ';
					}
					if (esc_attr($a['date']) == 'true' && esc_attr($a['author']) == 'true') {
						$e .= '<span class="date">'.__('the', 'bilnea').' ';
					} else if (esc_attr($a['date']) == 'true') {
						$e .= '<span class="date">';
					}
					if (esc_attr($a['date']) == 'true') {
						$e .= get_the_date().'</span>';
					}
					$e .= '</div>';
				}
				$e .= '<a href="'.get_permalink().'" title="'.get_the_title().'"><h4>'.get_the_title().'</h4></a>';
				if (esc_attr($a['excerpt']) == 'true') {
					if (get_the_excerpt() != '') {
						$e .= '<div class="excerpt">'.get_the_excerpt().'</div>';
					} else {
						$e .= '<div class="excerpt">'.b_f_get_excerpt(get_the_content()).'</div>';
					}
					
					$e .= '<a class="read-more" href="'.get_permalink().'">'.__('Read more', 'bilnea').'</a>';
				}
				$e .= '</div>';
			}
			$i++;
		endwhile;
		$e .= '</div>';
	}
	wp_reset_query();
	$e .= '</div>';
	return $e;
}

add_shortcode('b_rposts', 'b_f_s_recent_posts');

function b_f_select_sidebar($atts) {
	$a = shortcode_atts(array(
		'class' => null,
	), $atts);
	$opc = get_post_custom(get_the_ID());
	if(isset($opc['custom_sidebar'])) {
		$barra_lateral = $opc['custom_sidebar'][0];
	} else {
		$barra_lateral = 'default';
	}
	$out  = '<aside id="sidebar" class="barra-lateral sidebar-right '.esc_attr($a['class']).'">';
	if($barra_lateral && $barra_lateral != 'default') {
		ob_start();
		get_sidebar('custom');
		$out .= ob_get_clean();
	} else {
		ob_start();
		get_sidebar();
		$out .= ob_get_clean();
	}
	$out .= '</aside>';
	return $out;
}

add_shortcode('b_sidebar', 'b_f_select_sidebar');

function b_f_breadcrumb($atts) {
	$a = shortcode_atts(array(
		'separator' => '»',
		'home' => __('Home', 'bilnea'),
		'length' => '1000000',
	), $atts);
	$sep = '<span class="delimiter">'.esc_attr($a['separator']).'</span>';
	$hom = esc_attr($a['home']);
    $len = esc_attr($a['length']);
	$any = get_the_time('Y');
	$mes = get_the_time('F');
	$day = get_the_time('d');
	$sem = get_the_time('l');
	$url_any = get_year_link($arc_year);  
    $url_month = get_month_link($arc_year,$arc_month);
	if (!is_front_page()) {         
		$out = '<div class="breadcrumb">';
		global $post, $cat;         
		$url = get_option('home');
		if ($hom != 'none') {
			if ($hom == '/') {
				$out .= '<a href="'.$url.'">/</a> ';
			} else {
				$out .= '<a href="'.$url.'">'.$hom.'</a> '.$sep.' ';
			}
		}
		if (is_single()) {
			$cat = get_the_category();
            $tot_cat = count($cat);
			if ($tot_cat <= 1) {
				$out .= get_category_parents($cat[0],  true,' '.$sep.' ');
                $out .= ' '.get_the_title();
            } else {
                $out .= the_category('<span class="delimiter">|</span>', multiple);
				if (strlen(get_the_title()) >= $len) {
					$out .= ' '.$sep.' '.trim(substr(get_the_title(), 0, $len)).'...';
				} else {
					$out .= ' '.$sep.' '.get_the_title();
				}
			}
		} elseif (is_category()) {
			$out .= 'Categorías: "'.get_category_parents($cat, true,' '.$sep.' ').'"' ;
		} elseif (is_tag()) {
			$out .= 'Etiquetas: "'.single_tag_title("", false).'"';
		} elseif (is_day()) {
			$out .= '<a href="'.$url_any.'">'.$any.'</a> '.$sep.' ';
			$out .= '<a href="'.$url_mes.'">'.$mes.'</a> '.$sep.' '.$dia.' ('.$sem.')';
		} elseif (is_month()) {
			$out .= '<a href="'.$url_any.'">'.$any.'</a> '.$sep.' '.$mes;
		} elseif (is_year()) {
			$out .= $any;
		} elseif (is_search()) {
			$out .= 'Resultados de búsqueda para: "'.get_search_query().'"';
		} elseif (is_page() && !$post->post_parent) {
			$out .= get_the_title();
		} elseif (is_page() && $post->post_parent) {
			$post_array = get_post_ancestors($post);
			krsort($post_array); 
			foreach($post_array as $key=>$postid) {
				$post_ids = get_post($postid);
				$title = $post_ids->post_title;
				$out .= '<a href="'.get_permalink($post_ids).'">'.$title.'</a> '.$sep.' ';
			}
			ob_start();
			the_title();
			$out .= ob_get_clean();
		} elseif (is_author() ){
			global $author;
			$usr = get_userdata($author);
			$out .=  'Publicaciones de: '.$usr->display_name;
		} elseif (is_404()) {
			$out .=  'Página no encontrada';
		} else {
		}
		$out .= '</div>';
		return $out;
	}   
}

add_shortcode('b_breadcrumb', 'b_f_breadcrumb');

function b_f_get_title() {
	ob_start();
	the_title();
	return ob_get_clean();
}

add_shortcode('b_title', 'b_f_get_title');

function b_f_blog($atts) {
	global $lg;
	if ($lg == '') {
		$lg = 'es';
	}
	$a = shortcode_atts(array(
		'total' => '-1',
		'number' => null,
		'pagination' => 'true',
		'class'	=> null,
		'category' => null,
		'type' => 'post',
		'height' => 'auto'
	), $atts);
	$pag = (get_query_var('paged')) ? get_query_var('paged') : 1;
	if (esc_attr($a['number']) != null) {
		$blog_number = esc_attr($a['number']);
	} else {
		$blog_number = b_f_option('b_opt_blog-number');
	}
	$o = array(
		'post_type' => esc_attr($a['type']),
		'posts_per_page' => $blog_number,
		'paged' => $pag,
		'orderby' => b_f_option('b_opt_blog-order'),
	);
	$b_categ = b_f_option('b_opt_blog-categories');
	if ($b_categ == null) {
		$b_categ = array('all');
	}
	if (esc_attr($a['category']) != null) {
		$o['category_name'] = esc_attr($a['category']);
	} else {
		if (!in_array('all', $b_categ)) {
			$o['category_name'] = join(',',$b_categ);
		}
	}
	$query = new WP_Query($o);
	if ($query->have_posts()) {
		$out = '<ul class="blog-wrapper '.esc_attr($a['class']).'">';
		while ($query->have_posts()) {
			$query->the_post();
			ob_start();
			$heg = '';
			if (esc_attr($a['height']) == 'auto') {
				$heg = ' auto-height';
			}
			?>
			<li class="post-entry<?= $heg ?>">
				<?php 
				if (has_post_thumbnail()) {
					$url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
					if (b_f_option('b_opt_blog') == 1) {
						?>
						<div class="image big" style="background-image: url(<?php echo $url[0]; ?>);" title="<?php the_title(); ?>">
							<a class="title" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<h2 class="title">
									<?php the_title(); ?>
								</h2>
							</a>
						</div>
						<?php
					} elseif (b_f_option('b_opt_blog') == 2) {
						?>
						<a class="image big" href="<?php the_permalink(); ?>" rel="nofollow" style="background-image: url(<?php echo $url[0]; ?>);" title="<?php the_title(); ?>">
						</a>
						<?php
					} elseif (b_f_option('b_opt_blog') == 3) {
						?>
						<a class="image small" href="<?php the_permalink(); ?>" rel="nofollow" style="background-image: url(<?php echo $url[0]; ?>);" title="<?php the_title(); ?>">
						</a>
						<?php
					}
				} else {
					if (b_f_option('b_opt_blog') == 1) {
						?>
						<div class="image big empty" style="background-image: url(<?php echo b_f_option('b_opt_positive-logo'); ?>); background-size: contain;" title="<?php the_title(); ?>">
							<a class="title" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<h2 class="title">
									<?php the_title(); ?>
								</h2>
							</a>
						</div>
						<?php
					} elseif (b_f_option('b_opt_blog') == 2) {
						?>
						<a class="image big empty" href="<?php the_permalink(); ?>" rel="nofollow" style="background-image: url(<?php echo b_f_option('b_opt_positive-logo'); ?>);" title="<?php the_title(); ?>">
						</a>
						<?php
					} elseif (b_f_option('b_opt_blog') == 3) {
						?>
						<a class="image small empty" href="<?php the_permalink(); ?>" rel="nofollow" style="background-image: url(<?php echo b_f_option('b_opt_positive-logo'); ?>);" title="<?php the_title(); ?>">
						</a>
						<?php
					}
				}
				?>
				<div class="post-meta top">
					<?php
					switch (b_f_option('b_opt_blog-position-1-1')) {
						case 2:
							echo '<span class="author">'.get_the_author().'</span>';
							break;
						case 3:
							echo '<span class="date">'.get_the_date(b_f_option('b_opt_blog-date-'.$lg)).'</span>';
							break;
						case 4:
							echo '';
							break;
						case 5:
							echo '<span class="categories">'.get_the_category_list(', &nbsp;', '&nbsp;').'</span>';
							break;
						case 6:
							echo'<span class="tags">'.get_the_tag_list(', &nbsp;', '&nbsp;').'</span>';
							break;
						default:
							echo '';
							break;
					}
					switch (b_f_option('b_opt_blog-position-1-2')) {
						case 2:
							echo '<span class="author">'.get_the_author().'</span>';
							break;
						case 3:
							echo '<span class="date">'.get_the_date(b_f_option('b_opt_blog-date-'.$lg)).'</span>';
							break;
						case 4:
							echo '';
							break;
						case 5:
							echo '<span class="categories">'.get_the_category_list(', &nbsp;', '&nbsp;').'</span>';
							break;
						case 6:
							echo'<span class="tags">'.get_the_tag_list(', &nbsp;', '&nbsp;').'</span>';
							break;
						default:
							echo '';
							break;
					}
					switch (b_f_option('b_opt_blog-position-1-3')) {
						case 2:
							echo '<span class="author">'.get_the_author().'</span>';
							break;
						case 3:
							echo '<span class="date">'.get_the_date(b_f_option('b_opt_blog-date-'.$lg)).'</span>';
							break;
						case 4:
							echo '';
							break;
						case 5:
							echo '<span class="categories">'.get_the_category_list(', &nbsp;', '&nbsp;').'</span>';
							break;
						case 6:
							echo'<span class="tags">'.get_the_tag_list(', &nbsp;', '&nbsp;').'</span>';
							break;
						default:
							echo '';
							break;
					}
					switch (b_f_option('b_opt_blog-position-1-4')) {
						case 2:
							echo '<span class="author">'.get_the_author().'</span>';
							break;
						case 3:
							echo '<span class="date">'.get_the_date(b_f_option('b_opt_blog-date-'.$lg)).'</span>';
							break;
						case 4:
							echo '';
							break;
						case 5:
							echo '<span class="categories">'.get_the_category_list(', &nbsp;', '&nbsp;').'</span>';
							break;
						case 6:
							echo'<span class="tags">'.get_the_tag_list(', &nbsp;', '&nbsp;').'</span>';
							break;
						default:
							echo '';
							break;
					}
					switch (b_f_option('b_opt_blog-position-1-5')) {
						case 2:
							echo '<span class="author">'.get_the_author().'</span>';
							break;
						case 3:
							echo '<span class="date">'.get_the_date(b_f_option('b_opt_blog-date-'.$lg)).'</span>';
							break;
						case 4:
							echo '';
							break;
						case 5:
							echo '<span class="categories">'.get_the_category_list(', &nbsp;', '&nbsp;').'</span>';
							break;
						case 6:
							echo'<span class="tags">'.get_the_tag_list(', &nbsp;', '&nbsp;').'</span>';
							break;
						default:
							echo '';
							break;
					}
					?>
				</div>
				<?php
				if (b_f_option('b_opt_blog') != 1) {
					?>
					<a class="title" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<h2 class="title">
							<?php the_title(); ?>
						</h2>
					</a>
					<?php
				}
				?>
				<div class="post-meta bottom">
					<?php
					switch (b_f_option('b_opt_blog-position-2-1')) {
						case 2:
							echo '<span class="author">'.get_the_author().'</span>';
							break;
						case 3:
							echo '<span class="date">'.get_the_date(b_f_option('b_opt_blog-date-'.$lg)).'</time>';
							break;
						case 4:
							echo '';
							break;
						case 5:
							echo '<span class="categories">'.get_the_category_list(', &nbsp;', '&nbsp;').'</span>';
							break;
						case 6:
							echo'<span class="tags">'.get_the_tag_list(', &nbsp;', '&nbsp;').'</span>';
							break;
						default:
							echo '';
							break;
					}
					switch (b_f_option('b_opt_blog-position-2-2')) {
						case 2:
							echo '<span class="author">'.get_the_author().'</span>';
							break;
						case 3:
							echo '<span class="date">'.get_the_date(b_f_option('b_opt_blog-date-'.$lg)).'</time>';
							break;
						case 4:
							echo '';
							break;
						case 5:
							echo '<span class="categories">'.get_the_category_list(', &nbsp;', '&nbsp;').'</span>';
							break;
						case 6:
							echo'<span class="tags">'.get_the_tag_list(', &nbsp;', '&nbsp;').'</span>';
							break;
						default:
							echo '';
							break;
					}
					switch (b_f_option('b_opt_blog-position-2-3')) {
						case 2:
							echo '<span class="author">'.get_the_author().'</span>';
							break;
						case 3:
							echo '<span class="date">'.get_the_date(b_f_option('b_opt_blog-date-'.$lg)).'</time>';
							break;
						case 4:
							echo '';
							break;
						case 5:
							echo '<span class="categories">'.get_the_category_list(', &nbsp;', '&nbsp;').'</span>';
							break;
						case 6:
							echo'<span class="tags">'.get_the_tag_list(', &nbsp;', '&nbsp;').'</span>';
							break;
						default:
							echo '';
							break;
					}
					switch (b_f_option('b_opt_blog-position-2-4')) {
						case 2:
							echo '<span class="author">'.get_the_author().'</span>';
							break;
						case 3:
							echo '<span class="date">'.get_the_date(b_f_option('b_opt_blog-date-'.$lg)).'</time>';
							break;
						case 4:
							echo '';
							break;
						case 5:
							echo '<span class="categories">'.get_the_category_list(', &nbsp;', '&nbsp;').'</span>';
							break;
						case 6:
							echo'<span class="tags">'.get_the_tag_list(', &nbsp;', '&nbsp;').'</span>';
							break;
						default:
							echo '';
							break;
					}
					switch (b_f_option('b_opt_blog-position-2-5')) {
						case 2:
							echo '<span class="author">'.get_the_author().'</span>';
							break;
						case 3:
							echo '<span class="date">'.get_the_date(b_f_option('b_opt_blog-date-'.$lg)).'</time>';
							break;
						case 4:
							echo '';
							break;
						case 5:
							echo '<span class="categories">'.get_the_category_list(', &nbsp;', '&nbsp;').'</span>';
							break;
						case 6:
							echo'<span class="tags">'.get_the_tag_list(', &nbsp;', '&nbsp;').'</span>';
							break;
						default:
							echo '';
							break;
					}
					?>
				</div>
				<div class="the-content">
					<?php
					switch (b_f_option('b_opt_blog-excerpt')) {
						case 2:
							if (b_f_option('b_opt_blog-html') == 1) {
								the_excerpt();
								echo '<a class="read-more" href="'.get_the_permalink().'" title="'.get_the_title().'">'.b_f_option('b_opt_blog-read-more-'.$lg).'</a>';
							} else {
								strip_tags(the_excerpt());
								echo '<a class="read-more" href="'.get_the_permalink().'" title="'.get_the_title().'">'.b_f_option('b_opt_blog-read-more-'.$lg).'</a>';
							}
							break;
						case 3:
							if (b_f_option('b_opt_blog-html') == 1) {
								the_content();
							} else {
								strip_tags(the_content());
							}
							break;
					}
					?>
				</div>
			</li>
			<?php
			$out .= ob_get_clean();
		}
		wp_reset_postdata();
	} else {
		$out = '<ul class="blog-wrapper '.esc_attr($a['class']).'">'.__('No posts found', 'bilnea');
	}
	if ($query->max_num_pages > 1) {
		$arp = array();
		$out .= '<div class="pager">';
		$out .= '<div>'.sprintf(__('Page %1$s of %2$s', 'bilnea'), $pag, $query->max_num_pages).'</div>';
		if ($pag != 1) {
			$out .= '<a href="'.get_permalink().'page/'.($pag-1).'"><</a>';
		}
		if ($pag == 1) {
			$out .= '<a class="active">1</a>';
		} else {
			$out .= '<a href="'.get_permalink().'page/1">1</a>';
		}
		$dtb = false; $dta = false;
		for ($i = 2; $i <= $query->max_num_pages-1; $i++) {
			if ($pag == $i) {
				$out .= '<a class="active">'.$i.'</a>';
			}
			if ($i < $pag-3 && $dtb == false) {
				$out .= '<div class="more">...</div>';
				$dtb = true;
			}
			if ($pag != $i && $pag >= $i-3 && $pag <= $i+3) {
				$out .= '<a href="'.get_permalink().'page/'.$i.'">'.$i.'</a>';
			}
			if ($i > $pag+3 && $dta == false) {
				$out .= '<div class="more">...</div>';
				$dta = true;
			}
		}
		if ($pag == $query->max_num_pages) {
			$out .= '<a class="active">'.$query->max_num_pages.'</a>';
		} else {
			$out .= '<a href="'.get_permalink().'page/'.$query->max_num_pages.'">'.$query->max_num_pages.'</a>';
		}
		if ($pag != $query->max_num_pages) {
			$out .= '<a href="'.get_permalink().'page/'.($pag+1).'">></a>';
		}
		$out .= '</div>';
	}
	$out .= '</ul>';
	return $out;
}

add_shortcode('b_blog', 'b_f_blog');

function b_f_map($atts, $content = null) {
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
	$fw = '';
	switch (esc_attr($a['width'])) {
		case '1/1': $fw .= 'x11'; break;
		case '1/2': $fw .= 'x12'; break;
		case '1/3': $fw .= 'x13'; break;
		case '1/4': $fw .= 'x14'; break;
		case '1/5': $fw .= 'x15'; break;
		case '1/6': $fw .= 'x16'; break;
		case '1/7': $fw .= 'x17'; break;
		case '1/8': $fw .= 'x18'; break;
		case '1/9': $fw .= 'x19'; break;
		case '1/10': $fw .= 'x10'; break;
		case '2/2': $fw .= 'x11'; break;
		case '2/3': $fw .= 'x23'; break;
		case '2/4': $fw .= 'x12'; break;
		case '2/5': $fw .= 'x25'; break;
		case '2/6': $fw .= 'x13'; break;
		case '2/7': $fw .= 'x27'; break;
		case '2/8': $fw .= 'x14'; break;
		case '2/9': $fw .= 'x29'; break;
		case '2/10': $fw .= 'x15'; break;
		case '3/3': $fw .= 'x11'; break;
		case '3/4': $fw .= 'x34'; break;
		case '3/5': $fw .= 'x35'; break;
		case '3/6': $fw .= 'x12'; break;
		case '3/7': $fw .= 'x37'; break;
		case '3/8': $fw .= 'x38'; break;
		case '3/9': $fw .= 'x13'; break;
		case '3/10': $fw .= 'x30'; break;
		case '4/4': $fw .= 'x14'; break;
		case '4/5': $fw .= 'x45'; break;
		case '4/6': $fw .= 'x23'; break;
		case '4/7': $fw .= 'x47'; break;
		case '4/8': $fw .= 'x12'; break;
		case '4/9': $fw .= 'x49'; break;
		case '4/10': $fw .= 'x40'; break;
		case '5/5': $fw .= 'x11'; break;
		case '5/6': $fw .= 'x56'; break;
		case '5/7': $fw .= 'x57'; break;
		case '5/8': $fw .= 'x58'; break;
		case '5/9': $fw .= 'x59'; break;
		case '5/10': $fw .= 'x12'; break;
		case '6/6': $fw .= 'x11'; break;
		case '6/7': $fw .= 'x67'; break;
		case '6/8': $fw .= 'x34'; break;
		case '6/9': $fw .= 'x69'; break;
		case '6/10': $fw .= 'x35'; break;
		case '7/7': $fw .= 'x11'; break;
		case '7/8': $fw .= 'x78'; break;
		case '7/9': $fw .= 'x79'; break;
		case '7/10': $fw .= 'x70'; break;
		case '8/8': $fw .= 'x11'; break;
		case '8/9': $fw .= 'x89'; break;
		case '8/10': $fw .= 'x45'; break;
		case '9/9': $fw .= 'x11'; break;
		case '9/10': $fw .= 'x90'; break;
	}
	if (esc_attr($a['class']) != null) { $fw .= ' '.esc_attr($a['class']); }
	wp_is_mobile() ? $drag = 'false' : $drag = 'true';
	$cen = esc_attr($a['center']);
	$ran = rand(100000, 999999);
	$out = '<div id="map-'.$ran.'" style="width: '.esc_attr($a['width']).'; height: '.esc_attr($a['height']).';" class="'.$fw.'"></div>'."\n";
	wp_enqueue_script('google-map');
	$out .= '<script type="text/javascript">'."\n";
	$out .= '	var map_'.$ran.';'."\n";
	$out .= '	var map_'.$ran.';'."\n";
	$out .= '	var center_'.$ran.' = {lat: '.explode(',', $cen)[0].', lng: '.explode(',', $cen)[1].'};'."\n";
	$out .= '	var poi_'.$ran.' = \''.esc_attr($a['poi']).'\';'."\n";
	$out .= '	var zoom_'.$ran.' = '.esc_attr($a['zoom']).';'."\n";
	$out .= '	var drag_'.$ran.' = '.$drag.';'."\n";
	$out .= '	var scroll_'.$ran.' = '.esc_attr($a['scroll']).';'."\n";
	$out .= '	var controls_'.$ran.' = '.esc_attr($a['controls']).';'."\n";
	$out .= '	var m_control_'.$ran.' = '.esc_attr($a['m_control']).';'."\n";
	$out .= '	var z_control_'.$ran.' = '.esc_attr($a['z_control']).';'."\n";
	$out .= '	var markers_'.$ran.' = new Array();'."\n";
	$out .= '</script><div class="map-options" data-id="'.$ran.'">'.do_shortcode($content).'</div>'."\n";
	return $out;
}

add_shortcode('b_map', 'b_f_map');

function b_f_marker($atts, $content = null) {
	$a = shortcode_atts(array(
		'position' => '37.992900,-1.114391',
		'icon' => null,
		'size' => '40',
	), $atts);
	$out .= '<script type="text/javascript" id="b_map_script">'."\n";
	$out .= 'jQuery(function() {'."\n";
	$out .= '	var a = jQuery(\'#b_map_script\').remove(\'attr\', \'id\').closest(\'.map-options\').attr(\'data-id\');'."\n";
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
		$out .= '				size: \''.esc_attr($a['size']).'\''."\n";
		$out .= '			},'."\n";
		if ($content != null) {
			$out .= '		info: \''.$content.'\''."\n";
		}
	}
	$out .= '		};'."\n";
	$out .= '		var b = window[\'markers_\'+a];'."\n";
	$out .= '		b.push(marker);'."\n";
	$out .= '	});'."\n";
	$out .= '</script>'."\n";
	return $out;
}

add_shortcode('b_marker', 'b_f_marker');

function mostrar_idioma($atts) {
	$a = shortcode_atts(array(
		'mode' => 'select',
		'flag' => 'true',
		'text' => 'true',
		'translate' => 'true',
		'id' => null,
	), $atts);

	if (function_exists('icl_object_id')) {
		$iny = '';
		$inz = '';
		$tot = 0;
		$idi = icl_get_languages('skip_missing=0&orderby=code');
		if (!empty($idi)) {
			if (esc_attr($a['mode']) == 'inline') { $cl = ' en-linea'; } else { $cl = ' desplegable'; }
			$iny .= '<ul class="selector-idioma'.$cl.'">'."\n";
			foreach ($idi as $i) {
				if (!$i['active']) {
					if (esc_attr($a['id']) != null) {
						$pl = get_permalink(icl_object_id(esc_attr($a['id']), get_post_type(esc_attr($a['id'])), true, $i['language_code']));
					} else {
						$pl = $i['url'];
					}
					$inz .= '<li><a href="'.$pl.'">'."\n";
					if (esc_attr($a['flag']) == 'true') {
						$inz .= '<img src="'.$i['country_flag_url'].'" height="12" alt="'.$i['language_code'].'" width="18" class="bandera" />'."\n";
					}
					if (esc_attr($a['text']) == 'true' && esc_attr($a['translate']) == 'true') {
						$inz .= $i['translated_name'];
					}
					if (esc_attr($a['text']) == 'true' && esc_attr($a['translate']) != 'true') {
						$inz .= $i['native_name'];
					}
					$inz .= '</a></li>'."\n";
					$tot++;
				}
			}
			foreach ($idi as $i) {
				if ($i['active'] == 1) {
					$iny .= '<li><a href="'.$i['url'].'">'."\n";
					if (esc_attr($a['flag']) == 'true') {
						$iny .= '<img src="'.$i['country_flag_url'].'" height="12" alt="'.$i['language_code'].'" width="18" class="bandera" />'."\n";
					}
					if (esc_attr($a['text']) == 'true' && esc_attr($a['translate']) == 'true') {
						$iny .= $i['translated_name'];
					}
					if (esc_attr($a['text']) == 'true' && esc_attr($a['translate']) != 'true') {
						$iny .= $i['native_name'];
					}
					$iny .= '<div class="selector-abajo"></div></a>'."\n";
					if ($tot > 0) {
						$iny .= '<ul>'.$inz.'</ul>'."\n";
					}
					$iny .= '</li>'."\n";
				}
			}
		}
		return $iny;
	}
}

add_shortcode('b_wpml', 'mostrar_idioma');

function b_f_quote($atts, $content = null) {
	$a = shortcode_atts(array(
		'author' => null,
		'class' => null,
	), $atts);
	$fw = '';
	if (esc_attr($a['class']) != null) { $fw .= ' '.esc_attr($a['class']); }
	$out = '<div class="quote '.$fw.'">';
	$out .= $content;
	$out .= '<span class="author">'.esc_attr($a['author']).'</span>';
	$out .= '</div>';
	return $out;
}

add_shortcode('b_quote', 'b_f_quote');

function b_f_categories($atts) {
	$a = shortcode_atts(array(
		'orderby' => 'name',
		'all' => __('All', 'bilnea'),
		'term' => 'category',
		'class' => null,
	), $atts);
	$opts = array(
				'hide_empty' => 0,
				'title_li' => '',
				'echo' => 0,
				'show_option_all' => esc_attr($a['all']),
				'taxonomy' => esc_attr($a['term'])
			);
	return '<ul class="category-wrapper '.esc_attr($a['class']).'">'.wp_list_categories($opts).'</ul>';
}

add_shortcode('b_categories', 'b_f_categories');

function b_f_tweet($atts, $content = null) {
	$a = shortcode_atts(array(
		'author' => null,
	), $atts);
	$a = esc_attr($a['author']);
	if ($a != '') {
		return '<div class="tweeter">'.$content.'<div class="tweet-author"><a target="_blank" rel="nofollow" href="https://twitter.com/'.$a.'">@'.$a.'</div><div class="tweet-link"><a href="https://twitter.com/home?status='.urlencode($content).'%20via%20@'.$a.'" class="fa fa-twitter" target="_blank" rel="nofollow">&nbsp;&nbsp;'.__('Tweet this', 'bilnea').'</a></div></div>';
	} else {
		$options = get_option('bilnea_settings');
		if ($option['b_opt_social-twitter'] != '') {
			if (strpos($option['b_opt_social-twitter'],'twitter.com') === false) {
				if ($option['b_opt_social-twitter'][0] == '@') {
					$twitter_user = ltrim($option['b_opt_social-twitter'], '@');
				} else {
					$twitter_user = $option['b_opt_social-twitter'];
				}
			} else {
				preg_match("|https?://(www\.)?twitter\.com/(#!/)?@?([^/]*)|", "http://twitter.com/samuelcerezo", $matches);
				$twitter_user = $matches[3];
			}
			return '<div class="tweeter">'.$content.'<div class="tweet-link"><a href="https://twitter.com/home?status='.urlencode($content).'%20vía%20@'.$twitter_user.'" class="fa fa-twitter" target="_blank" rel="nofollow">&nbsp;&nbsp;'.__('Tweet this', 'bilnea').'</a></div></div>';
		} else {
			return '<div class="tweeter">'.$content.'<div class="tweet-link"><a href="https://twitter.com/home?status='.urlencode($content).'" class="fa fa-twitter" target="_blank" rel="nofollow">&nbsp;&nbsp;'.__('Tweet this', 'bilnea').'</a></div></div>';
		}
	}
}

add_shortcode('b_tweet', 'b_f_tweet');

function b_f_borded($atts, $content = null) {
	$a = shortcode_atts(array(
		'color' => null,
	), $atts);
	$a = esc_attr($a['color']);
	switch ($a) {
		case 'verde':
			$b = 'color: #9fe8bc;';
			break;
		case 'gris':
			$b = 'color: #efefef;';
			break;
		case 'rojo':
			$b = 'color: #e8a49f;';
			break;
		default:
			$b = 'color: '.$a.';';
			break;
	}
	if ($a != '') {
		$out = '<div class="b_borded" style="'.$b.'">'.$content.'</div>';
	} else {
		$out = '<div class="b_borded">'.$content.'</div>';
	}
	return $out;
}

add_shortcode('b_borded', 'b_f_borded');

function b_f_frame($atts, $content = null) {
	$a = shortcode_atts(array(
		'color' => null,
	), $atts);
	$a = esc_attr($a['color']);
	switch ($a) {
		case 'verde':
			$b = 'background-color: #9fe8bc;';
			break;
		case 'gris':
			$b = 'background-color: #efefef;';
			break;
		case 'rojo':
			$b = 'background-color: #e8a49f;';
			break;
		default:
			$b = 'background-color: '.$a.';';
			break;
	}
	if ($a != '') {
		$out = '<div class="b_frame" style="'.$b.'">'.$content.'</div>';
	} else {
		$out = '<div class="b_frame">'.$content.'</div>';
	}
	return $out;
}

add_shortcode('b_frame', 'b_f_frame');

function b_f_file($atts, $content = null) {
	$a = shortcode_atts(array(
		'class' => null,
		'id' => null,
		'target' => null,
		'echo' => false,
	), $atts);
	$c = ''; $t = '';
	if (esc_attr($a['class']) != null) {
		$c = esc_attr($a['class']);
	}
	if (esc_attr($a['target']) != null) {
		$t = ' target="blank"';
	}
	if (esc_attr($a['id']) != null) {
		$i = esc_attr($a['id']);
		$u = wp_get_attachment_url($i);
		$e = strtolower(pathinfo($u, PATHINFO_EXTENSION));
		$f = basename($u);
		if ($content == null) {
			$content = $f;
		}
		if (($e == 'png') || ($e == 'gif') || ($e == 'tiff') || ($e == 'jpg') || ($e == 'jpeg')) {
			$o = '<img src="'.$u.'" class="'.$c.'" />';
		} else {
			$o = '<a href="'.$u.'"'.$t.' class="'.$c.'">'.$content.'</a>';
		}
	}
	if (esc_attr($a['echo']) == true) {
		return $u;
	} else {
		return $o;
	}
}

add_shortcode('b_file', 'b_f_file');

function b_f_accordion($atts, $content = null) {
	wp_enqueue_script('b_s_accordion');
	$a = shortcode_atts(array(
		'class' 		=> null,
		'active' 		=> 0,
		'multiple' 		=> 'false',
		'close'			=> 'false',
	), $atts);
	$c = '';
	if (esc_attr($a['multiple']) == 'true') {
		$c .= '-multiple';
	}
	if (esc_attr($a['class']) != null) {
		$c .= ' '.esc_attr($a['class']);
	}
	if (esc_attr($a['close']) == 'true') {
		$c .= ' c2close';
	}
	$out = '<div class="b_accordion'.$c.'"'.$m;
	$out .= ' data-active="'.esc_attr($a['active']).'"';
	$out .= '>';
	add_shortcode('b_accordion_frame', 'b_f_accordion_frame');
	$out .= do_shortcode($content);
	$out .= '</div>';
	return $out;
}

add_shortcode('b_accordion', 'b_f_accordion');

function b_f_accordion_frame($atts, $content = null) {
	$a = shortcode_atts(array(
		'title' 		=> null,
		'element' 		=> 'h4',
		'class' 		=> null,
		'id' => null,
	), $atts, 'b_a_frame');
	$c = ''; $i = '';
	if (esc_attr($a['class']) != null) {
		$c .= ' '.esc_attr($a['class']);
	}
	if (esc_attr($a['id']) != null) {
		$i .= ' id="'.esc_attr($a['id']).'"';
	}
	$out = '<div'.$i.' class="accordion_frame'.$c.'"><'.b_f_sanitize(esc_attr($a['element'])).' class="accordion_title">'.esc_attr($a['title']).'</'.b_f_sanitize(esc_attr($a['element'])).'><div class="accordion_content">'.do_shortcode($content).'</div></div>';
	return $out;

}

function b_f_timeline($atts) {
	$a = shortcode_atts(array(
		'username' => null,
		'tweets' => 3,
	), $atts);
	include_once(ABSPATH.WPINC.'/feed.php');
	$twt = fetch_feed('https://api.twitter.com/1/statuses/user_timeline.rss?screen_name='.esc_attr($a['username']));
	$max = $twt->get_item_quantity(esc_attr($a['tweets']));
	$its = $twt->get_items(0, $max);
	$out = '<ul>';
	if (esc_attr($a['username']) == null) {
		$out .= '<li>'.__('It\'s not possible to get latest tweets. No username configured', 'bilnea').'</li>';
	} else {
		if ($max == 0) {
			$out .= '<li>'.__('No tweets', 'bilnea').'</li>';
		} else {
			foreach ($its as $item) {
				$out .= '<li><a href='.$item->get_permalink().'>'.$item->get_title().'</a></li>';
			}
		}
	}
	$out .= '</ul>';
	return $out;
}

function b_f_sanitize($s) {
	$out = preg_replace("/[^a-zA-Z0-9]+/", "", html_entity_decode($s, ENT_QUOTES));
	return $out;
}

if (b_f_option('b_opt_subscribers') == 1) {
	function b_newsletters($atts) {
		$a = shortcode_atts(array(
			'type' => 'name,email',
			'redirect' => b_f_option('b_opt_newsl_redirect'),
		), $atts);
		$ran = rand(100000, 999999);
		$temp = explode(',', str_replace(' ', '', $a['type']));
		$out = '<div class="b_newsletters">';
		$out .= '<input class="input" type="text" name="s_name" placeholder="'.__('* Name', 'bilnea').'" />';
		if (in_array('last', $temp)) {
			$out .= '<input type="text" name="s_last" placeholder="'.__('* Last name', 'bilnea').'" />';
		}
		$out .= '<input class="input" type="email" name="s_email" placeholder="'.__('* Email', 'bilnea').'" />';
		$out .= '<input class="b_input_checkbox" value="true" type="checkbox" id="s_legal-'.$ran.'" name="s_legal-'.$ran.'" />';
		$var_placeholder = __('Privacy policy', 'bilnea');
		switch (substr(explode(' ', $var_placeholder)[0], -1)) {
			case 'a':
				$art = _x('the', 'female', 'bilnea');
				break;
			default:
				$art = _x('the', 'male', 'bilnea');
				break;
		}
		$out .= '<label for="s_legal-'.$ran.'">* '.__('I have read, understood and accept', 'bilnea').' '.$art.' <a href="'.esc_attr($a['url']).'" title="'.$var_placeholder.'" target="_blank">'.strtolower($var_placeholder).'</a>.</label>';
		$out .= '<div class="s_submit">'.__('Suscribe', 'bilnea').'</div>';
		if (b_f_option('b_opt_newsl_service') == 'mailchimp') {
			$api_key = b_f_option('b_opt_newsl_api');
			wp_enqueue_script('b_mailchimp', get_template_directory_uri().'/js/mailchimp.js', array('jquery'), $version, true);
		}
		$out .= '<input type="hidden" class="redirect_to" value="'.esc_attr($a['redirect']).'" />';
		$out .= '</div>';

		return $out;
	}
	
	add_shortcode('b_newsletters', 'b_newsletters');
}

function b_rrss($atts) {
	$a = shortcode_atts(array(
		'type' => null
	), $atts);
	if ($a[type] != null) {
		switch (esc_attr($a['type'])) {
			case 'twitter':
				$link = b_f_option('b_opt_social-twitter');
				if (strpos($link,'twitter.com') === false) {
					if ($link[0] == '@') $link = ltrim($link, '@');
					$link = 'http://twitter.com/'.$link;
				}
				$link = 'https://'.preg_replace('#^https?://#', '', $link);
				return '<a href="'.$link.'" target="_blank" class="fa fa-twitter"></a>';
				break;
			case 'facebook':
				$link = b_f_option('b_opt_social-facebook');
				if (strpos($link,'facebook.com') === false) {
					$link = 'http://facebook.com/'.$link;
				}
				$link = 'https://'.preg_replace('#^https?://#', '', $link);
				return '<a href="'.$link.'" target="_blank" class="fa fa-facebook"></a>';
				break;
			case 'google-plus':
				$link = b_f_option('b_opt_social-google-plus');
				$link = 'https://'.preg_replace('#^https?://#', '', $link);
				return '<a href="'.$link.'" target="_blank" class="fa fa-google-plus"></a>';
				break;
			case 'youtube':
				$link = b_f_option('b_opt_social-youtube');
				$link = 'https://'.preg_replace('#^https?://#', '', $link);
				return '<a href="'.$link.'" target="_blank" class="fa fa-youtube"></a>';
				break;
			case 'linkedin':
				$link = b_f_option('b_opt_social-linkedin');
				$link = 'https://'.preg_replace('#^https?://#', '', $link);
				return '<a href="'.$link.'" target="_blank" class="fa fa-linkedin"></a>';
				break;
			case 'instagram':
				$link = b_f_option('b_opt_social-instagram');
				if (strpos($link,'instagram.com') === false) {
					if ($link[0] == '@') $link = ltrim($link, '@');
					$link = 'http://instagram.com/'.$link;
				}
				$link = 'https://'.preg_replace('#^https?://#', '', $link);
				return '<a href="'.$link.'" target="_blank" class="fa fa-instagram"></a>';
				break;
			case 'pinterest':
				$link = b_f_option('b_opt_social-pinterest');
				if (strpos($link,'pinterest.com') === false) {
					$link = 'http://pinterest.com/'.$link;
				}
				$link = 'https://'.preg_replace('#^https?://#', '', $link);
				return '<a href="'.$link.'" target="_blank" class="fa fa-pinterest"></a>';
				break;
		}
	}
}

add_shortcode('b_rrss', 'b_rrss');

// Línea de tiempo de Twitter

function b_twitter($atts) {
	global $mes;
	$a = shortcode_atts(array(
		'username' => null,
		'number' => 5,
		'retweet' => true,
		'response' => false,
	), $atts);

	// Claves de acceso
	$api_key = urlencode(b_f_option('b_opt_apis_twitter_api-key'));
	$api_secret = urlencode(b_f_option('b_opt_apis_twitter_api-secret'));

	// Variables temporales
	$data_username = esc_attr($a['username']);
	$data_count = esc_attr($a['number']);

	// Token de acceso
	$api_credentials = base64_encode($api_key.':'.$api_secret);

	$auth_headers = 'Authorization: Basic '.$api_credentials."\r\n";
	$auth_headers .= 'Content-Type: application/x-www-form-urlencoded;charset=UTF-8'."\r\n";

	$auth_context = stream_context_create(
	    array(
	        'http' => array(
	            'header' => $auth_headers,
	            'method' => 'POST',
	            'content'=> http_build_query(array('grant_type' => 'client_credentials', )),
	        )
	    )
	);

	$auth_response = json_decode(file_get_contents('https://api.twitter.com/oauth2/token', 0, $auth_context), true);
	$auth_token = $auth_response['access_token'];

	// Tweets del usuario
	$data_context = stream_context_create( array( 'http' => array( 'header' => 'Authorization: Bearer '.$auth_token."\r\n", ) ) );

	// Información del usuario
	$out = '<ul class="twitter-shortcode">';
	$data = json_decode(file_get_contents('https://api.twitter.com/1.1/users/show.json?screen_name='.urlencode($data_username), 0, $data_context), true);
	$out .= '<li class="user-profile" data-id="'.$data['id'].'"><a href="https://twitter.com/'.strtolower($data['screen_name']).'" target="" rel="nofollow" class="tw-profile-pic" style="background-image: url('.$data['profile_image_url'].');"></a><div>'.$data['name'].'<br /><a href="https://twitter.com/'.strtolower($data['screen_name']).'" target="" rel="nofollow" class="tw-user">@'.$data['screen_name'].'</a><a href="https://twitter.com/'.strtolower($ddata['screen_name']).'" target="" rel="nofollow" class="fa fa-twitter"></a></div></li>';

	// Configuración adiccional
	$params = '';
	if (esc_attr($a['response']) == false) {
		$params .= '&exclude_replies=true';
	}
	if (esc_attr($a['retweet']) == false) {
		$params .= '&include_rts=false';
	}

	$data = json_decode(file_get_contents('https://api.twitter.com/1.1/statuses/user_timeline.json?tweet_mode=extended&count='.$data_count.$params.'&screen_name='.urlencode($data_username), 0, $data_context), true);

	foreach ($data as $tweet) {
		$text = $tweet['full_text'];
		preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $text, $match);
		$main_url = end($match[0]);
		foreach ($tweet['entities']['media'] as $media) {
			$text = str_replace($media['url'], '<a href="'.$media['media_url'].'" class="fa fa-picture-o"></a>', $text);
		}
		foreach ($tweet['entities']['urls'] as $url) {
			$text = str_replace($url['url'], '<a class="tw-url" href="'.$url['expanded_url'].'" target="_blank" rel="nofollow">'.$url['display_url'].'</a>', $text);
		}
		$text = str_replace($main_url, '', $text);
		$text = preg_replace('/#(\w+)/', ' <a href="https://twitter.com/hashtag/$1" class="tw-hashtag">#$1</a>', $text);
		$out .= '<li tweet-id="'.$tweet['id'].'"><a href="'.$main_url.'">@'.$tweet['user']['screen_name'].'</a><span class="tw-date">'.date('j', strtotime($tweet['created_at'])).' '.$mes[date('n', strtotime($tweet['created_at']))-1].' '.date('Y, G:i', strtotime($tweet['created_at'])).'</span><p>'.$text.'</p></li>';
	}

	$out .= '</ul>';

	return $out;
}

add_shortcode('b_twitter', 'b_twitter');

?>