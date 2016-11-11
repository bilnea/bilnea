<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

?>

			</div>

			<?php

			if (b_f_option('footer_show') == 1) {

				?>

				<footer class="site-footer<?php if (b_f_option('footer_width') == 2) { echo ' container'; } ?>" role="contentinfo" id="footer">
					<div class="container">

					<?php
									
					for ($i = 1; $i <= b_f_option('b_opt_footer-menu'); $i++) { 
						echo '<div id="footer-'.$i.'" class="x1'.$i.'">';
						dynamic_sidebar('footer_'.$i);
						echo '</div>';
					}

					?>

					</div>
				</footer>

				<?php

			}

			if (b_f_option('socket_show') == 1) {

				?>

				<div id="socket"<?php if (b_f_option('socket_width') == 2) { echo ' class="container"'; } ?>>
					<div class="container">

						<?php

						if (b_f_option('socket_copy') == 1) {
								echo '&copy; '.date('Y').' '.get_bloginfo('name').'. ';
						}

						// Variables globales
						global $b_g_language;

						// Variables locales
						$var_links = array();

						// Aviso legal
						if (is_numeric(b_f_option('b_opt_legal-advice-'.$b_g_language))) {
							array_push($var_links, '<a href="'.get_permalink(b_f_option('b_opt_legal-advice-'.$b_g_language)).'" target="_blank" title="'.get_the_title(b_f_option('b_opt_legal-advice-'.$b_g_language)).'" rel="noindex">'.get_the_title(b_f_option('b_opt_legal-advice-'.$b_g_language)).'</a>');
						}
							
						// Política de privacidad
						if (is_numeric(b_f_option('b_opt_privacy-policy-'.$b_g_language))) {
							array_push($var_links, '<a href="'.get_permalink(b_f_option('b_opt_privacy-policy-'.$b_g_language)).'" target="_blank" title="'.get_the_title(b_f_option('b_opt_privacy-policy-'.$b_g_language)).'" rel="noindex">'.get_the_title(b_f_option('b_opt_privacy-policy-'.$b_g_language)).'</a>');
						}

						// Política de cookies
						if (is_numeric(b_f_option('b_opt_cookies-policy-'.$b_g_language))) {
							array_push($var_links, '<a href="'.get_permalink(b_f_option('b_opt_cookies-policy-'.$b_g_language)).'" target="_blank" title="'.get_the_title(b_f_option('b_opt_cookies-policy-'.$b_g_language)).'" rel="noindex">'.get_the_title(b_f_option('b_opt_cookies-policy-'.$b_g_language)).'</a>');
						}

						// Firma de bilnea
						if (md5(b_f_option('socket_no-development')) != 'e8f00e69e2bc444b3c291110d037eb7d') {
							array_push($var_links, __('Made with <i class="fa fa-heart-o"></i> by', 'bilnea').' <a href="http://bilnea.com" title="'.__('bilnea. Communication & Digital Marketing Agency', 'bilnea').'" target="_blank" rel="nofollow">bilnea</a>');
						}

						echo implode(' | ', $var_links);

						?>

					</div>
				</div>

				<?php

			}

			wp_footer();

			?>

		</div>
	</body>
</html>
