<?php

$check = b_f_option('b_opt_widget-'.get_post_type().'-'.$b_g_language);

if (is_null($check) || $check == 'none') {

	$file = get_stylesheet_directory().'/single-'.get_post_type().'.php';

	if (file_exists($file)) {
		include($file);
	} else {
		include(get_template_directory().'/page.php');
	}

} else {

	get_header();

	?>

	<div id="primary" class="main-row">
		<div id="content" role="main" class="span8 offset2">
			<article class="post">
				<div class="the-content">

					<?php

					if (have_posts()) {

						while (have_posts()) {

							the_post();

							ob_start();
							the_content();
							$content = ob_get_clean();

							add_filter('the_content', 'b_f_i_empty_content');

							function b_f_i_empty_content($content) {
								return '';
							}

							the_content();

							global $b_g_language;

							$categories = array();
							$tags = array();

							if (get_the_category()) {
								foreach (get_the_category() as $category) {
									array_push($categories, '<a href="'.esc_url(get_category_link($category->term_id)).'">'.esc_html($category->name).'</a>');
								}
							}

							$categories = '<div class="entry-categories">'.implode(', ', $categories).'</div>';

							$replacements = array(
								'{{b_title}}' => get_the_title(),
								'{{b_permalink}}' => get_permalink(),
								'{{b_content}}' => '<div class="b_content">'.$content.'</div>',
								'{{b_date}}' => get_the_date(),
								'{{b_categories}}' => $categories,
								'{{b_image}}' => wp_get_attachment_image_src(get_post_thumbnail_id($id), 'full')[0]
							);

							echo strtr(do_shortcode('[b_elementor id="'.b_f_option('b_opt_widget-'.get_post_type().'-'.$b_g_language).'"]'), $replacements);

						}

					}

					?>

				</div>
			</article>
		</div>
	</div>

	<?php

	get_footer();

}

?>