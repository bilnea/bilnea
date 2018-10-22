<?php

get_header();

?>

<div id="primary" class="main-row">
	<div id="content" role="main" class="span8 offset2">
		<article class="post">
			<div class="the-content">

				<?php

				global $b_g_language;

				$object = get_queried_object();

				if (isset($object->taxonomy)) {

					$replacements = array(
						'{{b_title}}' => $object->name,
						'{{b_content}}' => $object->description,
						'{{b_image}}' => wp_get_attachment_image_src(get_term_meta($term_id, 'thumbnail_id', true), 'medium', true)[0]
					);

					echo strtr(b_f_shortcode(do_shortcode('[b_elementor id="'.b_f_option('b_opt_widget-'.$object->taxonomy.'-'.$b_g_language).'"]')), $replacements);
				}

				?>

			</div>
		</article>
	</div>
</div>

<?php

get_footer();

?>