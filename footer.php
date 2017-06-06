<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

?>

			</div>

				<footer class="site-footer<?php if (b_f_option('footer_width') == 2) { echo ' container'; } ?>" role="contentinfo" id="footer">
					<div class="container">

					<?php
									
					for ($i = 1; $i <= b_f_option('b_opt_footer-menu'); $i++) { 
						echo '<div id="footer-'.$i.'" class="x1'.b_f_option('b_opt_footer-menu').'">';
						dynamic_sidebar('footer_'.$i);
						echo '</div>';
					}

					?>

					</div>
				</footer>

				<div id="socket"<?php if (b_f_option('socket_width') == 2) { echo ' class="container"'; } ?>>
					<div class="container">

						<?=

						b_s_socket();

						?>

					</div>
				</div>
			
			<?php

			wp_footer();

			?>

		</div>
	</body>
</html>
