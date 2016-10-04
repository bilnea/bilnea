<?php

$wordfence = 'wfvt_XXXXXX';
foreach ($_COOKIE as $name => $content) {
	if (strpos($name, 'wfvt_') === 0) {
		$wordfence = $name;
	}
}

$cookies_list = array(
	'PHPSESSID' => array(
		'',
		'',
		'Usada por el lenguaje de programación PHP, crea una sesión de navegación única que almacena las variables de la sesión. Caduca al finalizar la navegación por el sitio web.'
	),
	$wordfence => array(
		'WordFence',
		'https://www.wordfence.com/terms-of-use-and-privacy-policy/',
		'Cookie usada para garantizar la seguridad del sitio web y evitar accesos no deseados. Recopila información de los visitantes y bloquea el acceso de aquellos que puedan comprometer la estabilidad y seguridad del sitio web.'
	)
);

?>