<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


// Cambiar el directorio de subida de archivos

if (!function_exists('b_f_i_change_upload_dir')) {

	function b_f_i_change_upload_dir($var_dir) {

		// Variables globales
		global $b_g_uniqid;

		return array(
			'path'  => $var_dir['basedir'].'/mail/'.$b_g_uniqid,
			'url' => $var_dir['baseurl'].'/mail/'.$b_g_uniqid,
			'subdir' => '/mail/'.$b_g_uniqid,
		)+$var_dir;

	}

}


// Eliminación de directorio y archivos

if (!function_exists('b_f_i_rmdir')) {
	
	function b_f_i_rmdir($var_dir) {

		if (!is_dir($var_dir)) {
			throw new InvalidArgumentException('$var_dir must be a directory');
		}

		if (substr($var_dir, strlen($var_dir) - 1, 1) != '/') {
			$var_dir .= '/';
		}

		$files = glob($var_dir . '*', GLOB_MARK);

		foreach ($files as $file) {
			if (is_dir($file)) {
				self::deleteDir($file);
			} else {
				unlink($file);
			}
		}

		rmdir($var_dir);

	}

}

?>