<?php
namespace Elementorbilnea\Widgets;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

if (! defined('ABSPATH')) exit;

class bilnea_Breadcrumb extends Widget_Base {

	public function get_name() {
		return 'bilnea_breadcrumbs';
	}

	public function get_title() {
		return __('Breadcrumb', 'bilnea');
	}

	public function get_icon() {
		return 'eicon-navigation-horizontal';
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
				'label' => __('Breadcrumbs', 'bilnea'),
			]
		);

		$this->add_control(
			'separator',
			[
				'label' => __('Separator', 'bilnea'),
				'type' => Controls_Manager::TEXT,
				'default' => '»',
			]
		);

		$this->add_control(
			'show_home',
			[
				'label' => __('Show home', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => '',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'home',
			[
				'label' => __('Home value', 'bilnea'),
				'type' => Controls_Manager::TEXT,
				'default' => __('Home', 'bilnea'),
				'condition' => [
					'show_home' => 'yes',
				],
			]
		);

		$this->add_control(
			'custom',
			[
				'label' => __('Custom breadcrumbs', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => '',
				'separator' => 'before',
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'name',
			[
				'label' => __('Name', 'bilnea'),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __('Text', 'bilnea'),
			]
		);

		$repeater->add_control(
			'url',
			[
				'label' => __('Url', 'bilnea'),
				'type' => Controls_Manager::URL,
				'placeholder' => __('http://your-link.com', 'bilnea'),
			]
		);

		$this->add_control(
			'slugs',
			[
				'label' => __('Breadcrumbs', 'bilnea'),
				'type' => Controls_Manager::REPEATER,
				'show_label' => true,
				'fields' => array_values($repeater->get_controls()),
				'condition' => [
					'custom' => 'yes',
				],
			]
		);

		$this->end_controls_section();
		
	}

	protected function render() {

		$settings = $this->get_settings();

		$sep = ' <span class="separator">'.$settings['separator'].'</span> ';
		
		if (!is_front_page()) {

			$breadcrumbs = array();

			if ($settings['show_home'] == 'yes') {
				array_push($breadcrumbs, '<a href="'.get_site_url().'">'.$settings['home'].'</a>');
			}

			if ($settings['custom'] == 'yes') {
				foreach ($settings['slugs'] as $step) {
					array_push($breadcrumbs, '<a href="'.$step['url']['url'].'"'.(($step['url']['is_external'] == true) ? ' href="_blank"' : '').'>'.$step['name'].'</a>');
				}
			} else {
				if (is_category() || (is_single() && get_post_type() == 'post')) {
					array_push($breadcrumbs, the_category('title_li=').'a');
				} elseif (is_archive() || is_singular('post')) {
					if (is_day()) {
						array_push($breadcrumbs, printf(__('%s', 'bilnea'), get_the_date()));
					} elseif (is_month()) {
						array_push($breadcrumbs, printf(__('%s', 'bilnea'), get_the_date(_x('F Y', 'Fecha para archivos mensuales', 'bilnea'))));
					} elseif (is_year()) {
						array_push($breadcrumbs, printf(__('%s', 'bilnea'), get_the_date(_x('Y', 'Fecha para archivos anuales', 'bilnea'))));
					}
				}
				foreach (get_post_ancestors(get_the_ID()) as $parent) {
					array_push($breadcrumbs, '<a href="'.get_permalink($parent).'">'.get_the_title($parent).'</a>');
				}
			}

			if (is_singular()) {
				array_push($breadcrumbs, '<span class="current">'.get_the_title().'</span>');
			}
		
			if (is_home()) {
				global $post;
				if (get_option('page_for_posts')) { 
					$post = get_page(get_option('page_for_posts'));
					setup_postdata($post);
					array_push($breadcrumbs, '<span class="current">'.get_the_title().'</span>');
					rewind_posts();
				}
			}
			
		}

		echo '<div class="b_breadcrumbs">'.implode($sep, $breadcrumbs).'</div>';
		
	}

	protected function content_template() {
		
	}
}
