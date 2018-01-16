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
			'number',
			[
				'label' => __('Posts to show', 'bilnea'),
				'type' => Controls_Manager::NUMBER,
				'default' => '3',
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
			'tax_query',
			[
				'label' => __('Taxonomy Query', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => '',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'taxonomy',
			[
				'label' => __('Taxonomy', 'bilnea'),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'condition' => [
					'tax_query' => 'yes',
				],
			]
		);

		$this->add_control(
			'tax_key',
			[
				'label' => __('Key', 'bilnea'),
				'type' => Controls_Manager::SELECT,
				'default' => 'slug',
				'options' => [
					'slug' => __('Term slug', 'bilnea'),
					'id' => __('Term ID', 'bilnea'),
				],
				'condition' => [
					'tax_query' => 'yes',
				],
			]
		);

		$this->add_control(
			'tax_value',
			[
				'label' => __('Values', 'bilnea'),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'condition' => [
					'tax_query' => 'yes',
				],
			]
		);

		$this->add_control(
			'tax_operator',
			[
				'label' => __('Operator', 'bilnea'),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'in',
				'options' => [
					'in' => [
						'title' => 'IN',
						'icon' => 'font',
					],
					'not' => [
						'title' => 'NOT IN',
						'icon' => 'font',
					],
				],
				'condition' => [
					'tax_query' => 'yes',
				],
			]
		);

		$this->add_control(
			'meta_query',
			[
				'label' => __('Meta Query', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => '',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'meta_tag',
			[
				'label' => __('Meta tag', 'bilnea'),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'condition' => [
					'meta_query' => 'yes',
				],
			]
		);

		$this->add_control(
			'meta_key',
			[
				'label' => __('Meta key', 'bilnea'),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'condition' => [
					'meta_query' => 'yes',
				],
			]
		);

		$this->add_control(
			'meta_value',
			[
				'label' => __('Meta value', 'bilnea'),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'condition' => [
					'meta_query' => 'yes',
				],
			]
		);

		$this->add_control(
			'meta_operator',
			[
				'label' => __('Operator', 'bilnea'),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'in',
				'options' => [
					'in' => [
						'title' => 'LIKE',
						'icon' => 'font',
					],
					'not' => [
						'title' => 'NOT LIKE',
						'icon' => 'font',
					],
				],
				'condition' => [
					'meta_query' => 'yes',
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

		$out = '<div class="elementor-bilnea-recents elementor-row">';

		$args = array(
			'post_type' => array($settings['post_type']),
			'post_status' => array('publish'),
			'orderby' => $settings['order_by'],
			'posts_per_page' => $settings['number'],
		);

		$i = 0;

		foreach (get_posts($args) as $post) {

			if ($i%$settings['columns'] == 0) {
				$out .= '</div><div class="elementor-bilnea-recents elementor-row">';
			}

			$temp = '<div class="elementor-column elementor-col-'.round(100/$settings['columns']).'" data-id="'.get_post_type($post->ID).'-'.$post->ID.'">';
			$shortcodes = array(
				'{{b_title}}',
				'{{b_permalink}}',
				'{{b_link}}',
				'{{b_date}}',
				'{{b_image}}',
				'{{b_excerpt}}');
			$replace = array(
				get_the_title($post->ID),
				get_permalink($post->ID),
				get_permalink($post->ID),
				get_the_date(b_f_option('b_opt_blog-date-es'), $post->ID),
				wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'medium', true)[0],
				wp_trim_words(get_the_content($post->ID))
			);
			$temp .= str_replace($shortcodes, $replace, $settings['raw_content']);
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

		$out .= '</div></div>';

		echo $out;
		
	}

	protected function content_template() {
		
	}
}
