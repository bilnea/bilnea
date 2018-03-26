<?php
namespace Elementorbilnea\Widgets;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

if (! defined('ABSPATH')) exit;

class bilnea_Elementor extends Widget_Base {

	public function get_name() {
		return 'bilnea_elementor';
	}

	public function get_title() {
		return __('Elementor widget', 'bilnea');
	}

	public function get_icon() {
		return 'eicon-parallax';
	}

	public function get_categories() {
		return ['bilnea'];
	}

	public function get_script_depends() {
		return [];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'widget_selector',
			[
				'label' => __('Widget', 'bilnea'),
			]
		);

		$widgets = array();

		$args = array(
			'post_type' => 'elementor_library',
			'post_status' => 'publish',
			'posts_per_page' => -1,
			'orderby' => 'title',
		);

		foreach (get_posts($args) as $post) {
			$widgets[$post->ID] = $post->post_title;
		}

		$this->add_control(
			'widget',
			[
				'label' => __('Widget', 'bilnea'),
				'type' => Controls_Manager::SELECT,
				'default' => key($widgets),
				'options' => $widgets,
			]
		);

		$this->end_controls_section();
		
	}

	protected function render() {

		$settings = $this->get_settings();

		echo do_shortcode('[b_elementor id="'.$settings['widget'].'"]');
		
	}

	protected function content_template() {
		
	}
}
