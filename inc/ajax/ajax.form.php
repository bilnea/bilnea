<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


// Envío de formulario

if (!function_exists('b_a_send_form')) {

	function b_a_send_form(){

		// Variables globales
		global $wpdb;

		// Comprobación variables
		if (isset($_POST['eid']) && $_POST['eid'] != '' && isset($_POST['cid']) && $_POST['cid'] != '' && isset($_POST['action']) && $_POST['action'] == 'b_send_form') {

			// Variables globales
			global $b_g_hash;

			// Variables locales
			$var_name = get_bloginfo('name');
			if (isset($_POST['b_i_name']) && $_POST['b_i_name'] != '') {
				$var_name = ucfirst($_POST['b_i_name']);
			}
			if (isset($_POST['b_i_last-name']) && $_POST['b_i_last-name'] != '') {
				$var_name .= ' '.ucfirst($_POST['b_i_last-name']);
			}
			(isset($_POST['b_i_form-name']) && $_POST['b_i_form-name'] != '') ? $var_form_name = $_POST['b_i_form-name'].' ' : $var_form_name = '';
			$var_to = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($b_g_hash), base64_decode($_POST['b_i_to']), MCRYPT_MODE_CBC, md5(md5($b_g_hash))), "\0");
			$var_headers = 'From: '.$var_name.' <noreply@'.$_SERVER['SERVER_NAME'].'>'."\r\n";
			$var_headers .= 'Reply-to: '.$var_name.' <'.((isset($_POST['b_i_email']) && $_POST['b_i_email'] != '') ? $_POST['b_i_email'] : 'noreply@'.$_SERVER['SERVER_NAME']).'>'."\r\n";
			$var_headers .= 'Content-Type: text/html; charset=UTF-8';

			// Preparación de datos
			$var_table = $wpdb->prefix.'forms_users';
			$var_temp = array();
			if (isset($_POST['b_i_name']) && $_POST['b_i_name'] != '') {
				$var_temp['name'] = $_POST['b_i_name'];
			}
			if (isset($_POST['b_i_last-name']) && $_POST['b_i_last-name'] != '') {
				$var_temp['last name'] = $_POST['b_i_last-name'];
			}
			foreach ($_POST as $key => $value) {
				if (substr($key, 0, 10) == 'b_i_custom') {
					$var_temp[str_replace('b_i_custom_', '', $key)] = $value;
				}
			}
			if (isset($_POST['b_i_message']) && $_POST['b_i_message'] != '') {
				$var_temp['message'] = $_POST['b_i_message'];
			}
			$var_data = array(
				'data' => serialize($var_temp),
				'date' => date('Y-m-d H:i:s'),
				'email' => ((isset($_POST['b_i_email']) && $_POST['b_i_email'] != '') ? $_POST['b_i_email'] : 'Sin correo electrónico'),
				'formname' => rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($b_g_hash), base64_decode($_POST['b_i_formname']), MCRYPT_MODE_CBC, md5(md5($b_g_hash))), "\0"),
				'ip' => $_POST['b_i_ip'],
				'page' => rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($b_g_hash), base64_decode($_POST['b_i_page']), MCRYPT_MODE_CBC, md5(md5($b_g_hash))), "\0"),
				'status' => 'sent'
			);

			// Correo electrónico
			$var_message = '<div style="font-family: Arial, Helvetica;"><a href="'.get_home_url().'"><h3>'.get_bloginfo('name').'</h3></a><hr />';
			$var_message .= 'Se ha enviado un mensaje a través del formulario web '.$var_form_name.'de '.get_bloginfo('name').'.<hr />';
			foreach ($var_temp as $key => $value) {
				$var_message .= '<strong>'.ucfirst($key).'</strong>: '.$value.'<br />';
			}
			$var_message .= '<hr />Mensaje enviado el '.date('j/n/Y').' a las '.date('G:i').' desde la dirección IP '.$_POST['b_i_ip'].'.</div>';
			$var_subject = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($b_g_hash), base64_decode($_POST['b_i_subject']), MCRYPT_MODE_CBC, md5(md5($b_g_hash))), "\0");

			// Cambio de idioma
			$var_locale = setlocale(LC_ALL, 0);
			setlocale(LC_ALL, 'es_ES');

			// Configuración SMTP
			function b_f_smtp_server(PHPMailer $var_smtp) {
				$var_smtp->Host = b_f_option('b_opt_smtp-server');
				$var_smtp->Port = b_f_option('b_opt_smtp-port');
				$var_smtp->Username = b_f_option('b_opt_smtp-user');
				$var_smtp->Password = b_f_option('b_opt_smtp-pass');
				if (b_f_option('b_opt_smtp-auth') == 1) {
					$var_smtp->SMTPAuth = true;
				}
				if (b_f_option('b_opt_smtp-secure') == 1 && b_f_option('b_opt_smtp-protocol') == 'ssl') {
					$phpmailer->SMTPSecure = 'ssl';
				}
				if (b_f_option('b_opt_smtp-secure') == 1 && b_f_option('b_opt_smtp-protocol') == 'tls') {
					$phpmailer->SMTPSecure = 'tls';
				}
			    $phpmailer->IsSMTP();
			}
			if (b_f_option('b_opt_smtp') == 1) {
				add_action('phpmailer_init', 'b_f_smtp_server');
			}

			// Envío del formulario
			if (wp_mail($var_to, $var_subject, $var_message, $var_headers)) {
				$wpdb->insert($var_table, $var_data);
				setlocale(LC_ALL, $var_locale);
				echo rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($b_g_hash), base64_decode($_POST['b_i_sucess']), MCRYPT_MODE_CBC, md5(md5($b_g_hash))), "\0");
				echo '<script>window.location.href = "'.get_permalink(rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($b_g_hash), base64_decode($_POST['b_i_redirect']), MCRYPT_MODE_CBC, md5(md5($b_g_hash))), "\0")).'";</script>';

			} else {
				$var_data['status'] = 'error';
				$wpdb->insert($var_table, $var_data);
				setlocale(LC_ALL, $var_locale);
				echo __('Sorry, an error has ocurred sending your message. Please try again later.', 'bilnea');
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