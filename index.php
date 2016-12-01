<?php

/**
 * Plantilla de la página de entradas
 *
 */

$var_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

include 'inc/data/data.query.php';

$query = new WP_Query($args); 

if ($query->have_posts()) {

	get_header();

	?>

	<div id="primary" class="main-row">
		<div id="content" role="main" class="span8 offset2">
			<article class="post">
				<div class="the-content">

				<?php

				// Variables globales
				global $b_g_language;

				//locales
				$var_blog = '<div class="blog-wrapper">';
				$var_id = 1;

				while ($query->have_posts()) {

					$query->the_post();

					include 'inc/data/data.blog.php';

					switch ($var_id%2) {
						case 0:
							$var_blog .= '<div data-id="'.get_the_ID().'" class="entry-even auto-height">'.do_shortcode(preg_replace_callback("/{{b_image-([0-9a-zA-Z]+)}}/", "b_f_i_image", str_replace($var_shortcodes, $var_replace, b_f_option('b_opt_blog-content-even-'.$b_g_language)))).'</div>';
							break;
						default:
							$var_blog .= '<div data-id="'.get_the_ID().'" class="entry-odd auto-height">'.do_shortcode(preg_replace_callback("/{{b_image-([0-9a-zA-Z]+)}}/", "b_f_i_image", str_replace($var_shortcodes, $var_replace, b_f_option('b_opt_blog-content-odd-'.$b_g_language)))).'</div>';
							break;
					}

					$var_id++;

				}

				$var_blog .= '</div>';

				include 'inc/data/data.pagination.php';

				echo do_shortcode(str_replace($var_shortcodes, $var_replace, b_f_option('b_opt_blog-content-page-'.$b_g_language)));

				?>

				</div>
			</article>
		</div>
	</div>

	<?php

	get_footer();

} else {

	// Variables globales
	global $b_g_language;

	if (b_f_option('b_opt_page-404-'.$b_g_language) != 'none') {
		
		$var_post = get_post(b_f_option('b_opt_page-404-'.$b_g_language));

		echo apply_filters('the_content', $var_post->post_content);

	} else {

		include_once(get_stylesheet_directory().'/404.php');

	}

}

wp_reset_postdata();

?>