<?php
namespace Elementorbilnea\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Scheme_Typography;
use Elementor\Widget_Base;

if (! defined('ABSPATH')) exit;

class bilnea_Recent extends Widget_Base {

	public function get_name() {
		return 'bilnea_recents';
	}

	public function get_title() {
		return __('Recent post', 'bilnea');
	}

	public function get_icon() {
		return 'eicon-post-list';
	}

	public function get_categories() {
		return ['bilnea'];
	}

	public function get_script_depends() {
		return [];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'blog',
			[
				'label' => __('Recent post', 'bilnea'),
			]
		);

		$this->start_controls_tabs('recent_post');

		$this->start_controls_tab('config', ['label' => __('Configuration', 'bilnea')]);

		$this->add_control(
			'main_query',
			[
				'label' => __('Get from main query', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => '',
				'separator' => 'after',
			]
		);

		$types = array();

		foreach (get_post_types(array('public' => true), 'objects') as $key => $value) {
			$types[$key] = __($value->label);
		}

		unset($types['attachment']);
		unset($types['elementor_library']);

		reset($types);

		$this->add_control(
			'post_type',
			[
				'label' => __('Post type', 'bilnea'),
				'type' => Controls_Manager::SELECT,
				'default' => key($types),
				'options' => $types,
				'condition' => [
					'main_query' => '',
				],
			]
		);

		$this->add_control(
			'order_by',
			[
				'label' => __('Order by', 'bilnea'),
				'type' => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'date' => __('Date', 'bilnea'),
					'name' => __('Name', 'bilnea'),
					'rand' => __('Random', 'bilnea'),
				],
				'condition' => [
					'main_query' => '',
				],
				'separator' => 'after',
			]
		);

		$this->add_control(
			'pagination',
			[
				'label' => __('Show pagination', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'pagination_total',
			[
				'label' => __('Show totals', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => '',
				'condition' => [
					'pagination' => 'yes',
				],
			]
		);

		$this->add_control(
			'pagination_first',
			[
				'label' => __('Show first and last', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => '',
				'condition' => [
					'pagination' => 'yes',
				],
			]
		);

		$this->add_control(
			'post_page',
			[
				'label' => __('Posts per page', 'bilnea'),
				'type' => Controls_Manager::NUMBER,
				'default' => get_option('posts_per_page'),
				'condition' => [
					'main_query' => '',
				],
			]
		);

		$this->add_control(
			'number',
			[
				'label' => __('Posts to show', 'bilnea'),
				'type' => Controls_Manager::NUMBER,
				'default' => '3',
				'condition' => [
					'main_query' => '',
				],
			]
		);

		$this->add_control(
			'columns',
			[
				'label' => __('Columns', 'bilnea'),
				'type' => Controls_Manager::NUMBER,
				'default' => '3',
			]
		);

		$this->add_control(
			'length',
			[
				'label' => __('Excerpt length', 'bilnea'),
				'type' => Controls_Manager::NUMBER,
				'default' => '50',
			]
		);

		$this->add_control(
			'complex',
			[
				'label' => __('Complex Query', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => '',
				'separator' => 'before',
				'condition' => [
					'main_query' => '',
				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'type',
			[
				'label' => __('Query type', 'bilnea'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'tax'  => __('Taxonomy query', 'bilnea'),
					'meta' => __('Meta query', 'bilnea'),
				],
				'default' => 'tax'
			]
		);

		$repeater->add_control(
			'taxonomy',
			[
				'label' => __('Taxonomy', 'bilnea'),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'type' => 'tax',
				],
			]
		);

		$repeater->add_control(
			'field',
			[
				'label' => __('Field ', 'bilnea').'&nbsp;',
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'type' => 'tax',
				],
			]
		);

		$repeater->add_control(
			'terms',
			[
				'label' => __('Terms', 'bilnea'),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'type' => 'tax',
				],
			]
		);

		$repeater->add_control(
			'key',
			[
				'label' => __('Key', 'bilnea'),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'type' => 'meta',
				],
			]
		);

		$repeater->add_control(
			'value',
			[
				'label' => __('Value', 'bilnea'),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'type' => 'meta',
				],
			]
		);

		$repeater->add_control(
			'compare',
			[
				'label' => __('Compare', 'bilnea'),
				'type' => Controls_Manager::SELECT,
				'condition' => [
					'type' => 'meta',
				],
				'options' => [
					'='  => '=',
					'!=' => '!=',
					'>' => '>',
					'>=' => '>=',
					'<' => '<',
					'<=' => '<=',
					'LIKE' => 'LIKE',
					'NOT LIKE' => 'NOT LIKE',
					'IN' => 'IN',
					'NOT IN' => 'NOT IN',
					'BETWEEN' => 'BETWEEN',
					'NOT BETWEEN' => 'NOT BETWEEN',
					'EXISTS' => 'EXISTS',
					'NOT EXISTS' => 'NOT EXISTS',
					'REGEXP' => 'REGEXP',
					'NOT REGEXP' => 'NOT REGEXP',
					'RLIKE' => 'RLIKE'
				],
				'default' => '='
			]
		);

		$repeater->add_control(
			'meta_type',
			[
				'label' => __('Type', 'bilnea'),
				'type' => Controls_Manager::SELECT,
				'condition' => [
					'type' => 'meta',
				],
				'options' => [
					'NUMERIC'  => 'NUMERIC',
					'BINARY' => 'BINARY',
					'CHAR' => 'CHAR',
					'DATE' => 'DATE',
					'DATETIME' => 'DATETIME',
					'DECIMAL' => 'DECIMAL',
					'SIGNED' => 'SIGNED',
					'TIME' => 'TIME',
					'UNSIGNED' => 'UNSIGNED'
				],
				'default' => 'CHAR'
			]
		);

		$repeater->add_control(
			'excluding',
			[
				'label' => __('Excluding (NOT IN)', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => '',
				'condition' => [
					'type' => 'tax',
				],
			]
		);

		$this->add_control(
			'queries',
			[
				'label' => __('Custom queries', 'bilnea'),
				'type' => Controls_Manager::REPEATER,
				'show_label' => true,
				'default' => [
				],
				'fields' => array_values($repeater->get_controls()),
				'condition' => [
					'complex' => 'yes',
				],
			]
		);

		$this->add_control(
			'tax_operator',
			[
				'label' => __('Taxonomy operator', 'bilnea'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'AND' => __('AND', 'bilnea'),
					'OR' => __('OR', 'bilnea'),
				],
				'default' => 'and',
				'condition' => [
					'complex' => 'yes',
				],
			]
		);

		$this->add_control(
			'meta_operator',
			[
				'label' => __('Meta operator', 'bilnea'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'AND' => __('AND', 'bilnea'),
					'OR' => __('OR', 'bilnea'),
				],
				'default' => 'and',
				'condition' => [
					'complex' => 'yes',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab('content', ['label' => __('Content', 'bilnea')]);

		$this->add_control(
			'raw_content',
			[
				'label' => sprintf(__('You can use the followings snippets %s', 'bilnea'), implode(', ', array('{{b_title}}', '{{b_permalink}}', '{{b_title}}', '{{b_link}}', '{{b_date}}', '{{b_image}}', '{{b_excerpt}}'))),
				'type' => Controls_Manager::CODE,
				'default' => '',
				'placeholder' => __('Enter your enhaced content here', 'bilnea'),
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
		
	}

	protected function render() {

		$settings = $this->get_settings();

		$out = '<div class="elementor-bilnea-recents">';

		if ($settings['main_query'] == 'yes') {

			if (have_posts()) {

				$i = 0;

				while (have_posts()) {

					the_post();

					print_r(get_the_ID());

					if ($i%$settings['columns'] == 0 && $i > 0) {
						$out .= '</div><div class="elementor-bilnea-recents elementor-row">';
					}

					$temp = '<div class="elementor-column elementor-col-'.round(100/$settings['columns']).'" data-id="'.get_post_type().'-'.get_the_ID().'">';

					$replacements = array(
						'{{b_title}}' => get_the_title(),
						'{{b_permalink}}' => get_permalink(),
						'{{b_link}}' => get_permalink(),
						'{{b_date}}' => get_the_date(),
						'{{b_excerpt}}' => wp_trim_words(get_the_content(), $settings['length']),
						'{{b_image}}' => wp_get_attachment_image_src(get_post_thumbnail_id($id), 'medium')[0]
					);

					include_once(get_stylesheet_directory().'/elementor.php');

					if (isset($b_c_recents)) {
						$replacements = array_merge($replacements, $b_c_recents);
					}

					$temp .= strtr($settings['raw_content'], $replacements);

					$temp .= '</div>';

					$out .= preg_replace_callback("/{{b_tax-([a-z]+)}}/", function($matches) {
						$terms = array();
						foreach (wp_get_post_terms(get_the_ID(), $matches[1]) as $term) {
							array_push($terms, '<a href="'.get_term_link($term).'" data-term_id="'.$term->term_id.'">'.$term->name.'</a>');
						}
						return implode(', ', $terms);
					}, $temp);

					$i++;

					if ($i == $settings['number']) {
						break;
					}

				}

			}

			$out .= '</div></div>';

			if ($settings['pagination'] == 'yes') {

				global $wp_query;

				if ($wp_query->max_num_pages > 1) {

					$current = max(1, get_query_var('paged'));

					$pagination_block = paginate_links( array(
						'format' => __('page', 'bilnea').'/%#%',
						'current' => $current,
						'total' => $wp_query->max_num_pages,
						'prev_text' => '‹ <span>'.__('Previous', 'bilnea').'</span>',
						'next_text' => '<span>'.__('Next', 'bilnea').'</span> ›'
					));

					if ($settings['pagination_total'] == 'yes') {
						$out .= '<div class="b_pagination"><span class="total-pages">'.sprintf(__('Page %1$s of %2$s', 'bilnea'), $current, $wp_query->max_num_pages).'</span>';
					}

					if ($current > 2 && $settings['pagination_first'] == 'yes') {

						$out .= '<a class="first page-numbers" href="'.get_permalink().'">« <span>'.__('First', 'bilnea').'</span></a>';

					}

					$out .= $pagination_block;

					if ($current < ($wp_query->max_num_pages-2) && $settings['pagination_first'] == 'yes') {

						$out .= '<a class="last page-numbers" href="'.get_permalink().'/'.__('page', 'bilnea').'/'.($wp_query->max_num_pages-2).'"><span>'.__('Last', 'bilnea').' »</span></a>';

					}

					$out .= '</div>';

				}

			}

		} else {

			$args = array(
				'post_type' => array($settings['post_type']),
				'post_status' => array('publish'),
				'orderby' => $settings['order_by'],
				'order' => 'ASC',
				'posts_per_page' => $settings['post_page'],
			);

			if ($settings['pagination'] == 'yes') {
				$current = trim(((isset($_GET['pg']) && $_GET['pg'] != '') ? $_GET['pg'] : 1), '/');
				$args['paged'] = $current;
			}

			$tax = array();
			$meta = array();

			foreach ($settings['queries'] as $query) {
				switch ($query['type']) {
					case 'tax':
						$temp = '';
						$temp = array('taxonomy' => strtolower($query['taxonomy']), 'field' => strtolower($query['field']), 'terms' => preg_replace_callback("/{{b_current-([a-z-_]+)-([a-z]+)}}/", function($tax, $out = array()) {
								foreach (get_terms(array('taxonomy' => $tax[1], 'hide_empty' => false)) as $term) {
									switch ($tax[2]) {
										case 'id':
											array_push($out, get_queried_object()->term_id);
											break;
										case 'slug':
											array_push($out, get_queried_object()->slug);
											break;
									}
								}
								return implode(',', $out);
							}, explode(',', preg_replace('/\s+/', '', $query['terms']))));
						if ($query['excluding'] == 'yes') {
							$temp['operator'] = 'NOT IN';
						}
						array_push($tax, $temp);
						break;
					case 'meta':
						array_push($meta, array('key' => $query['key'], 'value' => $query['value'], 'compare' => $query['compare'], 'meta_type' => $query['meta_type']));
						break;
				}
			}

			if (count($tax) > 0) {
				$tax['relation'] = $settings['tax_operator'];
				$args['tax_query'] = $tax;
			}

			if (count($meta) > 0) {
				$meta['relation'] = $settings['meta_operator'];
				$args['meta_query'] = $meta;
			}

			$i = 0;

			$query = new \WP_Query($args);

			if ($query->have_posts()) {

				$out .= '<div class="elementor-row">';
				
				while ($query->have_posts()) {

					$query->the_post();

					if ($i%$settings['columns'] == 0 && $i > 0) {
						$out .= '</div><div class="elementor-bilnea-recents elementor-row">';
					}

					if (get_the_excerpt()) {
						$excerpt = get_the_excerpt();
					} else {
						$excerpt = wp_trim_words($post->post_content, $settings['length']);
					}

					$temp = '<div class="elementor-column elementor-col-'.round(100/$settings['columns']).'" data-id="'.get_post_type().'-'.get_the_ID().'">';

					$replacements = array(
						'{{b_title}}' => get_the_title(),
						'{{b_permalink}}' => get_permalink(),
						'{{b_link}}' => get_permalink(),
						'{{b_date}}' => get_the_date(get_option('date_format'), get_the_ID()),
						'{{b_excerpt}}' => $excerpt,
						'{{b_image}}' => wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium')[0]
					);

					include(get_stylesheet_directory().'/elementor.php');

					if (isset($b_c_recents)) {
						$replacements = array_merge($replacements, $b_c_recents);
					}

					if (function_exists('wc_get_product') && $product = wc_get_product(get_the_ID())) {
						$attributes = '';
						foreach (array_reverse($product->get_attributes()) as $attribute) {
							$attributes .= '<div class="attribute-wrap '.$attribute->get_name().'">';
							if ($attribute['is_visible'] || ($attribute->is_taxonomy() && taxonomy_exists($attribute->get_name()))) {
								foreach (get_the_terms($post->ID, $attribute->get_name()) as $term) {
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

					$temp .= strtr($settings['raw_content'], $replacements);

					$temp .= '</div>';

					$out .= preg_replace_callback("/{{b_tax-([a-z]+)}}/", function($matches) use($post) {
						$terms = array();
						foreach (wp_get_post_terms($post->ID, $matches[1]) as $term) {
							array_push($terms, '<a href="'.get_term_link($term).'" data-term_id="'.$term->term_id.'">'.$term->name.'</a>');
						}
						return implode(', ', $terms);
					}, $temp);

					$i++;

				}

				$out .= '</div>';

				if ($settings['pagination'] == 'yes') {

					if ($query->max_num_pages >= 1) {

						$pagination_block = paginate_links( array(
							'format' => '?pg=%#%',
							'current' => $current,
							'total' => $query->max_num_pages,
							'prev_text' => '‹ <span>'.__('Previous', 'bilnea').'</span>',
							'next_text' => '<span>'.__('Next', 'bilnea').'</span> ›'
						));

						$out .= '<div class="b_pagination"><span class="total-pages">'.sprintf(__('Page %1$s of %2$s', 'bilnea'), $current, $query->max_num_pages).'</span>';

						if ($current > 2 && $settings['pagination_first'] == 'yes') {

							$out .= '<a class="first page-numbers" href="'.get_permalink().'">« <span>'.__('First', 'bilnea').'</span></a>';

						}

						$out .= $pagination_block;

						if ($current < ($query->max_num_pages-2) && $settings['pagination_first'] == 'yes') {

							$out .= '<a class="last page-numbers" href="'.get_permalink().'/?pg='.($query->max_num_pages-2).'"><span>'.__('Last', 'bilnea').' »</span></a>';

						}

						$out .= '</div>';

					}

				}

			}

		}

		$out .= '</div>';

		echo $out;
		
	}

	protected function content_template() {
		
	}
}
