<?php

/* Template Name: bilnea | Política cookies */

get_header();

?>

<div id="primary" class="main-row">
	<div id="content" role="main" class="span8 offset2">

		<?php

		if (have_posts()) {
			while (have_posts()) {
				the_post();

				?>

				<article class="post">
					<div class="the-content">
			            <div class="container">

							<?php

								$wordfence = 'wfvt_XXXXXX';
								foreach ($_COOKIE as $name => $content) {
									if (strpos($name, 'wfvt_') === 0) {
										$wordfence = $name;
									}
								}

								$cookies_list = array(
									'PHPSESSID' => array(
										get_bloginfo('name'),
										get_site_url(),
										'Usada por el lenguaje de programación PHP, crea una sesión de navegación única que almacena las variables de la sesión. Caduca al finalizar la navegación por el sitio web.'
									),
									'cookies_viewed' => array(
										get_bloginfo('name'),
										get_site_url(),
										'Permite saber si el usuario ha aceptado el aviso legal sobre la política de cookies y lo muestra si no se ha aceptado.'
									),
									$wordfence => array(
										'WordFence',
										'https://www.wordfence.com/terms-of-use-and-privacy-policy/',
										'Cookie usada para garantizar la seguridad del sitio web y evitar accesos no deseados. Recopila información de los visitantes y bloquea el acceso de aquellos que puedan comprometer la estabilidad y seguridad del sitio web.'
									),
									'_ga' => array(
										'Google',
										'https://developers.google.com/analytics/devguides/collection/analyticsjs/cookie-usage',
										'Almacenan datos anónimos de navegación como tiempo de la sesión de navegación y páginas visitadas con el fin de realizar estadísticas globales sobre las visitas realizadas al sitio web.'
									),
									'_icl_current_language' => array(
										'WPML',
										'https://wpml.org/purchase/privacy-and-security-information/',
										'Utilizado para mostrar el contenido en el idioma seleccionado por el usuario. Permite alternar entre los distintos idiomas disponibles.'
									)
								);

								?>

								<div class="legal">
									<p>Este portal, al igual que la mayoría de portales en Internet, usa cookies para mejorar la experiencia de navegación del usuario. Las cookies personalizan los servicios que ofrece el sitio web, ofreciendo a cada usuario información que puede ser de su interés, en atención al uso que realiza de esta web. A continuación encontrará información sobre qué son las cookies, qué tipo de cookies utiliza esta web, cómo puede desactivar las cookies en su navegador o cómo desactivar específicamente la instalación de cookies de terceros y qué ocurre en caso de deshabilitarlas.</p>
									<h3>¿Qué son las cookies?</h3>
									<p>Las cookies son pequeños archivos que algunas plataformas, como las páginas web, pueden instalar en su ordenador, smartphone, tableta o televisión conectada, al acceder a las mismas. Sus funciones pueden ser muy variadas: almacenar sus preferencias de navegación, recopilar información estadística, permitir ciertas funcionalidades técnicas, almacenar y recuperar información sobre los hábitos de navegación o preferencias de un usuario o de su equipo hasta el punto, en ocasiones, dependiendo de la información que contengan y de la forma en que utilice su equipo, de poder reconocerlo. Una cookie se almacena en un ordenador para personalizar y facilitar al máximo la navegación del usuario. Las cookies se asocian únicamente a un usuario y su ordenador y no proporcionan referencias que permitan deducir datos personales del usuario. El usuario podrá configurar su navegador para que notifique o rechace la instalación de las cookies enviadas por el sitio web.</p>
									<h3>¿Por qué son tan importantes?</h3>
									<p>Las cookies son útiles por varios motivos. Desde un punto de vista técnico, permiten que las páginas web funcionen de forma más ágil y adaptada a las preferencias del usuario como, por ejemplo, almacenar su idioma o la moneda de su país. Además, ayudan a los responsables de los sitios web a mejorar los servicios que ofrecen, gracias a la información estadística que recogen a través de ellas. Finalmente, sirven para hacer más eficiente la publicidad que le mostramos, gracias a la cual le podemos ofrecer servicios de forma gratuita.</p>
									<h3>¿Cómo utilizamos las cookies?</h3>
									<p>Navegar por esta web supone que se puedan instalar los siguientes tipos de cookies:</p>
									<h4>Cookies de mejora de rendimiento</h4>
									<p>Este tipo de cookies conserva sus preferencias para ciertas herramientas o servicios para que no tenga que reconfigurarlos cada vez que visita nuestro portal y, en algunos casos, pueden ser aportadas por terceros. Algunos ejemplos de este tipo de cookies son: ajuste del volumen de los reproductores audiovisuales, preferencias de ordenación de artículos o velocidades de reproducción de vídeo compatibles. En el caso de comercio electrónico, permiten mantener información sobre su cesta de la compra.</p>
									<h4>Cookies de análisis estadístico</h4>
									<p>Son aquellas que, bien tratadas por nosotros o por terceros, permiten cuantificar el número de visitantes y analizar estadísticamente la utilización que hacen los usuarios de nuestros servicios. Gracias a ellas podemos estudiar la navegación por nuestra página web y mejorar así la oferta de productos o servicios que ofrecemos. Estas cookies no irán asociadas a ningún dato de carácter personal que pueda identificar al usuario, dando información sobre el comportamiento de navegación de forma anónima.</p>
									<h4>Cookies de geolocalización</h4>
									<p>Estas cookies son usadas por programas que intentan localizar geográficamente la situación del ordenador, smartphone, tableta o televisión conectada, para de manera totalmente anónima ofrecerle contenidos y servicios más adecuados.</p>
									<h4>Cookies de registro</h4>
									<p>Son cookies que le identifican como usuario registrado e indican cuándo usted se ha identificado en la web. Estas cookies son utilizadas para identificar su cuenta de usuario y sus servicios asociados, facilitando así su navegación. Estas cookies se mantienen mientras usted no abandone la cuenta, cierre el navegador o apague el dispositivo. Estas cookies pueden ser utilizadas en combinación con datos analíticos para identificar de manera individual sus preferencias en nuestro portal.</p>
									<h4>Cookies publicitarias</h4>
									<p>Son aquéllas que, bien tratadas por nosotros o por terceros, permiten gestionar eficazmente los espacios publicitarios de nuestro sitio web, adecuando el contenido del anuncio al contenido del servicio solicitado o al uso que realice de nuestra página web. Gracias a ella podemos conocer sus hábitos de navegación en internet y mostrarle publicidad relacionada con su perfil de navegación.</p>
									<h4>Otras cookies de terceros</h4>
									<p>En algunas de nuestras páginas se pueden instalar cookies de terceros que permitan gestionar y mejorar los servicios que éstos ofrecen. Un ejemplo de este uso son los enlaces a las redes sociales que permiten compartir nuestros contenidos.</p>
									<h3></h3>
									<p>¿Cómo puedo configurar mis preferencias?</p>
									<p>Usted puede permitir, bloquear o eliminar las cookies instaladas en su equipo mediante la configuración de las b_f_optiones de su navegador de internet.</p>
									<p>A continuación le ofrecemos enlaces en los que encontrará información sobre cómo puede activar sus preferencias en los principales navegadores:</p>
									<ul>
										<li>Internet Explorer <a href="http://support.microsoft.com/kb/196955/es" target="_blank" rel="nofollow" title="Internet Explorer 5">5</a> / <a href="http://support.microsoft.com/kb/283185/es" target="_blank" rel="nofollow" title="Internet Explorer 6">6</a> / <a href="http://windows.microsoft.com/es-ES/windows-vista/Block-or-allow-cookies" target="_blank" rel="nofollow" title="Internet Explorer 7">7</a> / <a href="http://windows.microsoft.com/es-ES/windows-vista/Block-or-allow-cookies" target="_blank" rel="nofollow" title="Internet Explorer 8">8</a> / <a href="http://windows.microsoft.com/es-ES/windows7/How-to-manage-cookies-in-Internet-Explorer-9" target="_blank" rel="nofollow" title="Internet Explorer™ 9">9</a> / <a href="http://windows.microsoft.com/es-es/internet-explorer/ie-security-privacy-settings#ie=ie-10" target="_blank" rel="nofollow" title="Internet Explorer™ 10">10</a> / <a href="http://windows.microsoft.com/es-es/internet-explorer/ie-security-privacy-settings#ie=ie-11" target="_blank" rel="nofollow" title="Internet Explorer™ 11">11</a></li>
										<li>Safari <a href="http://www.apple.com/es/support/mac-apps/safari/" target="_blank" rel="nofollow" title="Safari 5">5</a> / <a href="http://www.apple.com/es/support/mac-apps/safari/" target="_blank" rel="nofollow" title="Safari 6">6</a> / <a href="http://support.apple.com/kb/PH17191?viewlocale=es_ES&amp;locale=es_ES" target="_blank" rel="nofollow" title="Safari 7">7</a> / <a href="http://support.apple.com/kb/PH19214?viewlocale=es_ES&amp;locale=es_ES" target="_blank" rel="nofollow" title="Safari 8">8</a> / <a href="http://support.apple.com/kb/HT1677?viewlocale=es_ES" target="_blank" rel="nofollow" title="Safari para iOS">iOS</a></li>
										<li><a href="https://support.google.com/chrome/answer/95647?hl=es&amp;hlrm=es" target="_blank" rel="nofollow" title="Google Chrome">Google Chrome</a></li>
										<li><a href="http://support.mozilla.org/es/kb/cookies-informacion-que-los-sitios-web-guardan-en-?redirectlocale=en-US&amp;redirectslug=Cookies" target="_blank" rel="nofollow" title="Mozilla Firefox">Mozilla Firefox</a></li>
										<li><a href="http://help.opera.com/Windows/11.50/es-ES/cookies.html" target="_blank" rel="nofollow" title="Opera">Opera</a></li>
										<li><a href="http://support.google.com/android/?hl=es" target="_blank" rel="nofollow" title="">Android</a></li>
										<li><a href="http://www.windowsphone.com/es-ES/how-to/wp7/web/changing-privacy-and-other-browser-settings" target="_blank" rel="nofollow" title="">Windows Phone</a></li>
										<li><a href="http://docs.blackberry.com/en/smartphone_users/deliverables/18578/Turn_off_cookies_in_the_browser_60_1072866_11.jsp" target="_blank" rel="nofollow" title="">Blackberry</a></li>
									</ul>
									<h3>¿Qué ocurre si se deshabilitan las cookies?</h3>
									<p>En el caso de bloquear o no aceptar la instalación de cookies es posible que ciertos servicios ofrecidos por nuestro sitio web que necesitan su uso queden deshabilitados y, por tanto, no estén disponibles para usted por lo que no podrá aprovechar por completo todo lo que nuestra web y aplicaciones le ofrecen. Es posible también que la calidad de funcionamiento de la página web pueda disminuir.</p>

									<?php

									if (b_f_option('b_opt_create-cookies-table') == 1) {
										echo '<h3>Tipos de cookies</h3>'."\n";
										foreach ($_COOKIE as $cookie => $value) {
											if (array_key_exists($cookie, $cookies_list)) {
												$name = get_bloginfo('name');
												if ($cookies_list[$cookie][0] != '') {
													$name = $cookies_list[$cookie][0];
												}
												if ($name == '_ga') {
													$name .= ', _gat';
												}
												if ($name == '_icl_current_language' && isset($_COOKIE['wpml_referer_url'])) {
													$name .= ', wpml_referer_url';
												}
												if ($cookies_list[$cookie][1] != '') {
													$url = '<strong>'.$name.'</strong> <a href="'.$cookies_list[$cookie][1].'" rel="nofollow,noindex" title="Política de cookies '.$name.'"><strong>[+]</strong></a>';
												} else {
													$url = '<strong>'.$name.'</strong>';
												}
												echo '<table class="cookie_def">'."\n";
												echo '<tr>'."\n";
												echo '<td><strong>'.$cookie.'</strong></td>'."\n";
												echo '<td>'.$url.'</td>'."\n";
												echo '</tr>'."\n";
												echo '<tr>'."\n";
												echo '<td colspan="2">'.$cookies_list[$cookie][2].'</td>'."\n";
												echo '</tr>'."\n";
												echo '</table>'."\n";
											}
										}
									}

									?>

									<h3>Aceptación de cookies</h3>
									<p>Si usted sigue navegando después de haberle informado sobre nuestra Política de cookies entendemos que acepta la utilización de las cookies.</p>
									<p>Al acceder a este sitio web o aplicación por primera vez, verá una ventana donde se le informa de la utilización de las cookies y donde puede consultar esta política de cookies. Si usted consiente la utilización de cookies, continúa navegando o hace clic en algún link se entenderá que usted ha consentido nuestra política de cookies y, por tanto, la instalación de las mismas en su equipo o dispositivo.</p>
									<p>Además del uso de nuestras cookies propias, permitimos a terceros establecer cookies y acceder a ellas en su ordenador. El consentimiento del uso de las cookies de esta empresa está ligado a la navegación por este sitio web.</p>
									<p>Para cualquier consulta sobre el uso de cookies en nuestro sitio web puede dirigirse al teléfono <a href="tel://<?= b_f_option('user_phone') ?>" title="Teléfono"><?= b_f_option('user_phone') ?></a> o a la dirección de correo electrónico <a href="mailto:<?= b_f_option('user_email') ?>" title="Correo electrónico"><?= b_f_option('user_email') ?></a></p>
								
								</div>
						</div>
			        </div>
				</article>

			<?php

			}
		}

		?>

	</div>
</div>

<?php

get_footer();

?>
