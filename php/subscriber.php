<?php

if (!function_exists('site_url')) {
	$uri = explode('wp-content',$_SERVER['SCRIPT_FILENAME']);
	require($uri[0].'wp-load.php');
}

function b_locale($locale) {
	if (isset($_GET['l'])) {
		return sanitize_key($_GET['l']);
	} else {
		return 'es':
	}
	return $locale;
}

add_filter('locale', 'b_locale');

if (isset($_GET['action']) && $_GET['action'] == 'add') {
	if (!empty($_POST) && $_POST['s_email'] != '') {
		global $wpdb;
		$table = $wpdb->prefix.'subscribers';
		$data = array(
			'name' => $_POST['s_name'],
			'last_name' => $_POST['s_last'],
			'email' => $_POST['s_email'],
			'date' => date('Y-m-d'),
			'active' => 0,
			'hash' => md5('bilneador'.$_POST['s_email'])
		);

		$success = $wpdb->insert($table, $data);

		if ($success) {
			echo sprintf(esc_html__('An email message has been sent to %s.Please confirm your email address to complete your subscription.', 'bilnea'), $_POST['s_email']);
			
			$body = __('Please confirm your newsletter subscription by visiting the link below:', 'bilnea')."\n";
			$body .= ''."\n";
			$body .= __('If you have registered for a subscription accidentally or the newsletter was not ordered in your name, please ignore this email.', 'bilnea')."\n";
			$body .= get_option('blogname')."\n";
			$body .= get_site_url();

			wp_mail($_POST['s_email'], __('Thanks for subscribing', 'bilnea'), $body);
		}
	}
}

?>