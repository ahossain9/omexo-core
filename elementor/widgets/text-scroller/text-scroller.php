<?php

/**
 * omexer_insight testimonial carousel widget for elementor
 * @package Omexer_Insight
 * @since 1.0.0
 */

namespace Omexer_Insight\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;

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
				'label' => __('Content', 'omexer-insight'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'title',
			[
				'label' => __('Title', 'omexer-insight'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __('Expert Instructors', 'omexer-insight'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'icon',
			[
				'label' => esc_html__('Icon', 'omexer-insight'),
				'type' => Controls_Manager::ICONS,
				'label_block' => true,
				'default' => [
					'value' => 'fas fa-circle',
					'library' => 'fa-solid',
				],
			]
		);
		$this->add_control(
			'list_item',
			[
				'label' => __('Text List', 'omexer-insight'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => __('Title 1', 'omexer-insight'),
					],
					[
						'title' => __('Title 2', 'omexer-insight'),
					],
					[
						'title' => __('Title 3', 'omexer-insight'),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);
		$this->end_controls_section();

		// Options
		$this->start_controls_section(
			'options',
			[
				'label' => esc_html__('Options', 'omexer-insight'),
			]
		);
		$this->add_control(
			'animation_speed',
			[
				'label' => __('Scroll Speed', 'omexer-insight'),
				'type' => Controls_Manager::NUMBER,
				'default' => 15,
			]
		);
		$this->end_controls_section();

		// Style tab
		$this->start_controls_section(
			'section_content_style',
			[
				'label' => __('Content', 'omexer-insight'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'item_spacing',
			[
				'label' => __('Item Spacing', 'omexer-insight'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .scroller-content' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .scroller-content' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
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
			'title_color',
			[
				'label' => __('Color', 'omexer-insight'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .scroller-content .scroller-text' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
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
		$this->add_responsive_control(
			'icon_spacing',
			[
				'label' => __('Spacing', 'omexer-insight'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .scroller-content .scroller-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

?>
		<?php
		if ($settings['list_item']) : ?>
			<div class="text-scroller-wrap">
				<div class="text-scroller-inner">
					<?php foreach ($settings['list_item'] as $item) : ?>
						<div class="scroller-content">
							<?php if (!empty($item['title'])) : ?>
								<span class="scroller-text">
									<?php echo esc_html__($item['title']); ?>
								</span>
							<?php endif; ?>
							<span class="scroller-icon">
								<?php Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true']); ?>
							</span>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>
		<style>
			.text-scroller-inner {
				animation: marquee <?php echo $settings['animation_speed'];?>s linear infinite;
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

	}
}
