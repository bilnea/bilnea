<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


// Menús de navegación

register_nav_menus(array('menu_main' 	=> 'Menú principal'));
register_nav_menus(array('menu_footer'	=> 'Barra inferior'));
register_nav_menus(array('menu_top' 	=> 'Barra superior'));
register_nav_menus(array('menu_mobile' 	=> 'Menú móvil'));
register_nav_menus(array('menu_widget' 	=> 'Menú widget'));

?>