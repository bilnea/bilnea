<?php

if (!function_exists('site_url')) {
	$uri = explode('wp-content',$_SERVER['SCRIPT_FILENAME']);
	require($uri[0].'wp-load.php');
	wp();
}

?>

<!DOCTYPE html>

<html <?php language_attributes(); ?>>
<html>
	<head>
		<title>404 | <?= get_bloginfo('name') ?></title>
		<meta name="robots" content="noindex">
		<?php wp_head(); ?>
	</head>
	<body>
		<?php

		global $b_g_language;

		echo b_f_shortcode(do_shortcode('[b_elementor id="'.b_f_option('b_opt_widget-404-'.$b_g_language).'"]'));

		wp_footer();

		?>
	</body>
</html>