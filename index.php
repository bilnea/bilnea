<?php

/**
 * Plantilla de la página de entradas
 *
 */

$var_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

include 'inc/data/data.query.php';

$query = new WP_Query($args); 

get_header();

?>

<div id="primary" class="main-row">
	<div id="content" role="main" class="span8 offset2">
		<article class="post">
			<div class="the-content">

			<?php

			// Variables globales
			global $b_g_language;

			echo do_shortcode('[b_elementor id="'.b_f_option('b_opt_widget-index-'.$b_g_language).'"]');

			?>

			</div>
		</article>
	</div>
</div>

<?php

get_footer();

wp_reset_postdata();

?>