<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

class Shortcodes_Elementor {

	private static $_instance = null;

	/**
	 * Instance of Elemenntor Frontend class.
	 *
	 * @var \Elementor\Frontend()
	 */
	private static $elementor_frontend;

	public static function instance() {
		if ( ! isset( self::$_instance ) ) {
			self::$_instance = new self;
		}

		return self::$_instance;
	}

	public function __construct() {

		if ( defined( 'ELEMENTOR_VERSION' ) ) {
			self::$elementor_frontend = new \Elementor\Frontend();

			add_shortcode( 'b_elementor', array( $this, 'elemenntor_add_template' ) );
		} else {
			add_action( 'admin_notices', array( $this, 'elementor_not_available' ) );
			add_action( 'network_admin_notices', array( $this, 'elementor_not_available' ) );
		}
	}

	public function elementor_not_available() {

		if ( file_exists(  WP_PLUGIN_DIR . '/elementor/elementor.php' ) ) {
			$url = network_admin_url() . 'plugins.php?s=elementor';
		} else {
			$url = network_admin_url() . 'plugin-install.php?s=elementor';
		}

		echo '<div class="notice notice-error">';
		echo '<p>' . sprintf( __( 'The <strong>Elementor Header Footer</strong> plugin requires <strong><a href="%s">Elementor</strong></a> plugin installed & activated.', 'header-footer-elementor' ) . '</p>', $url );
		echo '</div>';

	}

	public function elemenntor_add_template( $atts ) {
		$atts = shortcode_atts( array(
	        'id' => '',
	    ), $atts, 'elementor_add_template' );

	    if ( $atts['id'] !== '' ) {
	    	return self::$elementor_frontend->get_builder_content_for_display( $atts['id'] );
	    }
	}


}

Shortcodes_Elementor::instance();


if (!function_exists('b_i_f_content_replace_tax')) {

	function b_i_f_content_replace_tax($content, $term_id) {

		$replacements = array(
			'{{b_title}}' => $term->name,
			'{{b_permalink}}' => get_term_link($term_id),
			'{{b_date}}' => '',
			'{{b_image}}' => b_f_i_sanitize_text_field(get_term_meta($term_id, '_term-featured-image', true)),
			'{{b_content}}' => term_description($term_id)
		);

		if ($taxonomy == 'product_cat') {
			$replacements['{{b_image}}'] = wp_get_attachment_image_src(get_term_meta($term_id, 'thumbnail_id', true), 'medium', true)[0];
		}

		if (file_exists(get_stylesheet_directory().'/elementor.php')) {

			include(get_stylesheet_directory().'/elementor.php');

			if (isset($b_query)) {
				$replacements = array_merge($replacements, $b_query);
			}

		}

		$content = preg_replace_callback("/{{b_meta-([a-z_-]+)}}/", function($matches) use ($term_id) {
			return get_term_meta($term_id, $matches[1], true);
		}, $content);

		$content = strtr($content, $replacements);

		return $content;

	}

}


if ('b_i_f_content_replace_query') {

	function b_i_f_content_replace_query($content, $post_id) {

		$replacements = array(
			'{{b_title}}' => get_the_title($post_id),
			'{{b_permalink}}' => get_permalink($post_id),
			'{{b_date}}' => get_the_date(b_f_option('b_opt_blog-date-'.$b_g_language), $post_id),
			'{{b_image}}' => wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'medium', true)[0],
			'{{b_content}}' => get_the_content($post_id)
		);

		if (file_exists(get_stylesheet_directory().'/elementor.php')) {

			include(get_stylesheet_directory().'/elementor.php');

			if (isset($b_query)) {
				$replacements = array_merge($replacements, $b_query);
			}

		}

		$content = strtr($content, $replacements);

		$content = preg_replace_callback("/{{b_meta-([a-z_-]+)}}/", function($matches) use($post_id) {
			return get_post_meta($post_id, $matches[1], true);
		}, $content);

		$content = preg_replace_callback("/{{b_tax_name-([a-z_-]+)}}/", function($matches) use($post_id) {
			$terms = array();
			foreach (wp_get_post_terms($post_id, $matches[1]) as $term) {
				array_push($terms, $term->name);
			}
			return implode(', ', $terms);
		}, $content);

		$content = preg_replace_callback("/{{b_tax-([a-z_-]+)}}/", function($matches) use($post_id) {
			$terms = array();
			foreach (wp_get_post_terms($post_id, $matches[1]) as $term) {
				array_push($terms, '<a href="'.get_term_link($term).'" data-term_id="'.$term->term_id.'">'.$term->name.'</a>');
			}
			return implode(', ', $terms);
		}, $content);

		$content = preg_replace_callback("/{{b_excerpt(-)?([0-9]+)?}}/", function($matches) use($post_id) {
			if (!isset($matches[2])) {
				$matches[2] = 50;
			}
			return wp_trim_words(get_the_content($post_id), $matches[2]);
		}, $content);

		return $content;

	}

}

?>