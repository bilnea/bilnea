<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

define('WP_USE_THEMES', false);

$var_root = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);

require_once($var_root[0].'wp-load.php' );
global $post;
print_r($_SESSION);

function crunchify_print_scripts_styles() {
    // Print all loaded Scripts
    global $wp_scripts;
    foreach( $wp_scripts->queue as $script ) :
        echo $script . '  **  ';
    endforeach;
 
    // Print all loaded Styles (CSS)
    global $wp_styles;
    foreach( $wp_styles->queue as $style ) :
        echo $style . '  ||  ';
    endforeach;
}
 
add_action( 'wp_print_scripts', 'crunchify_print_scripts_styles' );


?>