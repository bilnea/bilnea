<?php

function b_f_row($atts, $content = null) {
	$a = shortcode_atts(array(
		'width' => 0,
		'class' => null,
		'id' => null,
		'bgcolor' => null,
	), $atts);
	$fw = ''; $fi = ''; $fo = '';
	if (esc_attr($a['width']) != 1) { $fw = 'container'; }
	if (esc_attr($a['class']) != null) { $fw .= ' '.esc_attr($a['class']); }
	if (esc_attr($a['id']) != null) { $fi = ' id="'.esc_attr($a['id']).'"'; }
	if (esc_attr($a['bgcolor']) != null) { $fo = ' style="background-color: '.esc_attr($a['bgcolor']).';"'; }
	return '<div class="'.$fw.'"'.$fi.$fo.'>'.do_shortcode($content).'</div>';
}

add_shortcode('b_row', 'b_f_row');

function b_f_box($atts, $content = null) {
	$a = shortcode_atts(array(
		'width' => 1,
		'class' => null,
		'id' => null,
		'height' => null,
	), $atts);
	$fw = ''; $fi = ''; $fo = '';
	switch (esc_attr($a['width'])) {
		case '1/1': $fw = 'x11'; break;
		case '1/2': $fw = 'x12'; break;
		case '1/3': $fw = 'x13'; break;
		case '1/4': $fw = 'x14'; break;
		case '1/5': $fw = 'x15'; break;
		case '1/6': $fw = 'x16'; break;
		case '1/7': $fw = 'x17'; break;
		case '1/8': $fw = 'x18'; break;
		case '1/9': $fw = 'x19'; break;
		case '1/10': $fw = 'x10'; break;
		case '2/2': $fw = 'x11'; break;
		case '2/3': $fw = 'x23'; break;
		case '2/4': $fw = 'x12'; break;
		case '2/5': $fw = 'x25'; break;
		case '2/6': $fw = 'x13'; break;
		case '2/7': $fw = 'x27'; break;
		case '2/8': $fw = 'x14'; break;
		case '2/9': $fw = 'x29'; break;
		case '2/10': $fw = 'x15'; break;
		case '3/3': $fw = 'x11'; break;
		case '3/4': $fw = 'x34'; break;
		case '3/5': $fw = 'x35'; break;
		case '3/6': $fw = 'x12'; break;
		case '3/7': $fw = 'x37'; break;
		case '3/8': $fw = 'x38'; break;
		case '3/9': $fw = 'x13'; break;
		case '3/10': $fw = 'x30'; break;
		case '4/4': $fw = 'x14'; break;
		case '4/5': $fw = 'x45'; break;
		case '4/6': $fw = 'x23'; break;
		case '4/7': $fw = 'x47'; break;
		case '4/8': $fw = 'x12'; break;
		case '4/9': $fw = 'x49'; break;
		case '4/10': $fw = 'x40'; break;
		case '5/5': $fw = 'x11'; break;
		case '5/6': $fw = 'x56'; break;
		case '5/7': $fw = 'x57'; break;
		case '5/8': $fw = 'x58'; break;
		case '5/9': $fw = 'x59'; break;
		case '5/10': $fw = 'x12'; break;
		case '6/6': $fw = 'x11'; break;
		case '6/7': $fw = 'x67'; break;
		case '6/8': $fw = 'x34'; break;
		case '6/9': $fw = 'x69'; break;
		case '6/10': $fw = 'x35'; break;
		case '7/7': $fw = 'x11'; break;
		case '7/8': $fw = 'x78'; break;
		case '7/9': $fw = 'x79'; break;
		case '7/10': $fw = 'x70'; break;
		case '8/8': $fw = 'x11'; break;
		case '8/9': $fw = 'x89'; break;
		case '8/10': $fw = 'x45'; break;
		case '9/9': $fw = 'x11'; break;
		case '9/10': $fw = 'x90'; break;
	}
	if (esc_attr($a['height']) == 'adjust') { $fw .= ' auto-height'; }
	if (esc_attr($a['class']) != null) { $fw .= ' '.esc_attr($a['class']); }
	if (esc_attr($a['id']) != null) { $fi = ' id="'.esc_attr($a['id']).'"'; }
	if (esc_attr($a['bgcolor']) != null) { $fo = ' style="background-color: '.esc_attr($a['color']).';"'; }
	return '<div class="'.$fw.'"'.$fi.$fo.'>'.do_shortcode($content).'</div>';
}

add_shortcode('b_box', 'b_f_box');
add_shortcode('b_box_inside', 'b_f_box');

function b_f_slider($atts, $content = null) {
	wp_enqueue_script('slider');
	global $num_slid;
	add_shortcode('b_show', 'b_f_slideshow');
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
	$sty = ''; $cls = ''; $sid = '';
	if (esc_attr($a['id']) != null) { $sid = ' id="'.esc_attr($a['id']).'"'; }
	if (esc_attr($a['width']) == 0) { $cls = ' container'; }
	elseif (esc_attr($a['width']) > 0 && esc_attr($a['width']) <= 1) { $sty .= 'width: '.(esc_attr($a['width'])*100).'%;'; }
	elseif (is_numeric(esc_attr($a['width']))) { $sty .= 'width: '.esc_attr($a['width']).'px'; }
	else { $sty .= 'width: '.esc_attr($a['width']);	}
	if (esc_attr($a['height']) > 0 && esc_attr($a['height']) <= 1) { $sty .= ' height: '.(esc_attr($a['height'])*100).'vh;'; }
	elseif (is_numeric(esc_attr($a['height']))) { $sty .= ' height: '.esc_attr($a['height']).'px'; }
	else { $sty .= ' height: '.esc_attr($a['height']); }
	$num_slid++;
	return '<div class="slider-'.$num_slid.$cls.'" style="'.$sty.'"'.$sid.'>'.do_shortcode($content).'</div>'."\r\n"
		 . '<script type="text/javascript">'."\r\n"
		 . 'jQuery(function() {'."\r\n"
		 . '	jQuery(\'.slider-'.$num_slid.'\').sss({'."\r\n"
		 . '		slideShow: '.esc_attr($a['start']).','."\r\n"
		 . '		startOn:  '.(esc_attr($a['on'])-1).','."\r\n"
		 . '		transition:  '.esc_attr($a['fade']).','."\r\n"
		 . '		speed:  '.(esc_attr($a['time'])*1000).','."\r\n"
		 . '		showNav:  '.esc_attr($a['buttons'])."\r\n"
		 . '	})'."\r\n"
		 . '})'."\r\n"
		 . '</script>';
	$num_slid++;
}

add_shortcode('b_slider', 'b_f_slider');

function b_f_slideshow($atts, $content = null) {
	$a = shortcode_atts(array(
		'url' => get_template_directory_uri().'/img/empty-grid.png',
		'position' => 'cc',
	), $atts);
	$img = ''; $cen = 'center';
	switch (esc_attr($a['position'])) {
		case 'cc': $cen = 'center'; break;
		case 'ct': $cen = 'center top'; break;
		case 'tc': $cen = 'center top'; break;
		case 'cb': $cen = 'center bottom'; break;
		case 'bc': $cen = 'center bottom'; break;
		case 'lc': $cen = 'left center'; break;
		case 'cl': $cen = 'left center'; break;
		case 'rc': $cen = 'right center'; break;
		case 'cr': $cen = 'right center'; break;
		case 'lt': $cen = 'left top'; break;
		case 'tl': $cen = 'left top'; break;
		case 'rt': $cen = 'right top'; break;
		case 'tr': $cen = 'right top'; break;
		case 'lb': $cen = 'left bottom'; break;
		case 'bl': $cen = 'left bottom'; break;
		case 'rb': $cen = 'right bottom'; break;
		case 'br': $cen = 'right bottom'; break;
		default: $cen = 'center'; break;
	}
	if (esc_attr($a['url']) != null) { $img = ' style="background-image: url('.str_replace('b_root', preg_replace('(^https?://)', '', get_site_url()), esc_url(esc_attr($a['url']))).'); background-position: '.$cen.';"'; }
	return '<div'.$img.'>'.do_shortcode($content).'</div>';
}

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

function b_f_input($atts) {
	$lang = 'es';
	if (function_exists('icl_object_id')) {
		$lang = ICL_LANGUAGE_CODE;
	}
	global $opt;
	global $prov;
	$ran =rand(10000, 99999);
	$a = shortcode_atts(array(
		'id' => null,
		'class' => null,
		'type' => null,
		'required' => 'false',
		'placeholder' => '',
		'url' => site_url(b_f_option('b_opt_privacy-url-_'.$lang)),
		'length' => 5,
		'allow' => '',
	), $atts);
	$fw = ''; $ob = '';
	if (esc_attr($a['class']) != null) { $fw .= ' '.esc_attr($a['class']); }
	if (esc_attr($a['required']) == 'true') { $fw .= ' required'; $ob = '* '; }
	if (esc_attr($a['id']) != null) { $fi = ' id="'.esc_attr($a['id']).'"'; }
	if (esc_attr($a['placeholder']) == 'null') {
			$plh = '';
		} else {
			$plh = esc_attr($a['placeholder']);
		}
	if (esc_attr($a['type']) == 'email') {
		if (esc_attr($a['placeholder']) == '') { $plh = __('Email', 'bilnea'); }
		return '<input class="input'.$fw.'"'.$fi.' type="text" name="email" placeholder="'.$ob.$plh.'" />';
	} else if (esc_attr($a['type']) == 'message') {
		if (esc_attr($a['placeholder']) == '') { $plh = __('Message', 'bilnea'); }
		return '<textarea name="mensaje" class="input'.$fw.'"'.$fi.' placeholder="'.$ob.$plh.'"></textarea>';
	} else if (esc_attr($a['type']) == 'state') {
		$txt = '<select name="provincia" class="input'.$fw.'"'.$fi.'>';
		$txt .= '<option selected disabled>'.$ob.__('State', 'bilnea').'</option>';
		foreach ($prov as $key => $value) {
			$txt .= '<option value="'.$key.'--'.$value.'">'.$value.'</option>';
		}
		$txt .= '</select>';
		return $txt;
	} else if (esc_attr($a['type']) == 'legal') {
		if (esc_attr($a['placeholder']) == '') { $plh = __('Privacy policy', 'bilnea'); }
		switch (substr(explode(' ', $plh)[0], -1)) {
			case 'a':
				$art = _x('the', 'female', 'bilnea');
				break;
			default:
				$art = _x('the', 'male', 'bilnea');
				break;
		}
		$txt  = '<input class="input'.$fw.'" id="legal-'.$ran.'" type="checkbox" name="legal">';
		$txt .= '<p>'.$ob.__('I have read, understood and accept', 'bilnea').' '.$art.' <a href="'.esc_attr($a['url']).'" title="'.$plh.'" target="_blank">'.strtolower($plh).'</a>.</p>';
		return $txt;
	} else if (esc_attr($a['type']) == 'captcha') {
		session_start();
		$rnd = rand(0, 99999999);
		do {
			$md = md5(microtime()*mktime());
			preg_replace('([1aeilou0])', "", $md );
		} while(strlen($md) < esc_attr($a['length']));
		$key = substr( $md, 0, esc_attr($a['length']) );
		$_SESSION['key-'.$rnd] = md5($key);
		$ltr = str_split($key);
		$txt = '<div class="captcha input'.$fw.'"'.$fi.' data-id="'.$rnd.'">'.$ob.__('Fill in the following fields.', 'bilnea').'<br />';
		$i = 1;
		foreach ($ltr as $let) {
			$txt .= '<input type="text" class="captcha required" name="captcha[]" id="captcha_'.$i.'" placeholder="'.$let.'" size="1" maxlength="1">';
			$i++;
		}
		$txt .= '</div>';
		return $txt;
	} else if (esc_attr($a['type']) == 'file') {
		$ftp = '';
		if (esc_attr($a['allow']) != '') { $ftp = ' accept="'.esc_attr($a['allow']).'"'; }
		return '<input class="input'.$fw.'"'.$fi.' type="file"'.$ftp.' name="'.esc_attr($a['type']).'" />';
	} else if (esc_attr($a['type']) == 'week') {
		wp_enqueue_script('jquery-ui');
		wp_enqueue_style('jquery-ui-css');
		wp_enqueue_style('jquery-ui-css-theme');
		$out = '<input class="weekpicker-'.$ran.' input'.$fw.'"'.$fi.' type="text" name="weekpicker" placeholder="'.$ob.$plh.'" />'."\n";
		$out .= '<script type="text/javascript">'."\n";
		$out .= '	jQuery(function($) {'."\n";
		$out .= '		var startDate;'."\n";
		$out .= '		var endDate;'."\n";
		$out .= '		var selectCurrentWeek = function() {'."\n";
		$out .= '			window.setTimeout(function () {'."\n";
		$out .= '				$(\'.weekpickerdiv-'.$ran.'\').find(\'.ui-datepicker-current-day a\').addClass(\'ui-state-active\')'."\n";
		$out .= '			}, 1);'."\n";
		$out .= '		}'."\n";
		$out .= '		$(\'.weekpicker-'.$ran.'\').datepicker( {'."\n";
		$out .= '			beforeShow: function(input, inst) {'."\n";
		$out .= '				$(\'#ui-datepicker-div\').addClass(\'weekpickerdiv-'.$ran.'\');'."\n";
		$out .= '			},'."\n";
		$out .= '			showOtherMonths: true,'."\n";
		$out .= '			selectOtherMonths: true,'."\n";
		$out .= '			showAnim: "fadeIn",'."\n";
		$out .= '			onSelect: function(dateText, inst) { '."\n";
		$out .= '				var date = $(this).datepicker(\'getDate\');'."\n";
		$out .= '				startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay());'."\n";
		$out .= '				endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 6);'."\n";
		$out .= '				var dateFormat = inst.settings.dateFormat || $.datepicker._defaults.dateFormat;'."\n";
		$out .= '				if (typeof callback == \'function\') { callback(\''.$ran.'\', startDate, endDate); };'."\n";
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
		$out .= '		$(\'.weekpickerdiv-'.$ran.' .ui-datepicker-calendar tr\').live(\'mousemove\', function() { $(this).find(\'td a\').addClass(\'ui-state-hover\'); });'."\n";
		$out .= '		$(\'.weekpickerdiv-'.$ran.' .ui-datepicker-calendar tr\').live(\'mouseleave\', function() { $(this).find(\'td a\').removeClass(\'ui-state-hover\'); });'."\n";
		$out .= '	});'."\n";
		$out .= '</script>'."\n";
		return $out;
	} else if (esc_attr($a['type']) == 'day') {
		wp_enqueue_script('jquery-ui');
		wp_enqueue_style('jquery-ui-css');
		wp_enqueue_style('jquery-ui-css-theme');
		$out = '<input class="datepicker-'.$ran.' input'.$fw.'"'.$fi.' type="text" name="datepicker" placeholder="'.$ob.$plh.'" />'."\n";
		$out .= '<script type="text/javascript">'."\n";
		$out .= '	jQuery(function($) {'."\n";
		$out .= '		var startDate;'."\n";
		$out .= '		var endDate;'."\n";
		$out .= '		var selectCurrentWeek = function() {'."\n";
		$out .= '			window.setTimeout(function () {'."\n";
		$out .= '				$(\'.datepickerdiv-'.$ran.'\').find(\'.ui-datepicker-current-day a\').addClass(\'ui-state-active\')'."\n";
		$out .= '			}, 1);'."\n";
		$out .= '		}'."\n";
		$out .= '		$(\'.datepicker-'.$ran.'\').datepicker( {'."\n";
		$out .= '			beforeShow: function(input, inst) {'."\n";
		$out .= '				$(\'#ui-datepicker-div\').addClass(\'datepickerdiv-'.$ran.'\');'."\n";
		$out .= '			},'."\n";
		$out .= '			showOtherMonths: true,'."\n";
		$out .= '			selectOtherMonths: true,'."\n";
		$out .= '			showAnim: "fadeIn",'."\n";
		$out .= '		});'."\n";
		$out .= '	});'."\n";
		$out .= '</script>'."\n";
		return $out;
	} else {
		return '<input class="input'.$fw.'"'.$fi.' type="text" name="'.esc_attr($a['type']).'" placeholder="'.$ob.$plh.'" />';
	}
}

add_shortcode('b_input', 'b_f_input');

function form($atts, $content = null) {
	$ran = rand(0, 99999999);
	global $version;
	global $opt;
	$ip = '';
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip=' '.$_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip=' '.$_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip=' '.$_SERVER['REMOTE_ADDR'];
	}
	$a = shortcode_atts(array(
		'id' => null,
		'class' => null,
		'email' => true,
		'to' => get_option('admin_email'),
		'mensaje' => __('Your message has been sent sucesfully. Your request will delay. A copy has been sent to your email.', 'bilnea'),
		'action' => null,
		'method' => 'post',
		'send' => __('Send', 'bilnea'),
		'subject' => sprintf(esc_html__('Message sent from %s website form', 'bilnea'), get_option('blogname')),
	), $atts);
	$fw = ''; $fi = '';
	if (esc_attr($a['class']) != null) { $fw .= ' '.esc_attr($a['class']); }
	if (esc_attr($a['id']) != null) { $fi = ' id="'.esc_attr($a['id']).'"'; }
	$_SESSION['mail-'.$ran] = esc_attr($a['to']);
	$_SESSION['mens-'.$ran] = esc_attr($a['mensaje']);
	$_SESSION['blogname'] = get_option('blogname');
	$_SESSION['siteurl'] = site_url();
	if (esc_attr($a['action']) != null) { $ac = ' action="'.esc_attr($a['action']).'"'; } else { $ac = ''; }
	wp_enqueue_script('form', get_template_directory_uri().'/js/form.js', array(), $version, true );
	if(file_exists(get_stylesheet_directory().'/mail.php')) {
		$mail = array('mailphp' => get_stylesheet_directory_uri().'/mail.php');
	} else {
		$mail = array('mailphp' => get_template_directory_uri().'/inc/mail.php');
	}
	wp_localize_script('form', 'php', $mail);
	$txt .= '<form'.$ac.' class="form'.$fw.'"'.$fi.' method="'.esc_attr($a['method']).'" data-id="'.$ran.'">';
	$txt .= do_shortcode($content);
	$txt .= '<input type="hidden" value="'.$ip.'" name="ip" id="ip" />';
	$txt .= '<input type="hidden" name="b_f_subject" value="'.esc_attr($a['subject']).'" />';
	if ($opt['b_opt_smtp']) {
		$txt .= '<input type="hidden" value="smtp" name="method" id="method" />';
	} else {
		$txt .= '<input type="hidden" value="mail" name="method" id="method" />';
	}
	$txt .= '</form>';
	$txt .= '<div id="form-send" data-send="'.esc_attr($a['send']).'" data-sending="'.__('Sending', 'bilnea').'">'.esc_attr($a['send']).'</div>';
	$txt .= '<div class="response"></div>';
	return $txt;
}

add_shortcode('b_form', 'form');

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
			$e .= '<div class="'.$fw.' featured-post">';
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
					$e .= __('Published by ', 'bilnea').get_the_author().' ';
				}
				if (esc_attr($a['date']) == 'true' && esc_attr($a['author']) == 'true') {
					$e .= 'el ';
				}
				if (esc_attr($a['date']) == 'true') {
					$e .= get_the_date();
				}
				$e .= '</div>';
			}
			$e .= '<a href="'.get_permalink().'" title="'.get_the_title().'"><h4>'.get_the_title().'</h4></a>';
			if (esc_attr($a['excerpt']) == 'true') {
				if (get_the_excerpt() != '') {
					$e .= '<div class="excerpt">'.get_the_excerpt().'</div>';
				} else {
					$e .= '<div class="excerpt">'.b_f_get_excerpt(the_content()).'</div>';
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
						$e .= __('Published by ', 'bilnea').get_the_author().' ';
					}
					if (esc_attr($a['date']) == 'true' && esc_attr($a['author']) == 'true') {
						$e .= 'el ';
					}
					if (esc_attr($a['date']) == 'true') {
						$e .= get_the_date();
					}
					$e .= '</div>';
				}
				$e .= '<a href="'.get_permalink().'" title="'.get_the_title().'"><h4>'.get_the_title().'</h4></a>';
				if (esc_attr($a['excerpt']) == 'true') {
					if (get_the_excerpt() != '') {
						$e .= '<div class="excerpt">'.get_the_excerpt().'</div>';
					} else {
						$e .= '<div class="excerpt">'.b_f_get_excerpt(the_content()).'</div>';
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
	), $atts);
	$pag = (get_query_var('paged')) ? get_query_var('paged') : 1;
	if (esc_attr($a['number']) != null) {
		$blog_number = esc_attr($a['number']);
	} else {
		$blog_number = b_f_option('b_opt_blog-number');
	}
	$o = array(
		'post_type' => 'post',
		'posts_per_page' => $blog_number,
		'paged' => $pag,
		'orderby' => b_f_option('b_opt_blog-order'),
	);
	if (esc_attr($a['category']) != null) {
		$o['category_name'] = esc_attr($a['category']);
	} else {
		if (!in_array('all', b_f_option('b_opt_blog-categories'))) {
			$o['category_name'] = join(',',b_f_option('b_opt_blog-categories'));
		}
	}
	$query = new WP_Query($o);
	if ($query->have_posts()) {
		$out = '<ul class="blog-wrapper '.esc_attr($a['class']).'">';
		while ($query->have_posts()) {
			$query->the_post();
			ob_start();
			?>
			<li class="post-entry">
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
						<div class="image big" style="background-image: url(<?php echo b_f_option('b_opt_positive-logo'); ?>); background-size: contain;" title="<?php the_title(); ?>">
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
	$out .= '	var center_'.$ran.' = {lat: '.explode(',', $cen)[0].', lng: '.explode(',', $cen)[1].'};'."\n";
	$out .= '	var poi_'.$ran.' = \''.esc_attr($a['poi']).'\';'."\n";
	$out .= '	var zoom_'.$ran.' = '.esc_attr($a['zoom']).';'."\n";
	$out .= '	var drag_'.$ran.' = '.$drag.';'."\n";
	$out .= '	var scroll_'.$ran.' = '.esc_attr($a['scroll']).';'."\n";
	$out .= '	var controls_'.$ran.' = '.esc_attr($a['controls']).';'."\n";
	$out .= '	var m_control_'.$ran.' = '.esc_attr($a['m_control']).';'."\n";
	$out .= '	var z_control_'.$ran.' = '.esc_attr($a['z_control']).';'."\n";
	$out .= '	var markers_'.$ran.' = new Array();'."\n";
	$out .= '</script>'.do_shortcode($content)."\n";
	return $out;
}

add_shortcode('b_map', 'b_f_map');

function b_f_marker($atts) {
	$a = shortcode_atts(array(
		'position' => '37.992900,-1.114391',
		'icon' => null,
		'size' => '40',
	), $atts);
	$out ='<foo id="foo"></div>'."\n";
	$out .= '<script type="text/javascript">'."\n";
	$out .= 'jQuery(function() {';
	$out .= '	var a = jQuery(\'#foo\').prev().prev().attr(\'id\').replace(\'map-\', \'\');'."\n";
	$out .= '		jQuery(\'#foo\').remove();'."\n";
	$out .= '		var marker = {'."\n";
	$out .= '			position: {lat: '.explode(',', str_replace(' ', '', esc_attr($a['position'])))[0].', lng: '.explode(',', str_replace(' ', '', esc_attr($a['position'])))[1].'},'."\n";
	$out .= '			map: \'map_\'+a,'."\n";
	if (esc_attr($a['icon']) != null) {
		$out .= '			icon: {'."\n";
		$out .= '				url: \''.esc_attr($a['icon']).'\','."\n";
		$out .= '				size: \''.esc_attr($a['size']).'\''."\n";
		$out .= '			}'."\n";
	}
	$out .= '		};'."\n";
	$out .= '		var b = window[\'markers_\'+a];';
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
		return '<div class="tweeter">'.$content.'<div class="tweet-link"><a href="https://twitter.com/home?status='.urlencode($content).'" class="fa fa-twitter" target="_blank" rel="nofollow">&nbsp;&nbsp;'.__('Tweet this', 'bilnea').'</a></div></div>';
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
	), $atts, 'b_a_frame');
	$c = '';
	if (esc_attr($a['class']) != null) {
		$c .= ' '.esc_attr($a['class']);
	}
	$out = '<div class="accordion_frame'.$c.'"><'.b_f_sanitize(esc_attr($a['element'])).' class="accordion_title">'.esc_attr($a['title']).'</'.b_f_sanitize(esc_attr($a['element'])).'><div class="accordion_content">'.do_shortcode($content).'</div></div>';
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

?>