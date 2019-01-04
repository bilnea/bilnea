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

		global $b_g_language;

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

					$i = 1;

					if ($query->have_posts()) {

						while ($query->have_posts()) {

							$query->the_post();

							array_push($wrapper, array(
								'name' => get_the_title(),
								'date' => get_the_date('Ymd'),
								'odd' => b_i_f_content_replace_query($settings['raw_content'], get_the_ID()),
								'even' => b_i_f_content_replace_query($settings['raw_content_even'], get_the_ID()),
								'id' => get_post_type().'-'.get_the_ID()
							));

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

						array_push($wrapper, array(
							'name' => $term->name,
							'date' => '',
							'odd' => b_i_f_content_replace_tax($settings['raw_content'], $term_id),
							'even' => b_i_f_content_replace_tax($settings['raw_content_even'], $term_id),
							'id' => $taxonomy.'-'.$term->term_id
						));

					}

					break;

				case 'custom':

					$object = $query['selection'];

					if (term_exists((int)$object)) {

						$term = get_term((int)$object);

						$term_id = $term->term_id;

						array_push($wrapper, array(
							'name' => $term->name,
							'date' => '',
							'odd' => b_i_f_content_replace_tax($settings['raw_content'], $term_id),
							'even' => b_i_f_content_replace_tax($settings['raw_content_even'], $term_id),
							'id' => $taxonomy.'-'.$term->term_id
						));

					} else {

						array_push($wrapper, array(
							'name' => get_the_title(),
							'date' => get_the_date('Ymd'),
							'odd' => b_i_f_content_replace_query($settings['raw_content'], $object),
							'even' => b_i_f_content_replace_query($settings['raw_content_even'], $object),
							'id' => get_post_type().'-'.$object
						));

					}

					break;

			}


		}

		$wrapper = b_f_array_unique($wrapper);

		if ($settings['orderby'] == 'rand') {
			shuffle($wrapper);
		}

		if ($settings['order'] != 'yes' && $settings['orderby'] != 'custom') {
			$wrapper = array_reverse($wrapper);
		}

		$i = $j = 1;

		$paged = (is_integer(end(explode('/', trim($_SERVER['PHP_SELF'], '/')))) ? end(explode('/', trim($_SERVER['PHP_SELF'], '/'))) : 1);

		foreach ($wrapper as $element) {

			if ($i <= $settings['number']*$paged && $i > $settings['nummber']*($paged-1)) {

				$oddeven = 'odd ';

				if ($settings['even_content'] == 'yes') {
					$oddeven = (($j % 2 == 0) ? 'even ' : 'odd ');
				}

				if ($settings['pagination'] == 'yes') {

					if ($i > ($settings['number']*($paged-1)) && $i <= ($settings['number']*$paged)) {

						$out .= '<div class="'.$oddeven.(($settings['height'] == 'yes') ? 'auto-height ' : '').'elementor-column elementor-col-'.round(100/$settings['columns']['size']).'" data-id="'.$element['id'].'">'.$element[trim($oddeven)].'</div>';

						$j++;

					}

				} else {

					$out .= '<div class="'.$oddeven.(($settings['height'] == 'yes') ? 'auto-height ' : '').'elementor-column elementor-col-'.round(100/$settings['columns']['size']).'" data-id="'.$element['id'].'">'.$element[trim($oddeven)].'</div>';

					$j++;

				}

			}

			$i++;

		}

		if ($settings['pagination'] == 'yes' && $settings['number'] > 0) {

			$args = array(
				'base' => get_permalink().'/%_%',
				'format' => '%#%',
				'current' => $paged,
				'total' => ceil(count($wrapper)/$settings['number']),
			);

			$out .= '</div><div class="elementor-row b_pagination">'.paginate_links($args).'</div>';

		}

		echo $out;
	}

	}

	protected function content_template() {

	}
}
