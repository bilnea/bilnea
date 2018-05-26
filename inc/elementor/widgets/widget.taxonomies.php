<?php
namespace Elementorbilnea\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (! defined('ABSPATH')) exit;

class bilnea_Taxonomies extends Widget_Base {

	public function get_name() {
		return 'bilnea_taxonomies';
	}

	public function get_title() {
		return __('Taxonomies', 'bilnea');
	}

	public function get_icon() {
		return 'eicon-bullet-list';
	}

	public function get_categories() {
		return ['bilnea'];
	}

	public function get_script_depends() {
		return [];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'Taxonomies',
			[
				'label' => __('Taxonomies', 'bilnea'),
			]
		);

		$types = array();

		unset($types['post_format']);

		foreach (get_taxonomies(array('public' => true), 'objects') as $taxonomy => $values) {
			$types[$taxonomy] = __($values->labels->name).' ('.implode(', ', $values->object_type).')';
		}

		$this->add_control(
			'taxonomy',
			[
				'label' => __('Taxonomy', 'bilnea'),
				'type' => Controls_Manager::SELECT,
				'default' => 'category',
				'options' => $types,
			]
		);

		$this->add_control(
			'show_all',
			[
				'label' => __('Show all', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'all',
			[
				'label' => __('"All" text', 'bilnea'),
				'type' => Controls_Manager::TEXT,
				'default' => __('All', 'bilnea'),
				'condition' => [
					'show_all' => 'yes'
				]
			]
		);

		$this->add_control(
			'url',
			[
				'label' => __('"All" url', 'bilnea'),
				'type' => Controls_Manager::URL,
				'placeholder' => __('http://your-link.com', 'bilnea'),
				'condition' => [
					'show_all' => 'yes'
				]
			]
		);

		$this->add_control(
			'exclude',
			[
				'label' => __('Exclude terms, comma separated', 'bilnea'),
				'type' => Controls_Manager::TEXT,
				'default' => '',
			]
		);

		$this->add_control(
			'show_empty',
			[
				'label' => __('Show empty', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'childrens',
			[
				'label' => __('Show childrens', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->end_controls_section();
		
	}

	protected function render() {

		$settings = $this->get_settings();

		$options = array(
			'taxonomy' => $settings['taxonomy'],
		);

		if ($settings['show_empty'] == 'yes') {
			$options['hide_empty'] = false;
		}

		if ($settings['show_all'] != 'yes') {
			$options['show_option_all'] = $settings['all'];
		}

		if ($settings['show_childrens'] != 'yes') {
			$options['parent'] = 0;
		}

		$out = '<div class="elementor-widget-bilnea-taxonomies"><ul>'."\n";

		if ($settings['show_all'] == 'yes') {
			$out .= '<li data-term_id="all" data-taxonomy="'.$settings['taxonomy'].'"><a href="'.$settings['url']['url'].'">'.$settings['all'].'</a></li>'."\n";
		}

		$exclude = explode(',', preg_replace('/\s+/', '', $settings['exclude']));

		foreach (get_terms($options) as $term) {
			if (!in_array($term->term_id, $exclude)) {
				$out .= '<li data-term_id="'.$term->term_id.'" data-taxonomy="'.$settings['taxonomy'].'"><a href="'.get_term_link($term).'">'.$term->name.'</a></li>'."\n";
			}
		}


		$out .= '</ul></div>';

		echo $out;
		
	}

	protected function content_template() {
		
	}
}
