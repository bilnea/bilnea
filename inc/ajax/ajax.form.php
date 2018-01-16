<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


// Envío de formulario

if (!function_exists('b_a_send_form')) {

	function b_a_send_form() {

		// Comprobación variables
		if (isset($_POST['eid']) && $_POST['eid'] != '' && isset($_POST['action']) && $_POST['action'] == 'b_send_form') {

			// Variables globales
			global $wpdb, $b_g_hash, $b_g_language, $b_g_uniqid;

			// Variables locales
			(isset($_POST['b_i_form-name']) && $_POST['b_i_form-name'] != '') ? $var_form_name = $_POST['b_i_form-name'].' ' : $var_form_name = '';
			$var_to = rtrim(b_f_i_encrypt_decrypt('decrypt', $_POST['b_i_to']), "\0");
			$var_headers = 'From: '.get_bloginfo('name').' <noreply@'.$_SERVER['SERVER_NAME'].'>'."\r\n";
			if (isset($_POST['b_i_reply']) && $_POST['b_i_reply'] != '') {
				$var_headers .= 'Reply-to: '.$_POST['b_i_reply']."\r\n";
			}
			$var_headers .= 'Content-Type: text/html; charset=UTF-8';

			// Preparación de datos
			$var_names = json_decode(str_replace('\"', '"', str_replace("'", "\'", $_POST['b_i_names'])), true);
			$var_table = $wpdb->prefix.'form_users';
			$var_temp = array();
			foreach ($_POST as $key => $value) {
				if (!in_array($key, array('b_i_to', 'b_i_sucess', 'b_i_subject', 'b_i_formname', 'b_i_page', 'b_i_ip', 'b_i_redirect', 'b_i_names', 'b_i_reply'))) {
					$var_temp[str_replace("\'", "'", $var_names[$key])] = $value;
				}
			}


			if (!function_exists( 'wp_handle_upload')) require_once(ABSPATH.'wp-admin/includes/file.php');

			$attachments = array();
			$uploaded_files = array();

			add_filter('upload_dir', 'b_f_i_change_upload_dir');

			foreach ($_FILES as $key => $files) {

				$upload_overrides = array('test_form' => false);

				$attachments = array();

				foreach ($files['name'] as $key => $value) {
					if ($files['name'][$key]) {

						$file = array(
							'name' => $files['name'][$key],
							'type' => $files['type'][$key],
							'tmp_name' => $files['tmp_name'][$key],
							'error' => $files['error'][$key],
							'size' => $files['size'][$key]
						);
						
						array_push($uploaded_files, wp_upload_dir()['baseurl'].'/mail/'.$b_g_uniqid.'/'.$file['name']);

						$movefile = wp_handle_upload($file, $upload_overrides);

						$attachments[] = $movefile['file'];

					}
				}

			}

			remove_filter('upload_dir', 'b_f_i_change_upload_dir');

			$var_data = array(
				'data' => serialize($var_temp),
				'date' => date('Y-m-d H:i:s'),
				'email' => ((isset($_POST['b_i_reply']) && $_POST['b_i_reply'] != '') ? $_POST['b_i_reply'] : 'Sin correo electrónico'),
				'formname' => rtrim(b_f_i_encrypt_decrypt('decrypt', $_POST['b_i_formname']), "\0"),
				'ip' => $_POST['b_i_ip'],
				'page' => rtrim(b_f_i_encrypt_decrypt('decrypt', $_POST['b_i_page']), "\0"),
				'status' => 'sent',
				'lang' => $b_g_language,
				'attachments' => serialize($uploaded_files)
			);

			// Correo electrónico
			$var_message = '<div style="font-family: Arial, Helvetica;"><a href="'.get_home_url().'"><h3>'.get_bloginfo('name').'</h3></a><hr />';
			$var_message .= 'Se ha enviado un mensaje a través del formulario web '.$var_form_name.'de '.get_bloginfo('name').'.<hr />';
			foreach ($var_temp as $key => $value) {
				$var_message .= '<strong>'.$key.'</strong>: '.$value.'<br />';
			}
			$var_message .= '<hr />Mensaje enviado el '.date('j/n/Y').' a las '.date('G:i').' desde la dirección IP '.$_POST['b_i_ip'].'.</div>';
			if (isset($_POST['b_i_custom_subject']) && $_POST['b_i_custom_subject'] != '') {
				$var_subject = $_POST['b_i_custom_subject'];
			} else {
				$var_subject = rtrim(b_f_i_encrypt_decrypt('decrypt', $_POST['b_i_subject']), "\0");
			}

			// Cambio de idioma
			$var_locale = setlocale(LC_ALL, 0);
			setlocale(LC_ALL, 'es_ES');

			// Configuración SMTP
			if (b_f_option('b_opt_smtp') == 1) {
				add_action('phpmailer_init', 'b_f_smtp_server');
			}
print_r(b_f_i_encrypt_decrypt('decrypt', $_POST['b_i_to']));
			// Envío del formulario
			if (wp_mail($var_to, $var_subject, $var_message, $var_headers, $attachments)) {
				$wpdb->insert($var_table, $var_data);
				setlocale(LC_ALL, $var_locale);

				// Correo de respuesta
				if ((isset($_POST['b_i_response']) && $_POST['b_i_response'] == 'true') && (isset($_POST['b_i_reply']) && $_POST['b_i_reply'] != '')) {
					if (b_f_option('b_opt_response-email-'.$b_g_language) != '') {
						$var_message = b_f_option('b_opt_response-email-'.$b_g_language);
					} else {
						$var_message = __('Your message has been sucesfully sent.<br /><br />Here is a copy of your message.', 'bilnea');
					}
					$var_message .= '<hr />';
					foreach ($var_temp as $key => $value) {
						$var_message .= '<strong>'.$key.'</strong>: '.$value.'<br />';
					}
					$var_message .= '<hr />'.__('Please do not respond directly to this e-mail. The inbox of this account is disabled.', 'bilnea');
					$var_headers = 'From: '.get_bloginfo('name').' <noreply@'.$_SERVER['SERVER_NAME'].'>'."\r\n";
					$var_headers .= 'Content-Type: text/html; charset=UTF-8';
					wp_mail($_POST['b_i_reply'], __('Here is a copy of your message to', 'bilnea').' '.get_bloginfo('name'), $var_message, $var_headers);
				}
				
				if (isset($_POST['b_i_redirect']) && $_POST['b_i_redirect'] != '') {
					echo '<script>window.location.href = "'.b_f_i_encrypt_decrypt('decrypt', $_POST['b_i_redirect']).'";</script><div class="sent-ok redirecting">'.__('Message sent sucesfully. Please wait a moment.', 'bilnea').'</div>';
				} else {
					echo '<div class="sent-ok">'.rtrim(b_f_i_encrypt_decrypt('decrypt', $_POST['b_i_sucess']), "\0").'</div>';
				}
			} else {
				$var_data['status'] = 'error';
				$wpdb->insert($var_table, $var_data);
				setlocale(LC_ALL, $var_locale);
				echo '<div class="sent-error">'.__('Sorry, an error has ocurred sending your message. Please try again later.', 'bilnea').'</div>';
			}
			wp_die();
		} else {
			die('No bots!');
		}
	}
	 
	add_action('wp_ajax_b_send_form','b_a_send_form');
	add_action('wp_ajax_nopriv_b_send_form','b_a_send_form');

}

?>