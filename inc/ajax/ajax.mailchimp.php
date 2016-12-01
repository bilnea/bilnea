<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


// Suscripción a Mailchimp

function b_f_a_mailchimp_subscribe(){

	//Variables globales
	global $b_g_language;

	$list_id = b_f_option('b_opt_newsl_list-'.$b_g_language);
	$api_key = b_f_option('b_opt_newsl_api');

	(isset($_POST['s_last'])) ? $var_last = $_POST['s_last'] : $var_last = '';

	$result = json_decode( b_f_i_mailchimp_member_status($_POST['s_email'], 'subscribed', $list_id, $api_key, 'PUT', array('FNAME' => $_POST['s_name'],'LNAME' => $var_last) ) );

	if (!isset($_POST['action']) && $_POST['action'] != 'b_mailchimpsubscribe') {
		die('No bots!');
	}

	if( $result->status == 400 ){
		foreach( $result->errors as $error ) {
			echo '<p>Error: ' . $error->message . '</p>';
		}
	} elseif( $result->status == 'subscribed' ){
		echo '<script>window.location.href = "'.get_permalink($_POST['s_redirect']).'";</script>';
	}
	die;
}
 
add_action('wp_ajax_b_mailchimpsubscribe','b_f_a_mailchimp_subscribe');
add_action('wp_ajax_nopriv_b_mailchimpsubscribe','b_f_a_mailchimp_subscribe');

?>