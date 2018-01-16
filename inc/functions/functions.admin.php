<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

if (!function_exists('b_f_dashboard')) {

	function b_f_dashboard() {

		global $wp_meta_boxes;

		wp_add_dashboard_widget('bilnea_widget', 'bilnea Digital, S.L.', function() {

			$out = '<div class="bilnea_dashboard"><a href="https://bilnea.com" target="_blank" class="thumb" style="background-image: url('.get_template_directory_uri().'/img/logo-bilnea.png); display: block; background-size: contain; background-position: center; padding-bottom: 20%; background-repeat: no-repeat; margin-bottom: 20px;"></a>Desarrollo web realizado por <a href="https://bilnea.com" target="_blank">bilnea: La Agencia de Comunicación y Marketing Digital</a>. Puedes contactarnos en <a href="mailto:hola@bilnea.com">hola@bilnea.com</a> o en los teléfonos <a href="tel:968168456">968 168 456</a> o <a href="tel:961155808">96 11 55 808</a>.<br /><br /><em style="font-size: .8em;">&copy; '.date('Y').' bilnea, Samuel E. Cerezo, Carlos García.</em></div>';

			echo $out;

		});

			

	}

	add_action('wp_dashboard_setup', 'b_f_dashboard');

}


if (!function_exists('b_f_fonts')) {
	
	function b_f_fonts($var_font) {

		$var_fonts = json_decode(b_f_get_file_content(get_template_directory_uri().'/inc/data/data.google.fonts.json'));

		$b_g_google_fonts = array();

		foreach ($var_fonts->items as $font) {
			$var_sizes = $font->variants;
			foreach ($var_sizes as &$temp) {
				if ($temp == 'regular') { $temp = '400'; }
				if ($temp == 'italic') { $temp = '400italic'; }
			}
			$b_g_google_fonts['"'.$font->family.'", '.$font->category] = array(
				'name' => str_replace(' ', '+', $font->family),
				'sizes' => $var_sizes
			);
		}

		?>

		<!-- Selector tipográfico -->
		<div class="font-selector">
			<select name="bilnea_settings[b_opt_<?= $var_font ?>_ttf-font]" class="gran font-selector">
				<option value="inherit" selected data="">Heredada</option>

				<?php
				
				foreach ($b_g_google_fonts as $key => $value) {
					$var_current_font = b_f_option('b_opt_'.$var_font.'_ttf-font', true);
					echo '<option value="'.$value['name'].'" '.selected($var_current_font, $value['name']).' data="'.implode(',', $value['sizes']).'">'.str_replace('+', ' ', $value['name']).'</option>';
				}

				?>

			</select>
		</div>

		<!-- Selector tamaño -->
		<div class="font-size-picker">
			<input type="text" class="sp-input" name="bilnea_settings[b_opt_<?= $var_font ?>_ttf-size]" value="<?= b_f_option('b_opt_'.$var_font.'_ttf-size'); ?>" placeholder="<?= b_f_default('b_opt_'.$var_font.'_ttf-size'); ?>">
		</div>

		<!-- Selector color -->
		<div class="font-color-picker">
			<input type="text" class="sp-input" name="bilnea_settings[b_opt_<?= $var_font ?>_ttf-color]" value="<?= b_f_option('b_opt_'.$var_font.'_ttf-color'); ?>" placeholder="<?= b_f_default('b_opt_'.$var_font.'_ttf-color'); ?>" />
			<input type="text" class="colora text peq">
		</div>

		<!-- Selector estilo -->
		<div class="font_styles" style="position: relative;">
			<div><span>Regular</span><span>Cursiva</span></div>
			<?php

				$var_weights = array('100','200','300','400','500','600','700','800','900');

				foreach ($var_weights as $var_weight) {

					?>

					<div>
						<input type="radio" value="<?= $var_weight ?>" name="bilnea_settings[b_opt_<?= $var_font ?>_ttf-style]" <?php checked(b_f_option('b_opt_'.$var_font.'_ttf-style'), $var_weight); ?> />
						<input type="radio" value="<?= $var_weight ?>italic" name="bilnea_settings[b_opt_<?= $var_font ?>_ttf-style]" <?php checked(b_f_option('b_opt_'.$var_font.'_ttf-style'), $var_weight.'italic'); ?> />
					</div>

					<?php

				}

			?>

			<div class="notice font">
				<span style="font-family: 'Roboto'; font-weight: 100;">a</span> ... <span style="font-family: 'Roboto'; font-weight: 900;">a</span>
				<br />
				<span style="font-family: 'Roboto'; font-weight: 100; font-style: italic;">a</span> ... <span style="font-family: 'Roboto'; font-weight: 900; font-style: italic;">a</span>
			</div>

			<div class="font-uppercase">
				<span>
					<input type="checkbox" name="bilnea_settings[b_opt_<?= $var_font ?>_ttf-uppercase]" <?php checked(b_f_option('b_opt_'.$var_font.'_ttf-uppercase'), 1); ?> value="1">Mayúsculas
				</span>
				<span>
					<input type="checkbox" name="bilnea_settings[b_opt_<?= $var_font ?>_ttf-underline]" <?php checked(b_f_option('b_opt_'.$var_font.'_ttf-underline'), 1); ?> value="1">Subrayado
				</span>
			</div>

		</div>
		<?php
	}

}


if (!function_exists('b_f_smtp_server')) {

	function b_f_smtp_server(PHPMailer $var_smtp) {

		$var_smtp->Host = b_f_option('b_opt_smtp-server');
		$var_smtp->Port = b_f_option('b_opt_smtp-port');
		$var_smtp->Username = b_f_option('b_opt_smtp-user');
		$var_smtp->Password = b_f_option('b_opt_smtp-pass');

		if (b_f_option('b_opt_smtp-auth') == 1) {
			$var_smtp->SMTPAuth = true;
		}

		if (b_f_option('b_opt_smtp-secure') == 1 && b_f_option('b_opt_smtp-protocol') == 'ssl') {
			$var_smtp->SMTPSecure = 'ssl';
		}

		if (b_f_option('b_opt_smtp-secure') == 1 && b_f_option('b_opt_smtp-protocol') == 'tls') {
			$var_smtp->SMTPSecure = 'tls';
		}
		
		$var_smtp->IsSMTP();

	}

}


if (!function_exists('b_f_create_page')) {
	
	function b_f_create_page($var_page, $var_title, $var_language = 'es', $var_noindex = true) {

		include_once('inc/'.$var_language.'/'.$var_page.'.php');

		$var_create_page = array(
			'post_title'    => $var_title,
			'post_content'  => $txt,
			'post_status'   => 'publish',
			'post_author'   => 1,
			'post_type'     => 'page',
			'post_name'     => $var_page,
			'post_parent'	=> 0,
			'page_template'	=> 'blank-page.php'
		);

		$var_id = wp_insert_post($var_create_page);

		$var_options = get_option('bilnea_settings');

		$var_options['b_opt_'.$var_page.'-'.$var_language] = $var_id;

		update_option('bilnea_settings', $var_options);

		if ($var_noindex  == true) {
			add_post_meta($var_id, '_yoast_wpseo_meta-robots-noindex', '1');
		}
	}

}


function b_f_i_register_term_metabox() {

	register_meta('term', '_term-featured-image', 'b_f_i_sanitize_text_field');

	foreach (get_taxonomies() as $term) {
		if (!in_array($term, array('post_tag', 'nav_menu', 'link_category', 'post_format'))) {
			add_action($term.'_add_form_fields', 'b_f_i_term_add_meta_field');
			add_action($term.'_edit_form_fields', 'b_f_i_term_edit_featured_image');
			add_action('edit_'.$term, 'b_f_i_term_save_featured_image');
			add_action('create_'.$term, 'b_f_i_term_save_featured_image');
			add_filter('manage_edit-'.$term.'_columns', 'b_f_i_edit_term_columns');
			add_filter('manage_'.$term.'_custom_column', 'b_f_i_manage_term_columns', 10, 3);
		}
	}

}


function b_f_i_sanitize_text_field ($value) {

	return sanitize_text_field ($value);

}


function b_f_i_get_term_meta($term_id) {

	$var_value = get_term_meta($term_id, '_term-featured-image', true);
	$var_value = b_f_i_sanitize_text_field($var_value);

	return $var_value;

}


function b_f_i_term_add_meta_field() {

	wp_nonce_field(basename(__FILE__), 'term_featured_image_nonce');
	wp_enqueue_media();

	?>

	<div class="form-field term-meta-featured-image-wrap">
		<label for="term-meta-featured-image">Imagen destacada</label>
		<div data-columns="8">
			<ul id="term_images" style="overflow: hidden;">
				<li class="attachment" style="width: 100px; padding: 0;">
					<div class="attachment-preview">
						<div class="thumbnail" style="background-size: cover; box-shadow: 0 0 10px rgba(0, 0, 0, 0.6) inset; border: 1px solid #eceded; overflow: hidden;"></div>
					</div>
				</li>
			</ul>
		</div>
		<input type="hidden" name="term_featured_image" id="term-meta-featured-image" value="" class="term-meta-featured-image-field" />
		<input type="button" id="term_meta-image-button" class="button" value="Seleccionar imagen" />
		<script>
			jQuery(function($) {
				var mediaUploader;
				$('#term_meta-image-button, #term_images li').click(function(e) {
					e.preventDefault();
					if (mediaUploader) {
						mediaUploader.open();
						return;
					}
					mediaUploader = wp.media.frames.file_frame = wp.media({
						title: 'Seleccionar imagen',
						button: {
							text: 'Seleccionar'
						}, multiple: false
					});
					mediaUploader.on('select', function() {
						attachment = mediaUploader.state().get('selection').first().toJSON();
						$('#term-meta-featured-image').val(attachment.id);
						$('#term_images li .thumbnail').css('background-image', 'url('+attachment.sizes.thumbnail.url+')');
					});
					mediaUploader.open();
				})
			})
		</script>
	</div>

	<?php

}


function b_f_i_term_edit_featured_image($term) {

	wp_enqueue_media();
	$var_value  = b_f_i_get_term_meta($term->term_id);

	if (!$var_value) {
		$var_value = '';
	}
		
	?>

	<tr class="form-field term-meta-featured-image-wrap">
		<th scope="row">
			Imagen destacada
		</th>
		<td>

			<?php

			wp_nonce_field(basename(__FILE__), 'term_featured_image_nonce');

			?>

			<div data-columns="8">
				<ul id="term_images" style="overflow: hidden;">
					<li class="attachment" style="width: 100px; padding: 0;">
						<div class="attachment-preview">
							<div class="thumbnail" style="background-image: url(<?= wp_get_attachment_image_src($var_value, 'thumbnail')[0] ?>); background-size: cover; box-shadow: 0 0 10px rgba(0, 0, 0, 0.6) inset; border: 1px solid #eceded; overflow: hidden;"></div>
						</div>
					</li>
				</ul>
			</div>
			<input type="hidden" name="term_featured_image" id="term-meta-featured-image" value="<?= $var_value ?>" class="term-meta-featured-image-field" />
			<input type="button" id="term_meta-image-button" class="button" value="Seleccionar imagen" />
			<script>
				jQuery(function($) {
					var mediaUploader;
					$('#term_meta-image-button, #term_images li').click(function(e) {
						e.preventDefault();
						if (mediaUploader) {
							mediaUploader.open();
							return;
						}
						mediaUploader = wp.media.frames.file_frame = wp.media({
							title: 'Seleccionar imagen',
							button: {
								text: 'Seleccionar'
							}, multiple: false
						});
						mediaUploader.on('select', function() {
							attachment = mediaUploader.state().get('selection').first().toJSON();
							$('#term-meta-featured-image').val(attachment.id);
							$('#term_images li .thumbnail').css('background-image', 'url('+attachment.sizes.thumbnail.url+')');
						});
						mediaUploader.open();
					})
				})
			</script>
		</td>
	</tr>

<?php

}


function b_f_i_term_save_featured_image($term_id) {
	
	if (!isset($_POST['term_featured_image_nonce']) || !wp_verify_nonce($_POST['term_featured_image_nonce'], basename(__FILE__)))
		return;

	$old_value  = b_f_i_get_term_meta($term_id);
	$new_value = isset($_POST['term_featured_image']) ? b_f_i_sanitize_text_field ($_POST['term_featured_image']) : '';


	if ($old_value && '' === $new_value)
		delete_term_meta($term_id, '_term-featured-image');

	else if ($old_value !== $new_value)
		update_term_meta($term_id, '_term-featured-image', $new_value);

}


function b_f_i_edit_term_columns($var_columns) {

	$var_new_columns = array();

	foreach ($var_columns as $key => $value) {
		if ($key == 'name') {
			$var_new_columns['term-featured-image'] = '';
		}
		$var_new_columns[$key] = $value;
	}

	return $var_new_columns;
}


function b_f_i_manage_term_columns($out, $column, $term_id) {

	if ('term-featured-image' === $column) {

		$var_value  = b_f_i_get_term_meta($term_id);

		if (!$var_value) {
			$var_value = '';
		}

		$out = sprintf('<span class="term-meta-featured-image-block" style="" >%s</div>', esc_attr($var_value));
	}

	return '<a style="background-image: url('.wp_get_attachment_image_src($var_value, 'thumbnail')[0].');"></a>';

}

add_action('init', 'b_f_i_register_term_metabox', 50);


if (!function_exists('b_f_i_encrypt_decrypt')) {
	
	function b_f_i_encrypt_decrypt($action, $raw) {

		// Variables globales
		global $b_g_hash;

		$key = $b_g_hash;

		if ($action == 'encrypt') {
			return base64_encode(mcrypt_encrypt(
				MCRYPT_RIJNDAEL_256,
				md5($key),
				$raw,
				MCRYPT_MODE_CBC,
				md5(md5($key))
			));
		} else if ($action == 'decrypt') {
	   		return rtrim(
				mcrypt_decrypt(
					MCRYPT_RIJNDAEL_256,
					md5($key),
					base64_decode($raw),
					MCRYPT_MODE_CBC,
					md5(md5($key))
				)
			);
		}

	}

}

if (!function_exists('b_f_thumbnail_columns')) {

	function b_f_thumbnail_columns($var_columns) {

		// Variables locales
		$var_new_columns = array();

		foreach ($var_columns as $key => $value) {
			if ($key == 'title') {
				$var_new_columns['admin_thumb'] = '';
			}
			$var_new_columns[$key] = $value;
		}

		return $var_new_columns;

	}

}

if (!function_exists('b_f_thumbnail_columns_data')) {

	function b_f_thumbnail_columns_data($var_column, $var_post_id) {

		switch ($var_column) {
			case 'admin_thumb':
				echo '<a style="background-image: url('.wp_get_attachment_image_src(get_post_thumbnail_id($var_post_id), 'thumbnail')[0].');" href="'.get_edit_post_link().'"></a>';
				break;
		}

	}

}

foreach (get_post_types() as $post_type) {
	if (post_type_supports($post_type, 'thumbnail')) {
		add_filter('manage_posts_columns', 'b_f_thumbnail_columns');
		add_action('manage_posts_custom_column', 'b_f_thumbnail_columns_data', 10, 2);
	}
}


if (!function_exists('b_f_svg')) {

	function b_f_svg($var_mime_types) {
		$var_mime_types['svg'] = 'image/svg+xml';
		return $var_mime_types;
	}

	add_filter('upload_mimes', 'b_f_svg');
}


if (!function_exists('b_f_rich_editor')) {

	function b_f_rich_editor($content) {

		// Variables globales
		global $post_type;

		if ('page' == $post_type) {
			return false;
		}

		return $content;

	}

	add_filter('user_can_richedit', 'b_f_rich_editor');
	
}


if (!function_exists('b_f_sanitize_upload')) {

	function b_f_sanitize_upload($filename) {

		// Variables locales
		$var_ext = pathinfo($filename, PATHINFO_EXTENSION);
		$sanitized = preg_replace('/[^a-zA-Z0-9-_.]/','', substr($filename, 0, -(strlen($var_ext)+1)));
		$sanitized = str_replace('.','-', $sanitized);

		return strtolower($sanitized.'.'.$var_ext);

	}

	add_filter('sanitize_file_name', 'b_f_sanitize_upload', 10);

}

// Añadir tema al panel de administración

if (!function_exists('b_f_admin_menu')) {
	
	function b_f_admin_menu() {

		// Variables globales
		global $b_g_icon;
		
		add_menu_page('Opciones del tema', 'bilnea', 'manage_options', 'bilnea', 'b_f_options_page', $b_g_icon, 75);
	}

	add_action('admin_menu', 'b_f_admin_menu');

}

if (!function_exists('b_f_subscribers_menu')) {
	
	function b_f_subscribers_menu() { 
		add_submenu_page('bilnea', 'Suscriptores', 'Suscriptores', 'manage_options', 'subscribers', 'bilnea_subscribers_page');
	}

	if (b_f_option('b_opt_subscribers') == 1) {
		add_action('admin_menu', 'b_f_subscribers_menu');
	}

}


// Variable para almacenar las opciones del tema

if (!function_exists('b_f_variables')) {
	
	function b_f_variables() { 
		register_setting('pluginPage', 'bilnea_settings');
	}

	add_action('admin_init', 'b_f_variables');

}


// Cambiar la ruta de acceso

if (strlen(b_f_option('b_opt_wp-admin')) > 0) {

	if (!is_user_logged_in() && explode('/', trim($_SERVER['REQUEST_URI'], '/'))[0] == 'wp-admin' && b_f_option('b_opt_wp-admin') != 'wp-admin') {

		global $wp_query;

		$wp_query->set_404();
		
		status_header(404);

		die;

	}

	if (!function_exists('b_f_login_slug')) {

		function b_f_login_slug() {

			if (($slug = b_f_option('b_opt_wp-admin')) || (is_multisite() && ($slug = b_f_option('b_opt_wp-admin'))) || ($slug = 'login')) {
				return $slug;
			}

		}

	}

	global $pagenow;

	$request = parse_url($_SERVER['REQUEST_URI']);

	$wp_login_php = false;

	add_action('wp_loaded', 'b_f_wploaded');

	add_filter('site_url', 'b_f_site_url', 10, 4);
	add_filter('network_site_url', 'b_f_networksite_url', 10, 3);
	add_filter('wp_redirect', 'b_f_wpredirect', 10, 2);

	remove_action('template_redirect', 'wp_redirect_admin_locations', 1000);

	if (!function_exists('b_f_site_url')) {

		function b_f_site_url($url, $path, $scheme, $blog_id = 0) {
			return b_f_filter_login($url, $scheme);
		}

	}

	if (!function_exists('b_f_networksite_url')) {

		function b_f_networksite_url($url, $path, $scheme) {
			return b_f_filter_login($url, $scheme);
		}

	}

	if (!function_exists('b_f_wpredirect')) {

		function b_f_wpredirect($location, $status) {
			return b_f_filter_login($location);
		}

	}

	if (!function_exists('b_f_wploaded')) {
		
		function b_f_wploaded() {
		
			global $pagenow;
			
			if (is_admin() && !is_user_logged_in() && !defined('DOING_AJAX')) {
				
				global $wp_query;

				$wp_query->set_404();
			
				status_header(404);
			
			}
			
			$request = parse_url($_SERVER['REQUEST_URI']);
			
			if ($pagenow === 'wp-login.php' && $request['path'] !== user_trailingslashit($request['path']) && get_option('permalink_structure')) {

				wp_safe_redirect(user_trailingslashit(b_f_login_url()).(!empty($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : ''));
				
				die;
			
			} elseif ($wp_login_php) {
				
				if (($referer = wp_get_referer()) && strpos($referer, 'wp-activate.php') !== false && ($referer = parse_url($referer)) && !empty($referer['query'])) {
					
					parse_str($referer['query'], $referer);
					
					if (!empty($referer['key']) && ($result = wpmu_activate_signup($referer['key'])) && is_wp_error($result) && ($result->get_error_code() === 'already_active' || $result->get_error_code() === 'blog_taken')) {
						
						wp_safe_redirect(b_f_login_url().(!empty($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : ''));
						
						die;
					
					}
				
				}
				
				b_f_load_template();
			
			} elseif ($pagenow === 'wp-login.php') {
				
				global $error, $interim_login, $action, $user_login;
				
				@require_once ABSPATH.'wp-login.php';
				
				die;
			
			}
		
		}

	}

	if (!function_exists('b_f_filter_login')) {
		
		function b_f_filter_login($url, $scheme = null) {
			
			if (strpos($url, 'wp-login.php') !== false) {
				
				if (is_ssl()) {
					
					$scheme = 'https';
				
				}
				
				$args = explode('?', $url);
				
				if (isset($args[1])) {
					
					parse_str($args[1], $args);
					
					$url = add_query_arg($args, b_f_login_url($scheme));
				
				} else {
					
					$url = b_f_login_url($scheme);
				
				}
			
			}
			
			return $url;
		
		}

	}

	if (!function_exists('b_f_login_url')) {

		function b_f_login_url($scheme = null) {

			if (get_option('permalink_structure')) {
				return user_trailingslashit(home_url('/', $scheme).b_f_login_slug());
			} else {
				return home_url('/', $scheme).'?'.b_f_login_slug();
			}

		}

	}

	if (!function_exists('b_f_load_template')) {
		
		function b_f_load_template() {

			global $pagenow;

			$pagenow = 'index.php';

			if (!defined('WP_USE_THEMES')) {
				define('WP_USE_THEMES', true);
			}

			wp();

			if ($_SERVER['REQUEST_URI'] === user_trailingslashit(str_repeat('-/', 10))) {
				$_SERVER['REQUEST_URI'] = user_trailingslashit('/wp-login-php/');
			}

			require_once ABSPATH.WPINC.'/template-loader.php';

			die;
		}

	}

	if (is_admin() && !is_user_logged_in() && !defined('DOING_AJAX')) {
		
		global $wp_query;

		$wp_query->set_404();
		
		status_header(404);

	}

	

	if (!is_multisite() && (strpos($_SERVER['REQUEST_URI'], 'wp-signup') !== false || strpos($_SERVER['REQUEST_URI'], 'wp-activate') !== false)) {
		
		global $wp_query;

		$wp_query->set_404();

		status_header(404);
	
	}

	if ((strpos($_SERVER['REQUEST_URI'], 'wp-login.php') !== false || untrailingslashit($request['path']) === b_f_site_url(site_url(), 'wp-login', 'relative')) && !is_admin()) {

		$wp_login_php = true;
		
		$_SERVER['REQUEST_URI'] = user_trailingslashit('/'.str_repeat('-/', 10));
		
		$pagenow = 'index.php';
	
	} elseif (untrailingslashit($request['path']) === home_url(b_f_login_slug(), 'relative') || (!get_option('permalink_structure') && isset($_GET[b_f_login_slug()]) && empty($_GET[b_f_login_slug()]))) {
	
		$pagenow = 'wp-login.php';
	
	}

	if ($pagenow === 'wp-login.php' && $request['path'] !== user_trailingslashit($request['path']) && get_option('permalink_structure')) {
		
		wp_safe_redirect(user_trailingslashit(b_f_login_url()).(!empty($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : ''));
		
		die;
	
	} elseif ($wp_login_php) {
		
		if (($referer = wp_get_referer()) && strpos($referer, 'wp-activate.php') !== false && ($referer = parse_url($referer)) && !empty($referer['query'])) {
			
			parse_str($referer['query'], $referer);
			
			if (!empty($referer['key']) && ($result = wpmu_activate_signup($referer['key'])) && is_wp_error($result) && ($result->get_error_code() === 'already_active' || $result->get_error_code() === 'blog_taken')) {
				
				wp_safe_redirect(b_f_login_url().(!empty($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : ''));
				
				die;

			}
		
		}
		
		b_f_load_template();
		
	} elseif ($pagenow === 'wp-login.php') {
		
		global $error, $interim_login, $action, $user_login;
		
		@require_once ABSPATH.'wp-login.php';
		
		die;
	
	}
}


// Ir a la página principal al cerrar sesión

function b_f_go_home() {
	wp_redirect(home_url());
	exit();
}

add_action('wp_logout','b_f_go_home');

remove_filter('pre_term_description', 'wp_filter_kses');


// Restrucuración de columnas

if (!function_exists('b_f_change_admin_columns')) {
	
	function b_f_change_admin_columns($var_columns) {

		$var_new = array();

		if (isset($var_columns['wpseo-title'])) {

			foreach($var_columns as $key => $value) {

				if ($key == 'title') {
					$var_new['title'] = __('Title');
					$var_new['wpseo-metadesc'] = $var_columns['wpseo-metadesc'];
				}

				if (!in_array($key, array('title', 'wpseo-title', 'wpseo-metadesc'))) {
					$var_new[$key] = $value;
				}

			}

		} else {

			return $var_columns;

		}

		return $var_new;  
	}

	add_filter('manage_edit-posts_columns', 'b_f_change_admin_columns', 10, 1);
	add_filter('manage_edit-page_columns', 'b_f_change_admin_columns', 10, 1);

}

if (!function_exists('b_f_seo_title')) {
	
	function b_f_seo_title($var_title, $var_id) {

		if (is_plugin_active('wordpress-seo/wp-seo.php')) {
			$var_title =  WPSEO_Frontend::get_instance()->get_content_title(get_post($var_id));
		}

		return $var_title;

	}

	global $pagenow;

	if ( $pagenow == 'edit.php' ) {
		add_filter('the_title', 'b_f_seo_title',100, 2);
	}

}


?>