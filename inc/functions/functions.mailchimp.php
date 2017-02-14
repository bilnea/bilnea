<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


// Estado de suscripción

if (!function_exists('b_f_i_mailchimp_member_status')) {
	
	function b_f_i_mailchimp_member_status($var_email, $var_status, $var_list, $var_api_key, $var_request = 'PUT', $var_fields = null) {

		$var_data = array(
			'apikey' => $var_api_key,
			'email_address' => $var_email,
			'status' => $var_status,
			'merge_fields' => $var_fields
		);

		$var_init = curl_init();
	 
		curl_setopt($var_init, CURLOPT_URL, 'https://'.substr($var_api_key,strpos($var_api_key,'-')+1).'.api.mailchimp.com/3.0/lists/'.$var_list.'/members/'.md5(strtolower($var_data['email_address'])));
		curl_setopt($var_init, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Basic '.base64_encode( 'user:'.$var_api_key )));
		curl_setopt($var_init, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
		curl_setopt($var_init, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($var_init, CURLOPT_CUSTOMREQUEST, $var_request);
		curl_setopt($var_init, CURLOPT_TIMEOUT, 10);
		curl_setopt($var_init, CURLOPT_POST, true);
		curl_setopt($var_init, CURLOPT_SSL_VERIFYPEER, false);
		if ($var_request == 'PUT') {
			curl_setopt($var_init, CURLOPT_POSTFIELDS, json_encode($var_data));
		}
	 
		return curl_exec($var_init);
	}

}


// Conexión a Mailchimp

if (!function_exists('b_f_i_mailchimp')) {
	
	function b_f_i_mailchimp($var_url, $var_request_type, $var_api_key, $var_data = array()) {

		if ($var_request_type == 'GET') {
			$var_url .= '?'.http_build_query($var_data);
		}
		
		$var_init = curl_init();
		$var_headers = array(
			'Content-Type: application/json',
			'Authorization: Basic '.base64_encode('user:'.$var_api_key)
		);
		
		curl_setopt($var_init, CURLOPT_URL, $var_url);
		curl_setopt($var_init, CURLOPT_HTTPHEADER, $var_headers);
		curl_setopt($var_init, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($var_init, CURLOPT_CUSTOMREQUEST, $var_request_type);
		curl_setopt($var_init, CURLOPT_TIMEOUT, 10);
		curl_setopt($var_init, CURLOPT_SSL_VERIFYPEER, false);
			
		if ($var_request_type != 'GET') {
			curl_setopt($var_init, CURLOPT_POST, true);
			curl_setopt($var_init, CURLOPT_POSTFIELDS, json_encode($var_data));
		}	 
		
		return curl_exec($var_init);

	}

}

?>