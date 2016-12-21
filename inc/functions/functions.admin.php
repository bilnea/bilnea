<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

if (!function_exists('b_f_fonts')) {
	
	function b_f_fonts($var_font) {

		global $b_g_google_api;

		$var_fonts = json_decode(file_get_contents(('https://www.googleapis.com/webfonts/v1/webfonts?key='.$b_g_google_api)));

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
				<option disabled="disabled">Selecciona una tipografía</option>
				<option value="inherit" <?= selected($var_current_font, 'inherit') ?> data="">Heredada</option>

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
	
	if (! isset($_POST['term_featured_image_nonce']) || ! wp_verify_nonce($_POST['term_featured_image_nonce'], basename(__FILE__)))
		return;

	$old_value  = b_f_i_get_term_meta($term_id);
	$new_value = isset($_POST['term_featured_image']) ? b_f_i_sanitize_text_field ($_POST['term_featured_image']) : '';


	if ($old_value && '' === $new_value)
		delete_term_meta($term_id, '_term-featured-image');

	else if ($old_value !== $new_value)
		update_term_meta($term_id, '_term-featured-image', $new_value);

	if (!get_term_meta($term_id, 'custom-order', true)) {
		update_term_meta($term_id, 'custom-order', 0);
	}
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

		if (! $var_value) {
			$var_value = '';
		}

		$out = sprintf('<span class="term-meta-featured-image-block" style="" >%s</div>', esc_attr($value));
	}

	return '<a style="background-image: url('.wp_get_attachment_image_src($var_value, 'thumbnail')[0].');"></a>';

}

add_action('init', 'b_f_i_register_term_metabox', 50);


if (!function_exists('b_f_i_order_elements')) {
	
	function b_f_i_order_elements($query) {
		if (!isset($query->query['orderby']) || $query->query['orderby'] == '' && ($query->get('post_type') != 'attachment' && $query->get('post_type') != 'nav_menu_item')) {
			$query->set('orderby', 'menu_order');
			$query->set('order', 'ASC');
		}
	}

	add_filter('pre_get_posts', 'b_f_i_order_elements' );

}


if (!function_exists('b_f_i_terms_orderby')) {

	function b_f_i_terms_orderby($args, $taxonomies) {

		if (!isset($_GET['orderby']) && 'nav_menu' != $taxonomies[0]) {
			$args['meta_key'] = 'custom-order';
			$args['orderby'] = 'meta_value';
			$args['order'] = 'DESC';
		}

		return $args;

	}

	add_filter('get_terms_args', 'b_f_i_terms_orderby', 10, 2);

}

?>