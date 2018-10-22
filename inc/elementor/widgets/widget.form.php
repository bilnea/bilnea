<?php

namespace Elementorbilnea\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Widget_Base;

if (! defined('ABSPATH')) {
	exit;
}

class bilnea_Form extends Widget_Base {

	public function get_name() {
		return 'bilnea_form';
	}

	public function get_title() {
		return __('Form', 'bilnea');
	}

	public function get_icon() {
		return 'eicon-form-horizontal';
	}

	public function get_categories() {
		return ['bilnea'];
	}

	public function get_script_depends() {
		return [];
	}

	protected function _register_controls() {

		if (function_exists('pll_current_language')) {
			add_filter('locale', function($locale) {
				return pll_current_language('locale');
			});
		}

		$this->start_controls_section(
			'section_form',
			[
				'label' => __('Inputs', 'bilnea'),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'type',
			[
				'label' => __('Type', 'bilnea'),
				'type' => Controls_Manager::SELECT,
				'default' => 'text',
				'options' => [
					'text' => __('Text', 'bilnea'),
					'subject' => __('Subject', 'bilnea'),
					'email' => __('Email', 'bilnea'),
					'number' => __('Number', 'bilnea'),
					'radio' => __('Radio', 'bilnea'),
					'checkbox' => __('Checkbox', 'bilnea'),
					'select' => __('Select', 'bilnea'),
					'legal' => __('Legal notice', 'bilnea'),
					'hidden' => __('Hidden', 'bilnea'),
					'file' => __('File', 'bilnea'),
					'textarea' => __('Textarea', 'bilnea'),
					'header' => __('Header', 'bilnea'),
					'html' => __('HTML code', 'bilnea'),
					'mailchimp' => __('Mailchimp checkbox', 'bilnea'),
				],
				'separator' => 'none'
			]
		);

		$repeater->add_control(
			'label',
			[
				'label' => __('Label', 'bilnea'),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'separator' => 'none'
			]
		);

		$repeater->add_control(
			'value',
			[
				'label' => __('Value', 'bilnea'),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'condition' => [
					'type' => array('hidden')
				]
			]
		);

		$repeater->add_control(
			'placeholder',
			[
				'label' => __('Label as placeholder', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => '',
				'condition' => [
					'type' => array('text','email', 'number', 'select', 'textarea')
				]
			]
		);

		$repeater->add_control(
			'required',
			[
				'label' => __('Required', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => '',
				'separator' => 'none',
				'condition' => [
					'type' => array('text', 'subject', 'email', 'number', 'radio', 'checkbox', 'select', 'legal', 'file', 'textarea')
				]
			]
		);

		$repeater->add_control(
			'rows',
			[
				'label' => __('Rows', 'bilnea'),
				'type' => Controls_Manager::NUMBER,
				'default' => 4,
				'condition' => [
					'type' => 'textarea'
				],
				'separator' => 'none'
			]
		);

		$repeater->add_control(
			'reply',
			[
				'label' => __('Reply to this email adress.', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'type' => array('email')
				],
				'separator' => 'none'
			]
		);

		$repeater->add_control(
			'options',
			[
				'label' => __('Options. One per line, "value::name" format.', 'bilnea'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => '',
				'condition' => [
					'type' => array('radio', 'select', 'mailer')
				],
				'separator' => 'none'
			]
		);

		$repeater->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'font',
				'scheme' => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{CURRENT_ITEM}}',
				'condition' => [
					'type' => array('header')
				]
			]
		);

		$repeater->add_control(
			'raw_content',
			[
				'label' => __('HTML content', 'bilnea'),
				'type' => Controls_Manager::CODE,
				'default' => '',
				'condition' => [
					'type' => array('html')
				],
				'separator' => 'none'
			]
		);

		$repeater->add_control(
			'multiple',
			[
				'label' => __('Multiple', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => '',
				'condition' => [
					'type' => 'select'
				],
				'separator' => 'none'
			]
		);

		$repeater->add_responsive_control(
			'width',
			[
				'label' => __('Content Width', 'bilnea'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 10
					],
				],
				'size_units' => ['%'],
				'default' => [
					'size' => '100',
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'separator' => 'none',
				'condition' => [
					'type' => array('text', 'subject', 'email', 'number', 'radio', 'checkbox', 'select', 'legal', 'file', 'textarea', 'header', 'html', 'mailchimp')
				],
			]
		);

		$this->add_control(
			'inputs',
			[
				'label' => __('Inputs', 'bilnea'),
				'type' => Controls_Manager::REPEATER,
				'show_label' => true,
				'default' => [
					[
						'type' => 'text',
						'label' => __('Name', 'bilnea'),
						'required' => 'yes',
						'placeholder' => 'yes'
					],
					[
						'type' => 'email',
						'label' => __('Email', 'bilnea'),
						'required' => 'yes',
						'placeholder' => 'yes'
					],
					[
						'type' => 'textarea',
						'label' => __('Message', 'bilnea'),
						'required' => 'yes',
						'placeholder' => 'yes'
					]
				],
				'fields' => array_values($repeater->get_controls()),
				'title_field' => '{{{label}}}'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_form_options',
			[
				'label' => __('Options', 'bilnea'),
				'type' => Controls_Manager::SECTION,
			]
		);

		$this->add_control(
			'name',
			[
				'label' => __('Name', 'bilnea'),
				'type' => Controls_Manager::TEXT,
				'default' => sprintf(__('Form #%d / %s'), $this->get_id(), get_the_title()),
			]
		);

		$this->add_control(
			'subject',
			[
				'label' => __('Subject', 'bilnea'),
				'type' => Controls_Manager::TEXT,
				'default' => sprintf(esc_html__('Message sent from %s website form', 'bilnea'), get_option('blogname')),
			]
		);

		$this->add_control(
			'to',
			[
				'label' => __('Receivers', 'bilnea'),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => __('your@address.com', 'bilnea'),
			]
		);

		$this->add_control(
			'store',
			[
				'label' => __('Store in database', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'redirect_success',
			[
				'label' => __('Redirect on success', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'redirect',
			[
				'label' => __('Where redirect', 'bilnea'),
				'type' => Controls_Manager::URL,
				'placeholder' => __('http://your-domain.com', 'bilnea'),
				'condition' => [
					'redirect_success' => 'yes'
				]
			]
		);

		$this->add_control(
			'send',
			[
				'label' => __('Send text', 'bilnea'),
				'type' => Controls_Manager::TEXT,
				'default' => __('Send', 'bilnea'),
			]
		);

		$this->add_control(
			'sending',
			[
				'label' => __('Sending text', 'bilnea'),
				'type' => Controls_Manager::TEXT,
				'default' => __('Sending', 'bilnea'),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_form_messages',
			[
				'label' => __('Messages', 'bilnea'),
				'type' => Controls_Manager::SECTION,
			]
		);

		$this->add_control(
			'message_success',
			[
				'label' => __('Success message', 'bilnea'),
				'type' => Controls_Manager::TEXT,
				'default' => __('Your message has been sent sucesfully. Your request will delay. A copy has been sent to your email.', 'bilnea'),
			]
		);

		$this->add_control(
			'message_error',
			[
				'label' => __('Invalid inputs', 'bilnea'),
				'type' => Controls_Manager::TEXT,
				'default' => __('There are errors on the form. Please fix them before continuing', 'bilnea'),
			]
		);

		$this->add_control(
			'message_empty',
			[
				'label' => __('Empty inputs', 'bilnea'),
				'type' => Controls_Manager::TEXT,
				'default' => __('Fill in all the required fields', 'bilnea'),
			]
		);

		$this->add_control(
			'message_email',
			[
				'label' => __('Bad email', 'bilnea'),
				'type' => Controls_Manager::TEXT,
				'default' => __('Enter a valid email address', 'bilnea'),
			]
		);

		$this->add_control(
			'message_captcha',
			[
				'label' => __('Bad captcha', 'bilnea'),
				'type' => Controls_Manager::TEXT,
				'default' => __('Enter a correct captcha value', 'bilnea'),
			]
		);

		$this->add_control(
			'message_legal',
			[
				'label' => __('Legal acceptance', 'bilnea'),
				'type' => Controls_Manager::TEXT,
				'default' => __('You must accept the legal advice', 'bilnea'),
			]
		);

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
					'{{WRAPPER}} input, {{WRAPPER}} textarea, {{WRAPPER}} select.selected' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'input_font',
				'scheme' => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} input, {{WRAPPER}} textarea, {{WRAPPER}} select.selected',
			]
		);

		$this->add_control(
			'padding_element',
			[
				'label' => __('Space between elements', 'bilnea'),
				'type' => Controls_Manager::NUMBER,
				'default' => 10,
				'selectors' => [
					'{{WRAPPER}} .form-control' => 'padding: calc({{VALUE}}px / 2);',
					'{{WRAPPER}} .elementor-row' => 'margin-left: calc(-{{VALUE}}px / 2); margin-right: calc(-{{VALUE}}px / 2);',
				],
			]
		);

		$this->add_control(
			'back_color',
			[
				'label' => __('Background color', 'bilnea'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} input, {{WRAPPER}} textarea, {{WRAPPER}} select, {{WRAPPER}} input.b_input_checkbox + label::before' => 'background-color: {{VALUE}};',
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
					'{{WRAPPER}} input, {{WRAPPER}} textarea, {{WRAPPER}} select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} input, {{WRAPPER}} textarea, {{WRAPPER}} select' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'placeholder' => '1px',
				'default' => '1px',
				'selector' => '{{WRAPPER}} input, {{WRAPPER}} textarea, {{WRAPPER}} select, {{WRAPPER}} input.b_input_checkbox + label::before',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => __('Border Radius', 'elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} input, {{WRAPPER}} textarea, {{WRAPPER}} select, {{WRAPPER}} input.b_input_checkbox + label::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} input, {{WRAPPER}} textarea, {{WRAPPER}} select, {{WRAPPER}} input.b_input_checkbox + label::before',
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
					'{{WRAPPER}} textarea::-webkit-input-placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} textarea:-ms-input-placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} textarea::-ms-input-placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} textarea::placeholder' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'placeholder_font',
				'scheme' => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} input::placeholder, {{WRAPPER}} textarea::placeholder, {{WRAPPER}} select'
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
				'selector' => '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button',
			]
		);

		$this->start_controls_tabs('tabs_button_style');

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __('Normal', 'elementor'),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => __('Text Color', 'elementor'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .form-send' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label' => __('Background Color', 'elementor'),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				],
				'selectors' => [
					'{{WRAPPER}} .form-send' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __('Hover', 'elementor'),
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label' => __('Text Color', 'elementor'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .form-send:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_hover_color',
			[
				'label' => __('Background Color', 'elementor'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .form-send:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' => __('Border Color', 'elementor'),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .form-send:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => __('Hover Animation', 'elementor'),
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
				'selector' => '{{WRAPPER}} .form-send',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label' => __('Border Radius', 'elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .form-send' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_shadow',
				'selector' => '{{WRAPPER}} .form-send',
			]
		);

		$this->add_control(
			'button_text_padding',
			[
				'label' => __('Padding', 'elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .form-send' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'button_align',
			[
				'label' => __('Alignment', 'bilnea'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'bilnea'),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __('Center', 'bilnea'),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __('Right', 'bilnea'),
						'icon' => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __('Justify', 'bilnea'),
						'icon' => 'fa fa-align-justify',
					],
				],
				'devices' => ['desktop', 'tablet'],
				'selectors' => [
					'{{WRAPPER}} [data-input="send"]' => 'text-align: %s;',
				]
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		// Variables globales
		global $b_g_language;

		if (function_exists('pll_current_language')) {
			add_filter('locale', function($locale) {
				return pll_current_language('locale');
			});
		}

		$settings = $this->get_settings();

		wp_register_script('functions.form', get_template_directory_uri().'/js/internal/functions.form.js', array('jquery', 'functions.ajaxform'), b_f_versions(), true);

		$temp = array(
			'text' => $settings['message_error'],
			'empty' => $settings['message_empty'],
			'email' => $settings['message_email'],
			'captcha' => $settings['message_captcha'],
			'legal' => $settings['message_legal'],
			'files_selected' => __('files selected', 'bilnea')
		);

		wp_enqueue_script('functions.ajaxform');
		wp_enqueue_script('functions.form');

		wp_localize_script('functions.form', 'form_messages_'.$this->get_id(), $temp);

		if (empty($settings['inputs'])) {
			return;
		}

		$ip = '';
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip=' '.$_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip=' '.$_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip=' '.$_SERVER['REMOTE_ADDR'];
		}

		$out = '<form id="form-'.$this->get_id().'" method="post" data-id="'.$this->get_id().'" data-name="'.$settings['name'].'" enctype="multipart/form-data">';

		$out .= '<div class="elementor-row">';

		$i = $w = 0;

		$replacements = array(
			'{{b_title}}' => get_the_title(),
			'{{b_id}}' => get_the_ID(),
			'{{b_url}}' => get_permalink()
		);

		foreach ($settings['inputs'] as $input) {

			if ($input['required'] == 'yes') {
				$required = '* ';
				$data = ' data-required="true"';
			} else {
				$required = '';
				$data = '';
			}

			$classes = ' elementor-col-'.(('' !== $input['width']['size']) ? $input['width']['size'] : (($input['type'] == 'hidden') ? '0' : '100'));

			if ($input['width_tablet']['size'] != '') {
				$classes .= ' elementor-md-'.(('' !== $input['width_tablet']['size']) ? $input['width_tablet']['size'] : '100');
			}

			if ($input['width_mobile']['size'] != '') {
				$classes .= ' elementor-sm-'.(('' !== $input['width_mobile']['size']) ? $input['width_mobile']['size'] : '100');
			}

			switch ($input['type']) {

				case 'header':
					$out .= '<div class="form-control elementor-column'.$classes.'" data-type="header">'.$input['label'].'</div>';
					break;

				case 'html':
					$out .= '<div class="form-control elementor-column'.$classes.'" data-type="html">'.$input['raw_content'].'</div>';
					break;

				case 'hidden':
					$out .= '<input class="input" data-name="'.$input['label'].'" data-type="text" type="hidden" name="b_i_text-'.$this->get_id().$i.'" value="'.strtr($input['value'], $replacements).'" />';
					break;

				case 'email':
					if ($input['placeholder'] == 'yes') {
						$out .= '<div class="form-control elementor-column'.$classes.'"><input class="input"'.$data.' data-name="'.$input['label'].'" data-type="email"'.(($input['reply'] == 'yes') ? ' data-reply="yes"' : '').' type="text" name="b_i_email-'.$this->get_id().$i.'" placeholder="'.$input['label'].'" /></div>';
					} else {
						$out .= '<div class="form-control elementor-column'.$classes.'"><label><span>'.$input['label'].'</span><input class="input"'.$data.' data-name="'.$input['label'].'" data-type="email"'.(($input['reply'] == 'yes') ? ' data-reply="yes"' : '').' type="text" name="b_i_email-'.$this->get_id().$i.'" /></label></div>';
					}
					break;

				case 'legal':
					$label = $input['label'];
					if (empty($label)) {
						$label = sprintf(__('I have read, understood and accept the <a href="%s" target="_blank">privacy policy</a>.', 'bilnea'), get_permalink(b_f_option('b_opt_privacy-policy-'.$b_g_language)));
					}
					$out .= '<div class="form-control elementor-column'.$classes.'" data-input="legal">';
					$out .= '<input class="b_input_checkbox"'.$data.' data-name="'.__('Legal notice', 'bilnea').'" data-type="legal" type="checkbox" id="legal-'.$this->get_id().$i.'" name="b_i_legal-'.$this->get_id().$i.'">';
					$out .= '<label for="legal-'.$this->get_id().$i.'">'.strtr($label, array('“' => '', '”' => '')).'</label></div>';
					break;

				case 'number':
					if ($input['placeholder'] == 'yes') {
						$out .= '<div class="form-control elementor-column'.$classes.'"><input class="input"'.$data.' data-name="'.$input['label'].'" data-type="number" type="number" name="b_i_number-'.$this->get_id().$i.'" placeholder="'.$input['label'].'" /></div>';
					} else {
						$out .= '<div class="form-control elementor-column'.$classes.'"><label><span>'.$input['label'].'</span><input class="input"'.$data.' data-name="'.$input['label'].'" data-type="number" type="number" name="b_i_number-'.$this->get_id().$i.'" /></label></div>';
					}
					break;

				case 'select':
					$options = '';
					foreach (explode("\n", $input['options']) as $option) {
						$values = explode('::', $option);
						if (count($values) > 1) {
							$options .= '<option value="'.$values[0].'">'.$values[1].'</option>';
						} else {
							$options .= '<option value="'.$values[0].'">'.$values[0].'</option>';
						}
					}
					if ($input['placeholder'] == 'yes') {
						$out .= '<div class="form-control elementor-column'.$classes.' form-select" data-type="select"><select class="input"'.$data.' data-name="'.$input['label'].'" data-type="select" name="b_i_select-'.$this->get_id().$i.'"><option selected disabled>'.$input['label'].'</option>'.$options.'</select></div>';
					} else {
						$out .= '<div class="form-control elementor-column'.$classes.'" data-type="select"><label><span>'.$input['label'].'</span><select class="input"'.$data.' data-name="'.$input['label'].'" data-type="select" name="b_i_select-'.$this->get_id().$i.'">'.$options.'</select></label></div>';
					}
					break;

				case 'text':
					if ($input['placeholder'] == 'yes') {
						$out .= '<div class="form-control elementor-column'.$classes.'" data-type="text"><input class="input"'.$data.' data-name="'.$input['label'].'" data-type="text" type="text" name="b_i_text-'.$this->get_id().$i.'" placeholder="'.$input['label'].'" /></div>';
					} else {
						$out .= '<div class="form-control elementor-column'.$classes.'" data-type="text"><label><span>'.$input['label'].'</span><input class="input"'.$data.' data-name="'.$input['label'].'" data-type="text" type="text" name="b_i_text-'.$this->get_id().$i.'" /></label></div>';
					}
					break;

				case 'textarea':
					if ($input['placeholder'] == 'yes') {
						$out .= '<div class="form-control elementor-column'.$classes.'" data-input="textarea"><textarea'.$data.' data-name="'.$input['label'].'" data-type="textarea" name="b_i_textarea-'.$this->get_id().$i.'" class="input" placeholder="'.$input['label'].'" rows="'.$input['rows'].'"></textarea></div>';
					} else {
						$out .= '<div class="form-control elementor-column'.$classes.'"><label><span>'.$input['label'].'</span><textarea'.$data.' data-name="'.$input['label'].'" data-type="textarea" name="b_i_textarea-'.$this->get_id().$i.'" class="input" rows="'.$input['rows'].'"></textarea></label></div>';
					}
					break;

				case 'radio':
					$out .= '<div class="form-control elementor-column'.$classes.'" data-input="radio">';
					$i = 0;
					$uid = uniqid();
					foreach (explode("\n", $input['options']) as $option) {
						$values = explode('::', $option);
						if (count($values) > 1) {
							$out .= '<input class="b_input_radio"'.$data.' data-name="'.$input['label'].'" type="radio" id="radio-'.$uid.$i.'" name="radio-'.$uid.'" value="'.$values[0].'">';
							$out .= '<label>'.$values[1].'</label>';
						} else {
							$out .= '<input class="b_input_radio"'.$data.' data-name="'.$input['label'].'" type="radio" id="radio-'.$uid.$i.'" name="radio-'.$uid.'" value="'.$values[0].'">';
							$out .= '<label for="radio-'.$uid.$i.'">'.$values[0].'</label>';
						}
						$i++;
					}
					$out .= '</div>';
					break;

			}

			if (($w + $input['width']['size']) > 100) {
				$w = 0;
				$out .= '</div><div class="elementor-row">';
			} else {
				$w = $w + $input['width']['size'];
			}

			if ($w == 100) {
				$w = 0;
				$out .= '</div><div class="elementor-row">';
			}

			$i++;

		}

		$out .= '</div>';
		$out .= '<div class="elementor-row"><div class="form-control elementor-column '.$settings['button_align'].'" data-input="send"><div class="form-send elementor-button elementor-size-sm elementor-animation-'.$settings['hover_animation'].'" data-send="'.$settings['send'].'" data-sending="'.$settings['sending'].'">'.$settings['send'].'</div></div></div>';
		$out .= '<input type="hidden" value="'.b_f_i_encrypt_decrypt('encrypt', $settings['to']).'" name="b_i_to" />';
		$out .= '<input type="hidden" value="'.b_f_i_encrypt_decrypt('encrypt', $settings['message_success']).'" name="b_i_sucess" />';
		$out .= '<input type="hidden" value="'.b_f_i_encrypt_decrypt('encrypt', $settings['subject']).'" name="b_i_subject" />';
		$out .= '<input type="hidden" value="'.b_f_i_encrypt_decrypt('encrypt', $settings['name']).'" name="b_i_formname" />';
		$out .= '<input type="hidden" value="'.b_f_i_encrypt_decrypt('encrypt', get_the_ID()).'" name="b_i_page" />';
		$out .= '<input type="hidden" value="'.b_f_i_encrypt_decrypt('encrypt', $ip).'" name="b_i_ip" />';
		$out .= '<input type="hidden" value="'.b_f_i_encrypt_decrypt('encrypt', $settings['redirect']['url']).'" name="b_i_redirect" />';
		$out .= '<input type="hidden" value="" name="b_i_names" />';
		$out .= '<input type="hidden" value="" name="b_i_reply" />';
		if ($settings['store']) {
			$out .= '<input type="hidden" value="" name="b_i_store" />';
		}
		$out .= '<div class="response"></div>';
		$out .= '</form>';

		echo $out;

	}

	protected function content_template() {

	}
}
