<?php
session_start();

foreach ($_POST as $key => $value) {
	${$key} = $value;
}
$cp = $_SESSION['key-'.$cid];
$to = $_SESSION['mail-'.$eid];
$result = $_SESSION['mens-'.$eid];
$subject = 'Nueva consulta web:';
$txt  = '¡Hola!'."\r\n";
$txt .= "\r\n";
$txt .= 'Se acaba de enviar una consulta a través del formulario web de '.$_SESSION['blogname'].'. Aquí tienes los datos de la consulta:'."\r\n";
if (isset($apellidos)) {
	$nombre = $nombre.' '.$apellidos;
}
$txt .= 'Nombre: '.$nombre."\r\n";
$txt .= 'Correo electrónico: '.$email."\r\n";
$txt .= 'Asunto: '.$asunto."\r\n";
$txt .= 'Mensaje:'."\r\n";
$txt .= htmlspecialchars($mensaje)."\r\n";
$txt .= "\r\n";
$txt .= 'Consulta realizada el '.date('d/m/Y').' a las '.date('H:m').'. Dirección IP:'.$ip;
$headers = 'Content-Type: text/plain; charset=UTF-8'."\r\n";
$headers .= 'From: "'.$nombre.'" <'.$email.'>';

$tty = '';

if ($cp != '' && md5(implode('', $_POST['captcha'])) != $cp) {
	$tty .= '<script type="text/javascript">'."\r\n";
	$tty .= '	jQuery(function() {'."\r\n";
	$tty .= '		jQuery(\'[data-id="'.$cid.'"] input.captcha\').addClass(\'invalido\');'."\r\n";
	$tty .= '	});'."\r\n";
	$tty .= '	jQuery(\'.obligatorio.invalido\').on(\'click focus\', function() {'."\r\n";
	$tty .= '		jQuery(this).removeClass(\'invalido\');'."\r\n";
	$tty .= '	});'."\r\n";
	$tty .= '</script>'."\r\n";
} else {
	if (@mail($to,$subject,$txt,$headers))	{
		$tty .= '<div>'.$result.'</div>'."\r\n";
		$tty .= '<script type="text/javascript">'."\r\n";
		$tty .= '	jQuery(function() {'."\r\n";
		$tty .= '		jQuery(\'[data-id="'.$eid.'"]\')[0].reset();'."\r\n";
		$tty .= '	});'."\r\n";
		$tty .= '</script>'."\r\n";
	} else {
		$tty .= '<div>Ha ocurrido un error. Por favor, inténtalo de nuevo pasados unos minutos.</div>'."\r\n";
	}
}

echo $tty;

$tom = '';
$to = $email;
$subject = $_SESSION['blogname'].'. Consulta recibida';

if (date('H') < 6) {
	$tom = 'Buenas noches';
}
if (date('H') >= 6 && date('H') < 13) {
	$tom = 'Buenos días';
}
if (date('H') >= 13 && date('H') < 21) {
	$tom = 'Buenas tardes';
}
if (date('H') >= 21) {
	$tom = 'Buenas noches';
}

$txt = $tom.':'."\r\n";
$txt .= "\r\n";
$txt .= 'Su consulta ha sido recibida correctamente. Le contestaremos a la mayor brevedad.'."\r\n";
$txt .= "\r\n";
$txt .= 'A continuación le adjuntamos una copia de su mensaje.'."\r\n";
$txt .= "\r\n";
$txt .= "\r\n";
$txt .= 'Nombre: '.$nombre."\r\n";
if (isset($apellidos)) {
	$nombre = $nombre.' '.$apellidos;
}
$txt .= 'Correo electrónico: '.$email."\r\n";
$txt .= 'Asunto: '.$asunto."\r\n";
$txt .= 'Mensaje:'."\r\n";
$txt .= htmlspecialchars($mensaje)."\r\n";
$txt .= "\r\n";
$txt .= 'Este correo electrónico se ha generado automáticamente. Por favor, no conteste al mismo. El buzón desde donde se envía no tiene habilitada la recepción de mensajes.'."\r\n";
$txt .= "\r\n";
$txt .= $_SESSION['blogname']."\r\n";
$txt .= $_SESSION['siteurl']."\r\n";
$headers = 'Content-Type: text/plain; charset=UTF-8'."\r\n";
$headers .= 'From: "'.$_SESSION['blogname'].'" <noreply@'.$_SERVER['SERVER_NAME'].'.com>';

@mail($to,$subject,$txt,$headers);

?>