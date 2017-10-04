<?php

if (!function_exists('site_url')) {
	$uri = explode('wp-content',$_SERVER['SCRIPT_FILENAME']);
	require($uri[0].'wp-load.php');
	wp();
}

$shortcode = urldecode($_POST['shortcode']);

print_r(do_shortcode($shortcode));

?>