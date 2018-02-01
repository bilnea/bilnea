<?php
namespace Elementorbilnea\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (! defined('ABSPATH')) exit;

class bilnea_Share extends Widget_Base {

	public function get_name() {
		return 'bilnea_share';
	}

	public function get_title() {
		return __('Share', 'bilnea');
	}

	public function get_icon() {
		return 'eicon-social-icons';
	}

	public function get_categories() {
		return ['bilnea'];
	}

	public function get_script_depends() {
		return [];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'share',
			[
				'label' => __('Share it', 'bilnea'),
			]
		);

		$this->add_control(
			'facebook',
			[
				'label' => __('Facebook', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'twitter',
			[
				'label' => __('Twitter', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'twitter_user',
			[
				'label' => __('Twitter user', 'bilnea'),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'twitter' => 'yes'
				]
			]
		);

		$this->add_control(
			'google-plus',
			[
				'label' => __('Google plus', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'linkedin',
			[
				'label' => __('Linkedin', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'whatsapp',
			[
				'label' => __('WhatsApp', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'mail',
			[
				'label' => __('Mail', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();
		
	}

	protected function render() {

		$settings = $this->get_settings();

		$out = '';

		if ( is_tax() ) { 
			$title = get_term_link(get_query_var('term'), get_query_var('taxonomy'));
		} elseif(is_post_type_archive()) {
			$title = get_post_type_archive_link(get_query_var('post_type'));
		} else {
			global $post;
			$permalink = get_permalink(get_queried_object_id());
			$title = get_the_title(get_queried_object_id());
		}

		if ($settings['facebook'] == 'yes') {
			$out .= '<a target="_blank" class="sharer fa fa-facebook" href="http://www.facebook.com/sharer.php?u='.urlencode($permalink).'&t='.rawurlencode($title).'" title="'.__('Share in Facebook', 'bilnea').'"></a>';
		}

		if ($settings['twitter'] == 'yes') {
			$user = '';
			if ($settings['twitter_user']) {
				$user = $settings['twitter_user'];
			}
			$out .= '<a target="_blank" class="sharer fa fa-twitter" href="https://twitter.com/intent/tweet?original_referer='.urlencode($permalink).'&related='.$user.'&text='.rawurlencode($title).'&tw_p=tweetbutton&url='.urlencode($permalink).(($user != '') ? '$via='.$user : '').'" title="'.__('Share in Twitter', 'bilnea').'"></a>';
		}

		if ($settings['linkedin'] == 'yes') {
			$out .= '<a target="_blank" class="sharer fa fa-linkedin" href="http://linkedin.com/shareArticle?mini=true&title='.rawurlencode($title).'&url='.urlencode($permalink).'" title="'.__('Share in Linkedin', 'bilnea').'"></a>';
		}

		if ($settings['google-plus'] == 'yes') {
			$out .= '<a target="_blank" class="sharer fa fa-google-plus" href="https://plus.google.com/share?url='.urlencode($permalink).'" title="'.__('Share in Google +', 'bilnea').'"></a>';
		}

		if ($settings['whatsapp'] == 'yes') {
			if (wp_is_mobile()) {
				$out .= '<a class="sharer fa fa-whatsapp" href="whatsapp://send?text='.rawurlencode($title).' – '.urlencode($permalink).'" title="'.__('Share in Whatsapp', 'bilnea').'"></a>';
			}
		}

		if ($settings['mail'] == 'yes') {
			$out .= '<a class="sharer fa fa-envelope" href="mailto:?subject='.rawurlencode($title).'&body='.urlencode($permalink).'" title="'.__('Share by email', 'bilnea').'"></a>';
		}

		echo '<div class="b_share">'.$out.'</div>';
		
	}

	protected function content_template() {
		
	}
}
