<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

global $b_g_language;

?>

			</div>

				<footer class="site-footer<?php if (b_f_option('footer_width') == 2) { echo ' container'; } ?>" role="contentinfo" id="footer">

					<?= b_f_shortcode(do_shortcode(do_shortcode('[b_elementor id="'.b_f_option('b_opt_widget-footer-'.$b_g_language).'"]'))) ?>

				</footer>
			
			<?php

			wp_footer();

			?>

		</div>
	</body>
</html>
