<?php

if (!function_exists('site_url')) {
	$uri = explode('wp-content',$_SERVER['SCRIPT_FILENAME']);
	require($uri[0].'wp-load.php');
	wp();
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Página no encontrada | <?= get_bloginfo('name') ?></title>
		<meta name="robots" content="noindex">
		<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
	</head>
	<style type="text/css">
		html, body {
			margin: 0;
			padding: 0;
		}
		body {
			padding: 40px 0;
			text-align: center;
		}
		html {
			background-color: #fafafa;
		}
		img {
			max-width: 400px;
		}
		h2 {
			font-family: 'Montserrat';
			font-size: 60px;
			margin: 0;
		}
		h1 {
			font-family: 'Open Sans';
			font-size: 24px;
			max-width: 400px;
			margin: 10px auto;
		}
		a {
			background-color: #004D71;
			padding: 10px 20px;
			color: white;
			text-decoration: none;
			display: inline-block;
			margin-top: 30px;
			font-family: 'Montserrat';
			font-size: 22px;
		}
	</style>
	<body>
		<img src="<?= get_template_directory_uri() ?>/img/bilneador.png" />
		<h2>Oops...</h2>
		<h1>El recurso solicitado no existe, pero puedes ir a la página principal</h1>
		<a href="<?= site_url() ?>"><?= str_replace('http://', '', site_url()) ?></a>
	</body>
</html>