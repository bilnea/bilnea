<?php
namespace Elementorbilnea\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Scheme_Typography;
use Elementor\Widget_Base;

if (! defined('ABSPATH')) exit;

class bilnea_Blog extends Widget_Base {

	public function get_name() {
		return 'bilnea_blog';
	}

	public function get_title() {
		return __('Blog', 'bilnea');
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
				'label' => __('Blog', 'bilnea'),
			]
		);

		$this->start_controls_tabs('recent_post');

		$this->start_controls_tab('config', ['label' => __('Configuration', 'bilnea')]);

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
				]
			]
		);

		$this->add_control(
			'offset',
			[
				'label' => __('Offset', 'bilnea'),
				'type' => Controls_Manager::NUMBER,
				'default' => 0,
			]
		);

		$this->add_control(
			'number',
			[
				'label' => __('Posts per page', 'bilnea'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 5,
				],
				'range' => [
					'min' => 1,
					'max' => 10,
				],
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
			'complex',
			[
				'label' => __('Complex Query', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => '',
				'separator' => 'before',
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
				'default' => 'AND',
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
				'default' => 'AND',
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
				'label' => sprintf(__('You can use the followings snippets %s', 'bilnea'), implode(', ', array('{{b_title}}', '{{b_permalink}}, {{b_title}}', '{{b_link}}', '{{b_date}}', '{{b_image}}', '{{b_excerpt}}'))),
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

		$settings = $this->get_settings();

		$out = '<div class="elementor-bilnea-blog"><div class="elementor-row">';

		$args = array(
			'post_type' => array($settings['post_type']),
			'post_status' => array('publish'),
			'orderby' => $settings['order_by'],
			'posts_per_page' => $settings['number']['size'],
		);

		$paged = intval(end(explode('/', trim(explode('?', $_SERVER[REQUEST_URI])[0], '/'))));

		if ($paged == 0) {
			$paged = 1;
			$args['offset'] = $settings['offset'];
		} else {
			$args['offset'] = $settings['offset']+(($paged-1)*$settings['number']['size']);
		}

		$i = 1;

		$tax = array();
		$meta = array();

		foreach ($settings['queries'] as $query) {
			switch ($query['type']) {
				case 'tax':
					$keys = array(
						'{{b_current_tax-id}}'
					);
					$replaces = array(
						get_queried_object()->term_id
					);
					$temp = array('taxonomy' => strtolower($query['taxonomy']), 'field' => strtolower($query['field']), 'terms' => str_replace($keys, $replaces, explode(',', preg_replace('/\s+/', '', $query['terms']))));
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

		$query = new \WP_Query($args);

		if ($query->have_posts()) {

			while ($query->have_posts()) {

				$query->the_post();

				$post_id = get_the_ID();

				$temp = '<div class="'.(($i % 2 == 0) ? 'even ' : 'odd ').(($settings['height'] == 'yes') ? 'auto-height ' : '').'elementor-column elementor-col-'.round(100/$settings['columns']['size']).'" data-id="'.get_post_type().'-'.$post_id.'">';

				$replacements = array(
					'{{b_title}}' => get_the_title(),
					'{{b_permalink}}' => get_permalink(),
					'{{b_date}}' => get_the_date(b_f_option('b_opt_blog-date-es')),
					'{{b_image}}' => wp_get_attachment_image_src(get_post_thumbnail_id(),'medium', true)[0],
					'{{b_content}}' => get_the_content()
				);

				include(get_stylesheet_directory().'/elementor.php');

				if (isset($b_blog)) {
					$replacements = array_merge($replacements, $b_blog);
				}

				if ($settings['even_content'] == 'yes' && ($i % 2 == 0)) {
					$temp .= strtr($settings['raw_content_even'], $replacements);
				} else {
					$temp .= strtr($settings['raw_content'], $replacements);
				}

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

				$temp .= '</div>';

				if ($i%$settings['columns']['size'] == 0) {
					$temp .= '</div><div class="elementor-row">';
				}

				$i++;

				$out .= $temp;

			}

		}

		wp_reset_postdata();

		$args['posts_per_page'] = -1;
		$args['offset'] = 0;

		if ($settings['number']['size'] > 0) {
			$ppage = $settings['number']['size'];
		} else {
			$ppage = 1;
		}

		$total = (count(get_posts($args)) - $settings['offset'])/$ppage;

		$args = array(
			'base' => get_permalink().'%_%',
			'format' => '%#%',
			'current' => $paged,
			'total' => $total,
		);

		$out .= '</div><div class="elementor-row b_pagination">'.paginate_links($args).'</div>';

		echo $out;
		
	}

	protected function content_template() {
		
	}
}
