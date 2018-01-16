<?php

namespace Elementorbilnea\Widgets;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

if (! defined('ABSPATH')) {
	exit;
}

class bilnea_Map extends Widget_Base {

	public function get_name() {
		return 'bilnea_map';
	}

	public function get_title() {
		return __('Map', 'bilnea');
	}

	public function get_icon() {
		return 'eicon-google-maps';
	}

	public function get_categories() {
		return ['bilnea'];
	}

	public function get_script_depends() {
		return [];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_slides',
			[
				'label' => __('Configuration', 'bilnea'),
			]
		);

		$default_address = 'bilnea, Carril Condomina, 3 Murcia, España';

		$this->add_control(
			'center',
			[
				'label' => __('Center', 'elementor'),
				'type' => Controls_Manager::TEXT,
				'placeholder' => $default_address,
				'default' => $default_address,
				'label_block' => true
			]
		);

		$this->add_control(
			'zoom',
			[
				'label' => __('Zoom Level', 'bilnea'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 20
					]
				]
			]
		);

		$this->add_control(
			'height',
			[
				'label' => __('Height', 'bilnea'),
				'type' => Controls_Manager::NUMBER,
				'default' => 300
			]
		);

		$this->add_control(
			'scroll',
			[
				'label' => __('Prevent Scroll', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'returned_value' => 'yes'
			]
		);

		$this->add_control(
			'poi',
			[
				'label' => __('Show POIs', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'returned_value' => 'yes'
			]
		);

		$this->add_control(
			'style',
			[
				'label' => __('Style', 'bilnea'),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => __('Write here style script', 'bilnea')
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_markers',
			[
				'label' => __('Markers', 'bilnea'),
				'type' => Controls_Manager::SECTION,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'address',
			[
				'label' => __('Address or coordinates', 'elementor'),
				'type' => Controls_Manager::TEXT,
				'placeholder' => $default_address,
				'default' => $default_address,
				'label_block' => true
			]
		);

		$repeater->add_control(
			'icon',
			[
				'label' => __('Choose icon', 'bilnea'),
				'type' => Controls_Manager::MEDIA
			]
		);

		$repeater->add_control(
			'size',
			[
				'label' => __('Size', 'bilnea'),
				'type' => Controls_Manager::NUMBER,
				'default' => 40,
				'min' => 0
			]
		);

		$repeater->add_control(
			'position',
			[
				'label' => __('Position', 'bilnea'),
				'type' => Controls_Manager::SELECT,
				'default' => 'bc',
				'options' => [
					'tl' => __('Top left', 'bilnea'),
					'tc' => __('Top center', 'bilnea'),
					'tr' => __('Top right', 'bilnea'),
					'cl' => __('Center left', 'bilnea'),
					'cc' => __('Center', 'bilnea'),
					'cr' => __('Center right', 'bilnea'),
					'bl' => __('Bottom left', 'bilnea'),
					'bc' => __('Bottom center', 'bilnea'),
					'br' => __('Bottom right', 'bilnea'),
				]
			]
		);

		$repeater->add_control(
			'info',
			[
				'label' => __('Bubble info', 'bilnea'),
				'type' => Controls_Manager::WYSIWYG,
			]
		);

		$this->add_control(
			'markers',
			[
				'label' => __('Markers', 'bilnea'),
				'type' => Controls_Manager::REPEATER,
				'show_label' => true,
				'fields' => array_values($repeater->get_controls()),
			]
		);

		$this->end_controls_section();
		
	}

	protected function render() {
		
		$settings = $this->get_settings();

		if (is_numeric(str_replace(array(',', '.', '-', ' '), '', $settings['center']))) {
			$center = array('lat' => trim(explode(',', $settings['center'])[0]), 'lng' => trim(explode(',', $settings['center'])[1]));
		} else {
			$center = json_decode(b_f_get_file_content('http://maps.google.com/maps/api/geocode/json?address='.rawurlencode($settings['center'])), true)['results'][0]['geometry']['location'];
		}

		(b_f_option('b_opt_apis_gmaps') != '') ? $api_key = '&key='.b_f_option('b_opt_apis_gmaps') : $api_key = '';

		wp_enqueue_script('functions-map', get_template_directory_uri().'/js/internal/functions.map.js', array('jquery'), b_f_versions(), true);
		wp_enqueue_script('functions-google-map', 'https://maps.googleapis.com/maps/api/js?callback=initMap'.$api_key, array('functions-map'), '', false);

		$out = '<div id="map-'.$this->get_id().'" style="display: block; height: '.$settings['height'].'px;"></div>'."\n";
		$out .= '<script type="text/javascript">'."\n";
		$out .= '	var map_'.$this->get_id().','."\n";
		$out .= '		center_'.$this->get_id().' = {lat: '.$center['lat'].', lng: '.$center['lng'].'},'."\n";
		$out .= '		poi_'.$this->get_id().' = \''.(($settings['poi'] == 'yes') ? true : false).'\','."\n";
		$out .= '		zoom_'.$this->get_id().' = '.$settings['zoom']['size'].','."\n";
		$out .= '		scroll_'.$this->get_id().' = false,'."\n";
		$out .= '		controls_'.$this->get_id().' = false,'."\n";
		$out .= '		drag_'.$this->get_id().' = true,'."\n";
		$out .= '		m_control_'.$this->get_id().' = false,'."\n";
		$out .= '		z_control_'.$this->get_id().' = true,'."\n";
		$out .= '		markers_'.$this->get_id().' = ['."\n";

		foreach ($settings['markers'] as $marker) {
			$out .= '			{'."\n";
			if (is_numeric(str_replace(array(',', '.', '-', ' '), '', $marker['address']))) {
				$position = array('lat' => trim(explode(',', $marker['address'])[0]), 'lng' => trim(explode(',', $marker['address'])[1]));
			} else {
				$position = json_decode(b_f_get_file_content('http://maps.google.com/maps/api/geocode/json?address='.rawurlencode($marker['address'])), true)['results'][0]['geometry']['location'];
			}
			$out .= '				position: {lat: '.$position['lat'].', lng: '.$position['lng'].'},'."\n";
			$out .= '				map: \'map_'.$this->get_id().'\','."\n";
			if ($marker['icon']) {
				$out .= '				icon: {'."\n";
				$out .= '					url: \''.$marker['icon']['url'].'\','."\n";
				$out .= '					size: \''.$marker['size'].'\''."\n";
				$out .= '				},'."\n";
				if ($marker['info']) {
					$out .= '				info: \''.$marker['info'].'\''."\n";
				}
			}
			$out .= '			},'."\n";
		}

		$out .= '		],'."\n";
		$out .= '		styles_'.$this->get_id().' = '.$settings['style'].';'."\n";
		$out .= '</script>'."\n";

		echo $out;
		
	}

	protected function content_template() {
		
	}
}
