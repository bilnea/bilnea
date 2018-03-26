<?php

namespace Elementorbilnea\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Widget_Base;

if (! defined('ABSPATH')) {
	exit;
}

class bilnea_Mailchimp extends Widget_Base {

	public function get_name() {
		return 'bilnea_mailchimp';
	}

	public function get_title() {
		return __('Mailchimp form', 'bilnea');
	}

	public function get_icon() {
		return 'eicon-mailchimp';
	}

	public function get_categories() {
		return ['bilnea'];
	}

	public function get_script_depends() {
		return [];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'blog',
			[
				'label' => __('Mailchimp form', 'bilnea'),
			]
		);

		$this->start_controls_tabs('recent_post');

		$this->start_controls_tab('config', ['label' => __('Configuration', 'bilnea')]);

		if (b_f_option('b_opt_newsl_api') != '') {
			foreach (json_decode(b_f_i_mailchimp('https://'.substr(b_f_option('b_opt_newsl_api'),strpos(b_f_option('b_opt_newsl_api'),'-')+1).'.api.mailchimp.com/3.0/lists/', 'GET', b_f_option('b_opt_newsl_api'), array('fields' => 'lists', 'count' => 50)))->lists as $list) {
				$lists[$list->id] = $list->name;
			}
		}

		$this->add_control(
			'list',
			[
				'label' => __('List', 'bilnea'),
				'type' => Controls_Manager::SELECT,
				'default' => b_f_option('b_opt_newsl_list-es'),
				'options' => $lists,
			]
		);

		$this->add_control(
			'opt_in',
			[
				'label' => __('Double opt-in', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => checked(b_f_option('b_opt_double_opt_in'), 'yes'),
			]
		);

		$this->add_control(
			'redirect',
			[
				'label' => __('Redirect on success', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'redirect_id',
			[
				'label' => __('Where redirect', 'bilnea'),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'condition' => [
					'redirect' => 'yes',
				],
			]
		);

		$this->add_control(
			'send',
			[
				'label' => __('Button text', 'bilnea'),
				'type' => Controls_Manager::TEXT,
				'default' => 'Suscribe',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab('content', ['label' => __('Content', 'bilnea')]);

		$this->add_control(
			'raw_content',
			[
				'label' => sprintf(__('You can use the followings snippets %s', 'bilnea'), implode(', ', array('{{b_name}}', '{{b_last-name}}, {{b_email}}', '{{b_legal}}', '{{b_unsubscribe}}', '{{b_send}}'))),
				'type' => Controls_Manager::CODE,
				'default' => '{{b_name}}{{b_email}}{{b_legal}}{{b_send}}',
				'placeholder' => __('Enter your enhaced content here', 'bilnea'),
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'input_style',
			[
				'label' => __('Input style', 'bilnea'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'input_color',
			[
				'label' => __('Text Color', 'bilnea'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} input' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'input_font',
				'scheme' => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} input',
			]
		);

		$this->add_control(
			'back_color',
			[
				'label' => __('Background color', 'bilnea'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} input' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'padding',
			[
				'label' => __('Padding element', 'bilnea'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} input' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'placeholder' => '1px',
				'default' => '1px',
				'selector' => '{{WRAPPER}} input, {{WRAPPER}} input.b_input_checkbox + label::before',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} input, {{WRAPPER}} input.b_input_checkbox + label::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} input, {{WRAPPER}} input.b_input_checkbox + label::before',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'placeholder_color',
			[
				'label' => __('Placeholder Color', 'bilnea'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} input::-webkit-input-placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} input:-ms-input-placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} input::-ms-input-placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} input::placeholder' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'placeholder_font',
				'scheme' => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} input::placeholder'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'label_style',
			[
				'label' => __('Label style', 'bilnea'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'label_color',
			[
				'label' => __('Text Color', 'bilnea'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} label, {{WRAPPER}} label a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'label_font',
				'scheme' => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} label, {{WRAPPER}} label a',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'button_style',
			[
				'label' => __('Button', 'bilnea'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .s_submit',
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'elementor' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .s_submit' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				],
				'selectors' => [
					'{{WRAPPER}} .s_submit' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'elementor' ),
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .s_submit:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_hover_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .s_submit:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' => __( 'Border Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .s_submit:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => __( 'Hover Animation', 'elementor' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'placeholder' => '1px',
				'default' => '1px',
				'selector' => '{{WRAPPER}} .s_submit',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label' => __( 'Border Radius', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .s_submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_shadow',
				'selector' => '{{WRAPPER}} .s_submit',
			]
		);

		$this->add_control(
			'button_text_padding',
			[
				'label' => __( 'Padding', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .s_submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		// Variables globales
		global $b_g_language;
		
		$settings = $this->get_settings();

		$temp = array(
			'text' => __('There are errors on the form. Please fix them before continuing', 'bilnea'),
			'empty' => __('Fill in all the required fields', 'bilnea'),
			'email' => __('Enter a valid email address', 'bilnea'),
			'legal' => __('You must accept the legal advice', 'bilnea'),
			'unsubscribing' => __('Unsubscribing...')
		);

		wp_register_script('shortcodes.mailchimp', get_template_directory_uri().'/js/internal/shortcodes.mailchimp.js', array('jquery'), b_f_versions(), true);
		wp_localize_script('shortcodes.mailchimp', 'nws_errors', $temp);
		wp_enqueue_script('shortcodes.mailchimp');

		$random = rand(100000, 999999);

		$legal = '<input class="b_input_checkbox" value="true" type="checkbox" id="s_legal-'.$random.'" name="s_legal-'.$random.'" />';

		$placeholder = __('Privacy policy', 'bilnea');

		switch (substr(explode(' ', $placeholder)[0], -1)) {
			case 'a':
				$article = _x('the', 'female', 'bilnea');
				break;
			default:
				$article = _x('the', 'male', 'bilnea');
				break;
		}

		$legal .= '<label for="s_legal-'.$random.'">* '.__('I have read, understood and accept', 'bilnea').' '.$article.' <a href="'.get_permalink(b_f_option('b_opt_privacy-policy-'.$b_g_language)).'" title="'.$placeholder.'" target="_blank">'.strtolower($placeholder).'</a>.</label>';

		// Pseudo shortcodes
		$shortcodes = array('{{b_name}}', '{{b_last-name}}', '{{b_email}}', '{{b_legal}}', '{{b_nsubscribe}}', '{{b_send}}');
		$replace = array(
			'<input class="input" type="text" name="s_name" placeholder="* '.__('Name', 'bilnea').'" />',
			'<input type="text" name="s_last" placeholder="* '.__('Last name', 'bilnea').'" />',
			'<input class="input" type="email" name="s_email" placeholder="* '.__('Email', 'bilnea').'" />',
			$legal,
			'<span class="s_delete">'.__('If you want to unsubscribe from our newsletter, click', 'bilnea').' <a>'.__('here', 'bilnea').'.</a></span>',
			'<div class="s_submit" data-send="'.$settings['send'].'" data-sending="'.__('Subscribing', 'bilnea').'">'.$settings['send'].'</div>'
		);

		if ($settings['redirect'] == 'yes') {
			$redirect = $settings['redirect_id'];
		} else {
			$redirect = '';
		}

		echo '<div class="b_newsletters">'.do_shortcode(str_replace($shortcodes, $replace, $settings['raw_content'].'<input name="s_redirect" type="hidden" class="redirect_to" value="'.$redirect.'" /><input type="hidden" name="s_list" value="'.$settings['list'].'" />')).'</div><div class="response"></div>';

	}

	protected function content_template() {
		
	}
}
