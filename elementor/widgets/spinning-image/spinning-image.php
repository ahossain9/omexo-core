<?php

/**
 * omexer_insight course grid widget for elementor
 * @package Omexer_Insight
 * @since 1.0.0
 */

namespace Omexer_Insight\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Utils;

defined('ABSPATH') || die();

class Spinning_Image extends Widget_Base
{

	public function get_name()
	{
		return 'omexer-spinning-image';
	}

	public function get_title()
	{
		return __('Spinning Image', 'omexer-insight');
	}

	public function get_icon()
	{
		return 'omexer-insight-icon eicon-gallery-grid';
	}

	public function get_categories()
	{
		return ['omexer_insight'];
	}

	public function get_keywords()
	{
		return [
			'image',
			'spinning image',
			'omexer spinning image',
			'omexer',
		];
	}

	protected function register_controls()
	{
		$this->start_controls_section(
			'section_image',
			[
				'label' => esc_html__('Image', 'omexer-insight'),
			]
		);

		$this->add_control(
			'image',
			[
				'label' => esc_html__('Choose Image', 'omexer-insight'),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_image',
			[
				'label' => esc_html__('Image', 'omexer-insight'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => esc_html__('Alignment', 'omexer-insight'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'omexer-insight'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'omexer-insight'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'omexer-insight'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'width',
			[
				'label' => esc_html__('Width', 'omexer-insight'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => ['px', '%', 'em', 'rem', 'vw', 'custom'],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'space',
			[
				'label' => esc_html__('Max Width', 'omexer-insight'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => ['px', '%', 'em', 'rem', 'vw', 'custom'],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'height',
			[
				'label' => esc_html__('Height', 'omexer-insight'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'vh', 'custom'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 500,
					],
					'vh' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'separator_panel_style',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} img',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => esc_html__('Border Radius', 'omexer-insight'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} img',
			]
		);

		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
?>
		<div class="spinning-image-wrap">
			<?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'image'); ?>
			<span class="icon">20</span>
		</div>

<?php
	}
}
