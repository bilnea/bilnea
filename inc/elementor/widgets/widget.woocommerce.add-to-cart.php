<?php
namespace Elementorbilnea\Widgets;

use Elementor\Widget_Base;

if (! defined('ABSPATH')) exit;

class bilnea_Woo_Add_to_Cart extends Widget_Base {

	public function get_name() {
		return 'bilnea_woo_add_cart';
	}

	public function get_title() {
		return __('Woocommerce add to cart button', 'bilnea');
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

		global $post, $product;

		$pid = $post;

		$post = setup_postdata(get_post(get_queried_object_id()));
		$product = wc_get_product(get_queried_object_id());

		switch ($product->get_type()) {
			case 'simple':
				if ($product->is_in_stock()) {

					?>

					<form>

						<?php

						if (!$product->is_sold_individually()) {

							$min = apply_filters('woocommerce_quantity_input_min', 1, $product);
							$max = apply_filters('woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product);

							woocommerce_quantity_input(array(
								'min_value' => $min,
								'max_value' => $max,
								'input_value' => (isset($_POST['quantity']) ? wc_stock_amount($_POST['quantity']) : 1)
							));

						}

						?>

						<input type="hidden" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" />
						<button type="submit"><?php echo esc_html($product->single_add_to_cart_text()); ?></button>
					</form>

					<?php

				}

				break;

			case 'variable':
				woocommerce_variable_add_to_cart();
				break;

			}
		}

		$post = $pid;

	}

	protected function content_template() {

	}
}
