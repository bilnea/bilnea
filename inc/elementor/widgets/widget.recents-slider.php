<?php

namespace Elementorbilnea\Widgets;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

if (! defined('ABSPATH')) {
	exit;
}

class bilnea_Recent_Slider extends Widget_Base {

	public function get_name() {
		return 'bilnea_recents_slider';
	}

	public function get_title() {
		return __('Recent posts slider', 'bilnea');
	}

	public function get_icon() {
		return 'eicon-slideshow';
	}

	public function get_categories() {
		return ['bilnea'];
	}

	public function get_script_depends() {
		return ['imagesloaded', 'jquery-slick'];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_slider_query',
			[
				'label' => __('Query', 'bilnea'),
				'type' => Controls_Manager::SECTION,
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

		$this->end_controls_section();

		$this->start_controls_section(
			'section_slides',
			[
				'label' => __('Slides', 'bilnea'),
			]
		);

		$this->start_controls_tabs('slides_repeater');

		$this->start_controls_tab('background', ['label' => __('Background', 'bilnea')]);

		$this->add_control(
			'background_color',
			[
				'label' => __('Color', 'bilnea'),
				'type' => Controls_Manager::COLOR,
				'default' => '#bbbbbb',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-bg' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'background_image',
			[
				'label' => __('Image', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes'
			]
		);

		$this->add_control(
			'background_size',
			[
				'label' => __('Background size', 'bilnea'),
				'type' => Controls_Manager::SELECT,
				'default' => 'cover',
				'options' => [
					'cover' => __('Cover', 'bilnea'),
					'contain' => __('Contain', 'bilnea'),
					'auto' => __('Auto', 'bilnea'),
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-bg' => 'background-size: {{VALUE}}',
				],
				'condition' => [
					'background_image' => 'yes',
				],
			]
		);

		$this->add_control(
			'background_overlay',
			[
				'label' => __('Background Overlay', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => '',
				'separator' => 'before',
				'condition' => [
					'background_image' => 'yes',
				],
			]
		);

		$this->add_control(
			'background_overlay_color',
			[
				'label' => __('Color', 'bilnea'),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(0,0,0,0.5)',
				'condition' => [
					'background_image' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-inner .elementor-background-overlay' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'background_animation',
			[
				'label' => __('Animation', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => '',
				'separator' => 'before',
				'condition' => [
					'background_image' => 'yes',
				],
			]
		);

		$this->add_control(
			'zoom_direction',
			[
				'label' => __('Type', 'bilnea'),
				'type' => Controls_Manager::SELECT,
				'default' => 'in',
				'options' => [
					'in' => __('Zoom in', 'bilnea'),
					'out' => __('Zoom out', 'bilnea'),
				],
				'condition' => [
					'background_image' => 'yes',
				],
			]
		);

		$this->add_control(
			'background_parallax',
			[
				'label' => __('Parallax', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => '',
				'separator' => 'before',
				'condition' => [
					'background_image' => 'yes',
				],
			]
		);

		$this->add_control(
			'parallax_value',
			[
				'label' => __('Parallax speed', 'bilnea'),
				'type' => Controls_Manager::NUMBER,
				'default' => 0.2,
				'min' => 0,
				'max' => 10,
				'step' => 0.1,
				'condition' => [
					'background_parallax' => 'yes',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab('content_wrap', ['label' => __('Content', 'bilnea')]);

		$this->add_control(
			'slider_content',
			[
				'label' => sprintf(__('You can use the followings snippets %s', 'bilnea'), implode(', ', array('{{b_title}}', '{{b_permalink}}', '{{b_title}}', '{{b_link}}', '{{b_date}}', '{{b_image}}', '{{b_excerpt}}'))),
				'type' => Controls_Manager::CODE,
				'default' => '',
				'placeholder' => __('Enter your enhaced content here', 'bilnea'),
				'show_label' => true,
			]
		);

		$this->add_control(
			'full_link',
			[
				'label' => __('Link', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => '',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'horizontal_position',
			[
				'label' => __('Horizontal Position', 'bilnea'),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => __('Left', 'bilnea'),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __('Center', 'bilnea'),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => __('Right', 'bilnea'),
						'icon' => 'eicon-h-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-inner .elementor-slide-content' => '{{VALUE}}',
				],
				'selectors_dictionary' => [
					'left' => 'margin-right: auto',
					'center' => 'margin: 0 auto',
					'right' => 'margin-left: auto',
				],
			]
		);

		$this->add_control(
			'vertical_position',
			[
				'label' => __('Vertical Position', 'bilnea'),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'top' => [
						'title' => __('Top', 'bilnea'),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __('Middle', 'bilnea'),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __('Bottom', 'bilnea'),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-inner' => 'align-items: {{VALUE}}',
				],
				'selectors_dictionary' => [
					'top' => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				],
			]
		);

		$this->add_control(
			'text_align',
			[
				'label' => __('Text Align', 'bilnea'),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => __('Left', 'bilnea'),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __('Center', 'bilnea'),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __('Right', 'bilnea'),
						'icon' => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-inner' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'slides_height',
			[
				'label' => __('Height', 'bilnea'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1000,
					],
					'vh' => [
						'min' => 10,
						'max' => 100,
					],
					'vw' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 400,
				],
				'size_units' => ['px', 'vh', 'em'],
				'selectors' => [
					'{{WRAPPER}} .slick-slide' => 'height: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_slider_options',
			[
				'label' => __('Slider Options', 'bilnea'),
				'type' => Controls_Manager::SECTION,
			]
		);

		$this->add_control(
			'navigation',
			[
				'label' => __('Navigation', 'bilnea'),
				'type' => Controls_Manager::SELECT,
				'default' => 'both',
				'options' => [
					'both' => __('Arrows and Dots', 'bilnea'),
					'arrows' => __('Arrows', 'bilnea'),
					'dots' => __('Dots', 'bilnea'),
					'none' => __('None', 'bilnea'),
				],
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label' => __('Pause on Hover', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label' => __('Autoplay', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label' => __('Autoplay Speed', 'bilnea'),
				'type' => Controls_Manager::NUMBER,
				'default' => 5000,
				'condition' => [
					'autoplay' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .slick-slide-bg' => 'animation-duration: calc({{VALUE}}ms*1.2); transition-duration: calc({{VALUE}}ms)',
				],
			]
		);

		$this->add_control(
			'infinite',
			[
				'label' => __('Infinite Loop', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'transition',
			[
				'label' => __('Transition', 'bilnea'),
				'type' => Controls_Manager::SELECT,
				'default' => 'slide',
				'options' => [
					'slide' => __('Slide', 'bilnea'),
					'fade' => __('Fade', 'bilnea'),
				],
			]
		);

		$this->add_control(
			'transition_speed',
			[
				'label' => __('Transition Speed (ms)', 'bilnea'),
				'type' => Controls_Manager::NUMBER,
				'default' => 500,
			]
		);

		$this->add_control(
			'content_animation',
			[
				'label' => __('Content Animation', 'bilnea'),
				'type' => Controls_Manager::SELECT,
				'default' => 'fadeInUp',
				'options' => [
					'' => __('None', 'bilnea'),
					'fadeInDown' => __('Down', 'bilnea'),
					'fadeInUp' => __('Up', 'bilnea'),
					'fadeInRight' => __('Right', 'bilnea'),
					'fadeInLeft' => __('Left', 'bilnea'),
					'zoomIn' => __('Zoom', 'bilnea'),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_slides',
			[
				'label' => __('Slides', 'bilnea'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'content_max_width',
			[
				'label' => __('Content Width', 'bilnea'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => ['%', 'px'],
				'default' => [
					'size' => '100',
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-slide-content' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'slides_padding',
			[
				'label' => __('Padding', 'bilnea'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .slick-slide-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'slides_horizontal_position',
			[
				'label' => __('Horizontal Position', 'bilnea'),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'default' => 'center',
				'options' => [
					'left' => [
						'title' => __('Left', 'bilnea'),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __('Center', 'bilnea'),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => __('Right', 'bilnea'),
						'icon' => 'eicon-h-align-right',
					],
				],
			]
		);

		$this->add_control(
			'slides_vertical_position',
			[
				'label' => __('Vertical Position', 'bilnea'),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'default' => 'middle',
				'options' => [
					'top' => [
						'title' => __('Top', 'bilnea'),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __('Middle', 'bilnea'),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __('Bottom', 'bilnea'),
						'icon' => 'eicon-v-align-bottom',
					],
				],
			]
		);

		$this->add_control(
			'slides_text_align',
			[
				'label' => __('Text Align', 'bilnea'),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => __('Left', 'bilnea'),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __('Center', 'bilnea'),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __('Right', 'bilnea'),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .slick-slide-inner' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_navigation',
			[
				'label' => __('Navigation', 'bilnea'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'navigation' => ['arrows', 'dots', 'both'],
				],
			]
		);

		$this->add_control(
			'heading_style_arrows',
			[
				'label' => __('Arrows', 'bilnea'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'navigation' => ['arrows', 'both'],
				],
			]
		);

		$this->add_control(
			'arrows_position',
			[
				'label' => __('Arrows Position', 'bilnea'),
				'type' => Controls_Manager::SELECT,
				'default' => 'inside',
				'options' => [
					'inside' => __('Inside', 'bilnea'),
					'outside' => __('Outside', 'bilnea'),
				],
				'condition' => [
					'navigation' => ['arrows', 'both'],
				],
			]
		);

		$this->add_control(
			'arrows_size',
			[
				'label' => __('Arrows Size', 'bilnea'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 60,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-slides-wrapper .slick-slider .slick-prev:before, {{WRAPPER}} .elementor-slides-wrapper .slick-slider .slick-next:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => ['arrows', 'both'],
				],
			]
		);

		$this->add_control(
			'arrows_color',
			[
				'label' => __('Arrows Color', 'bilnea'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-slides-wrapper .slick-slider .slick-prev:before, {{WRAPPER}} .elementor-slides-wrapper .slick-slider .slick-next:before' => 'color: {{VALUE}};',
				],
				'condition' => [
					'navigation' => ['arrows', 'both'],
				],
			]
		);

		$this->add_control(
			'heading_style_dots',
			[
				'label' => __('Dots', 'bilnea'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'navigation' => ['dots', 'both'],
				],
			]
		);

		$this->add_control(
			'dots_position',
			[
				'label' => __('Dots Position', 'bilnea'),
				'type' => Controls_Manager::SELECT,
				'default' => 'inside',
				'options' => [
					'outside' => __('Outside', 'bilnea'),
					'inside' => __('Inside', 'bilnea'),
				],
				'condition' => [
					'navigation' => ['dots', 'both'],
				],
			]
		);

		$this->add_control(
			'dots_size',
			[
				'label' => __('Dots Size', 'bilnea'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 15,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-slides-wrapper .elementor-slides .slick-dots li button:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => ['dots', 'both'],
				],
			]
		);

		$this->add_control(
			'dots_color',
			[
				'label' => __('Dots Color', 'bilnea'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-slides-wrapper .elementor-slides .slick-dots li button:before' => 'color: {{VALUE}};',
				],
				'condition' => [
					'navigation' => ['dots', 'both'],
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings();

		wp_enqueue_style('elementor.slider', get_template_directory_uri().'/css/internal/elementor.slider.css', array(), b_f_versions());
		wp_enqueue_script('elementor.slider', get_template_directory_uri().'/js/internal/elementor.slider.js', ['jquery'], b_f_versions(), true);

		$slides = [];
		$slide_count = 0;

		$args = array(
			'post_type' => array($settings['post_type']),
			'post_status' => array('publish'),
			'orderby' => $settings['order_by'],
			'posts_per_page' => $settings['number'],
		);

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
				$slide_html = $slide_attributes = '';
				$btn_element = $slide_element = 'div';

				if ($settings['full_link'] == 'yes') {
					$this->add_render_attribute('slide_link'.$slide_count , 'href', get_permalink());

					$slide_element = 'a';
					$slide_attributes = $this->get_render_attribute_string('slide_link'.$slide_count);
				}

				if ($settings['background_overlay'] == 'yes') {
					$slide_html .= '<div class="elementor-background-overlay"></div>';
				}

				$replacements = array(
					'{{b_title}}' => get_the_title(),
					'{{b_permalink}}' => get_permalink(),
					'{{b_link}}' => get_permalink(),
					'{{b_date}}' => get_the_date(get_option('date_format()')),
					'{{b_image}}' => wp_get_attachment_image_src(get_post_thumbnail_id(), 'full', true)[0],
					'{{b_content}}' => get_the_content()
				);

				include(get_stylesheet_directory().'/elementor.php');

				if (isset($b_recents_slider)) {
					$replacements = array_merge($replacements, $b_recents_slider);
				}

				$content = strtr($settings['slider_content'], $replacements);

				$post_id = get_the_ID();

				$content = preg_replace_callback("/{{b_meta-([a-z_-]+)}}/", function($matches) use($post_id) {
					return get_post_meta($post_id, $matches[1], true);
				}, $content);

				$content = preg_replace_callback("/{{b_excerpt(-)?([0-9]+)?}}/", function($matches) use($post_id) {
					if (!isset($matches[2])) {
						$matches[2] = 50;
					}
					return wp_trim_words(get_the_content($post_id), $matches[2]);
				}, $content);

				$content = preg_replace_callback("/{{b_tax-([a-z]+)}}/", function($matches) use($post_id) {
					$terms = array();
					foreach (wp_get_post_terms($post_id, $matches[1]) as $term) {
						array_push($terms, '<a href="'.get_term_link($term).'" data-term_id="'.$term->term_id.'">'.$term->name.'</a>');
					}
					return implode(', ', $terms);
				}, $content);

				$content = preg_replace_callback("/{{b_tax_name-([a-z]+)}}/", function($matches) use($post_id) {
					$terms = array();
					foreach (wp_get_post_terms($post_id, $matches[1]) as $term) {
						array_push($terms, $term->name);
					}
					return implode(', ', $terms);
				}, $content);

				$slide_html .= '<div class="elementor-slide-content"><div class="elementor-slide-description">'.$content.'</div>';

				$ken_class = '';

				if ('' != $settings['background_animation']) {
					$ken_class = ' elementor-ken-'.$settings['zoom_direction'];
				}

				$back_image = '';

				if ('' != $settings['background_image']) {
					$back_image = ' style="background-image: url('.wp_get_attachment_image_src(get_post_thumbnail_id(), 'full', true)[0].');"';
				}

				$slide_html .= '</div>';
				$slide_html = '<div class="slick-slide-bg'.$ken_class.' elementor--h-position-'.$settings['horizontal_position'].' elementor--v-position-'.$settings['vertical_position'].'"'.$back_image.'></div><'.$slide_element.' '.$slide_attributes.' class="slick-slide-inner">'.$slide_html.'</'.$slide_element.'>';
				$slide_html = preg_replace_callback("/{{b_tax-([a-z-_]+)}}/", function($matches) use($post_id) {
					$terms = array();
					foreach (wp_get_post_terms($post_id, $matches[1]) as $term) {
						array_push($terms, '<a href="'.get_term_link($term).'" data-term_id="'.$term->term_id.'">'.$term->name.'</a>');
					}
					return implode(', ', $terms);
				}, $slide_html);
				$slide_html = preg_replace_callback("/{{b_tax_name-([a-z-_]+)}}/", function($matches) use($post_id) {
					$terms = array();
					foreach (wp_get_post_terms($post_id, $matches[1]) as $term) {
						array_push($terms, $term->name);
					}
					return implode(', ', $terms);
				}, $slide_html);
				$slides[] = '<div class="elementor-repeater-item-'.get_the_ID().' slick-slide">'.$slide_html.'</div>';
				$slide_count++;
			}
			wp_reset_postdata();
		}

		$is_rtl = is_rtl();
		$direction = $is_rtl ? 'rtl' : 'ltr';
		$show_dots = (in_array($settings['navigation'], ['dots', 'both']));
		$show_arrows = (in_array($settings['navigation'], ['arrows', 'both']));

		$slick_options = [
			'slidesToShow' => absint(1),
			'autoplaySpeed' => absint($settings['autoplay_speed']),
			'autoplay' => ('yes' === $settings['autoplay']),
			'infinite' => ('yes' === $settings['infinite']),
			'pauseOnHover' => ('yes' === $settings['pause_on_hover']),
			'speed' => absint($settings['transition_speed']),
			'arrows' => $show_arrows,
			'dots' => $show_dots,
			'rtl' => $is_rtl,
		];

		if ('fade' === $settings['transition']) {
			$slick_options['fade'] = true;
		}

		$carousel_classes = ['elementor-slides'];

		if ($show_arrows) {
			$carousel_classes[] = 'slick-arrows-'.$settings['arrows_position'];
		}

		if ($show_dots) {
			$carousel_classes[] = 'slick-dots-'.$settings['dots_position'];
		}

		$this->add_render_attribute('slides', [
			'class' => $carousel_classes,
			'data-slider_options' => wp_json_encode($slick_options),
			'data-animation' => $settings['content_animation'],
		]);

		?>
		<div class="elementor-slides-wrapper elementor-slick-slider" dir="<?php echo $direction; ?>">
			<div <?php echo $this->get_render_attribute_string('slides'); ?>>
				<?php echo implode('', $slides); ?>
			</div>
		</div>
		<?php
	}

	protected function content_template() {

	}
}
