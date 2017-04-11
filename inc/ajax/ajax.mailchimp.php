<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


// Suscripción a Mailchimp

function b_f_a_mailchimp_subscribe(){

	//Variables globales
	global $b_g_language;

	// Variables locales
	$list_id = b_f_option('b_opt_newsl_list-'.$b_g_language);
	$api_key = b_f_option('b_opt_newsl_api');
	(isset($_POST['s_name'])) ? $var_name = $_POST['s_name'] : $var_name = '';
	(isset($_POST['s_last'])) ? $var_last = $_POST['s_last'] : $var_last = '';
	if (isset($_POST['s_redirect'])) {
		if (is_numeric($_POST['s_redirect'])) {
			$var_redirect = '<script>window.location.href = "'.get_permalink($_POST['s_redirect']).'";</script>';
		} else if (strpos($_POST['s_redirect'], 'list-manage') !== false) {
			$var_random = rand();
			$var_redirect = '<form style="display: none;" id="b_news-'.$var_random.'" action="'.$_POST['s_redirect'].'" method="post">';
			$var_redirect .= '<input type="hidden" name="FNAME" value="'.$var_name.'" />';
			$var_redirect .= '<input type="hidden" name="LNAME" value="'.$var_last.'" />';
			$var_redirect .= '<input type="hidden" name="EMAIL" value="'.$_POST['s_email'].'" />';
			$var_redirect .= '</form>';
			$var_redirect .= '<script type="text/javascript">document.getElementById(\'b_news-'.$var_random.'\').submit();</script>';
		} else {
			$var_redirect = '<script>window.location.href = "'.$_POST['s_redirect'].'";</script>';
		}
	} else {
		$var_redirect = '';
	}
	
	if (b_f_option('b_opt_double_opt_in') == 1 && !isset($_POST['s_delete'])) {
		$result = json_decode(b_f_i_mailchimp_member_status($_POST['s_email'], 'pending', $list_id, $api_key, 'GET', array('FNAME' => $var_name,'LNAME' => $var_last)));
		if ($result->status == 'subscribed') {
			echo __('You are already subscribed to our newsletter', 'bilnea');
			die();
		} elseif ($result->status == 'pending') {
			json_decode(b_f_i_mailchimp_member_status($_POST['s_email'], 'pending', $list_id, $api_key, 'DELETE', array('FNAME' => $var_name,'LNAME' => $var_last)));
			$result = json_decode(b_f_i_mailchimp_member_status($_POST['s_email'], 'pending', $list_id, $api_key, 'PUT', array('FNAME' => $var_name,'LNAME' => $var_last)));
		} else {
			$result = json_decode(b_f_i_mailchimp_member_status($_POST['s_email'], 'pending', $list_id, $api_key, 'PUT', array('FNAME' => $var_name,'LNAME' => $var_last)));
		}
	} else {
		$result = json_decode(b_f_i_mailchimp_member_status($_POST['s_email'], 'subscribed', $list_id, $api_key, 'PUT', array('FNAME' => $var_name,'LNAME' => $var_last)));
	}

	if (!isset($_POST['action']) && $_POST['action'] != 'b_mailchimpsubscribe') {
		die('No bots!');
	}

	if (isset($_POST['s_delete']) && $_POST['s_delete'] == 1) {
		$result = json_decode(b_f_i_mailchimp_member_status($_POST['s_email'], 'cleaned', $list_id, $api_key, 'PUT', array('FNAME' => $var_name,'LNAME' => $var_last)));
	}

	if( $result->status == 400 ) {
		foreach($result->errors as $error) {
			echo '<p>Error: '.$error->message.'</p>';
		}
	} elseif ($result->status == 'subscribed') {
		if ($var_redirect != '') {
			echo __('You\'re subscribed. Please, wait a moment.', 'bilnea').$var_redirect;
		} else {
			echo __('You\'ve been subscribed to our newsletter succesfully.', 'bilnea');
		}
	} elseif ($result->status == 'pending') {
		if ($var_redirect != '') {
			echo __('You\'re subscribed. Please, wait a moment.', 'bilnea').$var_redirect;
		} else {
			echo __('You\'re subscribed. Shortly, you will be e-mailed with a request to confirm your membership. Please make sure to click the link in that message to confirm your subscription.', 'bilnea').'<div id="b_pointer"></div><script>jQuery(function() { jQuery(\'#pointer\').closest(\'.response\').prev().find(jQuery(\'input.input\')).val(\'\'); });</script>';
		}
	} elseif ($result->status == 'cleaned') {
		echo __('You\'ve been unsubscribed from our newsletter sucesfully. We\'re sorry to see you go.', 'bilnea').'<div id="b_pointer"></div><script>jQuery(function() { jQuery(\'#pointer\').closest(\'.response\').prev().find(jQuery(\'input.input\')).val(\'\'); });</script>';
	} else {
		echo $result->status;
	}
	die();
}
 
add_action('wp_ajax_b_mailchimpsubscribe','b_f_a_mailchimp_subscribe');
add_action('wp_ajax_nopriv_b_mailchimpsubscribe','b_f_a_mailchimp_subscribe');

?>