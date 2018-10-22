<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


// Preparación scripts

if (!function_exists('b_f_load_scripts')) {

	function b_f_load_scripts() {

		// Scripts del tema
		wp_register_script('functions.main', get_template_directory_uri().'/js/internal/functions.main.js', array('jquery'), b_f_versions(), true);
		wp_register_script('functions.anchor', get_template_directory_uri().'/js/internal/functions.anchor.js', array('jquery'), b_f_versions(), true);
		wp_register_script('functions.accordion', get_template_directory_uri().'/js/internal/functions.accordion.js', array('jquery'), b_f_versions(), true);
		wp_register_script('functions.design.parallax', get_template_directory_uri().'/js/internal/functions.design.parallax.js', array('jquery'), b_f_versions(), true);
		wp_register_script('functions.design.menu', get_template_directory_uri().'/js/internal/functions.design.menu.js', array('jquery'), b_f_versions(), true);
		wp_register_script('functions.admin', get_template_directory_uri().'/js/internal/functions.admin.js', array(), b_f_versions(), true);

		// Scripts del tema hijo
		wp_register_script('functions.child.main', get_stylesheet_directory_uri().'/js/main.js', array('jquery'), b_f_versions(), true);
		wp_register_script('functions.child.admin', get_stylesheet_directory_uri().'/js/admin.js', array('jquery', 'functions.admin'), b_f_versions(), true);

		// jQuery UI
		wp_register_script('functions.core.jquery.ui', get_template_directory_uri().'/js/external/functions.core.jquery.ui.js', array('jquery'), b_f_versions('jquery-ui'), true);

		// Select2
		wp_register_script('functions.design.select2', get_template_directory_uri().'/js/external/functions.design.select2.js', array('jquery'), b_f_versions('select2'), true);

		// Flipclock
		wp_register_script('functions.counter.flipclock', get_template_directory_uri().'/js/external/functions.counter.flipclock.js', array('jquery'), b_f_versions('flipclock'), true);

		// CounterUP
		wp_register_script('functions.counter.countup', get_template_directory_uri().'/js/external/functions.counter.countup.js', array('jquery'), b_f_versions('countup'), true);

		// Fitvids
		wp_register_script('functions.design.fitvids', get_template_directory_uri().'/js/external/functions.design.fitvids.js', array('jquery'), b_f_versions('fitvids'), true);

		// Query object
		wp_register_script('functions.core.jquery.queryobject', get_template_directory_uri().'/js/external/functions.core.jquery.queryobject.js', array('jquery'), b_f_versions('query-object'), true);

		// Anticopia
		wp_register_script('functions.anticopy', get_template_directory_uri().'/js/internal/functions.anticopy.js', array(), b_f_versions(), true);

		wp_register_script('functions.design.magnificpopup.internal', get_template_directory_uri().'/js/internal/functions.design.magnificpopup.js', array('functions.design.magnificpopup'), b_f_versions('magnific-popup'), false);

		// Animación de colores
		wp_register_script('functions.design.animatecolors', get_template_directory_uri().'/js/external/functions.design.animatecolors.js', array('jquery'), b_f_versions('animate-colors'), true);

		// Wow!
		wp_register_script('functions.design.wow', get_template_directory_uri().'/js/external/functions.design.wow.js', array('jquery'), b_f_versions('wow'), true);

		// Hyphenator
		wp_register_script('functions.design.hyphenator', get_template_directory_uri().'/js/external/functions.design.hyphenator.js', array('jquery'), b_f_versions('hyphenator'), true);

		// jQuery UI Mobile
		wp_register_script('functions.core.jquery.mobile', get_template_directory_uri().'/js/external/functions.core.jquery.mobile.js', array('bilnea'), b_f_versions('jquery-ui-mobile'), true);

		// Spectrum
		wp_register_script('functions.functionality.spectrum', get_template_directory_uri().'/js/external/functions.functionality.spectrum.js', array('jquery'), b_f_versions('spectrum'), true);

		// responsiveCarousel.JS
		wp_register_script('functions.carousel', get_template_directory_uri().'/js/external/functions.media.responsivecarousel.js', array('jquery'), b_f_versions('responsivecarousel'), false);

		// AjaxSubmit
		wp_register_script('functions.ajaxform', get_template_directory_uri().'/js/external/functions.form.ajaxform.js', array('jquery'), b_f_versions('ajaxform'), false);

		// Vide
		wp_register_script('functions.media.vide', get_template_directory_uri().'/js/external/functions.media.vide.js', array('jquery'), b_f_versions('vide'), false);

		// Mapbox
		wp_register_script('functions.maps.mapbox', get_template_directory_uri().'/js/external/functions.maps.mapbox.js', array('jquery'), b_f_versions('mapbox'), false);
		$temp = array(
			'token' => 'pk.eyJ1Ijoic2FtdWVsY2VyZXpvIiwiYSI6ImNqbW1jcDFuaTA1N2IzcW96eWZkOTN1a2gifQ.RWw5OA7GydKti0XEfL-kHQ'
		);
		wp_localize_script('functions.maps.mapbox', 'mapbox', $temp);

	}

}


// Carga scripts frontend

if (!function_exists('b_f_frontend_scripts')) {

	function b_f_frontend_scripts() {

		// Variables globales
		global $post;

		// Variables locales
		$log = 'Scripts loaded:\n';

		// Carga scripts
		b_f_load_scripts();

		$temp = array(
			'version' => b_f_versions(),
			'site_url' => site_url(),
			'post_id' => $post->ID
		);
		wp_localize_script('functions.main', 'bilnea', $temp);
		wp_enqueue_script('functions.main');
		wp_enqueue_script('functions.anchor');
		wp_enqueue_script('functions.child.main');
		wp_enqueue_script('functions.design.parallax');

		wp_enqueue_script('functions.design.fitvids');
		$log .= 'Fitvids '.b_f_versions('fitvids').'\n';

		wp_enqueue_script('functions.core.jquery.queryobject');
		$log .= 'Query Object '.b_f_versions('query-object').'\n';

		wp_enqueue_script('functions.design.animatecolors');
		$log .= 'Animated Colors '.b_f_versions('animate-colors').'\n';

		wp_enqueue_script('functions.media.vide');
		$log .= 'Vide '.b_f_versions('vide').'\n';

		if (b_f_option('b_opt_anticopy') == 1) {
			wp_enqueue_script('functions.anticopy');
		}

		if (b_f_option('b_opt_sticky-menu-animated') == 1) {
			$temp = array(
				'responsive' => b_f_option('b_opt_responsive')
			);
			wp_localize_script('functions.design.menu', 'menu', $temp);
			wp_enqueue_script('functions.design.menu');
		}

		if (b_f_option('b_opt_hyphenator') == 1) {
			$temp = array(
				'selector' => b_f_option('b_opt_hyphenator-selector', true)
			);
			wp_localize_script('functions.design.hyphenator', 'hyphenator', $temp);
			wp_enqueue_script('functions.design.hyphenator');
			$log .= 'Hyphenator '.b_f_versions('hyphenator').'\n';
		}

		if (b_f_option('b_opt_jquery-ui') == 1) {
			wp_enqueue_script('functions.core.jquery.ui');
			$log .= 'jQuery UI '.b_f_versions('jquery-ui').'\n';
		}

		if (b_f_option('b_opt_select2') == 1) {
			wp_enqueue_script('functions.design.select2');
			$log .= 'Select2 '.b_f_versions('select2').'\n';
		}

		if (b_f_option('b_opt_jquery-mobile') == 1) {
			wp_enqueue_script('functions.core.jquery.mobile');
			$log .= 'jQuery UI Mobile '.b_f_versions('jquery-ui-mobile').'\n';
		}

		// Scripts específicos de la página
		if (isset($post) && file_exists(get_stylesheet_directory().'/js/'.$post->post_type.'-'.$post->ID.'.js')) {
			wp_enqueue_script($post->post_type.'-'.$post->ID.'-js', get_stylesheet_directory_uri().'/js/'.$post->post_type.'-'.$post->ID.'.js', array('jquery', 'functions.child.main'), b_f_versions(), true );
		}

		if (is_home() && file_exists(get_stylesheet_directory().'/js/blog.js')) {
			wp_enqueue_script('bilnea.blog-js', get_stylesheet_directory_uri().'/js/blog.js', array('jquery', 'functions.child.main'), b_f_versions(), true );
		}

		if (is_front_page() && file_exists(get_stylesheet_directory().'/js/home.js')) {
			wp_enqueue_script('bilnea.home-js', get_stylesheet_directory_uri().'/js/home.js', array('jquery', 'functions.child.main'), b_f_versions(), true );
		}

		if (is_single() && file_exists(get_stylesheet_directory().'/js/single-'.$post->post_type.'.js')) {
			wp_enqueue_script($post->post_type.'-'.$post->ID.'-js', get_stylesheet_directory_uri().'/js/single-'.$post->post_type.'.js', array('jquery', 'functions.child.main'), b_f_versions(), true );
		}

		?>

		<script type="text/javascript">
			console.log('<?= $log ?>');
		</script>

		<?php

	}

	add_action('wp_enqueue_scripts', 'b_f_frontend_scripts');

}


// Carga scripts backend

if (!function_exists('b_f_backend_scripts')) {

	function b_f_backend_scripts() {

		// Variables locales
		$log = 'Scripts loaded:\n';

		// Carga scripts
		b_f_load_scripts();

		wp_enqueue_style('wp-color-picker');
		wp_enqueue_script('wp-color-picker-alpha', get_template_directory_uri().'/js/external/functions.admin.colorpicker-alpha.js', array('wp-color-picker'), b_f_versions(), true);

		$temp = array(
			'version' => b_f_versions()
		);

		foreach ($_GET as $key => $value) {
			$temp['get'][$key] = $value;
		}

		wp_localize_script('functions.admin', 'bilnea', $temp);
		wp_enqueue_script('functions.admin');
		wp_enqueue_script('functions.child.admin');

		wp_enqueue_script('functions.core.jquery.ui');
		$log .= 'jQuery UI '.b_f_versions('jquery-ui').'\n';

		wp_enqueue_script('functions.design.select2');
		$log .= 'Select2 '.b_f_versions('select2').'\n';

		wp_enqueue_script('functions.functionality.spectrum');
		$log .= 'Spectrum '.b_f_versions('spectrum').'\n';

		?>

		<script type="text/javascript">
			console.log('<?= $log ?>');
		</script>

		<?php

		wp_enqueue_script('wp-color-picker');

		wp_enqueue_script('thickbox');
		wp_enqueue_script('media-upload');
		wp_enqueue_media();

	}

	add_action('admin_enqueue_scripts', 'b_f_backend_scripts');

}


// Preparación hojas de estilos

if (!function_exists('b_f_load_styles')) {

	function b_f_load_styles()  {

		// Hojas de estilos del tema
		wp_register_style('styles.bilnea', get_stylesheet_directory_uri().'/style.css', false, b_f_versions());
		wp_register_style('styles.main', get_template_directory_uri().'/styles/styles.main.php', false, b_f_versions());
		wp_register_style('styles.admin', get_template_directory_uri().'/css/internal/styles.admin.css', array('styles.functionality.spectrum'), b_f_versions());


		// Hojas de estilos del tema hijo
		wp_register_style('styles.child.main', get_stylesheet_directory_uri().'/css/main.css', false, b_f_versions());
		wp_register_style('styles.child.admin', get_stylesheet_directory_uri().'/css/admin.css', false, b_f_versions());

		// Flipclock
		wp_register_style('styles.flipclock', get_template_directory_uri().'/css/external/styles.counter.flipclock.css', false, b_f_versions('flipclock'));

		// Font Awesome
		wp_register_style('styles.design.fonts.awesome', get_template_directory_uri().'/css/external/styles.design.fonts.awesome.css', false, b_f_versions('font-awesome'));

		// jQuery UI
		wp_register_style('styles.core.jquery.ui', get_template_directory_uri().'/css/external/styles.core.jquery.ui.theme.css', false, b_f_versions('jquery-ui'));
		wp_register_style('styles.core.jquery.ui.theme', get_template_directory_uri().'/css/external/styles.core.jquery.ui.theme.css', false, b_f_versions('jquery-ui'));

		// Select2
		wp_register_style('styles.design.select2', get_template_directory_uri().'/css/external/styles.design.select2.css', false, b_f_versions('select2'));

		// Animate.css
		wp_register_style('styles.design.animate', get_template_directory_uri().'/css/external/styles.design.animate.css', false, b_f_versions('animate-css'));

		// Spectrum
		wp_register_style('styles.functionality.spectrum', get_template_directory_uri().'/css/external/styles.functionality.spectrum.css', false, b_f_versions('spectrum'));

	}

}


// Hojas de estilos del frontend

if (!function_exists('b_f_frontend_styles')) {

	function b_f_frontend_styles() {

		// Variables globales
		global $post;

		// Variables locales
		$log = 'Styles loaded:\n';

		// Carga estilos
		b_f_load_styles();

		wp_enqueue_style('styles.bilnea');
		wp_enqueue_style('styles.main');
		wp_enqueue_style('styles.child.main');

		if (b_f_option('b_opt_jquery-ui') == 1) {
			wp_enqueue_style('styles.core.jquery.ui');
			wp_enqueue_style('styles.core.jquery.ui.theme');
		}

		if (b_f_option('b_opt_select2') == 1) {
			wp_enqueue_style('styles.design.select2');
		}

		if (b_f_option('b_opt_jquery-mobile') == 1 && b_f_option('b_opt_jquery-mobile-css') == 1) {
			wp_enqueue_style('styles.core.jquery.mobile', get_template_directory_uri().'/css/external/styles.core.jquery.mobile.css', array());
		}

		// Mapbox
		wp_register_style('styles.maps.mapbox', get_template_directory_uri().'/css/external/styles.maps.mapbox.css', false, b_f_versions('mapbox'));

		// Hojas de estilo específicas de la página
		if (isset($post) && file_exists(get_stylesheet_directory().'/css/'.$post->post_type.'-'.$post->ID.'.css')) {
			wp_enqueue_style($post->post_type.'-'.$post->ID.'-css', get_stylesheet_directory_uri().'/css/'.$post->post_type.'-'.$post->ID.'.css', array('styles.child.main'), b_f_versions());
		}

		if (is_home() && file_exists(get_stylesheet_directory().'/css/blog.css')) {
			wp_enqueue_style('bilnea.blog-css', get_stylesheet_directory_uri().'/css/blog.css', array('styles.child.main'), b_f_versions());
		}

		if (is_front_page() && file_exists(get_stylesheet_directory().'/css/home.css')) {
			wp_enqueue_style('bilnea.home-css', get_stylesheet_directory_uri().'/css/home.css', array('styles.child.main'), b_f_versions());
		}

		if (is_archive() && file_exists(get_stylesheet_directory().'/css/archive.css')) {
			wp_enqueue_style('bilnea.archive-css', get_stylesheet_directory_uri().'/css/archive.css', array('styles.child.main'), b_f_versions());
		}

		if (is_single() && file_exists(get_stylesheet_directory().'/css/single-'.$post->post_type.'.css')) {
			wp_enqueue_style($post->post_type.'-'.$post->ID.'-css', get_stylesheet_directory_uri().'/css/single-'.$post->post_type.'.css', array('styles.child.main'), b_f_versions());
		}

		// Hijas de estilo responsive
		$relative = str_replace(dirname(__FILE__).'/', '', get_stylesheet_directory().'/css');
		$scan = scandir(get_stylesheet_directory().'/css');

		unset($scan[0], $scan[1]);

		$temp = array();

		foreach($scan as $file) {
			if (substr($file, 0, 6) == 'media-') {
				$temp[str_replace('media-', '', str_replace('.css', '', $file))] = $file;
			}
		}

		krsort($temp);

		foreach($temp as $size => $file) {
			if ($size == 'mobile' && is_mobile()) {
				wp_enqueue_style('media-styles-'.$size, get_stylesheet_directory_uri().'/css/'.$file, array('styles.child.main'), b_f_versions());
			} else {
				wp_enqueue_style('media-styles-'.$size, get_stylesheet_directory_uri().'/css/'.$file, array('styles.child.main'), b_f_versions(), '(max-width: '.$size.'px)');
			}
		}

		?>

		<script type="text/javascript">
			console.log('<?= $log ?>');
		</script>

		<?php

	}

	add_action('wp_enqueue_scripts', 'b_f_frontend_styles');

}


// Hojas de estilos del backend

if (!function_exists('b_f_backend_styles')) {

	function b_f_backend_styles() {

		// Variables locales
		$log = 'Styles loaded:\n';

		// Carga estilos
		b_f_load_styles();

		wp_enqueue_style('styles.functionality.spectrum');

		wp_enqueue_style('styles.admin');
		wp_enqueue_style('styles.child.admin');

		wp_enqueue_style('styles.core.jquery.ui');
		wp_enqueue_style('styles.core.jquery.ui.theme');

		wp_enqueue_style('styles.design.select2');

		?>

		<script type="text/javascript">
			console.log('<?= $log ?>');
		</script>

		<?php

		wp_enqueue_style('wp-color-picker');

		wp_enqueue_style('thickbox');

	}

	add_action('admin_enqueue_scripts', 'b_f_backend_styles');

}

?>