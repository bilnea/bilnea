<?php
namespace Elementorbilnea\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Scheme_Typography;
use Elementor\Widget_Base;

if (! defined('ABSPATH')) exit;

class bilnea_Menu extends Widget_Base {

	public function get_name() {
		return 'bilnea_menu';
	}

	public function get_title() {
		return __('Menu', 'bilnea');
	}

	public function get_icon() {
		return 'eicon-nav-menu';
	}

	public function get_categories() {
		return ['bilnea'];
	}

	public function get_script_depends() {
		return [];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'settings',
			[
				'label' => __('Menu', 'bilnea'),
			]
		);

		$types = array();

		foreach (wp_get_nav_menus(array('orderby' => 'name')) as $menu) {
			$types[$menu->term_id] = __($menu->name);
		}

		foreach (get_registered_nav_menus() as $menu => $name) {
			$value = 'loc_'.$menu;
			if (function_exists('pll_languages_list')) {
				foreach (get_terms(array('taxonomy' => 'term_language', 'hide_empty' => false)) as $language) {
					if (pll_current_language() != str_replace('pll_', '', $language->slug)) {
						$types[$value.'___'.str_replace('pll_', '', $language->slug)] = $name.' ('.$language->name.')';
					} else {
						$types[$value] = $name.' ('.$language->name.')';
					}
				}
			} else {
				$types[$value] = $name;
			}
		}

		reset($types);

		$this->add_control(
			'menu',
			[
				'label' => __('Select menu', 'bilnea'),
				'type' => Controls_Manager::SELECT,
				'default' => key($types),
				'options' => $types,
				'separator' => 'after'
			]
		);

		$this->add_control(
			'align',
			[
				'label' => __('Alignment', 'bilnea'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => __( 'Left', 'bilnea' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'bilnea' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'bilnea' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'prefix_class' => 'elementor-align-',
				'default' => 'left',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'main_style',
			[
				'label' => __('Main menu', 'bilnea'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'menu_color',
			[
				'label' => __('Text Color', 'bilnea'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} ul[class*="menu"] > li > a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} ul[class*="menu"] > li > a',
			]
		);

		$this->add_control(
			'padding',
			[
				'label' => __('Padding element', 'bilnea'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} ul[class*="menu"] > li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'margin',
			[
				'label' => __('Margin element', 'bilnea'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} ul[class*="menu"] > li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings();

		if (substr($settings['menu'], 0, 4) == 'loc_') {
			$args = array('theme_location' => substr($settings['menu'], 4));
		} else {
			$args = array('menu' => $settings['menu']);
		}

		echo wp_nav_menu($args);

	}

	protected function content_template() {

	}
}
