<?php

if (!function_exists('site_url')) {
	$uri = explode('wp-content',$_SERVER['SCRIPT_FILENAME']);
	require($uri[0].'wp-load.php');
	wp();
}

$video = urldecode($_GET['v']);

$image = '';

if (isset($_GET['i'])) {
	$image = ' poster='.urldecode($_GET['i']);
}

print_r(do_shortcode('[video src="'.$video.'" autoplay="on"'.$image.']'));

?>