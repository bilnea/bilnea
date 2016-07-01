<?php

?>

	</div>

	<?php
	if (b_f_option('footer_show') == 1) {
	?>
	<footer class="site-footer" role="contentinfo" id="footer">
		<div <?php if (b_f_option('footer_width') == 2) { echo 'class="container"'; } ?>>
			<?php
			switch (b_f_option('b_opt_footer-menu')) {
				case 1:
					$clas = 'x11';
					break;

				case 2:
					$clas = 'x12';
					break;

				case 3:
					$clas = 'x13';
					break;
				
				case 4:
					$clas = 'x14';
					break;

				case 5:
					$clas = 'x15';
					break;
			}
			for ($i=0; $i < b_f_option('b_opt_footer-menu'); $i++) { 
			?>
			<div id="footer-<?= $i+1; ?>" class="<?= $clas ?>">

				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer_'.($i+1)) ) : ?>
				<?php endif; ?>
			</div>
			<?php
			}
			?>
		</div>
	</footer>
<?php
}
if (b_f_option('socket_show') == 1) {
?>
<div id="socket">
	<div <?php if (b_f_option('socket_width') == 2) { echo 'class="container"'; } ?>>
		<?php
		$lang = 'es';
		if (function_exists('icl_object_id')) {
			$lang = ICL_LANGUAGE_CODE;
			global $sitepress;
			$sck = [];
			if (b_f_option('socket_copy') == 1) {
				ob_start();
				echo bloginfo('name');
				$bln = ob_get_clean();
				array_push($sck, '&copy; '.date('Y').' '.$bln);
			}
			if (b_f_option('b_opt_legal-url-_'.$lang) != '') {
				array_push($sck, '<a href="'.$sitepress->language_url(ICL_LANGUAGE_CODE).b_f_option('b_opt_legal-url-_'.$lang).'" target="_blank" title="'.__('Legal Advice', 'bilnea').'" rel="noindex">'.__('Legal Advice', 'bilnea').'</a>');
			}
			if (b_f_option('b_opt_privacy-url-_'.$lang) != '') {
				array_push($sck, '<a href="'.$sitepress->language_url(ICL_LANGUAGE_CODE).b_f_option('b_opt_privacy-url-_'.$lang).'" target="_blank" title="'.__('Privacy Policy', 'bilnea').'" rel="noindex">'.__('Privacy Policy', 'bilnea').'</a>');
			}
			if (b_f_option('b_opt_cookies-url-_'.$lang) != '') {
				array_push($sck, '<a href="'.$sitepress->language_url(ICL_LANGUAGE_CODE).b_f_option('b_opt_cookies-url-_'.$lang).'" target="_blank" title="'.__('Cookies Policy', 'bilnea').'" rel="noindex">'.__('Cookies Policy', 'bilnea').'</a>');
			}
		} else {
			$sck = [];
			if (b_f_option('socket_copy') == 1) {
				ob_start();
				echo bloginfo('name');
				$bln = ob_get_clean();
				array_push($sck, '&copy; '.date('Y').' '.$bln);
			}
			if (b_f_option('b_opt_legal-url-_es') != '') {
				array_push($sck, '<a href="'.site_url().'/'.b_f_option('b_opt_legal-url-_es').'" target="_blank" title="'.__('Legal Advice', 'bilnea').'" rel="noindex">'.__('Legal Advice', 'bilnea').'</a>');
			}
			if (b_f_option('b_opt_privacy-url-_es') != '') {
				array_push($sck, '<a href="'.site_url().'/'.b_f_option('b_opt_privacy-url-_es').'" target="_blank" title="'.__('Privacy Policy', 'bilnea').'" rel="noindex">'.__('Privacy Policy', 'bilnea').'</a>');
			}
			if (b_f_option('b_opt_cookies-url-_es') != '') {
				array_push($sck, '<a href="'.site_url().'/'.b_f_option('b_opt_cookies-url-_es').'" target="_blank" title="'.__('Cookies Policy', 'bilnea').'" rel="noindex">'.__('Cookies Policy', 'bilnea').'</a>');
			}
		}

		if (md5(b_f_option('socket_no-development')) != 'e8f00e69e2bc444b3c291110d037eb7d') {
			array_push($sck, __('Made with <i class="fa fa-heart-o"></i> by', 'bilnea').' <a href="http://bilnea.com" title="'.__('bilnea. Communication & Digital Marketing Agency', 'bilnea').'" target="_blank" rel="nofollow">bilnea</a>');
		}
		echo preg_replace('/ \| /', '. ', implode(' | ', $sck), 1);
		?>
	</div>
</div>
</div>
<?php
}
?>

<?php
wp_footer();
?>

</body>
</html>
