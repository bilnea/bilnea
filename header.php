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
		<script type="text/javascript">
			var bilnea = {
				post_id: '<?= $post->ID ?>',
				main_theme_uri: '<?= get_template_directory_uri() ?>',
				child_theme_uri: '<?= get_stylesheet_directory_uri() ?>',
				main_uri: '<?= get_site_url() ?>'
			}
		</script>
	</head>

	<body <?php body_class(); echo (b_f_option('b_opt_anticopy') == 1) ? ' onkeypress="return anticopia(event);" onkeydown="return anticopia(event);" oncontextmenu="return false;"' : ''; ?>>

		<div class="main-search" style="display: none;">
			<span class="close">x</span>
			<?= get_search_form(false) ?>
		</div>

		<script type="text/javascript">
			jQuery(window).on('load scroll', function() {
				var responsive_width = <?= preg_replace('/[^0-9]/', '', b_f_option('b_opt_responsive')) ?>;
				if (jQuery(window).outerWidth() < responsive_width) {
					jQuery('#socket').html(jQuery('#socket').html().replace(' | Desarrollo web', '<br />Desarrollo web'));
				};
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
						setCookie('cookies_viewed', 'yes', 365);
					})

					if (getCookie('cookies_viewed') != 'yes') {
						setCookie('cookies_viewed', 'yes', 365);
					} else {
						jQuery('#cookie_warning').hide();
					}
					var cwh = jQuery('#cookie_warning').outerHeight();
					jQuery('.main_container, #mobile-header.sticky').css('margin-top', cwh);
				})

				function setCookie(cname, cvalue, exdays) {
					var d = new Date();
					d.setTime(d.getTime() + (exdays*24*60*60*1000));
					var expires = "expires="+d.toUTCString();
					document.cookie = cname + "=" + cvalue + "; " + expires;
				}

				function getCookie(cname) {
					var name = cname+'=';
					var ca = document.cookie.split(';');
					for(var i=0; i<ca.length; i++) {
						var c = ca[i];
						while (c.charAt(0)==' ') c = c.substring(1);
						if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
					}
					return '';
				}
			</script>

			<?php

			}

		}

		if (b_f_option('b_opt_mobile-menu') == 2 || b_f_option('b_opt_mobile-menu') == 3) {

			?>

			<div id="mobile-menu" data="type-<?= b_f_option('b_opt_mobile-menu') ?>">

				<?php
				
				if (b_f_page_get_metabox('b_o_page_mobile_menu') == 1) {
					
					?>

					<div class="container">

						<?php

						if (function_exists('icl_object_id')) {
							$var_language_selector = $sitepress->get_language_selector();
						} else {
							$var_language_selector = '';
						}

						// Variables locales
						$var_menu = wp_nav_menu(array('theme_location' => 'menu_mobile', 'container_id' => 'mobile_menu', 'echo' => false));
						if (strtolower(pathinfo(b_f_option('b_opt_main-logo'), PATHINFO_EXTENSION)) == 'svg') {
							$var_logo = '<a href="'.get_site_url().'" title="'.get_option('blogname').'" class="logo">';
							$var_curl = curl_init();
							curl_setopt($var_curl, CURLOPT_URL, b_f_option('b_opt_main-logo'));
							curl_setopt($var_curl, CURLOPT_RETURNTRANSFER, 1);
							curl_setopt($var_curl,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
							$var_logo .= curl_exec($var_curl);
							curl_close($var_curl);
							$var_logo .= '</a>';
						} else {
							$var_logo = '<a href="'.get_site_url().'" title="'.get_option('blogname').'" class="logo" style="display: none;"><img src="'.b_f_option('b_opt_main-logo').'" /></a>';
						}
								
						$var_shortcodes = array('{{b_menu}}','{{b_logo}}','{{b_search}}','{{b_rrss}}','{{b_language_selector}}', '{{b_switcher}}', '{{b_search_icon}}');
						$var_replace = array($var_menu, $var_logo, get_search_form(false), b_s_rrss(array()), $var_language_selector, '<div id="mobile-menu-button"><button class="mobile-button"><span></span></button></div>', $var_search);

						echo preg_replace_callback("/{{b_menu-([0-9]+)}}/", "b_f_i_menu", do_shortcode(str_replace($var_shortcodes, $var_replace, b_f_option('b_opt_mobile-menu-'.$b_g_language))));

						?>

					</div>

					<?php

				}

				?>

			</div>

			<?php
			
		}
			
		?>

		<div class="main_container <?php if (b_f_option('b_opt_body-width') == 1) { echo ' container'; } ?>" data-role="page">

			<!-- Cabecera de página escritorio -->
			<header id="header" class="site-header<?php echo ((b_f_option('b_opt_sticky-menu') == 1) ? ' sticky' : ''); echo ((b_f_option('b_opt_sticky-menu-animated') == 1) ? ' animated' : ''); ?>" role="banner">

				<!-- Barra superior -->
				<?php

				if (b_f_option('b_opt_top-bar') == 1 && get_post_meta(get_the_ID(), 'b_o_page_metabox_top_bar', true) == 1 || !is_page()) {

					?>

					<div class="header-top">

						<?php

						if (function_exists('icl_object_id')) {
							$var_language_selector = $sitepress->get_language_selector();
						} else {
							$var_language_selector = '';
						}

						// Variables locales
						$var_menu = wp_nav_menu(array('theme_location' => 'menu_top', 'container_id' => 'top_menu', 'echo' => false));
						if (strtolower(pathinfo(b_f_option('b_opt_main-logo'), PATHINFO_EXTENSION)) == 'svg') {
							$var_logo = '<a href="'.get_site_url().'" title="'.get_option('blogname').'" class="logo">';
							$var_curl = curl_init();
							curl_setopt($var_curl, CURLOPT_URL, b_f_option('b_opt_main-logo'));
							curl_setopt($var_curl, CURLOPT_RETURNTRANSFER, 1);
							curl_setopt($var_curl,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
							$var_logo .= curl_exec($var_curl);
							curl_close($var_curl);
							$var_logo .= '</a>';
						} else {
							$var_logo = '<a href="'.get_site_url().'" title="'.get_option('blogname').'" class="logo" style="display: none;"><img src="'.b_f_option('b_opt_main-logo').'" /></a>';
						}
							
						$var_shortcodes = array('{{b_menu}}','{{b_logo}}','{{b_search}}','{{b_rrss}}','{{b_language_selector}}', '{{b_search_icon}}');
						$var_replace = array($var_menu, $var_logo, get_search_form(false), b_s_rrss(array()), $var_language_selector, $var_search);

						echo do_shortcode(str_replace($var_shortcodes, $var_replace, b_f_option('b_opt_header-top-content-'.$b_g_language)));

						?>

					</div>

				<?php

				}

				if (get_post_meta(get_the_ID(), 'b_o_page_metabox_header', true) == 1 || !is_page()) {

					?>
			
					<!-- Bloque menú de la cabecera -->
					<div class="header">
						<div <?php if (b_f_option('b_opt_menu-width') == 2) { echo 'class="container"'; } ?>>

							<?php

							if (function_exists('icl_object_id')) {
								$var_language_selector = $sitepress->get_language_selector();
							} else {
								$var_language_selector = '';
							}

							// Variables locales
							$var_menu = wp_nav_menu(array('theme_location' => 'menu_main', 'container_id' => 'main_menu', 'echo' => false));
							if (strtolower(pathinfo(b_f_option('b_opt_main-logo'), PATHINFO_EXTENSION)) == 'svg') {
								$var_logo = '<a href="'.get_site_url().'" title="'.get_option('blogname').'" class="logo">';
								$var_curl = curl_init();
								curl_setopt($var_curl, CURLOPT_URL, b_f_option('b_opt_main-logo'));
								curl_setopt($var_curl, CURLOPT_RETURNTRANSFER, 1);
								curl_setopt($var_curl,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
								$var_logo .= curl_exec($var_curl);
								curl_close($var_curl);
								$var_logo .= '</a>';
							} else {
								$var_logo = '<a href="'.get_site_url().'" title="'.get_option('blogname').'" class="logo" style="display: none;"><img src="'.b_f_option('b_opt_main-logo').'" /></a>';
							}
		
							$var_shortcodes = array('{{b_menu}}','{{b_logo}}','{{b_search}}','{{b_rrss}}','{{b_language_selector}}', '{{b_search_icon}}');
							$var_replace = array($var_menu, $var_logo, get_search_form(false), b_s_rrss(array()), $var_language_selector, $var_search);

							echo do_shortcode(str_replace($var_shortcodes, $var_replace, b_f_option('b_opt_header-main-content-'.$b_g_language)));

							?>

						</div>
					</div>

					<?php

				}

				?>
				
			</header>

	<!-- Cabecera para dispositivos móviles -->
	<?php

	if (b_f_option('b_opt_mobile-menu') == 3 && b_f_page_get_metabox('b_o_page_mobile_menu') == 1)  {
		?>
			<header id="mobile-header">
				<div class="container">
					
					<?php

					if (function_exists('icl_object_id')) {
						$var_language_selector = $sitepress->get_language_selector();
					} else {
						$var_language_selector = '';
					}

					// Variables locales
					$var_menu = wp_nav_menu(array('theme_location' => 'menu_mobile', 'container_id' => 'mobile_menu', 'echo' => false));
					if (strtolower(pathinfo(b_f_option('b_opt_main-logo'), PATHINFO_EXTENSION)) == 'svg') {
						$var_logo = '<a href="'.get_site_url().'" title="'.get_option('blogname').'" class="logo">';
						$var_curl = curl_init();
						curl_setopt($var_curl, CURLOPT_URL, b_f_option('b_opt_main-logo'));
						curl_setopt($var_curl, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt($var_curl,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
						$var_logo .= curl_exec($var_curl);
						curl_close($var_curl);
						$var_logo .= '</a>';
					} else {
						$var_logo = '<a href="'.get_site_url().'" title="'.get_option('blogname').'" class="logo" style="display: none;"><img src="'.b_f_option('b_opt_main-logo').'" /></a>';
					}
						
					$var_shortcodes = array('{{b_menu}}','{{b_logo}}','{{b_search}}','{{b_rrss}}','{{b_language_selector}}', '{{b_switcher}}', '{{b_search_icon}}');
					$var_replace = array($var_menu, $var_logo, get_search_form(false), b_s_rrss(array()), $var_language_selector, '<div id="mobile-menu-button"><button class="mobile-button"><span></span></button></div>', $var_search);

					echo preg_replace_callback("/{{b_menu-([0-9]+)}}/", "b_f_i_menu", do_shortcode(str_replace($var_shortcodes, $var_replace, b_f_option('b_opt_mobile-header-'.$b_g_language))));

					?>
					
				</div>
			</header>


		<?php
	}

	?>

	<!-- Contenido -->
	<div class="content-wrapper">