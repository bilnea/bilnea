<?php
namespace Elementorbilnea\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (! defined('ABSPATH')) exit;

class bilnea_Woo_Quantity extends Widget_Base {

	public function get_name() {
		return 'bilnea_woo_quantity';
	}

	public function get_title() {
		return __('Woocommerce quantity input', 'bilnea');
	}

	public function get_icon() {
		return 'eicon-woocommerce';
	}

	public function get_categories() {
		return ['bilnea'];
	}

	public function get_script_depends() {
		return [];
	}

	protected function _register_controls() {
		
	}

	protected function render() {

		if (wc_get_product(get_queried_object_id()) != false) {

			woocommerce_quantity_input();

		}
		
	}

	protected function content_template() {
		
	}
}
