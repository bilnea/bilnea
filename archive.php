<?php

get_header();

?>

<div id="primary" class="main-row">
	<div id="content" role="main" class="span8 offset2">
		<article class="post">
			<div class="the-content">

				<?php

				global $b_g_language;

				if (is_category()) {
					echo do_shortcode('[b_elementor id="'.b_f_option('b_opt_widget-category-'.$b_g_language).'"]');
				}

				?>

			</div>
		</article>
	</div>
</div>

<?php

get_footer();

?>