<?php

/**
 * Plantilla de la página de entradas
 *
 */

$var_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array(
	'posts_per_page' => b_f_option('b_opt_blog-number', true),
	'paged' => $var_paged
);

$query = new WP_Query( $args ); 

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

				$var_categories = array();
				$var_tags = array();

				while ($query->have_posts()) {

					$query->the_post();

					if (!empty(get_the_category())) {
						foreach (get_the_category() as $var_category) {
							array_push($var_categories, '<a href="'.esc_url(get_category_link($var_category->term_id)).'">'.esc_html($var_category->name).'</a>');
						}
					}

					if (!empty(get_the_tags())) {
						foreach (get_the_tags() as $var_tag) {
							array_push($var_tags, '<a href="'.esc_url(get_tag_link($var_tag->term_id)).'">'.esc_html($var_tag->name ).'</a>');
						}
					}

					if (comments_open()) {
						if (get_comments_number() == 0) {
							$var_comments = __('No comments', 'bilnea');
						} elseif (get_comments_number() > 1) {
							$var_comments = get_comments_number().__(' comments', 'bilnea');
						} else {
							$var_comments = __('1 comment', 'bilnea');
						}
						$var_comments = '<a href="'.get_comments_link().'">'.$var_comments.'</a>';
					} else {
						$var_comments =  __('Comments are disabled', 'bilnea');
					}

					if (!function_exists('b_f_i_image')) {
						function b_f_i_image($arg = array('', 'thumbnail')) {
							return wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $arg[1])[0];
						}
					}

					$var_categories = '<div class="entry-categories">'.implode(', ', $var_categories).'</div>';
					$var_tags = '<div class="entry_tags">'.implode(', ', $var_tags).'</div>';

					$var_shortcodes = array('{{b_title}}', '{{b_permalink}}', '{{b_excerpt}}', '{{b_content}}', '{{b_date}}', '{{b_categories}}', '{{b_author}}', '{{b_tags}}', '{{b_comments-number}}', '{{b_share}}');
					$var_replace = array(get_the_title(), get_permalink(), get_the_excerpt(), get_the_content(), get_the_date(b_f_option('b_opt_blog-date-'.$b_g_language)), $var_categories, get_the_author_link(), $var_tags, $var_comments, '');

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

				$var_pagination = paginate_links( array(
					'format' => __('page', 'bilnea').'/%#%',
					'current' => max(1, get_query_var('paged')),
					'total' => $query->max_num_pages,
					'prev_text' => '« <span>'.__('Previous', 'bilnea').'</span>',
					'next_text' => '<span>'.__('Next', 'bilnea').'</span> »'
				));

				$var_shortcodes = array('{{b_blog}}','{{b_pagination}}');
				$var_replace = array($var_blog, '<div class="b_pagination">'.$var_pagination.'</div>');

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