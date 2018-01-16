<?php

namespace Elementorbilnea\Widgets;

use Elementor\Controls_Manager;
use Elementor\Repeater;
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
					'file' => __('File', 'bilnea'),
					'textarea' => __('Textarea', 'bilnea'),
					'mailchimp' => __('Mailchimp checkbox', 'bilnea'),
				]
			]
		);

		$repeater->add_control(
			'label',
			[
				'label' => __('Label', 'bilnea'),
				'type' => Controls_Manager::TEXT,
				'default' => '',
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
					'type' => array('text', 'email', 'number', 'select', 'textarea')
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
				]
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
				]
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
				]
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
				]
			]
		);

		$repeater->add_control(
			'breakline',
			[
				'label' => __('Break line', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
				'separator' => 'before'
			]
		);

		$repeater->add_control(
			'separator',
			[
				'label' => __('Break position', 'bilnea'),
				'type' => Controls_Manager::SELECT,
				'default' => 'after',
				'options' => [
					'before' => __('Before', 'bilnea'),
					'after' => __('After', 'bilnea')
				],
				'condition' => [
					'breakline' => 'yes'
				]
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
		
	}

	protected function render() {
		
		// Variables globales
		global $b_g_language;

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

		$i = 0;

		foreach ($settings['inputs'] as $input) {

			if ($input['breakline'] && $input['separator'] == 'before') {
				$out .= '</div><div class="elementor-row">';
			}

			if ($input['required'] == 'yes') {
				$required = '* ';
				$data = ' data-required="true"';
			} else {
				$required = '';
				$data = '';
			}

			switch ($input['type']) {

				case 'email':
					if ($input['placeholder'] == 'yes') {
						$out .= '<div class="form-control elementor-column"><input class="input"'.$data.' data-name="'.$input['label'].'" data-type="email"'.(($input['reply'] == 'yes') ? ' data-reply="yes"' : '').' type="text" name="b_i_email-'.$this->get_id().$i.'" placeholder="'.$input['label'].'" /></div>';
					} else {
						$out .= '<div class="form-control elementor-column"><label><span>'.$input['label'].'</span><input class="input"'.$data.' data-name="'.$input['label'].'" data-type="email"'.(($input['reply'] == 'yes') ? ' data-reply="yes"' : '').' type="text" name="b_i_email-'.$this->get_id().$i.'" /></label></div>';
					}
					break;

				case 'legal':
					$label = $input['label'];
					if (empty($label)) {
						$label = sprintf(__('I have read, understood and accept the <a href="%s" target="_blank">privacy policy</a>.'), get_permalink(b_f_option('b_opt_privacy-policy-'.$b_g_language)));
					}
					$out .= '<div class="form-control elementor-column" data-input="html">';
					$out .= '<input class="b_input_checkbox"'.$data.' data-name="'.__('Legal notice', 'bilnea').'" data-type="legal" type="checkbox" id="legal-'.$this->get_id().$i.'" name="b_i_legal-'.$this->get_id().$i.'">';
					$out .= '<label for="legal-'.$this->get_id().$i.'">'.$label.'</label></div>';
					break;

				case 'number':
					if ($input['placeholder'] == 'yes') {
						$out .= '<div class="form-control elementor-column"><input class="input"'.$data.' data-name="'.$input['label'].'" data-type="number" type="number" name="b_i_number-'.$this->get_id().$i.'" placeholder="'.$input['label'].'" /></div>';
					} else {
						$out .= '<div class="form-control elementor-column"><label><span>'.$input['label'].'</span><input class="input"'.$data.' data-name="'.$input['label'].'" data-type="number" type="number" name="b_i_number-'.$this->get_id().$i.'" /></label></div>';
					}
					break;

				case 'select':
					$options = '';
					foreach (explode("\n", $input['options']) as $option) {
						$values = explode('::', $option);
						if (count($values) > 1) {
							$options .= '<option value="'.$values[0].'">'.$values[1].'</option>';
						} else {
							$options .= '<option value="'.$values.'">'.$values.'</option>';
						}
					}
					if ($input['placeholder'] == 'yes') {
						$out .= '<div class="form-control elementor-column form-select"><select class="input"'.$data.' data-name="'.$input['label'].'" data-type="select" name="b_i_select-'.$this->get_id().$i.'"><option selected disabled>'.$input['label'].'</option>'.$options.'</select></div>';
					} else {
						$out .= '<div class="form-control elementor-column"><label><span>'.$input['label'].'</span><select class="input"'.$data.' data-name="'.$input['label'].'" data-type="select" name="b_i_select-'.$this->get_id().$i.'">'.$options.'</select></label></div>';
					}
					break;

				case 'text':
					if ($input['placeholder'] == 'yes') {
						$out .= '<div class="form-control elementor-column"><input class="input"'.$data.' data-name="'.$input['label'].'" data-type="text" type="text" name="b_i_text-'.$this->get_id().$i.'" placeholder="'.$input['label'].'" /></div>';
					} else {
						$out .= '<div class="form-control elementor-column"><label><span>'.$input['label'].'</span><input class="input"'.$data.' data-name="'.$input['label'].'" data-type="text" type="text" name="b_i_text-'.$this->get_id().$i.'" /></label></div>';
					}
					break;

				case 'textarea':
					if ($input['placeholder'] == 'yes') {
						$out .= '<div class="form-control elementor-column"><textarea'.$data.' data-name="'.$input['label'].'" data-type="textarea" name="b_i_textarea-'.$this->get_id().$i.'" class="input" placeholder="'.$input['label'].'" rows="'.$input['rows'].'"></textarea></div>';
					} else {
						$out .= '<div class="form-control elementor-column"><label><span>'.$input['label'].'</span><textarea'.$data.' data-name="'.$input['label'].'" data-type="textarea" name="b_i_textarea-'.$this->get_id().$i.'" class="input" rows="'.$input['rows'].'"></textarea></label></div>';
					}
					break;

			}

			if ($input['breakline'] && $input['separator'] == 'after') {
				$out .= '</div><div class="elementor-row">';
			}

			$i++;

		}

		$out .= '</div>';
		$out .= '<div class="elementor-row"><div class="form-control elementor-column" data-input="html"><div class="form-send elementor-button elementor-size-sm" data-send="'.$settings['send'].'" data-sending="'.$settings['sending'].'">'.$settings['send'].'</div></div></div>';
		$out .= '<input type="hidden" value="'.b_f_i_encrypt_decrypt('encrypt', $settings['to']).'" name="b_i_to" />';
		$out .= '<input type="hidden" value="'.b_f_i_encrypt_decrypt('encrypt', $settings['message_success']).'" name="b_i_sucess" />';
		$out .= '<input type="hidden" value="'.b_f_i_encrypt_decrypt('encrypt', $settings['subject']).'" name="b_i_subject" />';
		$out .= '<input type="hidden" value="'.b_f_i_encrypt_decrypt('encrypt', $settings['name']).'" name="b_i_formname" />';
		$out .= '<input type="hidden" value="'.b_f_i_encrypt_decrypt('encrypt', get_the_ID()).'" name="b_i_page" />';
		$out .= '<input type="hidden" value="'.b_f_i_encrypt_decrypt('encrypt', $ip).'" name="b_i_ip" />';
		$out .= '<input type="hidden" value="'.b_f_i_encrypt_decrypt('encrypt', $settings['redirect']['url']).'" name="b_i_redirect" />';
		$out .= '<input type="hidden" value="" name="b_i_names" />';
		$out .= '<input type="hidden" value="" name="b_i_reply" />';
		$out .= '<div class="response"></div>';
		$out .= '</form>';

		echo $out;
		
	}

	protected function content_template() {
		
	}
}
