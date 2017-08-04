<?php

session_start();

?>

<!DOCTYPE html>

<!--

88           88  88                                                                                         
88           ""  88                                                                                         
88               88                                                                                         
88,dPPYba,   88  88  8b,dPPYba,    ,adPPYba,  ,adPPYYba,        ,adPPYba,   ,adPPYba,   88,dPYba,,adPYba,   
88P'    "8a  88  88  88P'   `"8a  a8P_____88  ""     `Y8       a8"     ""  a8"     "8a  88P'   "88"    "8a  
88       d8  88  88  88       88  8PP"""""""  ,adPPPPP88       8b          8b       d8  88      88      88  
88b,   ,a8"  88  88  88       88  "8b,   ,aa  88,    ,88  888  "8a,   ,aa  "8a,   ,a8"  88      88      88  
8Y"Ybbd8"'   88  88  88       88   `"Ybbd8"'  `"8bbdP"Y8  888   `"Ybbd8"'   `"YbbdP"'   88      88      88 

-->


<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
		<meta name="format-detection" content="telephone=no" />
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

		<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
		<![endif]-->

		<?php wp_head(); ?>
		<?php
		if (b_f_option('b_opt_lightbox') == 1 && b_f_option('b_opt_lightbox-location') == 1) :
		?>
		<script type="text/javascript">
			jQuery(function($) {
				$('a[href$=".jpg"], a[href$=".jpeg"], a[href$=".gif"], a[href$=".png"]').magnificPopup({
					type: 'image' });
				$('a[href$="youtube.com"], a[href$="vimeo.com"]').magnificPopup({
					type: 'iframe',
					patterns: {
						youtube: {
							index: 'youtube.com/', 
							id: 'v=', 
							src: '//www.youtube.com/embed/%id%?autoplay=1' 
						},
						vimeo: {
							index: 'vimeo.com/',
							id: '/',
							src: '//player.vimeo.com/video/%id%?autoplay=1'
						}
					},
					srcAction: 'iframe_src', 
				})
				$('a[href$=".mp4"], a[href$=".m4v"], a[href$=".mp3"], a[href$=".m4a"], a[href$=".mov"], a[href$=".webm"], a[href$=".mpg"], a[href$=".mpeg"], a[href$=".ogg"], a[href$=".ogm"], a[href$=".wmv"]').each(function() {
					var t = $(this),
						url_vid = t.attr('href');
					if (t.has('img') && t.text() == '') {
						var image = '&i='+encodeURIComponent(t.find($('img')).attr('src'));
					} else {
						var image = '';
					}
					$.get(bilnea.main_theme_uri+'/inc/shortcode.video.php?v='+encodeURIComponent(url_vid)+image, function(video) {
						t.magnificPopup({
							type:'inline',
							items: {
								src: video 
							}
						})
						<?php
						if (wp_is_mobile()) {
						?>
						t.after(video.replace('autoplay="1"', ''));
						t.remove();
						<?php
						};
						?>
					});
				})
				$('img[rel*="gal"]').each(function() {
					var t = $(this),
						r = t.attr('rel');
					if (!t.parent().hasClass('galeria')) {
						t.parent().addClass('galeria');
					};
				})
				$('.galeria').each(function() {
					$(this).magnificPopup({
						delegate: 'a',
						type: 'image',
						gallery: {
							enabled: true
						}
					});
				});
			});
			jQuery(window).on('load scroll', function() {
				var responsive_width = <?= preg_replace('/[^0-9]/', '', b_f_option('b_opt_responsive')) ?>;
				if (jQuery(window).outerWidth() < responsive_width) {
					jQuery('#socket').html(jQuery('#socket').html().replace(' | Desarrollo web', '<br />Desarrollo web'));
				};
			})
		</script>
		<?php
		endif;
		?>
		<script type="text/javascript">
			jQuery(function() {
				new WOW().init();
			});
		</script>
	</head>

	<body <?php body_class(); $anc = (b_f_option('b_opt_anticopy') == 1) ? ' onkeypress="return anticopia(event);" onkeydown="return anticopia(event);" oncontextmenu="return false;"' : ''; echo $anc; ?>>

		<!-- Aviso cookies -->
		<?php
		if (b_f_option('b_opt_cookies-warning') == 1) {
			if (b_f_option('b_opt_show-cookies') == 1) {
				$pab = 'top: 0;';
			} else {
				$pab = 'bottom: 0';
			}
			if (!isset($_COOKIE['cookies_viewed']) || $_COOKIE['cookies_viewed'] != 'yes') :
		?>
		<div id="cookie_warning" style="padding: 10px 40px 10px 10px; text-align: center; left: 0; right: 0; z-index: 10000; <?php echo $pab; ?>">
			<div class="container">
				<?php
				printf(__('We use our own and third-part <em>cookies</em> to analyse the use and measurement of our web in order to improve our services. If you go on surfing, we assume you acceept their use.<br />You can change your settings or find more information <a href="%1$s" target="_blank" title="%2$s cookies policy">here</a>.', 'bilnea'), home_url('/'.b_f_option('b_opt_cookies-url-_es').'/'), get_bloginfo('name'));
				?>
				<div class="ok"><?= __('Ok', 'bilnea') ?></div>
			</div>
		</div>
		<script type="text/javascript">
			var user_name = '';

			jQuery(function() {
				jQuery('#cookie_warning div').click(function() {
					jQuery('#cookie_warning').hide();
					setCookie('cookies_viewed', 'yes', 365);
				})

				if (getCookie('cookies_viewed') != 'yes') {
					setCookie('cookies_viewed', 'yes', 365);
				} else {
					jQuery('#cookie_warning').hide();
				}
			})

			function setCookie(cname, cvalue, exdays) {
				var d = new Date();
				d.setTime(d.getTime() + (exdays*24*60*60*1000));
				var expires = "expires="+d.toUTCString();
				document.cookie = cname + "=" + cvalue + "; " + expires;
			}

			function getCookie(cname) {
				var name = cname + "=";
				var ca = document.cookie.split(';');
				for(var i=0; i<ca.length; i++) {
					var c = ca[i];
					while (c.charAt(0)==' ') c = c.substring(1);
					if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
				}
				return "";
			}
		</script>
		<?php
			endif;
		}
		?>

		<?php
		$stk = '';
		if (b_f_option('b_opt_sticky-menu') == 1) {
			$stk .= ' sticky';
		}
		if (b_f_option('b_opt_sticky-menu-animated') == 1) {
			$stk .= ' animated';
		}
		?>

		<div class="main_container <?php if (b_f_option('b_opt_body-width') == 1) { echo ' container'; } ?>" data-role="page">

			<!-- Cabecera de página escritorio -->
			<header id="header" class="site-header <?= $stk ?>" role="banner">

				<!-- Barra superior -->
				<?php
				if (b_f_option('b_opt_top-bar') == 1) :
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
						}
						if (b_f_option('b_opt_rrss-header') == 1 && b_f_option('b_opt_rrss-header-location') == 1) {
							echo b_f_rrss('social-top', b_f_option('b_opt_header-rrss-icons'));
						}
						?>
					</div>
					<?php
					if (function_exists('icl_object_id') && b_f_option('b_opt_language-header') == 1 && b_f_option('b_opt_language') == 1) :
						$iny = '';
						$inz = '';
						$tot = 0;
						$idi = icl_get_languages('skip_missing=1&orderby=code');
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
					endif;
					?>
					<div class="rrss">
						<a href="https://www.facebook.com/GrupoSanMarinoSpain" target="_blank" rel="nofollow" class="fa fa-facebook"></a>
						<a href="https://twitter.com/gruposanmarino" target="_blank" rel="nofollow" class="fa fa-twitter"></a>
						<a href="https://instagram.com/gruposanmarinospain" target="_blank" rel="nofollow" class="fa fa-instagram"></a>
						<a href="https://www.youtube.com/channel/UC8LVZ5NMLHp6O6lMND5d99A" target="_blank" rel="nofollow" class="fa fa-youtube"></a>
						<a href="http://www.linkedin.com/in/gruposanmarino" target="_blank" rel="nofollow" class="fa fa-linkedin"></a>
						<a href="http://www.pinterest.com/gruposanmarino" target="_blank" rel="nofollow" class="fa fa-pinterest"></a>
						<a href="http://www.houzz.es/pro/gruposanmarino" target="_blank" rel="nofollow" class="fa fa-houzz"></a>
					</div>
				</div>
				<?php
				endif;
				?>
		
		<!-- Bloque menú de la cabecera -->
		<?php
		switch (b_f_option('b_opt_menu-align')) {
			case 1: $alg = ' al'; break;
			case 2: $alg = ' ac'; break;
			case 3: $alg = ' ar'; break;
			default: $alg = ' al'; break;
		}
		switch (b_f_option('b_opt_header-logo-align')) {
			case 1: $gla = ' al'; break;
			case 2: $gla = ' ac'; break;
			case 3: $gla = ' ar'; break;
			default: $gla = ' al'; break;
		}
		?>
		<div class="header<?= $gla; ?>">
			<div <?php if (b_f_option('b_opt_menu-width') == 2) { echo 'class="container"'; } ?>>
				<?php
				$lgl = 'block';
				if (b_f_option('b_opt_main-logo') != '') :
					switch (b_f_option('header_menu')) {
					case 1:
						$lgl = 'block';
						break;
					default:
						$lgl = 'inline-block';
						break;
					}
				?>
				<div class="logo_wrapper" style="display: <?= $lgl; ?>;">
					<a href="<?php echo esc_url(home_url('/')); ?>" title="<?= bloginfo('name') ?>" class="logo" style="display: none;">
						<img src="<?= b_f_option('b_opt_main-logo') ?>" />
					</a>
				</div>
				<div class="rrss">
					<a href="https://www.facebook.com/GrupoSanMarinoSpain" target="_blank" rel="nofollow" class="fa fa-facebook"></a>
					<a href="https://twitter.com/gruposanmarino" target="_blank" rel="nofollow" class="fa fa-twitter"></a>
					<a href="https://instagram.com/gruposanmarinospain" target="_blank" rel="nofollow" class="fa fa-instagram"></a>
					<a href="https://www.youtube.com/channel/UC8LVZ5NMLHp6O6lMND5d99A" target="_blank" rel="nofollow" class="fa fa-youtube"></a>
					<a href="http://www.linkedin.com/in/gruposanmarino" target="_blank" rel="nofollow" class="fa fa-linkedin"></a>
					<a href="http://www.pinterest.com/gruposanmarino" target="_blank" rel="nofollow" class="fa fa-pinterest"></a>
					<a href="http://www.houzz.es/pro/gruposanmarino" target="_blank" rel="nofollow" class="fa fa-houzz"></a>
				</div>
				<?php
				endif;
				if (function_exists('icl_object_id') && b_f_option('b_opt_language-header') == 2 && b_f_option('b_opt_language') == 1) :
					$iny = '';
					$inz = '';
					$tot = 0;
					$idi = icl_get_languages('skip_missing=1&orderby=custom');
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
				endif;
				?>

				<nav role="navigation" class="site-navigation main-navigation<?= $alg; ?>" style="display: <?php echo $lgl; ?>;">
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
	if (b_f_option('b_opt_mobile-menu') == 1) :
	
	elseif (b_f_option('b_opt_mobile-menu') == 2) :
	?>
		<header id="mobile-header" class="<?= $stk ?>">
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
	elseif (b_f_option('b_opt_mobile-menu') == 3) :

	endif;
	?>

	<!-- Contenido -->
	<div class="content-wrapper">