<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


// Barras laterales

if (!function_exists('b_f_sidebar')) {
	
	function b_f_sidebar() {
		register_sidebar(
			array(
				'id' => 'sidebar',
				'name' => 'Barra lateral',
				'description' => 'Barra lateral del sitio',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h4 class="side-title">',
				'after_title' => '</h4>',
				'empty_title'=> '',	
			)
		);
		register_sidebar(
			array(
				'id' => 'sidebar_page',
				'name' => 'Barra lateral página',
				'description' => 'Barra lateral de página',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h4 class="side-title">',
				'after_title' => '</h4>',
				'empty_title'=> '',	
			)
		);
		register_sidebar(
			array(
				'id' => 'sidebar_blog',
				'name' => 'Barra lateral blog',
				'description' => 'Barra lateral del blog',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h4 class="side-title">',
				'after_title' => '</h4>',
				'empty_title'=> '',	
			)
		);
		register_sidebar(
			array(
				'id' => 'sidebar_alter1',
				'name' => 'Barra lateral alternativa #1',
				'description' => 'Barra lateral alternativa',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h4 class="side-title">',
				'after_title' => '</h4>',
				'empty_title'=> '',	
			)
		);
		register_sidebar(
			array(
				'id' => 'sidebar_alter2',
				'name' => 'Barra lateral alternativa #2',
				'description' => 'Barra lateral alternativa',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h4 class="side-title">',
				'after_title' => '</h4>',
				'empty_title'=> '',	
			)
		);
		$var_ordinals = ['Primera', 'Segunda', 'Tercera', 'Cuarta', 'Quinta', 'Sexta', 'Séptima', 'Octava', 'Novena', 'Décima', 'Undécima', 'Duodécima', 'Decimotercera', 'Decimocuarta', 'Decimoquinta', 'Decimosexta', 'Decimoséptima', 'Decimoctava', 'Decimonovena', 'Vigésima'];
		for ($i=0; $i < b_f_option('b_opt_footer-menu'); $i++) { 
			register_sidebar(
				array(
					'id' => 'footer_'.($i+1),
					'name' => 'Footer #'.($i+1),
					'description' => $var_ordinals[$i].' columna del pie de página',
					'before_title' => '<h4 class="footer-title">',
					'after_title' => '</h4>',
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget' => '</div>',
					'empty_title'=> '',	
				)
			);
		}
	} 

	add_action( 'widgets_init', 'b_f_sidebar' );

}

?>