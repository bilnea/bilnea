<?php

?>


		<article class="post">
			<div class="the-content">

				<?php

				global $b_g_language;

				$object = get_queried_object();

				if (isset($object->taxonomy)) {

					$replacements = array(
						'{{b_title}}' => $object->name,
						'{{b_content}}' => $object->description,
						'{{b_image}}' => wp_get_attachment_image_src(get_term_meta($object->term_id, '_term-featured-image', true), 'full')[0]
					);

					$temp = strtr(b_f_shortcode(do_shortcode('[b_elementor id="'.b_f_option('b_opt_widget-'.$object->taxonomy.'-'.$b_g_language).'"]')), $replacements);

					$term_id = $object->term_id;

					$temp = preg_replace_callback("/{{b_meta-([a-z_-]+)}}/", function($matches) use($term_id) {
								return get_term_meta($term_id, $matches[1], true);
							}, $temp);

					echo $temp;

				}

				?>

			</div>
		</article>