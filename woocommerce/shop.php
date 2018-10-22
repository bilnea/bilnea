<?php

?>

		<article class="post">
			<div class="the-content">

				<?php

						ob_start();
						the_content();
						$content = ob_get_clean();

						add_filter('the_content', 'b_f_i_empty_content');

						function b_f_i_empty_content($content) {
							return '';
						}

						the_content();

						global $b_g_language, $product;

						$categories = array();
						$tags = array();

						if (get_the_category()) {
							foreach (get_the_category() as $category) {
								array_push($categories, '<a href="'.esc_url(get_category_link($category->term_id)).'">'.esc_html($category->name).'</a>');
							}
						}

						$categories = '<div class="entry-categories">'.implode(', ', $categories).'</div>';

						$attributes = '';

						$replacements = array(
							'{{b_title}}' => get_the_title(),
							'{{b_permalink}}' => get_permalink(),
							'{{b_content}}' => '<div class="b_content">'.$content.'</div>',
							'{{b_date}}' => get_the_date(),
							'{{b_categories}}' => $categories,
							'{{b_image}}' => wp_get_attachment_image_src(get_post_thumbnail_id($id), 'full')[0]
						);

						if ($product) {

							foreach (array_reverse($product->get_attributes()) as $attribute) {
								$attributes .= '<div class="attribute-wrap '.$attribute->get_name().'">';
								if ($attribute['is_visible'] || ($attribute->is_taxonomy() && taxonomy_exists($attribute->get_name()))) {
									foreach (get_the_terms(get_queried_object_id(), $attribute->get_name()) as $term) {
										if ($attribute->get_name() == 'pa_color') {
											$attributes .= '<span style="background-color: '.$term->name.';"></span>';
										} else {
											$attributes .= '<span>'.$term->name.'</span>';
										}
									}
								}
								$attributes .= '</div>';
							}

							$replacements['{{b_w_sku}}'] = $product->get_sku();
							$replacements['{{b_w_attributes}}'] = $attributes;

						}



						echo strtr(do_shortcode('[b_elementor id="'.b_f_option('b_opt_widget-store-'.$b_g_language).'"]'), $replacements);

				?>

			</div>
		</article>