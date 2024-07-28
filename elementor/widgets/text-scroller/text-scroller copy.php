<?php

/**
 * omexer_insight course grid widget for elementor
 * @package Omexer_Insight
 * @since 1.0.0
 */

namespace Omexer_Insight\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Icons_Manager;

defined('ABSPATH') || die();

class Text_Scroller extends Widget_Base
{

	public function get_name()
	{
		return 'omexer-text-scroller';
	}

	public function get_title()
	{
		return __('Text Scroller', 'omexer-insight');
	}

	public function get_icon()
	{
		return 'omexer-insight-icon eicon-slider-3d';
	}

	public function get_categories()
	{
		return ['omexer_insight'];
	}

	public function get_keywords()
	{
		return [
			'scroller',
			'text scroller',
			'omexer text scroller image',
			'omexer',
		];
	}

	protected function register_controls()
	{
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__('Content', 'omexer-insight'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title_heading',
			[
				'label' => __('Title', 'omexer-insight'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'list',
			[
				'label' => esc_html__('Content List', 'omexer-insight'),
				'type' => Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'list_title',
						'label' => esc_html__('Title', 'omexer-insight'),
						'type' => Controls_Manager::TEXTAREA,
						'default' => esc_html__('List Title', 'omexer-insight'),
						'label_block' => true,
					],
					[
						'name' => 'icon',
						'label' => esc_html__('Icon', 'omexer-insight'),
						'type' => Controls_Manager::ICONS,
						'default' => [
							'value' => 'fas fa-circle',
							'library' => 'fa-solid',
						],
					]
				],
				'default' => [
					[
						'list_title' => esc_html__('Title 1', 'omexer-insight'),
					],
					[
						'list_title' => esc_html__('Title 2', 'omexer-insight'),
					],
				],
				'title_field' => '{{{ list_title }}}',
			]
		);
		$this->add_control(
			'test',
			[
				'label' => esc_html__('Size', 'omexer-insight'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [''],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__('Content', 'omexer-insight'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Text Color', 'omexer-insight'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .scroller-content .scroller-text' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'selector' => '{{WRAPPER}} .scroller-content .scroller-text',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'text_stroke',
				'selector' => '{{WRAPPER}} .scroller-content .scroller-text',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} .scroller-content .scroller-text',
			]
		);

		$this->add_control(
			'icon_heading',
			[
				'label' => __('Icon', 'omexer-insight'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__('Color', 'omexer-insight'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .scroller-content .scroller-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .scroller-content .scroller-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__('Size', 'omexer-insight'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em'],
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .scroller-content .scroller-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .scroller-content .scroller-icon svg' => 'height: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'icon_padding',
			[
				'label' => esc_html__('Spacing', 'omexer-insight'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .scroller-content .scroller-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'range' => [
					'px' => [
						'max' => 100,
					],
					'em' => [
						'min' => 0,
						'max' => 5,
					],
					'rem' => [
						'min' => 0,
						'max' => 5,
					],
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		var_dump($settings['test']);
?>
		<?php if ($settings['list']) : ?>
			<div class="text-scroller-wrap">
				<div class="text-scroller-inner">
					<?php foreach ($settings['list'] as $item) : ?>
						<div class="scroller-content">
							<span class="scroller-text"><?php echo esc_html__($item['list_title']); ?></span>
							<span class="scroller-icon">
								<?php Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true']); ?>
							</span>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<style>
				.text-scroller-inner {
					animation: marquee 10s linear infinite;
				}
				@keyframes marquee {
					0% {
						transform: translateX(0%);
					}

					100% {
						transform: translateX(-100%);
					}
				}
			</style>
<?php
		endif;
	}
}
