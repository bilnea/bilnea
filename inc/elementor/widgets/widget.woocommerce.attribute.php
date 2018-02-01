<?php
namespace Elementorbilnea\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (! defined('ABSPATH')) exit;

class bilnea_Woo_Attribute extends Widget_Base {

	public function get_name() {
		return 'bilnea_woo_attribute';
	}

	public function get_title() {
		return __('Woocommercer attribute', 'bilnea');
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

		$this->start_controls_section(
			'woocommerce',
			[
				'label' => __('Woocommerce', 'bilnea'),
			]
		);

		$attributes = array();

		foreach (wc_get_attribute_taxonomies() as $attribute) {
			$attributes[$attribute->attribute_id] = $attribute->attribute_label;
		}

		$this->add_control(
			'attribute',
			[
				'label' => __('Attribute', 'bilnea'),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => $attributes,
				'default' => $attributes[0]
			]
		);

		$this->add_control(
			'type',
			[
				'label' => __('Type', 'bilnea'),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'select' => __('Select', 'bilnea'),
					'radio' => __('Radio', 'bilnea'),
					'color' => __('Color', 'bilnea'),
				],
				'default' => 'select'
			]
		);

		$this->end_controls_section();
		
	}

	protected function render() {

		$settings = $this->get_settings();

		if (wc_get_product(get_queried_object_id()) != false) {

			$product = wc_get_product(get_queried_object_id());

			foreach ($product->get_attributes() as $attribute) {
				if (($attribute['is_visible'] || ($attribute->is_taxonomy() && taxonomy_exists($attribute->get_name()))) && $attribute->get_id() == $settings['attribute']) {
					$all = array();
					foreach (get_the_terms(get_queried_object_id(), $attribute->get_name()) as $term) {
						array_push($all, $term->name);
					}
					switch ($settings['type']) {
						case 'select':
							$out = '<div data-attribute="'.$attribute->get_name().'"><select class="woocommerce-attribute" name="'.$attribute->get_name().'">';
							foreach (get_terms(array('taxonomy' => $attribute->get_name(), 'hide_empty' => false)) as $option) {
								$out .= '<option value="'.$option->name.'"'.((in_array($option->name, $all) ? '' : ' disabled="disabled"')).'>'.$option->name.'</option>';
							}
							$out .= '</select></div>';
							break;
						case 'radio':
							$out = '<div data-attribute="'.$attribute->get_name().'">';
							foreach (get_terms(array('taxonomy' => $attribute->get_name(), 'hide_empty' => false)) as $option) {
								$uid = uniqid();
								$out .= '<input type="radio" name="'.$attribute->get_name().'" id="'.$uid.'" value="'.$option->name.'"'.((in_array($option->name, $all) ? '' : ' disabled="disabled"')).'><label for="'.$uid.'">'.$option->name.'</label>';
							}
							$out .= '</div>';
							break;
						case 'color':
							$out = '<div data-attribute="'.$attribute->get_name().'">';
							foreach (get_terms(array('taxonomy' => $attribute->get_name(), 'hide_empty' => false)) as $option) {
								$uid = uniqid();
								$out .= '<input type="radio" name="'.$attribute->get_name().'" id="'.$uid.'" value="'.$option->name.'"'.((in_array($option->name, $all) ? '' : ' disabled="disabled"')).'><label style="background-color: '.$option->name.';" for="'.$uid.'"></label>';
							}
							$out .= '</div>';
							break;
					}
					$out .= '<script type="text/javascript">'."\n";
					$out .= '	jQuery(function($) {'."\n";
					$out .= '		$(\'[name="'.$attribute->get_name().'"]\').on(\'change\', function() {'."\n";
					$out .= '			var v = $(this).val();'."\n";
					$out .= '			$(\'select#'.$attribute->get_name().' option[value="\'+v+\'"]\').prop(\'selected\', true);'."\n";
					$out .= '			$(\'select#'.$attribute->get_name().'\').trigger(\'change\');'."\n";
					$out .= '		});'."\n";
					$out .= '	});'."\n";
					$out .= '</script>'."\n";
					echo $out;
				}
			}

		}
		
	}

	protected function content_template() {
		
	}
}
