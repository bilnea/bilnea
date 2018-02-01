<?php
namespace Elementorbilnea\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (! defined('ABSPATH')) exit;

class bilnea_Search extends Widget_Base {

	public function get_name() {
		return 'bilnea_search';
	}

	public function get_title() {
		return __('Search form', 'bilnea');
	}

	public function get_icon() {
		return 'eicon-search';
	}

	public function get_categories() {
		return ['bilnea'];
	}

	public function get_script_depends() {
		return [];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'breadcrumbs',
			[
				'label' => __('Search form', 'bilnea'),
			]
		);

		$this->add_control(
			'placeholder',
			[
				'label' => __('Placeholder', 'bilnea'),
				'type' => Controls_Manager::TEXT,
				'default' => __('Search', 'bilnea'),
			]
		);

		$this->add_control(
			'limit',
			[
				'label' => __('Limit search', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return' => 'yes',
				'default' => '',
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
			'types',
			[
				'label' => __('Limit search to:', 'bilnea'),
				'type' => Controls_Manager::SELECT2,
				'options' => $types,
				'multiple' => true,
				'separator' => 'before',
				'condition' => [
					'limit' => 'yes'
				]
			]
		);

		$this->end_controls_section();
		
	}

	protected function render() {

		$settings = $this->get_settings();

		if ($settings['limit'] == 'yes') {
			echo str_replace('</form>', '<input type="hidden" name="post_type" value="'.implode(',', $settings['types']).'"></form>', get_search_form(false));
		} else {
			get_search_form(false);
		}
		
	}

	protected function content_template() {
		
	}
}
