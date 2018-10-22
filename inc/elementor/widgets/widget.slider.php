<?php

namespace Elementorbilnea\Widgets;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

if (! defined('ABSPATH')) {
	exit;
}

class bilnea_Slider extends Widget_Base {

	public function get_name() {
		return 'bilnea_slider';
	}

	public function get_title() {
		return __('Slider', 'bilnea');
	}

	public function get_icon() {
		return 'eicon-slideshow';
	}

	public function get_categories() {
		return ['bilnea'];
	}

	public function get_script_depends() {
		return ['imagesloaded', 'jquery-slick'];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_slides',
			[
				'label' => __('Slides', 'bilnea'),
			]
		);

		$repeater = new Repeater();

		$repeater->start_controls_tabs('slides_repeater');

		$repeater->start_controls_tab('background', ['label' => __('Background', 'bilnea')]);

		$repeater->add_control(
			'background_color',
			[
				'label' => __('Color', 'bilnea'),
				'type' => Controls_Manager::COLOR,
				'default' => '#bbbbbb',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-bg' => 'background-color: {{VALUE}}',
				],
			]
		);

		$repeater->add_control(
			'background_image',
			[
				'label' => __('Image', 'bilnea'),
				'type' => Controls_Manager::MEDIA,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-bg' => 'background-image: url({{URL}})',
				],
			]
		);

		$repeater->add_control(
			'background_size',
			[
				'label' => __('Background size', 'bilnea'),
				'type' => Controls_Manager::SELECT,
				'default' => 'cover',
				'options' => [
					'cover' => __('Cover', 'bilnea'),
					'contain' => __('Contain', 'bilnea'),
					'auto' => __('Auto', 'bilnea'),
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-bg' => 'background-size: {{VALUE}}',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'background_image[url]',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'background_overlay',
			[
				'label' => __('Background Overlay', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => '',
				'separator' => 'before',
				'conditions' => [
					'terms' => [
						[
							'name' => 'background_image[url]',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'background_overlay_color',
			[
				'label' => __('Color', 'bilnea'),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(0,0,0,0.5)',
				'conditions' => [
					'terms' => [
						[
							'name' => 'background_overlay',
							'operator' => '==',
							'value' => 'yes',
						],
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-inner .elementor-background-overlay' => 'background-color: {{VALUE}}',
				],
			]
		);

		$repeater->add_control(
			'background_animation',
			[
				'label' => __('Animation', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => '',
				'separator' => 'before',
				'conditions' => [
					'terms' => [
						[
							'name' => 'background_image[url]',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'zoom_direction',
			[
				'label' => __('Type', 'bilnea'),
				'type' => Controls_Manager::SELECT,
				'default' => 'in',
				'options' => [
					'in' => __('Zoom in', 'bilnea'),
					'out' => __('Zoom out', 'bilnea'),
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'background_animation',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'background_parallax',
			[
				'label' => __('Parallax', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => '',
				'separator' => 'before',
				'conditions' => [
					'terms' => [
						[
							'name' => 'background_image[url]',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'parallax_value',
			[
				'label' => __('Parallax speed', 'bilnea'),
				'type' => Controls_Manager::NUMBER,
				'default' => 0.2,
				'min' => 0,
				'max' => 10,
				'step' => 0.1,
				'conditions' => [
					'terms' => [
						[
							'name' => 'background_parallax',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab('content_wrap', ['label' => __('Content', 'bilnea')]);

		$repeater->add_control(
			'slider_content',
			[
				'label' => __('Content', 'bilnea'),
				'type' => Controls_Manager::CODE,
				'default' => '',
				'placeholder' => __('Enter your embed code here', 'bilnea'),
				'show_label' => false,
			]
		);

		$repeater->add_control(
			'full_link',
			[
				'label' => __('Link', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => '',
				'separator' => 'before',
			]
		);

		$repeater->add_control(
			'link',
			[
				'label' => __('Url', 'bilnea'),
				'type' => Controls_Manager::URL,
				'placeholder' => __('http://your-link.com', 'bilnea'),
				'conditions' => [
					'terms' => [
						[
							'name' => 'full_link',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'horizontal_position',
			[
				'label' => __('Horizontal Position', 'bilnea'),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => __('Left', 'bilnea'),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __('Center', 'bilnea'),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => __('Right', 'bilnea'),
						'icon' => 'eicon-h-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-inner .elementor-slide-content' => '{{VALUE}}',
				],
				'selectors_dictionary' => [
					'left' => 'margin-right: auto',
					'center' => 'margin: 0 auto',
					'right' => 'margin-left: auto',
				],
			]
		);

		$repeater->add_control(
			'vertical_position',
			[
				'label' => __('Vertical Position', 'bilnea'),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'top' => [
						'title' => __('Top', 'bilnea'),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __('Middle', 'bilnea'),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __('Bottom', 'bilnea'),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-inner' => 'align-items: {{VALUE}}',
				],
				'selectors_dictionary' => [
					'top' => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				],
			]
		);

		$repeater->add_control(
			'text_align',
			[
				'label' => __('Text Align', 'bilnea'),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
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
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-inner' => 'text-align: {{VALUE}}',
				],
			]
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control(
			'slides',
			[
				'label' => __('Slides', 'bilnea'),
				'type' => Controls_Manager::REPEATER,
				'show_label' => true,
				'default' => [
					[
						'background_color' => '#833ca3',
					],
					[
						'background_color' => '#4054b2',
					],
					[
						'background_color' => '#1abc9c',
					],
				],
				'fields' => array_values($repeater->get_controls()),
			]
		);

		$this->add_responsive_control(
			'slides_height',
			[
				'label' => __('Height', 'bilnea'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1000,
					],
					'vh' => [
						'min' => 10,
						'max' => 100,
					],
					'vw' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 400,
				],
				'size_units' => ['px', 'vh', 'vw', 'em'],
				'selectors' => [
					'{{WRAPPER}} .slick-slide' => 'height: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_slider_options',
			[
				'label' => __('Slider Options', 'bilnea'),
				'type' => Controls_Manager::SECTION,
			]
		);

		$this->add_control(
			'navigation',
			[
				'label' => __('Navigation', 'bilnea'),
				'type' => Controls_Manager::SELECT,
				'default' => 'both',
				'options' => [
					'both' => __('Arrows and Dots', 'bilnea'),
					'arrows' => __('Arrows', 'bilnea'),
					'dots' => __('Dots', 'bilnea'),
					'none' => __('None', 'bilnea'),
				],
			]
		);

		$this->add_responsive_control(
			'display',
			[
				'label' => __('Slides displayed', 'bilnea'),
				'type' => Controls_Manager::NUMBER,
				'desktop_default' => 1,
				'tablet_default' => 1,
				'mobile_default' => 1
			]
		);

		$this->add_responsive_control(
			'scroll',
			[
				'label' => __('Slides to scroll', 'bilnea'),
				'type' => Controls_Manager::NUMBER,
				'desktop_default' => 1,
				'tablet_default' => 1,
				'mobile_default' => 1
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label' => __('Pause on Hover', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label' => __('Autoplay', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label' => __('Autoplay Speed', 'bilnea'),
				'type' => Controls_Manager::NUMBER,
				'default' => 5000,
				'condition' => [
					'autoplay' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .slick-slide-bg' => 'animation-duration: calc({{VALUE}}ms*1.2); transition-duration: calc({{VALUE}}ms)',
				],
			]
		);

		$this->add_control(
			'infinite',
			[
				'label' => __('Infinite Loop', 'bilnea'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'transition',
			[
				'label' => __('Transition', 'bilnea'),
				'type' => Controls_Manager::SELECT,
				'default' => 'slide',
				'options' => [
					'slide' => __('Slide', 'bilnea'),
					'fade' => __('Fade', 'bilnea'),
				],
			]
		);

		$this->add_control(
			'transition_speed',
			[
				'label' => __('Transition Speed (ms)', 'bilnea'),
				'type' => Controls_Manager::NUMBER,
				'default' => 500,
			]
		);

		$this->add_control(
			'content_animation',
			[
				'label' => __('Content Animation', 'bilnea'),
				'type' => Controls_Manager::SELECT,
				'default' => 'fadeInUp',
				'options' => [
					'' => __('None', 'bilnea'),
					'fadeInDown' => __('Down', 'bilnea'),
					'fadeInUp' => __('Up', 'bilnea'),
					'fadeInRight' => __('Right', 'bilnea'),
					'fadeInLeft' => __('Left', 'bilnea'),
					'zoomIn' => __('Zoom', 'bilnea'),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_slides',
			[
				'label' => __('Slides', 'bilnea'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'content_max_width',
			[
				'label' => __('Content Width', 'bilnea'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => ['%', 'px'],
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
				'selectors' => [
					'{{WRAPPER}} .elementor-slide-content' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'slides_padding',
			[
				'label' => __('Padding', 'bilnea'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .slick-slide-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'slides_horizontal_position',
			[
				'label' => __('Horizontal Position', 'bilnea'),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'default' => 'center',
				'options' => [
					'left' => [
						'title' => __('Left', 'bilnea'),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __('Center', 'bilnea'),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => __('Right', 'bilnea'),
						'icon' => 'eicon-h-align-right',
					],
				],
				'prefix_class' => 'elementor--h-position-',
			]
		);

		$this->add_control(
			'slides_vertical_position',
			[
				'label' => __('Vertical Position', 'bilnea'),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'default' => 'middle',
				'options' => [
					'top' => [
						'title' => __('Top', 'bilnea'),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __('Middle', 'bilnea'),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __('Bottom', 'bilnea'),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'prefix_class' => 'elementor--v-position-',
			]
		);

		$this->add_control(
			'slides_text_align',
			[
				'label' => __('Text Align', 'bilnea'),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
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
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .slick-slide-inner' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_navigation',
			[
				'label' => __('Navigation', 'bilnea'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'navigation' => ['arrows', 'dots', 'both'],
				],
			]
		);

		$this->add_control(
			'heading_style_arrows',
			[
				'label' => __('Arrows', 'bilnea'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'navigation' => ['arrows', 'both'],
				],
			]
		);

		$this->add_control(
			'arrows_position',
			[
				'label' => __('Arrows Position', 'bilnea'),
				'type' => Controls_Manager::SELECT,
				'default' => 'inside',
				'options' => [
					'inside' => __('Inside', 'bilnea'),
					'outside' => __('Outside', 'bilnea'),
				],
				'condition' => [
					'navigation' => ['arrows', 'both'],
				],
			]
		);

		$this->add_control(
			'arrows_size',
			[
				'label' => __('Arrows Size', 'bilnea'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 60,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-slides-wrapper .slick-slider .slick-prev:before, {{WRAPPER}} .elementor-slides-wrapper .slick-slider .slick-next:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => ['arrows', 'both'],
				],
			]
		);

		$this->add_control(
			'arrows_color',
			[
				'label' => __('Arrows Color', 'bilnea'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-slides-wrapper .slick-slider .slick-prev:before, {{WRAPPER}} .elementor-slides-wrapper .slick-slider .slick-next:before' => 'color: {{VALUE}};',
				],
				'condition' => [
					'navigation' => ['arrows', 'both'],
				],
			]
		);

		$this->add_control(
			'heading_style_dots',
			[
				'label' => __('Dots', 'bilnea'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'navigation' => ['dots', 'both'],
				],
			]
		);

		$this->add_control(
			'dots_position',
			[
				'label' => __('Dots Position', 'bilnea'),
				'type' => Controls_Manager::SELECT,
				'default' => 'inside',
				'options' => [
					'outside' => __('Outside', 'bilnea'),
					'inside' => __('Inside', 'bilnea'),
				],
				'condition' => [
					'navigation' => ['dots', 'both'],
				],
			]
		);

		$this->add_control(
			'dots_size',
			[
				'label' => __('Dots Size', 'bilnea'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 15,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-slides-wrapper .elementor-slides .slick-dots li button:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => ['dots', 'both'],
				],
			]
		);

		$this->add_control(
			'dots_color',
			[
				'label' => __('Dots Color', 'bilnea'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-slides-wrapper .elementor-slides .slick-dots li button:before' => 'color: {{VALUE}};',
				],
				'condition' => [
					'navigation' => ['dots', 'both'],
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings();

		wp_enqueue_style('elementor.slider', get_template_directory_uri().'/css/internal/elementor.slider.css', array(), b_f_versions());
		wp_enqueue_script('elementor.slider', get_template_directory_uri().'/js/internal/elementor.slider.js', ['jquery'], b_f_versions(), true);

		if (empty($settings['slides'])) {
			return;
		}

		$slides = [];
		$slide_count = 0;
		foreach ($settings['slides'] as $slide) {
			$slide_html = $slide_attributes = '';
			$btn_element = $slide_element = 'div';
			$slide_url = $slide['link']['url'];

			if (! empty($slide_url)) {
				$this->add_render_attribute('slide_link'.$slide_count , 'href', $slide_url);

				if ($slide['link']['is_external']) {
					$this->add_render_attribute('slide_link'.$slide_count, 'target', '_blank');
				}

			    $slide_element = 'a';
				$slide_attributes = $this->get_render_attribute_string('slide_link'.$slide_count);
			}

			if ('yes' === $slide['background_overlay']) {
				$slide_html .= '<div class="elementor-background-overlay"></div>';
			}

			$slide_html .= '<div class="elementor-slide-content"><div class="elementor-slide-description">'.$slide['slider_content'].'</div>';

			$ken_class = '';

			if ('' != $slide['background_animation']) {
				$ken_class = ' elementor-ken-'.$slide['zoom_direction'];
			}

			$slide_html .= '</div>';
			$slide_html = '<div class="slick-slide-bg'.$ken_class.'"></div><'.$slide_element.' '.$slide_attributes.' class="slick-slide-inner">'.$slide_html.'</'.$slide_element.'>';
			$slides[] = '<div class="elementor-repeater-item-'.$slide['_id'].' slick-slide">'.$slide_html.'</div>';
			$slide_count++;
		}

		$is_rtl = is_rtl();
		$direction = $is_rtl ? 'rtl' : 'ltr';
		$show_dots = (in_array($settings['navigation'], ['dots', 'both']));
		$show_arrows = (in_array($settings['navigation'], ['arrows', 'both']));

		$slick_options = [
			'slidesToShow' => $settings['display'],
			'slidesToScroll' => $settings['scroll'],
			'autoplaySpeed' => absint($settings['autoplay_speed']),
			'autoplay' => ('yes' === $settings['autoplay']),
			'infinite' => ('yes' === $settings['infinite']),
			'pauseOnHover' => ('yes' === $settings['pause_on_hover']),
			'speed' => absint($settings['transition_speed']),
			'arrows' => $show_arrows,
			'dots' => $show_dots,
			'rtl' => $is_rtl,
			'responsive' => array([
				'breakpoint' => 1024,
				'settings' => [
					'slidesToShow' => $settings['display_tablet'],
					'slidesToScroll' => $settings['scroll_tablet']
				]
			],[
				'breakpoint' => 767,
				'settings' => [
					'slidesToShow' => $settings['display_mobile'],
					'slidesToScroll' => $settings['scroll_mobile']
				]
			])
		];

		if ('fade' === $settings['transition']) {
			$slick_options['fade'] = true;
		}

		$carousel_classes = ['elementor-slides'];

		if ($show_arrows) {
			$carousel_classes[] = 'slick-arrows-'.$settings['arrows_position'];
		}

		if ($show_dots) {
			$carousel_classes[] = 'slick-dots-'.$settings['dots_position'];
		}

		$this->add_render_attribute('slides', [
			'class' => $carousel_classes,
			'data-slider_options' => wp_json_encode($slick_options),
			'data-animation' => $settings['content_animation'],
		]);

		?>
		<div class="elementor-slides-wrapper elementor-slick-slider" dir="<?php echo $direction; ?>">
			<div <?php echo $this->get_render_attribute_string('slides'); ?>>
				<?php echo implode('', $slides); ?>
			</div>
		</div>
		<?php

	}

	protected function content_template() {

	}
}
