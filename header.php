<?php

session_start();

// Variables globales
global $b_g_version;
global $b_g_language;

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
						global $sitepress;
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

		$var_menu_class = '';

		if (b_f_option('b_opt_sticky-menu') == 1) {
			$var_menu_class .= ' sticky';
		}

		if (b_f_option('b_opt_sticky-menu-animated') == 1) {
			$var_menu_class .= ' animated';
		}

		if (b_f_option('b_opt_mobile-menu') == 3) {

			?>

			<div id="mobile-side-menu">
				<div id="mobile-menu">
					<div>

						<?php

						if (b_f_option('b_opt_header-search') == 1 && b_f_option('b_opt_header-search-location') == 2) {
							get_search_form();
						}

						wp_nav_menu(array(
							'theme_location' => 'menu_main',
							'container_id' => 'main_menu'
							)
						);

						if (b_f_option('header_rrss') == 1 && b_f_option('header_rrss_donde') == 2) {
							echo rrss('menu_rrss', b_f_option('b_opt_header-rrss-icons'));
						}

						?>
					</div>
				</div>
			</div>

			<?php
			
		}
			
		?>

			<div class="main_container <?php if (b_f_option('b_opt_body-width') == 1) { echo ' container'; } ?>" data-role="page">

				<!-- Cabecera de página escritorio -->
				<header id="header" class="site-header <?= $var_menu_class ?>" role="banner">

					<!-- Barra superior -->
					<?php

					if (b_f_option('b_opt_top-bar') == 1) {
					
						?>

						<div class="header-top">
							<div <?php if (b_f_option('b_opt_header-width') == 2) { echo 'class="container"'; } ?>>

								<?php

								if (b_f_option('b_opt_menu-top-bar') == 1) {

									wp_nav_menu(array(
										'theme_location' => 'menu_top',
										'container_id' => 'b_opt_topbar'
										)
									);

								};

								if (b_f_option('b_opt_rrss-header') == 1 && b_f_option('b_opt_rrss-header-location') == 1) {
									echo b_f_rrss('social-top', b_f_option('b_opt_header-rrss-icons'));
								}

								if (b_f_option('b_opt_header-search') == 1 && b_f_option('b_opt_header-search-location') == 1) {
									get_search_form();
								}

								?>

							</div>

							<?php

							if (function_exists('icl_object_id') && b_f_option('b_opt_language-header') == 1 && b_f_option('b_opt_language') == 1) {
								$iny = '';
								$inz = '';
								$tot = 0;
								$idi = icl_get_languages('skip_missing=0&orderby=code');
								if (!empty($idi)) {
									if (b_f_option('b_opt_language-selector-header') == 2) { $cl = ' inline'; } else { $cl = ' dropdown'; }
									$iny .= '<ul class="language-selector-top-bar'.$cl.'">'."\n";
									foreach ($idi as $i) {
										if (!$i['active']) {
											$inz .= '<li><a href="'.$i['url'].'">'."\n";
											if (b_f_option('b_opt_language-flag-header') == 1) {
												$inz .= '<img src="'.$i['country_flag_url'].'" height="12" alt="'.$i['language_code'].'" width="18" class="bandera" />'."\n";
											}
											if (b_f_option('b_opt_language-name-header') == 1 && b_f_option('b_opt_wpm-header-language') == 1) {
												$inz .= $i['translated_name'];
											}
											if (b_f_option('b_opt_language-name-header') == 1 && b_f_option('b_opt_wpm-header-language') == 2) {
												$inz .= $i['native_name'];
											}
											$inz .= '</a></li>'."\n";
											$tot++;
										}
									}
									foreach ($idi as $i) {
										if ($i['active'] == 1) {
											$iny .= '<li><a href="'.$i['url'].'">'."\n";
											if (b_f_option('b_opt_language-flag-header') == 1) {
												$iny .= '<img src="'.$i['country_flag_url'].'" height="12" alt="'.$i['language_code'].'" width="18" class="bandera" />'."\n";
											}
											if (b_f_option('b_opt_language-name-header') == 1 && b_f_option('b_opt_wpm-header-language') == 1) {
												$iny .= $i['translated_name'];
											}
											if (b_f_option('b_opt_language-name-header') == 1 && b_f_option('b_opt_wpm-header-language') == 2) {
												$iny .= $i['native_name'];
											}
											$iny .= '<div class="language-selector-submenu"></div></a>'."\n";
											if ($tot > 0) {
												if (b_f_option('b_opt_language-selector-header') == 2) {
													$iny .= $inz;
												} else {
													$iny .= '<ul>'.$inz.'</ul>'."\n";
												}
											}
											$iny .= '</li>'."\n";
										}
									}
									$iny .= '</ul>';
								}
								echo $iny;
							}
							?>
						</div>
					<?php
					}
					?>
		
		<!-- Bloque menú de la cabecera -->
		<?php
		switch (b_f_option('b_opt_menu-align')) {
			case 1: $var_menu_align = ' al'; break;
			case 2: $var_menu_align = ' ac'; break;
			case 3: $var_menu_align = ' ar'; break;
			default: $var_menu_align = ' al'; break;
		}
		switch (b_f_option('b_opt_header-logo-align')) {
			case 1: $var_logo_align = ' al'; break;
			case 2: $var_logo_align = ' ac'; break;
			case 3: $var_logo_align = ' ar'; break;
			default: $var_logo_align = ' al'; break;
		}
		?>
		<div class="header<?= $var_logo_align; ?>">
			<div <?php if (b_f_option('b_opt_menu-width') == 2) { echo 'class="container"'; } ?>>

				<?php

				$var_logo_class = 'block';

				if (b_f_option('b_opt_main-logo') != '') {

					switch (b_f_option('header_menu')) {
						case 1:
							$var_logo_class = 'block';
							break;
						default:
							$var_logo_class = 'inline-block';
							break;
					}

				}

				?>

				<div class="logo_wrapper" style="display: <?= $var_logo_class; ?>;">

					<?php

					if (strtolower(pathinfo(b_f_option('b_opt_main-logo'), PATHINFO_EXTENSION)) == 'svg') {
						echo '<a href="'.esc_url(home_url('/')).'" title="'.get_option('blogname').'" class="logo">'.file_get_contents(b_f_option('b_opt_main-logo')).'</a>';
					} else {
						echo '<a href="'.esc_url(home_url('/')).'" title="'.get_option('blogname').'" class="logo" style="display: none;"><img src="'.b_f_option('b_opt_main-logo').'" /></a>';
					}

					?>

				</div>

				<?php

				}

				if (function_exists('icl_object_id') && b_f_option('b_opt_language-header') == 2 && b_f_option('b_opt_language') == 1) {
					$iny = '';
					$inz = '';
					$tot = 0;
					$idi = icl_get_languages('skip_missing=0&orderby=custom');
					if (!empty($idi)) {
						if (b_f_option('b_opt_language-selector-header') == 2) { $cl = ' inline'; } else { $cl = ' dropdown'; }
						$iny .= '<ul class="language-selector-header'.$cl.'">'."\n";
						foreach ($idi as $i) {
							if (!$i['active']) {
								$inz .= '<li><a href="'.$i['url'].'">'."\n";
								if (b_f_option('b_opt_language-flag-header') == 1) {
									$inz .= '<img src="'.$i['country_flag_url'].'" height="12" alt="'.$i['language_code'].'" width="18" class="flag" />'."\n";
								}
								if (b_f_option('b_opt_language-name-header') == 1 && b_f_option('b_opt_wpm-header-language') == 1) {
									$inz .= $i['translated_name'];
								}
								if (b_f_option('b_opt_language-name-header') == 1 && b_f_option('b_opt_wpm-header-language') == 2) {
									$inz .= $i['native_name'];
								}
								if (b_f_option('b_opt_language-name-header') == 1 && b_f_option('b_opt_wpm-header-language') == 3) {
									$inz .= $i['code'];
								}
								$inz .= '</a></li>'."\n";
								$tot++;
							}
						}
						foreach ($idi as $i) {
							if ($i['active'] == 1) {
								$iny .= '<li><a href="'.$i['url'].'">'."\n";
								if (b_f_option('b_opt_language-flag-header') == 1) {
									$iny .= '<img src="'.$i['country_flag_url'].'" height="12" alt="'.$i['language_code'].'" width="18" class="flag" />'."\n";
								}
								if (b_f_option('b_opt_language-name-header') == 1 && b_f_option('b_opt_wpm-header-language') == 1) {
									$iny .= $i['translated_name'];
								}
								if (b_f_option('b_opt_language-name-header') == 1 && b_f_option('b_opt_wpm-header-language') == 2) {
									$iny .= $i['native_name'];
								}
								if (b_f_option('b_opt_language-name-header') == 1 && b_f_option('b_opt_wpm-header-language') == 3) {
									$inz .= $i['code'];
								}
								$iny .= '<div class="language-selector-submenu"></div></a>'."\n";
								if ($tot > 0) {
									if (b_f_option('b_opt_language-selector-header') == 2) {
										$iny .= $inz;
									} else {
										$iny .= '<ul>'.$inz.'</ul>'."\n";
									}
								}
								$iny .= '</li>'."\n";
							}
						}
						$iny .= '</ul>';
					}
					echo $iny;
				}
				?>

				<nav role="navigation" class="site-navigation main-navigation<?= $var_menu_align; ?>" style="display: <?php echo $var_logo_class; ?>;">

					<?php
					
					wp_nav_menu(array(
						'theme_location' => 'menu_main',
						'container_id' => 'main_menu'
						)
					);
					
					?>
				
				</nav>
			</div>
		</div>
	</header>

	<!-- Cabecera para dispositivos móviles -->
	<?php
	if (b_f_option('b_opt_mobile-menu') == 1)  {
	} elseif (b_f_option('b_opt_mobile-menu') == 2) {
		?>
			<header id="mobile-header" class="<?= $var_menu_class ?>">
				<div>

					<?php

					if (b_f_option('b_opt_main-logo') != '') {

						?>
						<a href="<?php echo esc_url(home_url('/')); ?>" title="<?= bloginfo('name') ?>" class="logo" style="display: none;">
							<img src="<?= b_f_option('b_opt_main-logo') ?>" />
						</a>

						<?php
						
						}
					
					?>
					
					<div class="extra">
					
						<?php
					
						if (b_f_option('header_rrss') == 1 && b_f_option('header_rrss_donde') == 2) {
							echo rrss('menu_rrss', b_f_option('b_opt_header-rrss-icons'));
						}
					
						if (b_f_option('b_opt_header-search') == 1 && b_f_option('b_opt_header-search-location') == 2) {
							get_search_form();
						}
					
						?>
					
					</div>
					<div id="mobile-menu-button">
						<button class="mobile-button">
							<span>toggle menu</span>
						</button>
					</div>
				</div>
				<div id="mobile-menu">
					<div>
						
						<?php
						
						if (b_f_option('b_opt_header-search') == 1 && b_f_option('b_opt_header-search-location') == 2) {
							get_search_form();
						}
						
						wp_nav_menu(array(
							'theme_location' => 'menu_main',
							'container_id' => 'main_menu'
							)
						);
						
						if (b_f_option('header_rrss') == 1 && b_f_option('header_rrss_donde') == 2) {
							echo rrss('menu_rrss', b_f_option('b_opt_header-rrss-icons'));
						}
						
						?>
					
					</div>
				</div>
			</header>


		<?php
	} elseif (b_f_option('b_opt_mobile-menu') == 3) {
		?>

			<header id="mobile-header" class="<?= $var_menu_class ?> mobile-header-side">
				<div>
					<div id="mobile-menu-button">
						<button class="mobile-button">
							<span>toggle menu</span>
						</button>
					</div>
					<?php
					if (b_f_option('b_opt_main-logo') != '') {
					?>
					<a href="<?php echo esc_url(home_url('/')); ?>" title="<?= bloginfo('name') ?>" class="logo" style="display: none;">
						<img src="<?= b_f_option('b_opt_main-logo') ?>" />
					</a>
					<?php
					}
					?>
				</div>
			</header>

		<?php
	}
	?>

	<!-- Contenido -->
	<div class="content-wrapper">