<?php
namespace Elementorbilnea\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Scheme_Typography;
use Elementor\Widget_Base;

if (! defined('ABSPATH')) exit;

class bilnea_Query extends Widget_Base {

	public function get_name() {
		return 'bilnea_query';
	}

	public function get_title() {
		return __('Loop', 'bilnea');
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
			'loop',
			[
				'label' => __('Loop', 'bilnea'),
			]
		);

		$this->start_controls_tabs('recent_post');

		$this->start_controls_tab('config', ['label' => __('Configuration', 'bilnea')]);

		$types = array();

		foreach (get_post_types(array('public' => true), 'objects') as $key => $value) {
			if (!in_array($key, array('attachment', 'elementor_library', 'jet-menu'))) {
				$types['type_'.$key] = __($value->label);
			}
		}

		foreach (get_taxonomies(array('public' => true), 'objects') as $key => $value) {
			$types['tax_'.$key] = __($value->label);
		}

		$types['custom'] = __('Selected object');

		reset($types);

		$repeater = new Repeater();

		$repeater->add_control(
			'post_type',
			[
				'label' => __('Object type', 'bilnea'),
				'type' => Controls_Manager::SELECT,
				'default' => array(key($types)),
				'options' => $types,
			]
		);

		$repeater->add_control(
			'parent',
			[
				'label' => __('Parent', 'bilnea'),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'min' => 0,
				'conditions' => [
					'terms' => [
						[
							'name' => 'post_type',
							'operator' => '!=',
							'value' => 'custom'
						]
					]
				],
			]
		);

		$repeater->add_control(
			'exclude',
			[
				'label' => __('Exclude IDs', 'bilnea'),
				'type' => Controls_Manager::TEXT,
				'conditions' => [
					'terms' => [
						[
							'name' => 'post_type',
							'operator' => '!=',
							'value' => 'custom'
						]
					]
				],
			]
		);

		$repeater->add_control(
			'include',
			[
				'label' => __('Include IDs', 'bilnea'),
				'type' => Controls_Manager::TEXT,
				'conditions' => [
					'terms' => [
						[
							'name' => 'post_type',
							'operator' => '!=',
							'value' => 'custom'
						]
					]
				],
			]
		);


		$repeater->add_control(
			'limit',
			[
				'label' => __('Limit to IDs', 'bilnea'),
				'type' => Controls_Manager::TEXT,
				'conditions' => [
					'terms' => [
						[
							'name' => 'post_type',
							'operator' => '!=',
							'value' => 'custom'
						]
					]
				],
			]
		);

		$repeater->add_control(
			'order_by',
			[
				'label' => __('Order by', 'bilnea'),
				'type' => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'default' => __('Default order', 'bilnea'),
					'date' => __('Date', 'bilnea'),
					'name' => __('Name', 'bilnea'),
					'rand' => __('Random', 'bilnea'),
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'post_type',
							'operator' => '!=',
							'value' => 'custom'
						]
					]
				],
			]
		);

		$repeater->add_control(
			'order',
			[
				'label' => __('Inverse order', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => '',
				'conditions' => [
					'terms' => [
						[
							'name' => 'post_type',
							'operator' => '!=',
							'value' => 'custom'
						]
					]
				],
			]
		);

		$repeater->add_control(
			'offset',
			[
				'label' => __('Offset', 'bilnea'),
				'type' => Controls_Manager::NUMBER,
				'default' => 0,
				'min' => 0,
				'conditions' => [
					'terms' => [
						[
							'name' => 'post_type',
							'operator' => '!=',
							'value' => 'custom'
						]
					]
				],
			]
		);

		$repeater->add_control(
			'number',
			[
				'label' => __('Posts per page', 'bilnea'),
				'type' => Controls_Manager::NUMBER,
				'default' => -1,
				'min' => -1,
				'conditions' => [
					'terms' => [
						[
							'name' => 'post_type',
							'operator' => '!=',
							'value' => 'custom'
						]
					]
				],
			]
		);

		$repeater->add_control(
			'query_type',
			[
				'label' => __('Query type', 'bilnea'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'simple' => __('Simple query', 'bilnea'),
					'tax'  => __('Taxonomy query', 'bilnea'),
					'meta' => __('Meta query', 'bilnea'),
				],
				'default' => 'simple',
				'conditions' => [
					'terms' => [
						[
							'name' => 'post_type',
							'operator' => '!=',
							'value' => 'custom'
						]
					]
				],
			]
		);

		$repeater->add_control(
			'taxonomy',
			[
				'label' => __('Taxonomy', 'bilnea'),
				'type' => Controls_Manager::TEXT,
				'conditions' => [
					'terms' => [
						[
							'name' => 'post_type',
							'operator' => '!=',
							'value' => 'custom'
						],
						[
							'name' => 'query_type',
							'operator' => '==',
							'value' => 'tax'
						]
					]
				],
			]
		);

		$repeater->add_control(
			'field',
			[
				'label' => __('Field ', 'bilnea'),
				'type' => Controls_Manager::TEXT,
				'conditions' => [
					'terms' => [
						[
							'name' => 'post_type',
							'operator' => '!=',
							'value' => 'custom'
						],
						[
							'name' => 'query_type',
							'operator' => '==',
							'value' => 'tax'
						]
					]
				],
			]
		);

		$repeater->add_control(
			'terms',
			[
				'label' => __('Terms', 'bilnea'),
				'type' => Controls_Manager::TEXT,
				'conditions' => [
					'terms' => [
						[
							'name' => 'post_type',
							'operator' => '!=',
							'value' => 'custom'
						],
						[
							'name' => 'query_type',
							'operator' => '==',
							'value' => 'tax'
						]
					]
				],
			]
		);

		$repeater->add_control(
			'key',
			[
				'label' => __('Key', 'bilnea'),
				'type' => Controls_Manager::TEXT,
				'conditions' => [
					'terms' => [
						[
							'name' => 'post_type',
							'operator' => '!=',
							'value' => 'custom'
						],
						[
							'name' => 'query_type',
							'operator' => '==',
							'value' => 'meta'
						]
					]
				],
			]
		);

		$repeater->add_control(
			'value',
			[
				'label' => __('Value', 'bilnea'),
				'type' => Controls_Manager::TEXT,
				'conditions' => [
					'terms' => [
						[
							'name' => 'post_type',
							'operator' => '!=',
							'value' => 'custom'
						],
						[
							'name' => 'query_type',
							'operator' => '==',
							'value' => 'meta'
						]
					]
				],
			]
		);

		$repeater->add_control(
			'compare',
			[
				'label' => __('Compare', 'bilnea'),
				'type' => Controls_Manager::SELECT,
				'conditions' => [
					'terms' => [
						[
							'name' => 'post_type',
							'operator' => '!=',
							'value' => 'custom'
						],
						[
							'name' => 'query_type',
							'operator' => '==',
							'value' => 'meta'
						]
					]
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
				'conditions' => [
					'terms' => [
						[
							'name' => 'post_type',
							'operator' => '!=',
							'value' => 'custom'
						],
						[
							'name' => 'query_type',
							'operator' => '==',
							'value' => 'meta'
						]
					]
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
			'childrens',
			[
				'label' => __('Include childrens', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
				'conditions' => [
					'terms' => [
						[
							'name' => 'post_type',
							'operator' => '!=',
							'value' => 'custom'
						],
						[
							'name' => 'query_type',
							'operator' => '!=',
							'value' => 'simple'
						]
					]
				],
			]
		);

		$objects = $types = array();

		foreach (get_post_types(array('public' => true), 'objects') as $key => $value) {
			if (!in_array($key, array('attachment', 'elementor_library', 'jet-menu'))) {
				array_push($types, $key);
			}
		}

		$query = new \WP_Query(array(
			'post_type' => $types,
			'post_status' => 'publish'
		));


		while ($query->have_posts()) {
			$query->the_post();
			$objects[get_the_ID()] = get_the_title();
		}

		wp_reset_query();

		$types = array();

		foreach (get_taxonomies(array('public' => true), 'objects') as $key => $value) {
			array_push($types, $key);
		}

		foreach (get_terms(array('taxonomy' => $types, 'hide_empty' => false)) as $term) {
			$objects[$term->term_id] = $term->name;
		}

		$repeater->add_control(
			'selection',
			[
				'label' => __('Selection', 'bilnea'),
				'type' => Controls_Manager::SELECT2,
				'condition' => [
					'post_type' => 'custom'
				],
				'options' => $objects,
			]
		);

		$repeater->add_control(
			'excluding',
			[
				'label' => __('Excluding (NOT IN)', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => '',
				'conditions' => [
					'terms' => [
						[
							'name' => 'post_type',
							'operator' => '!=',
							'value' => 'custom'
						],
						[
							'name' => 'query_type',
							'operator' => '==',
							'value' => 'tax'
						]
					]
				],
			]
		);

		$this->add_control(
			'query',
			[
				'label' => __('Query', 'bilnea'),
				'type' => Controls_Manager::REPEATER,
				'show_label' => true,
				'default' => [
				],
				'fields' => array_values($repeater->get_controls())
			]
		);

		$this->add_control(
			'orderby',
			[
				'label' => __('Order by', 'bilnea'),
				'type' => Controls_Manager::SELECT,
				'default' => 'custom',
				'options' => [
					'custom' => __('Custom order', ''),
					'date' => __('Date', 'bilnea'),
					'name' => __('Name', 'bilnea'),
					'rand' => __('Random', 'bilnea')
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label' => __('Inverse order', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'number',
			[
				'label' => __('Posts per page', 'bilnea'),
				'type' => Controls_Manager::NUMBER,
				'default' => -1,
				'min' => -1
			]
		);

		$this->add_control(
			'columns',
			[
				'label' => __('Columns', 'bilnea'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'min' => 1,
					'max' => 10,
				],
			]
		);

		$this->add_control(
			'height',
			[
				'label' => __('Equal height', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'pagination',
			[
				'label' => __('Pagination', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab('content', ['label' => __('Content', 'bilnea')]);

		$this->add_control(
			'raw_content',
			[
				'label' => sprintf(__('You can use the followings snippets %s', 'bilnea'), implode(', ', array('{{b_title}}', '{{b_permalink}}', '{{b_link}}', '{{b_date}}', '{{b_image}}', '{{b_excerpt}}', '{{b_content}}', '{{b_meta-META}}'))),
				'type' => Controls_Manager::CODE,
				'default' => '',
				'placeholder' => __('Enter your enhaced content here', 'bilnea'),
			]
		);

		$this->add_control(
			'even_content',
			[
				'label' => __('Different content for even', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'raw_content_even',
			[
				'label' => sprintf(__('You can use the followings snippets %s', 'bilnea'), implode(', ', array('{{b_title}}', '{{b_permalink}}, {{b_title}}', '{{b_link}}', '{{b_date}}', '{{b_image}}', '{{b_excerpt}}'))),
				'type' => Controls_Manager::CODE,
				'default' => '',
				'placeholder' => __('Enter your enhaced content here', 'bilnea'),
				'condition' => [
					'even_content' => 'yes'
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	protected function render() {

		if (get_post_type() != 'elementor_library') {

		$settings = $this->get_settings();

		$out = '<div class="elementor-bilnea-query"><div class="elementor-row">';

		$wrapper = array();

		foreach ($settings['query'] as $query) {

			$type = $query['post_type'];

			if (is_array($type)) {
				$type = $type[0];
			}

			switch (explode('_', $type)[0]) {

				case 'type':

					$type = substr($type, 5);

					$args = array(
						'post_type' => array($type),
						'post_status' => array('publish'),
						'posts_per_page' => ($query['number'] == '' ? -1 : $query['number']),
					);

					if ($query['order_by'] != 'default') {
						$args['orderby'] = $query['order_by'];
					}

					if ($query['parent'] != '') {
						$args['post_parent'] = $query['parent'];
					}

					if ($query['offset'] != '') {
						$args['offset'] = $query['offset'];
					}

					if ($query['exclude'] != '') {
						$args['post__not_in'] = explode(',', preg_replace('/\s+/', '', strtr($query['exclude'], array(
							'{{b_current}}' => get_the_ID()
						))));
					}

					if ($query['query_type'] == 'tax') {

						$terms = array();

						foreach (wp_get_post_terms(get_the_ID(), $query['taxonomy']) as $term) {
							array_push($terms, $term->term_id);
						}

						$terms = implode(',', $terms);

						$temp = array(
							'taxonomy' => strtolower($query['taxonomy']),
							'field' => strtolower($query['field']),
							'terms' => explode(',', strtr(preg_replace('/\s+/', '', $query['terms']), array(
								'{{b_current_tax-id}}' => $terms)
							))
						);

						if ($query['childrens'] == 'yes') {
							$temp['include_children'] = true;
						} else {
							$temp['include_children'] = false;
						}

						$args['tax_query'] = array($temp);

						if ($query['excluding'] == 'yes') {
							$args['tax_query'][0]['operator'] = 'NOT IN';
						}

					}

					if ($query['query_type'] == 'meta') {

						$args['meta_query'] = array(
							array(
								'key' => $query['key'],
								'value' => $query['value'],
								'compare' => $query['compare'],
								'meta_type' => $query['meta_type']
							)
						);

					}

					$query = new \WP_Query($args);

					if ($query->have_posts()) {

						while ($query->have_posts()) {

							$query->the_post();

								$post_id = get_the_ID();

								$temp = '<div class="{{oddeven}}'.(($settings['height'] == 'yes') ? 'auto-height ' : '').'elementor-column elementor-col-'.round(100/$settings['columns']['size']).'" data-id="'.get_post_type().'-'.$post_id.'">';

								$replacements = array(
									'{{b_title}}' => get_the_title(),
									'{{b_permalink}}' => get_permalink(),
									'{{b_date}}' => get_the_date(b_f_option('b_opt_blog-date-es')),
									'{{b_image}}' => wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium', true)[0],
									'{{b_content}}' => get_the_content()
								);

								include(get_stylesheet_directory().'/elementor.php');

								if (isset($b_query)) {
									$replacements = array_merge($replacements, $b_query);
								}

								if ($settings['even_content'] == 'yes' && ($i % 2 == 0)) {
									$temp .= strtr($settings['raw_content_even'], $replacements);
								} else {
									$temp .= strtr($settings['raw_content'], $replacements);
								}

								$temp .= '</div>';

								$temp = preg_replace_callback("/{{b_meta-([a-z_-]+)}}/", function($matches) use($post_id) {
									return get_post_meta($post_id, $matches[1], true);
								}, $temp);

								$temp = preg_replace_callback("/{{b_tax_name-([a-z_-]+)}}/", function($matches) use($post_id) {
									$terms = array();
									foreach (wp_get_post_terms($post_id, $matches[1]) as $term) {
										array_push($terms, $term->name);
									}
									return implode(', ', $terms);
								}, $temp);

								$temp = preg_replace_callback("/{{b_tax-([a-z_-]+)}}/", function($matches) use($post_id) {
									$terms = array();
									foreach (wp_get_post_terms($post_id, $matches[1]) as $term) {
										array_push($terms, '<a href="'.get_term_link($term).'" data-term_id="'.$term->term_id.'">'.$term->name.'</a>');
									}
									return implode(', ', $terms);
								}, $temp);

								$temp = preg_replace_callback("/{{b_excerpt(-)?([0-9]+)?}}/", function($matches) use($post_id) {
									if (!isset($matches[2])) {
										$matches[2] = 50;
									}
									return wp_trim_words(get_the_content($post_id), $matches[2]);
								}, $temp);

								array_push($wrapper, array('name' => get_the_title(), 'date' => get_the_date('Ymd'), 'content' => $temp));

							}

						}

						wp_reset_postdata();

					break;

				case 'tax':

					$taxonomy = substr($query['post_type'], 4);

					$args = array(
						'taxonomy' => $taxonomy,
						'hide_empty' => false,
						'order' => 'ASC'
					);

					if ($query['offset'] != '') {
						$args['offset'] = $query['offset'];
					}

					if ($query['number'] > 0) {
						$args['number'] = $query['number'];
					}

					if ((string)$query['parent'] != '') {
						$args['parent'] = strtr($query['parent'], array(
							'{{b_current_tax-id}}' => get_queried_object()->term_id
						));
					}

					$terms = get_terms($args);

					if ($query['include'] != '') {

						foreach (explode(',', preg_replace('/\s+/', '', $query['include'])) as $term) {
							array_push($terms, get_term_by('id', $term, $taxonomy));
						}

					}

					switch ($query['order_by']) {

						case 'date':

							break;

						case 'name':
							usort($terms, function($a, $b) {
								return $a->name <=> $b->name;
							});
							break;

						default:
							usort($terms, function($a, $b) {
								return $a->term_order <=> $b->term_order;
							});
							break;

					}

					if ($query['order'] == 'yes') {
						$terms = array_reverse($terms);
					}

					if ($query['order_by'] == 'rand') {
						shuffle($terms);
					}

					foreach ($terms as $term) {

						$exclude = ($query['exclude'] == '' ? array() : explode(',', preg_replace('/\s+/', '', strtr($query['exclude'], array(
							'{{b_current}}' => get_the_ID()
						)))));

						if (count($exclude) > 0 && in_array($term->term_id, $exclude)) {
							continue;
						}

						$term_id = $term->term_id;

						$temp = '<div class="{{oddeven}}'.(($settings['height'] == 'yes') ? 'auto-height ' : '').'elementor-column elementor-col-'.round(100/$settings['columns']['size']).'" data-id="'.$taxonomy.'-'.$term->term_id.'">';

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

						include(get_stylesheet_directory().'/elementor.php');

						if (isset($b_query)) {
							$replacements = array_merge($replacements, $b_query);
						}

						if ($settings['even_content'] == 'yes' && ($i % 2 == 0)) {
							$temp .= strtr($settings['raw_content_even'], $replacements);
						} else {
							$temp .= strtr($settings['raw_content'], $replacements);
						}

						$temp .= '</div>';

						$temp = preg_replace_callback("/{{b_meta-([a-z_-]+)}}/", function($matches) use ($term_id) {
							return get_term_meta($term_id, $matches[1], true);
						}, $temp);

						array_push($wrapper, array('name' => $term->name, 'date' => '', 'content' => $temp));

					}

					break;

				case 'custom':

					$object = $query['selection'];

					if (term_exists((int)$object)) {

						$term = get_term((int)$object);

						$term_id = $term->term_id;

						$temp = '<div class="{{oddeven}}'.(($settings['height'] == 'yes') ? 'auto-height ' : '').'elementor-column elementor-col-'.round(100/$settings['columns']['size']).'" data-id="'.$term->taxonomy.'-'.$term->term_id.'">';

						$replacements = array(
							'{{b_title}}' => $term->name,
							'{{b_permalink}}' => get_term_link($term_id),
							'{{b_date}}' => '',
							'{{b_image}}' => b_f_i_sanitize_text_field(get_term_meta($term_id, '_term-featured-image', true)),
							'{{b_content}}' => term_description($term_id)
						);

						if ($term->taxonomy == 'product_cat') {
							$replacements['{{b_image}}'] = wp_get_attachment_image_src(get_term_meta($term_id, 'thumbnail_id', true), 'medium', true)[0];
						}

						include(get_stylesheet_directory().'/elementor.php');

						if (isset($b_query)) {
							$replacements = array_merge($replacements, $b_query);
						}

						if ($settings['even_content'] == 'yes' && ($i % 2 == 0)) {
							$temp .= strtr($settings['raw_content_even'], $replacements);
						} else {
							$temp .= strtr($settings['raw_content'], $replacements);
						}

						$temp .= '</div>';

						$temp = preg_replace_callback("/{{b_meta-([a-z_-]+)}}/", function($matches) use ($term_id) {
							return get_term_meta($term_id, $matches[1], true);
						}, $temp);

						array_push($wrapper, array('name' => $term->name, 'date' => '', 'content' => $temp));

					} else {

						$temp = '<div class="{{oddeven}}'.(($settings['height'] == 'yes') ? 'auto-height ' : '').'elementor-column elementor-col-'.round(100/$settings['columns']['size']).'" data-id="'.get_post_type($object).'-'.$object.'">';

						$replacements = array(
							'{{b_title}}' => get_the_title($object),
							'{{b_permalink}}' => get_permalink($object),
							'{{b_date}}' => get_the_date(b_f_option('b_opt_blog-date-es'), $object),
							'{{b_image}}' => wp_get_attachment_image_src(get_post_thumbnail_id($object), 'medium', true)[0],
							'{{b_content}}' => get_the_content($object)
						);

						include(get_stylesheet_directory().'/elementor.php');

						if (isset($b_query)) {
							$replacements = array_merge($replacements, $b_query);
						}

						if ($settings['even_content'] == 'yes' && ($i % 2 == 0)) {
							$temp .= strtr($settings['raw_content_even'], $replacements);
						} else {
							$temp .= strtr($settings['raw_content'], $replacements);
						}

						$temp .= '</div>';

						$temp = preg_replace_callback("/{{b_meta-([a-z_-]+)}}/", function($matches) use($object) {
							return get_post_meta($object, $matches[1], true);
						}, $temp);

						$temp = preg_replace_callback("/{{b_tax_name-([a-z_-]+)}}/", function($matches) use($object) {
							$terms = array();
							foreach (wp_get_post_terms($object, $matches[1]) as $term) {
								array_push($terms, $term->name);
							}
							return implode(', ', $terms);
						}, $temp);

						$temp = preg_replace_callback("/{{b_tax-([a-z_-]+)}}/", function($matches) use($object) {
							$terms = array();
							foreach (wp_get_post_terms($object, $matches[1]) as $term) {
								array_push($terms, '<a href="'.get_term_link($term).'" data-term_id="'.$term->term_id.'">'.$term->name.'</a>');
							}
							return implode(', ', $terms);
						}, $temp);

						$temp = preg_replace_callback("/{{b_excerpt(-)?([0-9]+)?}}/", function($matches) use($object) {
							if (!isset($matches[2])) {
								$matches[2] = 50;
							}
							return wp_trim_words(get_the_content($object), $matches[2]);
						}, $temp);

						array_push($wrapper, array('name' => get_the_title($object), 'date' => get_the_date('Ymd', $object), 'content' => $temp));

					}

					break;

			}


		}

		$wrapper = b_f_array_unique($wrapper);

		if (in_array($settings['orderby'], array('date', 'name'))) {
			usort($wrapper, function($a, $b) {
				return $a[$settings['order']] <=> $b[$settings['order']];
			});
		}

		if ($settings['orderby'] == 'rand') {
			shuffle($wrapper);
		}

		if ($settings['order'] != 'yes' && $settings['orderby'] != 'custom') {
			$wrapper = array_reverse($wrapper);
		}

		$i = $j = 0;

		$paged = (is_integer(end(explode('/', trim($_SERVER['PHP_SELF'], '/')))) ? end(explode('/', trim($_SERVER['PHP_SELF'], '/'))) : 1);

		foreach ($wrapper as $element) {

			if ($settings['pagination'] == 'yes') {
				if ($i > ($settings['number']*($paged-1)) && $i <= ($settings['number']*$paged)) {
					$oddeven = (($j % 2 == 0) ? 'even ' : 'odd ');
					$out .= str_replace('{{oddeven}}', $oddeven, $element['content']);
					$j++;

				}
			} else {
				$oddeven = (($j % 2 == 0) ? 'even ' : 'odd ');
				$out .= str_replace('{{oddeven}}', $oddeven, $element['content']);
				$j++;
			}

			$i++;

		}

		if ($settings['pagination'] == 'yes' && $settings['number'] > 0) {

			$args = array(
				'base' => get_permalink().'/%_%',
				'format' => '%#%',
				'current' => $paged,
				'total' => (count($wrapper)/$settings['number']),
			);

			$out .= '</div><div class="elementor-row b_pagination">'.paginate_links($args).'</div>';

		}

		echo $out;
	}

	}

	protected function content_template() {

	}
}
