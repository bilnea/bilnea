<?php

session_start();

// Variables globales
global $b_g_version;
global $b_g_language;

if (function_exists('icl_object_id')) {
	global $sitepress;
}

$var_search = '<i class="fa fa-search main-search-button"></i>';

?>

<!DOCTYPE html>

<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
		<meta name="format-detection" content="telephone=no" />
		<link rel="profile" href="http://gmpg.org/xfn/11" />

		<!--[if lt IE 9]>
		<script src="<?= get_template_directory_uri() ?>/js/external/functions.functionality.html5.js" type="text/javascript"></script>
		<![endif]-->

		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); echo (b_f_option('b_opt_anticopy') == 1) ? ' onkeypress="return anticopia(event);" onkeydown="return anticopia(event);" oncontextmenu="return false;"' : ''; ?>>

		<div class="main-search" style="display: none;">
			<span class="close">x</span>
			<?= get_search_form(false) ?>
		</div>

		<script type="text/javascript">
			jQuery(window).on('load scroll', function() {
				var responsive_width = <?= preg_replace('/[^0-9]/', '', b_f_option('b_opt_responsive', true)) ?>;
			});
		</script>

		<?php
		if (b_f_option('b_opt_loader') == 1) {
			wp_enqueue_script('functions.design.loader', get_stylesheet_directory_uri().'/js/loader.js', array('jquery'), $b_g_version, true);
			?>
			<div id="loader-wrap">
			<?php
				include(get_stylesheet_directory().'/loader.php');
			?>
			</div>
			<?php
		}
		?>

		<!-- Aviso cookies -->
		<?php

		if (b_f_option('b_opt_cookies-warning') == 1) {

			if (!isset($_COOKIE['cookies_viewed']) || $_COOKIE['cookies_viewed'] != 'yes') {
			
			?>
		
			<div id="cookie_warning">
				<div class="container">
					
					<?php
					
					if (function_exists('icl_object_id')) {
						$var_url = get_permalink(b_f_option('b_opt_cookies-policy-'.$b_g_language));						
					} else {
						$var_url = get_permalink(b_f_option('b_opt_cookies-policy-es'));
					}

					printf(__('We use our own and third-part <em>cookies</em> to analyse the use and measurement of our web in order to improve our services. If you go on surfing, we assume you acceept their use. <br />You can change your settings or find more information <a href="%1$s" target="_blank" title="%2$s cookies policy">here</a>.', 'bilnea'), $var_url, get_bloginfo('name'));
				
					?>
				
					<div class="ok"><?= __('Ok', 'bilnea') ?></div>
				</div>
			</div>
			<script type="text/javascript">
				var user_name = '';

				jQuery(function() {
					jQuery('#cookie_warning div').click(function() {
						var cwh = jQuery('#cookie_warning').outerHeight();
						jQuery('#cookie_warning').animate({
							top: -cwh
						}, 200, function() {
							jQuery('#cookie_warning').hide();
						});
						jQuery('.main_container, #mobile-header.sticky').animate({
							'margin-top': 0
						}, 200);
						b_js_set_cookie('cookies_viewed', 'yes', 365);
					})

					if (b_js_get_cookie('cookies_viewed') != 'yes') {
						b_js_set_cookie('cookies_viewed', 'yes', 365);
					} else {
						jQuery('#cookie_warning').hide();
					}
					var cwh = jQuery('#cookie_warning').outerHeight()-2;
					jQuery('.main_container, #mobile-header.sticky').css('margin-top', cwh);
				})

			</script>

			<?php

			}

		}

		?>

		<div id="mobile-menu">
			<div class="container">

				<?= do_shortcode('[b_elementor id="'.b_f_option('b_opt_widget-mobile-menu-'.$b_g_language).'"]'); ?>

			</div>
		</div>


		<div class="main_container <?php if (b_f_option('b_opt_body-width') == 1) { echo ' container'; } ?>" data-role="page">

			<!-- Cabecera de página escritorio -->
			<header id="header" class="site-header<?php echo ((b_f_option('b_opt_sticky-menu') == 1) ? ' sticky' : ''); echo ((b_f_option('b_opt_sticky-menu-animated') == 1) ? ' animated' : ''); ?>" role="banner">

				<?= do_shortcode('[b_elementor id="'.b_f_option('b_opt_widget-header-'.$b_g_language).'"]') ?>
				
			</header>

	<!-- Cabecera para dispositivos móviles -->
	<header id="mobile-header">
		<div class="container">
					
			<?= do_shortcode('[b_elementor id="'.b_f_option('b_opt_widget-mobile-header-'.$b_g_language).'"]'); ?>
					
		</div>
	</header>

	<!-- Contenido -->
	<div class="content-wrapper">