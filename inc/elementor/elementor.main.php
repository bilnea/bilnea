<?php

namespace Elementorbilnea;

if (! defined('ABSPATH')) {
	exit;
}

use Elementorbilnea\Widgets\bilnea_Blog;
use Elementorbilnea\Widgets\bilnea_Breadcrumb;
use Elementorbilnea\Widgets\bilnea_Form;
use Elementorbilnea\Widgets\bilnea_Mailchimp;
use Elementorbilnea\Widgets\bilnea_Map;
use Elementorbilnea\Widgets\bilnea_Recent;
use Elementorbilnea\Widgets\bilnea_Slider;
use Elementorbilnea\Widgets\bilnea_Taxonomies;

if (! defined('ABSPATH')) exit;

class Plugin {

	public function __construct() {
		$this->add_actions();
	}

	private function add_actions() {
		add_action('elementor/widgets/widgets_registered', [$this, 'on_widgets_registered']);
		add_action('elementor/init', [$this, 'elementor_init']);
	}

	public function on_widgets_registered() {
		$this->includes();
		$this->register_widget();
	}

	private function includes() {
		b_f_include(get_template_directory().'/inc/elementor/widgets');
	}

	private function register_widget() {
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new bilnea_Blog());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new bilnea_Breadcrumb());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new bilnea_Form());
		if (b_f_option('b_opt_subscribers') == 1 && b_f_option('b_opt_newsl_service') == 'mailchimp') {
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new bilnea_Mailchimp());
		}
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new bilnea_Map());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new bilnea_Recent());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new bilnea_Slider());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new bilnea_Taxonomies());

	}

	public function elementor_init() {
		$elementor = \Elementor\Plugin::$instance;
		$elementor->elements_manager->add_category(
			'bilnea',
			[
				'title' => __('bilnea Widgets', 'bilnea'),
				'icon' => 'font',
			],
			1
		);
	}

}

new Plugin();