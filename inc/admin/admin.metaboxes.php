<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


if (!function_exists('b_f_page_get_metabox')) {

	function b_f_page_get_metabox($value) {

		// Variables globales
		global $post;

		if (!is_page($post->ID)) {
			return 1;
		}

		// Variables locales
		$var_field = get_post_meta($post->ID, $value, true);
		if (!empty($var_field)) {
			return is_array($var_field) ? stripslashes_deep($var_field) : stripslashes(wp_kses_decode_entities($var_field));
		} else {
			return false;
		}

	}

}

if (!function_exists('b_f_page_add_metaboxes')) {

	function b_f_page_add_metaboxes() {

		add_meta_box('template-config', 'Configuración de plantilla',
			'b_f_page_add_template_metabox',
			'page',
			'side',
			'default'
		);
	}

	add_action('add_meta_boxes', 'b_f_page_add_metaboxes');

}

if (!function_exists('b_f_page_add_template_metabox')) {

	function b_f_page_add_template_metabox($post) {

		// Variables globales
		wp_nonce_field('page_template_metabox', 'page_template_metabox_nonce'); ?>

		<h4 style="margin-bottom: 0;">Cabecera de página</h4>
		<p style="margin-top: 6px;">
			<input type="checkbox" name="b_o_page_metabox_top_bar" value="1" <?php echo (get_post_meta($_GET['post'], 'b_o_page_metabox_top_bar', true) == 1) ? 'checked' : ''; ?>>
			<label for="b_o_page_metabox_top_bar">Barra superior</label>
			<br />
			<input type="checkbox" name="b_o_page_metabox_header" value="1" <?php echo (get_post_meta($_GET['post'], 'b_o_page_metabox_header', true) == 1) ? 'checked' : ''; ?>>
			<label for="b_o_page_metabox_header">Zona principal cabecera de página</label>
		</p>
		<hr />
		<h4 style="margin-bottom: 0;">Pie de página</h4>
		<p style="margin-top: 6px;">
			<input type="checkbox" name="b_o_page_metabox_footer" value="1" <?php echo (get_post_meta($_GET['post'], 'b_o_page_metabox_footer', true) == 1) ? 'checked' : ''; ?>>
			<label for="b_o_page_metabox_footer">Zona principal pie de página</label>
			<br />
			<input type="checkbox" name="b_o_page_metabox_bottom_bar" value="1" <?php echo (get_post_meta($_GET['post'], 'b_o_page_metabox_bottom_bar', true) == 1) ? 'checked' : ''; ?>>
			<label for="b_o_page_metabox_bottom_bar">Barra inferior</label>
		</p>
		<hr />
		<h4 style="margin-bottom: 0;">Menú móvil</h4>
		<p style="margin-top: 6px;">
			<input type="checkbox" name="b_o_page_mobile_menu" value="1" <?php echo (get_post_meta($_GET['post'], 'b_o_page_mobile_menu', true) == 1) ? 'checked' : ''; ?>>
			<label for="b_o_page_mobile_menu">Menú móvil</label>
			<br />
			<input type="checkbox" name="b_o_page_mobile_bar" value="1" <?php echo (get_post_meta($_GET['post'], 'b_o_page_mobile_bar', true) == 1) ? 'checked' : ''; ?>>
			<label for="b_o_page_mobile_bar">Barra superior</label>
		</p>

		<?php

	}

}

if (!function_exists('b_f_page_save_template_metabox')) {

	function b_f_page_save_template_metabox($post_id) {

		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

		if (!isset($_POST['page_template_metabox_nonce']) || ! wp_verify_nonce($_POST['page_template__metabox_nonce'], 'page_template_metabox')) return;

		if (!current_user_can('edit_post', $post_id)) return;

		if (isset($_POST['b_o_page_metabox_top_bar']))
			update_post_meta($post_id, 'b_o_page_metabox_top_bar', esc_attr($_POST['b_o_page_metabox_top_bar']));
		else
			update_post_meta($post_id, 'b_o_page_metabox_top_bar', 0);

		if (isset($_POST['b_o_page_metabox_header']))
			update_post_meta($post_id, 'b_o_page_metabox_header', esc_attr($_POST['b_o_page_metabox_header']));
		else
			update_post_meta($post_id, 'b_o_page_metabox_header', 0);

		if (isset($_POST['b_o_page_metabox_footer']))
			update_post_meta($post_id, 'b_o_page_metabox_footer', esc_attr($_POST['b_o_page_metabox_footer']));
		else
			update_post_meta($post_id, 'b_o_page_metabox_footer', 0);

		if (isset($_POST['b_o_page_metabox_bottom_bar']))
			update_post_meta($post_id, 'b_o_page_metabox_bottom_bar', esc_attr($_POST['b_o_page_metabox_bottom_bar']));
		else
			update_post_meta($post_id, 'b_o_page_metabox_bottom_bar', 0);

		if (isset($_POST['b_o_page_mobile_menu']))
			update_post_meta($post_id, 'b_o_page_mobile_menu', esc_attr($_POST['b_o_page_mobile_menu']));
		else
			update_post_meta($post_id, 'b_o_page_mobile_menu', 0);

		if (isset($_POST['b_o_page_mobile_bar']))
			update_post_meta($post_id, 'b_o_page_mobile_bar', esc_attr($_POST['b_o_page_mobile_bar']));
		else
			update_post_meta($post_id, 'b_o_page_mobile_bar', 0);

	}

	add_action('save_post', 'b_f_page_save_template_metabox');
}

?>