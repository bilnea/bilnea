<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


// Preparación scripts

if (!function_exists('b_f_load_scripts')) {
	
	function b_f_load_scripts()  {

		// Variables globales
		global $b_g_version;

		// Scripts del tema
		wp_register_script('functions.main', get_template_directory_uri().'/js/internal/functions.main.js', array('jquery'), $b_g_version, true);
		wp_register_script('functions.anchor', get_template_directory_uri().'/js/internal/functions.anchor.js', array('jquery'), $b_g_version, true);
		wp_register_script('functions.accordion', get_template_directory_uri().'/js/internal/functions.accordion.js', array('jquery'), $b_g_version, true);
		wp_register_script('functions.design.parallax', get_template_directory_uri().'/js/internal/functions.design.parallax.js', array('jquery'), $b_g_version, true);
		wp_register_script('functions.design.menu', get_template_directory_uri().'/js/internal/functions.design.menu.js', array('jquery'), $b_g_version, true);
		wp_register_script('functions.admin', get_template_directory_uri().'/js/internal/functions.admin.js', array(), $b_g_version, true);
			
		// Scripts del tema hijo
		wp_register_script('functions.child.main', get_stylesheet_directory_uri().'/js/main.js', array('jquery'), $b_g_version, true);
		wp_register_script('functions.child.admin', get_stylesheet_directory_uri().'/js/admin.js', array('jquery', 'functions.admin'), $b_g_version, true);

		// jQuery UI
		wp_register_script('functions.core.jquery.ui', get_template_directory_uri().'/js/external/functions.core.jquery.ui.js', array('jquery'), b_f_versions('jquery-ui'), true);

		// Select2
		wp_register_script('functions.design.select2', get_template_directory_uri().'/js/external/functions.design.select2.js', array('jquery'), b_f_versions('select2'), true);

		// Flipclock
		wp_register_script('functions.counter.flipclock', get_template_directory_uri().'/js/external/functions.counter.flipclock.js', array('jquery'), b_f_versions('flipclock'), true);

		// Fitvids
		wp_register_script('functions.design.fitvids', get_template_directory_uri().'/js/external/functions.design.fitvids.js', array('jquery'), b_f_versions('fitvids'), true);

		// Query object
		wp_register_script('functions.core.jquery.queryobject', get_template_directory_uri().'/js/external/functions.core.jquery.queryobject.js', array('jquery'), b_f_versions('query-object'), true);

		// Anticopia
		wp_register_script('functions.anticopy', get_template_directory_uri().'/js/internal/functions.anticopy.js', array(), $b_g_version, true);

		// Lightbox
		wp_register_script('functions.design.magnificpopup', get_template_directory_uri().'/js/external/functions.design.magnificpopup.js', array('jquery'), b_f_versions('magnific-popup'), false);
		$var_temp = array(
			'labels' => array(
				'of' => __('of', 'bilnea')
			)
		);
		wp_localize_script('functions.main', 'magnificpopup', $var_temp);
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

		// Super Simple Slider
		wp_register_script('functions.slider', get_template_directory_uri().'/js/external/functions.media.flexslider.js', array('jquery'), b_f_versions('flexslider'), false);

		// responsiveCarousel.JS
		wp_register_script('functions.carousel', get_template_directory_uri().'/js/external/functions.media.responsivecarousel.js', array('jquery'), b_f_versions('responsivecarousel'), false);

		// AjaxSubmit
		wp_register_script('functions.ajaxform', get_template_directory_uri().'/js/external/functions.form.ajaxform.js', array('jquery'), b_f_versions('ajaxform'), false);

		// Vide
		wp_register_script('functions.media.vide', get_template_directory_uri().'/js/external/functions.media.vide.js', array('jquery'), b_f_versions('vide'), false);

	}

}


// Carga scripts frontend

if (!function_exists('b_f_frontend_scripts')) {
	
	function b_f_frontend_scripts() {

		// Variables globales
		global $post, $b_g_version;

		// Variables locales
		$var_log = 'Scripts loaded:\n';

		// Carga scripts
		b_f_load_scripts();

		$var_temp = array(
			'version' => $b_g_version,
			'root_url' => site_url()
		);
		wp_localize_script('functions.main', 'bilnea', $var_temp);
		wp_enqueue_script('functions.main');
		wp_enqueue_script('functions.anchor');
		wp_enqueue_script('functions.accordion');
		wp_enqueue_script('functions.child.main');
		wp_enqueue_script('functions.design.parallax');

		wp_enqueue_script('functions.design.fitvids');
		$var_log .= 'Fitvids '.b_f_versions('fitvids').'\n';

		wp_enqueue_script('functions.core.jquery.queryobject');
		$var_log .= 'Query Object '.b_f_versions('query-object').'\n';

		wp_enqueue_script('functions.design.wow');
		$var_log .= 'Wow '.b_f_versions('wow').'\n';

		wp_enqueue_script('functions.design.animatecolors');
		$var_log .= 'Animated Colors '.b_f_versions('animate-colors').'\n';

		wp_enqueue_script('functions.media.vide');
		$var_log .= 'Vide '.b_f_versions('vide').'\n';

		if (b_f_option('b_opt_anticopy') == 1) {
			wp_enqueue_script('functions.anticopy');
		}

		if (b_f_option('b_opt_lightbox') == 1) {
			wp_enqueue_script('functions.design.magnificpopup');
			wp_enqueue_script('functions.design.magnificpopup.internal');
			$var_log .= 'Magnific Popup '.b_f_versions('magnific-popup').'\n';
		}

		if (b_f_option('b_opt_sticky-menu-animated') == 1) {
			$var_temp = array(
				'responsive' => b_f_option('b_opt_responsive')
			);
			wp_localize_script('functions.design.menu', 'menu', $var_temp);
			wp_enqueue_script('functions.design.menu');
		}

		if (b_f_option('b_opt_hyphenator') == 1) {
			$var_temp = array(
				'selector' => b_f_option('b_opt_hyphenator-selector', true)
			);
			wp_localize_script('functions.design.hyphenator', 'hyphenator', $var_temp);
			wp_enqueue_script('functions.design.hyphenator');
			$var_log .= 'Hyphenator '.b_f_versions('hyphenator').'\n';
		}

		if (b_f_option('b_opt_jquery-ui') == 1) {
			wp_enqueue_script('functions.core.jquery.ui');
			$var_log .= 'jQuery UI '.b_f_versions('jquery-ui').'\n';
		}

		if (b_f_option('b_opt_select2') == 1) {
			wp_enqueue_script('functions.design.select2');
			$var_log .= 'Select2 '.b_f_versions('select2').'\n';
		}

		if (b_f_option('b_opt_jquery-mobile') == 1) {
			wp_enqueue_script('functions.core.jquery.mobile');
			$var_log .= 'jQuery UI Mobile '.b_f_versions('jquery-ui-mobile').'\n';
		}

		if (isset($post) && has_shortcode($post->post_content, 'b_slider')) {
			wp_enqueue_script('functions.slider');
			$var_log .= 'Flexslider '.b_f_versions('flexslider').'\n';
		}

		// Scripts específicos de la página
		if (isset($post) && file_exists(get_stylesheet_directory().'/js/'.$post->post_type.'-'.$post->ID.'.js')) {
			wp_enqueue_script($post->post_type.'-'.$post->ID.'-js', get_stylesheet_directory_uri().'/js/'.$post->post_type.'-'.$post->ID.'.js', array('jquery', 'functions.child.main'), $b_g_version, true );
		}

		if (is_home() && file_exists(get_stylesheet_directory().'/js/blog.js')) {
			wp_enqueue_script('bilnea.blog-js', get_stylesheet_directory_uri().'/js/blog.js', array('jquery', 'functions.child.main'), $b_g_version, true );
		}

		if (is_front_page() && file_exists(get_stylesheet_directory().'/js/home.js')) {
			wp_enqueue_script('bilnea.home-js', get_stylesheet_directory_uri().'/js/home.js', array('jquery', 'functions.child.main'), $b_g_version, true );
		}

		if (is_single() && file_exists(get_stylesheet_directory().'/js/single-'.$post->post_type.'.js')) {
			wp_enqueue_script($post->post_type.'-'.$post->ID.'-js', get_stylesheet_directory_uri().'/js/single-'.$post->post_type.'.js', array('jquery', 'functions.child.main'), $b_g_version, true );
		}

		add_filter('script_loader_tag', function ($var_tag, $var_handle) {
			if ('functions.google.map' !== $var_handle) {
				return $var_tag;
			} else {
				return str_replace("&#038;", "&", str_replace(' src', ' async defer src', $var_tag));
			}
		}, 10, 2);

		?>

		<script type="text/javascript">
			console.log('<?= $var_log ?>');
		</script>

		<?php

	}

	add_action('wp_enqueue_scripts', 'b_f_frontend_scripts');

}


// Carga scripts backend

if (!function_exists('b_f_backend_scripts')) {
	
	function b_f_backend_scripts() {

		// Variables globales
		global $b_g_version;

		// Variables locales
		$var_log = 'Scripts loaded:\n';

		// Carga scripts
		b_f_load_scripts();

		$var_temp = array(
			'version' => $b_g_version
		);

		foreach ($_GET as $key => $value) {
			$var_temp['get'][$key] = $value;
		}
		
		wp_localize_script('functions.admin', 'bilnea', $var_temp);
		wp_enqueue_script('functions.admin');
		wp_enqueue_script('functions.accordion');
		wp_enqueue_script('functions.child.admin');

		wp_enqueue_script('functions.core.jquery.ui');
		$var_log .= 'jQuery UI '.b_f_versions('jquery-ui').'\n';

		wp_enqueue_script('functions.design.select2');
		$var_log .= 'Select2 '.b_f_versions('select2').'\n';

		wp_enqueue_script('functions.functionality.spectrum');
		$var_log .= 'Spectrum '.b_f_versions('spectrum').'\n';

		add_filter('script_loader_tag', function ($var_tag, $var_handle) {
			if ('functions.google.map' !== $var_handle) {
				return $var_tag;
			} else {
				return str_replace("&#038;", "&", str_replace(' src', ' async defer src', $var_tag));
			}
		}, 10, 2);
			
		?>

		<script type="text/javascript">
			console.log('<?= $var_log ?>');
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

		// Variables globales
		global $b_g_version;

		// Hojas de estilos del tema
		wp_register_style('styles.bilnea', get_stylesheet_directory_uri().'/style.css', false, $b_g_version);
		wp_register_style('styles.main', get_template_directory_uri().'/styles/styles.main.php', false, $b_g_version);
		wp_register_style('styles.admin', get_template_directory_uri().'/css/internal/styles.admin.css', array('styles.functionality.spectrum'), $b_g_version);
		

		// Hojas de estilos del tema hijo
		wp_register_style('styles.child.main', get_stylesheet_directory_uri().'/css/main.css', false, $b_g_version);
		wp_register_style('styles.child.admin', get_stylesheet_directory_uri().'/css/admin.css', false, $b_g_version);

		// Flexslider
		wp_register_style('styles.slider', get_template_directory_uri().'/css/external/styles.media.flexslider.css', false, b_f_versions('flexslider'));

		// Flipclock
		wp_register_style('styles.flipclock', get_template_directory_uri().'/css/external/styles.counter.flipclock.css', false, b_f_versions('flipclock'));

		// Font Awesome
		wp_register_style('styles.design.fonts.awesome', get_template_directory_uri().'/css/external/styles.design.fonts.awesome.css', false, b_f_versions('font-awesome'));

		// Lightbox
		wp_register_style('styles.design.magnificpopup', get_template_directory_uri().'/css/external/styles.design.magnificpopup.css', false, b_f_versions('magnificpopup'));

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
		global $b_g_version;

		// Variables locales
		$var_log = 'Styles loaded:\n';

		// Carga estilos
		b_f_load_styles();

		wp_enqueue_style('styles.bilnea');
		wp_enqueue_style('styles.main');
		wp_enqueue_style('styles.child.main');

		wp_enqueue_style('styles.design.fonts.awesome');
		$var_log .= 'Font Awesome '.b_f_versions('font-awesome').'\n';

		wp_enqueue_style('styles.design.animate');
		$var_log .= 'Animate.css '.b_f_versions('animate-css').'\n';

		if (b_f_option('b_opt_lightbox') == 1) {
			wp_enqueue_style('styles.design.magnificpopup');
		}

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

		// Hojas de estilo específicas de la página
		if (isset($post) && file_exists(get_stylesheet_directory().'/css/'.$post->post_type.'-'.$post->ID.'.css')) {
			wp_enqueue_style($post->post_type.'-'.$post->ID.'-css', get_stylesheet_directory_uri().'/css/'.$post->post_type.'-'.$post->ID.'.css', array('styles.child.main'), $b_g_version);
		}

		if (is_home() && file_exists(get_stylesheet_directory().'/css/blog.css')) {
			wp_enqueue_style('bilnea.blog-css', get_stylesheet_directory_uri().'/css/blog.css', array('styles.child.main'), $b_g_version);
		}

		if (is_front_page() && file_exists(get_stylesheet_directory().'/css/home.css')) {
			wp_enqueue_style('bilnea.home-css', get_stylesheet_directory_uri().'/css/home.css', array('styles.child.main'), $b_g_version);
		}

		if (is_archive() && file_exists(get_stylesheet_directory().'/css/archive.css')) {
			wp_enqueue_style('bilnea.archive-css', get_stylesheet_directory_uri().'/css/archive.css', array('styles.child.main'), $b_g_version);
		}

		if (is_single() && file_exists(get_stylesheet_directory().'/css/single-'.$post->post_type.'.css')) {
			wp_enqueue_style($post->post_type.'-'.$post->ID.'-css', get_stylesheet_directory_uri().'/css/single-'.$post->post_type.'.css', array('styles.child.main'), $b_g_version);
		}

		// Hijas de estilo responsive
		$var_relative = str_replace(dirname(__FILE__).'/', '', get_stylesheet_directory().'/css');
		$var_scan = scandir(get_stylesheet_directory().'/css');

		unset($var_scan[0], $var_scan[1]);

		$var_temp = array();

		foreach($var_scan as $var_file) {
			if (substr($var_file, 0, 6) == 'media-') {
				$var_temp[str_replace('media-', '', str_replace('.css', '', $var_file))] = $var_file;
			}
		}

		krsort($var_temp);

		foreach($var_temp as $var_size => $var_file) {
			if ($var_size == 'mobile' && is_mobile()) {
				wp_enqueue_style('media-styles-'.$var_size, get_stylesheet_directory_uri().'/css/'.$var_file, array('styles.child.main'), $b_g_version);
			} else {
				wp_enqueue_style('media-styles-'.$var_size, get_stylesheet_directory_uri().'/css/'.$var_file, array('styles.child.main'), $b_g_version, '(max-width: '.$var_size.'px)');
			}
		}

		?>

		<script type="text/javascript">
			console.log('<?= $var_log ?>');
		</script>

		<?php

	}

	add_action('wp_enqueue_scripts', 'b_f_frontend_styles');

}


// Hojas de estilos del backend

if (!function_exists('b_f_backend_styles')) {
	
	function b_f_backend_styles() {

		// Variables globales
		global $b_g_version;

		// Variables locales
		$var_log = 'Styles loaded:\n';

		// Carga estilos
		b_f_load_styles();

		wp_enqueue_style('styles.functionality.spectrum');

		wp_enqueue_style('styles.admin');
		wp_enqueue_style('styles.child.admin');

		wp_enqueue_style('styles.design.fonts.awesome');
		$var_log .= 'Font Awesome '.b_f_versions('font-awesome').'\n';

		if (b_f_option('b_opt_lightbox') == 1) {
			wp_enqueue_style('styles.design.magnificpopup');
		}

		wp_enqueue_style('styles.core.jquery.ui');
		wp_enqueue_style('styles.core.jquery.ui.theme');

		wp_enqueue_style('styles.design.select2');

		?>

		<script type="text/javascript">
			console.log('<?= $var_log ?>');
		</script>

		<?php

		wp_enqueue_style('wp-color-picker');

		wp_enqueue_style('thickbox');

	}

	add_action('admin_enqueue_scripts', 'b_f_backend_styles');

}

?>